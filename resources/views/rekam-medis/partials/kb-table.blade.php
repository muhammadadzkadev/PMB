<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-teal-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-teal-700 uppercase tracking-wider">Tanggal</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-teal-700 uppercase tracking-wider">Hari Terakhir Haid</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-teal-700 uppercase tracking-wider">Keluhan</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-teal-700 uppercase tracking-wider">Pemeriksaan</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-teal-700 uppercase tracking-wider">Analisa/Diagnosa</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-teal-700 uppercase tracking-wider">Tindakan</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-teal-700 uppercase tracking-wider">Kunjungan Ulang</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-teal-700 uppercase tracking-wider">Anamnesa</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($records as $record)
                <tr class="hover:bg-teal-50 transition duration-150 ease-in-out">
                    <td class="px-6 py-4 whitespace-nowrap">{{ $record->tanggal->format('d/m/Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $record->hari_terakhir_haid->format('d/m/Y') }}</td>
                    <td class="px-6 py-4">{{ $record->keluhan }}</td>
                    <td class="px-6 py-4">{{ $record->pemeriksaan }}</td>
                    <td class="px-6 py-4">{{ $record->analisa_diagnosa }}</td>
                    <td class="px-6 py-4">{{ $record->tindakan }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $record->kunjungan_ulang->format('d/m/Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <button 
                            type="button" 
                            class="text-teal-600 hover:text-teal-900 transition duration-150 ease-in-out"
                            onclick="showAnamnesaKB('{{ $record->id }}')"
                        >
                            Detail
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="px-6 py-4 text-center text-gray-500">Tidak ada data rekam medis untuk Poli KB</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Modal untuk detail anamnesa -->
<div id="anamnesaKBModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                    Detail Anamnesa KB
                </h3>
                <div class="mt-2" id="anamnesaKBContent">
                    <!-- Konten anamnesa akan diisi di sini -->
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="closeAnamnesaKBModal()">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function showAnamnesaKB(recordId) {
    // Fetch anamnesa data
    fetch(`/rekam-medis/kb/${recordId}/anamnesa`)
        .then(response => response.json())
        .then(data => {
            // Populate modal with anamnesa data
            let content = `
                <p><strong>Jumlah Anak:</strong> ${data.jumlah_anak}</p>
                <p><strong>Usia Anak Terakhir:</strong> ${data.anak_terakhir}</p>
                <p><strong>Riwayat KB Terakhir:</strong> ${data.riwayat_kb_terakhir}</p>
            `;
            document.getElementById('anamnesaKBContent').innerHTML = content;
            document.getElementById('anamnesaKBModal').classList.remove('hidden');
        })
        .catch(error => console.error('Error:', error));
}

function closeAnamnesaKBModal() {
    document.getElementById('anamnesaKBModal').classList.add('hidden');
}
</script>