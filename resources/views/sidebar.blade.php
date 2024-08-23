<style>
  .sidebar .nav .nav-item .nav-link i.menu-arrow:before {
    font-size: 0.9rem;
  }
</style>
<nav class="sidebar sidebar-offcanvas" id="sidebar">

  <ul class="nav">

    @if(auth()->user()->roles == 1)
    {{-- <li class="nav-item nav-category">Admin</li> --}}
    <li class="nav-item">
      <a class="nav-link" href="{{url('admin/admin_dashboard')}}">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('admin/picker_diary')}}">
        <i class="fa-solid fa-book  menu-icon"></i>
        <span class="menu-title">Picker Diary</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('admin/work_diary')}}">
        <i class="fa-solid fa-briefcase menu-icon"></i>
        <span class="menu-title">Packer Diary</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('admin/fruits_details')}}">
        <i class="fa-regular fa-lemon menu-icon"></i>
        <span class="menu-title">Sorted Fruits by Quality</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('admin/product_varieties')}}">
        <i class="fa-solid fa-list fa-lg menu-icon"></i>
        <span class="menu-title">Product Varieties</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('admin/accounts')}}">
        <i class="fa-regular fa-address-book menu-icon"></i>
        <span class="menu-title">Accounts</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('admin/wages')}}">
        <i class="fa-solid fa-sack-dollar menu-icon"></i>
        <span class="menu-title">Wages</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('admin/invoice')}}">
        <i class="fa-solid fa-file-invoice menu-icon"></i>
        <span class="menu-title">Invoice</span>
      </a>
    </li>
    {{-- <li class="nav-item nav-category">Packer</li> --}}
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#packer" aria-expanded="false" aria-controls="packer">
        <i class="menu-icon fa-solid fa-boxes-packing"></i>
        <span class="menu-title">Packer</span>
        <i class="menu-arrow"></i> 
      </a>
      <div class="collapse" id="packer">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" onMouseOver="this.style.color='#1F3BB3'" onMouseOut="this.style.color='black'" href="{{ url('packer/packer_dashboard') }}"><b>Dashboard</b></a></li>
          <li class="nav-item"> <a class="nav-link"  onMouseOver="this.style.color='#1F3BB3'" onMouseOut="this.style.color='black'" href="{{ url('packer/workdiary') }}"><b>Work Diary</b></a></li>
        </ul>
      </div>
    </li>
    {{-- <li class="nav-item">
      <a class="nav-link" href="{{url('packer/packer_dashboard')}}">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('packer/workdiary')}}">
        <i class="fa-solid fa-briefcase menu-icon"></i>
        <span class="menu-title">Work Diary</span>
      </a>
    </li> --}}
    {{-- <li class="nav-item nav-category"></li> --}}
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#manager" aria-expanded="false" aria-controls="manager">
        <i class="menu-icon fa-solid fa-filter"></i>
        <span class="menu-title">Manager</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="manager">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link"  onMouseOver="this.style.color='#1F3BB3'" onMouseOut="this.style.color='black'" href="{{ url('manager/manager_dashboard') }}"><b>Dashboard</b></a></li>
          <li class="nav-item"> <a class="nav-link"  onMouseOver="this.style.color='#1F3BB3'" onMouseOut="this.style.color='black'" href="{{ url('manager/received_fruits') }}"><b>Received Fruits</b></a></li>
          <li class="nav-item"> <a class="nav-link"  onMouseOver="this.style.color='#1F3BB3'" onMouseOut="this.style.color='black'"  href="{{ url('manager/sorted_fruits') }}"><b>Sorted by Quality</b></a></li>
        </ul>
      </div>
    </li>
    {{-- <li class="nav-item">
      <a class="nav-link" href="{{ url('manager/manager_dashboard') }}">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item nav-category">Fruits</li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('manager/received_fruits') }}">
        <i class="fa-brands fa-get-pocket menu-icon"></i>
        <span class="menu-title">Received Fruits</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('manager/sorted_fruits') }}">
        <i class="fa-regular fa-lemon menu-icon"></i>
        <span class="menu-title">Sorted by Quality</span>
      </a>
    </li> --}}

   

    @elseif(auth()->user()->roles == 2)

    <li class="nav-item">
      <a class="nav-link" href="{{url('picker/dashboard')}}">
        <i class="fa-regular fa-lemon menu-icon"></i>
        <span class="menu-title">Fruits</span>
      </a>
    </li>

    @elseif(auth()->user()->roles == 3)

    {{-- <li class="nav-item">
      <a class="nav-link" href="{{url('packer/dashboard')}}">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('packer/work')}}">
        <i class="fa-solid fa-briefcase menu-icon"></i>
        <span class="menu-title">Work Diary</span>
      </a>
    </li> --}}

    @else

    {{-- <li class="nav-item nav-category">Dashboard</li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('manager/dashboard') }}">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item nav-category">Fruits</li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('manager/received_fruits') }}">
        <i class="fa-brands fa-get-pocket menu-icon"></i>
        <span class="menu-title">Received Fruits</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('manager/sorted_fruits') }}">
        <i class="fa-regular fa-lemon menu-icon"></i>
        <span class="menu-title">Sorted by Quality</span>
      </a>
    </li>

    <li class="nav-item nav-category">Invoice</li>

    <li class="nav-item">
      <a class="nav-link" href="{{url('manager/invoice')}}">
        <i class="fa-solid fa-file-invoice menu-icon"></i>
        <span class="menu-title">Invoice</span>
      </a>
    </li> --}}

    @endif

  </ul>

</nav>

  