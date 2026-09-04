<?php

namespace App\Modules\Ordering;

use Illuminate\Support\ServiceProvider;

final class OrderingServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Binding kontrak -> implementasi ditambahkan saat modul diimplementasikan.
    }

    public function boot(): void
    {
        //
    }
}
