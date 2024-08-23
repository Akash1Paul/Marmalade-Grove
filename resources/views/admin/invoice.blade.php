@section('title', 'Marmalade Grove | Admin - Invoice')

@include('layouts.header')

@include('navbar')

<div class="container-fluid page-body-wrapper">
  <!-- partial:partials/_sidebar.html -->
  @include('sidebar')
  <!-- partial -->
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Generate Invoice</h4>
              <form action="{{ url('admin/pdf') }}" method="post">
                @csrf
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" name="date" value="" placeholder="Select Date Range" autocomplete="off" class="form-control" />
                      <span class="text-danger">
                        @error('date') {{ $message }} @enderror
                      </span>
                    </div>
                  </div>
                </div>

                <input type="hidden" name="fromDate" id="fromDate" value="">

                <input type="hidden" name="toDate" id="toDate" value="">

                <button type="submit" class="btn btn-primary me-2 generate">Generate Invoice</button>
                <a href="{{url('admin/dashboard')}}" class="btn btn-light">Cancel</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->

    @include('layouts.footer')

    <script>
      $(function() {

        $('input[name="date"]').daterangepicker({

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
        "drops": "auto",
       
        });

        $('input[name="date"]').on('apply.daterangepicker', function(ev, picker) {
          $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));

          $('#fromDate').val(picker.startDate.format('MM/DD/YYYY'));
          $('#toDate').val(picker.endDate.format('MM/DD/YYYY'));

        });

        $('input[name="date"]').on('cancel.daterangepicker', function(ev, picker) {
          $(this).val('');
        });

      });
    </script>

    </body>

    </html>