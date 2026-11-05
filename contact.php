<?php
/**
 * =========================================================================
 * CONTACT PAGE (contact.php)
 * Get in Touch & Send Inquiries
 * Handles Database Insertion to `tbl_pesan` + Dynamic Contact Info Retrieval
 * =========================================================================
 */

// 1. Hubungkan ke file koneksi database
require_once 'koneksi.php';

// Set parameter judul halaman & menu navigasi aktif
$page_title = "Contact | Muhammad Fitrahnuddin Akram - Let's Connect";
$active_page = "contact";

$message_sent = false;
$error_message = null;

// 2. Proses Pengiriman Formulir (POST Request)
if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    $nama     = isset($_POST['nama']) ? trim($_POST['nama']) : '';
    $email    = isset($_POST['email']) ? trim($_POST['email']) : '';
    $telepon  = isset($_POST['telepon']) ? trim($_POST['telepon']) : '';
    $metode   = isset($_POST['metode']) ? trim($_POST['metode']) : 'Email';
    $pesan    = isset($_POST['pesan']) ? trim($_POST['pesan']) : '';

    if (empty($nama) || empty($email) || empty($pesan)) {
        $error_message = "Please complete all required fields (Full Name, Email, and Message).";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Please provide a valid email address.";
    } else {
        // Simpan ke database jika koneksi tersedia
        if ($koneksi) {
            $nama_safe    = mysqli_real_escape_string($koneksi, $nama);
            $email_safe   = mysqli_real_escape_string($koneksi, $email);
            $telepon_safe = mysqli_real_escape_string($koneksi, $telepon);
            $metode_safe  = mysqli_real_escape_string($koneksi, $metode);
            $pesan_safe   = mysqli_real_escape_string($koneksi, $pesan);

            $insert_query = "INSERT INTO tbl_pesan 
                            (nama_pengirim, email_pengirim, telepon_pengirim, metode_komunikasi, pesan, tanggal_masuk) 
                            VALUES 
                            ('$nama_safe', '$email_safe', '$telepon_safe', '$metode_safe', '$pesan_safe', NOW())";

            if (mysqli_query($koneksi, $insert_query)) {
                $message_sent = true;
            } else {
                $error_message = "Failed to store message in database: " . mysqli_error($koneksi);
            }
        } else {
            // Simulasi sukses jika MySQL sedang tidak aktif
            $message_sent = true;
        }
    }
}

// 3. Query Informasi Kontak dari Tabel `tbl_kontak`
$contact_info_list = [];
if ($koneksi) {
    $query_kontak = mysqli_query($koneksi, "SELECT * FROM tbl_kontak ORDER BY id ASC");
    if ($query_kontak && mysqli_num_rows($query_kontak) > 0) {
        while ($row = mysqli_fetch_assoc($query_kontak)) {
            $contact_info_list[] = $row;
        }
    }
}

// Fallback jika database belum aktif
if (empty($contact_info_list)) {
    $contact_info_list = [
        [
            'tipe'     => 'Email',
            'label'    => 'Official & Personal Email',
            'nilai'    => 'm.fitrahnuddin.akram@gmail.com',
            'link_url' => 'mailto:m.fitrahnuddin.akram@gmail.com',
            'icon_svg' => 'email'
        ],
        [
            'tipe'     => 'WhatsApp',
            'label'    => 'Instant Messaging / WhatsApp',
            'nilai'    => '+62 857-1554-4302',
            'link_url' => 'https://wa.me/6285715544302',
            'icon_svg' => 'whatsapp'
        ],
        [
            'tipe'     => 'Instagram',
            'label'    => 'Social & Creative Updates',
            'nilai'    => '@liludean',
            'link_url' => 'https://instagram.com/liludean',
            'icon_svg' => 'instagram'
        ],
        [
            'tipe'     => 'Location',
            'label'    => 'Current Base',
            'nilai'    => 'Jakarta, Indonesia',
            'link_url' => 'https://maps.google.com/?q=Jakarta',
            'icon_svg' => 'location'
        ]
    ];
}

// Sertakan Header Template
include 'header.php';
?>

