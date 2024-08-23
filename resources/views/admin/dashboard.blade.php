@section('title', 'Marmalade Grove | Admin - Dashboard')

@include('layouts.header')

@include('navbar')

<div class="container-fluid page-body-wrapper">
  <!-- partial:partials/_sidebar.html -->
  @include('sidebar')
  <!-- partial -->
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-sm-12">
          <div class="home-tab">
            <div class="tab-content tab-content-basic">
              <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">

                <div class="row mb-4">
                  <div class="col-md-10">
                    <div id="reportrange" class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                      <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                      <span></span> <b class="caret"></b>
                    </div>
                  </div>
                  <div class="col">
                    <button class="btn btn-warning" onclick="resetFilter()">Reset</button>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-12">
                    <div class="statistics-details row align-items-center justify-content-between">
                      <div class="col-md-2 col-4">
                        <p class="statistics-title text-start">Cost per package</p>
                        <h3 class="rate-percentage" id="cost_per_package">${{ round($dashboard['thismonthscop'],2)}}</h3>
                        <!-- <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>-0.5%</span></p> -->
                      </div>
                      {{-- <div class="col-md-2 col-4">
                        <p class="statistics-title text-start">Total Members</p>
                        <h3 class="rate-percentage">6</h3>
                        <!-- <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>-0.5%</span></p> -->
                      </div> --}}
                      <div class="col-md-2 col-4">
                        <p class="statistics-title text-start">Total Hours</p>
                        <h3 class="rate-percentage" id="total_hours">{{ round($dashboard['hours'],2) }}</h3>
                        <!-- <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><span>+0.1%</span></p> -->
                      </div>
                      <div class="col-md-2 col-4">
                        <p class="statistics-title text-start">Total Fruits</p>
                        <h3 class="rate-percentage" id="total_fruits">{{ $dashboard['totalfruits'] }}</h3>
                        <!-- <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>68.8</span></p> -->
                      </div>
                      <div class="col-md-2 col-4">
                        <p class="statistics-title text-start">Completed Packages</p>
                        <h3 class="rate-percentage" id="numberofpackages">{{ $dashboard['numberofpackages'] }}</h3>
                        <!-- <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>68.8</span></p> -->
                      </div>
                      <div class="col-md-2 col-4">
                        <p class="statistics-title text-start">Packaged Fruits</p>
                        <h3 class="rate-percentage" id="packaged_fruits">{{ $dashboard['totalpackfruits'] }}</h3>
                        <!-- <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>68.8</span></p> -->
                      </div>
                      <div class="col-md-2 col-4">
                        <p class="statistics-title text-start">Remaining Fruits</p>
                        <h3 class="rate-percentage" id="remaining_fruits">{{ $dashboard['remaining_fruits']  }}</h3>
                        <!-- <p class="text-success d-flex"><i class="mdi mdi-menu-down"></i><span>+0.8%</span></p> -->
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-8 d-flex flex-column">
                    <div class="row flex-grow">
                      <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                        <div class="card card-rounded">
                          <div class="card-body">
                            <div class="d-sm-flex justify-content-between align-items-start">
                              <div>
                                <h4 class="card-title card-title-dash">Finished Packages Per Day</h4>
                                <h5 class="card-subtitle card-subtitle-dash">This Chart Shows Finished Packages Per Day</h5>
                              </div>
                              <div id="performance-line-legend"></div>
                            </div>
                            <div class="chartjs-wrapper mt-5">
                              <canvas id="performaneLine"></canvas>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 d-flex flex-column">
                    <div class="row flex-grow">
                      <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                        <div class="card bg-primary card-rounded">
                          <div class="card-body pb-0">
                            <h4 class="card-title card-title-dash text-white mb-4">Cost Summary</h4>
                            <div class="row">
                              <div class="col-sm-8" id="cost_summary">
                                <p class="status-summary-ight-white mb-1 text-white">This Month</p>
                                <h2 class="text-info text-white">${{ $dashboard['cost_of_month'] }}</h2>
                              </div>
                              {{-- <div class="col-sm-8">
                                    <div class="status-summary-chart-wrapper pb-4">
                                      <canvas id="status-summary"></canvas>
                                    </div>
                                  </div> --}}
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                        <div class="card card-rounded">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-sm-6">
                                <div class="d-flex justify-content-between align-items-center mb-2 mb-sm-0">
                                  <div class="circle-progress-width">
                                    <div id="totalVisitors" class="progressbar-js-circle pr-2"></div>
                                  </div>
                                  <div>
                                    <p class="text-small mb-2">Total Hours</p>
                                    <h4 class="mb-0 fw-bold" id="hours">{{ $dashboard['hours'] }}</h4>
                                  </div>
                                </div>
                              </div>

                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-8 d-flex flex-column">
                    <div class="row flex-grow">
                      <div class="col-12 grid-margin stretch-card">
                        <div class="card card-rounded">
                          <div class="card-body">
                            <div class="d-sm-flex justify-content-between align-items-start">
                              <div>
                                <h4 class="card-title card-title-dash">Cost Per Package</h4>
                                <p class="card-subtitle card-subtitle-dash">This Graph Shows Cost Per Package Of Each Day</p>
                              </div>
                              <div>
                                <div class="dropdown">
                                  {{-- <button class="btn btn-secondary  btn-lg mb-0 me-0" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> This month </button> --}}
                                  {{-- <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                        <h6 class="dropdown-header">Settings</h6>
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Separated link</a>
                                      </div> --}}
                                </div>
                              </div>
                            </div>
                            <div class="d-sm-flex align-items-center mt-1 justify-content-between">
                              <div class="d-sm-flex align-items-center mt-4 justify-content-between">
                                <h2 class="me-2 fw-bold" >${{ round($dashboard['thismonthscop'],2) }} </h2>
                                <h4 class="me-2">USD</h4>
                                <h4 class="text-success">({{ ($dashboard['thismonthscop'] - $dashboard['lastmonthscop'])/100 }}%)</h4>
                              </div>
                              <div class="me-3">
                                <div id="marketing-overview-legend"></div>
                              </div>
                            </div>
                            <div class="chartjs-bar-wrapper mt-3">
                              <canvas id="marketingOverview"></canvas>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 d-flex flex-column">
                    <div class="row flex-grow">
                      <div class="col-12 grid-margin stretch-card">
                        <div class="card card-rounded">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-lg-12">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                  <div>
                                    <h4 class="card-title card-title-dash">Team Members</h4>
                                  </div>
                                </div>
                                <div class="mt-3">
                                  @foreach ($users as $user => $item)
                                  <div class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                    <div class="d-flex">

                                      @if($item->image != '')

                                      <img class="img-sm rounded-10" src="{{url('userUploads/' . $item->image)}}" alt="profile">

                                      @else

                                      <img class="img-sm rounded-10" src="{{url('userUploads/avatar.png')}}" alt="profile">

                                      @endif
                                      <div class="wrapper ms-3">
                                        <p class="ms-1 mb-1 fw-bold">{{$item->fname}}</p>
                                        <small class="text-muted mb-0">+1 {{$item->phone}}</small>
                                      </div>
                                    </div>
                                  </div>
                                  @endforeach
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    <footer class="footer">
      <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Marmalde Grove</span>
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2023. All rights reserved.</span>
      </div>
    </footer>
    <!-- partial -->
  </div>
  <!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

