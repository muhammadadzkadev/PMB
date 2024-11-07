<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    <h2 class="text-2xl font-semibold text-teal-700 mb-6">{{ __('Buat Pendaftaran Baru') }}</h2>

                    <form action="{{ route('pendaftaran.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-teal-600 mb-4 pb-2 border-b border-teal-200">Informasi Pasien</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="rounded-lg shadow-sm">
                                    <label for="nama" class="block text-sm font-medium text-teal-700 mb-1">Nama</label>
                                    <input type="text" id="nama" class="mt-1 block w-full bg-white border-teal-300 rounded-md shadow-sm focus:border-teal-500 focus:ring-teal-500" value="{{ $patient->nama }}" readonly>
                                </div>
                                <div class="rounded-lg shadow-sm">
                                    <label for="nik" class="block text-sm font-medium text-teal-700 mb-1">NIK</label>
                                    <input type="text" id="nik" class="mt-1 block w-full bg-white border-teal-300 rounded-md shadow-sm focus:border-teal-500 focus:ring-teal-500" value="{{ $patient->nik }}" readonly>
                                </div>
                                <div class="rounded-lg shadow-sm">
                                    <label for="jenis_kelamin" class="block text-sm font-medium text-teal-700 mb-1">Jenis Kelamin</label>
                                    <input type="text" id="jenis_kelamin" class="mt-1 block w-full bg-white border-teal-300 rounded-md shadow-sm focus:border-teal-500 focus:ring-teal-500" value="{{ $patient->jenis_kelamin }}" readonly>
                                </div>
                                <div class="rounded-lg shadow-sm">
                                    <label for="no_dokumen_rm" class="block text-sm font-medium text-teal-700 mb-1">No. Dokumen RM</label>
                                    <input type="text" id="no_dokumen_rm" class="mt-1 block w-full bg-white border-teal-300 rounded-md shadow-sm focus:border-teal-500 focus:ring-teal-500" value="{{ $patient->no_dokumen_rm }}" readonly>
                                </div>
                                <div class="rounded-lg shadow-sm">
                                    <label for="Lahir" class="block text-sm font-medium text-teal-700 mb-1">Tanggal Lahir</label>
                                    <input type="text" id="Lahir" class="mt-1 block w-full bg-white border-teal-300 rounded-md shadow-sm focus:border-teal-500 focus:ring-teal-500" value="{{ $patient->tanggal_lahir }}" readonly>
                                </div>
                                <div class="rounded-lg shadow-sm">
                                    <label for="kelurahan" class="block text-sm font-medium text-teal-700 mb-1">Kelurahan</label>
                                    <input type="text" id="kelurahan" class="mt-1 block w-full bg-white border-teal-300 rounded-md shadow-sm focus:border-teal-500 focus:ring-teal-500" value="{{ $patient->kelurahan }}" readonly>
                                </div>
                                <div class="rounded-lg shadow-sm">
                                    <label for="no_hp_pasien" class="block text-sm font-medium text-teal-700 mb-1">No HP Pasien</label>
                                    <input type="text" id="no_hp_pasien" class="mt-1 block w-full bg-white border-teal-300 rounded-md shadow-sm focus:border-teal-500 focus:ring-teal-500" value="{{ $patient->no_hp }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="mt-10">
                            <h3 class="text-lg font-semibold text-teal-600 mb-4 pb-2 border-b border-teal-200">Informasi Pendaftaran</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="tanggal_daftar" class="block text-sm font-medium text-teal-700 mb-1">Tanggal Daftar</label>
                                    <input type="date" name="tanggal_daftar" id="tanggal_daftar" class="mt-1 block w-full border-teal-300 rounded-md shadow-sm focus:border-teal-500 focus:ring-teal-500" value="{{ date('Y-m-d') }}" readonly>
                                </div>
                                <div>
                                    <label for="jenis_kunjungan" class="block text-sm font-medium text-teal-700 mb-1">Jenis Kunjungan</label>
                                    <select name="jenis_kunjungan" id="jenis_kunjungan" class="mt-1 block w-full border-teal-300 rounded-md shadow-sm focus:border-teal-500 focus:ring-teal-500" required>
                                        <option value="">Pilih Jenis Kunjungan</option>
                                        <option value="Baru">Baru</option>
                                        <option value="Lama">Lama</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="status_hamil" class="block text-sm font-medium text-teal-700 mb-1">Status Hamil/Bersalin/Nifas</label>
                                    <select name="status_hamil" id="status_hamil" class="mt-1 block w-full border-teal-300 rounded-md shadow-sm focus:border-teal-500 focus:ring-teal-500" required>
                                        <option value="">Pilih Status</option>
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="poli_id" class="block text-sm font-medium text-teal-700 mb-1">Poli / Ruangan</label>
                                    <select name="poli_id" id="poli_id" class="mt-1 block w-full border-teal-300 rounded-md shadow-sm focus:border-teal-500 focus:ring-teal-500" required>
                                        <option value="">Pilih Poli</option>
                                        @foreach($polis as $poli)
                                            <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mt-10 flex justify-between">
                            <a href="{{ route('pendaftaran.pasien-kk') }}" class="inline-flex justify-center py-2 px-4 border border-teal-300 shadow-sm text-sm font-medium rounded-md text-teal-700 bg-white hover:bg-teal-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition duration-150 ease-in-out">
                                Kembali
                            </a>
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition duration-150 ease-in-out">
                                Simpan Pendaftaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>