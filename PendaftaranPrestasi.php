<?php
require_once 'pendaftaran.php';

class PendaftaranPrestasi extends Pendaftaran {
    // Properti tambahan spesifik
    private $jenisPrestasi;
    private $tingkatPrestasi;

    public function __construct($id_pendaftaran, $nama_calon, $asal_sekolah, $nilai_ujian, $biayaPendaftaranDasar, $jenisPrestasi, $tingkatPrestasi) {
        parent::__construct($id_pendaftaran, $nama_calon, $asal_sekolah, $nilai_ujian, $biayaPendaftaranDasar);
        
        $this->jenisPrestasi = $jenisPrestasi;
        $this->tingkatPrestasi = $tingkatPrestasi;
    }

    // OVERRIDE: Implementasi wajib dari class abstrak
    public function hitungTotalBiaya() {
        // Contoh: Prestasi mendapat potongan 100.000
        $total = $this->biayaPendaftaranDasar - 100000;
        return ($total < 0) ? 0 : $total; 
    }

    // OVERRIDE: Implementasi wajib dari class abstrak
    public function tampilkanInfoJalur() {
        return "Jalur Prestasi - Jenis: {$this->jenisPrestasi} (Tingkat {$this->tingkatPrestasi})";
    }

    // METODE KHUSUS: Mengambil data khusus jalur Prestasi
    public static function getDaftarPrestasi($db) {
        $query = "SELECT * FROM tabel_pendaftaran WHERE jalur_pendaftaran = 'prestasi'";
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