@php

$date = date_create($works['date']);

$formattedDate = date_format($date, 'm/d/Y');

@endphp

@section('title', 'Marmalade Grove | Packer - Work Edit')

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
              <h4 class="card-title">Edit Work</h4>
              <form action="{{url('packer/update_work/'.$works['id'])}}" method="POST">
                @csrf
                <div class="form-group col-md-2" id="date">
                  <label>Date</label>
                  <input type="text" name="date" id="tbDate" class="form-control" value="{{ $works['date'] }}" autocomplete="off">
                  <span class="text-danger">
                    @error('date'){{$message}}@enderror
                  </span>
                </div>
                <div class="form-group" id="activity">
                  <label>Activity</label>
                  <select class="form-control" name="activity" value="{{old('activity')}}">
                    <option value="" {{ $works['activity'] == '' ? 'selected' : '' }}></option>
                    <option value="Packing" {{ $works['activity'] == 'Packing' ? 'selected' : '' }}>Ready for Shipment</option>
                    <option value="Cleaning" {{ $works['activity'] == 'Cleaning' ? 'selected' : '' }}>Cleaning</option>
                    <option value="Labelling" {{ $works['activity'] == 'Labelling' ? 'selected' : '' }}>Labelling</option>
                    <option value="Staging" {{ $works['activity'] == 'Staging' ? 'selected' : '' }}>Staging & Packing</option>
                    <option value="BreakDown" {{ $works['activity'] == 'BreakDown' ? 'selected' : '' }}>Break Down</option>
                    <option value="Maintenance" {{ $works['activity'] == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                  </select>
                  <span class="text-danger">
                    @error('activity'){{$message}}@enderror
                  </span>
                </div>
                <div class="form-group" id="product_types">
                  <label>Product types</label>
                  <select class="form-control" name="product_types" value="{{ old('product_types') }}">
                    @foreach($products as $product)
                    <option value="" {{ $works['product_types'] == '' ? 'selected' : '' }}>Select</option>
                    <option value="{{ $product['product_name'] }}" {{ $works['product_types'] == $product['product_name'] ? 'selected' : '' }}>{{ $product['product_name'] }}</option>
                    @endforeach
                  </select>
                  <span class="text-danger">
                    @error('product_types'){{$message}}@enderror
                  </span>
                </div>
                <div class="form-group" id="boxsize">
                  <label>Box size</label>
                  <select class="form-control" name="boxsize" value="{{ old('boxsize') }}">
                    <option value="" {{ $works['boxsize'] == '' ? 'selected' : '' }}></option>
                    <option value="5" {{ $works['boxsize'] == '5' ? 'selected' : '' }}>5LB</option>
                    <option value="7" {{ $works['boxsize'] == '7' ? 'selected' : '' }}>7LB</option>
                    <option value="10" {{ $works['boxsize'] == '10' ? 'selected' : '' }}>10LB</option>
                    <option value="25" {{ $works['boxsize'] == '25' ? 'selected' : '' }}>25LB</option>
                  </select>
                  <span class="text-danger">
                    @error('boxsize'){{$message}}@enderror
                  </span>
                </div>
                
                <div class="row">
                  <div class="col-md-6">
                  <div class="form-group" id="hour">
                    <label>Hours</label>
                   <input type="number" name="hours" id="hoursInput" class="form-control" value="{{ date('h',strtotime($works['hour']))}}">
                   <span id="validationMessage" style="color: red; font-size:15px;"></span>
                    {{-- <select name="hours" id=""  class="form-control"  value="{{ date('h',strtotime($works['hour']))}}">
                      <option value="00" {{ date('h',strtotime($works['hour'])) == '00' ? 'selected' : '' }}>0</option>
                      <option value="01" {{ date('h',strtotime($works['hour'])) == '01' ? 'selected' : '' }}>1</option>
                      <option value="02" {{ date('h',strtotime($works['hour'])) == '02' ? 'selected' : '' }}>2</option>
                      <option value="03" {{ date('h',strtotime($works['hour'])) == '03' ? 'selected' : '' }}>3</option>
                      <option value="04" {{ date('h',strtotime($works['hour'])) == '04' ? 'selected' : '' }}>4</option>
                      <option value="05" {{ date('h',strtotime($works['hour'])) == '05' ? 'selected' : '' }}>5</option>
                      <option value="06" {{ date('h',strtotime($works['hour'])) == '06' ? 'selected' : '' }}>6</option>
                      <option value="07" {{ date('h',strtotime($works['hour'])) == '07' ? 'selected' : '' }}>7</option>
                      <option value="08" {{ date('h',strtotime($works['hour'])) == '08' ? 'selected' : '' }}>8</option>
                      <option value="09" {{ date('h',strtotime($works['hour'])) == '09' ? 'selected' : '' }}>9</option>
                      <option value="10" {{ date('h',strtotime($works['hour'])) == '10' ? 'selected' : '' }}>10</option>
                      <option value="11" {{ date('h',strtotime($works['hour'])) == '11' ? 'selected' : '' }}>11</option>
                      <option value="12" {{ date('h',strtotime($works['hour'])) == '12' ? 'selected' : '' }}>12</option>
                      <option value="13" {{ date('h',strtotime($works['hour'])) == '13' ? 'selected' : '' }}>13</option>
                      <option value="14" {{ date('h',strtotime($works['hour'])) == '14' ? 'selected' : '' }}>14</option>
                      <option value="15" {{ date('h',strtotime($works['hour'])) == '15' ? 'selected' : '' }}>15</option>
                      <option value="16" {{ date('h',strtotime($works['hour'])) == '16' ? 'selected' : '' }}>16</option>
                      <option value="17" {{ date('h',strtotime($works['hour'])) == '17' ? 'selected' : '' }}>17</option>
                      <option value="18" {{ date('h',strtotime($works['hour'])) == '18' ? 'selected' : '' }}>18</option>
                      <option value="19" {{ date('h',strtotime($works['hour'])) == '19' ? 'selected' : '' }}>19</option>
                      <option value="20" {{ date('h',strtotime($works['hour'])) == '20' ? 'selected' : '' }}>20</option>
                      <option value="21" {{ date('h',strtotime($works['hour'])) == '21' ? 'selected' : '' }}>21</option>
                      <option value="22" {{ date('h',strtotime($works['hour'])) == '22' ? 'selected' : '' }}>22</option>
                      <option value="23" {{ date('h',strtotime($works['hour'])) == '23' ? 'selected' : '' }}>23</option>
                     </select>
                    <span class="text-danger">
                      @error('hours') {{ $message }} @enderror
                    </span> --}}
                  </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group" id="end_time">
                      <label>Minutes</label>
                      <input type="number" name="minutes" id="minutesInput" class="form-control" value="{{ date('i',strtotime($works['hour'])) }}">
                      <span id="minutesValidationMessage" style="color: red; font-size:15px;"></span>
                      {{-- <select name="minutes" id=""  class="form-control"  value="{{ date('i',strtotime($works['hour'])) }}">
                        <option value="00"  {{ date('i',strtotime($works['hour'])) == '00' ? 'selected' : '' }}>0</option>
                        <option value="15" {{ date('i',strtotime($works['hour'])) == '15' ? 'selected' : '' }}>15</option>
                        <option value="30" {{ date('i',strtotime($works['hour'])) == '30' ? 'selected' : '' }}>30</option>
                        <option value="45" {{ date('i',strtotime($works['hour'])) == '45' ? 'selected' : '' }}>45</option>
                      </select>
                      <span class="text-danger">
                        @error('end_time'){{$message}}@enderror
                      </span> --}}
                    </div>
                  </div>
                </div>

                <div class="form-group" id="quantities">
                  <label>Quantities</label>
                  <input type="text" name="quantities" class="form-control" placeholder="Quantities" value="{{ $works['quantities'] }}">
                  <span class="text-danger">
                    @error('quantities'){{$message}}@enderror
                  </span>
                </div>

                <div class="form-group" id="packers">
                  <label for="total_packers">Total number of Packers worked on this task</label>
                  <input type="number" name="total_packers" id="totalPackersInput" min="1" class="form-control" value="{{ $works['total_packers'] }}">
                  <span id="totalPackersValidationMessage" style="color: red; font-size:15px;"></span>
                  
                  {{-- <select class="form-control" name="total_packers" value="{{old('total_packers')}}">
                    <option value="" disabled {{ $works['total_packers'] == '' ? 'selected' : '' }}>Select</option>
                    <option value="1" {{ $works['total_packers'] == 1 ? 'selected' : '' }}>1</option>
                    <option value="2" {{ $works['total_packers'] == 2 ? 'selected' : '' }}>2</option>
                    <option value="3" {{ $works['total_packers'] == 3 ? 'selected' : '' }}>3</option>
                    <option value="4" {{ $works['total_packers'] == 4 ? 'selected' : '' }}>4</option>
                    <option value="5" {{ $works['total_packers'] == 5 ? 'selected' : '' }}>5</option>
                    <option value="6" {{ $works['total_packers'] == 6 ? 'selected' : '' }}>6</option>
                  </select> --}}
                </div>

                <div class="form-group">
                  <label>Logged by</label>
                  <input type="text" name="labourname" class="form-control" placeholder="Logged by" value="{{  $works['labourname']}}">
                  <span class="text-danger">
                    @error('labourname'){{$message}}@enderror
                  </span>
                </div>

                <div class="form-group">
                  <label for="notes">Notes</label>
                  <textarea name="notes" id="notes" rows="5" class="form-control h-auto">{{ $works['notes'] }}</textarea>
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

    <script>
      $(document).ready(function() {
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
        }  else {
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
        }  else {
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

      $('#tbDate').val(new Date().toJSON().slice(0, 10));

      $('#tbDate').daterangepicker({
        "singleDatePicker": true,
        "startDate": "{{ $formattedDate }}"
      }, function(start, end, label) {
        console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
      });

      $('.timepicker').timepicker({
        timeFormat: 'H:mm',
        interval: 1,
        startTime: '01:00',
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