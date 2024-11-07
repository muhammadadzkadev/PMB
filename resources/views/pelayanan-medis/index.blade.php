<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-teal-700 mb-6">{{ __('Data Pelayanan Medis') }}</h2>

                    <form action="{{ route('pelayanan-medis.index') }}" method="GET" class="mb-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-4">
                            <input type="date" name="tanggal" class="border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500" value="{{ request('tanggal', date('Y-m-d')) }}">
                            <select name="poli_id" class="border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                                <option value="">- Semua Poli -</option>
                                @foreach($polis as $poli)
                                    <option value="{{ $poli->id }}" {{ request('poli_id') == $poli->id ? 'selected' : '' }}>{{ $poli->nama_poli }}</option>
                                @endforeach
                            </select>
                            <select name="status" class="border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                                <option value="">Semua Status</option>
                                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Belum Diperiksa</option>
                                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Sudah Diperiksa</option>
                            </select>
                        </div>

                        <div class="flex items-center">
                            <input type="text" name="search" placeholder="Pencarian" class="border rounded px-4 py-2 mr-2 focus:outline-none focus:ring-2 focus:ring-teal-500" value="{{ request('search') }}">
                            <button type="submit" class="px-4 py-2 bg-teal-500 text-white rounded hover:bg-teal-600 transition duration-150 ease-in-out">Cari</button>
                            <a href="{{ route('pelayanan-medis.index') }}" class="ml-2 px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition duration-150 ease-in-out">Reset</a>
                        </div>
                    </form>

                    <div class="overflow-x-auto">
                        <div class="max-h-[calc(100vh-300px)] overflow-y-auto">
                            <table class="min-w-full bg-white">
                                <thead class="bg-teal-50 sticky top-0">
                                    <tr>
                                        <th class="py-2 px-4 border text-left text-xs font-medium text-teal-700 uppercase tracking-wider">No.</th>
                                        <th class="py-2 px-4 border text-left text-xs font-medium text-teal-700 uppercase tracking-wider">Poli/Ruangan</th>
                                        <th class="py-2 px-4 border text-left text-xs font-medium text-teal-700 uppercase tracking-wider">Tanggal Daftar</th>
                                        <th class="py-2 px-4 border text-left text-xs font-medium text-teal-700 uppercase tracking-wider">NIK</th>
                                        <th class="py-2 px-4 border text-left text-xs font-medium text-teal-700 uppercase tracking-wider">Nama Pasien</th>
                                        <th class="py-2 px-4 border text-left text-xs font-medium text-teal-700 uppercase tracking-wider">Jenis Kelamin</th>
                                        <th class="py-2 px-4 border text-left text-xs font-medium text-teal-700 uppercase tracking-wider">Tempat & Tgl.Lahir</th>
                                        <th class="py-2 px-4 border text-left text-xs font-medium text-teal-700 uppercase tracking-wider">Umur</th>
                                        <th class="py-2 px-4 border text-left text-xs font-medium text-teal-700 uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($pendaftaranMedis as $index => $pendaftaran)
                                    @php
                                        $poliName = strtolower($pendaftaran->poli->nama_poli);
                                        $routeName = 'rekam-medis.input';

                                        if (str_contains($poliName, 'kia')) {
                                            $routeName = 'rekam-medis.kia.input';
                                        } elseif (str_contains($poliName, 'kb')) {
                                            $routeName = 'rekam-medis.kb.input';
                                        } elseif (str_contains($poliName, 'anak')) {
                                            $routeName = 'rekam-medis.anak.input';
                                        }

                                        $status = $pendaftaran->status ? 'Sudah Diperiksa' : 'Belum Diperiksa';
                                        $statusClass = $pendaftaran->status ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800';
                                    @endphp
                                    <tr class="{{ $pendaftaran->status ? '' : 'hover:bg-teal-50 transition duration-150 ease-in-out cursor-pointer' }}" 
                                        {{ $pendaftaran->status ? '' : 'data-href=' . route($routeName, ['pendaftaran' => $pendaftaran->id, 'poli' => $pendaftaran->poli_id]) }}>
                                        <td class="py-2 px-4 border">{{ $index + 1 }}</td>
                                        <td class="py-2 px-4 border">{{ $pendaftaran->poli->nama_poli }}</td>
                                        <td class="py-2 px-4 border">{{ $pendaftaran->tanggal_daftar }}</td>
                                        <td class="py-2 px-4 border">{{ $pendaftaran->patient->nik }}</td>
                                        <td class="py-2 px-4 border">{{ $pendaftaran->patient->nama }}</td>
                                        <td class="py-2 px-4 border">{{ $pendaftaran->patient->jenis_kelamin }}</td>
                                        <td class="py-2 px-4 border">{{ $pendaftaran->patient->tempat_lahir }}, {{ $pendaftaran->patient->tanggal_lahir }}</td>
                                        <td class="py-2 px-4 border">{{ \Carbon\Carbon::parse($pendaftaran->patient->tanggal_lahir)->age }} Tahun</td>
                                        <td class="py-2 px-4 border">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                                {{ $status }}
                                            </span>
                                        </td>
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
            const rows = document.querySelectorAll('tr[data-href]');
            rows.forEach(row => {
                row.addEventListener('click', () => {
                    window.location.href = row.dataset.href;
                });
            });
        });
    </script>
</x-app-layout>