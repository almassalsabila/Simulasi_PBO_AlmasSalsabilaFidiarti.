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

    // OVERRIDE: Menghitung total biaya pendaftaran kedinasan
    public function hitungTotalBiaya() {
        // Dikenakan surcharge/biaya tambahan untuk pengurusan administrasi khusus 
        // dan kemitraan dinas sebesar 25% (dikali 1.25) dari biaya dasar
        return $this->biayaPendaftaranDasar * 1.25;
    }

    // OVERRIDE: Menampilkan informasi spesifik jalur kedinasan
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