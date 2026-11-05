<?php
/**
 * =========================================================================
 * HOMEPAGE (index.php)
 * Portfolio & Personal Information Web Page
 * Powered by PHP & MySQL (Dynamic Data Retrieval)
 * =========================================================================
 */

// 1. Hubungkan ke file koneksi database
require_once 'koneksi.php';

// Set parameter judul halaman & menu navigasi aktif
$page_title = "Home | Muhammad Fitrahnuddin Akram - Web Developer";
$active_page = "home";

// 2. Query Data Pribadi dari Tabel `tbl_data_pribadi`
$data_pribadi = null;
if ($koneksi) {
    $query_pribadi = mysqli_query($koneksi, "SELECT * FROM tbl_data_pribadi ORDER BY id ASC LIMIT 1");
    if ($query_pribadi && mysqli_num_rows($query_pribadi) > 0) {
        $data_pribadi = mysqli_fetch_assoc($query_pribadi);
    }
}

// Fallback jika database belum di-import atau koneksi belum aktif
if (!$data_pribadi) {
    $data_pribadi = [
        'nama_lengkap'        => 'Muhammad Fitrahnuddin Akram',
        'nama_panggilan'      => 'Akram',
        'profesi'             => 'Web Developer & UI/UX Enthusiast',
        'sub_profesi'         => 'Undergraduate Informatics Engineering Student',
        'ringkasan_bio'       => 'I am a forward-thinking Web Developer and Informatics Engineering student with a passion for building clean, performant, and accessible web applications. I bridge intuitive UI/UX design with scalable backend logic.',
        'program_studi'       => 'B.S. in Informatics Engineering',
        'universitas'         => 'Universitas Paramadina',
        'foto_profil'         => 'foto-profil.jpg',
        'email'               => 'm.fitrahnuddin.akram@gmail.com',
        'telepon'             => '+62 857-1554-4302',
        'lokasi'              => 'Jakarta, Indonesia',
        'status_ketersediaan' => 'Available for Projects & Collaboration'
    ];
}

// 3. Query Data Keahlian dari Tabel `tbl_skill`
$skills_result = [];
if ($koneksi) {
    $query_skills = mysqli_query($koneksi, "SELECT * FROM tbl_skill ORDER BY tingkat DESC");
    if ($query_skills && mysqli_num_rows($query_skills) > 0) {
        while ($row = mysqli_fetch_assoc($query_skills)) {
            $skills_result[] = $row;
        }
    }
}

// Fallback Data Keahlian jika database kosong
if (empty($skills_result)) {
    $skills_result = [
        ['nama_skill' => 'HTML5 & Semantic Markup', 'kategori' => 'Frontend', 'tingkat' => 90, 'level_label' => 'Advanced'],
        ['nama_skill' => 'CSS3 & Modern Flex/Grid', 'kategori' => 'Frontend', 'tingkat' => 88, 'level_label' => 'Advanced'],
        ['nama_skill' => 'JavaScript (ES6+)', 'kategori' => 'Frontend', 'tingkat' => 82, 'level_label' => 'Intermediate'],
        ['nama_skill' => 'PHP & MVC Architecture', 'kategori' => 'Backend', 'tingkat' => 80, 'level_label' => 'Intermediate'],
        ['nama_skill' => 'MySQL & Database Modeling', 'kategori' => 'Database', 'tingkat' => 85, 'level_label' => 'Advanced'],
        ['nama_skill' => 'Figma & UI/UX Wireframing', 'kategori' => 'Design', 'tingkat' => 86, 'level_label' => 'Advanced']
    ];
}

// 4. Query Data Riwayat Pendidikan dari Tabel `tbl_pendidikan`
$education_result = [];
if ($koneksi) {
    $query_edu = mysqli_query($koneksi, "SELECT * FROM tbl_pendidikan ORDER BY urutan ASC");
    if ($query_edu && mysqli_num_rows($query_edu) > 0) {
        while ($row = mysqli_fetch_assoc($query_edu)) {
            $education_result[] = $row;
        }
    }
}

// Fallback Data Pendidikan jika database kosong
if (empty($education_result)) {
    $education_result = [
        ['jenjang' => 'Junior High School', 'nama_sekolah' => 'SMPN 171 Jakarta', 'tahun' => '2019 - 2022', 'status' => 'Graduated', 'deskripsi' => 'Foundational secondary education.'],
        ['jenjang' => 'Senior High School', 'nama_sekolah' => 'SMA Prestasi Prima', 'tahun' => '2022 - 2025', 'status' => 'Graduated', 'deskripsi' => 'Science & Technology stream with focus on computing.'],
        ['jenjang' => 'Undergraduate Degree', 'nama_sekolah' => 'Universitas Paramadina', 'tahun' => '2025 - Present', 'status' => 'Currently Enrolled', 'deskripsi' => 'Bachelor of Science in Informatics Engineering.']
    ];
}

// Sertakan Header Template
include 'header.php';
?>

