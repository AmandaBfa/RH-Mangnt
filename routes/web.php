<?php

use App\Http\Controllers\ColaboratorsController;
use App\Http\Controllers\ConfirmAccountController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RhUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // ------------ email confirmation and password definition ------------
    Route::get('/confirm-account/{token}', [ConfirmAccountController::class, 'confirmAccount'])->name('confirm-account');
    Route::post('/confirm-account', [ConfirmAccountController::class, 'confirmAccountSubmit'])->name('confirm-account-submit');
});

Route::middleware('auth')->group(function () {

    Route::redirect('/', 'home');
    Route::view('/home', 'home')->name('home');

    // user profile page
    Route::get('/user/profile', [ProfileController::class, 'index'])->name('user.profile');
    Route::post('/user/profile/update-password', [ProfileController::class, 'updatePassword'])->name('user.profile.update-password');
    Route::post('/user/profile/update-user-data', [ProfileController::class, 'updateUserData'])->name('user.profile.update-user-data');

    // ------------ DEPARTMENT ROUTE ------------
    Route::get('/departments', [DepartmentController::class, 'index'])->name('departments');
    // new department
    Route::get('/departments/new-department', [DepartmentController::class, 'newDepartment'])->name('departments.new-department');
    Route::post('/departments/create-department', [DepartmentController::class, 'createDepartment'])->name('departments.create-department');
    // edit department
    Route::get('/departments/edit-department/{id}', [DepartmentController::class, 'editDepartment'])->name('departments.edit-department');
    Route::post('/departments/update-department', [DepartmentController::class, 'updateDepartment'])->name('departments.update-department');
    // delete department
    Route::get('/departments/delete-department/{id}', [DepartmentController::class, 'deleteDepartment'])->name('departments.delete-department');
    Route::get('/departments/delete-department-confirm/{id}', [DepartmentController::class, 'deleteDepartmentConfirm'])->name('departments.delete-department-confirm');

    // ------------ RH COLABORATORS ROUTES ------------
    Route::get('/rh-users', [RhUserController::class, 'index'])->name('colaborators.rh-users');
    // new user
    Route::get('/rh-users/new-colaborator', [RhUserController::class, 'newColaborator'])->name('colaborators.rh.new-colaborator');
    Route::post('/rh-users/create-colaborator', [RhUserController::class, 'createRhColaborator'])->name('colaborators.rh.create-colaborator');
    // edit user
    Route::get('/rh-users/edit-colaborator/{id}', [RhUserController::class, 'editRhColaborator'])->name('colaborators.rh.edit-colaborator');
    Route::post('/rh-users/update-colaborator}', [RhUserController::class, 'updateRhColaborator'])->name('colaborators.rh.update-colaborator');
    // delete user
    Route::get('/rh-users/delete-colaborator/{id}', [RhUserController::class, 'deleteRhColaborator'])->name('colaborators.rh.delete-colaborator');
    Route::get('/rh-users/delete-confirm/{id}', [RhUserController::class, 'deleteRhColaboratorConfirm'])->name('colaborators.rh.delete-confirm');

    // ------------ ADMIN COLABORATORS LIST ------------
    Route::get('/colaborators', [ColaboratorsController::class, 'index'])->name('colaborators.all-colaborators');
    Route::get('/colaborators/details/{id}', [ColaboratorsController::class, 'showDetails'])->name('colaborators.details');

    // ------------ DELETE ADMIN COLABORATORS ------------
    Route::get('/colaborators/delete/{id}', [ColaboratorsController::class, 'deleteColaborator'])->name('colaborators.delete');
    Route::get('/colaborators/delete-confirm/{id}', [ColaboratorsController::class, 'deleteColaboratorConfirm'])->name('colaborators.delete-confirm');
});
