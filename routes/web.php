<?php
/*
 * @Author: Agung Martono
 * @Github: https://github.com/agungmartono
 * @Email: agungmartonolabs@gmail.com
 */

use App\Http\Controllers\Backend\DoctorController;
use App\Http\Controllers\Backend\Pages\DashboardController;
use App\Http\Controllers\Backend\RegistrationController;
use App\Http\Controllers\Backend\RoomController;
use App\Http\Controllers\Backend\PatientController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('dashboard');
});

Route::middleware('auth')->group(function(){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('rooms/installation/{type}', [RoomController::class, 'getInstallation']);
    Route::resource('rooms', RoomController::class);
    Route::resource('doctors', DoctorController::class);
    Route::resource('patients', PatientController::class);
    
    Route::controller(RegistrationController::class)
        ->name('registration_patients.')
        ->group(function () {
            Route::get('registration-patients', 'index')->name('index');
            Route::get('registration-patients/create', 'create')->name('create');
            Route::post('registration-patients/', 'store')->name('store');
            Route::get('registration-patients/{id}/edit', 'edit')->name('edit');
            Route::put('registration-patients/{id}/', 'update')->name('update');
            Route::delete('registration-patients/{id}', 'destroy')->name('destroy');
            Route::get('registration-patients/{id}/patient-old', 'oldPatient')->name('old_patient');
            Route::post('registration-patients/patient-old', 'registration_patient_old')->name('registration_patient_old');
        });
});

Route::get('/home', function(){
    return redirect('dashboard');
});

Route::get('logout', function(){
    \Auth::logout();
    return redirect('login');
});