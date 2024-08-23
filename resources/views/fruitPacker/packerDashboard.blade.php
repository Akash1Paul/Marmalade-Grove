@php

$quality_choices = [];

foreach($fruits as $fruit)
{
$quality_choices[] = json_decode($fruit['quality_choice'], true);
}

@endphp

@section('title', 'Marmalade Grove | Packer - Dashboard')

@include('layouts.header')

@include('navbar')

<!-- partial -->
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
                <div class="row">
                  <div class="col-xl-6 col-sm-6 m-t35 mb-xl-0 mb-3">
                    <div class="card card-coin gradient-one">
                      <div class="card-body">
                        <h3 class="card-title text-white">Total Packed Fruits</h3>
                        <div class="d-inline-block">
                          <h2 class="text-white">{{ $dashboard['totalbox']}}</h2>

                        </div>
                        <!-- <span class="float-right display-5 opacity-5"><i class="fa fa-heart"></i></span> -->
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-6 col-sm-6 m-t35 mb-xl-0 mb-3">
                    <div class="card card-coin gradient-two">
                      <div class="card-body">
                        <h3 class="card-title text-white">Total Hours</h3>
                        <div class="d-inline-block">
                          <h2 class="text-white">{{ $dashboard['hours']}}</h2>

                        </div>
                        <!-- <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span> -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title">Fruits - Sorted By Quality</h4>
              </div>
              <div class="table-responsive pt-3">
                @if(count($fruits) != 0)
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
                    </tr>
                  </thead>
                  <tbody>

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
                      <td>{{ $fruits[$i]['weight'] }}</td>
                      </tr>

                      @endfor

                      @else

                      <tr>
                        <td colspan="100" class="text-center text-danger"><b>No Data Found</b></td>
                      </tr>

                      @endif
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

</body>

    </html>