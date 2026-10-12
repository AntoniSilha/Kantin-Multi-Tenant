<x-layouts.admin title="Dashboard">
    <div class="flex flex-wrap items-baseline justify-between gap-3">
        <div>
            <h1 class="text-xl font-semibold">Dashboard Pengelola</h1>
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                {{ $canteen?->name ?? 'Belum terhubung ke kantin' }}
            </p>
        </div>
        @if ($canteen)
            <div class="text-sm text-zinc-600 dark:text-zinc-300">
                {{ $tenants->count() }} tenant - {{ $tableSummary['active'] }}/{{ $tableSummary['total'] }} meja aktif
            </div>
        @endif
    </div>

    <div class="mt-6 overflow-x-auto rounded-xl border border-zinc-200 dark:border-zinc-800">
        <table class="w-full min-w-[40rem] text-left text-sm">
            <thead class="bg-zinc-100 text-zinc-600 dark:bg-zinc-800 dark:text-zinc-300">
                <tr>
                    <th class="px-4 py-2">Tenant</th>
                    <th class="px-4 py-2">Operator</th>
                    <th class="px-4 py-2">Menu</th>
                    <th class="px-4 py-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tenants as $tenant)
                    @php($owner = $tenant->tenantRoles->first()?->user)
                    <tr class="border-t border-zinc-200 dark:border-zinc-800">
                        <td class="px-4 py-3 font-medium">
                            {{ $tenant->display_name }}
                            <span class="ms-1 font-mono text-xs text-zinc-500">{{ $tenant->code }}</span>
                        </td>
                        <td class="px-4 py-3">{{ $owner?->name ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $tenant->active_menus_count }}/{{ $tenant->menus_count }} tersedia</td>
                        <td class="px-4 py-3">
                            <x-status-badge :status="$tenant->status === 'active' ? 'active' : 'default'">
                                {{ $tenant->status === 'active' ? 'AKTIF' : 'NONAKTIF' }}
                            </x-status-badge>
                        </td>
                    </tr>
                @empty
                    <tr class="border-t border-zinc-200 dark:border-zinc-800">
                        <td class="px-4 py-3" colspan="4">
                            <x-empty-state title="Belum ada tenant" description="Daftarkan tenant pertama dari menu Tenant & Komisi." />
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts.admin>
