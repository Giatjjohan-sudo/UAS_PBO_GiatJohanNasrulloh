<?php
// Menyertakan file koneksi database dan definisi class PBO
require_once 'koneksi.php';
require_once 'Karyawan.php';

// Menyiapkan array penampung objek karyawan berdasarkan kategori
$daftarKaryawanTetap = [];
$daftarKaryawanKontrak = [];
$daftarKaryawanMagang = [];

// Query untuk mengambil semua data dari database
$sql = "SELECT * FROM tabel_karyawan";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        
        // Memisahkan instansiasi objek berdasarkan jenis_karyawan (Polimorfisme)
        if ($row['jenis_karyawan'] == 'tetap') {
            // Berikan nilai dummy/default untuk tunjanganKesehatan (misal: Rp 500.000) dan opsiSahamId
            $tunjanganKesehatan = 500000; 
            $opsiSahamId = "SHM-" . str_pad($row['id_karyawan'], 3, "0", STR_PAD_LEFT);
            
            $daftarKaryawanTetap[] = new KaryawanTetap(
                $row['id_karyawan'], $row['nama_karyawan'], $row['departemen'], 
                $row['hari_kerja_masuk'], $row['gaji_dasar_per_hari'], 
                $tunjanganKesehatan, $opsiSahamId
            );
            
        } elseif ($row['jenis_karyawan'] == 'kontrak') {
            // Berikan nilai dummy/default untuk agensiPenyalur karena tidak ada di DB awal
            $agensiPenyalur = "PT. Sinergi Bangsa";
            
            $daftarKaryawanKontrak[] = new KaryawanKontrak(
                $row['id_karyawan'], $row['nama_karyawan'], $row['departemen'], 
                $row['hari_kerja_masuk'], $row['gaji_dasar_per_hari'], 
                $row['durasi_kontrak_bulan'], $agensiPenyalur
            );
            
        } elseif ($row['jenis_karyawan'] == 'magang') {
            // Untuk magang, jika gaji_dasar_per_hari di DB adalah 0, kita beri plafon dasar 
            // harian fiktif (misal: Rp 120.000) agar rumus potongan 20% di Tahap 5 menghasilkan nilai.
            $gajiDasarMagang = ($row['gaji_dasar_per_hari'] == 0) ? 120000 : $row['gaji_dasar_per_hari'];

            // PERBAIKAN: Mengubah $row['uangSakuBulanan'] menjadi $row['uang_saku_bulanan'] sesuai kolom DB
            $daftarKaryawanMagang[] = new KaryawanMagang(
                $row['id_karyawan'], $row['nama_karyawan'], $row['departemen'], 
                $row['hari_kerja_masuk'], $gajiDasarMagang, 
                $row['uang_saku_bulanan'], $row['sertifikat_kampus_merdeka']
            );
        }
    }
}
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
                    <?php 
                        $ref = new ReflectionClass($k);
                        $props = [];
                        foreach($ref->getProperties() as $p) {
                            $p->setAccessible(true);
                            $props[$p->getName()] = $p->getValue($k);
                        }
                    ?>
                    <tr>
                        <td><?= $props['id_karyawan']; ?></td>
                        <td><strong><?= $props['nama_karyawan']; ?></strong></td>
                        <td><?= $props['departemen']; ?></td>
                        <td><?= $props['hari_kerja_masuk']; ?> hari</td>
                        <td class="text-right">Rp <?= number_format($props['gaji_dasar_per_hari'], 0, ',', '.'); ?></td>
                        <td class="text-right" style="color: #27ae60;">Rp <?= number_format($props['tunjanganKesehatan'], 0, ',', '.'); ?></td>
                        <td><code><?= $props['opsiSahamId']; ?></code></td>
                        <td class="text-right" style="font-weight: bold; background: #eef9f1;">Rp <?= number_format($k->hitungGajiBersih(), 0, ',', '.'); ?></td>
                    </tr>
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
                    <?php 
                        $ref = new ReflectionClass($k);
                        $props = [];
                        foreach($ref->getProperties() as $p) {
                            $p->setAccessible(true);
                            $props[$p->getName()] = $p->getValue($k);
                        }
                    ?>
                    <tr>
                        <td><?= $props['id_karyawan']; ?></td>
                        <td><strong><?= $props['nama_karyawan']; ?></strong></td>
                        <td><?= $props['departemen']; ?></td>
                        <td><?= $props['hari_kerja_masuk']; ?> hari</td>
                        <td class="text-right">Rp <?= number_format($props['gaji_dasar_per_hari'], 0, ',', '.'); ?></td>
                        <td><?= $props['durasiKontrakBulan']; ?> Bulan</td>
                        <td><?= $props['agensiPenyalur']; ?></td>
                        <td class="text-right" style="font-weight: bold; background: #fff8f2;">Rp <?= number_format($k->hitungGajiBersih(), 0, ',', '.'); ?></td>
                    </tr>
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
                    <?php 
                        $ref = new ReflectionClass($k);
                        $props = [];
                        foreach($ref->getProperties() as $p) {
                            $p->setAccessible(true);
                            $props[$p->getName()] = $p->getValue($k);
                        }
                    ?>
                    <tr>
                        <td><?= $props['id_karyawan']; ?></td>
                        <td><strong><?= $props['nama_karyawan']; ?></strong></td>
                        <td><?= $props['departemen']; ?></td>
                        <td><?= $props['hari_kerja_masuk']; ?> hari</td>
                        <td class="text-right">Rp <?= number_format($props['gaji_dasar_per_hari'], 0, ',', '.'); ?></td>
                        <td><?= !empty($props['sertifikatKampusMerdeka']) ? $props['sertifikatKampusMerdeka'] : '<span style="color:#aaa; font-style:italic;">Tidak Ada</span>'; ?></td>
                        <td class="text-right" style="font-weight: bold; background: #fdf5ff; color: #c0392b;">Rp <?= number_format($k->hitungGajiBersih(), 0, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>