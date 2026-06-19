<?php
require_once 'pendaftaran.php';

class PendaftaranReguler extends Pendaftaran {
    // Properti tambahan spesifik
    private $pilihanProdi;
    private $lokasiKampus;

    public function __construct($id_pendaftaran, $nama_calon, $asal_sekolah, $nilai_ujian, $biayaPendaftaranDasar, $pilihanProdi, $lokasiKampus) {
        // Memanggil constructor dari class induk
        parent::__construct($id_pendaftaran, $nama_calon, $asal_sekolah, $nilai_ujian, $biayaPendaftaranDasar);
        
        $this->pilihanProdi = $pilihanProdi;
        $this->lokasiKampus = $lokasiKampus;
    }

    // OVERRIDE: Menghitung total biaya pendaftaran reguler
    public function hitungTotalBiaya() {
        // Tarif standar murni tanpa biaya tambahan seleksi/tes laboratorium
        return $this->biayaPendaftaranDasar;
    }

    // OVERRIDE: Menampilkan informasi spesifik jalur reguler
    public function tampilkanInfoJalur() {
        return "Jalur Reguler - Prodi: {$this->pilihanProdi}, Lokasi: {$this->lokasiKampus}";
    }

    // METODE KHUSUS: Mengambil data khusus jalur Reguler
    public static function getDaftarReguler($db) {
        $query = "SELECT * FROM tabel_pendaftaran WHERE jalur_pendaftaran = 'reguler'";
        $result = $db->query($query);
        
        $data = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }
}
?>