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
              <form action="{{url('admin/add_product_variety')}}" method="POST">
                @csrf
                <h4 class="card-title">Add Product Variety</h4>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Product Name</label>
                      <input type="text" class="form-control" name="product_name" value="" placeholder="">
                      <span class="text-danger">
                        @error('product_name')
                            {{$message}}
                        @enderror
                      </span>
                    </div>
                  </div>
                </div>

                <button type="submit" class="btn btn-primary me-2">Submit</button>
                <a href="{{url('admin/product_varieties')}}" class="btn btn-light">Cancel</a>
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