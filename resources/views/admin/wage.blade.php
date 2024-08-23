@section('title', 'Marmalade Grove | Admin - Wage')

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
              <form action="{{url('admin/wages')}}" method="POST">
                @csrf
                <h4 class="card-title">Add Wages</h4>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Hourly Wage ($)</label>
                      <input type="text" class="form-control" name="wage" value="{{ $wage->wage}}" placeholder="Hourly Wage">
                    </div>
                  </div>
                </div>

                <button type="submit" class="btn btn-primary me-2">Submit</button>
                <a href="{{url('admin/dashboard')}}" class="btn btn-light">Cancel</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
    
    @include('layouts.footer')

    </body>

    </html>