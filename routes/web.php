<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PackerController;
use App\Http\Controllers\PickerController;
use App\Http\Controllers\ManagerController;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['guest']], function () {

    Route::get('/', function () {
        return view('login');
    });

    Route::post('login', [AuthController::class, 'login']);
});

Route::get('logout', function () {
    Session::flush();
    Auth::logout();
    return redirect('/');
});


//Admin Routes
Route::group(['middleware' => ['VerifyAdmin']], function () {

    Route::get('admin/admin_dashboard', [AdminController::class, 'index']);

    Route::get('admin/picker_diary', [AdminController::class, 'pickerDiary']);

    Route::get('admin/work_diary', [AdminController::class, 'workDiary']);

    Route::get('admin/fruits_details', [AdminController::class, 'fruitsDetails']);

    Route::get('admin/product_varieties', [AdminController::class, 'productVarieties']);

    Route::get('admin/add_product_variety', [AdminController::class, 'addProductVariety']);

    Route::post('admin/add_product_variety', [AdminController::class, 'addProductVariety']);

    Route::get('admin/edit_product_variety/{id}', [AdminController::class, 'editProductVariety']);

    Route::post('admin/edit_product_variety/{id}', [AdminController::class, 'editProductVariety']);

    Route::get('admin/delete_product_variety/{id}', [AdminController::class, 'deleteProductVariety']);

    Route::get('admin/accounts', [AdminController::class, 'accounts']);

    Route::get('admin/wages', [AdminController::class, 'wages']);

    Route::get('admin/add_account', [AdminController::class, 'addAccount']);

    Route::post('admin/add_account', [AdminController::class, 'saveAccount']);

    Route::get('admin/edit_account/{id}', [AdminController::class, 'editAccount']);

    Route::post('admin/update_account/{id}', [AdminController::class, 'updateAccount']);

    Route::post('admin/wages', [AdminController::class, 'addWages']);

    Route::get('admin/invoice', [AdminController::class, 'invoice']);

    Route::get('admin/pdf', [AdminController::class, 'pdf']);

    Route::post('admin/pdf', [AdminController::class, 'pdf']);

    Route::get('admin/generate_pdf', [ManagerController::class, 'generatePDF']);

    Route::get('admin/profile/{id}', [AdminController::class, 'profile']);

    Route::get('admin/filter-dashboard/from={from}&to={to}', [AdminController::class, 'dashboardFilter']);

    Route::get('admin/filter-diary/{date}', [AdminController::class, 'filterDiary']);

    Route::get('admin/filter-picker/from={fromdate}&to={todate}', [AdminController::class, 'filterPicker']);

    Route::get('admin/filter-packer/from={fromdate}&to={todate}', [AdminController::class, 'filterPacker']);

    Route::get('admin/filter-fruits/from={fromdate}&to={todate}', [AdminController::class, 'filterFruits']);

/////////////------Packer Panel Start---------------------------------------------------------->
    Route::get('packer/packer_dashboard', [PackerController::class, 'index']);

    Route::get('packer/received_work', [PackerController::class, 'receivedWork']);

    Route::get('packer/workdiary', [PackerController::class, 'work']);

    Route::get('packer/add_work', [PackerController::class, 'addWork']);

    Route::post('packer/add_work', [PackerController::class, 'addWork']);

    Route::get('packer/edit_work/{id}', [PackerController::class, 'editWork']);

    Route::post('packer/update_work/{id}', [PackerController::class, 'editWork']);

    Route::get('packer/delete_work/{id}', [PackerController::class, 'deleteWork']);

    Route::get('packer/profile/{id}', [PackerController::class, 'profile']);

    Route::get('packer/filter-work-diary/from={fromdate}&to={todate}', [PackerController::class, 'filterWorkDiary']);
/////////////------Packer Panel End---------------------------------------------------------->
////////////-------Manager Panel Start------------------------------------------------------->
    Route::get('manager/manager_dashboard', [ManagerController::class, 'index']);

    Route::get('manager/fruits', [ManagerController::class, 'fruits']);

    Route::get('manager/received_fruits', [ManagerController::class, 'receivedFruits']);

    Route::get('manager/sorted_fruits', [ManagerController::class, 'sortedFruits']);

    Route::get('manager/add_fruit', [ManagerController::class, 'addFruit']);

    Route::post('manager/add_fruit', [ManagerController::class, 'addFruit'])->name('addFruit');

    Route::get('manager/edit_fruit/{id}', [ManagerController::class, 'editFruit']);

    Route::post('manager/edit_fruit/{id}', [ManagerController::class, 'editFruit'])->name('editFruit');

    Route::get('manager/delete_sorted_fruit/{id}', [ManagerController::class, 'deleteSortedFruit']);

    Route::get('manager/profile/{id}', [ManagerController::class, 'profile']);

    Route::get('manager/sort_fruit', [ManagerController::class, 'fruitToSort']);

    Route::post('manager/sort_fruit', [ManagerController::class, 'fruitToSort']);

    Route::get('manager/fruit_sort', [ManagerController::class, 'sortFruit']);

    Route::post('manager/fruit_sort', [ManagerController::class, 'sortFruit'])->name('sortFruit');

    Route::get('manager/invoice', [ManagerController::class, 'invoice']);

    Route::get('manager/pdf', [ManagerController::class, 'pdf']);

    Route::post('manager/pdf', [ManagerController::class, 'pdf']);

    Route::get('manager/generate_pdf', [ManagerController::class, 'generatePDF']);

    Route::get('manager/filter-fruits/from={fromdate}&to={todate}', [ManagerController::class, 'filterFruits']);

    Route::get('manager/filter-received-fruits/from={fromdate}&to={todate}', [ManagerController::class, 'filterReceivedFruits']);

///////////-------Manager Panel End---------------------------------------------------------->
});

//Pickers Routes
Route::group(['middleware' => ['VerifyPicker']], function () {

    Route::get('picker/dashboard', [PickerController::class, 'index']);

    Route::get('picker/add_fruit', [PickerController::class, 'addFruit']);

    Route::post('picker/add_fruit', [PickerController::class, 'addFruit']);

    Route::get('picker/resetdate', [PickerController::class, 'resetDate']);

    Route::get('picker/profile/{id}', [PickerController::class, 'profile']);

    Route::get('picker/edit_fruit/{id}', [PickerController::class, 'editFruit']);

    Route::post('picker/update_fruit/{id}', [PickerController::class, 'updateFruit']);

    Route::get('picker/delete_fruit/{id}', [PickerController::class, 'deleteFruit']);

    Route::get('picker/filter-fruits/from={fromdate}&to={todate}', [PickerController::class, 'filterFruits']);
});

//Packers Routes
// Route::group(['middleware' => ['VerifyPacker']], function () {

   
// });

// //Manager Routes
// Route::group(['middleware' => ['VerifyManager']], function () {

   
// });
