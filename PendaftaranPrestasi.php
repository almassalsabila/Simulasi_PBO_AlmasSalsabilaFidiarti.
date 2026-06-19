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

    // OVERRIDE: Menghitung total biaya pendaftaran prestasi
    public function hitungTotalBiaya() {
        // Mendapatkan potongan/insentif apresiasi prestasi sebesar Rp50.000 dari biaya dasar
        $totalBiaya = $this->biayaPendaftaranDasar - 50000;
        
        // Memastikan total biaya tidak bernilai negatif jika biaya dasar di bawah 50.000
        return ($totalBiaya < 0) ? 0 : $totalBiaya;
    }

    // OVERRIDE: Menampilkan informasi spesifik jalur prestasi
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