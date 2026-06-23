<?php
// WAJIB: Menghubungkan ke file abstract induk
require_once 'Karyawan.php';

class KaryawanKontrak extends Karyawan {
    private $durasiKontrakBulan;
    private $agensiPenyalur;

    public function __construct($id, $nama, $dept, $hariKerja, $gajiDasar, $durasiKontrakBulan, $agensiPenyalur) {
        parent::__construct($id, $nama, $dept, $hariKerja, $gajiDasar);
        $this->durasiKontrakBulan = $durasiKontrakBulan;
        $this->agensiPenyalur = $agensiPenyalur;
    }

    // TAHAP 4: Tambahan Metode Query Internal Bersyarat (WHERE) di dalam kelas
    public static function ambilDataDariDB($koneksi) {
        $daftar = [];
        $sql = "SELECT * FROM tabel_karyawan WHERE jenis_karyawan = 'kontrak'";
        $result = $koneksi->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $agensi = "PT. Sinergi Bangsa";
                $daftar[] = new self(
                    $row['id_karyawan'], $row['nama_karyawan'], $row['departemen'], 
                    $row['hari_kerja_masuk'], $row['gaji_dasar_per_hari'], $row['durasi_kontrak_bulan'], $agensi
                );
            }
        }
        return $daftar;
    }

    // TAHAP 5: Implementasi hitung gaji bersih (Menggunakan return)
    public function hitungGajiBersih() {
        return $this->hari_kerja_masuk * $this->gaji_dasar_per_hari;
    }

    // TAHAP 6: Implementasi tampilkan profil (Sesuai dengan HTML Table agar rapi di index.php)
    public function tampilkanProfilKaryawan() {
        echo "<tr>
                <td>{$this->id_karyawan}</td>
                <td><strong>{$this->nama_karyawan}</strong></td>
                <td>{$this->departemen}</td>
                <td>{$this->hari_kerja_masuk} hari</td>
                <td class='text-right'>Rp " . number_format($this->gaji_dasar_per_hari, 0, ',', '.') . "</td>
                <td>{$this->durasiKontrakBulan} Bulan</td>
                <td>{$this->agensiPenyalur}</td>
                <td class='text-right' style='font-weight: bold; background: #fff8f2;'>Rp " . number_format($this->hitungGajiBersih(), 0, ',', '.') . "</td>
              </tr>";
    }
}
?>