<?php
// Pastikan file abstract class Karyawan sudah disertakan sebelum kelas-kelas ini

// ==================== 1. CLASS KARYAWAN TETAP ====================
class KaryawanTetap extends Karyawan {
    // Properti tambahan sesuai instruksi
    private $tunjanganKesehatan;
    private $opsiSahamId;

    // Constructor menerima parameter dasar + properti tambahan
    public function __construct($id, $nama, $dept, $hariKerja, $gajiDasar, $tunjanganKesehatan, $opsiSahamId) {
        parent::__construct($id, $nama, $dept, $hariKerja, $gajiDasar);
        $this->tunjanganKesehatan = $tunjanganKesehatan;
        $this->opsiSahamId = $opsiSahamId;
    }

    // Implementasi hitung gaji bersih (Gaji Dasar x Hari Kerja + Tunjangan Kesehatan)
    public function hitungGajiBersih() {
        return ($this->hari_kerja_masuk * $this->gaji_dasar_per_hari) + $this->tunjanganKesehatan;
    }

    // Implementasi tampilkan profil karyawan tetap
    public function tampilkanProfilKaryawan() {
        echo "<h3>Profil Karyawan Tetap</h3>";
        echo "ID Karyawan: " . $this->id_karyawan . "<br>";
        echo "Nama: " . $this->nama_karyawan . "<br>";
        echo "Departemen: " . $this->departemen . "<br>";
        echo "Status: Tetap<br>";
        echo "Tunjangan Kesehatan: Rp " . number_format($this->tunjanganKesehatan, 0, ',', '.') . "<br>";
        echo "Opsi Saham ID: " . $this->opsiSahamId . "<br>";
        echo "Gaji Bersih: Rp " . number_format($this->hitungGajiBersih(), 0, ',', '.') . "<br>";
        echo "<hr>";
    }
}

// ==================== 2. CLASS KARYAWAN KONTRAK ====================
class KaryawanKontrak extends Karyawan {
    // Properti tambahan sesuai instruksi
    private $durasiKontrakBulan;
    private $agensiPenyalur;

    // Constructor menerima parameter dasar + properti tambahan
    public function __construct($id, $nama, $dept, $hariKerja, $gajiDasar, $durasiKontrakBulan, $agensiPenyalur) {
        parent::__construct($id, $nama, $dept, $hariKerja, $gajiDasar);
        $this->durasiKontrakBulan = $durasiKontrakBulan;
        $this->agensiPenyalur = $agensiPenyalur;
    }

    // Implementasi hitung gaji bersih untuk karyawan kontrak (Gaji Dasar x Hari Kerja)
    public function hitungGajiBersih() {
        return $this->hari_kerja_masuk * $this->gaji_dasar_per_hari;
    }

    // Implementasi tampilkan profil karyawan kontrak
    public function tampilkanProfilKaryawan() {
        echo "<h3>Profil Karyawan Kontrak</h3>";
        echo "ID Karyawan: " . $this->id_karyawan . "<br>";
        echo "Nama: " . $this->nama_karyawan . "<br>";
        echo "Departemen: " . $this->departemen . "<br>";
        echo "Status: Kontrak<br>";
        echo "Durasi Kontrak: " . $this->durasiKontrakBulan . " Bulan<br>";
        echo "Agensi Penyalur: " . $this->agensiPenyalur . "<br>";
        echo "Gaji Bersih: Rp " . number_format($this->hitungGajiBersih(), 0, ',', '.') . "<br>";
        echo "<hr>";
    }
}

// ==================== 3. CLASS KARYAWAN MAGANG ====================
class KaryawanMagang extends Karyawan {
    // Properti tambahan sesuai instruksi
    private $uangSakuBulanan;
    private $sertifikatKampusMerdeka;

    // Constructor menerima parameter dasar + properti tambahan
    public function __construct($id, $nama, $dept, $hariKerja, $gajiDasar, $uangSakuBulanan, $sertifikatKampusMerdeka) {
        parent::__construct($id, $nama, $dept, $hariKerja, $gajiDasar);
        $this->uangSakuBulanan = $uangSakuBulanan;
        $this->sertifikatKampusMerdeka = $sertifikatKampusMerdeka;
    }

    // Implementasi hitung gaji bersih untuk anak magang (diambil dari uang saku bulanan)
    public function hitungGajiBersih() {
        return $this->uangSakuBulanan;
    }

    // Implementasi tampilkan profil karyawan magang
    public function tampilkanProfilKaryawan() {
        echo "<h3>Profil Karyawan Magang</h3>";
        echo "ID Karyawan: " . $this->id_karyawan . "<br>";
        echo "Nama: " . $this->nama_karyawan . "<br>";
        echo "Departemen: " . $this->departemen . "<br>";
        echo "Status: Magang<br>";
        echo "Uang Saku Bulanan: Rp " . number_format($this->uangSakuBulanan, 0, ',', '.') . "<br>";
        echo "Sertifikat MBKM: " . ($this->sertifikatKampusMerdeka ?? "Tidak Ada") . "<br>";
        echo "<hr>";
    }
}
?>