<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-teal-600">
                    <h2 class="text-2xl font-bold text-white">
                        {{ __('Data Rekam Medis Pasien') }}
                    </h2>
                </div>

                <div class="p-6 bg-white">
                    <div class="flex flex-wrap justify-between items-center mb-6">
                        <form action="{{ route('rekam-medis.index') }}" method="GET" class="flex w-full md:w-auto">
                            <input type="text" name="search" placeholder="Cari Nama/NIK" value="{{ request('search') }}" class="border rounded-l px-4 py-2 w-full md:w-64 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            <button type="submit" class="bg-teal-500 hover:bg-teal-600 text-white font-semibold py-2 px-4 rounded-r transition duration-150 ease-in-out">
                                Cari
                            </button>
                        </form>
                        @if(request('search'))
                            <a href="{{ route('rekam-medis.index') }}" class="mt-2 md:mt-0 text-teal-600 hover:text-teal-800 transition duration-150 ease-in-out">Reset</a>
                        @endif
                    </div>

                    <div class="overflow-x-auto bg-white rounded-lg shadow">
                        <div class="max-h-[calc(100vh-300px)] overflow-y-auto">
                            <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                                <thead>
                                    <tr class="text-left">
                                        <th class="bg-teal-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-teal-700 font-bold tracking-wider uppercase text-xs">No.</th>
                                        <th class="bg-teal-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-teal-700 font-bold tracking-wider uppercase text-xs">No. Dok. RM</th>
                                        <th class="bg-teal-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-teal-700 font-bold tracking-wider uppercase text-xs">Nama</th>
                                        <th class="bg-teal-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-teal-700 font-bold tracking-wider uppercase text-xs">NIK</th>
                                        <th class="bg-teal-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-teal-700 font-bold tracking-wider uppercase text-xs">No Asuransi</th>
                                        <th class="bg-teal-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-teal-700 font-bold tracking-wider uppercase text-xs">No HP</th>
                                        <th class="bg-teal-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-teal-700 font-bold tracking-wider uppercase text-xs">Jenis Kelamin</th>
                                        <th class="bg-teal-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-teal-700 font-bold tracking-wider uppercase text-xs">Tempat & Tgl.Lahir</th>
                                        <th class="bg-teal-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-teal-700 font-bold tracking-wider uppercase text-xs">Kelurahan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($patients as $index => $patient)
                                        <tr class="hover:bg-teal-50 cursor-pointer patient-row transition duration-150 ease-in-out" data-href="{{ route('rekam-medis.show', $patient->id) }}">
                                            <td class="border-b border-gray-200 px-6 py-4 text-gray-700">{{ $patients->firstItem() + $index }}</td>
                                            <td class="border-b border-gray-200 px-6 py-4 text-gray-700">{{ $patient->no_dokumen_rm }}</td>
                                            <td class="border-b border-gray-200 px-6 py-4 text-gray-700 font-medium">{{ $patient->nama }}</td>
                                            <td class="border-b border-gray-200 px-6 py-4 text-gray-700">{{ $patient->nik }}</td>
                                            <td class="border-b border-gray-200 px-6 py-4 text-gray-700">{{ $patient->penjamin }}</td>
                                            <td class="border-b border-gray-200 px-6 py-4 text-gray-700">{{ $patient->no_hp }}</td>
                                            <td class="border-b border-gray-200 px-6 py-4 text-gray-700">{{ $patient->jenis_kelamin }}</td>
                                            <td class="border-b border-gray-200 px-6 py-4 text-gray-700">{{ $patient->tempat_lahir }}, {{ $patient->tanggal_lahir }}</td>
                                            <td class="border-b border-gray-200 px-6 py-4 text-gray-700">{{ $patient->kelurahan }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mt-6">
                        {{ $patients->links() }}
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