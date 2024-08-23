@section('title', 'Marmalade Grove | Packer - Work Diary')

@include('layouts.header')

@include('navbar')

<div class="container-fluid page-body-wrapper">
  <!-- partial:partials/_sidebar.html -->
  @include('sidebar')
  <!-- partial -->
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">

              <div class="row">

                <div class="col-md-6 mb-3">
                  <h4 class="card-title">Work Diary</h4>
                </div>

                <div class="col-md-4 mb-3">
                  <div id="reportrange" class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                    <span></span> <b class="caret"></b>
                  </div>
                </div>

                <div class="col-md-2 mb-3">
                  <a><button class="btn btn-sm btn-primary" onclick="resetFilter()">Reset</button></a>
                  <a href="{{url('packer/add_work')}}"><button type="button" class="btn btn-sm btn-primary">Add</button></a>
                </div>
              </div>

              <div class="table-responsive pt-3">
                @if ($packers->count() > 0)
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>
                        Date
                      </th>
                      <th>
                        Activity
                      </th>
                      <th>
                        Product Types
                      </th>
                      <th>
                        Quantities
                      </th>
                      <th>
                        Box
                      </th>
                      <th>Total Hours</th>
                      <th>
                        Logged By
                      </th>
                      <th>
                        Action
                      </th>
                    </tr>
                  </thead>
                  <tbody id="data">
                    @foreach ($packers as $index => $item)
                    <tr>
                      <td>{{date('m/d/Y', strtotime($item->date)) }}</td>
                      <td>{{ $item->activity }}</td>
                      <td>{{ $item->product_types == '' ? '-' : $item->product_types  }}</td>
                      <td>{{ $item->quantities == '' ? '-' : $item->quantities }}</td>
                      <td>{{ $item->boxsize == '' ? '-' : $item->boxsize.' LB' }}</td>
                      <td>{{ $data[$index] }} Hours</td>
                      <td>{{ $item->labourname }}</td>
                      <td>
                        <a href="{{url('packer/edit_work/'.$item['id'])}}" class="btn btn-sm btn-success btn-icon-text">
                          Edit
                          <i class="ti-file btn-icon-append"></i>
                        </a>
                        <a href="{{ url('packer/delete_work/'. $item['id']) }}" type="button" class="btn btn-sm btn-danger btn-icon-text" onclick="return confirm('Do you want to delete this work ?')">
                          Delete
                        </a>
                      </td>
                    </tr>
                    @endforeach

                  </tbody>
                </table>
                @else
                <div>
                  <p class="text-danger text-center">No Data Found</p>
                </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>

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

          let url = "{{ url('packer/filter-work-diary') }}" + "/" + "from=" + picker.startDate.format('YYYY-MM-DD') + "&to=" + picker.endDate.format('YYYY-MM-DD');

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

                let getDate = new Date(work.date);

                let date = (getDate.getMonth() + 1) + "/" + getDate.getDate() + "/" + getDate.getFullYear();

                li += `
                <tbody>
                <tr>
                    <td>${date} </td>
                    <td>${work.activity}</td>
                    <td>${work.product_types}</td>
                    <td>${work.quantities}</td>
                    <td>${work.boxsize}</td>
                    <td>${work.hours}</td>
                    <td>${work.labourname}</td>
                    <td>
                    <a href="{{url('packer/edit_work/${work.id}')}}" class="btn btn-sm btn-success btn-icon-text">
                      Edit
                      <i class="ti-file btn-icon-append"></i>
                    </a>
                        <a href="{{ url('packer/delete_work/${work.id}') }}" type="button" class="btn btn-sm btn-danger btn-icon-text" onclick="return confirm('Do you want to delete this work ?')">
                          Delete
                    </a>
                    </td>        
                </tr>
                </tbody>`;

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