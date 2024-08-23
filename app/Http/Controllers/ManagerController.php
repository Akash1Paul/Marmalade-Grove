<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Fruit;
use App\Models\Picker;
use App\Models\Work;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ManagerController extends Controller
{
    public function index()
    {

        $arr = [];

        $hours = Work::all()->toArray();

        $pickers = Picker::orderBy('created_at', 'desc')->get()->toArray();

        $fruits = Fruit::all()->toArray();

        $count = ['value' => 0];

        foreach ($fruits as $fruit) {

            $quality_choices = json_decode($fruit['quality_choice'], true);

            $count['value'] += $quality_choices['shipping_grade']['unit'];
            $count['value'] += $quality_choices['marmalade_grade']['unit'];
            $count['value'] += $quality_choices['fancy_grade']['unit'];
            $count['value'] += $quality_choices['culls']['unit'];
        }

        $dashboard = [
            'total_fruits' => 0,
            'total_weight' => 0,
            'team_members' => count(User::where('roles', 2)->get()->toArray()),
            'hours' => 0,
            'pickers' => $pickers,
            'remaining_fruits' => 0
        ];

        foreach ($pickers as $picker) {
            if ($picker['types'] == 'Crates') {
                $dashboard['total_fruits'] += $picker['units'];
                $dashboard['total_weight'] += $picker['units'] * 40;

                if ($picker['sorted'] != '1') {
                    $dashboard['remaining_fruits'] += $picker['units'];
                }
            } else {
                $dashboard['total_fruits'] += $picker['units'] * 22;
                $dashboard['total_weight'] += $picker['units'] * 22 * 40;

                if ($picker['sorted'] != '1') {
                    $dashboard['remaining_fruits'] += $picker['units'] * 22;
                }
            }
        }

        foreach ($hours as $hour) {
            $filterhopur['totalpackers'] = 0;
            $filterhopur['totalpackers'] += $hour['total_packers'];
            $hour = (explode(':', $hour['hour']));

            $dashboard['hours'] += (($hour[0]) + ($hour[1] / 60 ) + $hour[2] ) * $filterhopur['totalpackers'];
        }

        return view('manager.dashboard')->with(compact('dashboard'));
    }

    public function sortedFruits()
    {
        $fruits = Fruit::orderBy('created_at', 'desc')->get()->toArray();

        return view('manager.sorted_fruits')->with(compact('fruits'));
    }

    public function addFruit(Request $request)
    {

        if ($request->isMethod('post')) {

            $credentials = $request->validate([
                'date' => 'required',
                'product_type' => 'required',
            ]);

            $date = date_create($request->date);

            $fruit = Fruit::create([
                'date' => date_format($date, 'Y-m-d'),
                'product_type' => $request->product_type,
                'total_fruits' => $request->total_fruits,
                'quality_choice' => json_encode([
                    'shipping_grade' => ['type' => $request->type1, 'unit' => $request->shipping_grade, 'weight' => $request->weight1],
                    'marmalade_grade' => ['type' => $request->type2, 'unit' => $request->marmalade_grade, 'weight' => $request->weight2],
                    'fancy_grade' => ['type' => $request->type3, 'unit' => $request->fancy_grade, 'weight' => $request->weight3],
                    'culls' => ['type' => $request->type4, 'unit' => $request->culls, 'weight' => $request->weight4],

                ]),
                'remaining_fruits' => $request->remaining_fruits,
                'type' => $request->type,
                'weight' => $request->weight
            ]);

            if ($fruit) {

                if ($request->remaining_fruits == '0') {
                    Picker::where('id', $request->id)->update(['fruit_yet_to_sorted' => $request->remaining_fruits, 'sorted' => 1]);
                } else {
                    Picker::where('id', $request->id)->update(['fruit_yet_to_sorted' => $request->remaining_fruits]);
                }

                return redirect('manager/sorted_fruits')->with('status', 'Fruit Added Successfully');
            }

            return redirect()->back()->withErrors($credentials);
        } else {
            return view('manager.add_fruit');
        }
    }

    public function editFruit(Request $request, $id)
    {

        if ($request->isMethod('post')) {

            $credentials = $request->validate([
                'date' => 'required',
                'product_type' => 'required'
            ]);

            $date = date_create($request->date);

            $fruit = Fruit::where('fruit_id', $id)->update([
                'date' => date_format($date, 'Y-m-d'),
                'product_type' => $request->product_type,
                'total_fruits' => $request->total_fruits,
                'quality_choice' => json_encode([
                    'shipping_grade' => ['type' => $request->type1, 'unit' => $request->shipping_grade, 'weight' => $request->weight1],
                    'marmalade_grade' => ['type' => $request->type2, 'unit' => $request->marmalade_grade, 'weight' => $request->weight2],
                    'fancy_grade' => ['type' => $request->type3, 'unit' => $request->fancy_grade, 'weight' => $request->weight3],
                    'culls' => ['type' => $request->type4, 'unit' => $request->culls, 'weight' => $request->weight4],
                ]),
                'remaining_fruits' => $request->remaining_fruits,
                'type' => $request->type,
                'weight' => $request->weight
            ]);

            if ($fruit) {
                return redirect('manager/sorted_fruits')->with('status', 'Fruit Updated Successfully');
            }

            return redirect()->back()->withErrors($credentials);
        } else {
            $fruit = Fruit::where('fruit_id', $id)->get()->toArray();
            return view('manager.edit_fruit')->with(compact('fruit'));
        }
    }

    public function receivedFruits()
    {
        $fruits = Picker::orderBy('created_at', 'desc')->get();
        return view('manager.received_fruits')->with(compact('fruits'));
    }

    public function fruitToSort(Request $request)
    {

        $fruit = [
            'id' => $request->id,
            'fruit_id' => $request->fruit_id,
            'type' => $request->type,
            'product_type' => $request->product_type,
            'total_fruits' => $request->total_fruits,
            'fruit_yet_to_sorted' => $request->fruit_yet_to_sorted,
            'weight' => $request->weight
        ];

        if ($fruit['fruit_id'] != '') {

            $getSortedFruit = Fruit::where('fruit_id', $fruit['fruit_id'])->get()->toArray();

            $fruit['quality_choice'] = $getSortedFruit[0]['quality_choice'];
            $fruit['remaining_fruits'] = $getSortedFruit[0]['remaining_fruits'];
         
            return view('manager.sort_fruit')->with(compact('fruit'));
        } else {
            return view('manager.sort_fruit')->with(compact('fruit'));
        }
    }

    public function sortFruit(Request $request)
    {

        if ($request->isMethod('post')) {

            $date = date_create($request->date);

            if ($request->sorting == '0') {

                $fruit = Fruit::create([
                    'date' => date_format($date, 'Y-m-d'),
                    'product_type' => $request->product_type,
                    'total_fruits' => $request->total_fruits,
                    'quality_choice' => json_encode([
                        'shipping_grade' => ['type' => $request->type1, 'unit' => $request->shipping_grade, 'weight' => $request->weight1],
                        'marmalade_grade' => ['type' => $request->type2, 'unit' => $request->marmalade_grade, 'weight' => $request->weight2],
                        'fancy_grade' => ['type' => $request->type3, 'unit' => $request->fancy_grade, 'weight' => $request->weight3],
                        'culls' => ['type' => $request->type4, 'unit' => $request->culls, 'weight' => $request->weight4],

                    ]),
                    'remaining_fruits' => $request->remaining_fruits,
                    'type' => $request->type,
                    'weight' => $request->weight
                ]);

                if ($fruit) {

                    if ($request->remaining_fruits == '0') {
                        Picker::where('id', $request->id)->update(['fruit_id' => $fruit->fruit_id, 'fruit_yet_to_sorted' => $request->remaining_fruits, 'sorted' => 1]);
                    } else {
                        Picker::where('id', $request->id)->update(['fruit_id' => $fruit->fruit_id, 'fruit_yet_to_sorted' => $request->remaining_fruits]);
                    }

                    return redirect('manager/sorted_fruits')->with('status', 'Fruit Added Successfully');
                }
            } else {

                $fruit = Fruit::where('fruit_id', $request->fruit_id)->update([
                    'date' => date_format($date, 'Y-m-d'),
                    'product_type' => $request->product_type,
                    'total_fruits' => $request->total_fruits,
                    'quality_choice' => json_encode([
                        'shipping_grade' => ['type' => $request->type1, 'unit' => $request->shipping_grade, 'weight' => $request->weight1],
                        'marmalade_grade' => ['type' => $request->type2, 'unit' => $request->marmalade_grade, 'weight' => $request->weight2],
                        'fancy_grade' => ['type' => $request->type3, 'unit' => $request->fancy_grade, 'weight' => $request->weight3],
                        'culls' => ['type' => $request->type4, 'unit' => $request->culls, 'weight' => $request->weight4],

                    ]),
                    'remaining_fruits' => $request->remaining_fruits,
                    'type' => $request->type,
                    'weight' => $request->weight
                ]);

                if ($fruit) {

                    if ($request->remaining_fruits == '0') {
                        Picker::where('id', $request->id)->update(['fruit_id' => $request->fruit_id, 'fruit_yet_to_sorted' => $request->remaining_fruits, 'sorted' => 1]);
                    } else {
                        Picker::where('id', $request->id)->update(['fruit_id' => $request->fruit_id, 'fruit_yet_to_sorted' => $request->remaining_fruits]);
                    }

                    return redirect('manager/sorted_fruits')->with('status', 'Fruit Added Successfully');
                }
            }
        } else {
            return view('manager.sort_fruit');
        }
    }

    public function deleteSortedFruit($id)
    {
        $fruit = Fruit::where('fruit_id', $id)->delete();

        if($fruit)
        {
            Picker::where('fruit_id', $id)->update(['fruit_id' => null, 'sorted' => null]);
            return redirect('manager/sorted_fruits');
        }

    }

    public function invoice()
    {
        return view('manager.invoice');
    }

    public function pdf(Request $request)
    {

        if ($request->isMethod('post')) {

            $request->validate([
                'date' => 'required',
            ]);

            $formattedStartDate = date_create($request->input('fromDate'));
            $formattedEndDate = date_create($request->input('toDate'));

            $startdate = date_format($formattedStartDate, 'Y-m-d');
            $enddate = date_format($formattedEndDate, 'Y-m-d');

            session()->put('startdate', $startdate);
            session()->put('enddate', $enddate);

            $fruits = Fruit::whereBetween('date', [$startdate, $enddate])->get();
            $works = Work::whereBetween('date', [$startdate, $enddate])->get()->toArray();
            $packing = Work::whereBetween('date', [$startdate, $enddate])->where('activity', 'Packing')->get()->toArray();
            $picker = Picker::whereBetween('date', [$startdate, $enddate])->orderBy('id', 'DESC')->get()->toArray();
            $cleaning = Work::whereBetween('date', [$startdate, $enddate])->where('activity', 'Cleaning')->get()->toArray();
            $labelling = Work::whereBetween('date', [$startdate, $enddate])->where('activity', 'Labelling')->get()->toArray();
            $staging = Work::whereBetween('date', [$startdate, $enddate])->where('activity', 'Staging')->get()->toArray();
            $breakdown = Work::whereBetween('date', [$startdate, $enddate])->where('activity', 'BreakDown')->get()->toArray();
            $maintenance = Work::whereBetween('date', [$startdate, $enddate])->where('activity', 'Maintenance')->get()->toArray();

            $hours = [
                'total_hours' => 0,
                'packing_hours' => 0,
                'cleaning_hours' => 0,
                'labelling_hours' => 0,
                'staging_hours' => 0,
                'breakdown_hours' => 0,
                'maintenance_hours' => 0,
                'start_date' => session()->get('startdate'),
                'end_date' => session()->get('enddate'),
            ];
    
            foreach ($works as $hour) {
                $totalhour = (explode(':', $hour['hour']));
                $hours['total_hours'] += round( ($totalhour[0]) + ($totalhour[1] / 60 ) + $totalhour[2],2)*$hour['total_packers'];
            }
    
            foreach ($packing as $pack) {
                $hour = (explode(':', $pack['hour']));
                $hours['packing_hours'] +=  round( ($hour[0]) + ($hour[1] / 60 ) + $hour[2],2)*$pack['total_packers'];
            }
    
            foreach ($cleaning as $clean) {
                $hour = (explode(':', $clean['hour']));
                $hours['cleaning_hours'] +=  round( ($hour[0]) + ($hour[1] / 60 ) + $hour[2],2)*$clean['total_packers'];
            }
    
            foreach ($labelling as $label) {
                $hour = (explode(':', $label['hour']));
                $hours['labelling_hours'] +=  round( ($hour[0]) + ($hour[1] / 60 ) + $hour[2],2)*$label['total_packers'];
            }
    
            foreach ($staging as $stag) {
                $hour = (explode(':', $stag['hour']));
                $hours['staging_hours'] += round( ($hour[0]) + ($hour[1] / 60 ) + $hour[2],2)*$stag['total_packers'];
            }
    
            foreach ($breakdown as $break) {
                $hour = (explode(':', $break['hour']));
                $hours['breakdown_hours'] +=  round( ($hour[0]) + ($hour[1] / 60 ) + $hour[2],2)*$break['total_packers'];
            }
    
            foreach ($maintenance as $main) {
                $hour = (explode(':', $main['hour']));
                $hours['maintenance_hours'] +=  round( ($hour[0]) + ($hour[1] / 60 ) + $hour[2],2)*$main['total_packers'];
            }

            $randomNumber = random_int(100000, 999999);
            
            return view('manager.generated_invoice')->with(compact('fruits', 'works', 'hours', 'randomNumber','picker'));

        } else {
            return view('manager.generated_invoice');
        }
    }

    public function generatePDF()
    {
        $startdate = session()->get('startdate');

        $enddate = session()->get('enddate');

        $fruits = Fruit::whereBetween('date', [$startdate, $enddate])->get();

        $works = Work::whereBetween('date', [$startdate, $enddate])->get()->toArray();

        $packing = Work::whereBetween('date', [$startdate, $enddate])->where('activity', 'Packing')->get()->toArray();
        $picker = Picker::whereBetween('date', [$startdate, $enddate])->orderBy('id', 'DESC')->get()->toArray();
        $cleaning = Work::whereBetween('date', [$startdate, $enddate])->where('activity', 'Cleaning')->get()->toArray();
        $labelling = Work::whereBetween('date', [$startdate, $enddate])->where('activity', 'Labelling')->get()->toArray();
        $staging = Work::whereBetween('date', [$startdate, $enddate])->where('activity', 'Staging')->get()->toArray();
        $breakdown = Work::whereBetween('date', [$startdate, $enddate])->where('activity', 'BreakDown')->get()->toArray();
        $maintenance = Work::whereBetween('date', [$startdate, $enddate])->where('activity', 'Maintenance')->get()->toArray();

        $hours = [
            'total_hours' => 0,
            'packing_hours' => 0,
            'cleaning_hours' => 0,
            'labelling_hours' => 0,
            'staging_hours' => 0,
            'breakdown_hours' => 0,
            'maintenance_hours' => 0,
            'start_date' => session()->get('startdate'),
            'end_date' => session()->get('enddate'),
        ];

        foreach ($works as $hour) {
            $totalhour = (explode(':', $hour['hour']));
            $hours['total_hours'] += round( ($totalhour[0]) + ($totalhour[1] / 60 ) + $totalhour[2],2)*$hour['total_packers'];
        }

        foreach ($packing as $pack) {
            $hour = (explode(':', $pack['hour']));
            $hours['packing_hours'] +=  round( ($hour[0]) + ($hour[1] / 60 ) + $hour[2],2)*$pack['total_packers'];
          
        }

        foreach ($cleaning as $clean) {
            $hour = (explode(':', $clean['hour']));
            $hours['cleaning_hours'] +=  round( ($hour[0]) + ($hour[1] / 60 ) + $hour[2],2)*$clean['total_packers'];
        }

        foreach ($labelling as $label) {
            $hour = (explode(':', $label['hour']));
            $hours['labelling_hours'] +=  round( ($hour[0]) + ($hour[1] / 60 ) + $hour[2],2)*$label['total_packers'];
        }

        foreach ($staging as $stag) {
            $hour = (explode(':', $stag['hour']));
            $hours['staging_hours'] += round( ($hour[0]) + ($hour[1] / 60 ) + $hour[2],2)*$stag['total_packers'];
        }

        foreach ($breakdown as $break) {
            $hour = (explode(':', $break['hour']));
            $hours['breakdown_hours'] +=  round( ($hour[0]) + ($hour[1] / 60 ) + $hour[2],2)*$break['total_packers'];
        }

        foreach ($maintenance as $main) {
            $hour = (explode(':', $main['hour']));
            $hours['maintenance_hours'] +=  round( ($hour[0]) + ($hour[1] / 60 ) + $hour[2],2)*$main['total_packers'];
        }

        $randomNumber = random_int(100000, 999999);

        $pdf = PDF::loadView('manager.generated_invoice', ['fruits' => $fruits,'picker' => $picker, 'works' => $works, 'hours' => $hours, 'randomNumber' => $randomNumber]);

        return $pdf->download('Invoice_MG' . date('Y-') . '-' . $randomNumber . '.pdf');
    }

    public function profile(Request $request, $id)
    {
        $users = User::find($id);
        return view('manager.profile')->with(compact('users'));
    }

    public function filterFruits($fromdate, $todate)
    {
        $fruits = Fruit::whereBetween('date', [$fromdate, $todate])->orderBy('created_at', 'desc')->get()->toArray();

        return $fruits;
    }

    public function filterReceivedFruits($fromdate, $todate)
    {
        $fruits = Picker::whereBetween('date', [$fromdate, $todate])->orderBy('created_at', 'desc')->get()->toArray();
        return $fruits;
    }
}
