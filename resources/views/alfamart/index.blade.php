<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Alfamart') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="flex">
                        <h2 class="text-xl font-bold">Buat Transaksi Alfamart</h2>
                    </div>

                    <div class="container mx-auto ">
                        <button id="popUp" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah Barang</button>
                    </div>

                    <!-- Modal -->
                    <div id="modalAlfa"
                        class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center">
                        <div class="bg-white p-4 rounded w-80">
                            <h2 class="text-lg font-bold">Tambah Barang</h2>
                            <input type="text" id="nama_barang" placeholder="Nama Barang"
                                class="border w-full px-2 py-1 mt-2">
                            <input type="number" id="qty" placeholder="Qty" class="border w-full px-2 py-1 mt-2">
                            <input type="number" id="harga" placeholder="Harga"
                                class="border w-full px-2 py-1 mt-2">

                            <div class="flex justify-end gap-2 mt-4">
                                <button id="closeModal" class="px-4 py-2 bg-gray-400 rounded">Batal</button>
                                <button id="saveBarang"
                                    class="px-4 py-2 bg-green-600 text-white rounded">Simpan</button>
                            </div>
                        </div>
                    </div>

                    <table class="table-auto w-full mt-4 border">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border px-2 py-1">No</th>
                                <th class="border px-2 py-1">Nama Barang</th>
                                <th class="border px-2 py-1">Qty</th>
                                <th class="border px-2 py-1">Harga</th>
                                <th class="border px-2 py-1">Total</th>
                                <th class="border px-2 py-1">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="dataTable"></tbody>
                    </table>

                    <button id="submitBtnAlfa" class="bg-green-600 text-white px-4 py-2 mt-4 rounded">
                        Submit Transaksi
                    </button>

                    <!-- Struk -->
                    <div id="strukArea" class="hidden w-[280px] text-xs">
                        <div class="text-center">
                            <strong>ALFAMART</strong><br>
                            Jl. Contoh No.123<br>
                            Bandung<br>
                            ==============================<br>
                        </div>
                        <div id="strukBody"></div>
                        ==============================<br>
                        <div class="text-center">
                            Terima kasih<br>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
