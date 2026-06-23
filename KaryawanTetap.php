<?php
// WAJIB: Menghubungkan ke file abstract induk agar bisa menggunakan 'extends Karyawan'
require_once 'Karyawan.php';

class KaryawanTetap extends Karyawan {
    private $tunjanganKesehatan;
    private $opsiSahamId;

    public function __construct($id, $nama, $dept, $hariKerja, $gajiDasar, $tunjanganKesehatan, $opsiSahamId) {
        parent::__construct($id, $nama, $dept, $hariKerja, $gajiDasar);
        $this->tunjanganKesehatan = $tunjanganKesehatan;
        $this->opsiSahamId = $opsiSahamId;
    }

    // TAHAP 4: Tambahan Metode Query Internal Bersyarat (WHERE) di dalam kelas
    public static function ambilDataDariDB($koneksi) {
        $daftar = [];
        $sql = "SELECT * FROM tabel_karyawan WHERE jenis_karyawan = 'tetap'";
        $result = $koneksi->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $tunjangan = 500000; 
                $sahamId = "SHM-" . str_pad($row['id_karyawan'], 3, "0", STR_PAD_LEFT);
                $daftar[] = new self(
                    $row['id_karyawan'], $row['nama_karyawan'], $row['departemen'], 
                    $row['hari_kerja_masuk'], $row['gaji_dasar_per_hari'], $tunjangan, $sahamId
                );
            }
        }
        return $daftar;
    }

    // TAHAP 5: Implementasi hitung gaji bersih (Menggunakan return)
    public function hitungGajiBersih() {
        return ($this->hari_kerja_masuk * $this->gaji_dasar_per_hari) + $this->tunjanganKesehatan;
    }

    // TAHAP 6: Implementasi tampilkan profil (Sesuai dengan HTML Table agar rapi di index.php)
    public function tampilkanProfilKaryawan() {
        echo "<tr>
                <td>{$this->id_karyawan}</td>
                <td><strong>{$this->nama_karyawan}</strong></td>
                <td>{$this->departemen}</td>
                <td>{$this->hari_kerja_masuk} hari</td>
                <td class='text-right'>Rp " . number_format($this->gaji_dasar_per_hari, 0, ',', '.') . "</td>
                <td class='text-right' style='color: #27ae60;'>Rp " . number_format($this->tunjanganKesehatan, 0, ',', '.') . "</td>
                <td><code>{$this->opsiSahamId}</code></td>
                <td class='text-right' style='font-weight: bold; background: #eef9f1;'>Rp " . number_format($this->hitungGajiBersih(), 0, ',', '.') . "</td>
              </tr>";
    }
}
?>