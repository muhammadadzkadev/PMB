<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <div class="flex items-center gap-4">
                            <a href="{{ route('rekam-medis.index') }}" class="inline-flex items-center px-4 py-2 border border-teal-300 bg-white hover:bg-teal-50 text-teal-700 rounded-lg transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Kembali
                            </a>
                            <h2 class="text-2xl font-bold text-teal-700">{{ __('Detail Rekam Medis Pasien') }}</h2>
                        </div>
                        <div x-data="{ showFilters: false }">
                            <div class="flex gap-2">
                                <button @click="showFilters = !showFilters" class="inline-flex items-center px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white rounded-lg transition duration-150 ease-in-out">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                                    </svg>
                                    Filter
                                </button>
                                <a href="#" onclick="submitExport()" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition duration-150 ease-in-out">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Export PDF
                                </a>
                            </div>

                            <!-- Filter Panel -->
                            <div x-show="showFilters" 
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 transform scale-95"
                                 x-transition:enter-end="opacity-100 transform scale-100"
                                 x-transition:leave="transition ease-in duration-200"
                                 x-transition:leave-start="opacity-100 transform scale-100"
                                 x-transition:leave-end="opacity-0 transform scale-95"
                                 class="absolute right-0 mt-2 w-72 bg-white rounded-lg shadow-xl p-4 z-10">
                                <form id="filterForm">
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Rentang Waktu</label>
                                        <select name="date_range" class="w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200">
                                            <option value="all">Semua Data</option>
                                            <option value="7">7 Hari Terakhir</option>
                                            <option value="30">30 Hari Terakhir</option>
                                            <option value="365">1 Tahun Terakhir</option>
                                        </select>
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Poli</label>
                                        <div class="space-y-2">
                                            <div class="flex items-center">
                                                <input type="checkbox" id="select_all" class="rounded border-gray-300 text-teal-600 shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50" onchange="toggleAllPoli(this)">
                                                <label for="select_all" class="ml-2 text-sm text-gray-700">Pilih Semua</label>
                                            </div>
                                            <div class="flex items-center">
                                                <input type="checkbox" name="poli[]" value="1" class="poli-checkbox rounded border-gray-300 text-teal-600 shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50">
                                                <label class="ml-2 text-sm text-gray-700">Poli Anak</label>
                                            </div>
                                            <div class="flex items-center">
                                                <input type="checkbox" name="poli[]" value="2" class="poli-checkbox rounded border-gray-300 text-teal-600 shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50">
                                                <label class="ml-2 text-sm text-gray-700">Poli KIA</label>
                                            </div>
                                            <div class="flex items-center">
                                                <input type="checkbox" name="poli[]" value="3" class="poli-checkbox rounded border-gray-300 text-teal-600 shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50">
                                                <label class="ml-2 text-sm text-gray-700">Poli KB</label>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="bg-teal-50 p-6 rounded-lg shadow mb-8">
                        <h3 class="text-lg font-semibold text-teal-700 mb-4">Informasi Pasien</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-teal-600">No. Dokumen RM</p>
                                <p class="text-gray-900">{{ $patient->no_dokumen_rm }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-teal-600">Penjamin</p>
                                <p class="text-gray-900">{{ $patient->penjamin }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-teal-600">Nama</p>
                                <p class="text-gray-900">{{ $patient->nama }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-teal-600">NIK</p>
                                <p class="text-gray-900">{{ $patient->nik }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-teal-600">No. KK</p>
                                <p class="text-gray-900">{{ $patient->no_kk }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-teal-600">Jenis Kelamin</p>
                                <p class="text-gray-900">{{ $patient->jenis_kelamin }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-teal-600">Tempat Lahir</p>
                                <p class="text-gray-900">{{ $patient->tempat_lahir }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-teal-600">Tanggal Lahir</p>
                                <p class="text-gray-900">{{ $patient->tanggal_lahir }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-teal-600">Umur</p>
                                <p class="text-gray-900">{{ $age['years'] }} tahun {{ $age['months'] }} bulan</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-teal-600">Provinsi</p>
                                <p class="text-gray-900">{{ $patient->provinsi }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-teal-600">Kota</p>
                                <p class="text-gray-900">{{ $patient->kota }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-teal-600">Kelurahan</p>
                                <p class="text-gray-900">{{ $patient->kelurahan }}</p>
                            </div>
                            <div class="md:col-span-2">
                                <p class="text-sm font-medium text-teal-600">Alamat</p>
                                <p class="text-gray-900">{{ $patient->alamat }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-teal-700 mb-4">Rekam Medis</h3>
                        <div x-data="{ activeTab: 'anak' }">
                            <div class="mb-4">
                                <button @click="activeTab = 'anak'" :class="{ 'bg-teal-500 text-white': activeTab === 'anak', 'bg-gray-200 text-gray-700': activeTab !== 'anak' }" class="px-4 py-2 rounded-lg mr-2 transition duration-150 ease-in-out">Poli Anak</button>
                                <button @click="activeTab = 'kb'" :class="{ 'bg-teal-500 text-white': activeTab === 'kb', 'bg-gray-200 text-gray-700': activeTab !== 'kb' }" class="px-4 py-2 rounded-lg mr-2 transition duration-150 ease-in-out">Poli KB</button>
                                <button @click="activeTab = 'kia'" :class="{ 'bg-teal-500 text-white': activeTab === 'kia', 'bg-gray-200 text-gray-700': activeTab !== 'kia' }" class="px-4 py-2 rounded-lg transition duration-150 ease-in-out">Poli KIA</button>
                            </div>

                            <div x-show="activeTab === 'anak'">
                                @include('rekam-medis.partials.anak-table', ['records' => $anakRecords])
                            </div>

                            <div x-show="activeTab === 'kb'">
                                @include('rekam-medis.partials.kb-table', ['records' => $kbRecords])
                            </div>

                            <div x-show="activeTab === 'kia'">
                                @include('rekam-medis.partials.kia-table', ['records' => $kiaRecords])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleAllPoli(checkbox) {
            const poliCheckboxes = document.querySelectorAll('.poli-checkbox');
            poliCheckboxes.forEach(cb => cb.checked = checkbox.checked);
        }

        function updateSelectAllCheckbox() {
            const poliCheckboxes = document.querySelectorAll('.poli-checkbox');
            const selectAllCheckbox = document.getElementById('select_all');
            const allChecked = Array.from(poliCheckboxes).every(cb => cb.checked);
            const noneChecked = Array.from(poliCheckboxes).every(cb => !cb.checked);
            selectAllCheckbox.checked = allChecked;
            selectAllCheckbox.indeterminate = !allChecked && !noneChecked;
        }

        document.querySelectorAll('.poli-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', updateSelectAllCheckbox);
        });

        function submitExport() {
            const form = document.getElementById('filterForm');
            const formData = new FormData(form);
            const params = new URLSearchParams(formData);
            window.location.href = `{{ route('rekam-medis.export', $patient->id) }}?${params.toString()}`;
        }
    </script>
</x-app-layout>