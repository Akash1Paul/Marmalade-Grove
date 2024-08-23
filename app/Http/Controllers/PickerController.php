<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProductVariety;
use App\Models\Picker;

class PickerController extends Controller
{

    public function index()
    {
        $pickers = Picker::orderBy('created_at', 'desc')->get();
        return view('fruitPicker.fruitPicker')->with(compact('pickers'));
    }

    public function addFruit(Request $request)
    {
        if ($request->isMethod('post')) {

            $request->validate([
                'date' => 'required',
                'product_type' => 'required',
                'types' => 'required',
                'units' => 'required',
                'weight' => 'required'
            ]);

            $date = date_create($request->input('date'));

            $pickers = new Picker();
            $pickers->date = date_format($date, 'Y-m-d');
            $pickers->product_type = $request->input('product_type');
            $pickers->types = $request->input('types');
            $pickers->units = $request->input('units');
            $pickers->weight = $request->input('weight');
            $pickers->save();
            // Assuming you want to redirect to another page after saving the room
            return redirect('picker/dashboard')->with('status', 'Fruits Added Successfully');
        } else {
            $products = ProductVariety::all()->toArray();
            return view('fruitPicker.addFruit')->with(compact('products'));
        }
    }

    public function editFruit(Request $request, $id)
    {
        $pickers = Picker::find($id);
        $products = ProductVariety::all()->toArray();
        return view('fruitPicker.editFruit')->with(compact('pickers', 'products'));
    }

    public function updateFruit(Request $request, $id)
    {
        if ($request->isMethod('post')) {

            $request->validate([
                'date' => 'required',
                'product_type' => 'required',
                'types' => 'required',
                'units' => 'required',
                'weight' => 'required'
            ]);

            $date = date_create($request->input('date'));

            $pickers = Picker::find($id);
            $pickers->date = date_format($date, 'Y-m-d');
            $pickers->product_type = $request->input('product_type');
            $pickers->types = $request->input('types');
            $pickers->units = $request->input('units');
            $pickers->weight = $request->input('weight');
            $pickers->update();
            // Assuming you want to redirect to another page after saving the room
            return redirect('picker/dashboard')->with('status', 'Fruits Updated Successfully');
        } else {
            $products = ProductVariety::all()->toArray();
            return view('fruitPicker.editFruit')->with(compact('products'));
        }
    }

    public function deleteFruit($id)
    {
        $fruit = Picker::where('id', $id)->delete();

        if ($fruit) {
            return redirect('picker/dashboard');
        }
    }

    public function profile(Request $request, $id)
    {
        $users = User::find($id);
        return view('fruitPicker.profile')->with(compact('users'));
    }

    public function filterFruits($fromdate, $todate)
    {
        $fruits = Picker::whereBetween('date', [$fromdate, $todate])->orderBy('created_at', 'desc')->get()->toArray();
        return $fruits;
    }

    public function resetDate()
    {
        $fruits = Picker::orderBy('created_at', 'desc')->get()->toArray();
        return $fruits;
    }
}
