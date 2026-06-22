<?php
// 1. WAJIB: Memanggil file koneksi di baris paling atas
require_once 'koneksi.php';

// 2. Memanggil class yang diperlukan
require_once 'PendaftaranReguler.php';
require_once 'PendaftaranPrestasi.php';
require_once 'PendaftaranKedinasan.php';

// 3. Mengambil data dari database dengan mengoper variabel $koneksi yang valid
$dataReguler   = PendaftaranReguler::getDaftarReguler($koneksi);
$dataPrestasi  = PendaftaranPrestasi::getDaftarPrestasi($koneksi);
$dataKedinasan = PendaftaranKedinasan::getDaftarKedinasan($koneksi);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Dashboard Pendaftaran Mahasiswa Baru - Simulasi PBO TRPL 1A">
    <title>Dashboard Pendaftaran — Simulasi PBO</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* ============================================================
           DESIGN TOKENS & VARIABLES
           ============================================================ */
        :root {
            --primary: #B7A3E3;
            --primary-deep: #9B85D6;
            --secondary: #C2E2FA;
            --secondary-deep: #9DD0F5;
            --coral: #FF8F8F;
            --coral-light: #FFB5B5;
            --cream: #FFF1CB;
            --cream-deep: #FFE6A0;
            --text-dark: #2D3748;
            --text-muted: #718096;
            --text-light: #A0AEC0;
            --bg-base: #F8FAFC;
            --bg-white: #FFFFFF;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.04), 0 1px 2px rgba(0,0,0,0.06);
            --shadow-md: 0 4px 16px rgba(0,0,0,0.06), 0 2px 4px rgba(0,0,0,0.04);
            --shadow-lg: 0 10px 40px rgba(0,0,0,0.08), 0 4px 12px rgba(0,0,0,0.04);
            --shadow-xl: 0 20px 60px rgba(0,0,0,0.10), 0 8px 20px rgba(0,0,0,0.05);
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 20px;
            --radius-pill: 100px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --font: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        /* ============================================================
           RESET & BASE
           ============================================================ */
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--font);
            background-color: var(--bg-base);
            color: var(--text-dark);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* ============================================================
           HEADER / TOP BANNER
           ============================================================ */
        .dashboard-header {
            background: linear-gradient(135deg, #B7A3E3 0%, #9B85D6 30%, #A8C8F0 70%, #C2E2FA 100%);
            padding: 0;
            position: relative;
            overflow: hidden;
        }

        .dashboard-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(255,255,255,0.12) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .dashboard-header::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .header-inner {
            max-width: 1320px;
            margin: 0 auto;
            padding: 48px 40px 44px;
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 32px;
            flex-wrap: wrap;
        }

        .header-text h1 {
            font-size: 2rem;
            font-weight: 800;
            color: #FFFFFF;
            letter-spacing: -0.5px;
            line-height: 1.2;
            margin-bottom: 6px;
            text-shadow: 0 2px 12px rgba(0,0,0,0.08);
        }

        .header-text p {
            font-size: 0.925rem;
            color: rgba(255,255,255,0.85);
            font-weight: 500;
        }

        .header-widget {
            display: flex;
            align-items: center;
            gap: 14px;
            background: rgba(255,255,255,0.18);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255,255,255,0.25);
            border-radius: var(--radius-lg);
            padding: 16px 24px;
            transition: var(--transition);
        }

        .header-widget:hover {
            background: rgba(255,255,255,0.28);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
        }

        .widget-icon {
            width: 44px;
            height: 44px;
            background: rgba(255,255,255,0.3);
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
        }

        .widget-info .widget-label {
            font-size: 0.75rem;
            color: rgba(255,255,255,0.8);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .widget-info .widget-value {
            font-size: 1.5rem;
            font-weight: 800;
            color: #FFFFFF;
            line-height: 1.2;
        }

        /* ============================================================
           LAYOUT CONTAINER
           ============================================================ */
        .dashboard-body {
            max-width: 1320px;
            margin: 0 auto;
            padding: 0 40px 60px;
        }

        /* ============================================================
           KPI / ANALYTICS CARDS
           ============================================================ */
        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-top: -36px;
            position: relative;
            z-index: 2;
            margin-bottom: 44px;
        }

        .kpi-card {
            background: var(--bg-white);
            border-radius: var(--radius-xl);
            padding: 28px 28px 24px;
            box-shadow: var(--shadow-lg);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(0,0,0,0.03);
        }

        .kpi-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-xl);
        }

        .kpi-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            border-radius: 4px 4px 0 0;
        }

        .kpi-card.kpi-reguler::after { background: linear-gradient(90deg, #B7A3E3, #C9BAF0); }
        .kpi-card.kpi-prestasi::after { background: linear-gradient(90deg, #C2E2FA, #9DD0F5); }
        .kpi-card.kpi-kedinasan::after { background: linear-gradient(90deg, #FF8F8F, #FFB5B5); }

        .kpi-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .kpi-icon {
            width: 48px;
            height: 48px;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
        }

        .kpi-reguler .kpi-icon { background: linear-gradient(135deg, #EDE7F9, #D8CDF0); }
        .kpi-prestasi .kpi-icon { background: linear-gradient(135deg, #E1F1FC, #C2E2FA); }
        .kpi-kedinasan .kpi-icon { background: linear-gradient(135deg, #FFE0E0, #FFBFBF); }

        .kpi-badge {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            padding: 4px 12px;
            border-radius: var(--radius-pill);
        }

        .kpi-reguler .kpi-badge { background: #F3EEFF; color: #7C5FC7; }
        .kpi-prestasi .kpi-badge { background: #E8F4FD; color: #4A9AD4; }
        .kpi-kedinasan .kpi-badge { background: #FFE8E8; color: #D46A6A; }

        .kpi-value {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--text-dark);
            line-height: 1;
            margin-bottom: 4px;
        }

        .kpi-label {
            font-size: 0.875rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* ============================================================
           SECTION: TABLE CONTAINERS
           ============================================================ */
        .data-section {
            margin-bottom: 36px;
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 20px;
        }

        .section-icon {
            width: 40px;
            height: 40px;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
            flex-shrink: 0;
        }

        .section-reguler .section-icon { background: linear-gradient(135deg, #EDE7F9, #D8CDF0); }
        .section-prestasi .section-icon { background: linear-gradient(135deg, #E1F1FC, #C2E2FA); }
        .section-kedinasan .section-icon { background: linear-gradient(135deg, #FFE0E0, #FFBFBF); }

        .section-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--text-dark);
            letter-spacing: -0.3px;
        }

        .section-subtitle {
            font-size: 0.8rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .table-card {
            background: var(--bg-white);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-md);
            overflow: hidden;
            border: 1px solid rgba(0,0,0,0.04);
            transition: var(--transition);
        }

        .table-card:hover {
            box-shadow: var(--shadow-lg);
        }

        /* ============================================================
           TABLES
           ============================================================ */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--text-muted);
            padding: 18px 24px;
            text-align: left;
            border-bottom: 2px solid #EDF2F7;
            background: #FAFBFD;
            white-space: nowrap;
        }

        thead th:first-child {
            padding-left: 28px;
        }

        thead th:last-child {
            padding-right: 28px;
        }

        tbody td {
            padding: 18px 24px;
            font-size: 0.9rem;
            color: var(--text-dark);
            border-bottom: 1px solid #F1F5F9;
            vertical-align: middle;
            transition: var(--transition);
        }

        tbody td:first-child {
            padding-left: 28px;
        }

        tbody td:last-child {
            padding-right: 28px;
        }

        tbody tr {
            transition: var(--transition);
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr:hover {
            background: linear-gradient(90deg, rgba(183,163,227,0.05) 0%, rgba(194,226,250,0.06) 100%);
        }

        tbody tr:hover td {
            color: var(--text-dark);
        }

        /* ID Column */
        .col-id {
            font-weight: 700;
            color: var(--text-light);
            font-size: 0.85rem;
            min-width: 48px;
        }

        /* Name Column */
        .col-name {
            font-weight: 600;
            color: var(--text-dark);
            white-space: nowrap;
        }

        .col-name .name-school {
            display: block;
            font-size: 0.78rem;
            font-weight: 400;
            color: var(--text-muted);
            margin-top: 2px;
        }

        /* Score Badge */
        .score-chip {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: #F3EEFF;
            color: #7C5FC7;
            padding: 5px 12px;
            border-radius: var(--radius-pill);
            font-size: 0.82rem;
            font-weight: 600;
        }

        /* Biaya Dasar */
        .biaya-dasar {
            font-weight: 500;
            color: var(--text-muted);
            font-size: 0.875rem;
        }

        /* Badge: Info Jalur */
        .badge-jalur {
            display: inline-block;
            max-width: 280px;
            padding: 7px 14px;
            border-radius: var(--radius-pill);
            font-size: 0.78rem;
            font-weight: 600;
            line-height: 1.4;
            transition: var(--transition);
        }

        .badge-reguler {
            background: #F3EEFF;
            color: #6B51B8;
            border: 1px solid #E4D9F7;
        }

        .badge-prestasi {
            background: #E8F4FD;
            color: #3A7EAE;
            border: 1px solid #C2E2FA;
        }

        .badge-kedinasan {
            background: #FFF8E7;
            color: #A67A2E;
            border: 1px solid #FFE6A0;
        }

        tbody tr:hover .badge-jalur {
            transform: scale(1.02);
        }

        /* Total Biaya */
        .total-biaya {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-weight: 700;
            font-size: 0.92rem;
            padding: 7px 16px;
            border-radius: var(--radius-sm);
            transition: var(--transition);
        }

        .total-reguler {
            background: linear-gradient(135deg, #EDE7F9, #F3EEFF);
            color: #6B51B8;
        }

        .total-prestasi {
            background: linear-gradient(135deg, #DBEAFE, #E8F4FD);
            color: #3A7EAE;
        }

        .total-kedinasan {
            background: linear-gradient(135deg, #FFE0E0, #FFE8E8);
            color: #C75050;
        }

        tbody tr:hover .total-biaya {
            transform: scale(1.04);
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        /* Empty Row */
        .empty-row td {
            text-align: center;
            color: var(--text-light);
            font-style: italic;
            padding: 48px 24px;
            font-size: 0.9rem;
        }

        /* ============================================================
           FOOTER
           ============================================================ */
        .dashboard-footer {
            max-width: 1320px;
            margin: 0 auto;
            padding: 0 40px 48px;
        }

        .footer-inner {
            text-align: center;
            padding: 24px;
            border-top: 1px solid #EDF2F7;
            color: var(--text-light);
            font-size: 0.8rem;
            font-weight: 500;
        }

        .footer-inner span {
            color: var(--primary-deep);
            font-weight: 600;
        }

        /* ============================================================
           ANIMATIONS
           ============================================================ */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(24px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .kpi-card {
            animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        .kpi-card:nth-child(1) { animation-delay: 0.1s; }
        .kpi-card:nth-child(2) { animation-delay: 0.2s; }
        .kpi-card:nth-child(3) { animation-delay: 0.3s; }

        .data-section {
            animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        .data-section:nth-of-type(1) { animation-delay: 0.35s; }
        .data-section:nth-of-type(2) { animation-delay: 0.45s; }
        .data-section:nth-of-type(3) { animation-delay: 0.55s; }

        /* ============================================================
           RESPONSIVE
           ============================================================ */
        @media (max-width: 1024px) {
            .header-inner {
                padding: 36px 28px 36px;
            }
            .dashboard-body, .dashboard-footer {
                padding-left: 28px;
                padding-right: 28px;
            }
        }

        @media (max-width: 768px) {
            .header-inner {
                padding: 32px 20px;
                flex-direction: column;
                text-align: center;
            }

            .header-text h1 {
                font-size: 1.5rem;
            }

            .dashboard-body, .dashboard-footer {
                padding-left: 16px;
                padding-right: 16px;
            }

            .kpi-grid {
                grid-template-columns: 1fr;
                gap: 16px;
                margin-top: -28px;
            }

            .table-card {
                border-radius: var(--radius-lg);
                overflow-x: auto;
            }

            thead th, tbody td {
                padding: 14px 16px;
                font-size: 0.82rem;
            }
        }
    </style>
</head>
<body>

    <!-- ========== HEADER ========== -->
    <header class="dashboard-header">
        <div class="header-inner">
            <div class="header-text">
                <h1>📋 Dashboard Pendaftaran Mahasiswa Baru</h1>
                <p>Simulasi PBO — Almas Salsabila Fidiarti &middot; TRPL 1A</p>
            </div>
            <div class="header-widget">
                <div class="widget-icon">🎓</div>
                <div class="widget-info">
                    <div class="widget-label">Total Pendaftar</div>
                    <div class="widget-value"><?= count($dataReguler) + count($dataPrestasi) + count($dataKedinasan); ?></div>
                </div>
            </div>
        </div>
    </header>

    <div class="dashboard-body">

        <!-- ========== KPI CARDS ========== -->
        <div class="kpi-grid">
            <!-- KPI: Reguler -->
            <div class="kpi-card kpi-reguler">
                <div class="kpi-header">
                    <div class="kpi-icon">📝</div>
                    <div class="kpi-badge">Reguler</div>
                </div>
                <div class="kpi-value"><?= count($dataReguler); ?></div>
                <div class="kpi-label">Total Pendaftar Jalur Reguler</div>
            </div>

            <!-- KPI: Prestasi -->
            <div class="kpi-card kpi-prestasi">
                <div class="kpi-header">
                    <div class="kpi-icon">🏆</div>
                    <div class="kpi-badge">Prestasi</div>
                </div>
                <div class="kpi-value"><?= count($dataPrestasi); ?></div>
                <div class="kpi-label">Total Pendaftar Jalur Prestasi</div>
            </div>

            <!-- KPI: Kedinasan -->
            <div class="kpi-card kpi-kedinasan">
                <div class="kpi-header">
                    <div class="kpi-icon">🏛️</div>
                    <div class="kpi-badge">Kedinasan</div>
                </div>
                <div class="kpi-value"><?= count($dataKedinasan); ?></div>
                <div class="kpi-label">Total Pendaftar Jalur Kedinasan</div>
            </div>
        </div>

        <!-- ========== TABLE: JALUR REGULER ========== -->
        <div class="data-section section-reguler">
            <div class="section-header">
                <div class="section-icon">📝</div>
                <div>
                    <div class="section-title">Jalur Reguler</div>
                    <div class="section-subtitle">Pendaftaran melalui ujian tulis &mdash; biaya standar</div>
                </div>
            </div>
            <div class="table-card">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Calon</th>
                            <th>Nilai Ujian</th>
                            <th>Biaya Dasar</th>
                            <th>Informasi Jalur</th>
                            <th>Total Biaya</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($dataReguler)): ?>
                            <tr class="empty-row"><td colspan="6">Belum ada data pendaftar jalur reguler.</td></tr>
                        <?php else: ?>
                            <?php foreach ($dataReguler as $row): 
                                $mahasiswa = new PendaftaranReguler(
                                    $row['id_pendaftaran'],
                                    $row['nama_calon'],
                                    $row['asal_sekolah'], 
                                    $row['nilai_ujian'],
                                    $row['biaya_pendaftaran_dasar'],
                                    $row['pilihan_prodi'],
                                    $row['lokasi_kampus']
                                );
                            ?>
                                <tr>
                                    <td class="col-id">#<?= $mahasiswa->getIdPendaftaran(); ?></td>
                                    <td class="col-name">
                                        <?= $mahasiswa->getNamaCalon(); ?>
                                        <span class="name-school"><?= $mahasiswa->getAsalSekolah(); ?></span>
                                    </td>
                                    <td><span class="score-chip"><?= $mahasiswa->getNilaiUjian(); ?></span></td>
                                    <td class="biaya-dasar">Rp <?= number_format($mahasiswa->getBiayaPendaftaranDasar(), 0, ',', '.'); ?></td>
                                    <td><span class="badge-jalur badge-reguler"><?= $mahasiswa->tampilkanInfoJalur(); ?></span></td>
                                    <td><span class="total-biaya total-reguler">Rp <?= number_format($mahasiswa->hitungTotalBiaya(), 0, ',', '.'); ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- ========== TABLE: JALUR PRESTASI ========== -->
        <div class="data-section section-prestasi">
            <div class="section-header">
                <div class="section-icon">🏆</div>
                <div>
                    <div class="section-title">Jalur Prestasi</div>
                    <div class="section-subtitle">Pendaftaran berdasarkan pencapaian &mdash; mendapat potongan Rp 50.000</div>
                </div>
            </div>
            <div class="table-card">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Calon</th>
                            <th>Nilai Ujian</th>
                            <th>Biaya Dasar</th>
                            <th>Informasi Jalur</th>
                            <th>Total Biaya (Diskon)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($dataPrestasi)): ?>
                            <tr class="empty-row"><td colspan="6">Belum ada data pendaftar jalur prestasi.</td></tr>
                        <?php else: ?>
                            <?php foreach ($dataPrestasi as $row): 
                                $mahasiswa = new PendaftaranPrestasi(
                                    $row['id_pendaftaran'],
                                    $row['nama_calon'],
                                    $row['asal_sekolah'],
                                    $row['nilai_ujian'],
                                    $row['biaya_pendaftaran_dasar'],
                                    $row['jenis_prestasi'],
                                    $row['tingkat_prestasi']
                                );
                            ?>
                                <tr>
                                    <td class="col-id">#<?= $mahasiswa->getIdPendaftaran(); ?></td>
                                    <td class="col-name">
                                        <?= $mahasiswa->getNamaCalon(); ?>
                                        <span class="name-school"><?= $mahasiswa->getAsalSekolah(); ?></span>
                                    </td>
                                    <td><span class="score-chip"><?= $mahasiswa->getNilaiUjian(); ?></span></td>
                                    <td class="biaya-dasar">Rp <?= number_format($mahasiswa->getBiayaPendaftaranDasar(), 0, ',', '.'); ?></td>
                                    <td><span class="badge-jalur badge-prestasi"><?= $mahasiswa->tampilkanInfoJalur(); ?></span></td>
                                    <td><span class="total-biaya total-prestasi">Rp <?= number_format($mahasiswa->hitungTotalBiaya(), 0, ',', '.'); ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- ========== TABLE: JALUR KEDINASAN ========== -->
        <div class="data-section section-kedinasan">
            <div class="section-header">
                <div class="section-icon">🏛️</div>
                <div>
                    <div class="section-title">Jalur Kedinasan</div>
                    <div class="section-subtitle">Pendaftaran ikatan dinas &mdash; dikenakan surcharge 25% dari biaya dasar</div>
                </div>
            </div>
            <div class="table-card">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Calon</th>
                            <th>Nilai Ujian</th>
                            <th>Biaya Dasar</th>
                            <th>Informasi Jalur</th>
                            <th>Total Biaya (+Surcharge)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($dataKedinasan)): ?>
                            <tr class="empty-row"><td colspan="6">Belum ada data pendaftar jalur kedinasan.</td></tr>
                        <?php else: ?>
                            <?php foreach ($dataKedinasan as $row): 
                                $mahasiswa = new PendaftaranKedinasan(
                                    $row['id_pendaftaran'],
                                    $row['nama_calon'],
                                    $row['asal_sekolah'],
                                    $row['nilai_ujian'],
                                    $row['biaya_pendaftaran_dasar'],
                                    $row['sk_ikatan_dinas'],
                                    $row['instansi_sponsor']
                                );
                            ?>
                                <tr>
                                    <td class="col-id">#<?= $mahasiswa->getIdPendaftaran(); ?></td>
                                    <td class="col-name">
                                        <?= $mahasiswa->getNamaCalon(); ?>
                                        <span class="name-school"><?= $mahasiswa->getAsalSekolah(); ?></span>
                                    </td>
                                    <td><span class="score-chip"><?= $mahasiswa->getNilaiUjian(); ?></span></td>
                                    <td class="biaya-dasar">Rp <?= number_format($mahasiswa->getBiayaPendaftaranDasar(), 0, ',', '.'); ?></td>
                                    <td><span class="badge-jalur badge-kedinasan"><?= $mahasiswa->tampilkanInfoJalur(); ?></span></td>
                                    <td><span class="total-biaya total-kedinasan">Rp <?= number_format($mahasiswa->hitungTotalBiaya(), 0, ',', '.'); ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- ========== FOOTER ========== -->
    <footer class="dashboard-footer">
        <div class="footer-inner">
            Simulasi PBO &copy; <?= date('Y'); ?> &middot; Database: <span>db_simulasi_pbo_trpl1A_AlmasSalsabilaFidiarti</span>
        </div>
    </footer>

</body>
</html>