@section('title', 'Marmalade Grove | Picker - Add Fruits')

@include('layouts.header')

@include('navbar')

<div class="container-fluid page-body-wrapper">

  @include('sidebar')

  <!-- partial -->
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Add Fruits</h4>
              <form action="{{url('picker/add_fruit')}}" method="POST">
                @csrf

                <div class="form-group col-md-2">
                  <label>Date</label>
                  <input id="tbDate" type="text" class="form-control" placeholder="yy-mm-dd" name="date" value="{{ old('date') }}" />
                  <span class="text-danger">
                    @error('date')
                    {{$message}}
                    @enderror
                  </span>
                </div>


                <div class="form-group">
                  <label>Product types</label>
                  <select class="form-control" name="product_type" value="{{ old('product_type') }}">
                    @foreach($products as $product)
                      <option value="{{ $product['product_name'] }}">{{ $product['product_name'] }}</option>
                    @endforeach
                  </select>
                  <span class="text-danger">
                    @error('product_type')
                    {{$message}}
                    @enderror
                  </span>
                </div>
                <div class="form-group">
                  <label>Types</label>
                  <select class="form-control" id="types" onchange="weightcalculation()" name="types" value="{{ old('types') }}">
                    <option value="Bins">Bins</option>
                    <option value="Crates">Crates</option>
                  </select>
                  <span class="text-danger">
                    @error('types')
                    {{$message}}
                    @enderror
                  </span>
                </div>
                <div class="form-group">
                  <label>Units</label>
                  <input type="text" name="units" id="Units" onkeyup="weightcalculation()" class="form-control" placeholder="Units" value="{{ old('units') }}">
                  <span class="text-danger">
                    @error('units')
                    {{$message}}
                    @enderror
                  </span>
                </div>
                <div class="form-group">
                  <label>Total Weight</label>
                  <input type="text" name="weight" id="weight" class="form-control" placeholder="Total Weight" value="{{ old('weight') }}">
                  <span class="text-danger">
                    @error('weight')
                    {{$message}}
                    @enderror
                  </span>
                </div>
                <button type="submit" class="btn btn-primary me-2">Submit</button>
                <a href="{{url('picker/dashboard')}}" class="btn btn-light">Cancel</a>
              </form>
            </div>
          </div>
        </div>
      </div>

      @include('layouts.footer')

      <script>
        $('#tbDate').val(new Date().toJSON().slice(0, 10));

        $('#tbDate').daterangepicker({
          "singleDatePicker": true,
          "startDate": "{{ date('m/d/Y') }}",
        }, function(start, end, label) {
          console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
        });

        function weightcalculation() {
          let Types = document.getElementById('types').value;
          let Units = Number(document.getElementById('Units').value);
          let weight;
          if (Types == 'Bins') {
            weight = Units * 22 * 40;
          } else {
            weight = Units * 40;
          }
          document.getElementById('weight').value = weight;
        }
      </script>

      </body>

      </html>