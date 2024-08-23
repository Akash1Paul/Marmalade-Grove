@section('title', 'Marmalade Grove | Manager - Dashboard')

@include('layouts.header')

@include('navbar')

<div class="container-fluid page-body-wrapper">
  <!-- partial:partials/_settings-panel.html -->
  <!-- partial -->
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
                <div class="row justify-content-between">

                  <div class="col-xl col-sm-6 m-t35 mb-xl-0 mb-3">
                    <div class="card card-coin gradient-one">
                      <div class="card-body">
                        <h3 class="card-title text-white">Total Fruits</h3>
                        <div class="d-inline-block">
                          <h6 class="text-white">{{ $dashboard['total_fruits'] }} crates</h6>
                          {{-- <p class="text-white mb-0">Jan - March 2019</p> --}}
                        </div>
                        <!-- <span class="float-right display-5 opacity-5"><i class="fa fa-heart"></i></span> -->
                      </div>
                    </div>
                  </div>

                  <div class="col-xl col-sm-6 m-t35 mb-xl-0 mb-3">
                    <div class="card card-coin gradient-two">
                      <div class="card-body">
                        <h3 class="card-title text-white">Total Weight</h3>
                        <div class="d-inline-block">
                          <h6 class="text-white">{{ $dashboard['total_weight'] }} pounds</h6>
                          {{-- <p class="text-white mb-0">Jan - March 2019</p> --}}
                        </div>
                        <!-- <span class="float-right display-5 opacity-5"><i class="fa fa-heart"></i></span> -->
                      </div>
                    </div>
                  </div>

                  <div class="col-xl col-sm-6 m-t35 mb-xl-0 mb-3">
                    <div class="card card-coin gradient-three">
                      <div class="card-body">
                        <h3 class="card-title text-white">Total Hours</h3>
                        <div class="d-inline-block">
                          <h6 class="text-white">{{ $dashboard['hours'] }}</h6>
                          {{-- <p class="text-white mb-0">Jan - March 2019</p> --}}
                        </div>
                        <!-- <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span> -->
                      </div>
                    </div>
                  </div>

                  <div class="col-xl col-sm-6 m-t35 mb-xl-0 mb-3">
                    <div class="card card-coin gradient-four">
                      <div class="card-body">
                        <h3 class="card-title text-white">Remaining Fruits</h3>
                        <div class="d-inline-block">
                          <h6 class="text-white">{{ $dashboard['remaining_fruits'] }} crates</h6>
                          {{-- <p class="text-white mb-0">Jan - March 2019</p> --}}
                        </div>
                        <!-- <span class="float-right display-5 opacity-5"><i class="fa fa-bell" aria-hidden="true"></i></span> -->
                      </div>
                    </div>
                  </div>

                  <div class="col-xl col-sm-6 m-t35 mb-xl-0 mb-3">
                    <div class="card card-coin gradient-two">
                      <div class="card-body">
                        <h3 class="card-title text-white">Fruit Packers</h3>
                        <div class="d-inline-block">
                          <h6 class="text-white">6</h6>
                          {{-- <p class="text-white mb-0">Jan - March 2019</p> --}}
                        </div>
                        <!-- <span class="float-right display-5 opacity-5"><i class="fa fa-bell" aria-hidden="true"></i></span> -->
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
                  <h4 class="card-title">Received Fruits</h4>
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
                        <th>
                          Action
                        </th>
                      </tr>
                    </thead>
                    <tbody>

                      @if(count($dashboard['pickers']) != 0)

                      @foreach ($dashboard['pickers'] as $item)
                      <tr>
                        <td>{{date('m/d/Y', strtotime($item['date'])) }}</td>
                        <td>{{ $item['product_type'] }}</td>
                        <td>{{ $item['units'] }}</td>
                        <td>{{ $item['types'] }}</td>

                        @if($item['weight'] != '')
                        <td>{{ $item['weight'] }} pounds</td>
                        @else
                        <td></td>
                        @endif

                        <td>{{ $item['units'] - $item['fruit_yet_to_sorted'] }}</td>

                        <td>
                          <form method="post" action="{{ url('manager/sort_fruit') }}">
                            @csrf


                            <input type="hidden" name="id" value="{{ $item['id'] }}">
                            <input type="hidden" name="type" value="{{ $item['product_type'] }}">
                            <input type="hidden" name="product_type" value="{{ $item['types'] }}">
                            <input type="hidden" name="total_fruits" value="{{ $item['units'] }}">
                            <input type="hidden" name="weight" value="{{ $item['weight'] }}">

                            @if($item['sorted'] == 1)

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

                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      @include('layouts.footer')

      </body>

      </html>