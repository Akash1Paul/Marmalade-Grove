@section('title', 'Marmalade Grove | Login')

@include('layouts.header')

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo text-center">
                <img src="{{url('/images/Wordmark.svg')}}" alt="logo">
              </div>
              <div class="col-md-12">
                @if ($errors->any())
                <div class="alert alert-danger mt-0">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
              <h4>Hello! let's get started</h4>
              <h6 class="fw-light">Sign in to continue.</h6>
              <form class="pt-3" action="{{url('login')}}" method="post">
                @csrf
                <input type="hidden" name="roles" value="1">
                <div class="form-group">
                  <input type="email"  name="email" class="form-control form-control-lg" id="exampleInputEmail1" autocomplete="one-time-code" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password"  name="password" class="form-control form-control-lg" id="exampleInputPassword1" autocomplete="one-time-code" placeholder="Password">
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  @include('layouts.footer')
