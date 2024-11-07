<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-teal-700 mb-2">{{ $patient->nama }}</h2>
                        <p class="text-gray-600">No. Dokumen RM: {{ $patient->no_dokumen_rm }}</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <div class="bg-teal-50 p-6 rounded-lg shadow">
                            <h3 class="text-lg font-semibold text-teal-700 mb-4">Informasi Pribadi</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-teal-600">NIK</label>
                                    <p class="mt-1 text-gray-900 font-semibold">{{ $patient->nik }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-teal-600">No. KK</label>
                                    <p class="mt-1 text-gray-900 font-semibold">{{ $patient->no_kk }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-teal-600">Jenis Kelamin</label>
                                    <p class="mt-1 text-gray-900 font-semibold">{{ $patient->jenis_kelamin }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-teal-600">Golongan Darah</label>
                                    <p class="mt-1 text-gray-900 font-semibold">{{ $patient->golongan_darah }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-teal-600">Tempat & Tanggal Lahir</label>
                                    <p class="mt-1 text-gray-900 font-semibold">{{ $patient->tempat_lahir }}, {{ $patient->tanggal_lahir }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-teal-600">Provinsi</label>
                                    <p class="mt-1 text-gray-900 font-semibold">{{ $patient->provinsi }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-teal-600">Kota</label>
                                    <p class="mt-1 text-gray-900 font-semibold">{{ $patient->kota }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-teal-600">RT/RW</label>
                                    <p class="mt-1 text-gray-900 font-semibold">{{ $patient->rt }}/{{ $patient->rw }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-teal-600">Pekerjaan</label>
                                    <p class="mt-1 text-gray-900 font-semibold">{{ $patient->pekerjaan }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-teal-600">Agama</label>
                                    <p class="mt-1 text-gray-900 font-semibold">{{ $patient->agama }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-teal-600">Pendidikan</label>
                                    <p class="mt-1 text-gray-900 font-semibold">{{ $patient->pendidikan }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-teal-600">Status</label>
                                    <p class="mt-1 text-gray-900 font-semibold">{{ $patient->status_perkawinan }}</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-teal-600">Alamat</label>
                                <p class="mt-1 text-gray-900 font-semibold">{{ $patient->alamat }}</p>
                            </div>
                        </div>

                        <div class="bg-teal-50 p-6 rounded-lg shadow">
                            <h3 class="text-lg font-semibold text-teal-700 mb-4">Informasi Kontak</h3>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-teal-600">Email</label>
                                <p class="mt-1 text-gray-900 font-semibold">{{ $patient->email }}</p>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-teal-600">No. HP</label>
                                <p class="mt-1 text-gray-900 font-semibold">{{ $patient->no_hp }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-teal-600">Penjamin</label>
                                <p class="mt-1 text-gray-900 font-semibold">{{ $patient->penjamin }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex flex-col sm:flex-row justify-between items-center">
                        <a href="{{ route('pendaftaran.pasien-kk') }}" class="mb-4 sm:mb-0 bg-white hover:bg-teal-50 text-teal-700 font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out border border-teal-300 focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali
                        </a>
                        <div class="flex flex-wrap justify-center sm:justify-end space-y-2 sm:space-y-0 sm:space-x-2">
                            <a href="{{ route('pendaftaran.create', $patient->id) }}" class="w-full sm:w-auto bg-teal-600 hover:bg-teal-700 text-white font-semibold focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 py-2 px-4 rounded-md transition duration-300 ease-in-out">
                                <i class="fas fa-user-plus mr-2"></i> Pendaftaran
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>