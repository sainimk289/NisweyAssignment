<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::get('/contact/import', [ContactController::class, 'import'])->name('contact.import');
Route::get('/', [ContactController::class, 'index'])->name('contact.index');
Route::get('/contact/edit/{id}', [ContactController::class, 'edit'])->name('contact.edit');
Route::put('/contact/update', [ContactController::class, 'update'])->name('contact.update');
Route::delete('/contact/delete/{id}', [ContactController::class, 'delete'])->name('contact.destroy');
Route::post('/contacts/import', [ContactController::class, 'importContactsFromXml'])->name('contacts.import.xml');
