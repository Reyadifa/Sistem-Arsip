<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>History Peminjaman</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            font-size: 12px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #1d4ed8;
            padding-bottom: 15px;
        }
        
        .header h1 {
            margin: 0;
            color: #1d4ed8;
            font-size: 24px;
            font-weight: bold;
        }
        
        .header p {
            margin: 5px 0 0 0;
            color: #666;
            font-size: 14px;
        }
        
        .search-info {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f3f4f6;
            border-radius: 5px;
        }
        
        .search-info p {
            margin: 0;
            font-weight: bold;
            color: #374151;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        table, th, td {
            border: 1px solid #000;
        }
        
        thead {
            background-color: #3b82f6;
            color: white;
        }
        
        th {
            padding: 8px 5px;
            text-align: center;
            font-weight: bold;
            font-size: 10px;
        }
        
        td {
            padding: 6px 5px;
            font-size: 10px;
            vertical-align: top;
        }
        
        .text-center {
            text-align: center;
        }
        
        .text-left {
            text-align: left;
        }
        
        tbody tr:nth-child(even) {
            background-color: #f9fafb;
        }
        
        .no-data {
            text-align: center;
            font-style: italic;
            color: #9ca3af;
            padding: 40px;
        }
        
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            color: #666;
            padding: 10px;
            background-color: white;
            border-top: 1px solid #e5e7eb;
        }
        
        @page {
            margin: 1cm;
        }
        
        .col-no { width: 5%; }
        .col-nama { width: 15%; }
        .col-arsip { width: 20%; }
        .col-kategori { width: 12%; }
        .col-tahun { width: 8%; }
        .col-bulan { width: 8%; }
        .col-tgl-pinjam { width: 12%; }
        .col-tgl-kembali { width: 12%; }
        .col-status { width: 8%; }
    </style>
</head>
<body>
    <div class="header">
        <h1>History Peminjaman Arsip</h1>
        <p>Laporan Data Peminjaman yang Telah Dikembalikan</p>
        <p>Dicetak pada: {{ date('d/m/Y H:i:s') }}</p>
    </div>
    
    @if($search)
    <div class="search-info">
        <p>Filter Pencarian: "{{ $search }}"</p>
    </div>
    @endif
    
    <table>
        <thead>
            <tr>
                <th class="col-no">No</th>
                <th class="col-nama">Nama Peminjam</th>
                <th class="col-arsip">Nama Arsip Yang Dipinjam</th>
                <th class="col-tahun">Tahun Arsip</th>
                <th class="col-bulan">Bulan Arsip</th>
                <th class="col-tgl-pinjam">Tanggal Pinjam</th>
                <th class="col-tgl-kembali">Tanggal Kembali</th>
                <th class="col-status">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($peminjamans as $index => $peminjaman)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-left">{{ $peminjaman->nama_peminjam }}</td>
                    <td class="text-left">{{ optional($peminjaman->arsip->usaha)->nama_usaha ?? '-' }}</td>
                    <td class="text-center">{{ $peminjaman->arsip->tahun ?? '-' }}</td>
                    <td class="text-center">{{ $peminjaman->arsip->bulan ?? '-' }}</td>
                    <td class="text-center">{{ $peminjaman->tgl_minjam }}</td>
                    <td class="text-center">{{ $peminjaman->tgl_kembali }}</td>
                    <td class="text-center">{{ $peminjaman->status }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="no-data">
                        Tidak ada data history peminjaman
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <div style="margin-top: 30px;">
        <p><strong>Total Data:</strong> {{ $peminjamans->count() }} peminjaman</p>
    </div>
    
    <div class="footer">
        <p>© {{ date('Y') }} Sistem Informasi Arsip</p>
    </div>
</body>
</html>