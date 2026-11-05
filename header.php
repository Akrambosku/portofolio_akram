<?php
/**
 * =========================================================================
 * HEADER TEMPLATE (header.php)
 * Portfolio & Personal Website - Web Developer Theme
 * =========================================================================
 */

// Pastikan variabel judul dan halaman aktif telah terdefinisi
if (!isset($page_title)) {
    $page_title = "Muhammad Fitrahnuddin Akram | Web Developer Portfolio";
}
if (!isset($active_page)) {
    $active_page = "home";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Personal Portfolio & Web Development Projects of Muhammad Fitrahnuddin Akram, Informatics Engineering Student & Developer.">
    <meta name="author" content="Muhammad Fitrahnuddin Akram">
    <title><?= htmlspecialchars($page_title); ?></title>

    <!-- Google Fonts: Plus Jakarta Sans for refined modern aesthetic -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- External Modern CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- ================= TOP NAVIGATION BAR ================= -->
    <header class="site-header">
        <div class="container nav-container">
            <a href="index.php" class="brand-logo" title="Back to Homepage">
                <span class="brand-badge">&lt;/&gt;</span>
                <span>Akram<span style="color: var(--accent-cyan);">.dev</span></span>
            </a>

            <!-- Mobile Hamburger Toggle -->
            <button class="mobile-toggle" id="mobileNavToggle" aria-label="Toggle navigation menu">
                ☰
            </button>

            <!-- Navigation Links -->
            <nav>
                <ul class="nav-links" id="navLinks">
                    <li>
                        <a href="index.php" class="nav-link <?= ($active_page === 'home') ? 'active' : ''; ?>">
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="portfolio.php" class="nav-link <?= ($active_page === 'portfolio') ? 'active' : ''; ?>">
                            <span>Portfolio</span>
                        </a>
                    </li>
                    <li>
                        <a href="contact.php" class="nav-link <?= ($active_page === 'contact') ? 'active' : ''; ?>">
                            <span>Contact</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

