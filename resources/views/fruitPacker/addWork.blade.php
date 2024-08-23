@section('title', 'Marmalade Grove | Packer - Add Work')

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
              <h4 class="card-title">Add Work</h4>
              <form action="{{url('packer/add_work')}}" method="POST">
                @csrf
                <div class="form-group col-md-2" id="date">
                  <label>Date</label>
                  <input type="text" name="date" id="tbDate" class="form-control" value="{{ old('date') }}" autocomplete="off">
                  <span class="text-danger">
                    @error('date') {{ $message }} @enderror
                  </span>
                </div>
                <div class="form-group" id="activity">
                  <label>Activity</label>
                  <select class="form-control" name="activity" value="{{old('activity')}}">
                    <option value="">Select</option>
                    <option value="Packing">Ready for Shipment</option>
                    <option value="Cleaning">Cleaning</option>
                    <option value="Labelling">Labelling</option>
                    <option value="Staging">Staging & Packing</option>
                    <option value="BreakDown">Break Down</option>
                    <option value="Maintenance">Maintenance</option>
                  </select>
                  <span class="text-danger">
                    @error('activity') {{ $message }} @enderror
                  </span>
                </div>
                <div class="form-group" id="product_types">
                  <label>Product types</label>
                  <select class="form-control" name="product_types" value="{{ old('product_types') }}">
                    <option value="">Select</option>
                    @foreach($products as $product)
                    <option value="{{ $product['product_name'] }}">{{ $product['product_name'] }}</option>
                    @endforeach
                  </select>
                  <span class="text-danger">
                    @error('product_types') {{ $message }} @enderror
                  </span>
                </div>
                <div class="form-group" id="boxsize">
                  <label>Box size</label>
                  <select class="form-control" name="boxsize" value="{{ old('boxsize') }}">
                    <option value="">Select</option>
                    <option value="5">5LB</option>
                    <option value="7">7LB</option>
                    <option value="10">10LB</option>
                    <option value="25">25LB</option>
                  </select>
                  <span class="text-danger">
                    @error('boxsize') {{ $message }} @enderror
                  </span>
                </div>
                
               

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group" id="hour">
                      <label>Hours</label>
                      <input type="number" name="hours" id="hoursInput" class="form-control" value="{{ old('hours') }}">
                        <span id="validationMessage" style="color: red; font-size:15px;"></span>
                     {{-- <select name="hours" id=""  class="form-control">
                      <option value="00">0</option>
                      <option value="01">1</option>
                      <option value="02">2</option>
                      <option value="03">3</option>
                      <option value="04">4</option>
                      <option value="05">5</option></option>
                      <option value="06">6</option>
                      <option value="07">7</option>
                      <option value="08">8</option>
                      <option value="09">9</option></option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                      <option value="13">13</option>
                      <option value="14">14</option>
                      <option value="15">15</option>
                      <option value="16">16</option>
                      <option value="17">17</option>
                      <option value="18">18</option>
                      <option value="19">19</option>
                      <option value="20">20</option>
                      <option value="21">21</option>
                      <option value="22">22</option>
                      <option value="23">23</option>
                     </select> --}}
                      <span class="text-danger">
                        @error('hours') {{ $message }} @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group" id="end_time">
                      <label>Minutes</label>
                      <input type="number" name="minutes" id="minutesInput" class="form-control" value="{{ old('minutes') }}">
                      <span id="minutesValidationMessage" style="color: red; font-size:15px;"></span>

                      {{-- <select name="minutes" id=""  class="form-control">
                        <option value="00">0</option>
                        <option value="15">15</option>
                        <option value="30">30</option>
                        <option value="45">45</option>
                      </select> --}}
                        @error('minutes') {{ $message }} @enderror
                      </span>
                    </div>
                  </div>
                </div>

                <div class="form-group" id="quantities">
                  <label>Quantities</label>
                  <input type="number" name="quantities" class="form-control" placeholder="Quantities" value="{{ old('quantities') }}" min="1">
                  <span class="text-danger">
                    @error('quantities') {{ $message }} @enderror
                  </span>
                </div>

                <div class="form-group">
                  <label for="total_packers">Total number of Packers worked on this task</label>
                  <input type="number" name="total_packers" id="totalPackersInput" min="1" class="form-control" value="{{ old('total_packers') }}">
                  <span id="totalPackersValidationMessage" style="color: red; font-size:15px;"></span>
                  
                  
                  
                  {{-- <select name="total_packers" id="" class="form-control" value="{{ old('total_packers') }}">
                    <option value="" selected disabled>Select</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                  </select> --}}
                </div>

                <div class="form-group">
                  <label>Logged by</label>
                  <input type="text" name="labourname" class="form-control" placeholder="Logged by" value="{{ old('labourname') }}">
                </div>

                <div class="form-group">
                  <label for="notes">Notes</label>
                  <textarea name="notes" id="notes" rows="5" class="form-control h-auto" ></textarea>
                </div>

                <button type="submit" class="btn btn-primary me-2">Submit</button>
                <a href="{{url('packer/workdiary')}}" class="btn btn-light">Cancel</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    @include('layouts.footer')

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script>
      $('#activity').on('change', function() {
        let selectedActivity = $('#activity option:selected').val();

        if (selectedActivity == 'Packing') {
          $('#product_types').css({
            'display': 'block'
          });
          $('#boxsize').css({
            'display': 'block'
          });
          $('#quantities').css({
            'display': 'block'
          });
        }else {
          $('#product_types').css({
            'display': 'none'
          });
          $('#boxsize').css({
            'display': 'none'
          });
          $('#quantities').css({
            'display': 'none'
          });
        }

      });

    //$('#tbDate').val(new Date().toLocaleString('en-US',{timeZone: 'America/Los_Angeles'}));
     //mobiscroll.momentTimezone.moment = moment;
     
      $('#tbDate').daterangepicker({
        "singleDatePicker": true,
        "startDate": "{{ date('m/d/Y') }}",
      }, function(start, end, label) {
        console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
        
      });

      $('.timepicker').timepicker({
        timeFormat: 'H',
        interval: 1,
        startTime: '00:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true,
       
      });
      $('.timepicker2').timepicker({
        timeFormat: 'mm',
        interval: 15,
        startTime: '00:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true,
       
      });
    </script>
