@section('title', 'Marmalade Grove | Manager - Add Fruits')

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
              <form action="{{ route('addFruit') }}" method="POST">
                @csrf

                @if($errors->any())
                <div class="alert alert-danger">
                  <ul class="list-unstyled">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
                @endif

                <div class="form-group col-md-2">
                  <label>Date</label>
                  <input type="text" id="tbDate" class="form-control" name="date" value="<?php echo date('Y-m-d'); ?>" autocomplete="off">
                </div>

                <div class="form-group">
                  <label>Product types</label>
                  <select class="form-control" name="product_type">
                    <option value="">Select</option>
                    <option value='"SUNRISE" PIXIE TANGERINE MARMALADE'>"SUNRISE" PIXIE TANGERINE MARMALADE</option>
                    <option value="CARA CARA & HIBISCUS MARMALADE">CARA CARA & HIBISCUS MARMALADE</option>
                    <option value="MEYER LEMON & HONEY MARMALADE">MEYER LEMON & HONEY MARMALADE</option>
                    <option value="MARMALADE GIFT SET">MARMALADE GIFT SET</option>
                    <option value="VALENCIA ORANGES">VALENCIA ORANGES</option>
                    <option value="PIXIE TANGERINES">PIXIE TANGERINES</option>
                    <option value="PONY PIXIES">PONY PIXIES</option>
                    <option value="GOLDEN NUGGET TANGERINES">GOLDEN NUGGET TANGERINES</option>
                    <option value="OROBLANCO GRAPEFRUIT">OROBLANCO GRAPEFRUIT</option>
                    <option value="TANGO TANGERINES">TANGO TANGERINES</option>
                    <option value="SATSUMA MANDARINS">SATSUMA MANDARINS</option>
                    <option value="BACON AVOCADO">BACON AVOCADO</option>
                    <option value="NAVEL ORANGES">NAVEL ORANGES</option>
                    <option value="CARA CARA ORANGES">CARA CARA ORANGES</option>
                    <option value="MEYER LEMONS">MEYER LEMONS</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="type">Type</label>
                  <select name="type" id="type" class="form-control">
                    <option value="Bins">Bins</option>
                    <option value="Crates">Crates</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="total_fruits">Total Fruits</label>

                  <input type="text" name="total_fruits" id="total_fruits" class="form-control" value="">

                </div>

                <div>
                  <div class="table-responsive pt-3 mt-2 mb-4">
                    <table class="table table-bordered" id="data">
                      <thead>
                        <tr>
                          <th>
                            Quality Choice
                          </th>
                          <th>
                            Types
                          </th>
                          <th>
                            Units
                          </th>
                          <th>
                            Weight
                          </th>
                        </tr>
                      </thead>
                      <tbody>

                        <tr>
                          <td>Shipping Grade</td>
                          <td>
                            <select name="type1" id="type1" class="form-control">
                              <option value="">Select</option>
                              <option value="Bins">Bins</option>
                              <option value="Crates">Crates</option>
                            </select>
                          </td>
                          <td><input type="number" name="shipping_grade" id="shipping_grade" class="form-control" onchange="fruitCalculation()"></td>
                          <td><input type="text" name="weight1" id="weight1" class="form-control"></td>
                        </tr>

                        <tr>
                          <td>Marmalade Grade</td>
                          <td>
                            <select name="type2" id="type2" class="form-control">
                              <option value="">Select</option>
                              <option value="Bins">Bins</option>
                              <option value="Crates">Crates</option>
                            </select>
                          </td>
                          <td><input type="number" name="marmalade_grade" id="marmalade_grade" class="form-control" onchange="fruitCalculation()"></td>
                          <td><input type="text" name="weight2" id="weight2" class="form-control"></td>
                        </tr>

                        <tr>
                          <td>Fancy Grade</td>
                          <td>
                            <select name="type3" id="type3" class="form-control">
                              <option value="">Select</option>
                              <option value="Bins">Bins</option>
                              <option value="Crates">Crates</option>
                            </select>
                          </td>
                          <td><input type="number" name="fancy_grade" id="fancy_grade" class="form-control" onchange="fruitCalculation()"></td>
                          <td><input type="text" name="weight3" id="weight3" class="form-control"></td>
                        </tr>

                        <tr>
                          <td>Culls</td>
                          <td>
                            <select name="type4" id="type4" class="form-control">
                              <option value="">Select</option>
                              <option value="Bins">Bins</option>
                              <option value="Crates">Crates</option>
                            </select>
                          </td>
                          <td><input type="number" name="culls" id="culls" class="form-control" onchange="fruitCalculation()"></td>
                          <td><input type="text" name="weight4" id="weight4" class="form-control"></td>
                        </tr>

                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="form-group">
                  <label for="remaining_fruits">Remaining Crates</label>
                  <input type="text" name="remaining_fruits" id="remaining_fruits" class="form-control" value="">
                </div>

                <div class="form-group">
                  <label>Weight</label>
                  <input type="text" class="form-control" name="weight" id="weight" placeholder="Weight">
                </div>

                <button type="submit" class="btn btn-primary me-2">Submit</button>

                <a href="{{ url('manager/manager_dashboard') }}" class="btn btn-light">Cancel</a>

              </form>
            </div>
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

      function fruitCalculation() {

        let totalFruits = Number(document.getElementById('total_fruits').value);
        let shippingFruit = Number(document.getElementById('shipping_grade').value);
        let marmaladeFruit = Number(document.getElementById('marmalade_grade').value);
        let fancyFruit = Number(document.getElementById('fancy_grade').value);
        let culls = Number(document.getElementById('culls').value);

        let getType = document.getElementById('type');
        let value = getType.value;
        let type = getType.options[getType.selectedIndex].text;

        let count;
        let weight;

        if (type == 'Bins') {
          count = totalFruits * 22;
        } else {
          count = totalFruits;
        }

        let remainingFruits = shippingFruit + marmaladeFruit + fancyFruit + culls;

        document.getElementById('remaining_fruits').value = count - remainingFruits;

        document.getElementById('weight').value = (shippingFruit + marmaladeFruit + fancyFruit + culls) * 40;

      }
    </script>

    </body>

    </html>