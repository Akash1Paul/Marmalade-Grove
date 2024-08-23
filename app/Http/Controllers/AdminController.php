<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProductVariety;
use App\Models\Fruit;
use App\Models\Picker;
use App\Models\Wage;
use App\Models\Work;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Redirect;
class AdminController extends Controller
{
    public function index()
    {

        $hours = Work::whereMonth('date', Carbon::now()->month)->get()->toArray();
        $wage = Wage::all()->last();
        $getThisWeek = Work::where('activity', 'Packing')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get()->toArray();

        $thisWeek = [
            'Sun' => 0,
            'Mon' => 0,
            'Tue' => 0,
            'Wed' => 0,
            'Thu' => 0,
            'Fri' => 0,
            'Sat' => 0
        ];

        foreach ($getThisWeek as $day) {

            $getDay = date('D', strtotime($day['date']));

            if ($getDay == 'Sun') {
                $thisWeek['Sun'] += $day['quantities'];
            }

            if ($getDay == 'Mon') {
                $thisWeek['Mon'] += $day['quantities'];
            }

            if ($getDay == 'Tue') {
                $thisWeek['Tue'] += $day['quantities'];
            }

            if ($getDay == 'Wed') {
                $thisWeek['Wed'] += $day['quantities'];
            }

            if ($getDay == 'Thu') {
                $thisWeek['Thu'] += $day['quantities'];
            }

            if ($getDay == 'Fri') {
                $thisWeek['Fri'] += $day['quantities'];
            }

            if ($getDay == 'Sat') {
                $thisWeek['Sat'] += $day['quantities'];
            }
        }

        $getLastWeek = Work::where('activity', 'Packing')->whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()])->get()->toArray();

        $lastWeek = [
            'Sun' => 0,
            'Mon' => 0,
            'Tue' => 0,
            'Wed' => 0,
            'Thu' => 0,
            'Fri' => 0,
            'Sat' => 0
        ];

        foreach ($getLastWeek as $day) {
            $getDay = date('D', strtotime($day['date']));

            if ($getDay == 'Sun') {
                $lastWeek['Sun'] += $day['quantities'];
            }

            if ($getDay == 'Mon') {
                $lastWeek['Mon'] += $day['quantities'];
            }

            if ($getDay == 'Tue') {
                $lastWeek['Tue'] += $day['quantities'];
            }

            if ($getDay == 'Wed') {
                $lastWeek['Wed'] += $day['quantities'];
            }

            if ($getDay == 'Thu') {
                $lastWeek['Thu'] += $day['quantities'];
            }

            if ($getDay == 'Fri') {
                $lastWeek['Fri'] += $day['quantities'];
            }

            if ($getDay == 'Sat') {
                $lastWeek['Sat'] += $day['quantities'];
            }
        }

        $copthisweek = Work::where('activity', 'Packing')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get()->toArray();

        $copthisweeks = [
            'Jan' => 0,
            'Feb' => 0,
            'Mar' => 0,
            'Apr' => 0,
            'May' => 0,
            'Jun' => 0,
            'Jul' => 0,
            'Aug' => 0,
            'Sep' => 0,
            'Oct' => 0,
            'Nov' => 0,
            'Dec' => 0
        ];

        foreach ($copthisweek as $thiscop) {
            $getmonth = date('M', strtotime($thiscop['date']));
            if ($getmonth == 'Jan') {
                $hour = (explode(':', $thiscop['hour']));
                $copperday = round((((($hour[0]) + ($hour[1] / 60 ) + $hour[2] ) * $wage->wage) * $thiscop['total_packers'] / $thiscop['quantities']), 2);
                $copthisweeks['Jan'] += $copperday;
            }
            if ($getmonth == 'Feb') {
                $hour = (explode(':', $thiscop['hour']));
                $copperday = round((((($hour[0]) + ($hour[1] / 60 ) + $hour[2] ) * $wage->wage) * $thiscop['total_packers'] / $thiscop['quantities']), 2);
                $copthisweeks['Feb'] += $copperday;
            }
            if ($getmonth == 'Mar') {
                $hour = (explode(':', $thiscop['hour']));
                $copperday = round((((($hour[0]) + ($hour[1] / 60 ) + $hour[2] ) * $wage->wage) * $thiscop['total_packers'] / $thiscop['quantities']), 2);
                $copthisweeks['Mar'] += $copperday;
            }
            if ($getmonth == 'Apr') {
                $hour = (explode(':', $thiscop['hour']));
                $copperday = round((((($hour[0]) + ($hour[1] / 60 ) + $hour[2] ) * $wage->wage) * $thiscop['total_packers'] / $thiscop['quantities']), 2);
                $copthisweeks['Apr'] += $copperday;
            }
            if ($getmonth == 'May') {
                $hour = (explode(':', $thiscop['hour']));
                $copperday = round((((($hour[0]) + ($hour[1] / 60 ) + $hour[2] ) * $wage->wage) * $thiscop['total_packers'] / $thiscop['quantities']), 2);
                $copthisweeks['May'] += $copperday;
            }
            if ($getmonth == 'Jun') {
                $hour = (explode(':', $thiscop['hour']));
                $copperday = round((((($hour[0]) + ($hour[1] / 60 ) + $hour[2] ) * $wage->wage) * $thiscop['total_packers'] / $thiscop['quantities']), 2);
                $copthisweeks['Jun'] += $copperday;
            }
            if ($getmonth == 'Jul') {
                $hour = (explode(':', $thiscop['hour']));
                $copperday = round((((($hour[0]) + ($hour[1] / 60 ) + $hour[2] ) * $wage->wage) * $thiscop['total_packers'] / $thiscop['quantities']), 2);
                $copthisweeks['Jul'] += $copperday;
            }
            if ($getmonth == 'Aug') {
                $hour = (explode(':', $thiscop['hour']));
                $copperday = round((((($hour[0]) + ($hour[1] / 60 ) + $hour[2] ) * $wage->wage) * $thiscop['total_packers'] / $thiscop['quantities']), 2);
                $copthisweeks['Aug'] += $copperday;
            }
            if ($getmonth == 'Sep') {
                
                $hour = (explode(':', $thiscop['hour']));
                $copperday = round((((($hour[0]) + ($hour[1] / 60 ) + $hour[2] ) * $wage->wage) * $thiscop['total_packers'] / $thiscop['quantities']), 2);
                $copthisweeks['Sep'] += $copperday;
            }
            if ($getmonth == 'Oct') {
                $hour = (explode(':', $thiscop['hour']));
                $copperday = round((((($hour[0]) + ($hour[1] / 60 ) + $hour[2] ) * $wage->wage) * $thiscop['total_packers'] / $thiscop['quantities']), 2);
                $copthisweeks['Oct'] += $copperday;
            }
            if ($getmonth == 'Nov') {
                $hour = (explode(':', $thiscop['hour']));
                $copperday = round((((($hour[0]) + ($hour[1] / 60 ) + $hour[2] ) * $wage->wage) * $thiscop['total_packers'] / $thiscop['quantities']), 2);
                $copthisweeks['Nov'] += $copperday;
            }
            if ($getmonth == 'Dec') {
                $hour = (explode(':', $thiscop['hour']));
                $copperday = round((((($hour[0]) + ($hour[1] / 60 ) + $hour[2] ) * $wage->wage) * $thiscop['total_packers'] / $thiscop['quantities']), 2);
                $copthisweeks['Dec'] += $copperday;
            }
        }

        $coplastweek = Work::where('activity', 'Packing')->whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()])->get()->toArray();
        $coplastweeks = [
            'Jan' => 0,
            'Feb' => 0,
            'Mar' => 0,
            'Apr' => 0,
            'May' => 0,
            'Jun' => 0,
            'Jul' => 0,
            'Aug' => 0,
            'Sep' => 0,
            'Oct' => 0,
            'Nov' => 0,
            'Dec' => 0
        ];
        foreach ($coplastweek as $lastcop) {
            $getmonth = date('M', strtotime($lastcop['date']));
           
            if ($getmonth == 'Jan') {
                $hour = (explode(':', $lastcop['hour']));
                $copperday = round((((($hour[0]) + ($hour[1] / 60 ) + $hour[2] ) * $wage->wage) * $lastcop['total_packers'] / $lastcop['quantities']), 2);
                $coplastweeks['Jan'] += $copperday;
            }
            if ($getmonth == 'Feb') {
                $hour = (explode(':', $lastcop['hour']));
                $copperday = round((((($hour[0]) + ($hour[1] / 60 ) + $hour[2] ) * $wage->wage) * $lastcop['total_packers'] / $lastcop['quantities']), 2);
                $coplastweeks['Feb'] += $copperday;
            }
            if ($getmonth == 'Mar') {
                $hour = (explode(':', $lastcop['hour']));
                $copperday = round((((($hour[0]) + ($hour[1] / 60 ) + $hour[2] ) * $wage->wage) * $lastcop['total_packers'] / $lastcop['quantities']), 2);
                $coplastweeks['Mar'] += $copperday;
            }
            if ($getmonth == 'Apr') {
                $hour = (explode(':', $lastcop['hour']));
                $copperday = round((((($hour[0]) + ($hour[1] / 60 ) + $hour[2] ) * $wage->wage) * $lastcop['total_packers'] / $lastcop['quantities']), 2);
                $coplastweeks['Apr'] += $copperday;
            }
            if ($getmonth == 'May') {
                $hour = (explode(':', $lastcop['hour']));
                $copperday = round((((($hour[0]) + ($hour[1] / 60 ) + $hour[2] ) * $wage->wage) * $lastcop['total_packers'] / $lastcop['quantities']), 2);
                $coplastweeks['May'] += $copperday;
            }
            if ($getmonth == 'Jun') {
                $copperday = round((((($hour[0]) + ($hour[1] / 60 ) + $hour[2] ) * $wage->wage) * $lastcop['total_packers'] / $lastcop['quantities']), 2);
                $coplastweeks['Jun'] += $copperday;
            }
            if ($getmonth == 'Jul') {
                $hour = (explode(':', $lastcop['hour']));
                $copperday = round((((($hour[0]) + ($hour[1] / 60 ) + $hour[2] ) * $wage->wage) * $lastcop['total_packers'] / $lastcop['quantities']), 2);
                $coplastweeks['Jul'] += $copperday;
            }
            if ($getmonth == 'Aug') {
                $hour = (explode(':', $lastcop['hour']));
                $copperday = round((((($hour[0]) + ($hour[1] / 60 ) + $hour[2] ) * $wage->wage) * $lastcop['total_packers'] / $lastcop['quantities']), 2);
                $coplastweeks['Aug'] += $copperday;
            }
            if ($getmonth == 'Sep') {
                $hour = (explode(':', $lastcop['hour']));
                $copperday = round((((($hour[0]) + ($hour[1] / 60 ) + $hour[2] ) * $wage->wage) * $lastcop['total_packers'] / $lastcop['quantities']), 2);
                $coplastweeks['Sep'] += $copperday;
            }
            if ($getmonth == 'Oct') {
                $hour = (explode(':', $lastcop['hour']));
                $copperday = round((((($hour[0]) + ($hour[1] / 60 ) + $hour[2] ) * $wage->wage) * $lastcop['total_packers'] / $lastcop['quantities']), 2);
                $coplastweeks['Oct'] += $copperday;
            }
            if ($getmonth == 'Nov') {
                $hour = (explode(':', $lastcop['hour']));
                $copperday = round((((($hour[0]) + ($hour[1] / 60 ) + $hour[2] ) * $wage->wage) * $lastcop['total_packers'] / $lastcop['quantities']), 2);
                $coplastweeks['Nov'] += $copperday;
            }
            if ($getmonth == 'Dec') {
                $hour = (explode(':', $lastcop['hour']));
                $copperday = round((((($hour[0]) + ($hour[1] / 60 ) + $hour[2] ) * $wage->wage) * $lastcop['total_packers'] / $lastcop['quantities']), 2);
                $coplastweeks['Dec'] += $copperday;
            }
        }

        $users = User::where('email', '!=', Auth::user()->email)->get();

        $dashboard = [
            'totalfruits' =>  Picker::whereMonth('date', Carbon::now()->month)->sum('weight'),
            'hours' => 0,
            'totalcop' => 0,
            'totalquantity' => Work::sum('quantities'),
            'test' => 0,
            'test2'=>0,
            'thismonthscop' => 0,
            'lastmonthscop' => 0,
            'totalpackfruits' => 0,
            'remaining_fruits' => 0,
            'cost_of_month' => 0,
            'totalpackers' => 0,
            'numberofpackages' => 0
        ];

        $works = Work::whereMonth('date', Carbon::now()->month)->get();
        foreach ($works as $work) {
            $hour = (explode(':', $work->hour));

            $dashboard['totalcop'] += round(((($hour[0]) + ($hour[1] / 60 ) + $hour[2] ) * $wage->wage) / $work->total_packers, 2);
            // suppose boxsize is 10lb and quantity is 20 that means 10*20 = 200lb

            $dashboard['cost_of_month'] += round(((($hour[0]) + ($hour[1] / 60 ) + $hour[2] ) * $wage->wage * $work->total_packers));
        }

        $totalpackers = Work::where('activity', 'Packing')->whereMonth('date', Carbon::now()->month)->get();
      
      
        foreach ($hours as $hour) {
            $filterhopur['totalpackers'] = 0;
            $filterhopur['totalpackers'] += $hour['total_packers'];
            $hour = (explode(':', $hour['hour']));
            $dashboard['hours'] += (($hour[0]) + ($hour[1] / 60 ) + $hour[2] ) * $filterhopur['totalpackers'];
        }
       
        $curentmonthcop = Work::whereMonth('date', Carbon::now()->month)->get();

        $i=Work::whereMonth('date', Carbon::now()->month)->where('quantities','!=',null)->count();
        $quant = 0;
        foreach ($curentmonthcop as $cmcop) {
            $quant +=  $cmcop->quantities;
            $hour = (explode(':', $cmcop->hour));
            $dashboard['test'] += round((((($hour[0]) + ($hour[1] / 60 ) + $hour[2] )* $wage->wage) * $cmcop->total_packers), 2);
        }
        if($i != null){
        $dashboard['thismonthscop'] = round( (($dashboard['test']/$quant))/$i,2);
        }
        
        $lastmonthcop = Work::whereBetween('date', [Carbon::now()->subMonth(1), Carbon::now()])->get();
        $j=Work::whereBetween('date', [Carbon::now()->subMonth(1), Carbon::now()])->where('quantities','!=',null)->count();
        $quant2 = 0;
        foreach ($lastmonthcop as $copoflast) {  
            $quant2 +=  $copoflast->quantities;
            $hour = (explode(':', $copoflast->hour));
            $dashboard['test2'] += round((((($hour[0]) + ($hour[1] / 60 ) + $hour[2] ) * $wage->wage) * $copoflast->total_packers), 2);
        }
        if($j != null){
        $dashboard['lastmonthscop'] =  round( (($dashboard['test2']/$quant2))/$j,2);
        }

        $totalpackage =  Work::where('activity', 'Packing')->whereMonth('date', Carbon::now()->month)->get();
        foreach ($totalpackage as $package) {
            $dashboard['totalpackfruits'] += ($package->boxsize * $package->total_packers);
        }

        $dashboard['remaining_fruits'] += $dashboard['totalfruits'] - $dashboard['totalpackfruits'];

        $dashboard['numberofpackages'] = Work::where('activity', 'Packing')->whereMonth('date', Carbon::now()->month)->get()->count();
        return view('admin.dashboard')->with(compact('dashboard', 'users', 'thisWeek', 'lastWeek', 'copthisweeks', 'coplastweeks'));
    }

    public function workDiary()
    {
        $works = Work::orderBy('created_at', 'desc')->get();
        $wage = Wage::all()->last();
        $arr = [];
        $costperpackege = [];
        $test = ['test'=> 0];
        $hour = '';
        $totalhour = 0;
        $i=0;
      
         foreach ($works as $work) {
           
             $i++;
             $hour = (explode(':', $work->hour));
             $arr[] = round( ($hour[0]) + ($hour[1] / 60 ) + $hour[2],2); 
             $totalhour = round( ($hour[0]) + ($hour[1] / 60 ) + $hour[2],2); 
             //$test['test'] = round((($totalhour * $wage->wage) * $work->total_packers / $work->quantities), 2);
             //$costperpackege[] =  round($test['test'],2);
            
         }
       
        return view('admin.workDiary')->with(compact('works', 'wage', 'arr', 'costperpackege'));
    }

    public function pickerDiary()
    {
        $pickers = Picker::orderBy('created_at', 'desc')->get();
        return view('admin.pickerDiary')->with(compact('pickers'));
    }

    public function fruitsDetails()
    {
        $fruits = Fruit::orderBy('created_at', 'desc')->get();
        return view('admin.fruitDetails')->with(compact('fruits'));
    }

    public function productVarieties()
    {
        $varieties = ProductVariety::orderBy('created_at', 'desc')->get()->toArray();

        return view('admin.product_varieties')->with(compact('varieties'));
    }

    public function addProductVariety(Request $request)
    {

        if ($request->isMethod('post')) {

            $credentials = $request->validate([
                'product_name' => 'required',
            ]);

            $product = ProductVariety::create([
                'product_name' => $request->product_name,
            ]);

            if ($product) {
                return redirect('admin/product_varieties')->with('status', 'Product Added Successfully');
            }

            return redirect()->back()->withErrors($credentials);
        } else {
            return view('admin.add_product_variety');
        }
    }

    public function editProductVariety(Request $request, $id)
    {

        if ($request->isMethod('post')) {

            $credentials = $request->validate([
                'product_name' => 'required',
            ]);

            $product = ProductVariety::where('product_id', $id)->update([
                'product_name' => $request->product_name,
            ]);

            if ($product) {
                return redirect('admin/product_varieties')->with('status', 'Product Updated Successfully');
            }

            return redirect()->back()->withErrors($credentials);
        } else {
            $product = ProductVariety::where('product_id', $id)->get()->toArray();
            return view('admin.edit_product_variety')->with(compact('product'));
        }
    }

    public function deleteProductVariety($id)
    {
        $product = ProductVariety::where('product_id', $id)->delete();

        if ($product) {
            return redirect('admin/product_varieties');
        }
    }

    public function accounts()
    {
        $users = User::where('email', '!=', Auth::user()->email)->get();
        return view('admin.account')->with(compact('users'));
    }

    public function addAccount()
    {
        return view('admin.addAccount');
    }

    public function editAccount(Request $request, $id)
    {
        $users = User::find($id);
        return view('admin.editAccount')->with(compact('users'));
    }

    public function updateAccount(Request $request, $id)
    {
        if ($request->isMethod('post')) {

            $request->validate([
                'roles' => 'required',
                'fname' => 'required',
                'lname' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'phone' => 'required',
                'address' => 'required'
            ]);
            $users = User::find($id);
            $users->roles = $request->input('roles');
            $users->fname = $request->input('fname');
            $users->lname = $request->input('lname');
            $users->email = $request->input('email');
            $users->password = Hash::make($request->input('password'));
            $users->phone = $request->input('phone');
            $users->address = $request->input('address');

            if ($request->hasfile('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '_image.' . $extension;
                $file->move('userUploads', $filename);
                $users->image = $filename;
            } else {

                $users->image = $request['image'];
            }
            $users->update();
            return Redirect::back()->with('status', 'Accounts Updated Successfully');
        } else {
           return Redirect::back();
        }
    }

    public function saveAccount(Request $request)
    {
        if ($request->isMethod('post')) {

            $request->validate([
                'roles' => 'required',
                'fname' => 'required',
                'lname' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'phone' => 'required',
                'address' => 'required'
            ]);
            $users = new User();
            $users->fname = $request->input('fname');
            $users->lname = $request->input('lname');
            $users->email = $request->input('email');
            $users->password = Hash::make($request->input('password'));
            $users->phone = $request->input('phone');
            $users->address = $request->input('address');
            $users->roles = $request->input('roles');
            if ($request->hasfile('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '_image.' . $extension;
                $file->move('userUploads', $filename);
                $users->image = $filename;
            } else {

                $users->image = $request['image'];
            }
            $users->save();
            return redirect('admin/accounts')->with('status', 'Accounts Added Successfully');
        } else {
            return view('admin.addAccount');
        }
    }

    public function wages()
    {
        $wage = Wage::all()->last();
        return view('admin.wage')->with(compact('wage'));
    }

    public function addWages(Request $request)
    {
        if ($request->isMethod('post')) {

            $request->validate([
                'wage' => 'required',
            ]);
            $wage = new Wage();
            $wage->wage = $request->input('wage');
            $wage->save();
            return redirect('admin/wages')->with('status', 'Wage Added Successfully');
        } else {
            return redirect('admin/wages');
        }
    }

    public function invoice()
    {
        return view('admin.invoice');
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

            return view('admin.generated_invoice')->with(compact('fruits', 'works', 'hours', 'randomNumber','picker'));
        } else {
            return view('admin.generated_invoice');
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
        $pdf = PDF::loadView('admin.generated_invoice', ['fruits' => $fruits,'picker' => $picker, 'works' => $works, 'hours' => $hours, 'randomNumber' => $randomNumber]);
        return $pdf->download('Invoice_MG' . date('Y-') . '-' . $randomNumber . '.pdf');
    }

    public function filterDiary($date)
    {
        $diary = Work::where('date', $date)->get()->toArray();
        return $diary;
    }

    public function profile(Request $request, $id)
    {
        $users = User::find($id);
        return view('admin.profile')->with(compact('users'));
    }


    public function filterPicker($fromdate, $todate)
    {
        $fruits = Picker::whereBetween('date', [$fromdate, $todate])->orderBy('created_at', 'desc')->get()->toArray();
        return $fruits;
    }

    public function filterFruits($fromdate, $todate)
    {
        $fruits = Fruit::whereBetween('date', [$fromdate, $todate])->orderBy('created_at', 'desc')->get()->toArray();
        return $fruits;
    }

    public function filterPacker($fromdate, $todate)
    {
        $works = Work::whereBetween('date', [$fromdate, $todate])->orderBy('created_at', 'desc')->get()->toArray();

        $wage = Wage::all()->last()->toArray();

        $result = [];
        $test = ['test'=>0];
        $i = 0;
        $j = 0;
        foreach ($works as $work) {
            $j++;
            $hour = (explode(':', $work['hour']));
            $result[$i] = $work;
            $result[$i]['wage'] = $wage['wage'];
            $result[$i]['hours'] = round( ($hour[0]) + ($hour[1] / 60 ) + $hour[2],2);
           // $test['test'] = round((((($hour[0]) + ($hour[1] / 60 ) + $hour[2]) * $wage['wage']) * $work['total_packers'] / $work['quantities']), 2);
            //$result[$i]['cost_per_package'] =  round($test['test'] ,2);
            $i = $i + 1;
        }

        return $result;
    }

    public function dashboardFilter($from, $to)
    {

        $hours = Work::whereBetween('date', [$from, $to])->get()->toArray();
        $costofmonths = Work::whereBetween('date', [$from, $to])->get();
        $wage = Wage::all()->last();

        $dashboard = [
            'cost_per_package' => 0,
            'total_hours' => 0,
            'total_fruits' =>  Picker::whereBetween('date', [$from, $to])->sum('weight'),
            'packaged_fruits' => 0,
            'remaining_fruits' => 0,
            'total_quantity' => Work::whereBetween('date', [$from, $to])->sum('quantities'),
            'cost_of_month' => 0,
            'totalpackers' => 0,
            'test'=>0,
            'numberofpackages' => 0
        ];
       
        $works = Work::whereBetween('date', [$from, $to])->get();
        $total_packaged = Work::whereBetween('date', [$from, $to])->where('activity', 'Packing')->get()->toArray();
        $i=Work::whereBetween('date', [$from, $to])->where('quantities','!=',null)->count();
        $quant = 0;
        foreach ($works as $work) {
           
            $quant +=  $work->quantities;
            $hour = (explode(':', $work->hour));
            $dashboard['test'] += round((((($hour[0]) + ($hour[1] / 60 ) + $hour[2] )* $wage->wage) * $work->total_packers), 2); 
        }
       
       if($quant == 0 &&  $i==null)
       {
        $dashboard['cost_per_package'] = 0;
       }else{
        $dashboard['cost_per_package']  = round( (($dashboard['test']/$quant))/$i,2);
       }

        $totalpackers = Work::where('activity', 'Packing')->whereMonth('date', Carbon::now()->month)->get();
        foreach($totalpackers as $totalpacker)
        {
            $dashboard['totalpackers'] += $totalpacker->total_packers;
        } 

        foreach ($hours as $hour) {
            $filterhopur['totalpackers'] = 0;
            $filterhopur['totalpackers'] += $hour['total_packers'];
            $hour = (explode(':', $hour['hour']));
            $dashboard['total_hours'] += round((($hour[0]) + ($hour[1] / 60 ) + $hour[2] )*$filterhopur['totalpackers'],2);
        }
       
       
        foreach($costofmonths as $costofmonth)
        {
            $hour = (explode(':', $costofmonth->hour));
            $dashboard['cost_of_month'] += round(((($hour[0]) + ($hour[1] / 60 ) + $hour[2] ) * $wage->wage * $costofmonth->total_packers));
        }

        foreach ($total_packaged as $packaged) {

            $dashboard['packaged_fruits'] += ($packaged['boxsize'] * $packaged['quantities']);
        }

        $dashboard['remaining_fruits'] += $dashboard['total_fruits'] - $dashboard['packaged_fruits'];
        $dashboard['numberofpackages'] = Work::where('activity', 'Packing')->whereBetween('date', [$from, $to])->get()->count();

        return $dashboard;
    }

    
}
