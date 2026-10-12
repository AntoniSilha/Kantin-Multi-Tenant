<?php

use App\Models\Tenant;
use Illuminate\Support\Facades\Route;

/**
 * Konteks OPERATOR TENANT (internal). Prefix: tenant/{tenant:slug}, name: tenant.*
 * Grup (middleware auth+verified+tenant/SetTenantContext + scopeBindings) didefinisikan tunggal di
 * PortalRoutes::tenant(); route fitur ditambahkan modul di app/Modules/{Modul}/routes/tenant.php.
 */
Route::get('/dashboard', function (Tenant $tenant) {
    $menus = $tenant->menus()
        ->orderBy('name')
        ->get(['id', 'tenant_id', 'name', 'base_price', 'stock_qty', 'is_available']);

    $menuSummary = [
        'total' => $menus->count(),
        'available' => $menus->where('is_available', true)->count(),
    ];

    return view('tenant.dashboard', compact('tenant', 'menus', 'menuSummary'));
})->name('dashboard');
