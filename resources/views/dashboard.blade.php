<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="item-center justify-center">
                        <h2 class="text-xl font-bold">Pilih transaksi yang ingin anda buat</h2>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
                        <!-- Card Indomaret -->
                        <div class="bg-white shadow-md rounded-xl p-6 flex flex-col justify-between">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800 mb-2">Indomaret</h2>
                                <p class="text-sm text-gray-500">Transaksi kebutuhan harian</p>
                            </div>
                            <a href="{{ route('indomaret.index') }}"
                                class="mt-4 inline-block bg-blue-600 text-white text-sm font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                                Mulai Transaksi
                            </a>
                        </div>

                        <!-- Card SPBU -->
                        <div class="bg-white shadow-md rounded-xl p-6 flex flex-col justify-between">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800 mb-2">SPBU</h2>
                                <p class="text-sm text-gray-500">Pencatatan BBM dan solar</p>
                            </div>
                            <a href="{{ route('pertamina.index') }}"
                                class="mt-4 inline-block bg-green-600 text-white text-sm font-semibold py-2 px-4 rounded-lg hover:bg-green-700 transition">
                                Mulai Transaksi
                            </a>
                        </div>

                        <!-- Card Supermarket -->
                        <div class="bg-white shadow-md rounded-xl p-6 flex flex-col justify-between">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800 mb-2">Alfamart</h2>
                                <p class="text-sm text-gray-500">Penjualan barang kebutuhan pokok</p>
                            </div>
                            <a href="{{ route('alfamart.index') }}"
                                class="mt-4 inline-block bg-yellow-500 text-white text-sm font-semibold py-2 px-4 rounded-lg hover:bg-yellow-600 transition">
                                Mulai Transaksi
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
