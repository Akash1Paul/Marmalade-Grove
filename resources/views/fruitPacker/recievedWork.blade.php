@section('title', 'Marmalade Grove | Packer - Dashboard')

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
                        Quality Choices
                      </th>
                      <th>
                        Units
                      </th>
                      <th>
                        Types
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($fruits as $index => $item)
                    <tr>
                      <td>{{date('m/d/Y', strtotime($item->date)) }}</td>
                      <td>{{ $item->product_type }}</td>
                      <td>{{ $item->quality_choice }}</td>
                      <td>{{ $item->unit }}</td>
                      <td>{{ $item->type }}</td>
                    </tr>
                    @endforeach
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