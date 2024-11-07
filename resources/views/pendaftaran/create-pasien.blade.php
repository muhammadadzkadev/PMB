<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    <h2 class="text-2xl font-semibold text-teal-700 mb-6">{{ __('Buat Pasien Baru') }}</h2>

                    <form action="{{ route('pendaftaran.store-pasien') }}" method="POST" id="createPatientForm">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="no_dokumen_rm" class="block text-sm font-medium text-teal-700">No. Dokumen RM</label>
                                <input type="text" name="no_dokumen_rm" id="no_dokumen_rm" class="mt-1 focus:ring-teal-500 focus:border-teal-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md bg-gray-100" value="- Otomatis -" readonly>
                            </div>
                            <div>
                                <label for="nama" class="block text-sm font-medium text-teal-700">Nama</label>
                                <input type="text" name="nama" id="nama" class="mt-1 focus:ring-teal-500 focus:border-teal-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            </div>
                            <div>
                                <label for="nik" class="block text-sm font-medium text-teal-700">NIK</label>
                                <input type="text" name="nik" id="nik" class="mt-1 focus:ring-teal-500 focus:border-teal-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required pattern="\d*" title="Hanya angka yang diperbolehkan">
                            </div>
                            <div>
                                <label for="no_kk" class="block text-sm font-medium text-teal-700">No. KK</label>
                                <input type="text" name="no_kk" id="no_kk" class="mt-1 focus:ring-teal-500 focus:border-teal-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required pattern="\d*" title="Hanya angka yang diperbolehkan">
                            </div>
                            <div>
                                <label for="penjamin" class="block text-sm font-medium text-teal-700">Penjamin</label>
                                <select name="penjamin" id="penjamin" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" required>
                                    <option value="">- Pilih -</option>
                                    <option>Umum</option>
                                    <option>BPJS</option>
                                </select>
                            </div>
                            <div>
                                <label for="golongan_darah" class="block text-sm font-medium text-teal-700">Golongan Darah</label>
                                <select name="golongan_darah" id="golongan_darah" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" required>
                                    <option value="">- Pilih -</option>
                                    <option>A</option>
                                    <option>B</option>
                                    <option>AB</option>
                                    <option>O</option>
                                </select>
                            </div>
                            <div>
                                <label for="no_hp" class="block text-sm font-medium text-teal-700">No. HP</label>
                                <input type="text" name="no_hp" id="no_hp" class="mt-1 focus:ring-teal-500 focus:border-teal-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required pattern="\d*" title="Hanya angka yang diperbolehkan">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-teal-700">E-mail</label>
                                <input type="email" name="email" id="email" class="mt-1 focus:ring-teal-500 focus:border-teal-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-teal-700">Jenis Kelamin</label>
                                <div class="mt-2 space-y-2">
                                    <div class="flex items-center">
                                        <input id="laki-laki" name="jenis_kelamin" type="radio" value="L" class="focus:ring-teal-500 h-4 w-4 text-teal-600 border-gray-300" required>
                                        <label for="laki-laki" class="ml-3 block text-sm font-medium text-gray-700">Laki-laki</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input id="perempuan" name="jenis_kelamin" type="radio" value="P" class="focus:ring-teal-500 h-4 w-4 text-teal-600 border-gray-300" required>
                                        <label for="perempuan" class="ml-3 block text-sm font-medium text-gray-700">Perempuan</label>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label for="agama" class="block text-sm font-medium text-teal-700">Agama</label>
                                <select name="agama" id="agama" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" required>
                                    <option value="">- Pilih -</option>
                                    <option>Islam</option>
                                    <option>Kristen</option>
                                    <option>Katolik</option>
                                    <option>Hindu</option>
                                    <option>Buddha</option>
                                    <option>Konghucu</option>
                                </select>
                            </div>
                            <div>
                                <label for="tempat_lahir" class="block text-sm font-medium text-teal-700">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="mt-1 focus:ring-teal-500 focus:border-teal-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            </div>
                            <div>
                                <label for="tanggal_lahir" class="block text-sm font-medium text-teal-700">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="mt-1 focus:ring-teal-500 focus:border-teal-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            </div>
                            <div>
                                <label for="pendidikan" class="block text-sm font-medium text-teal-700">Pendidikan</label>
                                <select name="pendidikan" id="pendidikan" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" required>
                                    <option value="">- Pilih -</option>
                                    <option>Belum Sekolah</option>
                                    <option>SD</option>
                                    <option>SMP</option>
                                    <option>SMA</option>
                                    <option>D3</option>
                                    <option>S1</option>
                                    <option>S2</option>
                                    <option>S3</option>
                                </select>
                            </div>
                            <div>
                                <label for="status_perkawinan" class="block text-sm font-medium text-teal-700">Status Perkawinan</label>
                                <select name="status_perkawinan" id="status_perkawinan" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" required>
                                    <option value="">- Pilih -</option>
                                    <option>Belum Kawin</option>
                                    <option>Kawin</option>
                                    <option>Cerai Hidup</option>
                                    <option>Cerai Mati</option>
                                </select>
                            </div>
                            <div>
                                <label for="pekerjaan" class="block text-sm font-medium text-teal-700">Pekerjaan</label>
                                <input type="text" name="pekerjaan" id="pekerjaan" class="mt-1 focus:ring-teal-500 focus:border-teal-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            </div>
                            <div>
                                <label for="instansi" class="block text-sm font-medium text-teal-700">Instansi</label>
                                <input type="text" name="instansi" id="instansi" class="mt-1 focus:ring-teal-500 focus:border-teal-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            </div>
                            <div id="pekerjaan_suami_container" style="display: none;">
                                <label for="pekerjaan_suami" class="block text-sm font-medium text-teal-700">Pekerjaan Suami</label>
                                <input type="text" name="pekerjaan_suami" id="pekerjaan_suami" class="mt-1 focus:ring-teal-500 focus:border-teal-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>

                        <div class="mt-8">
                            <h3 class="text-lg font-medium text-teal-700 mb-4">Alamat Tempat Tinggal</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="provinsi" class="block text-sm font-medium text-teal-700">Propinsi</label>
                                    <input type="text" name="provinsi" id="provinsi" class="mt-1 focus:ring-teal-500 focus:border-teal-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                </div>
                                <div>
                                    <label for="kota" class="block text-sm font-medium text-teal-700">Kota/Kab</label>
                                    <input type="text" name="kota" id="kota" class="mt-1 focus:ring-teal-500 focus:border-teal-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                </div>
                                <div>
                                    <label for="kecamatan" class="block text-sm font-medium text-teal-700">Kecamatan</label>
                                    <input type="text" name="kecamatan" id="kecamatan" class="mt-1 focus:ring-teal-500 focus:border-teal-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                </div>
                                <div>
                                    <label for="kelurahan" class="block text-sm font-medium text-teal-700">Kelurahan/Desa</label>
                                    <input type="text" name="kelurahan" id="kelurahan" class="mt-1 focus:ring-teal-500 focus:border-teal-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                </div>
                                <div class="md:col-span-2">
                                    <label for="alamat" class="block text-sm font-medium text-teal-700">Alamat</label>
                                    <textarea name="alamat" id="alamat" rows="3" class="mt-1 focus:ring-teal-500 focus:border-teal-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required></textarea>
                                </div>
                                <div>
                                    <label for="rt" class="block text-sm font-medium text-teal-700">RT</label>
                                    <input type="text" name="rt" id="rt" class="mt-1 focus:ring-teal-500 focus:border-teal-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required pattern="\d*" title="Hanya angka yang diperbolehkan">
                                </div>
                                <div>
                                    <label for="rw" class="block text-sm font-medium text-teal-700">RW</label>
                                    <input type="text" name="rw" id="rw" class="mt-1 focus:ring-teal-500 focus:border-teal-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required pattern="\d*" title="Hanya angka yang diperbolehkan">
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-between">
                            <a href="{{ route('pendaftaran.pasien-kk') }}" class="inline-flex justify-center py-2 px-4 border border-teal-300 shadow-sm text-sm font-medium rounded-md text-teal-700 bg-white hover:bg-teal-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition duration-150 ease-in-out">
                                Kembali
                            </a>
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition duration-150 ease-in-out">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('createPatientForm');
            const pekerjaanSuamiContainer = document.getElementById('pekerjaan_suami_container');
            const jenisKelaminInputs = document.querySelectorAll('input[name="jenis_kelamin"]');
            const statusPerkawinanSelect = document.getElementById('status_perkawinan');

            function updatePekerjaanSuamiVisibility() {
                const jenisKelamin = document.querySelector('input[name="jenis_kelamin"]:checked')?.value;
                const statusPerkawinan = statusPerkawinanSelect.value;

                if (jenisKelamin === 'P' && statusPerkawinan === 'Kawin') {
                    pekerjaanSuamiContainer.style.display = 'block';
                    document.getElementById('pekerjaan_suami').required = true;
                } else {
                    pekerjaanSuamiContainer.style.display = 'none';
                    document.getElementById('pekerjaan_suami').required = false;
                    document.getElementById('pekerjaan_suami').value = '-';
                }
            }

            jenisKelaminInputs.forEach(input => {
                input.addEventListener('change', updatePekerjaanSuamiVisibility);
            });

            statusPerkawinanSelect.addEventListener('change', updatePekerjaanSuamiVisibility);

            form.addEventListener('submit', function(event) {
                if (pekerjaanSuamiContainer.style.display === 'none') {
                    document.getElementById('pekerjaan_suami').value = '-';
                }
            });

            updatePekerjaanSuamiVisibility();
        });
    </script>
</x-app-layout>