<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
    <div class="me-3">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
        <span class="icon-menu"></span>
      </button>
    </div>
    <div>

      @if(auth()->user()->roles == 1)

      <a class="navbar-brand brand-logo" href="{{ url('admin/dashboard') }}">
        <img src="{{ asset('images/Wordmark.svg') }}" alt="logo" />
      </a>
      <a class="navbar-brand brand-logo-mini" href="{{ url('admin/dashboard') }}">
        <img src="{{ asset('images/Wordmark.svg') }}" alt="logo" />
      </a>

      @elseif(auth()->user()->roles == 2)

      <a class="navbar-brand brand-logo" href="{{ url('picker/dashboard') }}">
        <img src="{{ asset('images/Wordmark.svg') }}" alt="logo" />
      </a>
      <a class="navbar-brand brand-logo-mini" href="{{ url('picker/dashboard') }}">
        <img src="{{ asset('images/Wordmark.svg') }}" alt="logo" />
      </a>

      @elseif(auth()->user()->roles == 3)

      <a class="navbar-brand brand-logo" href="{{ url('packer/dashboard') }}">
        <img src="{{ asset('images/Wordmark.svg') }}" alt="logo" />
      </a>
      <a class="navbar-brand brand-logo-mini" href="{{ url('packer/dashboard') }}">
        <img src="{{ asset('images/Wordmark.svg') }}" alt="logo" />
      </a>

      @else

      <a class="navbar-brand brand-logo" href="{{ url('manager/dashboard') }}">
        <img src="{{ asset('images/Wordmark.svg') }}" alt="logo" />
      </a>
      <a class="navbar-brand brand-logo-mini" href="{{ url('manager/dashboard') }}">
        <img src="{{ asset('images/Wordmark.svg') }}" alt="logo" />
      </a>

      @endif

    </div>
  </div>

  <div class="navbar-menu-wrapper d-flex align-items-top">
    <ul class="navbar-nav">
      <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">

        @if(auth()->user()->roles == 1)

        <h1 class="welcome-text"><span class="text-black fw-bold">Admin Dashboard</span></h1>

        @elseif(auth()->user()->roles == 2)

        <h1 class="welcome-text"><span class="text-black fw-bold">Picker Dashboard</span></h1>

        @elseif(auth()->user()->roles == 3)

        <h1 class="welcome-text"><span class="text-black fw-bold">Packer Dashboard</span></h1>

        @else

        <h1 class="welcome-text"><span class="text-black fw-bold">Manager Dashboard</span></h1>

        @endif

      </li>
    </ul>
    <ul class="navbar-nav ms-auto">

      <li class="nav-item dropdown d-lg-block user-dropdown">

        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">

          @if(auth()->user()->image == '')
          <img class="img-xs rounded-circle" src="{{ url('userUploads/avatar.png') }}" alt="Profile image"> </a>
        @else
        <img class="img-xs rounded-circle" src="{{ url('userUploads/'.auth()->user()->image) }}" alt="Profile image">

        @endif

        </a>

        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">

          <div class="dropdown-header text-center">

            @if(auth()->user()->image == '')
            <img class="img-md rounded-circle" src="{{ url('userUploads/avatar.png') }}" alt="Profile image" height="70" width="70">
            <p class="mb-1 mt-3 font-weight-semibold">{{ auth()->user()->fname }}</p>
            <p class="fw-light text-muted mb-0">{{ auth()->user()->email }}</p>

            @else
            <img class="img-md rounded-circle" src="{{ url('userUploads/'.auth()->user()->image) }}" alt="Profile image" height="70" width="70">
            <p class="mb-1 mt-3 font-weight-semibold">{{ auth()->user()->fname }}</p>
            <p class="fw-light text-muted mb-0">{{ auth()->user()->email }}</p>

            @endif

          </div>

          @if(auth()->user()->roles == 1)

          <a class="dropdown-item" href="{{url('admin/profile/'.auth()->user()->id)}}"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile </a>

        @elseif(auth()->user()->roles == 2)

        <a class="dropdown-item" href="{{url('picker/profile/'.auth()->user()->id)}}"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile </a>

        @elseif(auth()->user()->roles == 3)

        <a class="dropdown-item" href="{{url('packer/profile/'.auth()->user()->id)}}"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile </a>

        @else

        <a class="dropdown-item" href="{{url('manager/profile/'.auth()->user()->id)}}"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile </a>

        @endif

          <a class="dropdown-item" href="{{ url('logout') }}"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>

        </div>
      </li>

    </ul>

    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>

  </div>
</nav>