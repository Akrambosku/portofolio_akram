<?php
/**
 * =========================================================================
 * PORTFOLIO PAGE (portfolio.php)
 * Showcase of Web Development, UI/UX, and Design Projects
 * Powered by PHP & MySQL (Dynamic Data Retrieval)
 * =========================================================================
 */

// 1. Hubungkan ke file koneksi database
require_once 'koneksi.php';

// Set parameter judul halaman & menu navigasi aktif
$page_title = "Portfolio | Muhammad Fitrahnuddin Akram - Projects & Showcase";
$active_page = "portfolio";

// 2. Query Data Portofolio dari Tabel `tbl_portofolio`
$portfolio_result = [];
if ($koneksi) {
    $query_portfolio = mysqli_query($koneksi, "SELECT * FROM tbl_portofolio ORDER BY urutan ASC, id ASC");
    if ($query_portfolio && mysqli_num_rows($query_portfolio) > 0) {
        while ($row = mysqli_fetch_assoc($query_portfolio)) {
            $portfolio_result[] = $row;
        }
    }
}

// Fallback Data Portofolio jika database kosong
if (empty($portfolio_result)) {
    $portfolio_result = [
        [
            'id'             => 1,
            'judul'          => 'IT Fest Event Brand & Identity Proposal',
            'kategori'       => 'Branding & UI Design',
            'deskripsi'      => 'Comprehensive visual identity system and executive digital proposal design created for the annual IT Festival conference, delivering high visual clarity and modern typography.',
            'gambar'         => 'itfest.png',
            'teknologi'      => 'Figma, Adobe Illustrator, UI Design, Brand Identity',
            'tautan_proyek'  => '#',
            'tautan_github'  => 'https://github.com/fitrahnuddin',
            'featured'       => 1
        ],
        [
            'id'             => 2,
            'judul'          => 'Reformatics Keynote & Speaker Showcase',
            'kategori'       => 'Event Promotion & Web Media',
            'deskripsi'      => 'Curated presentation graphics and speaker introduction visual assets for the Reformatics technology symposium, emphasizing speaker authority and professional credibility.',
            'gambar'         => 'reformatics.jpg',
            'teknologi'      => 'Visual Design, Web Media, Typography, Event Media',
            'tautan_proyek'  => '#',
            'tautan_github'  => 'https://github.com/fitrahnuddin',
            'featured'       => 1
        ],
        [
            'id'             => 3,
            'judul'          => 'Informatics Student Union (HIMTI) Workplan',
            'kategori'       => 'Organizational Media & Layout',
            'deskripsi'      => 'Strategic work-program publication design for the Informatics Engineering Student Association (HIMTI), organizing organizational roadmaps into a clean, legible infographic structure.',
            'gambar'         => 'proker-himti.jpg',
            'teknologi'      => 'Information Architecture, Layouting, Graphic Media',
            'tautan_proyek'  => '#',
            'tautan_github'  => 'https://github.com/fitrahnuddin',
            'featured'       => 0
        ]
    ];
}

// Sertakan Header Template
include 'header.php';
?>

<!-- ================= MAIN CONTENT ================= -->
<main class="container">

    <!-- Header Section -->
    <section class="card" style="padding-bottom: 24px;">
        <span class="section-tag">Featured Works</span>
        <h1 class="section-title">Projects &amp; Case Studies</h1>
        <p class="section-subtitle">
            A curated collection of web design systems, interactive prototypes, and digital media projects loaded dynamically from the <code>tbl_portofolio</code> database table.
        </p>
    </section>

    <!-- Project Grid Showcase -->
    <div class="portfolio-grid">
        <?php foreach ($portfolio_result as $project): 
            $tech_list = array_filter(array_map('trim', explode(',', $project['teknologi'])));
        ?>
            <article class="portfolio-card">
                <!-- Thumbnail Image -->
                <div class="portfolio-thumb-wrap">
                    <img src="<?= htmlspecialchars($project['gambar']); ?>" 
                         alt="<?= htmlspecialchars($project['judul']); ?>" 
                         class="portfolio-thumb"
                         loading="lazy">
                    <div class="portfolio-overlay">
                        <span class="category-badge"><?= htmlspecialchars($project['kategori']); ?></span>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="portfolio-body">
                    <h2 class="portfolio-title"><?= htmlspecialchars($project['judul']); ?></h2>
                    <p class="portfolio-desc"><?= htmlspecialchars($project['deskripsi']); ?></p>

                    <!-- Tech Stack Tags -->
                    <div class="tech-tags">
                        <?php foreach ($tech_list as $tech): ?>
                            <span class="tech-tag"><?= htmlspecialchars($tech); ?></span>
                        <?php endforeach; ?>
                    </div>

                    <!-- Links & Actions -->
                    <div class="portfolio-links">
                        <?php if (!empty($project['tautan_proyek']) && $project['tautan_proyek'] !== '#'): ?>
                            <a href="<?= htmlspecialchars($project['tautan_proyek']); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-primary">
                                <span>Live Demo</span>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                                    <polyline points="15 3 21 3 21 9"></polyline>
                                    <line x1="10" y1="14" x2="21" y2="3"></line>
                                </svg>
                            </a>
                        <?php endif; ?>

                        <a href="<?= htmlspecialchars($project['tautan_github'] ?? 'https://github.com/fitrahnuddin'); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-secondary">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path>
                            </svg>
                            <span>Repository</span>
                        </a>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    </div>

</main>

<?php
// Sertakan Footer Template
include 'footer.php';
?>