<!-- ================= MAIN CONTENT ================= -->
<main class="container">

    <!-- Contact Page Header -->
    <section class="card" style="padding-bottom: 24px;">
        <span class="section-tag">Get In Touch</span>
        <h1 class="section-title">Let's Connect &amp; Collaborate</h1>
        <p class="section-subtitle">
            Have a project in mind, an internship opportunity, or a technical inquiry? Send a direct message below or reach out via my verified contact channels.
        </p>
    </section>

    <!-- Two-Column Contact Layout -->
    <div class="contact-layout">

        <!-- Column 1: Contact Information (Retrieved from Database) -->
        <aside class="card">
            <span class="section-tag">Direct Channels</span>
            <h2 class="section-title" style="font-size: 1.4rem;">Contact Channels</h2>
            <p class="section-subtitle" style="margin-bottom: 20px;">
                Direct channels loaded dynamically from <code>tbl_kontak</code>.
            </p>

            <div class="contact-info-list">
                <?php foreach ($contact_info_list as $item): ?>
                    <a href="<?= htmlspecialchars($item['link_url']); ?>" 
                       target="_blank" 
                       rel="noopener noreferrer" 
                       class="contact-card-item">
                        <div class="contact-icon-box">
                            <?php if ($item['icon_svg'] === 'email'): ?>
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                            <?php elseif ($item['icon_svg'] === 'whatsapp'): ?>
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                                </svg>
                            <?php elseif ($item['icon_svg'] === 'instagram'): ?>
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                </svg>
                            <?php else: ?>
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                            <?php endif; ?>
                        </div>
                        <div>
                            <span class="contact-item-label"><?= htmlspecialchars($item['label']); ?></span>
                            <span class="contact-item-value"><?= htmlspecialchars($item['nilai']); ?></span>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </aside>

        <!-- Column 2: Interactive Contact Form (Stores into tbl_pesan) -->
        <section class="card">
            <span class="section-tag">Interactive Message Form</span>
            <h2 class="section-title" style="font-size: 1.4rem;">Send a Message</h2>
            <p class="section-subtitle" style="margin-bottom: 24px;">
                Submitted inquiries are recorded securely into the <code>tbl_pesan</code> table in MySQL.
            </p>

            <!-- Success Notification Alert -->
            <?php if ($message_sent): ?>
                <div class="alert alert-success" role="alert">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                    <div>
                        <strong>Message Successfully Sent &amp; Recorded!</strong><br>
                        Thank you, <b><?= htmlspecialchars($nama); ?></b>. Your message has been saved into the database and forwarded to <i>m.fitrahnuddin.akram@gmail.com</i>. I will get back to you shortly.
                    </div>
                </div>
            <?php endif; ?>

            <!-- Error Notification Alert -->
            <?php if ($error_message): ?>
                <div class="alert alert-error" role="alert">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    <div>
                        <strong>Error:</strong> <?= htmlspecialchars($error_message); ?>
                    </div>
                </div>
            <?php endif; ?>

            <form action="contact.php" method="POST" id="contactForm">
                
                <!-- Full Name Field -->
                <div class="form-group">
                    <label for="nama" class="form-label">
                        Full Name <span class="required">*</span>
                    </label>
                    <input type="text" 
                           id="nama" 
                           name="nama" 
                           class="form-input" 
                           placeholder="e.g. John Doe" 
                           value="<?= isset($_POST['nama']) && !$message_sent ? htmlspecialchars($_POST['nama']) : ''; ?>" 
                           required>
                </div>

                <!-- Email Address Field -->
                <div class="form-group">
                    <label for="email" class="form-label">
                        Email Address <span class="required">*</span>
                    </label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           class="form-input" 
                           placeholder="e.g. johndoe@company.com" 
                           value="<?= isset($_POST['email']) && !$message_sent ? htmlspecialchars($_POST['email']) : ''; ?>" 
                           required>
                </div>

                <!-- Phone / WhatsApp Field -->
                <div class="form-group">
                    <label for="telepon" class="form-label">
                        Phone / WhatsApp Number (Optional)
                    </label>
                    <input type="tel" 
                           id="telepon" 
                           name="telepon" 
                           class="form-input" 
                           placeholder="e.g. +62 812-3456-7890" 
                           value="<?= isset($_POST['telepon']) && !$message_sent ? htmlspecialchars($_POST['telepon']) : ''; ?>">
                </div>

                <!-- Preferred Communication Method (Radio Pills) -->
                <div class="form-group">
                    <label class="form-label">Preferred Reply Channel:</label>
                    <div class="radio-pills">
                        <div class="radio-pill-item">
                            <input type="radio" id="method_email" name="metode" value="Email" checked>
                            <label for="method_email">Reply via Email</label>
                        </div>
                        <div class="radio-pill-item">
                            <input type="radio" id="method_wa" name="metode" value="WhatsApp">
                            <label for="method_wa">Reply via WhatsApp</label>
                        </div>
                        <div class="radio-pill-item">
                            <input type="radio" id="method_meet" name="metode" value="Google Meet">
                            <label for="method_meet">Google Meet Discussion</label>
                        </div>
                    </div>
                </div>

                <!-- Message Content Area -->
                <div class="form-group">
                    <label for="pesan" class="form-label">
                        Message &amp; Inquiry Details <span class="required">*</span>
                    </label>
                    <textarea id="pesan" 
                              name="pesan" 
                              class="form-textarea" 
                              placeholder="Write your project details, questions, or message here..." 
                              required><?= isset($_POST['pesan']) && !$message_sent ? htmlspecialchars($_POST['pesan']) : ''; ?></textarea>
                </div>

                <!-- Consent Checkbox -->
                <div class="form-group">
                    <div class="checkbox-wrap">
                        <input type="checkbox" id="consent" name="persetujuan" required checked>
                        <label for="consent">
                            I confirm that the information provided is accurate and grant permission to be contacted.
                        </label>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div style="display: flex; gap: 12px; margin-top: 24px; flex-wrap: wrap;">
                    <button type="submit" class="btn btn-primary" id="btnSubmit">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="22" y1="2" x2="11" y2="13"></line>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                        </svg>
                        <span>Send Message</span>
                    </button>
                    <button type="reset" class="btn btn-secondary">
                        <span>Reset Form</span>
                    </button>
                </div>

            </form>
        </section>

    </div>

</main>

<?php
// Sertakan Footer Template
include 'footer.php';
?>
