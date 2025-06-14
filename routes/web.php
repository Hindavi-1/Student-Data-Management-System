<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\InternshipController;
use App\Http\Controllers\CourseWorkshopController;
use App\Http\Controllers\PaperPublicationController;

// use App\Http\Controllers\EmployeeController;



Route::get('/', function () {
    return view('welcome');
});

// Route::resource('employees', EmployeeController::class);


// Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
// Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->name('employees.update');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::get('/achievements/ajax', [AchievementController::class, 'index'])->name('achievements.ajax');
Route::middleware('auth')->group(function () {
    Route::get('/achievements', [AchievementController::class, 'index'])->name('achievements.index');
    Route::post('/achievements', [AchievementController::class, 'store'])->name('achievements.store');

});



Route::middleware('auth')->group(function () {
    Route::get('/internships', [InternshipController::class, 'index'])->name('internships.index');
    Route::post('/internships', [InternshipController::class, 'store'])->name('internships.store');
    Route::get('/internships/ajax', [InternshipController::class, 'index'])->name('internships.ajax');
    Route::get('/internships/{id}', action: [InternshipController::class, 'show'])->name('internships.show');

    Route::put('/internships/{id}', [InternshipController::class, 'update'])->name('internships.update');
    //Route::delete('/internships/{id}', [InternshipController::class, 'destroy'])->name('internships.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('internships', InternshipController::class);
});
Route::get('/dashboard/{id}', [InternshipController::class, 'destroy'])->name('internships.destroy');




Route::resource('courses_workshops', CourseWorkshopController::class)->middleware('auth');
Route::get('/courses_workshops', [CourseWorkshopController::class, 'index'])->name('courses_workshops.index');
Route::get('/dashboard/{id}', [CourseWorkshopController::class, 'destroy'])->name('courses_workshops.destroy');





Route::middleware(['auth'])->group(function () {
    Route::resource('paper-publications', PaperPublicationController::class);
});
Route::get('/paper_publications', [PaperPublicationController::class, 'index'])->name('paper_publications.index');
Route::get('/dashboard/{id}', [PaperPublicationController::class, 'destroy'])->name('paper_publications.destroy');
Route::get('/paper_publications/{id}', action: [PaperPublicationController::class, 'show'])->name('paper_publications.show');




require __DIR__.'/auth.php';





