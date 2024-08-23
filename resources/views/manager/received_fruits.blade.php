@section('title', 'Marmalade Grove | Manager - Received Fruits')

@include('layouts.header')

@include('navbar')

<div class="container-fluid page-body-wrapper">

  @include('sidebar')

  <!-- partial -->
  <div class="main-panel">

    <div class="content-wrapper">
      <!-- <h2 class="font-weight-bolder mb-5">Fruits</h2> -->
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">

              <div class="row">

                <div class="col-md-6 mb-3">
                  <h4 class="card-title">Received Fruits</h4>
                </div>

                <div class="col-md-5 mb-3">
                  <div id="reportrange" class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                    <span></span> <b class="caret"></b>
                  </div>
                </div>

                <div class="col mb-3">
                  <button type="button" class="btn btn-sm btn-warning" name="reset_button" id="reset_button" onclick="resetFilter()">Reset</button>
                </div>

              </div>

              <div class="table-responsive pt-3">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>
                        Date
                      </th>
                      <th>
                        Product types
                      </th>
                      <th>
                        Units
                      </th>
                      <th>
                        Types
                      </th>
                      <th>
                        Weight
                      </th>
                      <th>
                        Sorted Fruits
                      </th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="data">

                    @if(sizeof($fruits) > 0)

                    @foreach ($fruits as $index => $item)
                    <tr>
                      <td>{{date('m/d/Y', strtotime($item->date)) }}</td>
                      <td>{{ $item->product_type }}</td>
                      <td>{{ $item->units }}</td>
                      <td>{{ $item->types }}</td>

                      @if($item->weight != '')
                      <td>{{ $item->weight }} pounds</td>
                      @else
                      <td></td>
                      @endif

                      <td>
                        {{ $item->units - $item->fruit_yet_to_sorted }}
                      </td>

                      <td>
                        <form method="post" action="{{ url('manager/sort_fruit') }}">
                          @csrf

                          <input type="hidden" name="id" value="{{ $item->id }}">

                          @if($item->fruit_id != '')
                          <input type="hidden" name="fruit_id" value="{{ $item->fruit_id }}">
                          @endif

                          <input type="hidden" name="type" value="{{ $item->product_type }}">
                          <input type="hidden" name="product_type" value="{{ $item->types }}">
                          <input type="hidden" name="total_fruits" value="{{ $item->units }}">
                          <input type="hidden" name="fruit_yet_to_sorted" value="{{ $item->fruit_yet_to_sorted }}">
                          <input type="hidden" name="weight" value="{{ $item->weight }}">

                          @if($item->sorted == 1)

                          <button type="submit" class="btn btn-sm btn-success btn-icon-text text-white" disabled>
                            Sorted
                          </button>
                          @else
                          <button type="submit" class="btn btn-sm btn-success btn-icon-text">
                            Sort
                          </button>
                          @endif

                        </form>
                      </td>
                    </tr>
                    @endforeach

                    @else

                    <tr>
                      <td colspan="100" class="text-center text-danger"><b>No Data Found</b></td>
                    </tr>

                    @endif

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- partial -->
      </div>
    </div>
    <!-- main-panel ends -->

    @include('layouts.footer')

    <script type="text/javascript">
      $('#reportrange span').html('Select Range');

      $('#reportrange').daterangepicker({
        ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
          'Last 90 Days': [moment().subtract(89, 'days'), moment()],
          'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
        },
        "locale": {
          "format": "YYYY/MM/DD",
          "separator": " - ",
          "applyLabel": "Apply",
          "cancelLabel": "Cancel",
          "fromLabel": "From",
          "toLabel": "To",
          "customRangeLabel": "Custom",
          "weekLabel": "W",
          "daysOfWeek": [
            "Su",
            "Mo",
            "Tu",
            "We",
            "Th",
            "Fr",
            "Sa"
          ],
          "monthNames": [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December"
          ],
          "firstDay": 1
        },
        "alwaysShowCalendars": true,
        "opens": "center",
        "drops": "auto"
      });

      $('#reportrange').on('apply.daterangepicker', function(ev, picker) {

        $('#reportrange span').html(picker.startDate.format('MMMM D, YYYY') + ' - ' + picker.endDate.format('MMMM D, YYYY'));

        let url = "{{ url('manager/filter-received-fruits') }}" + "/" + "from=" + picker.startDate.format('YYYY-MM-DD') + "&to=" + picker.endDate.format('YYYY-MM-DD');

        let li;

        fetch(url).then(response => response.json()).then(json => {

          if (json.length == 0) {

            li = `    
                    <tr>
                    <td colspan="100" class="text-center text-danger"><b>No Data Found</b></td>      
                    </tr>
                    `;

          } else {

            json.forEach(fruit => {

              let getDate = new Date(fruit.date);

              let date = (getDate.getMonth() + 1) + "/" + getDate.getDate() + "/" + getDate.getFullYear();

              let weight = fruit.weight != '' ? fruit.weight + ' pounds' : '';

              let sortButton;

              if (fruit.sorted == 1) {
                sortButton =
                  `
                    <button type="submit" class="btn btn-sm btn-success btn-icon-text text-white" disabled>
                      Sorted
                    </button>
                    `;
              } else {
                sortButton =
                  `
                    <button type="submit" class="btn btn-sm btn-success btn-icon-text">
                      Sort
                    </button>
                    `;
              }

              li += `
                        <tr>
                          <td>${date}</td>
                          <td>${fruit.product_type}</td>
                          <td>${fruit.units}</td>
                          <td>${fruit.types}</td>
                          <td>${weight}</td>
                          <td>${ fruit.units - fruit.fruit_yet_to_sorted }</td>
                          <td>
                                <form method="post" action="{{ url('manager/sort_fruit') }}">
                                  @csrf

                                  <input type="hidden" name="id" value="${fruit.id}">
                                  <input type="hidden" name="type" value="${fruit.types}">
                                  <input type="hidden" name="product_type" value="${fruit.product_type}">
                                  <input type="hidden" name="total_fruits" value="${fruit.units}">

                                  ${sortButton}

                                </form>
                              </td>        
                        </tr>
                        `;

            })
          }

          $('#data').html(li);

        });
      });

      function resetFilter() {
        window.location.reload();
      }
    </script>

    </body>

    </html>