<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProductVariety;
use App\Models\Fruit;
use App\Models\Work;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Support\Facades\Validator;

class PackerController extends Controller
{
    public function index()
    {
        $fruits = Fruit::orderBy('created_at', 'desc')->get();;
        $hours = Work::all()->toArray();
        $works = Work::all();
        $dashboard = [
            'hours' => 0,
            'items' => count(Fruit::get()->toArray()),
            'totalbox' => 0,
        ];
        foreach ($hours as $hour) {
            $filterhopur['totalpackers'] = 0;
            $filterhopur['totalpackers'] += $hour['total_packers'];
            $hour = (explode(':', $hour['hour']));
            $dashboard['hours'] += round((($hour[0]) + ($hour[1] / 60 ) + $hour[2] ) * $filterhopur['totalpackers'],2);
        }
        foreach ($works as $work) {
            $dashboard['totalbox'] += $work->quantities;
        }
        return view('fruitPacker.packerDashboard')->with(compact('fruits', 'dashboard'));
    }

    public function receivedWork()
    {
        $fruits = Fruit::orderBy('created_at', 'desc')->get();;
        return view('fruitPacker.recievedWork')->with(compact('fruits'));
    }

    public function work()
    {
        $packers = Work::orderBy('created_at', 'desc')->get();
        $arr = [];
        $hour = '';
        $data = [];
        foreach ($packers as $work) {
            $filterhopur = 0;
            $filterhopur += $work->total_packers;
            $hour = (explode(':', $work->hour));
            $data[] = round( ($hour[0]) + ($hour[1] / 60 ) + $hour[2],2) * $filterhopur; 
        }
        return view('fruitPacker.work')->with(compact('packers','data'));
    }

    public function addWork(Request $request)
    {

        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'date' => 'required',
                'product_types' => 'nullable',
                'boxsize' => 'nullable',
                'activity' => 'required',
                'quantities' => 'nullable',
                'total_packers' => 'required',
                'hours' => 'required',
                'minutes' => 'required'
            ]);

            $validator->after(function ($validator) use ($request) {

                if ($request->activity == 'Packing') {

                    if ($request->product_types == null) {
                        $validator->errors()->add('product_types', 'The product type field is required');
                    }

                    if ($request->boxsize == null) {
                        $validator->errors()->add('boxsize', 'The boxsize field is required');
                    }

                    if ($request->quantities == null) {
                        $validator->errors()->add('quantities', 'The quantities field is required');
                    }
                }
            });

            if ($validator->fails()) {
                $products = ProductVariety::all()->toArray();
                return view('fruitPacker.addWork', compact('products'))->withErrors($validator);
            }

            $date = date_create($request->input('date'));

            $packers = new Work();
            $packers->date = date_format($date, 'Y-m-d');
            $packers->product_types = $request->input('product_types');
            $packers->boxsize = $request->input('boxsize');
            $packers->activity = $request->input('activity');
            $packers->hour =  $request->input('hours') . ':' .$request->input('minutes');
            $packers->quantities = $request->input('quantities');
            $packers->labourname = $request->input('labourname');
            $packers->total_packers = $request->input('total_packers');
            $packers->notes = $request->input('notes');
            $packers->save();

            // Assuming you want to redirect to another page after saving the room
            return redirect('packer/workdiary')->with('status', 'Work Added Successfully');
        } else {
            $products = ProductVariety::all()->toArray();
            return view('fruitPacker.addWork')->with(compact('products'));
        }
    }

    public function editWork(Request $request, $id)
    {
        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'date' => 'required',
                'product_types' => 'nullable',
                'boxsize' => 'nullable',
                'activity' => 'required',
                'hours' => 'required',
                'quantities' => 'nullable',
                'total_packers' => 'required'
            ]);

            $validator->after(function ($validator) use ($request) {

                if ($request->activity == 'Packing') {

                    if ($request->product_types == null) {
                        $validator->errors()->add('product_types', 'The product type field is required');
                    }

                    if ($request->boxsize == null) {
                        $validator->errors()->add('boxsize', 'The boxsize field is required');
                    }

                    if ($request->quantities == null) {
                        $validator->errors()->add('quantities', 'The quantities field is required');
                    }
                }
            });

            if ($validator->fails()) {
                $works = Work::find($id);
                $products = ProductVariety::all()->toArray();
                return view('fruitPacker.addWork', compact('works', 'products'))->withErrors($validator);
            }

            $date = date_create($request->input('date'));

            $packers = Work::find($id);
            $packers->date = date_format($date, 'Y-m-d');
            $packers->product_types = $request->input('product_types');
            $packers->boxsize = $request->input('boxsize');
            $packers->activity = $request->input('activity');
            $packers->hour =  $request->input('hours') . ':' .$request->input('minutes');
            $packers->quantities = $request->input('quantities');
            $packers->labourname = $request->input('labourname');
            $packers->total_packers = $request->input('total_packers');
            $packers->notes = $request->input('notes');
            $packers->update();
            // Assuming you want to redirect to another page after saving the room
            return redirect('packer/workdiary')->with('status', 'Work Updated Successfully');
        } else {
            $works = Work::find($id);
            $products = ProductVariety::all()->toArray();
            return view('fruitPacker.editWork')->with(compact('works', 'products'));
        }
    }

    public function deleteWork($id)
    {
        $work = Work::where('id', $id)->delete();

        if ($work) {
            return redirect('packer/workdiary');
        }
    }

    public function profile(Request $request, $id)
    {
        $users = User::find($id);
        return view('fruitPacker.profile')->with(compact('users'));
    }

    public function filterWorkDiary($fromdate, $todate)
    {
        $packers = Work::whereBetween('date', [$fromdate, $todate])->orderBy('created_at', 'desc')->get()->toArray();

        $result = [];

        $i = 0;
      
        foreach ($packers as $work) {

            // $to = Carbon::createFromFormat('H:s:i', $work['start_time']);
            // $from = Carbon::createFromFormat('H:s:i', $work['end_time']);

            $hour = (explode(':', $work['hour']));

            $result[$i] = $work;
            $result[$i]['hours'] = round( ($hour[0]) + ($hour[1] / 60 ) + $hour[2],2);

            $i = $i + 1;
        }

        return $result;
    }
}
