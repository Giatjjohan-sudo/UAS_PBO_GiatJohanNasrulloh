<?php
// WAJIB: Menghubungkan ke file abstract induk
require_once 'Karyawan.php';

// ==================== 3. CLASS KARYAWAN MAGANG ====================
class KaryawanMagang extends Karyawan {
    private $uangSakuBulanan;
    private $sertifikatKampusMerdeka;

    public function __construct($id, $nama, $dept, $hariKerja, $gajiDasar, $uangSakuBulanan, $sertifikatKampusMerdeka) {
        parent::__construct($id, $nama, $dept, $hariKerja, $gajiDasar);
        $this->uangSakuBulanan = $uangSakuBulanan;
        $this->sertifikatKampusMerdeka = $sertifikatKampusMerdeka;
    }

    // TAHAP 4: Metode Query Internal Spesifik Bersyarat (WHERE) di dalam kelas
    public static function ambilDataDariDB($koneksi) {
        $daftar = [];
        $sql = "SELECT * FROM tabel_karyawan WHERE jenis_karyawan = 'magang'";
        $result = $koneksi->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $gajiDasarMagang = ($row['gaji_dasar_per_hari'] == 0) ? 120000 : $row['gaji_dasar_per_hari'];
                
                // SOLUSI ERROR: Cek apakah kolom di DB pakai 'campus' atau 'kampus', jika tidak ada set default "Tidak Ada"
                if (isset($row['sertifikat_campus_merdeka'])) {
                    $sertifikatData = $row['sertifikat_campus_merdeka'];
                } elseif (isset($row['sertifikat_kampus_merdeka'])) {
                    $sertifikatData = $row['sertifikat_kampus_merdeka'];
                } else {
                    $sertifikatData = "Tidak Ada";
                }

                $daftar[] = new self(
                    $row['id_karyawan'], 
                    $row['nama_karyawan'], 
                    $row['departemen'], 
                    $row['hari_kerja_masuk'], 
                    $gajiDasarMagang, 
                    $row['uang_saku_bulanan'], 
                    $sertifikatData
                );
            }
        }
        return $daftar;
    }

    // TAHAP 5: Implementasi hitung gaji bersih formula potongan 20%
    public function hitungGajiBersih() {
        return ($this->hari_kerja_masuk * $this->gaji_dasar_per_hari) * 0.80;
    }

    // TAHAP 6: Implementasi tampilkan profil (Sesuai dengan HTML Table agar rapi di index.php)
    public function tampilkanProfilKaryawan() {
        $sertifikat = !empty($this->sertifikatKampusMerdeka) ? $this->sertifikatKampusMerdeka : "<span style='color:#aaa; font-style:italic;'>Tidak Ada</span>";
        echo "<tr>
                <td>{$this->id_karyawan}</td>
                <td><strong>{$this->nama_karyawan}</strong></td>
                <td>{$this->departemen}</td>
                <td>{$this->hari_kerja_masuk} hari</td>
                <td class='text-right'>Rp " . number_format($this->gaji_dasar_per_hari, 0, ',', '.') . "</td>
                <td>{$sertifikat}</td>
                <td class='text-right' style='font-weight: bold; background: #fdf5ff; color: #c0392b;'>Rp " . number_format($this->hitungGajiBersih(), 0, ',', '.') . "</td>
              </tr>";
    }
}
?>