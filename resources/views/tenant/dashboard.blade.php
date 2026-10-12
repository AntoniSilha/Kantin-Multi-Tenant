<x-layouts.tenant title="Dashboard">
    <div class="flex flex-wrap items-start justify-between gap-3">
        <div>
            <div class="flex items-center gap-3">
                <h1 class="text-xl font-semibold">{{ $tenant->display_name }}</h1>
                <x-status-badge :status="$tenant->status">{{ $tenant->status }}</x-status-badge>
            </div>
            <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">Slug: <span class="font-mono">{{ $tenant->slug }}</span></p>
        </div>
        <div class="text-sm text-zinc-600 dark:text-zinc-300">
            {{ $menuSummary['available'] }}/{{ $menuSummary['total'] }} menu tersedia
        </div>
    </div>

    <div class="mt-6 overflow-x-auto rounded-xl border border-zinc-200 dark:border-zinc-800">
        <table class="w-full min-w-[36rem] text-left text-sm">
            <thead class="bg-zinc-100 text-zinc-600 dark:bg-zinc-800 dark:text-zinc-300">
                <tr>
                    <th class="px-4 py-2">Menu</th>
                    <th class="px-4 py-2">Harga</th>
                    <th class="px-4 py-2">Stok</th>
                    <th class="px-4 py-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($menus as $menu)
                    <tr class="border-t border-zinc-200 dark:border-zinc-800">
                        <td class="px-4 py-3 font-medium">{{ $menu->name }}</td>
                        <td class="px-4 py-3">Rp{{ number_format($menu->base_price, 0, ',', '.') }}</td>
                        <td class="px-4 py-3">{{ $menu->stock_qty }}</td>
                        <td class="px-4 py-3">
                            <x-status-badge :status="$menu->is_available ? 'active' : 'default'">
                                {{ $menu->is_available ? 'TERSEDIA' : 'TIDAK TERSEDIA' }}
                            </x-status-badge>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-4 py-3" colspan="4">
                            <x-empty-state title="Belum ada menu" description="Menu tenant belum tersedia." />
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts.tenant>
