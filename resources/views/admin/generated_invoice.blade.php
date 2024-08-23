<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <!-- endinject -->
    <link rel="shortcut icon" href="{{url('images/favicon.png')}}" />
    <style>
        .full {
            clear: both;
        }

        body {
            max-width: 100%;
            /* padding: 0px 50px; */
            font-family: system-ui;
            height: auto;
        }

        .left {
            float: left;
            width: 46%;
            margin-bottom: 0px;
        }

        .left-new {
            float: left;
            width: 60%;
            margin-bottom: 30px;
        }

        .right {
            float: right;
            width: 49%;
        }

        .con {
            float: right;
        }

        h1 {
            font-size: 20px;
            color: #006d00;
        }

        h2 {
            font-size: 30px;
            color: #006d00;
            text-align: right;
        }

        p {
            font-size: 14px;
            font-weight: 500;
            color: #838383;
        }

        .head-bg {
            background: #006d00;
            padding: 5px;
            color: #fff;
            font-weight: 500;
            margin-top: 10px;
        }

        .foot-bg {
            background: #8fbc8f;
            padding: 10px;
            color: #006d00;
            font-weight: 700;
            text-align: center;
            font-style: italic;
        }

        .right-footer {
            background: #82cd82;
            padding: 10px;
            color: #006d00;
            font-weight: 700;
            text-align: center;
            font-style: italic;
        }

        .right-new {
            float: right;
            width: 40%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th {
            background: #006d00;
            padding: 5px;
            color: #fff;
            font-weight: 500;
        }

        td {
            font-size: 12px;
            padding: 5px;
            color: #000;
            font-weight: 400;
            border: 1px solid #000;
        }

        .tab td {
            text-align: center;
        }

        table,
        td,
        th {
            border: 1px solid #838383;
        }

        .table {
            margin-top: 30px;
        }

        .table {
            margin-top: 10px;
        }

        .border-none td,
        th {
            border: none;
        }

        .border-none td {
            font-weight: 600;
        }

        .copy-wright {
            clear: both;
            margin-top: 30px;
            text-align: center;
            margin-bottom: 40px;
        }

        .copy-wright p {
            font-size: 14px;
            color: #000;
            font-weight: 500;
            margin-bottom: 10px;
        }

        .copy-wright h5 {
            margin: 0px;
        }

        .button {
            background: #298FCE;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-weight: 600;
            color: rgb(255, 255, 255);
            outline: none !important;
            margin-left: 40px;
        }
    </style>
</head>

<body>
    {{-- {{ $hours['total_hours'] }} --}}
    {{-- {{$hours['total_hours'] }} --}}
    @if(Request::url() == url('admin/pdf'))

    <div class="row mt-4 mb-4" style="display: flex; justify-content: end">
        <div class="col offset-lg-10">
            <a href="{{ url('admin/generate_pdf') }}"><button class="btn btn-primary button">Download PDF</button></a>
        </div>
    </div>

    @endif

    @php

    $quality_choices = [];
    $product_type = [];
    foreach($fruits as $fruit)
    {
    $quality_choices[] = json_decode($fruit['quality_choice'], true);
    $product_type[] =  $fruit['product_type'];
    }

    @endphp
    <div class="container">
        <div class="main">
            <div class="left">
                <div class="content">
                    <h1>The Shore Packing Company</h1>
                    <p>P.O. Box 472</p>
                    <p>Santa Paula, CA 93061-0472</p>
                    <p>Phone: (805) 279-1436</p>

                    <div class="head-bg">BILL TO</div>
                    <p>Marmalade Grove</p>
                    <p>7215 Santa Monica Blvd.</p>
                    <p>West Hollywood, CA 90046</p>
                </div>
            </div>

            <div class="right">
                <h2>INVOICE</h2>
                <br>
                <table class="tab">
                    <tr>
                        <th>INVOICE #</th>
                        <th>START DATE</th>
                        <th>END DATE</th>
                    </tr>

                    <tr>
                        <td>MG{{ date('Y-') }}{{ $randomNumber }}</td>
                        <td>{{ date('m/d/Y',strtotime($hours['start_date'])) }}</td>
                        <td>{{ date('m/d/Y',strtotime($hours['end_date'])) }}</td>
                    </tr>

                </table>

                <table class="table tab">
                    <tr>
                        <th>CUSTOMER PO#</th>
                        <th>TERMS</th>
                    </tr>

                    <tr>
                        <td>Peter</td>
                        <td>Due Upon Receipt</td>
                    </tr>

                </table>

            </div>
        <div class="full">
            <table class="table">
                <tr>
                    <th>RECEIVED FRUITS</th>
                    <th>UNITS</th>
                    <th>TYPE</th>
                    <th>WEIGHT</th>
                </tr>

                @foreach ($picker as $index => $item)
                    <tr>
                      <td>{{ $item['product_type'] }}</td>
                      <td>{{ $item['units'] }}</td>
                      <td>{{ $item['types'] }}</td>
                      <td>{{ $item['weight'] }}</td>
                    </tr>
                @endforeach
               
            </table>
        </div>
            
        </div>
        <div class="full">
            <table class="table">
                <tr>
                    <th>SORTED FRUITS BY QUALITY</th>
                    <th>QTY</th>
                    <th>UNIT PRICE</th>
                    <th>AMOUNT</th>
                </tr>

              
                
                <tr>
                   
                @if(count($fruits) != 0)
                    @php
                    $sum = 0; // Initialize the sum
                    $totalsum = 0;
                    $sum2 = 0;
                    $totalsum2 = 0;
                    $sum3 = 0;
                    $totalsum3 = 0;
                    $sum4 = 0;
                    $totalsum4 = 0;
                    $nounits = '';
                    $product_types = '';
                    @endphp

                @for($i = 0; $i < count($fruits); $i++) 
                    <tr>
                        @php
                        $arr1 = $quality_choices[$i]['shipping_grade']['unit'];
                        $sum = $arr1; // Accumulate values for summation
                        $totalsum += $arr1; 
                        $arr2 = $quality_choices[$i]['marmalade_grade']['unit'];
                        $sum2 = $arr2;
                        $totalsum2 += $arr2; 
                        $arr3 = $quality_choices[$i]['fancy_grade']['unit'];
                        $sum3 = $arr3;
                        $totalsum3 += $arr3;
                        $arr4 = $quality_choices[$i]['culls']['unit'];
                        $sum4 = $arr4;
                        $totalsum4 += $arr4;
                        $product_types = $product_type[$i];
                        @endphp
                    </tr>
                <tr>
                    <td>{{$product_types}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><span style="margin-left: 50px;">Shipping Grade</td>
                    <td>{{ $sum }}</td>
                    <td>$16.50</td>
                    <td>${{ $sum * 16.50 }}</td>
                </tr>
                <tr>
                    <td><span style="margin-left: 50px;">Fancy Grade</td>
                    <td>{{ $sum3 }}</td>
                    <td>$16.50</td>
                    <td>${{ $sum3 * 16.50 }}</td>
                </tr>

                <tr>
                    <td><span style="margin-left: 50px;">Marmalade Grade</td>
                    <td>{{ $sum2 }}</td>
                    <td>$8.25</td>
                    <td>${{ $sum2 * 8.25 }}</td>
                </tr>

                <tr>
                    <td><span style="margin-left: 50px;">Culls Grade</td>
                    <td>{{ $sum4 }}</td>
                    <td>$3.85</td>
                    <td>${{ $sum4 * 3.85 }}</td>
                </tr>
                @endfor
                
            </table>
            @endif
            <div class="full">
                <table class="table" style="page-break-before: always;">
                    <tr>
                       <th>PACKING HOURS</th>
                       <th>QTY</th>
                       <th>UNIT PRICE</th>
                       <th>AMOUNT</th>
                    </tr>
                    <tr>
                        <td>Total Hours</td>
                        <td>{{ $hours['total_hours'] }}</td>
                        <td>$20.00</td>
                        <td>${{ $hours['total_hours'] * 20.00 }}</td>
                    </tr>
                    <tr>
                        <td><span style="margin-left: 50px;">Packing</span></td>
                        <td>{{ $hours['packing_hours'] }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><span style="margin-left: 50px;">Staging</span></td>
                        <td>{{ $hours['staging_hours']  }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><span style="margin-left: 50px;">Break Down</span></td>
                        <td>{{ $hours['breakdown_hours'] }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><span style="margin-left: 50px;">Label Printing</span></td>
                        <td>{{ $hours['labelling_hours'] }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><span style="margin-left: 50px;">Maintenance</span></td>
                        <td>{{ $hours['maintenance_hours'] }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><span style="margin-left: 50px;">Cleaning</span></td>
                        <td>{{ $hours['cleaning_hours'] }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                    </tr>
                    {{-- <tr>
                        <td>
                            @php
                            // Initialize an associative array to store quantities
                            $quantityByProductType = [];
    
                            // Loop through $works array to calculate quantities
                            foreach ($works as $work) {
                            $productType = $work['product_types'];
                            $quantity = $work['quantities'];
    
                            // If the product type is already in the array, add the quantity
                            if (array_key_exists($productType, $quantityByProductType)) {
                            $quantityByProductType[$productType] += $quantity;
                            } else {
                            // If not, initialize it with the quantity
                            $quantityByProductType[$productType] = $quantity;
                            }
                            }
    
                            // Initialize an empty formatted string
                            $formattedString = '';
    
                            // Build the formatted string with commas
                            foreach ($quantityByProductType as $productType => $totalQuantity) {
                            if($productType != '')
                            {
                            $formattedString .= "$totalQuantity $productType , ";
                            }
                            }
    
                            // Remove the trailing comma and space
                            $formattedString = rtrim($formattedString, ', ');
    
                            // Print the formatted string
                            echo $formattedString;
                            @endphp
                        </td>
                    </tr> --}}
                </table>
            </div>
            <div class="left-new">
                <div class="foot-bg">Thank You For Your Business!</div>
            </div>
            @if(count($fruits) != 0)
            @php
            $sum = 0; // Initialize the sum
            $totalsum = 0;
            $sum2 = 0;
            $totalsum2 = 0;
            $sum3 = 0;
            $totalsum3 = 0;
            $sum4 = 0;
            $totalsum4 = 0;
            $nounits = '';
            $product_types = '';
            @endphp
            <div class="right-new">
                <div class="right-footer">
                    <table class="border-none">
                        <tr>
                            <td>SUBTOTAL -</td>
                            <td>${{ ($totalsum * 16.50) + ($totalsum2 * 8.25) + ($totalsum3 * 16.50) + ($totalsum4 * 3.85) + ($hours['total_hours'] * 20.00) }}</td>
                        </tr>

                        <tr>
                            <td>TAX RATE-</td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>TAX -</td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>TOTAL</td>
                            <td>$ {{ ($totalsum * 16.50) + ($totalsum2 * 8.25) + ($totalsum3 * 16.50) + ($totalsum4 * 3.85) + ($hours['total_hours'] * 20.00) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        @endif
        <div class="copy-wright">
            <p>If you have any questions about this invoice, please contact</p>
            <h5>Fernando Gomez, (805) 279-1436, theshorepackingcompany@gmail.com</h5>
        </div>
    </div>
</body>

</html>