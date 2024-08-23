@php

$quality_choices = [];

foreach($fruits as $fruit)
{
$quality_choices[] = json_decode($fruit['quality_choice'], true);
}

@endphp

@section('title', 'Marmalade Grove | Manager - Sorting by Quality')

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

                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                        <h4 class="card-title">Sorting by Quality</h4>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div id="reportrange" class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                                            <span></span> <b class="caret"></b>
                                        </div>
                                    </div>

                                    <div class="col mb-3">
                                        <button type="button" class="btn btn-sm btn-warning" name="reset_button" id="reset_button" onclick="resetFilter()">Reset</button>
                                    </div>

                                    <div class="col mb-md-0 mb-3">
                                        <a href="{{ url('manager/add_fruit') }}"><button type="button" class="btn btn-sm btn-primary">Add</button></a>
                                    </div>
                                </div>

                                <div class="table-responsive pt-3 mt-2">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Date
                                                </th>
                                                <th>
                                                    Product Types
                                                </th>
                                                <th>
                                                    Shipping Grade
                                                </th>
                                                <th>
                                                    Marmalade Grade
                                                </th>
                                                <th>
                                                    Fancy Grade
                                                </th>
                                                <th>
                                                    Culls Grade
                                                </th>
                                                <th>
                                                    Weight
                                                </th>
                                                <th>
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="data">

                                            @if(count($fruits) > 0)

                                            @for($i = 0; $i < count($fruits); $i++) <tr>
                                                <td>{{date('m/d/Y', strtotime($fruits[$i]['date'])) }}</td>
                                                <td>{{ $fruits[$i]['product_type'] }}</td>
                                                <td>
                                                    @if($quality_choices[$i]['shipping_grade']['unit'] == '')
                                                    0
                                                    @else
                                                    {{ $quality_choices[$i]['shipping_grade']['unit'] }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($quality_choices[$i]['marmalade_grade']['unit'] == '')
                                                    0
                                                    @else
                                                    {{ $quality_choices[$i]['marmalade_grade']['unit'] }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($quality_choices[$i]['fancy_grade']['unit'] == '')
                                                    0
                                                    @else
                                                    {{ $quality_choices[$i]['fancy_grade']['unit'] }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($quality_choices[$i]['culls']['unit'] == '')
                                                    0
                                                    @else
                                                    {{ $quality_choices[$i]['culls']['unit'] }}
                                                    @endif
                                                </td>

                                                @if($fruits[$i]['weight'] != '')
                                                <td>{{ $fruits[$i]['weight'] }} pounds</td>
                                                @else
                                                <td></td>
                                                @endif
                                                <td>

                                                    <a href="{{ url('manager/edit_fruit/'.$fruits[$i]['fruit_id']) }}" type="button" class="btn btn-sm btn-success btn-icon-text">
                                                        Edit
                                                        <i class="ti-file btn-icon-append"></i>
                                                    </a>

                                                    <a href="{{ url('manager/delete_sorted_fruit/'. $fruits[$i]['fruit_id']) }}" type="button" class="btn btn-sm btn-danger btn-icon-text" onclick="return confirm('Do you want to delete this sorted fruit?')">
                                                        Delete
                                                    </a>

                                                </td>
                                                </tr>

                                                @endfor

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

                    let url = "{{ url('manager/filter-fruits') }}" + "/" + "from=" + picker.startDate.format('YYYY-MM-DD') + "&to=" + picker.endDate.format('YYYY-MM-DD');

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

                                let getQualityChoices = JSON.parse(fruit.quality_choice);

                                let qualityChoices = Object.values(getQualityChoices);

                                let weight = fruit.weight == null ? '' : fruit.weight + ' pounds';

                                li += `
                                        <tr>
                                            <td>${date} </td>
                                            <td>${fruit.product_type}</td>
                                            <td>${qualityChoices[0].unit != null ? qualityChoices[0].unit : 0}</td>
                                            <td>${qualityChoices[1].unit != null ? qualityChoices[1].unit : 0}</td>
                                            <td>${qualityChoices[2].unit != null ? qualityChoices[2].unit : 0}</td>
                                            <td>${qualityChoices[3].unit != null ? qualityChoices[3].unit : 0}</td>
                                            <td>${weight}</td> 
                                            <td>
                                            <a href="{{ url('manager/edit_fruit/${fruit.fruit_id}') }}" type="button" class="btn btn-sm btn-success btn-icon-text">
                                                Edit
                                                <i class="ti-file btn-icon-append"></i>
                                            </a>
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