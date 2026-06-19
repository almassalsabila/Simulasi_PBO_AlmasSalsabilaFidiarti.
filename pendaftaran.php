<?php

abstract class Pendaftaran {
    // Properti terenkapsulasi dengan hak akses protected
    protected $id_pendaftaran;
    protected $nama_calon;
    protected $asal_sekolah;
    protected $nilai_ujian;
    protected $biayaPendaftaranDasar;

    /**
     * Constructor untuk memetakan nilai properti 
     * langsung dari kolom tabel database (Tahap 1)
     */
    public function __construct($id_pendaftaran, $nama_calon, $asal_sekolah, $nilai_ujian, $biayaPendaftaranDasar) {
        $this->id_pendaftaran = $id_pendaftaran;
        $this->nama_calon = $nama_calon;
        $this->asal_sekolah = $asal_sekolah;
        $this->nilai_ujian = $nilai_ujian;
        $this->biayaPendaftaranDasar = $biayaPendaftaranDasar;
    }

    /**
     * Metode Abstrak: Wajib di-override (diimplementasikan ulang) 
     * oleh class anak (Reguler, Prestasi, Kedinasan)
     */
    abstract public function hitungTotalBiaya();
    abstract public function tampilkanInfoJalur();

    // =========================================================================
    // GETTER METHODS (Opsional namun sangat disarankan dalam PBO)
    // Digunakan agar class luar/file view bisa membaca nilai properti protected
    // =========================================================================
    
    public function getIdPendaftaran() {
        return $this->id_pendaftaran;
    }

    public function getNamaCalon() {
        return $this->nama_calon;
    }

    public function getAsalSekolah() {
        return $this->asal_sekolah;
    }

    public function getNilaiUjian() {
        return $this->nilai_ujian;
    }

    public function getBiayaPendaftaranDasar() {
        return $this->biayaPendaftaranDasar;
    }
}