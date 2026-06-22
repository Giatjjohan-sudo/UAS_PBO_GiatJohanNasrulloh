<?php

// ==========================================
// TAHAP 3: ABSTRACT CLASS (PARENT CLASS)
// ==========================================
abstract class Karyawan {
    // Properti terenkapsulasi (protected)
    protected $id_karyawan;
    protected $nama_karyawan;
    protected $departemen;
    protected $hari_kerja_masuk;
    protected $gaji_dasar_per_hari;

    // Constructor Utama
    public function __construct($id, $nama, $dept, $hariKerja, $gajiDasar) {
        $this->id_karyawan = $id;
        $this->nama_karyawan = $nama;
        $this->departemen = $dept;
        $this->hari_kerja_masuk = $hariKerja;
        $this->gaji_dasar_per_hari = $gajiDasar;
    }

    // Metode Abstrak (Wajib diimplementasikan di kelas anak)
    abstract public function hitungGajiBersih();
    abstract public function tampilkanProfilKaryawan();
}


// ==========================================
// TAHAP 4 & 5: KELAS ANAK (KARYAWAN TETAP)
// ==========================================
class KaryawanTetap extends Karyawan {
    // Properti tambahan (Tahap 4)
    private $tunjanganKesehatan;
    private $opsiSahamId;

    public function __construct($id, $nama, $dept, $hariKerja, $gajiDasar, $tunjanganKesehatan, $opsiSahamId) {
        parent::__construct($id, $nama, $dept, $hariKerja, $gajiDasar);
        $this->tunjanganKesehatan = $tunjanganKesehatan;
        $this->opsiSahamId = $opsiSahamId;
    }

    /**
     * TAHAP 5: Overriding Hitung Gaji Bersih
     * Logika: (Hari Kerja x Gaji Dasar) + Tunjangan Kesehatan
     */
    public function hitungGajiBersih() {
        return ($this->hari_kerja_masuk * $this->gaji_dasar_per_hari) + $this->tunjanganKesehatan;
    }

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


// ==========================================
// TAHAP 4 & 5: KELAS ANAK (KARYAWAN KONTRAK)
// ==========================================
class KaryawanKontrak extends Karyawan {
    // Properti tambahan (Tahap 4)
    private $durasiKontrakBulan;
    private $agensiPenyalur;

    public function __construct($id, $nama, $dept, $hariKerja, $gajiDasar, $durasiKontrakBulan, $agensiPenyalur) {
        parent::__construct($id, $nama, $dept, $hariKerja, $gajiDasar);
        $this->durasiKontrakBulan = $durasiKontrakBulan;
        $this->agensiPenyalur = $agensiPenyalur;
    }

    /**
     * TAHAP 5: Overriding Hitung Gaji Bersih
     * Logika: Hari Kerja x Gaji Dasar
     */
    public function hitungGajiBersih() {
        return $this->hari_kerja_masuk * $this->gaji_dasar_per_hari;
    }

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


// ==========================================
// TAHAP 4 & 5: KELAS ANAK (KARYAWAN MAGANG)
// ==========================================
class KaryawanMagang extends Karyawan {
    // Properti tambahan (Tahap 4)
    private $uangSakuBulanan;
    private $sertifikatKampusMerdeka;

    public function __construct($id, $nama, $dept, $hariKerja, $gajiDasar, $uangSakuBulanan, $sertifikatKampusMerdeka) {
        parent::__construct($id, $nama, $dept, $hariKerja, $gajiDasar);
        $this->uangSakuBulanan = $uangSakuBulanan;
        $this->sertifikatKampusMerdeka = $sertifikatKampusMerdeka;
    }

    /**
     * TAHAP 5: Overriding Hitung Gaji Bersih
     * Logika: (Hari Kerja x Gaji Dasar) * 0.80 (Potongan 20%)
     */
    public function hitungGajiBersih() {
        return ($this->hari_kerja_masuk * $this->gaji_dasar_per_hari) * 0.80;
    }

    public function tampilkanProfilKaryawan() {
        echo "<h3>Profil Karyawan Magang</h3>";
        echo "ID Karyawan: " . $this->id_karyawan . "<br>";
        echo "Nama: " . $this->nama_karyawan . "<br>";
        echo "Departemen: " . $this->departemen . "<br>";
        echo "Status: Magang<br>";
        echo "Uang Saku Bulanan Dasar: Rp " . number_format($this->uangSakuBulanan, 0, ',', '.') . "<br>";
        echo "Sertifikat MBKM: " . ($this->sertifikatKampusMerdeka ?? "Tidak Ada") . "<br>";
        echo "Gaji Bersih (Setelah Potongan 20%): Rp " . number_format($this->hitungGajiBersih(), 0, ',', '.') . "<br>";
        echo "<hr>";
    }
}

?>