<!-- ================= MAIN CONTENT ================= -->
<main class="container">

    <!-- Notifikasi Status Database (jika belum terkoneksi) -->
    <?php if (isset($db_connection_error) && $db_connection_error): ?>
        <div class="alert alert-info" role="alert">
            <div>
                <strong>Notice for Database Setup:</strong> Currently using cached profile data because the MySQL database is not connected (<code><?= htmlspecialchars($db_connection_error); ?></code>). Please start Apache and MySQL in XAMPP, open phpMyAdmin, and import <code>database.sql</code>.
            </div>
        </div>
    <?php endif; ?>

    <!-- ================= SECTION 1: HERO PROFILE ================= -->
    <section class="card">
        <div class="hero-box">
            <!-- Profile Photo with Active Status Pill -->
            <div class="hero-avatar-wrap">
                <img src="<?= htmlspecialchars($data_pribadi['foto_profil']); ?>" 
                     alt="<?= htmlspecialchars($data_pribadi['nama_lengkap']); ?> - Profile Picture" 
                     class="hero-img">
                <div class="status-pill" title="Current Status">
                    <span class="status-dot"></span>
                    <span>Available</span>
                </div>
            </div>

            <!-- Profile Details & Bio -->
            <div class="hero-content">
                <span class="section-tag">Welcome to my space</span>
                <h1 class="hero-name"><?= htmlspecialchars($data_pribadi['nama_lengkap']); ?></h1>
                
                <p class="hero-role">
                    <span><?= htmlspecialchars($data_pribadi['profesi']); ?></span>
                    <span style="color: var(--text-dim);">&bull;</span>
                    <span style="color: var(--text-muted); font-size: 0.9rem;"><?= htmlspecialchars($data_pribadi['universitas']); ?></span>
                </p>

                <p class="hero-bio">
                    <?= htmlspecialchars($data_pribadi['ringkasan_bio']); ?>
                </p>

                <!-- Call-to-Action Buttons -->
                <div class="hero-actions">
                    <a href="portfolio.php" class="btn btn-primary">
                        <span>View Portfolio</span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                    <a href="contact.php" class="btn btn-secondary">
                        <span>Get In Touch</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= SECTION 2: BIODATA & ESSENTIALS ================= -->
    <section class="card">
        <div class="card-header">
            <span class="section-tag">Profile Overview</span>
            <h2 class="section-title">Personal Biography &amp; Details</h2>
            <p class="section-subtitle">Real-time biographical information retrieved dynamically from the database.</p>
        </div>

        <div class="info-grid">
            <div class="info-tile">
                <span class="info-tile-label">Full Name</span>
                <span class="info-tile-value"><?= htmlspecialchars($data_pribadi['nama_lengkap']); ?></span>
            </div>
            <div class="info-tile">
                <span class="info-tile-label">Major &amp; Degree</span>
                <span class="info-tile-value"><?= htmlspecialchars($data_pribadi['program_studi']); ?></span>
            </div>
            <div class="info-tile">
                <span class="info-tile-label">University</span>
                <span class="info-tile-value"><?= htmlspecialchars($data_pribadi['universitas']); ?></span>
            </div>
            <div class="info-tile">
                <span class="info-tile-label">Location</span>
                <span class="info-tile-value"><?= htmlspecialchars($data_pribadi['lokasi']); ?></span>
            </div>
            <div class="info-tile">
                <span class="info-tile-label">Direct Email</span>
                <span class="info-tile-value"><?= htmlspecialchars($data_pribadi['email']); ?></span>
            </div>
            <div class="info-tile">
                <span class="info-tile-label">Availability</span>
                <span class="info-tile-value" style="color: var(--accent-emerald);">
                    <?= htmlspecialchars($data_pribadi['status_ketersediaan'] ?? 'Available for Inquiries'); ?>
                </span>
            </div>
        </div>
    </section>

    <!-- ================= SECTION 3: TECHNICAL SKILLS ================= -->
    <section class="card">
        <div class="card-header">
            <span class="section-tag">Core Competencies</span>
            <h2 class="section-title">Skills &amp; Technologies</h2>
            <p class="section-subtitle">Dynamic skill metrics and tools I use to build scalable web applications.</p>
        </div>

        <div class="skills-grid">
            <?php foreach ($skills_result as $skill): ?>
                <div class="skill-card">
                    <div class="skill-card-top">
                        <span class="skill-title"><?= htmlspecialchars($skill['nama_skill']); ?></span>
                        <span class="skill-badge"><?= htmlspecialchars($skill['level_label'] ?? $skill['kategori']); ?></span>
                    </div>
                    <div class="skill-progress-bar">
                        <div class="skill-progress-fill" style="width: <?= (int)$skill['tingkat']; ?>%;"></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- ================= SECTION 4: EDUCATION HISTORY ================= -->
    <section class="card">
        <div class="card-header">
            <span class="section-tag">Academic Background</span>
            <h2 class="section-title">Educational Milestones</h2>
            <p class="section-subtitle">Structured academic background loaded from <code>tbl_pendidikan</code>.</p>
        </div>

        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Level</th>
                        <th>Institution Name</th>
                        <th>Academic Period</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    foreach ($education_result as $edu): 
                        $is_enrolled = (stripos($edu['status'], 'Enrolled') !== false || stripos($edu['status'], 'Sedang') !== false);
                    ?>
                        <tr>
                            <td><strong><?= $no++; ?></strong></td>
                            <td><?= htmlspecialchars($edu['jenjang']); ?></td>
                            <td>
                                <strong><?= htmlspecialchars($edu['nama_sekolah']); ?></strong>
                                <?php if (!empty($edu['deskripsi'])): ?>
                                    <div style="font-size: 0.8rem; color: var(--text-dim); margin-top: 3px;">
                                        <?= htmlspecialchars($edu['deskripsi']); ?>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($edu['tahun']); ?></td>
                            <td>
                                <span class="status-badge <?= $is_enrolled ? 'enrolled' : 'graduated'; ?>">
                                    <?= htmlspecialchars($edu['status']); ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

</main>

<?php
// Sertakan Footer Template
include 'footer.php';
?>

