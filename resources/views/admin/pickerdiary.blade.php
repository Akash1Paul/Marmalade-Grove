@section('title', 'Marmalade Grove | Admin - Picker Diary')

@include('layouts.header')

@include('navbar')

<div class="container-fluid page-body-wrapper">
  <!-- partial:partials/_sidebar.html -->
  @include('sidebar')
  </nav>
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
                  <h4 class="card-title">Picker Diary</h4>
                </div>

                <div class="col-md-4 mb-3">
                  <div id="reportrange" class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                    <span></span> <b class="caret"></b>
                  </div>
                </div>

                <div class="col mb-3">
                  <a><button class="btn btn-sm btn-primary" onclick="resetFilter()">Reset</button></a>
                  <input type="button" class="btn btn-sm btn-primary m-0" value="Create PDF" id="btPrint" onclick="createPDF()" />
                </div>
              </div>

              <div class="table-responsive pt-3 mt-2" id="tbl">
                @if ($pickers->count() > 0)
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
                        Total Weight
                      </th>
                    </tr>
                  </thead>
                  <tbody id="data">
                    @foreach ($pickers as $index => $item)
                    <tr>
                      <td>{{date('m/d/Y', strtotime($item->date)) }}</td>
                      <td>{{ $item->product_type }}</td>
                      <td>{{ $item->units }}</td>
                      <td>{{ $item->types }}</td>
                      <td>{{ $item->weight }}</td>
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

        let url = "{{ url('admin/filter-picker') }}" + "/" + "from=" + picker.startDate.format('YYYY-MM-DD') + "&to=" + picker.endDate.format('YYYY-MM-DD');

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
              li += `
                    <tr>
                      <td>${date} </td>
                      <td>${fruit.product_type}</td>
                      <td>${fruit.units}</td>
                      <td>${fruit.types}</td>
                      <td>${fruit.weight}</td>      
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

      function createPDF() {
        var sTable = document.getElementById('tbl').innerHTML;

        var style = "<style>";
        style = style + "table {width: 100%;font: 17px Helveticas;}";
        style = style + "table,tr, th, td {border: solid 1px #dee2e6;padding:15px; border-collapse: collapse;";
        style = style + "padding: 2px 3px;text-align: center;}";
        style = style + "</style>";

        // CREATE A WINDOW OBJECT.
        var win = window.open('', '', 'height=1000,width=1000');

        win.document.write('<html><head>');
        win.document.write('<title>Fruit List</title>'); // <title> FOR PDF HEADER.
        win.document.write(style); // ADD STYLE INSIDE THE HEAD TAG.
        win.document.write('</head>');
        win.document.write('<body>');
        win.document.write(sTable); // THE TABLE CONTENTS INSIDE THE BODY TAG.
        win.document.write('</body></html>');

        win.document.close(); // CLOSE THE CURRENT WINDOW.

        win.print(); // PRINT THE CONTENTS.
      }
    </script>

    </body>

    </html>