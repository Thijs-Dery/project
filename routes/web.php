<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FaqCategoryController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecipeController;

// Redirect root to dashboard
Route::redirect('/', '/dashboard');

// Dashboard route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Group routes that require authentication
Route::middleware('auth')->group(function () {

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // FAQ routes
    Route::resource('faq-categories', FaqCategoryController::class);
    Route::resource('faqs', FaqController::class);

    // Recipe routes
    Route::resource('recipes', RecipeController::class);
    Route::post('/recipes/{id}/favorite', [RecipeController::class, 'toggleFavorite'])->name('recipes.favorite');
    Route::get('/fetch-recipes', [RecipeController::class, 'fetchAndStoreApiRecipes']);

    // Favorites route
    Route::get('/favorites', [RecipeController::class, 'favorites'])->name('favorites');
});

// Auth routes
require __DIR__.'/auth.php';

// Home route
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Database test route
Route::get('/test-db', function () {
    try {
        \DB::connection()->getPdo();
        return 'Database connection is working!';
    } catch (\Exception $e) {
        return 'Could not connect to the database. Please check your configuration. Error: ' . $e->getMessage();
    }
});

// Contact routes
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Additional FAQ routes outside of auth middleware
Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');
Route::post('/faq', [FaqController::class, 'store'])->name('faqs.store');
Route::get('/faq/{faq}/edit', [FaqController::class, 'edit'])->name('faqs.edit');
Route::patch('/faq/{faq}', [FaqController::class, 'update'])->name('faqs.update');
Route::delete('/faq/{faq}', [FaqController::class, 'destroy'])->name('faqs.destroy');

// About page route
Route::get('/about', function () {
    return view('about-extra');
})->name('about');
