<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-teal-700 mb-6">{{ __('Input Rekam Medis Anak') }}</h2>

                    <div class="bg-teal-50 p-4 rounded-lg shadow-sm mb-6">
                        <h3 class="text-lg font-semibold text-teal-700 mb-2">Data Pasien</h3>
                        <p><strong>Nama:</strong> {{ $pendaftaran->patient->nama }}</p>
                        <p><strong>Tanggal Lahir:</strong> {{ $pendaftaran->patient->tanggal_lahir }}</p>
                    </div>

                    <form id="rekamMedisForm" class="mt-6">
                        @csrf
                        <input type="hidden" name="pendaftaran_id" value="{{ $pendaftaran->id }}">
                        
                        <h4 class="text-lg font-semibold text-teal-700 mb-4">Anamnesa Anak</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-teal-700">Riwayat Imunisasi</label>
                                <textarea name="riwayat_imunisasi" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500" required></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-teal-700">Riwayat Penyakit</label>
                                <textarea name="riwayat_penyakit" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500" required></textarea>
                            </div>
                        </div>

                        <h4 class="text-lg font-semibold text-teal-700 mb-4 mt-6">Rekam Medis Anak</h4>

                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-teal-700">Tanggal</label>
                                <input type="date" name="tanggal" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-teal-700">Keluhan</label>
                                <textarea name="keluhan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500" required></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-teal-700">Hasil Pemeriksaan</label>
                                <textarea name="hasil_pemeriksaan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500" required></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-teal-700">Analisa</label>
                                <textarea name="analisa" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500" required></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-teal-700">Penatalaksanaan</label>
                                <textarea name="penatalaksanaan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500" required></textarea>
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="submit" id="submitForm" class="px-4 py-2 bg-teal-500 text-white rounded hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                                Simpan Rekam Medis Anak
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

        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            submitButton.disabled = true;
            submitButton.textContent = 'Menyimpan...';

            const formData = new FormData(form);

            try {
                const response = await axios.post('{{ route("rekam-medis.anak.store", $pendaftaran) }}', formData);
                console.log('Data saved:', response.data);

                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Data rekam medis anak dan anamnesa berhasil disimpan',
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
                submitButton.textContent = 'Simpan Rekam Medis Anak';
            }
        });
    });
    </script>
</x-app-layout>