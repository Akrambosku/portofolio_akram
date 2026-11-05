-- ============================================================
-- DATABASE SCRIPT: db_portofolio
-- Portfolio & Personal Data Management System
-- Tailored for: Muhammad Fitrahnuddin Akram (Web Developer)
-- ============================================================

CREATE DATABASE IF NOT EXISTS `db_portofolio` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `db_portofolio`;

-- --------------------------------------------------------
-- Table structure for `tbl_data_pribadi`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `tbl_data_pribadi`;
CREATE TABLE `tbl_data_pribadi` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` VARCHAR(150) NOT NULL,
  `nama_panggilan` VARCHAR(50) DEFAULT NULL,
  `profesi` VARCHAR(100) NOT NULL,
  `sub_profesi` VARCHAR(150) DEFAULT NULL,
  `ringkasan_bio` TEXT NOT NULL,
  `program_studi` VARCHAR(100) NOT NULL,
  `universitas` VARCHAR(150) NOT NULL,
  `foto_profil` VARCHAR(255) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `telepon` VARCHAR(50) NOT NULL,
  `lokasi` VARCHAR(100) NOT NULL,
  `status_ketersediaan` VARCHAR(100) DEFAULT 'Available for Freelance & Internships',
  `link_github` VARCHAR(255) DEFAULT NULL,
  `link_linkedin` VARCHAR(255) DEFAULT NULL,
  `link_instagram` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `tbl_data_pribadi`
INSERT INTO `tbl_data_pribadi` (
  `id`, `nama_lengkap`, `nama_panggilan`, `profesi`, `sub_profesi`, `ringkasan_bio`, 
  `program_studi`, `universitas`, `foto_profil`, `email`, `telepon`, `lokasi`, 
  `status_ketersediaan`, `link_github`, `link_linkedin`, `link_instagram`
) VALUES (
  1,
  'Muhammad Fitrahnuddin Akram',
  'Akram',
  'Web Developer & UI/UX Enthusiast',
  'Undergraduate Informatics Engineering Student',
  'I am a forward-thinking Web Developer and Informatics Engineering student with a passion for building clean, performant, and accessible web applications. I bridge the gap between intuitive UI/UX design and scalable backend logic using modern web technologies.',
  'B.S. in Informatics Engineering',
  'Universitas Paramadina',
  'foto-profil.jpg',
  'm.fitrahnuddin.akram@gmail.com',
  '+62 857-1554-4302',
  'Jakarta, Indonesia',
  'Open to Projects & Collaboration',
  'https://github.com/fitrahnuddin',
  'https://linkedin.com',
  'https://instagram.com/liludean'
);

-- --------------------------------------------------------
-- Table structure for `tbl_pendidikan`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `tbl_pendidikan`;
CREATE TABLE `tbl_pendidikan` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `jenjang` VARCHAR(50) NOT NULL,
  `nama_sekolah` VARCHAR(150) NOT NULL,
  `tahun` VARCHAR(50) NOT NULL,
  `status` VARCHAR(100) NOT NULL,
  `deskripsi` TEXT DEFAULT NULL,
  `urutan` INT(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `tbl_pendidikan`
INSERT INTO `tbl_pendidikan` (`id`, `jenjang`, `nama_sekolah`, `tahun`, `status`, `deskripsi`, `urutan`) VALUES
(1, 'Junior High School', 'SMPN 171 Jakarta', '2019 - 2022', 'Graduated', 'Foundational academic studies and early introduction to basic computing logic.', 1),
(2, 'Senior High School', 'SMA Prestasi Prima', '2022 - 2025', 'Graduated', 'Focused on sciences and technology, active in computer science clubs and visual media.', 2),
(3, 'Undergraduate Degree', 'Universitas Paramadina', '2025 - Present', 'Currently Enrolled', 'Pursuing Bachelor of Science in Informatics Engineering with focus on Software Engineering, Web Systems, and Database Architectures.', 3);

-- --------------------------------------------------------
-- Table structure for `tbl_skill`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `tbl_skill`;
CREATE TABLE `tbl_skill` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nama_skill` VARCHAR(100) NOT NULL,
  `kategori` VARCHAR(50) NOT NULL,
  `tingkat` INT(11) NOT NULL COMMENT 'Percentage 1-100',
  `level_label` VARCHAR(50) NOT NULL,
  `badge_color` VARCHAR(30) DEFAULT '#4f46e5',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `tbl_skill`
