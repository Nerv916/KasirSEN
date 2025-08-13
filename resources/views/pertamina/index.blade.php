<x-app-layout>
    <x-slot name="header">
        <div class="justify-between flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Pertamina') }}

            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="item-center justify-center">
                        <h2 class="text-xl font-bold">Buat Transaksi Pertamina</h2>
                    </div>
                    <form id="pertaminaForm">
                        <div class="mb-3">
                            <label>Jenis BBM</label>
                            <select id="jenis_bbm" class="w-full border px-2 py-1">
                                <option value="Pertalite">Pertalite</option>
                                <option value="Pertamax">Pertamax</option>
                                <option value="Dexlite">Dexlite</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Liter</label>
                            <input type="number" step="0.01" id="liter" class="w-full border px-2 py-1">
                        </div>

                        <div class="mb-3">
                            <label>Harga per Liter</label>
                            <input type="number" id="harga_per_liter" class="w-full border px-2 py-1">
                        </div>

                        <div class="mb-3">
                            <label>Total</label>
                            <input type="number" id="total" class="w-full border px-2 py-1" readonly>
                        </div>

                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Simpan & Cetak
                            Struk</button>
                    </form>

                    <!-- Struk -->
                    {{-- <div id="strukArea" style="display:none; font-size:12px; width:260px; margin-top:20px;">
                        <div style="text-align:center;">
                            <strong>PERTAMINA SPBU 34-12345</strong><br>
                            Jl. Raya ABC No. 123<br>
                            ==============================
                        </div>
                        <div id="strukBody"></div>
                        ==============================<br>
                        <div style="text-align:center;">Terima kasih</div>
                    </div> --}}

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