<!-- plugins:js -->
<script src="{{url('/vendors/js/vendor.bundle.base.js')}}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="{{url('/vendors/chart.js/Chart.min.js')}}"></script>
<script src="{{url('/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{url('/vendors/progressbar.js/progressbar.min.js')}}"></script>

<!-- End plugin js for this page -->

<!-- inject:js -->
<script src="{{url('/js/off-canvas.js')}}"></script>
<script src="{{url('/js/hoverable-collapse.js')}}"></script>
<script src="{{url('/js/template.js')}}"></script>
<script src="{{url('/js/settings.js')}}"></script>
<script src="{{url('/js/todolist.js')}}"></script>
<!-- endinject -->

<!-- Custom js for this page-->
<script src="{{url('/js/jquery.cookie.js" type="text/javascript')}}"></script>
<script src="{{url('/js/Chart.roundedBarCharts.js')}}"></script>
<!-- End custom js for this page-->

<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

<script type="text/javascript">
  $(function() {

    var start = moment().startOf('month');
    var end = moment();
    console.log(start);
    function cb(start, end) {
      var amountToIncreaseWith = 1;
      let startdate = start.toISOString().split('T')[0];
      let startingdate = incrementDate(startdate,amountToIncreaseWith);
      let fromDate =  startingdate.toISOString().split('T')[0];
      console.log(fromDate);
      let toDate = end.toISOString().split('T')[0];
      $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

      let filter = 'empty';
      let url = "{{ url('admin/filter-dashboard') }}" + "/from=" + fromDate + "&to=" + toDate;

      fetch(url).then(response => response.json()).then(json => {

        document.getElementById('cost_per_package').innerHTML = "$" + json.cost_per_package;
        document.getElementById('packaged_fruits').innerHTML = json.packaged_fruits;
        document.getElementById('numberofpackages').innerHTML = json.numberofpackages;
        document.getElementById('remaining_fruits').innerHTML = json.remaining_fruits;
        document.getElementById('total_fruits').innerHTML = json.total_fruits;
        document.getElementById('total_hours').innerHTML = json.total_hours;
        document.getElementById('hours').innerHTML = json.total_hours;
        document.getElementById('cost_summary').innerHTML = `
                    <p class="status-summary-ight-white mb-1 text-white">Estimated Cost</p>
                    <h2 class="text-info text-white">$${Math.round(json.cost_of_month )}</h2>`;

      });

    }

    $('#reportrange').daterangepicker({
      startDate: start,
      endDate: end,
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
    }, cb);

    cb(start, end);

  });
  function incrementDate(dateInput,increment) {
        var dateFormatTotime = new Date(dateInput);
        var increasedDate = new Date(dateFormatTotime.getTime() +(increment *86400000));
        return increasedDate;
    }
