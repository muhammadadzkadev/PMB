<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-teal-700 mb-6">{{ __('Input Rekam Medis KB') }}</h2>

                    <div class="bg-teal-50 p-4 rounded-lg shadow-sm mb-6">
                        <h3 class="text-lg font-semibold text-teal-700 mb-2">Data Pasien</h3>
                        <p><strong>Nama:</strong> {{ $pendaftaran->patient->nama }}</p>
                        <p><strong>Tanggal Lahir:</strong> {{ $pendaftaran->patient->tanggal_lahir }}</p>
                    </div>

                    <form id="rekamMedisForm" class="mt-6">
                        @csrf
                        <input type="hidden" name="pendaftaran_id" value="{{ $pendaftaran->id }}">
                        
                        <h4 class="text-lg font-semibold text-teal-700 mb-4">Anamnesa KB</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-teal-700">Jumlah Anak</label>
                                <input type="number" name="jumlah_anak" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-teal-700">Usia Anak Terakhir</label>
                                <div class="relative">
                                    <input type="number" name="anak_terakhir" id="anak_terakhir" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 pr-16" required>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">Bulan</span>
                                    </div>
                                </div>
                            </div>
                            <div class="md:col-span-2 lg:col-span-1">
                                <label class="block text-sm font-medium text-teal-700">Riwayat KB Terakhir</label>
                                <textarea name="riwayat_kb_terakhir" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500" required></textarea>
                            </div>
                        </div>

                        <h4 class="text-lg font-semibold text-teal-700 mb-4 mt-6">Rekam Medis KB</h4>

                        <div class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-teal-700">Tanggal</label>
                                    <input type="date" name="tanggal" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-teal-700">Hari Terakhir Haid</label>
                                    <input type="date" name="hari_terakhir_haid" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-teal-700">Kunjungan Ulang</label>
                                    <input type="date" name="kunjungan_ulang" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500" required>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-teal-700">Keluhan</label>
                                <textarea name="keluhan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500" required></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-teal-700">Pemeriksaan</label>
                                <textarea name="pemeriksaan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500" required></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-teal-700">Analisa/Diagnosa</label>
                                <textarea name="analisa_diagnosa" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500" required></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-teal-700">Tindakan</label>
                                <textarea name="tindakan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500" required></textarea>
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="submit" id="submitForm" class="px-4 py-2 bg-teal-500 text-white rounded hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                                Simpan Rekam Medis KB
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('rekamMedisForm');
        const submitButton = document.getElementById('submitForm');
        const anakTerakhirInput = document.getElementById('anak_terakhir');

        anakTerakhirInput.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            submitButton.disabled = true;
            submitButton.textContent = 'Menyimpan...';

            const formData = new FormData(form);
            formData.set('anak_terakhir', anakTerakhirInput.value + ' Bulan');

            try {
                const response = await axios.post('{{ route("rekam-medis.kb.store", $pendaftaran) }}', formData);
                console.log('Data saved:', response.data);

                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Data rekam medis KB dan anamnesa berhasil disimpan',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '{{ route("rekam-medis.show", $pendaftaran->patient_id) }}';
                    }
                });
            } catch (error) {
                console.error('Error saving data:', error);
                
                let errorMessage = 'Unknown error';
                if (error.response?.data?.error) {
                    if (typeof error.response.data.error === 'object') {
                        errorMessage = Object.values(error.response.data.error).flat().join('\n');
                    } else {
                        errorMessage = error.response.data.error;
                    }
                }
                
                Swal.fire({
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat menyimpan data: ' + errorMessage,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            } finally {
                submitButton.disabled = false;
                submitButton.textContent = 'Simpan Rekam Medis KB';
            }
        });
    });
    </script>
</x-app-layout>