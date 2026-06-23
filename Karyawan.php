<?php
// ==========================================
// TAHAP 3: ABSTRACT CLASS (INDUK)
// ==========================================
abstract class Karyawan {
    protected $id_karyawan;
    protected $nama_karyawan;
    protected $departemen;
    protected $hari_kerja_masuk;
    protected $gaji_dasar_per_hari;

    public function __construct($id, $nama, $dept, $hariKerja, $gajiDasar) {
        $this->id_karyawan = $id;
        $this->nama_karyawan = $nama;
        $this->departemen = $dept;
        $this->hari_kerja_masuk = $hariKerja;
        $this->gaji_dasar_per_hari = $gajiDasar;
    }

    abstract public function hitungGajiBersih();
    abstract public function tampilkanProfilKaryawan();
}
?>