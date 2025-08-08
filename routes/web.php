<?php

use App\Http\Controllers\TelegramController;
use App\Livewire\Dashboard;
use App\Livewire\Employees;
use App\Livewire\EmployeesEdit;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\WorkTimes;
use App\Livewire\WorkTimesEdit;
use Illuminate\Support\Facades\Route;

Route::post('/webhook-wf3ohocsb499v2', TelegramController::class)->name('webhook');

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('employees', Employees::class)->name('employees');
    Route::get('employees/{employee}/edit', EmployeesEdit::class)->name('employees.edit');
    Route::get('work-times', WorkTimes::class)->name('work-times');
    Route::get('work-times/{workTime}/edit', WorkTimesEdit::class)->name('work-times.edit');
    Route::get('dashboard', Dashboard::class)->name('dashboard');
});

require __DIR__.'/auth.php';
