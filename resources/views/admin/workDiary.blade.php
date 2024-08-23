@section('title', 'Marmalade Grove | Admin - Packer Diary')

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
                  <h4 class="card-title">Packer Diary</h4>
                </div>

                <div class="col-md-5 mb-3">
                  <div id="reportrange" class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                    <span></span> <b class="caret"></b>
                  </div>
                </div>

                <div class="col mb-3">
                  <a><button class="btn btn-sm btn-primary" onclick="resetFilter()">Reset</button></a>
                </div>
              </div>

              <div class="table-responsive pt-3">
                @if ($works->count() > 0)
                <table class="table table-bordered text-center">
                  <thead>
                    <tr>
                      <th>
                        Date
                      </th>
                      <th>
                        Product
                      </th>
                      <th>
                        Logged By
                      </th>
                      <th>
                        Activity
                      </th>
                      <th>
                        Total Packers
                      </th>
                      <th>
                        Total Hours
                      </th>
                      <th>
                        Rate
                      </th>
                      <th>
                        Total Cost
                      </th>
                      <th>Quantities</th>
                      <th>
                        Cost Per Package
                      </th>
                    </tr>
                  </thead>
                  <tbody id="data">
                    @foreach($works as $index => $item)
                    <tr>
                      <td>{{date('m/d/Y', strtotime($item->date)) }}</td>
                      <td>{{$item->product_types == '' ? '-' : $item->product_types   }}</td>
                      <td>{{ $item->labourname }}</td>
                      <td>{{ $item->activity }}</td>
                      <td>{{ $item->total_packers }}</td>
                      <td>{{$arr[$index] * $item->total_packers }}</td>
                      <td>${{$wage->wage}}/Hour</td>
                      <td>${{$arr[$index] * $wage->wage * $item->total_packers}}</td>
                      <td>{{ $item->quantities == '' ? '-' : $item->quantities }}</td>
                      <td>
                      @if($item->quantities != '')
                        ${{round($arr[$index] * $wage->wage * $item->total_packers/$item->quantities,2) }}
                      @else
                        -
                      @endif
                       
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
    </div>
    <!-- content-wrapper ends -->

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

        let url = "{{ url('admin/filter-packer') }}" + "/" + "from=" + picker.startDate.format('YYYY-MM-DD') + "&to=" + picker.endDate.format('YYYY-MM-DD');

        let li;

        fetch(url).then(response => response.json()).then(json => {

          if (json.length == 0) {

            li = `    
                    <tr>
                    <td colspan="100" class="text-center text-danger"><b>No Data Found</b></td>      
                    </tr>
                    `;

          } else {

            json.forEach(packerDiary => {

              let getDate = new Date(packerDiary.date);
              let date = (getDate.getMonth() + 1) + "/" + getDate.getDate() + "/" + getDate.getFullYear();
              let cost_per_package = 0;
              if(packerDiary.quantities != null)
              {
                cost_per_package ='$'+((packerDiary.hours * packerDiary.wage * packerDiary.total_packers)/packerDiary.quantities).toFixed(2);
              }
              else{
                cost_per_package = '-';
              }
              let quantities = packerDiary.quantities == null ? '-' : packerDiary.quantities;
              let product_types =  packerDiary.product_types == null ? '-' : packerDiary.product_types;
              li += `
                    <tr>
                      <td>${date} </td>
                      <td>${product_types}</td>
                      <td>${packerDiary.labourname}</td>
                      <td>${packerDiary.activity}</td>
                      <td>${packerDiary.total_packers}</td>
                      <td>${packerDiary.hours * packerDiary.total_packers}</td>
                      <td>$${packerDiary.wage}/Hour </td>
                      <td>$${packerDiary.hours * packerDiary.wage * packerDiary.total_packers}</td>
                      <td>${quantities}</td>
                      <td>${cost_per_package}</td>         
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