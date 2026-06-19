<?php
require_once 'pendaftaran.php';

class PendaftaranKedinasan extends Pendaftaran {
    // Properti tambahan spesifik
    private $skIkatanDinas;
    private $instansiSponsor;

    public function __construct($id_pendaftaran, $nama_calon, $asal_sekolah, $nilai_ujian, $biayaPendaftaranDasar, $skIkatanDinas, $instansiSponsor) {
        parent::__construct($id_pendaftaran, $nama_calon, $asal_sekolah, $nilai_ujian, $biayaPendaftaranDasar);
        
        $this->skIkatanDinas = $skIkatanDinas;
        $this->instansiSponsor = $instansiSponsor;
    }

    // OVERRIDE: Implementasi wajib dari class abstrak
    public function hitungTotalBiaya() {
        return 0; // Kedinasan disubsidi penuh (gratis)
    }

    // OVERRIDE: Implementasi wajib dari class abstrak
    public function tampilkanInfoJalur() {
        return "Jalur Kedinasan - Sponsor: {$this->instansiSponsor} (SK: {$this->skIkatanDinas})";
    }

    // METODE KHUSUS: Mengambil data khusus jalur Kedinasan
    public static function getDaftarKedinasan($db) {
        $query = "SELECT * FROM tabel_pendaftaran WHERE jalur_pendaftaran = 'kedinasan'";
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