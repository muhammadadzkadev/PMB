<!DOCTYPE html>
<html>
<head>
    <title>Rekam Medis - {{ $patient->nama }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #374151;
            margin: 0;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 24px;
            padding: 16px;
            background-color: #14B8A6;
            color: white;
            border-radius: 8px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .subtitle {
            font-size: 16px;
            color: #F0FDFA;
        }

        .patient-info {
            margin-bottom: 24px;
            border: 1px solid #99F6E4;
            padding: 16px;
            border-radius: 8px;
            background-color: #F0FDFA;
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 12px;
            background-color: #14B8A6;
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
        }

        .info-item {
            margin-bottom: 8px;
            padding: 4px 0;
        }

        .label {
            font-weight: 600;
            display: inline-block;
            width: 150px;
            color: #0F766E;
        }

        .visit-section {
            margin-bottom: 24px;
            page-break-inside: avoid;
            border: 1px solid #99F6E4;
            border-radius: 8px;
            overflow: hidden;
        }

        .visit-header {
            background-color: #2DD4BF;
            color: white;
            padding: 12px;
            font-weight: 500;
        }

        .record-content {
            margin: 16px;
        }

        .filter-info {
            margin-bottom: 20px;
            font-size: 11px;
            border: 1px solid #99F6E4;
            padding: 16px;
            background-color: #F0FDFA;
            border-radius: 8px;
        }

        .filter-info p {
            margin: 4px 0;
            color: #0F766E;
        }

        .filter-info strong {
            color: #0D9488;
        }

        .record-content .section-title {
            background-color: #0D9488;
            font-size: 14px;
            margin: 16px 0 12px 0;
        }

        .record-content .info-item:nth-child(even) {
            background-color: #F0FDFA;
            border-radius: 4px;
            padding: 6px 8px;
        }

        .record-content .info-item:nth-child(odd) {
            padding: 6px 8px;
        }

        .page-break {
            page-break-after: always;
        }

        @media print {
            body {
                padding: 0;
            }

            .header, 
            .patient-info, 
            .filter-info, 
            .visit-section {
                border-radius: 0;
            }

            .filter-info {
                background-color: #F9FAFB !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .header,
            .section-title,
            .visit-header {
                background-color: #14B8A6 !important;
                color: white !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .record-content .section-title {
                background-color: #0D9488 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .record-content .info-item:nth-child(even) {
                background-color: #F0FDFA !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>
<div class="header">
        <div class="title">Rekam Medis Pasien</div>
        <div class="subtitle">{{ $patient->nama }} - {{ $patient->no_dokumen_rm }}</div>
    </div>

    <div class="filter-info">
        <p><strong>Filter yang digunakan:</strong></p>
        <p>Rentang Waktu: 
            @switch($filters['date_range'])
                @case('7')
                    7 Hari Terakhir
                    @break
                @case('30')
                    30 Hari Terakhir
                    @break
                @case('365')
                    1 Tahun Terakhir
                    @break
                @default
                    Semua Data
            @endswitch
        </p>
        <p>Poli: 
            @if(empty($filters['poli']))
                Semua Poli
            @else
                @foreach($filters['poli'] as $poli)
                    @switch($poli)
                        @case(1)
                            Anak
                            @break
                        @case(2)
                            KIA
                            @break
                        @case(3)
                            KB
                            @break
                    @endswitch
                    @if(!$loop->last), @endif
                @endforeach
            @endif
        </p>
    </div>

    <div class="patient-info">
        <div class="section-title">Data Pasien</div>
        <div class="info-item">
            <span class="label">No. Dokumen RM</span>: {{ $patient->no_dokumen_rm }}
        </div>
        <div class="info-item">
            <span class="label">Nama</span>: {{ $patient->nama }}
        </div>
        <div class="info-item">
            <span class="label">NIK</span>: {{ $patient->nik }}
        </div>
        <div class="info-item">
            <span class="label">Jenis Kelamin</span>: {{ $patient->jenis_kelamin }}
        </div>
        <div class="info-item">
            <span class="label">Tanggal Lahir</span>: {{ $patient->tanggal_lahir }}
        </div>
        <div class="info-item">
            <span class="label">Alamat</span>: {{ $patient->alamat }}
        </div>
    </div>

    @foreach($rekamMedisData as $entry)
    <div class="visit-section">
        <div class="visit-header">
            <strong>Kunjungan - {{ \Carbon\Carbon::parse($entry['tanggal_daftar'])->format('d/m/Y') }}</strong><br>
            Poli: {{ $entry['poli'] }}<br>
            Jenis Kunjungan: {{ $entry['jenis_kunjungan'] }}
        </div>

        @foreach($entry['records'] as $record)
    <div class="record-content">
        @if($record['type'] === 'Anak')
            <div class="section-title">Rekam Medis Anak</div>
            <div class="info-item">
                <span class="label">Tanggal</span>: {{ \Carbon\Carbon::parse($record['rekam_medis']->tanggal)->format('d/m/Y') }}
            </div>
            <div class="info-item">
                <span class="label">Keluhan</span>: {{ $record['rekam_medis']->keluhan }}
            </div>
            <div class="info-item">
                <span class="label">Hasil Pemeriksaan</span>: {{ $record['rekam_medis']->hasil_pemeriksaan }}
            </div>
            <div class="info-item">
                <span class="label">Analisa</span>: {{ $record['rekam_medis']->analisa }}
            </div>
            <div class="info-item">
                <span class="label">Penatalaksanaan</span>: {{ $record['rekam_medis']->penatalaksanaan }}
            </div>

            <div class="section-title">Anamnesa Anak</div>
            <div class="info-item">
                <span class="label">Riwayat Imunisasi</span>: {{ $record['anamnesa']->riwayat_imunisasi }}
            </div>
            <div class="info-item">
                <span class="label">Riwayat Penyakit</span>: {{ $record['anamnesa']->riwayat_penyakit }}
            </div>

        @elseif($record['type'] === 'KIA')
            <div class="section-title">Rekam Medis KIA</div>
            <div class="info-item">
                <span class="label">Tanggal</span>: {{ \Carbon\Carbon::parse($record['rekam_medis']->tanggal)->format('d/m/Y') }}
            </div>
            <div class="info-item">
                <span class="label">TD</span>: {{ $record['rekam_medis']->td }}
            </div>
            <div class="info-item">
                <span class="label">BB</span>: {{ $record['rekam_medis']->bb }}
            </div>
            <div class="info-item">
                <span class="label">LILA</span>: {{ $record['rekam_medis']->lila }}
            </div>
            <div class="info-item">
                <span class="label">Tinggi Fundus</span>: {{ $record['rekam_medis']->tfu }}
            </div>
            <div class="info-item">
                <span class="label">Letak Janin</span>: {{ $record['rekam_medis']->letak_janin }}
            </div>
            <div class="info-item">
                <span class="label">DJJ</span>: {{ $record['rekam_medis']->djj }}
            </div>
            <div class="info-item">
                <span class="label">Keluhan</span>: {{ $record['rekam_medis']->keluhan }}
            </div>
            <div class="info-item">
                <span class="label">Analisa</span>: {{ $record['rekam_medis']->analisis }}
            </div>
            <div class="info-item">
                <span class="label">Penatalaksanaan</span>: {{ $record['rekam_medis']->penatalaksanaan }}
            </div>

            <div class="section-title">Anamnesa KIA</div>
            <div class="info-item">
                <span class="label">HPHT</span>: {{ \Carbon\Carbon::parse($record['anamnesa']->hpht)->format('d/m/Y') }}
            </div>
            <div class="info-item">
                <span class="label">G</span>: {{ $record['anamnesa']->g }}
            </div>
            <div class="info-item">
                <span class="label">P</span>: {{ $record['anamnesa']->p }}
            </div>
            <div class="info-item">
                <span class="label">A</span>: {{ $record['anamnesa']->a }}
            </div>
            <div class="info-item">
                <span class="label">Jarak Persalinan</span>: {{ $record['anamnesa']->jarak_persalinan }}
            </div>
            <div class="info-item">
                <span class="label">Cara Persalinan</span>: {{ $record['anamnesa']->cara_persalinan }}
            </div>
            <div class="info-item">
                <span class="label">Riwayat KB Terakhir</span>: {{ $record['anamnesa']->riwayat_kb_terakhir }}
            </div>

        @elseif($record['type'] === 'KB')
            <div class="section-title">Rekam Medis KB</div>
            <div class="info-item">
                <span class="label">Tanggal</span>: {{ \Carbon\Carbon::parse($record['rekam_medis']->tanggal)->format('d/m/Y') }}
            </div>
            <div class="info-item">
                <span class="label">Hari Terakhir Haid</span>: {{ \Carbon\Carbon::parse($record['rekam_medis']->hari_terakhir_haid)->format('d/m/Y') }}
            </div>
            <div class="info-item">
                <span class="label">Keluhan</span>: {{ $record['rekam_medis']->keluhan }}
            </div>
            <div class="info-item">
                <span class="label">Pemeriksaan</span>: {{ $record['rekam_medis']->pemeriksaan }}
            </div>
            <div class="info-item">
                <span class="label">Analisa/Diagnosa</span>: {{ $record['rekam_medis']->analisa_diagnosa }}
            </div>
            <div class="info-item">
                <span class="label">Tindakan</span>: {{ $record['rekam_medis']->tindakan }}
            </div>
            <div class="info-item">
                <span class="label">Kunjungan Ulang</span>: {{ \Carbon\Carbon::parse($record['rekam_medis']->kunjungan_ulang)->format('d/m/Y') }}
            </div>

            <div class="section-title">Anamnesa KB</div>
            <div class="info-item">
                <span class="label">Jumlah Anak</span>: {{ $record['anamnesa']->jumlah_anak }}
            </div>
            <div class="info-item">
                <span class="label">Anak Terakhir</span>: {{ $record['anamnesa']->anak_terakhir }}
            </div>
            <div class="info-item">
                <span class="label">Riwayat KB Terakhir</span>: {{ $record['anamnesa']->riwayat_kb_terakhir }}
            </div>
        @endif
    </div>
@endforeach
    </div>
    @if(!$loop->last)
    <div class="page-break"></div>
    @endif
    @endforeach
</body>
</html>