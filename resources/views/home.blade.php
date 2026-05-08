
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ScalePro | Solusi Timbangan Truk Elektronik Profesional Indonesia</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    
    <!-- Enhanced Meta Tags for SEO -->
    <meta name="description" content="ScalePro menyediakan weighbridge truck scale dengan teknologi POWERCELL, software monitoring real-time, dan garansi 2 tahun di Tebing Tinggi">
    <meta name="keywords" content="timbangan truk, weighbridge, truck scale, timbangan elektronik, load cell">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Google Fonts untuk Typography Modern -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1e40af;
            --secondary: #0ea5e9;
            --accent: #f59e0b;
            --dark: #0f172a;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-900: #0f172a;
            --success: #10b981;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: "Inter", system-ui, -apple-system, sans-serif;
            color: #334155;
            overflow-x: hidden;
            line-height: 1.6;
        }
        
        /* ==================== MODERN NAVBAR ==================== */
        .navbar-modern {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        
        .navbar-modern.scrolled {
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        
        .navbar-brand {
            font-family: "Space Grotesk", sans-serif;
            font-weight: 700;
            font-size: 1.5rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .nav-link {
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            position: relative;
            color: var(--gray-900) !important;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        
        .nav-link:hover::after {
            width: 80%;
        }
        
        /* ==================== MODERN HERO SECTION ==================== */
        .hero-modern {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
        }
        
        .hero-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=1920') center/cover;
            opacity: 0.15;
            z-index: 1;
        }
        
        .hero-modern::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.9), rgba(14, 165, 233, 0.85));
            z-index: 2;
        }
        
        .hero-content {
            position: relative;
            z-index: 3;
            color: white;
        }
        
        .hero-title {
            font-family: "Space Grotesk", sans-serif;
            font-size: clamp(2.5rem, 6vw, 4.5rem);
            font-weight: 700;
            line-height: 1.1;
            margin-bottom: 1.5rem;
        }
        
        .hero-subtitle {
            font-size: clamp(1.1rem, 2vw, 1.4rem);
            font-weight: 400;
            opacity: 0.95;
            line-height: 1.6;
        }
        
        /* Floating Animation untuk Hero Elements */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .float-element {
            animation: float 6s ease-in-out infinite;
        }
        
        /* Stats Counter di Hero */
        .stats-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
        }
        
        .stats-card:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-5px);
        }
        
        .stats-number {
            font-size: 3rem;
            font-weight: 800;
            font-family: "Space Grotesk", sans-serif;
            margin: 0;
        }
        
        .stats-label {
            font-size: 0.95rem;
            opacity: 0.9;
            margin-top: 0.5rem;
        }
        
        /* CTA Buttons Modern */
        .btn-modern-primary {
            background: white;
            color: var(--primary);
            border: none;
            padding: 1rem 2.5rem;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        
        .btn-modern-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.15);
            color: var(--primary-dark);
        }
        
        .btn-modern-outline {
            background: transparent;
            color: white;
            border: 2px solid white;
            padding: 1rem 2.5rem;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.3s ease;
        }
        
        .btn-modern-outline:hover {
            background: white;
            color: var(--primary);
            transform: translateY(-3px);
        }
        
        /* ==================== FEATURES SECTION ==================== */
        .features-section {
            padding: 6rem 0;
            background: var(--gray-50);
        }
        
        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }
        
        .section-tag {
            display: inline-block;
            background: rgba(37, 99, 235, 0.1);
            color: var(--primary);
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }
        
        .section-title {
            font-family: "Space Grotesk", sans-serif;
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 1rem;
        }
        
        .section-description {
            font-size: 1.1rem;
            color: #64748b;
            max-width: 600px;
            margin: 0 auto;
        }
        
        /* Modern Feature Cards */
        .feature-card-modern {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            height: 100%;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid #e2e8f0;
            position: relative;
            overflow: hidden;
        }
        
        .feature-card-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }
        
        .feature-card-modern:hover::before {
            transform: scaleX(1);
        }
        
        .feature-card-modern:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(37, 99, 235, 0.15);
            border-color: var(--primary);
        }
        
        .feature-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }
        
        .feature-card-modern:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
        }
        
        .feature-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 1rem;
        }
        
        .feature-description {
            color: #64748b;
            line-height: 1.7;
        }
        
        /* ==================== SPECIFICATIONS/TECH SECTION ==================== */
        .tech-specs-section {
            padding: 6rem 0;
            background: var(--dark);
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .tech-specs-section::before {
            content: '';
            position: absolute;
            top: 0;
            right: -10%;
            width: 50%;
            height: 100%;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.1), rgba(14, 165, 233, 0.05));
            border-radius: 50%;
            filter: blur(100px);
        }
        
        .spec-item {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }
        
        .spec-item:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--secondary);
            transform: translateX(10px);
        }
        
        .spec-label {
            font-size: 0.9rem;
            opacity: 0.7;
            margin-bottom: 0.5rem;
        }
        
        .spec-value {
            font-size: 1.3rem;
            font-weight: 700;
            font-family: "Space Grotesk", sans-serif;
        }
        
        /* ==================== INTERACTIVE COMPARISON TABLE ==================== */
        .comparison-table {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 50px rgba(0,0,0,0.1);
        }
        
        .comparison-table th {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 1.5rem;
            font-weight: 600;
            border: none;
        }
        
        .comparison-table td {
            padding: 1.5rem;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .comparison-table tr:hover {
            background: var(--gray-50);
        }
        
        .check-icon {
            color: var(--success);
            font-size: 1.5rem;
        }
        
        /* ==================== PRICING CARDS ENHANCED ==================== */
        .pricing-section {
            padding: 6rem 0;
            background: linear-gradient(180deg, var(--gray-50) 0%, white 100%);
        }
        
        .price-card-modern {
            background: white;
            border-radius: 24px;
            padding: 0;
            height: 100%;
            border: 2px solid #e2e8f0;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            position: relative;
        }
        
        .price-card-modern:hover {
            transform: translateY(-15px);
            box-shadow: 0 25px 70px rgba(37, 99, 235, 0.2);
            border-color: var(--primary);
        }
        
        .price-card-header {
            padding: 2.5rem 2rem;
            text-align: center;
            background: var(--gray-50);
            position: relative;
        }
        
        .price-card-popular {
            border: 3px solid var(--accent);
            transform: scale(1.05);
        }
        
        .price-card-popular .price-card-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
        }
        
        .popular-badge-modern {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--accent);
            color: var(--dark);
            padding: 0.5rem 1.2rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .price-amount {
            font-size: 3rem;
            font-weight: 800;
            font-family: "Space Grotesk", sans-serif;
            color: var(--primary);
            margin: 1rem 0;
        }
        
        .price-card-popular .price-amount {
            color: white;
        }
        
        .price-card-body {
            padding: 2.5rem 2rem;
        }
        
        .price-features {
            list-style: none;
            padding: 0;
            margin-bottom: 2rem;
        }
        
        .price-features li {
            padding: 1rem 0;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .price-features li i {
            color: var(--success);
            font-size: 1.2rem;
        }
        
        .btn-choose-plan {
            width: 100%;
            padding: 1rem;
            border-radius: 12px;
            font-weight: 600;
            border: 2px solid var(--primary);
            background: transparent;
            color: var(--primary);
            transition: all 0.3s ease;
        }
        
        .btn-choose-plan:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(37, 99, 235, 0.3);
        }
        
        .price-card-popular .btn-choose-plan {
            background: var(--primary);
            color: white;
        }
        
        /* ==================== TESTIMONIALS SECTION ==================== */
        .testimonials-section {
            padding: 6rem 0;
            background: white;
        }
        
        .testimonial-card {
            background: var(--gray-50);
            border-radius: 20px;
            padding: 2.5rem;
            height: 100%;
            position: relative;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }
        
        .testimonial-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.08);
        }
        
        .quote-icon {
            font-size: 3rem;
            color: var(--primary);
            opacity: 0.2;
            position: absolute;
            top: 20px;
            right: 20px;
        }
        
        .testimonial-text {
            font-size: 1.05rem;
            line-height: 1.8;
            color: #475569;
            margin-bottom: 2rem;
            position: relative;
            z-index: 1;
        }
        
        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .author-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        .author-name {
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 0.2rem;
        }
        
        .author-company {
            font-size: 0.9rem;
            color: #64748b;
        }
        
        /* ==================== PROCESS/TIMELINE SECTION ==================== */
        .process-section {
            padding: 6rem 0;
            background: var(--gray-50);
        }
        
        .timeline {
            position: relative;
            padding: 2rem 0;
        }
        
        .timeline::before {
            content: '';
            position: absolute;
            left: 50%;
            top: 0;
            bottom: 0;
            width: 3px;
            background: linear-gradient(180deg, var(--primary), var(--secondary));
            transform: translateX(-50%);
        }
        
        .timeline-item {
            display: flex;
            margin-bottom: 3rem;
            position: relative;
        }
        
        .timeline-item:nth-child(odd) {
            flex-direction: row-reverse;
        }
        
        .timeline-content {
            flex: 1;
            background: white;
            padding: 2rem;
            border-radius: 16px;
            margin: 0 2rem;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            position: relative;
        }
        
        .timeline-number {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 800;
            font-size: 1.5rem;
            box-shadow: 0 5px 20px rgba(37, 99, 235, 0.4);
            z-index: 2;
        }
        
        /* ==================== FAQ ACCORDION ==================== */
        .faq-section {
            padding: 6rem 0;
            background: white;
        }
        
        .accordion-button {
            background: var(--gray-50);
            color: var(--dark);
            font-weight: 600;
            font-size: 1.1rem;
            padding: 1.5rem;
            border: none;
            border-radius: 12px !important;
        }
        
        .accordion-button:not(.collapsed) {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            box-shadow: 0 5px 20px rgba(37, 99, 235, 0.3);
        }
        
        .accordion-button:focus {
            box-shadow: none;
        }
        
        .accordion-item {
            border: none;
            margin-bottom: 1rem;
            border-radius: 12px;
            overflow: hidden;
        }
        
        .accordion-body {
            padding: 1.5rem;
            background: var(--gray-50);
            color: #475569;
            line-height: 1.8;
        }
        
        /* ==================== CONTACT SECTION ==================== */
        .contact-section {
            padding: 6rem 0;
            background: linear-gradient(135deg, var(--dark) 0%, #1e293b 100%);
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .contact-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 2.5rem;
            transition: all 0.3s ease;
        }
        
        .contact-card:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-5px);
        }
        
        .contact-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
        }
        
        /* ==================== FOOTER ==================== */
        .footer-modern {
            background: #0a0f1e;
            color: white;
            padding: 4rem 0 2rem;
        }
        
        .footer-links a {
            color: #94a3b8;
            text-decoration: none;
            transition: all 0.3s ease;
            display: block;
            padding: 0.5rem 0;
        }
        
        .footer-links a:hover {
            color: var(--secondary);
            transform: translateX(5px);
        }
        
        /* ==================== SCROLL TO TOP BUTTON ==================== */
        .scroll-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 999;
            box-shadow: 0 5px 20px rgba(37, 99, 235, 0.4);
        }
        
        .scroll-to-top.show {
            opacity: 1;
            visibility: visible;
        }
        
        .scroll-to-top:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(37, 99, 235, 0.5);
        }
        
        /* ==================== RESPONSIVE ==================== */
        @media (max-width: 992px) {
            .timeline::before {
                left: 30px;
            }
            
            .timeline-item,
            .timeline-item:nth-child(odd) {
                flex-direction: row;
            }
            
            .timeline-number {
                left: 30px;
            }
            
            .timeline-content {
                margin-left: 100px;
                margin-right: 0;
            }
        }
        
        @media (max-width: 768px) {
            .stats-card {
                margin-bottom: 1rem;
            }
            
            .hero-title {
                font-size: 2rem;
            }
            
            .section-title {
                font-size: 1.8rem;
            }
        }
        
        /* Loading Animation */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }
        
        .loading-overlay.hidden {
            opacity: 0;
            visibility: hidden;
        }
        
        .loader {
            width: 60px;
            height: 60px;
            border: 5px solid rgba(255,255,255,0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>

<!-- LOADING SCREEN -->
<div class="loading-overlay" id="loadingOverlay">
    <div class="loader"></div>
</div>

<!-- NAVBAR MODERN -->
<nav class="navbar navbar-expand-lg navbar-modern sticky-top" id="navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home.index') }}">
            <i class="bi bi-speedometer2 me-2"></i>ScalePro
        </a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link px-3" href="#solusi">Solusi</a></li>
                <li class="nav-item"><a class="nav-link px-3" href="#teknologi">Teknologi</a></li>
                <li class="nav-item"><a class="nav-link px-3" href="#fitur">Fitur</a></li>
                <li class="nav-item"><a class="nav-link px-3" href="#paket">Paket</a></li>
                <li class="nav-item"><a class="nav-link px-3" href="#testimoni">Testimoni</a></li>
                <li class="nav-item"><a class="nav-link px-3" href="#faq">FAQ</a></li>
                <li class="nav-item ms-3">
                    <a href="/login" class="btn btn-modern-primary px-4">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Masuk Sistem
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- HERO MODERN -->
<section class="hero-modern" id="hero">
    <div class="container hero-content">
        <div class="row align-items-center">
            <div class="col-lg-7" data-aos="fade-right">
                <h1 class="hero-title">
                    Weighbridge Profesional untuk<br>
                    <span style="background: linear-gradient(90deg, #fbbf24, #f59e0b); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Bisnis Modern</span>
                </h1>
                <p class="hero-subtitle mb-5">
                    Sistem timbangan truk elektronik dengan teknologi POWERCELL, 
                    software monitoring real-time, dan integrasi ERP. Akurasi tinggi, 
                    instalasi cepat, garansi 2 tahun.
                </p>
                <div class="d-flex gap-3 flex-wrap mb-5">
                    <a href="#paket" class="btn btn-modern-primary">
                        <i class="bi bi-lightning-charge me-2"></i>Lihat Paket Harga
                    </a>
                    <a href="#kontak" class="btn btn-modern-outline">
                        <i class="bi bi-telephone me-2"></i>Konsultasi Gratis
                    </a>
                </div>
                
                <!-- Trust Indicators -->
                <div class="row g-3 mt-4">
                    <div class="col-6 col-md-3">
                        <div class="stats-card float-element" style="animation-delay: 0s">
                            <p class="stats-number" style="font-size: 1.5rem; width: 100%;">200+</p>
                            <p class="stats-label">Proyek Selesai</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="stats-card float-element" style="animation-delay: 0.5s">
                            <p class="stats-number" style="font-size: 1.5rem; width: 100%;">98%</p>
                            <p class="stats-label">Kepuasan Klien</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="stats-card float-element" style="animation-delay: 1s">
                            <p class="stats-number" style="font-size: 1.5rem; width: 100%;">24hr</p>
                            <p class="stats-label">Support Teknis</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="stats-card float-element" style="animation-delay: 1.5s">
                            <p class="stats-number" style="font-size: 1.5rem; width: 100%;">2 Thn</p>
                            <p class="stats-label">Garansi</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-5 mt-5 mt-lg-0" data-aos="fade-left">
                <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=800" 
                     alt="Truck Weighbridge" 
                     class="img-fluid rounded-4 shadow-lg float-element"
                     style="border: 5px solid rgba(255,255,255,0.2);">
            </div>
        </div>
    </div>
</section>

<!-- SOLUSI/LAYANAN SECTION -->
<section id="solusi" class="features-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-tag">LAYANAN KAMI</span>
            <h2 class="section-title">Solusi Lengkap Weight Bridge</h2>
            <p class="section-description">
                Dari hardware timbangan hingga software monitoring, kami menyediakan 
                solusi terintegrasi untuk kebutuhan penimbangan industri Anda
            </p>
        </div>

        <div class="row g-4">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-card-modern">
                    <div class="feature-icon">
                        <i class="bi bi-truck"></i>
                    </div>
                    <h3 class="feature-title">Weight Bridge Premium</h3>
                    <p class="feature-description">
                        Timbangan truk kapasitas 40-100 ton dengan struktur modular H-beam, 
                        checkered steel deck, dan load cell POWERCELL berteknologi tinggi. 
                        Instalasi pit-mounted atau surface-mounted.
                    </p>
                    <ul class="list-unstyled mt-3">
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Load Cell IP68</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Akurasi ±0.1%</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Modular Design</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-card-modern">
                    <div class="feature-icon">
                        <i class="bi bi-laptop"></i>
                    </div>
                    <h3 class="feature-title">Software Monitoring Real-Time</h3>
                    <p class="feature-description">
                        Platform ScalePro dengan dashboard interaktif, laporan otomatis Excel/PDF, 
                        data visualization, multi-user access, dan integrasi ERP. Akses dari desktop atau mobile.
                    </p>
                    <ul class="list-unstyled mt-3">
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Cloud-Based</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Auto Reports</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>API Integration</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-card-modern">
                    <div class="feature-icon">
                        <i class="bi bi-tools"></i>
                    </div>
                    <h3 class="feature-title">Instalasi & Service 24/7</h3>
                    <p class="feature-description">
                        Tim teknisi bersertifikat untuk pemasangan, kalibrasi, maintenance berkala, 
                        dan emergency support. Dilengkapi dengan BridgeCare service agreement.
                    </p>
                    <ul class="list-unstyled mt-3">
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Quick Installation</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Legal Calibration</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Priority Support</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TEKNOLOGI/SPECS SECTION -->
<section id="teknologi" class="tech-specs-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <span class="section-tag" style="background: rgba(255,255,255,0.15); color: white;">TEKNOLOGI TERKINI</span>
                <h2 class="section-title mt-3" style="color: white;">
                    POWERCELL Load Cell Technology
                </h2>
                <p class="lead mb-4" style="color: rgba(255,255,255,0.9);">
                    Kami menggunakan load cell berstandar internasional OIML dengan 
                    sertifikasi IP68 untuk ketahanan maksimal di lingkungan industri
                </p>
                
                <div class="spec-item">
                    <div class="spec-label">Kapasitas Maksimal</div>
                    <div class="spec-value">100 Ton</div>
                </div>
                
                <div class="spec-item">
                    <div class="spec-label">Tingkat Akurasi</div>
                    <div class="spec-value">± 0.1% - 0.5%</div>
                </div>
                
                <div class="spec-item">
                    <div class="spec-label">Jenis Pemasangan</div>
                    <div class="spec-value">Pit-Mount / Surface-Mount / Portable</div>
                </div>
                
                <div class="spec-item">
                    <div class="spec-label">Konektivitas</div>
                    <div class="spec-value">RS232, RS485, Ethernet, WiFi</div>
                </div>
                
                <div class="spec-item">
                    <div class="spec-label">Garansi Load Cell</div>
                    <div class="spec-value">10 Tahun (Comprehensive)</div>
                </div>
            </div>
            
            <div class="col-lg-6 mt-5 mt-lg-0" data-aos="fade-left">
                <img src="https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=800" 
                     alt="Weighbridge Technology" 
                     class="img-fluid rounded-4"
                     style="box-shadow: 0 20px 60px rgba(0,0,0,0.5);">
            </div>
        </div>
    </div>
</section>

<!-- FITUR SOFTWARE SECTION -->
<section id="fitur" class="features-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-tag">FITUR UNGGULAN</span>
            <h2 class="section-title">ScalePro Software Features</h2>
            <p class="section-description">
                Platform manajemen weighbridge yang powerful dengan fitur-fitur modern 
                untuk efisiensi operasional maksimal
            </p>
        </div>

        <div class="row g-4">
            <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                <div class="feature-card-modern text-center">
                    <div class="feature-icon mx-auto">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                    <h4 class="feature-title">Real-Time Dashboard</h4>
                    <p class="feature-description">
                        Monitor aktivitas penimbangan secara live dengan visualisasi data yang mudah dipahami
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                <div class="feature-card-modern text-center">
                    <div class="feature-icon mx-auto">
                        <i class="bi bi-file-earmark-pdf"></i>
                    </div>
                    <h4 class="feature-title">Auto Reporting</h4>
                    <p class="feature-description">
                        Generate laporan harian, mingguan, bulanan dalam format Excel dan PDF otomatis
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="300">
                <div class="feature-card-modern text-center">
                    <div class="feature-icon mx-auto">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h4 class="feature-title">Fraud Prevention</h4>
                    <p class="feature-description">
                        Sistem keamanan berlapis dengan ANPR (Automatic Number Plate Recognition)
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="400">
                <div class="feature-card-modern text-center">
                    <div class="feature-icon mx-auto">
                        <i class="bi bi-cloud-arrow-up"></i>
                    </div>
                    <h4 class="feature-title">Cloud Backup</h4>
                    <p class="feature-description">
                        Data tersimpan aman di cloud dengan enkripsi dan backup otomatis setiap hari
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="500">
                <div class="feature-card-modern text-center">
                    <div class="feature-icon mx-auto">
                        <i class="bi bi-people"></i>
                    </div>
                    <h4 class="feature-title">Multi-User Access</h4>
                    <p class="feature-description">
                        Role-based access control untuk tim dengan level akses yang berbeda
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="600">
                <div class="feature-card-modern text-center">
                    <div class="feature-icon mx-auto">
                        <i class="bi bi-phone"></i>
                    </div>
                    <h4 class="feature-title">Mobile App</h4>
                    <p class="feature-description">
                        Akses sistem dari smartphone Android/iOS untuk monitoring on-the-go
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="700">
                <div class="feature-card-modern text-center">
                    <div class="feature-icon mx-auto">
                        <i class="bi bi-plug"></i>
                    </div>
                    <h4 class="feature-title">ERP Integration</h4>
                    <p class="feature-description">
                        API untuk integrasi dengan SAP, Oracle, atau sistem ERP Anda
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="800">
                <div class="feature-card-modern text-center">
                    <div class="feature-icon mx-auto">
                        <i class="bi bi-camera-video"></i>
                    </div>
                    <h4 class="feature-title">CCTV Integration</h4>
                    <p class="feature-description">
                        Rekam setiap transaksi penimbangan dengan snapshot/video otomatis
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- PROCESS/HOW IT WORKS TIMELINE -->
<section id="proses" class="process-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-tag">BAGAIMANA KAMI BEKERJA</span>
            <h2 class="section-title">Proses Instalasi ScalePro</h2>
            <p class="section-description">
                Dari survey hingga training, kami memastikan setiap tahapan berjalan profesional
            </p>
        </div>

        <div class="timeline">
            <div class="timeline-item" data-aos="fade-up">
                <div class="timeline-number">1</div>
                <div class="timeline-content">
                    <h4 class="fw-bold mb-2">Survey & Konsultasi</h4>
                    <p class="mb-0">
                        Tim kami mengunjungi lokasi untuk analisis kebutuhan, pengukuran area, 
                        dan memberikan rekomendasi tipe weighbridge yang sesuai
                    </p>
                </div>
            </div>

            <div class="timeline-item" data-aos="fade-up" data-aos-delay="100">
                <div class="timeline-number">2</div>
                <div class="timeline-content">
                    <h4 class="fw-bold mb-2">Desain & Proposal</h4>
                    <p class="mb-0">
                        Penyusunan gambar teknis, spesifikasi detail, RAB, dan timeline pengerjaan 
                        sesuai kebutuhan operasional Anda
                    </p>
                </div>
            </div>

            <div class="timeline-item" data-aos="fade-up" data-aos-delay="200">
                <div class="timeline-number">3</div>
                <div class="timeline-content">
                    <h4 class="fw-bold mb-2">Civil Works & Pondasi</h4>
                    <p class="mb-0">
                        Persiapan pondasi beton sesuai standar, instalasi pit (jika diperlukan), 
                        dan pembangunan infrastruktur pendukung
                    </p>
                </div>
            </div>

            <div class="timeline-item" data-aos="fade-up" data-aos-delay="300">
                <div class="timeline-number">4</div>
                <div class="timeline-content">
                    <h4 class="fw-bold mb-2">Instalasi Hardware</h4>
                    <p class="mb-0">
                        Pemasangan deck timbangan, load cell, junction box, indicator, dan 
                        semua perangkat elektronis dengan presisi tinggi
                    </p>
                </div>
            </div>

            <div class="timeline-item" data-aos="fade-up" data-aos-delay="400">
                <div class="timeline-number">5</div>
                <div class="timeline-content">
                    <h4 class="fw-bold mb-2">Software Setup & Kalibrasi</h4>
                    <p class="mb-0">
                        Instalasi software ScalePro, konfigurasi sistem, kalibrasi legal, 
                        dan testing untuk memastikan akurasi maksimal
                    </p>
                </div>
            </div>

            <div class="timeline-item" data-aos="fade-up" data-aos-delay="500">
                <div class="timeline-number">6</div>
                <div class="timeline-content">
                    <h4 class="fw-bold mb-2">Training & Handover</h4>
                    <p class="mb-0">
                        Pelatihan operator, dokumentasi lengkap, sertifikat kalibrasi, 
                        dan official handover dengan garansi 2 tahun
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- PRICING SECTION ENHANCED -->
<section id="paket" class="pricing-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-tag">PAKET HARGA</span>
            <h2 class="section-title">Investasi untuk Bisnis Anda</h2>
            <p class="section-description">
                Pilih paket yang sesuai dengan skala operasional dan budget perusahaan Anda. 
                Semua paket sudah termasuk instalasi dan training
            </p>
        </div>

        <div class="row g-4 align-items-center">
            <!-- Paket 1: Starter -->
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="price-card-modern">
                    <div class="price-card-header">
                        <h5 class="fw-bold mb-2">STARTER</h5>
                        <div class="price-amount">75 Jt</div>
                        <p class="mb-0 small">Timbangan 40 Ton</p>
                    </div>
                    <div class="price-card-body">
                        <ul class="price-features">
                            <li><i class="bi bi-check-circle-fill"></i>Weighbridge 40T</li>
                            <li><i class="bi bi-check-circle-fill"></i>4 Load Cells</li>
                            <li><i class="bi bi-check-circle-fill"></i>Basic Indicator</li>
                            <li><i class="bi bi-check-circle-fill"></i>Pemasangan</li>
                            <li><i class="bi bi-check-circle-fill"></i>Kalibrasi Legal</li>
                            <li><i class="bi bi-check-circle-fill"></i>Garansi 1 Tahun</li>
                            <li style="opacity: 0.4;"><i class="bi bi-x-circle"></i>Software Digital</li>
                        </ul>
                        <button class="btn-choose-plan">Pilih Paket</button>
                    </div>
                </div>
            </div>

            <!-- Paket 2: Business -->
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="price-card-modern">
                    <div class="price-card-header">
                        <h5 class="fw-bold mb-2">BUSINESS</h5>
                        <div class="price-amount">95 Jt</div>
                        <p class="mb-0 small">Timbangan 50 Ton</p>
                    </div>
                    <div class="price-card-body">
                        <ul class="price-features">
                            <li><i class="bi bi-check-circle-fill"></i>Weighbridge 50T</li>
                            <li><i class="bi bi-check-circle-fill"></i>6 Load Cells POWERCELL</li>
                            <li><i class="bi bi-check-circle-fill"></i>Touchscreen Indicator</li>
                            <li><i class="bi bi-check-circle-fill"></i>Software ScalePro Basic</li>
                            <li><i class="bi bi-check-circle-fill"></i>Real-Time Monitoring</li>
                            <li><i class="bi bi-check-circle-fill"></i>Thermal Printer</li>
                            <li><i class="bi bi-check-circle-fill"></i>Garansi 18 Bulan</li>
                        </ul>
                        <button class="btn-choose-plan">Pilih Paket</button>
                    </div>
                </div>
            </div>

            <!-- Paket 3: Professional (POPULAR) -->
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="price-card-modern price-card-popular">
                    <span class="popular-badge-modern">TERPOPULER</span>
                    <div class="price-card-header">
                        <h5 class="fw-bold mb-2">PROFESSIONAL</h5>
                        <div class="price-amount">135 Jt</div>
                        <p class="mb-0 small">Timbangan 60 Ton</p>
                    </div>
                    <div class="price-card-body">
                        <ul class="price-features">
                            <li><i class="bi bi-check-circle-fill"></i>Weighbridge 60T Premium</li>
                            <li><i class="bi bi-check-circle-fill"></i>8 Load Cells POWERCELL</li>
                            <li><i class="bi bi-check-circle-fill"></i>Advanced Terminal</li>
                            <li><i class="bi bi-check-circle-fill"></i>Software ScalePro Pro</li>
                            <li><i class="bi bi-check-circle-fill"></i>Cloud Dashboard</li>
                            <li><i class="bi bi-check-circle-fill"></i>Auto Reports (Excel/PDF)</li>
                            <li><i class="bi bi-check-circle-fill"></i>Multi-User (5 User)</li>
                            <li><i class="bi bi-check-circle-fill"></i>CCTV Integration</li>
                            <li><i class="bi bi-check-circle-fill"></i>Garansi 2 Tahun</li>
                            <li><i class="bi bi-check-circle-fill"></i>Priority Support 24/7</li>
                        </ul>
                        <button class="btn-choose-plan">Pilih Paket</button>
                    </div>
                </div>
            </div>

            <!-- Paket 4: Enterprise -->
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="price-card-modern">
                    <div class="price-card-header">
                        <h5 class="fw-bold mb-2">ENTERPRISE</h5>
                        <div class="price-amount">185 Jt</div>
                        <p class="mb-0 small">Timbangan 80-100 Ton</p>
                    </div>
                    <div class="price-card-body">
                        <ul class="price-features">
                            <li><i class="bi bi-check-circle-fill"></i>Weighbridge 100T Heavy Duty</li>
                            <li><i class="bi bi-check-circle-fill"></i>10 POWERCELL Load Cells</li>
                            <li><i class="bi bi-check-circle-fill"></i>Industrial-Grade Terminal</li>
                            <li><i class="bi bi-check-circle-fill"></i>ScalePro Enterprise</li>
                            <li><i class="bi bi-check-circle-fill"></i>ERP Integration (API)</li>
                            <li><i class="bi bi-check-circle-fill"></i>ANPR System</li>
                            <li><i class="bi bi-check-circle-fill"></i>Traffic Light & Barrier</li>
                            <li><i class="bi bi-check-circle-fill"></i>Mobile App iOS/Android</li>
                            <li><i class="bi bi-check-circle-fill"></i>Unlimited Users</li>
                            <li><i class="bi bi-check-circle-fill"></i>Maintenance 2 Tahun</li>
                            <li><i class="bi bi-check-circle-fill"></i>Dedicated Engineer</li>
                        </ul>
                        <button class="btn-choose-plan">Hubungi Sales</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Comparison Table -->
        <div class="mt-5 pt-5" data-aos="fade-up">
            <h3 class="text-center mb-4 fw-bold">Perbandingan Lengkap Paket</h3>
            <div class="table-responsive">
                <table class="table comparison-table text-center">
                    <thead>
                        <tr>
                            <th class="text-start">Fitur</th>
                            <th>Starter</th>
                            <th>Business</th>
                            <th>Professional</th>
                            <th>Enterprise</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-start fw-bold">Kapasitas</td>
                            <td>40 Ton</td>
                            <td>50 Ton</td>
                            <td>60 Ton</td>
                            <td>80-100 Ton</td>
                        </tr>
                        <tr>
                            <td class="text-start fw-bold">Software Monitoring</td>
                            <td>-</td>
                            <td><i class="check-icon">✓</i></td>
                            <td><i class="check-icon">✓</i></td>
                            <td><i class="check-icon">✓</i></td>
                        </tr>
                        <tr>
                            <td class="text-start fw-bold">Cloud Dashboard</td>
                            <td>-</td>
                            <td>-</td>
                            <td><i class="check-icon">✓</i></td>
                            <td><i class="check-icon">✓</i></td>
                        </tr>
                        <tr>
                            <td class="text-start fw-bold">ERP Integration</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td><i class="check-icon">✓</i></td>
                        </tr>
                        <tr>
                            <td class="text-start fw-bold">ANPR System</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td><i class="check-icon">✓</i></td>
                        </tr>
                        <tr>
                            <td class="text-start fw-bold">Garansi</td>
                            <td>1 Tahun</td>
                            <td>18 Bulan</td>
                            <td>2 Tahun</td>
                            <td>2 Tahun</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- TESTIMONIALS SECTION -->
<section id="testimoni" class="testimonials-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-tag">TESTIMONI KLIEN</span>
            <h2 class="section-title">Apa Kata Mereka?</h2>
            <p class="section-description">
                Lebih dari 200 perusahaan mempercayai ScalePro untuk kebutuhan weighbridge mereka
            </p>
        </div>

        <div class="row g-4">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="testimonial-card">
                    <i class="bi bi-quote quote-icon"></i>
                    <p class="testimonial-text">
                        "Software monitoring ScalePro sangat membantu operasional kami. 
                        Real-time dashboard dan laporan otomatis membuat pekerjaan jauh lebih efisien. 
                        Tim support juga sangat responsif!"
                    </p>
                    <div class="testimonial-author">
                        <div class="author-avatar">BW</div>
                        <div>
                            <div class="author-name">Budi Wibowo</div>
                            <div class="author-company">PT Semen Tebing Jaya</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="testimonial-card">
                    <i class="bi bi-quote quote-icon"></i>
                    <p class="testimonial-text">
                        "Instalasi cepat, kalibrasi akurat, dan garansi yang jelas. 
                        ScalePro memberikan value yang sangat baik untuk investasi kami. 
                        Highly recommended untuk perusahaan logistik!"
                    </p>
                    <div class="testimonial-author">
                        <div class="author-avatar">SR</div>
                        <div>
                            <div class="author-name">Siti Rahmawati</div>
                            <div class="author-company">CV Maju Bersama Logistik</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="testimonial-card">
                    <i class="bi bi-quote quote-icon"></i>
                    <p class="testimonial-text">
                        "Kami sudah gunakan ScalePro sejak 2022 dan tidak ada masalah berarti. 
                        Maintenance rutin dilakukan dengan baik, dan spare part selalu tersedia. 
                        Partner terpercaya!"
                    </p>
                    <div class="testimonial-author">
                        <div class="author-avatar">AP</div>
                        <div>
                            <div class="author-name">Ahmad Pratama</div>
                            <div class="author-company">PT Perkebunan Sawit Nusantara</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ SECTION -->
<section id="faq" class="faq-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-tag">FAQ</span>
            <h2 class="section-title">Pertanyaan yang Sering Diajukan</h2>
            <p class="section-description">
                Temukan jawaban untuk pertanyaan umum seputar produk dan layanan kami
            </p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="fade-up">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                Berapa lama waktu instalasi weighbridge?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Untuk instalasi surface-mounted, biasanya memakan waktu 7-10 hari kerja termasuk pondasi. 
                                Untuk pit-mounted memerlukan 14-21 hari tergantung kondisi tanah dan cuaca. 
                                Ini sudah termasuk civil works, instalasi hardware, software setup, dan kalibrasi legal.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                Apakah software bisa diakses dari jarak jauh?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Ya! ScalePro menggunakan cloud-based system yang bisa diakses dari mana saja melalui 
                                browser atau mobile app (iOS/Android). Anda bisa monitoring real-time, lihat laporan, 
                                dan export data kapanpun dibutuhkan dengan koneksi internet.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                Bagaimana dengan kalibrasi ulang?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Kalibrasi legal harus dilakukan minimal 1 tahun sekali sesuai regulasi. 
                                Kami menyediakan layanan kalibrasi dengan sertifikat resmi dari lembaga metrologi. 
                                Untuk paket Professional dan Enterprise, kalibrasi tahunan sudah included dalam garansi.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                Apakah bisa integrasi dengan sistem ERP yang sudah ada?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Tentu saja! ScalePro menyediakan REST API yang bisa diintegrasikan dengan berbagai sistem ERP 
                                seperti SAP, Oracle, Odoo, atau custom ERP Anda. Tim IT kami akan membantu proses integrasi 
                                dan testing. Fitur ini tersedia di paket Enterprise.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                                Bagaimana sistem pembayarannya?
                            </button>
                        </h2>
                        <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Kami menerima pembayaran dengan skema: DP 30% saat kontrak, 40% saat instalasi dimulai, 
                                dan 30% pelunasan setelah testing & handover. Untuk perusahaan dengan reputasi baik, 
                                kami juga menyediakan opsi leasing/kredit melalui partner finance kami.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CONTACT SECTION -->
<section id="kontak" class="contact-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
                <span class="section-tag" style="background: rgba(255,255,255,0.15); color: white;">HUBUNGI KAMI</span>
                <h2 class="section-title mt-3" style="color: white;">
                    Siap Upgrade Sistem Penimbangan Anda?
                </h2>
                <p class="lead mb-4" style="color: rgba(255,255,255,0.9);">
                    Dapatkan konsultasi gratis dan penawaran terbaik dari tim expert kami. 
                    Survey lokasi tanpa biaya untuk wilayah Tebing Tinggi dan sekitarnya.
                </p>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="contact-card">
                            <div class="contact-icon">
                                <i class="bi bi-whatsapp"></i>
                            </div>
                            <h5 class="fw-bold mb-2">WhatsApp</h5>
                            <a href="https://wa.me/6281234567890" class="text-white text-decoration-none">
                                0812-3456-7890
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="contact-card">
                            <div class="contact-icon">
                                <i class="bi bi-telephone"></i>
                            </div>
                            <h5 class="fw-bold mb-2">Telepon</h5>
                            <a href="tel:0611234567" class="text-white text-decoration-none">
                                (061) 123-4567
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="contact-card">
                            <div class="contact-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <h5 class="fw-bold mb-2">Email</h5>
                            <a href="mailto:info@scalepro.co.id" class="text-white text-decoration-none">
                                info@scalepro.co.id
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="contact-card">
                            <div class="contact-icon">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <h5 class="fw-bold mb-2">Kantor</h5>
                            <p class="mb-0 small">Jl. Jend. Sudirman No. 45<br>Tebing Tinggi, Sumut</p>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="https://wa.me/6281234567890" class="btn btn-modern-primary btn-lg me-3">
                        <i class="bi bi-whatsapp me-2"></i>Chat WhatsApp
                    </a>
                    <a href="tel:0611234567" class="btn btn-modern-outline btn-lg">
                        <i class="bi bi-telephone me-2"></i>Telepon Sekarang
                    </a>
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-left">
                <div class="contact-card p-4">
                    <h4 class="fw-bold mb-4">Request Penawaran</h4>
                    <form>
                        <div class="mb-3">
                            <input type="text" class="form-control form-control-lg" placeholder="Nama Lengkap" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control form-control-lg" placeholder="Nama Perusahaan" required>
                        </div>
                        <div class="mb-3">
                            <input type="tel" class="form-control form-control-lg" placeholder="No. WhatsApp" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control form-control-lg" placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <select class="form-select form-select-lg" required>
                                <option value="">Pilih Paket</option>
                                <option value="starter">Starter - 75 Juta</option>
                                <option value="business">Business - 95 Juta</option>
                                <option value="professional">Professional - 135 Juta</option>
                                <option value="enterprise">Enterprise - 185 Juta</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control form-control-lg" rows="3" placeholder="Pesan / Kebutuhan Khusus"></textarea>
                        </div>
                        <button type="submit" class="btn btn-modern-primary w-100 btn-lg">
                            <i class="bi bi-send me-2"></i>Kirim Permintaan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER MODERN -->
<footer class="footer-modern">
    <div class="container">
        <div class="row g-4 mb-4">
            <div class="col-lg-4">
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-speedometer2 fs-2 text-primary me-2"></i>
                    <h4 class="fw-bold mb-0">ScalePro</h4>
                </div>
                <p class="text-secondary mb-3">
                    Solusi timbangan truk elektronik profesional dengan teknologi terkini 
                    untuk efisiensi operasional maksimal di industri Anda.
                </p>
                <div class="d-flex gap-3">
                    <a href="#" class="text-secondary fs-5"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-secondary fs-5"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-secondary fs-5"><i class="bi bi-linkedin"></i></a>
                    <a href="#" class="text-secondary fs-5"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-6">
                <h6 class="fw-bold mb-3 text-white">Produk</h6>
                <div class="footer-links">
                    <a href="#solusi">Weight Bridge</a>
                    <a href="#fitur">Software</a>
                    <a href="#teknologi">Load Cell</a>
                    <a href="#paket">Paket Harga</a>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-6">
                <h6 class="fw-bold mb-3 text-white">Perusahaan</h6>
                <div class="footer-links">
                    <a href="#">Tentang Kami</a>
                    <a href="#testimoni">Testimoni</a>
                    <a href="#">Portfolio</a>
                    <a href="#">Karir</a>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-6">
                <h6 class="fw-bold mb-3 text-white">Support</h6>
                <div class="footer-links">
                    <a href="#faq">FAQ</a>
                    <a href="#">Dokumentasi</a>
                    <a href="#">Service Center</a>
                    <a href="#">Garansi</a>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-6">
                <h6 class="fw-bold mb-3 text-white">Kontak</h6>
                <div class="footer-links">
                    <a href="tel:0611234567"><i class="bi bi-telephone me-2"></i>(061) 123-4567</a>
                    <a href="https://wa.me/6281234567890"><i class="bi bi-whatsapp me-2"></i>0812-3456-7890</a>
                    <a href="mailto:info@scalepro.co.id"><i class="bi bi-envelope me-2"></i>info@scalepro.co.id</a>
                </div>
            </div>
        </div>
        
        <hr class="border-secondary my-4">
        
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <p class="text-secondary mb-0 small">
                    © 2026 ScalePro Indonesia. All Rights Reserved.
                </p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <a href="#" class="text-secondary small me-3 text-decoration-none">Privacy Policy</a>
                <a href="#" class="text-secondary small me-3 text-decoration-none">Terms of Service</a>
                <a href="#" class="text-secondary small text-decoration-none">Sitemap</a>
            </div>
        </div>
    </div>
</footer>

<!-- SCROLL TO TOP -->
<div class="scroll-to-top" id="scrollToTop">
    <i class="bi bi-arrow-up"></i>
</div>

<!-- SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    // Initialize AOS
    AOS.init({
        duration: 800,
        once: true,
        offset: 100
    });

    // Loading Screen
    window.addEventListener('load', function() {
        setTimeout(() => {
            document.getElementById('loadingOverlay').classList.add('hidden');
        }, 800);
    });

    // Navbar Scroll Effect
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // Scroll to Top Button
    const scrollToTopBtn = document.getElementById('scrollToTop');
    window.addEventListener('scroll', function() {
        if (window.scrollY > 300) {
            scrollToTopBtn.classList.add('show');
        } else {
            scrollToTopBtn.classList.remove('show');
        }
    });

    scrollToTopBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // Smooth Scroll for Navigation Links
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

    // Counter Animation for Stats
    function animateCounter(element, target, duration = 2000) {
        let current = 0;
        const increment = target / (duration / 16);
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                element.textContent = target + (element.dataset.suffix || '');
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(current) + (element.dataset.suffix || '');
            }
        }, 16);
    }

    // Trigger counter animation when in viewport
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const statsNumbers = entry.target.querySelectorAll('.stats-number');
                statsNumbers.forEach(stat => {
                    const target = parseInt(stat.textContent);
                    stat.dataset.suffix = stat.textContent.replace(/[0-9]/g, '');
                    animateCounter(stat, target);
                });
                observer.unobserve(entry.target);
            }
        });
    });

    const heroSection = document.querySelector('#hero');
    if (heroSection) observer.observe(heroSection);

    // Form Submission
    const contactForm = document.querySelector('form');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Terima kasih! Tim kami akan segera menghubungi Anda.');
            contactForm.reset();
        });
    }
</script>

</body>
</html>
