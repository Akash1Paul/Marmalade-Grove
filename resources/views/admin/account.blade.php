@section('title', 'Marmalade Grove | Admin - Account')

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
                <h4 class="card-title">Accounts</h4>
                <a href="{{url('admin/add_account')}}"><button type="button" class="btn btn-sm btn-primary">Add</button></a>
              </div>
              <div class="table-responsive pt-3">
                @if ($users->count() > 0)
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>
                        S. No
                      </th>
                      <th>
                        Name
                      </th>
                      <th>
                        Role
                      </th>
                      <th>
                        Email
                      </th>
                      <th>
                        Action
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $index => $item)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>{{ $item->fname." ".$item->lname  }}</td>
                      <td>
                        @if ($item->roles == 1)
                        Admin
                        @elseif($item->roles == 2)
                        Fruit Picker
                        @elseif($item->roles == 3)
                        Fruit Packer
                        @elseif($item->roles == 4)
                        Manager
                        @endif
                      </td>
                      <td>{{ $item->email }}</td>
                      <td>
                        <a href="{{ url('admin/edit_account/'. $item->id) }}" type="button" class="btn btn-sm btn-success btn-icon-text">
                          Edit
                          <i class="ti-file btn-icon-append"></i>
                        </a>
                      </td>
                    </tr>
                    @endforeach
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

    <!-- content-wrapper ends -->

    @include('layouts.footer')

    </body>

    </html>