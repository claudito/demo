<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::inertia('/', 'Welcome', [
    'canRegister' => Features::enabled(Features::registration()),
])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
    Route::get('users', function () {
        return Inertia::render('Users/Index', [
            'users' => User::query()
                ->select('id', 'name', 'email', 'created_at')
                ->orderBy('name')
                ->get(),
        ]);
    })->name('users.index');
});

require __DIR__.'/settings.php';
