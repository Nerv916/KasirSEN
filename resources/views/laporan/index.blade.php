<x-app-layout>
    <x-slot name="header">
        <div class="justify-between flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('laporan') }}

            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="item-center justify-center">
                        <h2 class="text-xl font-bold">Laporan transaksi</h2>
                    </div>
                    <h2 class="text-lg font-bold mb-2">Indomaret</h2>
                    <div class="max-h-48 overflow-y-auto border rounded">
                        <table class="min-w-full border-collapse">
                            <thead class="bg-gray-200 sticky top-0">
                                <tr>
                                    <th class="border px-2 py-1 text-left">No</th>
                                    <th class="border px-2 py-1 text-left">Nama Barang</th>
                                    <th class="border px-2 py-1 text-left">Qty</th>
                                    <th class="border px-2 py-1 text-left">Harga</th>
                                    <th class="border px-2 py-1 text-left">Total</th>
                                    <th class="border px-2 py-1 text-left">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($indomaret as $i => $item)
                                    <tr class="odd:bg-white even:bg-gray-50">
                                        <td class="border px-2 py-1">{{ $i + 1 }}</td>
                                        <td class="border px-2 py-1">{{ $item->nama_barang }}</td>
                                        <td class="border px-2 py-1">{{ $item->qty }}</td>
                                        <td class="border px-2 py-1">Rp {{ number_format($item->harga, 0, ',', '.') }}
                                        </td>
                                        <td class="border px-2 py-1">Rp {{ number_format($item->total, 0, ',', '.') }}
                                        </td>
                                        <td class="border px-2 py-1">{{ $item->created_at->format('d-m-Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <h2 class="text-lg font-bold mt-6 mb-2">Pertamina</h2>
                    <div class="max-h-48 overflow-y-auto border rounded">
                        <table class="min-w-full border-collapse">
                            <thead class="bg-gray-200 sticky top-0">
                                <tr>
                                    <th class="border px-2 py-1 text-left">No</th>
                                    <th class="border px-2 py-1 text-left">Jenis BBM</th>
                                    <th class="border px-2 py-1 text-left">Liter</th>
                                    <th class="border px-2 py-1 text-left">Harga/Liter</th>
                                    <th class="border px-2 py-1 text-left">Total</th>
                                    <th class="border px-2 py-1 text-left">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pertamina as $i => $item)
                                    <tr class="odd:bg-white even:bg-gray-50">
                                        <td class="border px-2 py-1">{{ $i + 1 }}</td>
                                        <td class="border px-2 py-1">{{ $item->jenis_bbm }}</td>
                                        <td class="border px-2 py-1">{{ $item->liter }}</td>
                                        <td class="border px-2 py-1">Rp
                                            {{ number_format($item->harga_per_liter, 0, ',', '.') }}</td>
                                        <td class="border px-2 py-1">Rp {{ number_format($item->total, 0, ',', '.') }}
                                        </td>
                                        <td class="border px-2 py-1">{{ $item->created_at->format('d-m-Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <h2 class="text-lg font-bold mt-6 mb-2">Alfamart</h2>
                    <div class="max-h-48 overflow-y-auto border rounded">
                        <table class="min-w-full border-collapse">
                            <thead class="bg-gray-200 sticky top-0">
                                <tr>
                                    <th class="border px-2 py-1 text-left">No</th>
                                    <th class="border px-2 py-1 text-left">Nama Barang</th>
                                    <th class="border px-2 py-1 text-left">Qty</th>
                                    <th class="border px-2 py-1 text-left">Harga</th>
                                    <th class="border px-2 py-1 text-left">Total</th>
                                    <th class="border px-2 py-1 text-left">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alfamart as $i => $item)
                                    <tr class="odd:bg-white even:bg-gray-50">
                                        <td class="border px-2 py-1">{{ $i + 1 }}</td>
                                        <td class="border px-2 py-1">{{ $item->nama_barang }}</td>
                                        <td class="border px-2 py-1">{{ $item->qty }}</td>
                                        <td class="border px-2 py-1">Rp {{ number_format($item->harga, 0, ',', '.') }}
                                        </td>
                                        <td class="border px-2 py-1">Rp {{ number_format($item->total, 0, ',', '.') }}
                                        </td>
                                        <td class="border px-2 py-1">{{ $item->created_at->format('d-m-Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