INSERT INTO `tbl_skill` (`id`, `nama_skill`, `kategori`, `tingkat`, `level_label`, `badge_color`) VALUES
(1, 'HTML5 & Semantic Markup', 'Frontend', 90, 'Advanced', '#3b82f6'),
(2, 'CSS3 & Modern Flex/Grid', 'Frontend', 88, 'Advanced', '#6366f1'),
(3, 'JavaScript (ES6+)', 'Frontend', 82, 'Intermediate', '#eab308'),
(4, 'PHP & MVC Architecture', 'Backend', 80, 'Intermediate', '#8b5cf6'),
(5, 'MySQL & Database Modeling', 'Database', 85, 'Advanced', '#06b6d4'),
(6, 'MongoDB & NoSQL Basics', 'Database', 75, 'Intermediate', '#10b981'),
(7, 'Figma & UI/UX Wireframing', 'Design', 86, 'Advanced', '#ec4899'),
(8, 'Git & GitHub Version Control', 'Tools', 80, 'Intermediate', '#f97316');

-- --------------------------------------------------------
-- Table structure for `tbl_portofolio`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `tbl_portofolio`;
CREATE TABLE `tbl_portofolio` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `judul` VARCHAR(150) NOT NULL,
  `kategori` VARCHAR(80) NOT NULL,
  `deskripsi` TEXT NOT NULL,
  `gambar` VARCHAR(255) NOT NULL,
  `teknologi` VARCHAR(255) NOT NULL,
  `tautan_proyek` VARCHAR(255) DEFAULT '#',
  `tautan_github` VARCHAR(255) DEFAULT '#',
  `featured` TINYINT(1) DEFAULT 0,
  `urutan` INT(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `tbl_portofolio`
INSERT INTO `tbl_portofolio` (`id`, `judul`, `kategori`, `deskripsi`, `gambar`, `teknologi`, `tautan_proyek`, `tautan_github`, `featured`, `urutan`) VALUES
(1, 'IT Fest Event Brand & Identity Proposal', 'Branding & UI Design', 'Comprehensive visual identity system and executive digital proposal design created for the annual IT Festival conference, delivering high visual clarity and modern typography.', 'itfest.png', 'Figma, Adobe Illustrator, UI Design, Brand Identity', '#', 'https://github.com/fitrahnuddin', 1, 1),
(2, 'Reformatics Keynote & Speaker Showcase', 'Event Promotion & Web Media', 'Curated presentation graphics and speaker introduction visual assets for the Reformatics technology symposium, emphasizing speaker authority and professional credibility.', 'reformatics.jpg', 'Visual Design, Web Media, Typography, Event Media', '#', 'https://github.com/fitrahnuddin', 1, 2),
(3, 'Informatics Student Union (HIMTI) Workplan', 'Organizational Media & Layout', 'Strategic work-program publication design for the Informatics Engineering Student Association (HIMTI), organizing organizational roadmaps into a clean, legible infographic structure.', 'proker-himti.jpg', 'Information Architecture, Layouting, Graphic Media', '#', 'https://github.com/fitrahnuddin', 0, 3);

-- --------------------------------------------------------
-- Table structure for `tbl_kontak`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `tbl_kontak`;
CREATE TABLE `tbl_kontak` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `tipe` VARCHAR(50) NOT NULL,
  `label` VARCHAR(100) NOT NULL,
  `nilai` VARCHAR(150) NOT NULL,
  `link_url` VARCHAR(255) NOT NULL,
  `icon_svg` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `tbl_kontak`
INSERT INTO `tbl_kontak` (`id`, `tipe`, `label`, `nilai`, `link_url`, `icon_svg`) VALUES
(1, 'Email', 'Personal & Work Email', 'm.fitrahnuddin.akram@gmail.com', 'mailto:m.fitrahnuddin.akram@gmail.com', 'email'),
(2, 'WhatsApp', 'WhatsApp Direct Chat', '+62 857-1554-4302', 'https://wa.me/6285715544302', 'whatsapp'),
(3, 'Instagram', 'Instagram Profile', '@liludean', 'https://instagram.com/liludean', 'instagram'),
(4, 'Location', 'City & Country', 'Jakarta, Indonesia', 'https://maps.google.com/?q=Jakarta', 'location');

-- --------------------------------------------------------
-- Table structure for `tbl_pesan`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `tbl_pesan`;
CREATE TABLE `tbl_pesan` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nama_pengirim` VARCHAR(100) NOT NULL,
  `email_pengirim` VARCHAR(100) NOT NULL,
  `telepon_pengirim` VARCHAR(50) DEFAULT NULL,
  `metode_komunikasi` VARCHAR(50) NOT NULL,
  `subjek` VARCHAR(150) DEFAULT 'Portfolio Inquiry',
  `pesan` TEXT NOT NULL,
  `tanggal_masuk` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `status` VARCHAR(30) DEFAULT 'Unread',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

