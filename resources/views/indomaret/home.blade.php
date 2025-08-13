<x-app-layout>
    <x-slot name="header">
        <div class="justify-between flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Indomaret') }}

            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="item-center justify-center">
                        <h2 class="text-xl font-bold">Buat Transaksi Indomaret</h2>
                    </div>
                    <!-- Tombol buka popup -->
                    <button id="openModal" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tambah
                        Transaksi</button>

                    <!-- Modal -->
                    <div id="modal"
                        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
                            <h2 class="text-lg font-bold mb-4">Tambah Transaksi</h2>

                            <form id="transaksiForm" data-mode="add" data-edit-index="">
                                @csrf
                                <div class="mb-3">
                                    <label class="block text-sm text-gray-700">Nama Barang</label>
                                    <input type="text" id="nama_barang"
                                        class="w-full border border-gray-300 rounded px-3 py-2" required>
                                </div>
                                <div class="mb-3">
                                    <label class="block text-sm text-gray-700">Qty</label>
                                    <input type="number" id="qty"
                                        class="w-full border border-gray-300 rounded px-3 py-2" required>
                                </div>
                                <div class="mb-3">
                                    <label class="block text-sm text-gray-700">Harga</label>
                                    <input type="number" id="harga"
                                        class="w-full border border-gray-300 rounded px-3 py-2" required>
                                </div>
                                <div class="flex justify-end gap-2 mt-4">
                                    <button type="button" id="closeModal"
                                        class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                                    <button type="submit"
                                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <table class="table-auto w-full mt-4 border overflow-x-auto">
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
                        <tbody id="dataTable">
                            <!-- Data transaksi akan dirender di sini -->
                        </tbody>
                    </table>
                    <button id="submitBtn" class="bg-green-600 text-white px-4 py-2 mt-4 rounded hover:bg-green-700">
                        Submit Transaksi
                    </button>

                    <!-- Area struk, sembunyikan dulu -->
                    <div id="strukArea" style="display: none; width: 280px; font-size: 12px;">
                        <div style="text-align: center;">
                            <strong>PT. Pilar Citra Sejati</strong><br>
                            Jl. Raya ABC No. 123<br>
                            Bandung<br>
                            ==============================<br>
                        </div>

                        <div id="strukBody"></div>

                        ==============================<br>
                        <div style="text-align: center;">
                            Terima kasih<br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
