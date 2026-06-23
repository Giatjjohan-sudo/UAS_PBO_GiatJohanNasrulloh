<?php
// 1. Menyertakan koneksi database
require_once 'koneksi.php';

// 2. Menyertakan Kelas Induk (Abstract Class)
require_once 'Karyawan.php';

// 3. Menyertakan 3 Kelas Anak (Subclass) yang sudah dipisah file-nya
require_once 'KaryawanTetap.php';
require_once 'KaryawanKontrak.php';
require_once 'KaryawanMagang.php';

// TAHAP 6: Mengambil kelompok data via query subclass (Sesuai Kriteria Rubrik)
$daftarKaryawanTetap   = KaryawanTetap::ambilDataDariDB($koneksi);
$daftarKaryawanKontrak = KaryawanKontrak::ambilDataDariDB($koneksi);
$daftarKaryawanMagang  = KaryawanMagang::ambilDataDariDB($koneksi);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>UAS PBO - Daftar Slip Gaji Karyawan</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f6f9; margin: 20px; color: #333; }
        h1 { text-align: center; color: #2c3e50; margin-bottom: 30px; }
        h2 { color: #2980b9; border-bottom: 2px solid #2980b9; padding-bottom: 5px; margin-top: 40px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        th, td { padding: 12px; text-align: left; border: 1px solid #ddd; }
        th { background-color: #34495e; color: #fff; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .text-right { text-align: right; }
        .badge { background: #27ae60; color: white; padding: 3px 8px; border-radius: 4px; font-size: 12px; }
    </style>
</head>
<body>

    <h1>SISTEM INFORMASI PENGGAJIAN KARYAWAN</h1>
    <p style="text-align: center; font-weight: bold;">Nama Database: db_uas_pbo_ti1c_giatjohannasrulloh</p>

    <h2><span class="badge">Kategori</span> Karyawan Tetap</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Karyawan</th>
                <th>Departemen</th>
                <th>Hari Kerja</th>
                <th>Gaji / Hari</th>
                <th>Tunjangan Kesehatan</th>
                <th>Opsi Saham ID</th>
                <th>Gaji Bersih (Total)</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($daftarKaryawanTetap)): ?>
                <tr><td colspan="8" style="text-align:center;">Tidak ada data.</td></tr>
            <?php else: ?>
                <?php foreach($daftarKaryawanTetap as $k): ?>
                    <?php $k->tampilkanProfilKaryawan(); // Eksekusi Polimorfisme Murni dari KaryawanTetap.php ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <h2><span class="badge" style="background: #e67e22;">Kategori</span> Karyawan Kontrak</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Karyawan</th>
                <th>Departemen</th>
                <th>Hari Kerja</th>
                <th>Gaji / Hari</th>
                <th>Durasi Kontrak</th>
                <th>Agensi Penyalur</th>
                <th>Gaji Bersih (Total)</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($daftarKaryawanKontrak)): ?>
                <tr><td colspan="8" style="text-align:center;">Tidak ada data.</td></tr>
            <?php else: ?>
                <?php foreach($daftarKaryawanKontrak as $k): ?>
                    <?php $k->tampilkanProfilKaryawan(); // Eksekusi Polimorfisme Murni dari KaryawanKontrak.php ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <h2><span class="badge" style="background: #9b59b6;">Kategori</span> Karyawan Magang</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Karyawan</th>
                <th>Departemen</th>
                <th>Hari Kerja</th>
                <th>Plafon Harian</th>
                <th>Sertifikat Kampus Merdeka</th>
                <th>Gaji Bersih (Potongan 20%)</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($daftarKaryawanMagang)): ?>
                <tr><td colspan="7" style="text-align:center;">Tidak ada data.</td></tr>
            <?php else: ?>
                <?php foreach($daftarKaryawanMagang as $k): ?>
                    <?php $k->tampilkanProfilKaryawan(); // Eksekusi Polimorfisme Murni dari KaryawanMagang.php ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>