</script>

<script>
  (function($) {
    'use strict';
    $(function() {
      if ($("#performaneLine").length) {
        var graphGradient = document.getElementById("performaneLine").getContext('2d');
        var graphGradient2 = document.getElementById("performaneLine").getContext('2d');
        var saleGradientBg = graphGradient.createLinearGradient(5, 0, 5, 100);
        saleGradientBg.addColorStop(0, 'rgba(26, 115, 232, 0.18)');
        saleGradientBg.addColorStop(1, 'rgba(26, 115, 232, 0.02)');
        var saleGradientBg2 = graphGradient2.createLinearGradient(100, 0, 50, 150);
        saleGradientBg2.addColorStop(0, 'rgba(0, 208, 255, 0.19)');
        saleGradientBg2.addColorStop(1, 'rgba(0, 208, 255, 0.03)');
        var salesTopData = {
          labels: ["SUN", "MON", "TUE", "WED", "THU", "FRI", "SAT"],
          datasets: [{
            label: 'This week',
            data: ["{{ $thisWeek['Sun'] }}", "{{ $thisWeek['Mon'] }}", "{{ $thisWeek['Tue'] }}", "{{ $thisWeek['Wed'] }}", "{{ $thisWeek['Thu'] }}", "{{ $thisWeek['Fri'] }}", "{{ $thisWeek['Sat'] }}"],

            backgroundColor: saleGradientBg,
            borderColor: [
              '#1F3BB3',
            ],
            borderWidth: 1.5,
            fill: true, // 3: no fill
            pointBorderWidth: 1,
            pointRadius: [4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4],
            pointHoverRadius: [2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2],
            pointBackgroundColor: ['#1F3BB3)', '#1F3BB3', '#1F3BB3', '#1F3BB3', '#1F3BB3)', '#1F3BB3', '#1F3BB3', '#1F3BB3', '#1F3BB3)', '#1F3BB3', '#1F3BB3', '#1F3BB3', '#1F3BB3)'],
            pointBorderColor: ['#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', ],
          }, {
            label: 'Last week',
            data: ["{{ $lastWeek['Sun'] }}", "{{ $lastWeek['Mon'] }}", "{{ $lastWeek['Tue'] }}", "{{ $lastWeek['Wed'] }}", "{{ $lastWeek['Thu'] }}", "{{ $lastWeek['Fri'] }}", "{{ $lastWeek['Sat'] }}"],
            //data:[{{$dashboard['totalcop']}}],
            backgroundColor: saleGradientBg2,
            borderColor: [
              '#52CDFF',
            ],
            borderWidth: 1.5,
            fill: true, // 3: no fill
            pointBorderWidth: 1,
            pointRadius: [0, 0, 0, 4, 0],
            pointHoverRadius: [0, 0, 0, 2, 0],
            pointBackgroundColor: ['#52CDFF)', '#52CDFF', '#52CDFF', '#52CDFF', '#52CDFF)', '#52CDFF', '#52CDFF', '#52CDFF', '#52CDFF)', '#52CDFF', '#52CDFF', '#52CDFF', '#52CDFF)'],
            pointBorderColor: ['#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', ],
          }]
        };

        var salesTopOptions = {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            yAxes: [{
              gridLines: {
                display: true,
                drawBorder: false,
                color: "#F0F0F0",
                zeroLineColor: '#F0F0F0',
              },
              ticks: {
                beginAtZero: false,
                autoSkip: true,
                maxTicksLimit: 4,
                fontSize: 10,
                color: "#6B778C"
              }
            }],
            xAxes: [{
              gridLines: {
                display: false,
                drawBorder: false,
              },
              ticks: {
                beginAtZero: false,
                autoSkip: true,
                maxTicksLimit: 7,
                fontSize: 10,
                color: "#6B778C"
              }
            }],
          },
          legend: false,
          legendCallback: function(chart) {
            var text = [];
            text.push('<div class="chartjs-legend"><ul>');
            for (var i = 0; i < chart.data.datasets.length; i++) {
              console.log(chart.data.datasets[i]); // see what's inside the obj.
              text.push('<li>');
              text.push('<span style="background-color:' + chart.data.datasets[i].borderColor + '">' + '</span>');
              text.push(chart.data.datasets[i].label);
              text.push('</li>');
            }
            text.push('</ul></div>');
            return text.join("");
          },

          elements: {
            line: {
              tension: 0.4,
            }
          },
          tooltips: {
            backgroundColor: 'rgba(31, 59, 179, 1)',
          }
        }
        var salesTop = new Chart(graphGradient, {
          type: 'line',
          data: salesTopData,
          options: salesTopOptions
        });
        // document.getElementById('performance-line-legend').innerHTML = salesTop.generateLegend();
      }
      if ($("#performaneLine-dark").length) {
        var graphGradient = document.getElementById("performaneLine-dark").getContext('2d');
        var graphGradient2 = document.getElementById("performaneLine-dark").getContext('2d');
        var saleGradientBg = graphGradient.createLinearGradient(5, 0, 5, 100);
        saleGradientBg.addColorStop(0, 'rgba(26, 115, 232, 0.18)');
        saleGradientBg.addColorStop(1, 'rgba(34, 36, 55, 0.5)');
        var saleGradientBg2 = graphGradient2.createLinearGradient(10, 0, 0, 150);
        saleGradientBg2.addColorStop(0, 'rgba(0, 208, 255, 0.19)');
        saleGradientBg2.addColorStop(1, 'rgba(34, 36, 55, 0.2)');
        var salesTopDataDark = {
          labels: ["SUN", "sun", "MON", "mon", "TUE", "tue", "WED", "wed", "THU", "thu", "FRI", "fri", "SAT"],
          datasets: [{
            label: '# of Votes',
            data: [50, 110, 60, 290, 200, 115, 130, 170, 90, 210, 240, 280, 200],
            backgroundColor: saleGradientBg,
            borderColor: [
              '#1F3BB3',
            ],
            borderWidth: 1.5,
            fill: true, // 3: no fill
            pointBorderWidth: 1,
            pointRadius: [4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4],
            pointHoverRadius: [2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2],
            pointBackgroundColor: ['#1F3BB3)', '#1F3BB3', '#1F3BB3', '#1F3BB3', '#1F3BB3)', '#1F3BB3', '#1F3BB3', '#1F3BB3', '#1F3BB3)', '#1F3BB3', '#1F3BB3', '#1F3BB3', '#1F3BB3)'],
            pointBorderColor: ['#222437', '#222437', '#222437', '#222437', '#222437', '#222437', '#222437', '#222437', '#222437', '#222437', '#222437', '#222437', '#222437', ],
          }, {
            label: '# of Votes',
            data: [30, 150, 190, 250, 120, 150, 130, 20, 30, 15, 40, 95, 180],
            backgroundColor: saleGradientBg2,
            borderColor: [
              '#52CDFF',
            ],
            borderWidth: 1.5,
            fill: true, // 3: no fill
            pointBorderWidth: 1,
            pointRadius: [0, 0, 0, 4, 0],
            pointHoverRadius: [0, 0, 0, 2, 0],
            pointBackgroundColor: ['#52CDFF)', '#52CDFF', '#52CDFF', '#52CDFF', '#52CDFF)', '#52CDFF', '#52CDFF', '#52CDFF', '#52CDFF)', '#52CDFF', '#52CDFF', '#52CDFF', '#52CDFF)'],
            pointBorderColor: ['#222437', '#222437', '#222437', '#222437', '#222437', '#222437', '#222437', '#222437', '#222437', '#222437', '#222437', '#222437', '#222437', ],
          }]
        };

        var salesTopOptionsDark = {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            yAxes: [{
              gridLines: {
                display: true,
                drawBorder: false,
                color: "rgba(255,255,255,.05)",
                zeroLineColor: "rgba(255,255,255,.05)",
              },
              ticks: {
                beginAtZero: false,
                autoSkip: true,
                maxTicksLimit: 4,
                fontSize: 10,
                color: "#6B778C"
              }
            }],
            xAxes: [{
              gridLines: {
                display: false,
                drawBorder: false,
              },
              ticks: {
                beginAtZero: false,
                autoSkip: true,
                maxTicksLimit: 7,
                fontSize: 10,
                color: "#6B778C"
              }
            }],
          },
          legend: false,
          legendCallback: function(chart) {
            var text = [];
            text.push('<div class="chartjs-legend"><ul>');
            for (var i = 0; i < chart.data.datasets.length; i++) {
              console.log(chart.data.datasets[i]); // see what's inside the obj.
              text.push('<li>');
              text.push('<span style="background-color:' + chart.data.datasets[i].borderColor + '">' + '</span>');
              text.push(chart.data.datasets[i].label);
              text.push('</li>');
            }
            text.push('</ul></div>');
            return text.join("");
          },

          elements: {
            line: {
              tension: 0.4,
            }
          },
          tooltips: {
            backgroundColor: 'rgba(31, 59, 179, 1)',
          }
        }
        var salesTopDark = new Chart(graphGradient, {
          type: 'line',
          data: salesTopDataDark,
          options: salesTopOptionsDark
        });
        document.getElementById('performance-line-legend-dark').innerHTML = salesTopDark.generateLegend();
      }
      if ($("#datepicker-popup").length) {
        $('#datepicker-popup').datepicker({
          enableOnReadonly: true,
          todayHighlight: true,
        });
        $("#datepicker-popup").datepicker("setDate", "0");
      }
      if ($("#status-summary").length) {
        var statusSummaryChartCanvas = document.getElementById("status-summary").getContext('2d');;
        var statusData = {
          labels: ["SUN", "MON", "TUE", "WED", "THU", "FRI"],
          datasets: [{
            label: '# of Votes',
            data: [50, 68, 70, 10, 12, 80],
            backgroundColor: "#ffcc00",
            borderColor: [
              '#01B6A0',
            ],
            borderWidth: 2,
            fill: false, // 3: no fill
            pointBorderWidth: 0,
            pointRadius: [0, 0, 0, 0, 0, 0],
            pointHoverRadius: [0, 0, 0, 0, 0, 0],
          }]
        };

        var statusOptions = {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            yAxes: [{
              display: false,
              gridLines: {
                display: false,
                drawBorder: false,
                color: "#F0F0F0"
              },
              ticks: {
                beginAtZero: false,
                autoSkip: true,
                maxTicksLimit: 4,
                fontSize: 10,
                color: "#6B778C"
              }
            }],
            xAxes: [{
              display: false,
              gridLines: {
                display: false,
                drawBorder: false,
              },
              ticks: {
                beginAtZero: false,
                autoSkip: true,
                maxTicksLimit: 7,
                fontSize: 10,
                color: "#6B778C"
              }
            }],
          },
          legend: false,

          elements: {
            line: {
              tension: 0.4,
            }
          },
          tooltips: {
            backgroundColor: 'rgba(31, 59, 179, 1)',
          }
        }
        var statusSummaryChart = new Chart(statusSummaryChartCanvas, {
          type: 'line',
          data: statusData,
          options: statusOptions
        });
      }
      if ($('#totalVisitors').length) {
        var bar = new ProgressBar.Circle(totalVisitors, {
          color: '#fff',
          // This has to be the same size as the maximum width to
          // prevent clipping
          strokeWidth: 15,
          trailWidth: 15,
          easing: 'easeInOut',
          duration: 1400,
          text: {
            autoStyleContainer: false
          },
          from: {
            color: '#52CDFF',
            width: 15
          },
          to: {
            color: '#677ae4',
            width: 15
          },
          // Set default step function for all animate calls
          step: function(state, circle) {
            circle.path.setAttribute('stroke', state.color);
            circle.path.setAttribute('stroke-width', state.width);

            var value = Math.round(circle.value() * 100);
            if (value === 0) {
              circle.setText('');
            } else {
              circle.setText(value);
            }

          }
        });

        bar.text.style.fontSize = '0rem';
        bar.animate("{{$dashboard['hours']/60}}"); // Number from 0.0 to 1.0
      }
      if ($('#visitperday').length) {
        var bar = new ProgressBar.Circle(visitperday, {
          color: '#fff',
          // This has to be the same size as the maximum width to
          // prevent clipping
          strokeWidth: 15,
          trailWidth: 15,
          easing: 'easeInOut',
          duration: 1400,
          text: {
            autoStyleContainer: false
          },
          from: {
            color: '#34B1AA',
            width: 15
          },
          to: {
            color: '#677ae4',
            width: 15
          },
          // Set default step function for all animate calls
          step: function(state, circle) {
            circle.path.setAttribute('stroke', state.color);
            circle.path.setAttribute('stroke-width', state.width);

            var value = Math.round(circle.value() * 100);
            if (value === 0) {
              circle.setText('');
            } else {
              circle.setText(value);
            }

          }
        });

        bar.text.style.fontSize = '0rem';
        bar.animate(); // Number from 0.0 to 1.0
      }
      if ($("#marketingOverview").length) {
        var marketingOverviewChart = document.getElementById("marketingOverview").getContext('2d');
        var marketingOverviewData = {
          labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"],
          datasets: [{
            label: 'Last week',
            data: ["{{ $coplastweeks['Jan'] }}", "{{ $coplastweeks['Feb'] }}", "{{ $coplastweeks['Mar'] }}", "{{ $coplastweeks['Apr'] }}", "{{ $coplastweeks['May'] }}", "{{ $coplastweeks['Jun'] }}", "{{ $coplastweeks['Jul'] }}", "{{ $coplastweeks['Aug'] }}", "{{ $coplastweeks['Sep'] }}", "{{ $coplastweeks['Oct'] }}", "{{ $coplastweeks['Nov'] }}", "{{ $coplastweeks['Dec'] }}"],
            backgroundColor: "#52CDFF",
            borderColor: [
              '#52CDFF',
            ],
            borderWidth: 0,
            fill: true, // 3: no fill

          }, {
            label: 'This week',
            data: ["{{ $copthisweeks['Jan'] }}", "{{ $copthisweeks['Feb'] }}", "{{ $copthisweeks['Mar'] }}", "{{ $copthisweeks['Apr'] }}", "{{ $copthisweeks['May'] }}", "{{ $copthisweeks['Jun'] }}", "{{ $copthisweeks['Jul'] }}", "{{ $copthisweeks['Aug'] }}", "{{ $copthisweeks['Sep'] }}", "{{ $copthisweeks['Oct'] }}", "{{ $copthisweeks['Nov'] }}", "{{ $copthisweeks['Dec'] }}"],
            backgroundColor: "#1F3BB3",
            borderColor: [
              '#1F3BB3',
            ],
            borderWidth: 0,
            fill: true, // 3: no fill
          }]
        };

        var marketingOverviewOptions = {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            yAxes: [{
              gridLines: {
                display: true,
                drawBorder: false,
                color: "#F0F0F0",
                zeroLineColor: '#F0F0F0',
              },
              ticks: {
                beginAtZero: true,
                autoSkip: true,
                maxTicksLimit: 5,
                fontSize: 10,
                color: "#6B778C"
              }
            }],
            xAxes: [{
              stacked: true,
              barPercentage: 0.35,
              gridLines: {
                display: false,
                drawBorder: false,
              },
              ticks: {
                beginAtZero: false,
                autoSkip: true,
                maxTicksLimit: 12,
                fontSize: 10,
                color: "#6B778C"
              }
            }],
          },
          legend: false,
          legendCallback: function(chart) {
            var text = [];
            text.push('<div class="chartjs-legend"><ul>');
            for (var i = 0; i < chart.data.datasets.length; i++) {
              console.log(chart.data.datasets[i]); // see what's inside the obj.
              text.push('<li class="text-muted text-small">');
              text.push('<span style="background-color:' + chart.data.datasets[i].borderColor + '">' + '</span>');
              text.push(chart.data.datasets[i].label);
              text.push('</li>');
            }
            text.push('</ul></div>');
            return text.join("");
          },

          elements: {
            line: {
              tension: 0.4,
            }
          },
          tooltips: {
            backgroundColor: 'rgba(31, 59, 179, 1)',
          }
        }
        var marketingOverview = new Chart(marketingOverviewChart, {
          type: 'bar',
          data: marketingOverviewData,
          options: marketingOverviewOptions
        });
        // document.getElementById('marketing-overview-legend').innerHTML = marketingOverview.generateLegend();
      }
      if ($("#marketingOverview-dark").length) {
        var marketingOverviewChartDark = document.getElementById("marketingOverview-dark").getContext('2d');
        var marketingOverviewDataDark = {
          labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"],
          datasets: [{
            label: 'Last week',
            data: [110, 220, 200, 190, 220, 110, 210, 110, 205, 202, 201, 150],
            backgroundColor: "#52CDFF",
            borderColor: [
              '#52CDFF',
            ],
            borderWidth: 0,
            fill: true, // 3: no fill

          }, {
            label: 'This week',
            data: [215, 290, 210, 250, 290, 230, 290, 210, 280, 220, 190, 300],
            backgroundColor: "#1F3BB3",
            borderColor: [
              '#1F3BB3',
            ],
            borderWidth: 0,
            fill: true, // 3: no fill
          }]
        };

        var marketingOverviewOptionsDark = {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            yAxes: [{
              gridLines: {
                display: true,
                drawBorder: false,
                color: "rgba(255,255,255,.05)",
                zeroLineColor: "rgba(255,255,255,.05)",
              },
              ticks: {
                beginAtZero: true,
                autoSkip: true,
                maxTicksLimit: 5,
                fontSize: 10,
                color: "#6B778C"
              }
            }],
            xAxes: [{
              stacked: true,
              barPercentage: 0.35,
              gridLines: {
                display: false,
                drawBorder: false,
              },
              ticks: {
                beginAtZero: false,
                autoSkip: true,
                maxTicksLimit: 7,
                fontSize: 10,
                color: "#6B778C"
              }
            }],
          },
          legend: false,
          legendCallback: function(chart) {
            var text = [];
            text.push('<div class="chartjs-legend"><ul>');
            for (var i = 0; i < chart.data.datasets.length; i++) {
              console.log(chart.data.datasets[i]); // see what's inside the obj.
              text.push('<li class="text-muted text-small">');
              text.push('<span style="background-color:' + chart.data.datasets[i].borderColor + '">' + '</span>');
              text.push(chart.data.datasets[i].label);
              text.push('</li>');
            }
            text.push('</ul></div>');
            return text.join("");
          },

          elements: {
            line: {
              tension: 0.4,
            }
          },
          tooltips: {
            backgroundColor: 'rgba(31, 59, 179, 1)',
          }
        }
        var marketingOverviewDark = new Chart(marketingOverviewChartDark, {
          type: 'bar',
          data: marketingOverviewDataDark,
          options: marketingOverviewOptionsDark
        });
        document.getElementById('marketing-overview-legend').innerHTML = marketingOverviewDark.generateLegend();
      }
      if ($("#doughnutChart").length) {
        var doughnutChartCanvas = $("#doughnutChart").get(0).getContext("2d");
        var doughnutPieData = {
          datasets: [{
            data: [40, 20, 30, 10],
            backgroundColor: [
              "#1F3BB3",
              "#FDD0C7",
              "#52CDFF",
              "#81DADA"
            ],
            borderColor: [
              "#1F3BB3",
              "#FDD0C7",
              "#52CDFF",
              "#81DADA"
            ],
          }],

          // These labels appear in the legend and in the tooltips when hovering different arcs
          labels: [
            'Total',
            'Net',
            'Gross',
            'AVG',
          ]
        };
        var doughnutPieOptions = {
          cutoutPercentage: 50,
          animationEasing: "easeOutBounce",
          animateRotate: true,
          animateScale: false,
          responsive: true,
          maintainAspectRatio: true,
          showScale: true,
          legend: false,
          legendCallback: function(chart) {
            var text = [];
            text.push('<div class="chartjs-legend"><ul class="justify-content-center">');
            for (var i = 0; i < chart.data.datasets[0].data.length; i++) {
              text.push('<li><span style="background-color:' + chart.data.datasets[0].backgroundColor[i] + '">');
              text.push('</span>');
              if (chart.data.labels[i]) {
                text.push(chart.data.labels[i]);
              }
              text.push('</li>');
            }
            text.push('</div></ul>');
            return text.join("");
          },

          layout: {
            padding: {
              left: 0,
              right: 0,
              top: 0,
              bottom: 0
            }
          },
          tooltips: {
            callbacks: {
              title: function(tooltipItem, data) {
                return data['labels'][tooltipItem[0]['index']];
              },
              label: function(tooltipItem, data) {
                return data['datasets'][0]['data'][tooltipItem['index']];
              }
            },

            backgroundColor: '#fff',
            titleFontSize: 14,
            titleFontColor: '#0B0F32',
            bodyFontColor: '#737F8B',
            bodyFontSize: 11,
            displayColors: false
          }
        };
        var doughnutChart = new Chart(doughnutChartCanvas, {
          type: 'doughnut',
          data: doughnutPieData,
          options: doughnutPieOptions
        });
        document.getElementById('doughnut-chart-legend').innerHTML = doughnutChart.generateLegend();
      }
      if ($("#leaveReport").length) {
        var leaveReportChart = document.getElementById("leaveReport").getContext('2d');
        var leaveReportData = {
          labels: ["Jan", "Feb", "Mar", "Apr", "May"],
          datasets: [{
            label: 'Last week',
            data: [18, 25, 39, 11, 24],
            backgroundColor: "#52CDFF",
            borderColor: [
              '#52CDFF',
            ],
            borderWidth: 0,
            fill: true, // 3: no fill

          }]
        };

        var leaveReportOptions = {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            yAxes: [{
              gridLines: {
                display: true,
                drawBorder: false,
                color: "rgba(255,255,255,.05)",
                zeroLineColor: "rgba(255,255,255,.05)",
              },
              ticks: {
                beginAtZero: true,
                autoSkip: true,
                maxTicksLimit: 5,
                fontSize: 10,
                color: "#6B778C"
              }
            }],
            xAxes: [{
              barPercentage: 0.5,
              gridLines: {
                display: false,
                drawBorder: false,
              },
              ticks: {
                beginAtZero: false,
                autoSkip: true,
                maxTicksLimit: 7,
                fontSize: 10,
                color: "#6B778C"
              }
            }],
          },
          legend: false,

          elements: {
            line: {
              tension: 0.4,
            }
          },
          tooltips: {
            backgroundColor: 'rgba(31, 59, 179, 1)',
          }
        }
        var leaveReport = new Chart(leaveReportChart, {
          type: 'bar',
          data: leaveReportData,
          options: leaveReportOptions
        });
      }
      if ($("#leaveReport-dark").length) {
        var leaveReportChartDark = document.getElementById("leaveReport-dark").getContext('2d');
        var leaveReportDataDark = {
          labels: ["JAN", "FEB", "MAR", "APR", "MAY"],
          datasets: [{
            label: 'Last week',
            data: [18, 25, 39, 11, 24],
            backgroundColor: "#52CDFF",
            borderColor: [
              '#52CDFF',
            ],
            borderWidth: 0,
            fill: true, // 3: no fill

          }]
        };

        var leaveReportOptionsDark = {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            yAxes: [{
              gridLines: {
                display: true,
                drawBorder: false,
                color: "#383e5d",
                zeroLineColor: '#383e5d',
              },
              ticks: {
                beginAtZero: true,
                autoSkip: true,
                maxTicksLimit: 5,
                fontSize: 10,
                color: "#6B778C"
              }
            }],
            xAxes: [{
              barPercentage: 0.5,
              gridLines: {
                display: false,
                drawBorder: false,
              },
              ticks: {
                beginAtZero: false,
                autoSkip: true,
                maxTicksLimit: 7,
                fontSize: 10,
                color: "#6B778C"
              }
            }],
          },
          legend: false,

          elements: {
            line: {
              tension: 0.4,
            }
          },
          tooltips: {
            backgroundColor: 'rgba(31, 59, 179, 1)',
          }
        }
        var leaveReportDark = new Chart(leaveReportChartDark, {
          type: 'bar',
          data: leaveReportDataDark,
          options: leaveReportOptionsDark
        });
      }

    });
  })(jQuery);
</script>

<script>
  function resetFilter() {
    window.location.reload();
  }
</script>

</html>