<script>
  const hoursInput = document.getElementById('hoursInput');
  const validationMessage = document.getElementById('validationMessage');

  hoursInput.addEventListener('input', function() {
    const hours = parseFloat(this.value);

    if (hours < 1 || hours > 24 || isNaN(hours)) {
      validationMessage.textContent = 'Please enter a valid number between 1 and 24';
      hoursInput.classList.add('invalid');
    } else {
      validationMessage.textContent = '';
      hoursInput.classList.remove('invalid');
    }
  });
</script>
<script>
  const minutesInput = document.getElementById('minutesInput');
  const minutesValidationMessage = document.getElementById('minutesValidationMessage');

  minutesInput.addEventListener('input', function() {
    const minutes = parseFloat(this.value);

    if (minutes < 0 || minutes > 59 || isNaN(minutes)) {
      minutesValidationMessage.textContent = 'Please enter a valid number between 0 and 59';
      minutesInput.classList.add('invalid');
    } else {
      minutesValidationMessage.textContent = '';
      minutesInput.classList.remove('invalid');
    }
  });
</script>
<script>
  const totalPackersInput = document.getElementById('totalPackersInput');
  const totalPackersValidationMessage = document.getElementById('totalPackersValidationMessage');

  totalPackersInput.addEventListener('input', function() {
    const totalPackers = parseInt(this.value);

    if (totalPackers < 0 || isNaN(totalPackers)) {
      totalPackersValidationMessage.textContent = 'Please enter a valid number (minimum value is 1)';
      totalPackersInput.classList.add('invalid');
      this.value = 1; // Reset value to 1 if negative value is entered
    } else {
      totalPackersValidationMessage.textContent = '';
      totalPackersInput.classList.remove('invalid');
    }
  });
</script>

    </body>

    </html>