<?php

use App\Models\Canteen;
use App\Models\DiningTable;
use App\Models\Tenant;
use App\Models\UserCanteenRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * Konteks PENGELOLA KANTIN (internal). Prefix: admin, name: admin.*
 * Grup (prefix/name/middleware auth+verified+role:admin) didefinisikan tunggal di PortalRoutes::admin();
 * route fitur ditambahkan oleh modul di app/Modules/{Modul}/routes/admin.php.
 * Administrasi tenant/role/komisi/rekening (Modul 5): app/Modules/Admin/routes/admin.php.
 * Policy per-aksi (TenantPolicy) diperiksa di controller modul.
 */
Route::get('/dashboard', function (Request $request) {
    $canteenId = UserCanteenRole::query()
        ->where('user_id', $request->user()?->id)
        ->whereIn('role', ['owner', 'manager', 'finance'])
        ->value('canteen_id');

    $canteen = $canteenId === null ? null : Canteen::query()->find($canteenId);
    $tenants = collect();
    $tableSummary = ['total' => 0, 'active' => 0];

    if ($canteen !== null) {
        $tenants = Tenant::query()
            ->where('canteen_id', $canteen->id)
            ->with(['tenantRoles' => fn ($query) => $query->where('role', 'owner')->with('user')])
            ->withCount([
                'menus',
                'menus as active_menus_count' => fn ($query) => $query->where('is_available', true),
            ])
            ->orderBy('display_name')
            ->get();

        $tableSummary = [
            'total' => DiningTable::query()->where('canteen_id', $canteen->id)->count(),
            'active' => DiningTable::query()->where('canteen_id', $canteen->id)->where('status', 'active')->count(),
        ];
    }

    return view('admin.dashboard', compact('canteen', 'tenants', 'tableSummary'));
})->name('dashboard');
