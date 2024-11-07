<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white">
                    <h2 class="text-2xl font-semibold text-teal-700 mb-6">{{ __('Data Pasien dan Kartu Keluarga') }}</h2>
                    
                    <div class="flex flex-wrap justify-between mb-4">
                        <div>
                            <a href="{{ route('pendaftaran.create-pasien') }}" class="bg-teal-500 hover:bg-teal-600 text-white font-semibold py-2 px-4 rounded transition duration-150 ease-in-out">
                                Buat Pasien Baru
                            </a>
                        </div>
                        <div class="flex items-center">
                            <form action="{{ route('pendaftaran.pasien-kk') }}" method="GET" class="flex">
                                <input type="text" name="search" placeholder="Cari Nama/NIK" value="{{ request('search') }}" class="border rounded-l px-4 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                                <button type="submit" class="bg-teal-500 hover:bg-teal-600 text-white font-semibold py-2 px-4 rounded-r transition duration-150 ease-in-out">
                                    Cari
                                </button>
                            </form>
                            @if(request('search'))
                                <a href="{{ route('pendaftaran.pasien-kk') }}" class="ml-2 text-teal-600 hover:text-teal-800 transition duration-150 ease-in-out">Reset</a>
                            @endif
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                            <p class="font-bold">Berhasil</p>
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                            <p class="font-bold">Error</p>
                            <p>{{ session('error') }}</p>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <div class="max-h-[calc(100vh-300px)] overflow-y-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-teal-50 sticky top-0">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-teal-700 uppercase tracking-wider">No. Dok. RM</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-teal-700 uppercase tracking-wider">Nama</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-teal-700 uppercase tracking-wider">NIK</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-teal-700 uppercase tracking-wider">Jenis Kelamin</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-teal-700 uppercase tracking-wider">Tempat & Tgl.Lahir</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-teal-700 uppercase tracking-wider">Kelurahan</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-teal-700 uppercase tracking-wider">Alamat</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($patients as $index => $patient)
                                    <tr class="hover:bg-teal-50 transition duration-150 ease-in-out cursor-pointer patient-row" data-href="{{ route('patients.show', $patient) }}">
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $patient->no_dokumen_rm }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $patient->nama }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $patient->nik }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $patient->jenis_kelamin }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $patient->tempat_lahir }}, {{ $patient->tanggal_lahir }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $patient->kelurahan }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $patient->alamat }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('.patient-row');
            rows.forEach(row => {
                row.addEventListener('click', function() {
                    window.location.href = this.dataset.href;
                });
            });
        });
    </script>
</x-app-layout>