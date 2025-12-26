<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Inventory Management - Kelola Stok Anda dengan Mudah</title>
    <meta name="description" content="Sistem inventory management modern untuk mengelola stok barang, supplier, dan laporan bisnis Anda dengan efisien">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- STYLES -->

    <style {csp-style-nonce}>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-color: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary-color: #64748b;
            --light-bg: #f8fafc;
            --white: #ffffff;
            --text-dark: #1e293b;
            --text-light: #64748b;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --border-radius: 8px;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            background-color: var(--white);
        }

        /* Navigation */
        .navbar {
            background: var(--white);
            box-shadow: var(--shadow);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 70px;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--primary-color);
            text-decoration: none;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 2rem;
        }

        .nav-menu a {
            color: var(--text-dark);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-menu a:hover {
            color: var(--primary-color);
        }

        .btn-primary {
            background: var(--primary-color);
            color: var(--white);
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: var(--border-radius);
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: background 0.3s ease;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: var(--white);
            padding: 120px 2rem 80px;
            text-align: center;
        }

        .hero-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .hero p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            opacity: 0.9;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-secondary {
            background: transparent;
            border: 2px solid var(--white);
            color: var(--white);
        }

        .btn-secondary:hover {
            background: var(--white);
            color: var(--primary-color);
        }

        /* Features Section */
        .features {
            padding: 80px 2rem;
            background: var(--light-bg);
        }

        .features-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 3rem;
            color: var(--text-dark);
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background: var(--white);
            padding: 2rem;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        .feature-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .feature-card h3 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--text-dark);
        }

        .feature-card p {
            color: var(--text-light);
            line-height: 1.6;
        }

        /* Stats Section */
        .stats {
            padding: 60px 2rem;
            background: var(--white);
        }

        .stats-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            text-align: center;
        }

        .stat-item h4 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .stat-item p {
            color: var(--text-light);
            font-weight: 500;
        }

        /* CTA Section */
        .cta {
            padding: 80px 2rem;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: var(--white);
            text-align: center;
        }

        .cta h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .cta p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        /* Footer */
        .footer {
            background: var(--text-dark);
            color: var(--white);
            padding: 40px 2rem 20px;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .footer p {
            opacity: 0.8;
            font-size: 0.9rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-container {
                padding: 0 1rem;
                flex-direction: column;
                height: auto;
                padding: 1rem;
            }

            .nav-menu {
                margin-top: 1rem;
                gap: 1rem;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1.1rem;
            }

            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }

            .section-title {
                font-size: 2rem;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<!-- Navigation -->
<nav class="navbar">
    <div class="nav-container">
        <a href="/" class="logo">
            <i class="fas fa-boxes"></i> Inventory Pro
        </a>
        <ul class="nav-menu">
            <li><a href="#features">Fitur</a></li>
            <li><a href="#about">Tentang</a></li>
            <li><a href="#contact">Kontak</a></li>
            <li><a href="/login" class="btn-primary">Login</a></li>
        </ul>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-container">
        <h1>Kelola Inventory Anda dengan Mudah & Efisien</h1>
        <p>Sistem manajemen inventory modern yang membantu bisnis Anda mengontrol stok barang, supplier, dan laporan dengan akurat. Tingkatkan produktivitas dan kurangi kerugian inventory.</p>
        <div class="hero-buttons">
            <a href="#features" class="btn-primary">Pelajari Fitur</a>
            <a href="/register" class="btn-secondary">Mulai Gratis</a>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="features">
    <div class="features-container">
        <h2 class="section-title">Fitur Unggulan</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-warehouse"></i>
                </div>
                <h3>Manajemen Stok Real-time</h3>
                <p>Pantau stok barang secara real-time dengan notifikasi otomatis ketika stok rendah atau habis. Hindari stockout dan overstock.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-truck"></i>
                </div>
                <h3>Pengelolaan Supplier</h3>
                <p>Kelola data supplier dengan mudah, pantau performa, dan otomatisasi proses pemesanan ulang berdasarkan level stok.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <h3>Laporan & Analitik</h3>
                <p>Generate laporan penjualan, inventory turnover, dan analitik bisnis secara real-time untuk pengambilan keputusan yang tepat.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <h3>Akses Mobile</h3>
                <p>Kelola inventory dari mana saja melalui aplikasi mobile. Sinkronisasi otomatis dengan sistem utama.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3>Keamanan Data</h3>
                <p>Enkripsi data end-to-end dan backup otomatis. Kontrol akses berbasis role untuk melindungi informasi bisnis Anda.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-cogs"></i>
                </div>
                <h3>Integrasi Mudah</h3>
                <p>Terintegrasi dengan sistem POS, e-commerce, dan ERP lainnya. API yang fleksibel untuk kebutuhan khusus.</p>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats">
    <div class="stats-container">
        <div class="stat-item">
            <h4>10K+</h4>
            <p>Bisnis Terpercaya</p>
        </div>
        <div class="stat-item">
            <h4>500K+</h4>
            <p>Produk Dikelola</p>
        </div>
        <div class="stat-item">
            <h4>99.9%</h4>
            <p>Uptime Sistem</p>
        </div>
        <div class="stat-item">
            <h4>24/7</h4>
            <p>Dukungan Teknis</p>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta">
    <div class="hero-container">
        <h2>Siap Tingkatkan Efisiensi Bisnis Anda?</h2>
        <p>Bergabunglah dengan ribuan bisnis yang telah mempercayai Inventory Pro untuk mengelola inventory mereka. Mulai uji coba gratis selama 14 hari!</p>
        <div class="hero-buttons">
            <a href="/register" class="btn-primary">Mulai Uji Coba Gratis</a>
            <a href="#contact" class="btn-secondary">Hubungi Kami</a>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <div class="footer-container">
        <p>&copy; 2025 Inventory Pro. Dibuat dengan ❤️ menggunakan CodeIgniter 4.</p>
        <p>Page rendered in {elapsed_time} seconds using {memory_usage} MB of memory.</p>
    </div>
</footer>

<!-- Scripts -->
<script {csp-script-nonce}>
    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Navbar scroll effect
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.style.background = 'rgba(255, 255, 255, 0.95)';
            navbar.style.boxShadow = 'var(--shadow)';
        } else {
            navbar.style.background = 'var(--white)';
            navbar.style.boxShadow = 'none';
        }
    });
</script>

</body>
</html>