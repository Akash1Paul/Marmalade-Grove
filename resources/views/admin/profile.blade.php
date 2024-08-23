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
              <form action="{{ url('admin/update_account/'.$users->id) }}" enctype="multipart/form-data" method="POST">
                @csrf
                <h4 class="card-title">Personal Info</h4>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Role</label>
                      <select name="roles" class="form-control" value="{{ old('roles') }}">
                        <option value="4" {{ $users['roles'] == '4' ? 'selected' : '' }}>Manager</option>
                        <option value="3" {{ $users['roles'] == '3' ? 'selected' : '' }}>Fruit Packer</option>
                        <option value="2" {{ $users['roles'] == '2' ? 'selected' : '' }}>Fruit Picker</option>
                        <option value="1" {{ $users['roles'] == '1' ? 'selected' : '' }}>Admin</option>
                      </select>
                      <span class="text-danger">
                        @error('roles'){{$message}}@enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>First Name</label>
                      <input type="text" name="fname" class="form-control" placeholder="First Name" value="{{ $users['fname']}}">
                      <span class="text-danger">
                        @error('fname'){{$message}}@enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Last Name</label>
                      <input type="text" name="lname" class="form-control" placeholder="Last Name" value="{{ $users['lname']}}">
                      <span class="text-danger">
                        @error('lname'){{$message}}@enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $users['email']}}">
                      <span class="text-danger">
                        @error('email'){{$message}}@enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-6" hidden>
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" name="password" class="form-control" placeholder="Password" value="12345678">
                      <span class="text-danger">
                        @error('password'){{$message}}@enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Phone Number</label>
                      <input type="number" name="phone" class="form-control" placeholder="Phone Number" value="{{ $users['phone']}}"">
                                <span class=" text-danger">
                      @error('phone'){{$message}}@enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Address</label>
                      <input type="text" name="address" class="form-control" placeholder="Address" value="{{ $users['address']}}">
                      <span class="text-danger">
                        @error('address'){{$message}}@enderror
                      </span>
                    </div>
                  </div>
                  @if($users->image != '')

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Profile Image</label>
                      {{-- <input type="file" name="image" class="form-control" placeholder="image"  onchange="loadpasport(event)"> --}}
                      <img src="{{url('userUploads/' . $users->image)}}" class="mt-3" id="image" height="120px" width="120px" />
                      <input type="hidden" name="image" value="{{ $users['image'] }}" />
                      <span class="text-danger">
                        @error('image'){{$message}}@enderror
                      </span>
                    </div>
                  </div>

                  @else

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Profile Image</label>
                      {{-- <input type="file" name="image" class="form-control" placeholder="image"  onchange="loadpasport(event)"> --}}
                      <img src="{{url('userUploads/avatar.png')}}" class="mt-3" id="image" height="120px" width="120px" />
                      <input type="hidden" name="image" value="{{ $users['image'] }}" />
                      <span class="text-danger">
                        @error('image'){{$message}}@enderror
                      </span>
                    </div>
                  </div>

                  @endif
                  <script>
                    var loadpasport = function(event) {
                      var passport = document.getElementById('image');
                      passport.src = URL.createObjectURL(event.target.files[0]);
                      passport.onload = function() {
                        URL.revokeObjectURL(passport.src)
                      }
                    };
                  </script>
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