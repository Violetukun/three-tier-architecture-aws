<?php
// --- PHP DATA ARRAYS FOR DYNAMIC RENDERING ---

$navLinks = [
    'home' => 'HOME',
    'locations' => 'LOCATIONS',
    'services' => 'SERVICES',
    'test-directory' => 'TEST DIRECTORY',
    'about' => 'ABOUT US'
];

$services = [
    ['icon' => 'fa-flask', 'name' => 'Fully Automated Lab', 'asterisk' => false],
    ['icon' => 'fa-ring', 'name' => 'CT-Scan', 'asterisk' => true],
    ['icon' => 'fa-user-doctor', 'name' => 'Multi-Specialty Doctors', 'asterisk' => false],
    ['icon' => 'fa-x-ray', 'name' => 'X-Ray', 'asterisk' => false],
    ['icon' => 'fa-heart-pulse', 'name' => 'ECG', 'asterisk' => false],
    ['icon' => 'fa-house', 'name' => 'Home Service', 'asterisk' => false],
    ['icon' => 'fa-person-breastfeeding', 'name' => 'Digital Mammography', 'asterisk' => true],
    ['icon' => 'fa-person-running', 'name' => 'Treadmill Stress Test', 'asterisk' => true],
    ['icon' => 'fa-syringe', 'name' => 'Vaccination', 'asterisk' => false],
];

$teamMembers = [
    [
        'img' => 'images/dr-santos.jpg', 'placeholder' => 'Dr.+Santos',
        'name' => 'Dr. Maria Santos, MD, FPSP', 'title' => 'Medical Director', 'dept' => 'Anatomic & Clinical Pathology'
    ],
    [
        'img' => 'images/dr-reyes.jpg', 'placeholder' => 'Dr.+Reyes',
        'name' => 'Dr. Jose Reyes, MD, FPCR', 'title' => 'Chief Radiologist', 'dept' => 'Radiology & Imaging'
    ],
    [
        'img' => 'images/dr-cruz.jpg', 'placeholder' => 'Dr.+Cruz',
        'name' => 'Dr. Ana Cruz, MD, FPCP', 'title' => 'Senior Internist', 'dept' => 'Internal Medicine'
    ],
    [
        'img' => 'images/ms-mendoza.jpg', 'placeholder' => 'Ms.+Mendoza',
        'name' => 'Ms. Liza Mendoza, RMT', 'title' => 'Head of Laboratory', 'dept' => 'Medical Technology'
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagnostic Center - Yellow Theme Prototype</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #f8f9fa; color: #333; display: flex; flex-direction: column; min-height: 100vh; }
        a { text-decoration: none; color: inherit; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        
        :root {
            --primary-yellow: #FFC107;
            --primary-hover: #e0a800;
            --dark-gray: #333;
            --light-gray: #f4f4f4;
        }

        .btn { padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; transition: 0.2s; }
        .btn-yellow { background-color: var(--primary-yellow); color: var(--dark-gray); }
        .btn-yellow:hover { background-color: var(--primary-hover); }
        .btn-dark { background-color: var(--dark-gray); color: white; }
        .btn-dark:hover { background-color: #111; }
        .btn-outline { border: 2px solid var(--primary-yellow); color: var(--dark-gray); background: transparent; }
        .btn-outline:hover { background: var(--primary-yellow); }

        header { background-color: white; padding: 20px 0; }
        .header-content { display: flex; justify-content: space-between; align-items: center; }
        .logo img { height: 60px; }
        .header-buttons { display: flex; gap: 15px; }

        nav { background-color: var(--primary-yellow); color: var(--dark-gray); }
        .nav-links { display: flex; list-style: none; }
        .nav-links li { flex: 1; text-align: center; cursor: pointer; }
        .nav-links a { display: block; padding: 15px 10px; font-weight: 600; font-size: 14px; transition: background 0.3s; }
        .nav-links li.active a { background-color: var(--dark-gray); color: white; }
        .nav-links a:hover { background-color: rgba(0, 0, 0, 0.05); }

        .page-content { display: none; padding: 40px 0; flex: 1; }
        .page-content.active { display: block; }
        .page-title { text-align: center; color: var(--dark-gray); font-size: 36px; margin-bottom: 40px; }

        /* HOME */
        .hero { position: relative; background: url('images/home-page-img.jpg') center/cover; height: 450px; display: flex; align-items: center; justify-content: flex-end; }
        .action-cards { display: flex; justify-content: center; gap: 20px; margin-top: -60px; position: relative; z-index: 10; }
        .card { display: flex; align-items: center; justify-content: center; gap: 15px; width: 250px; padding: 25px 20px; border-radius: 10px; color: white; font-size: 18px; font-weight: bold; box-shadow: 0 4px 10px rgba(0,0,0,0.15); transition: transform 0.2s; cursor: pointer; }
        .card:hover { transform: translateY(-5px); }
        .card i { font-size: 32px; }
        .card-darkblue { background-color: #1a3b5c; }
        .card-pink { background-color: #c94b7a; }
        .card-green { background-color: #2ab072; }

        /* LOCATIONS */
        .locations-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 30px; }
        .loc-column h3 { background-color: var(--dark-gray); color: var(--primary-yellow); padding: 15px; text-align: center; border-radius: 5px; margin-bottom: 20px; }
        .loc-column ul { list-style: none; }
        .loc-column li { padding: 10px 0; border-bottom: 1px solid #eee; font-size: 15px; color: #555; display: flex; align-items: flex-start; gap: 8px; }
        .loc-column li i { color: var(--primary-yellow); margin-top: 2px; font-size: 13px; flex-shrink: 0; }
        .loc-column li .branch-address { font-size: 12px; color: #999; display: block; margin-top: 2px; }
        .badge-new { background-color: #2ab072; color: white; font-size: 10px; padding: 2px 6px; border-radius: 10px; margin-left: 5px; vertical-align: middle; white-space: nowrap; }
        .badge-soon { background-color: #e0a800; color: white; font-size: 10px; padding: 2px 6px; border-radius: 10px; margin-left: 5px; vertical-align: middle; white-space: nowrap; }
        .loc-contact-bar { background: white; border: 1px solid #eee; border-radius: 8px; padding: 20px 30px; margin-bottom: 35px; display: flex; align-items: center; gap: 40px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        .loc-contact-bar .contact-item { display: flex; align-items: center; gap: 10px; font-size: 15px; }
        .loc-contact-bar .contact-item i { color: var(--primary-yellow); font-size: 18px; }
        .loc-contact-bar .contact-item strong { display: block; color: #333; }
        .loc-contact-bar .contact-item span { color: #666; font-size: 13px; }
        .loc-note { background-color: #fff8e1; border-left: 4px solid var(--primary-yellow); padding: 12px 18px; border-radius: 4px; font-size: 13px; color: #666; margin-bottom: 30px; }

        /* SERVICES */
        .services-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 30px; }
        .service-item { display: flex; align-items: flex-start; gap: 15px; font-size: 15px; color: #444; background: white; border-radius: 8px; padding: 18px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); transition: transform 0.2s, box-shadow 0.2s; }
        .service-item:hover { transform: translateY(-3px); box-shadow: 0 6px 16px rgba(0,0,0,0.1); }
        .service-item i { font-size: 26px; color: var(--primary-yellow); width: 30px; text-align: center; flex-shrink: 0; margin-top: 2px; }
        .service-item .svc-text strong { display: block; font-size: 15px; color: #333; }
        .service-item span.asterisk { color: red; margin-left: 2px; font-size: 13px; }
        .forms-section { display: flex; justify-content: space-between; align-items: flex-start; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .forms-left h3 { color: var(--dark-gray); margin-bottom: 20px; }
        .form-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee; width: 440px; gap: 10px; }
        .form-row .form-info { flex: 1; }
        .form-row .form-info strong { display: block; font-size: 14px; }
        .forms-right { display: flex; flex-direction: column; gap: 15px; width: 300px; }
        .forms-right .btn { width: 100%; padding: 15px; }

        /* TEST DIRECTORY */
        .test-dir-layout { display: flex; gap: 50px; align-items: center; }
        .test-images { flex: 1; position: relative; height: 500px; }
        .test-images img { position: absolute; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.2); object-fit: cover; border: 5px solid white; }
        .img-1 { width: 250px; height: 250px; top: 0; left: 20px; z-index: 1; }
        .img-2 { width: 200px; height: 200px; top: 150px; left: 200px; z-index: 2; border: 5px solid var(--primary-yellow); }
        .img-3 { width: 220px; height: 220px; bottom: 0; left: 50px; z-index: 3; }
        .test-cards { flex: 1; display: flex; flex-direction: column; gap: 20px; }
        .test-cards h2 { font-size: 32px; color: var(--dark-gray); }
        .test-cards p.sub { color: #666; margin-bottom: 10px; }
        .t-card-row { display: flex; align-items: center; gap: 20px; }
        .t-card { display: flex; flex-direction: column; align-items: center; justify-content: center; width: 180px; height: 100px; border-radius: 10px; color: white; font-weight: bold; font-size: 16px; text-align: center; flex-shrink: 0; cursor: pointer; transition: opacity 0.2s; }
        .t-card:hover { opacity: 0.85; }
        .t-card i { font-size: 24px; margin-bottom: 5px; }
        .t-desc { font-size: 14px; color: #555; line-height: 1.5; }
        .t-desc strong { display: block; color: #333; margin-bottom: 4px; }
        .bg-red { background-color: #d9534f; }
        .bg-pink { background-color: #c94b7a; }
        .bg-purple { background-color: #8e44ad; }

        /* ABOUT */
        .mission-vision { display: flex; gap: 30px; margin-bottom: 60px; }
        .mv-card { flex: 1; background: white; padding: 40px; text-align: center; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .mv-card h2 { color: var(--primary-yellow); font-size: 36px; margin-bottom: 15px; }
        .core-values { margin-top: 40px; }
        .core-values-header { text-align: center; margin-bottom: 40px; }
        .core-values-header h2 { color: var(--primary-yellow); font-size: 36px; }
        .cv-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; }
        .cv-item { display: flex; gap: 20px; }
        .cv-item i { font-size: 40px; color: var(--primary-yellow); }
        .cv-text h4 { font-size: 20px; color: var(--dark-gray); margin-bottom: 10px; }
        .cv-text p { color: #666; font-size: 15px; line-height: 1.5; }
        .about-history { display: flex; gap: 40px; align-items: flex-start; margin: 50px 0; background: white; padding: 35px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .about-history .history-text { flex: 2; }
        .about-history .history-text h3 { font-size: 24px; color: var(--dark-gray); margin-bottom: 15px; border-left: 4px solid var(--primary-yellow); padding-left: 12px; }
        .about-history .history-text p { color: #555; font-size: 15px; line-height: 1.8; margin-bottom: 12px; }
        .about-history .history-stats { flex: 1; display: flex; flex-direction: column; gap: 20px; }
        .stat-box { background: var(--light-gray); border-radius: 8px; padding: 20px; text-align: center; border-top: 4px solid var(--primary-yellow); }
        .stat-box .stat-num { font-size: 36px; font-weight: 800; color: var(--dark-gray); }
        .stat-box .stat-label { font-size: 13px; color: #888; margin-top: 4px; }
        .accreditations { margin: 30px 0 50px; }
        .accreditations h3, .leadership h3 { font-size: 22px; color: var(--dark-gray); border-left: 4px solid var(--primary-yellow); padding-left: 12px; margin-bottom: 20px; }
        .accred-list { display: flex; flex-wrap: wrap; gap: 15px; }
        .accred-badge { display: flex; align-items: center; gap: 10px; background: white; border: 1px solid #eee; border-radius: 8px; padding: 12px 18px; box-shadow: 0 2px 6px rgba(0,0,0,0.04); }
        .accred-badge i { font-size: 22px; color: var(--primary-yellow); }
        .accred-badge .accred-info strong { display: block; font-size: 14px; color: #333; }
        .accred-badge .accred-info span { font-size: 12px; color: #888; }
        .leadership { margin: 10px 0 50px; }
        .leaders-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }
        .leader-card { background: white; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); overflow: hidden; text-align: center; }
        .leader-card .leader-img { width: 100%; height: 140px; overflow: hidden; }
        .leader-card .leader-img img { width: 100%; height: 100%; object-fit: cover; }
        .leader-card .leader-info { padding: 16px; }
        .leader-card .leader-info strong { display: block; font-size: 14px; color: #333; }
        .leader-card .leader-info span { font-size: 12px; color: #888; }
        .leader-card .leader-info .leader-dept { font-size: 11px; color: var(--primary-hover); margin-top: 4px; font-weight: 600; }

        footer { border-top: 1px solid #ccc; padding: 20px 0; margin-top: auto; font-size: 14px; color: #666; background: white; }
    </style>
</head>
<body>

    <header>
        <div class="container header-content">
            <div class="logo">
                <img src="images/logo.jpg" onerror="this.src='https://placehold.co/300x80/ffffff/FFC107?text=Diagnostic+Logo'" alt="Company Logo">
            </div>
            <div class="header-buttons">
                <a href="online-results.html" class="btn btn-yellow">Online Results</a>
            </div>
        </div>
    </header>

    <nav>
        <ul class="nav-links container">
            <?php foreach($navLinks as $target => $label): ?>
                <li class="nav-item <?= $target === 'home' ? 'active' : '' ?>" data-target="<?= htmlspecialchars($target) ?>">
                    <a><?= htmlspecialchars($label) ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>

    <div id="home" class="page-content active">
        <section class="hero"></section>
        <section class="container">
            <div class="action-cards">
                <a href="online-results.php" class="card card-darkblue">
                    <i class="fa-solid fa-clipboard-check"></i><span>Online<br>Results</span>
                </a>
                <div class="card card-pink card-nav" data-target="test-directory">
                    <i class="fa-solid fa-dna"></i><span>Featured<br>Tests</span>
                </div>
                <div class="card card-green card-nav" data-target="services">
                    <i class="fa-solid fa-stethoscope"></i><span>Find a<br>Doctor</span>
                </div>
            </div>
        </section>
        <section class="container" style="margin-top: 80px; margin-bottom: 60px;">
            <div class="mission-vision">
                <div class="mv-card"><h2>Mission</h2><p>To provide <strong>Quality Diagnostic Healthcare</strong><br>services at <strong>affordable prices</strong>.</p></div>
                <div class="mv-card"><h2>Vision</h2><p>To make <strong>Quality Diagnostic Healthcare</strong><br>services <strong>accessible for all</strong>.</p></div>
            </div>
            <div class="core-values">
                <div class="core-values-header"><h2>Core Values</h2><p>We consistently deliver to <strong>customers' expectations</strong> by maintaining:</p></div>
                <div class="cv-grid">
                    <div class="cv-item"><i class="fa-regular fa-heart"></i><div class="cv-text"><h4>Excellent Customer Care</h4><p>We serve our patients with utmost care and compassion as we cater to their diagnostic needs.</p></div></div>
                    <div class="cv-item"><i class="fa-solid fa-hand-holding-medical"></i><div class="cv-text"><h4>Respect</h4><p>We treat our colleagues and patients with utmost courtesy and consideration, regardless of their status, race, nationality and beliefs.</p></div></div>
                    <div class="cv-item"><i class="fa-solid fa-droplet"></i><div class="cv-text"><h4>Accuracy</h4><p>We deliver reliable and accurate results to uphold the trust and confidence of our patients with our services.</p></div></div>
                    <div class="cv-item"><i class="fa-solid fa-puzzle-piece"></i><div class="cv-text"><h4>Ownership</h4><p>We are responsible to perform our duties to the best of our abilities and take ownership for the results of our actions.</p></div></div>
                </div>
            </div>
        </section>
    </div>

    <div id="locations" class="page-content">
        <div class="container">
            <h2 class="page-title" style="color: var(--primary-yellow);">Our Branches</h2>
            <div class="loc-contact-bar">
                <div class="contact-item"><i class="fa-solid fa-phone"></i><div><strong>Customer Hotline</strong><span>(02) 8123-4567 | 1-800-DIAGNOST</span></div></div>
                <div class="contact-item"><i class="fa-solid fa-clock"></i><div><strong>Operating Hours</strong><span>Mon–Sat: 6:00 AM – 6:00 PM &nbsp;|&nbsp; Sun: 7:00 AM – 12:00 PM</span></div></div>
                <div class="contact-item"><i class="fa-solid fa-envelope"></i><div><strong>Email Us</strong><span><a href="mailto:info@diagnosticcenter.com">info@diagnosticcenter.com</a></span></div></div>
            </div>
            <div class="loc-note"><i class="fa-solid fa-circle-info"></i>&nbsp; Branch hours may vary during holidays. Please call your nearest branch to confirm schedules. Branches marked <span class="badge-new">NEW</span> are newly opened; branches marked <span class="badge-soon">COMING SOON</span> are under preparation.</div>
            <div class="locations-grid">
                <div class="loc-column">
                    <h3><i class="fa-solid fa-city" style="margin-right:6px;"></i> Metro Manila</h3>
                    <ul>
                        <li><i class="fa-solid fa-location-dot"></i><div><span>Binondo</span><span class="branch-address">258 Ongpin St., Binondo, Manila</span></div></li>
                        <li><i class="fa-solid fa-location-dot"></i><div><span>Commonwealth</span><span class="branch-address">Commonwealth Ave., Quezon City</span></div></li>
                        <li><i class="fa-solid fa-location-dot"></i><div><span>Del Monte</span><span class="branch-address">Del Monte Ave., Quezon City</span></div></li>
                        <li><i class="fa-solid fa-location-dot"></i><div><span>Novaliches <span class="badge-new">NEW</span></span><span class="branch-address">Quirino Highway, Novaliches, QC</span></div></li>
                        <li><i class="fa-solid fa-location-dot"></i><div><span>Pasig</span><span class="branch-address">Shaw Blvd., Pasig City</span></div></li>
                        <li><i class="fa-solid fa-location-dot"></i><div><span>Pioneer</span><span class="branch-address">Pioneer St., Mandaluyong City</span></div></li>
                        <li><i class="fa-solid fa-location-dot"></i><div><span>San Mateo <span class="badge-new">NEW</span></span><span class="branch-address">Gen. Luna St., San Mateo, Rizal</span></div></li>
                        <li><i class="fa-solid fa-location-dot"></i><div><span>Sta. Maria, Bulacan <span class="badge-new">NEW</span></span><span class="branch-address">McArthur Highway, Sta. Maria, Bulacan</span></div></li>
                    </ul>
                </div>
                <div class="loc-column">
                    <h3><i class="fa-solid fa-mountain-sun" style="margin-right:6px;"></i> Luzon</h3>
                    <ul>
                        <li><i class="fa-solid fa-location-dot"></i><div><span>Angeles</span><span class="branch-address">MacArthur Highway, Angeles City, Pampanga</span></div></li>
                        <li><i class="fa-solid fa-location-dot"></i><div><span>Antipolo</span><span class="branch-address">Circumferential Rd., Antipolo City, Rizal</span></div></li>
                        <li><i class="fa-solid fa-location-dot"></i><div><span>Bacoor</span><span class="branch-address">Aguinaldo Highway, Bacoor, Cavite</span></div></li>
                        <li><i class="fa-solid fa-location-dot"></i><div><span>Baguio</span><span class="branch-address">Session Road, Baguio City</span></div></li>
                        <li><i class="fa-solid fa-location-dot"></i><div><span>Cabanatuan</span><span class="branch-address">Burgos Ave., Cabanatuan City, Nueva Ecija</span></div></li>
                        <li><i class="fa-solid fa-location-dot"></i><div><span>Dagupan</span><span class="branch-address">Perez Blvd., Dagupan City, Pangasinan</span></div></li>
                    </ul>
                </div>
                <div class="loc-column">
                    <h3><i class="fa-solid fa-water" style="margin-right:6px;"></i> Visayas</h3>
                    <ul>
                        <li><i class="fa-solid fa-location-dot"></i><div><span>Consolacion, Cebu</span><span class="branch-address">North National Highway, Consolacion, Cebu</span></div></li>
                        <li><i class="fa-solid fa-location-dot"></i><div><span>J. Llorente, Cebu</span><span class="branch-address">J. Llorente St., Cebu City</span></div></li>
                        <li><i class="fa-solid fa-location-dot"></i><div><span>Mactan, Cebu</span><span class="branch-address">M.L. Quezon National Highway, Lapu-Lapu City</span></div></li>
                        <li><i class="fa-solid fa-location-dot"></i><div><span>Naga, Cebu</span><span class="branch-address">South National Road, Naga City, Cebu</span></div></li>
                    </ul>
                </div>
                <div class="loc-column">
                    <h3><i class="fa-solid fa-sun" style="margin-right:6px;"></i> Mindanao</h3>
                    <ul>
                        <li><i class="fa-solid fa-location-dot"></i><div><span>Butuan</span><span class="branch-address">J.C. Aquino Ave., Butuan City, Agusan del Norte</span></div></li>
                        <li><i class="fa-solid fa-location-dot"></i><div><span>Cagayan de Oro</span><span class="branch-address">Velez St., Cagayan de Oro City</span></div></li>
                        <li><i class="fa-solid fa-location-dot"></i><div><span>Davao</span><span class="branch-address">Quimpo Blvd., Ecoland, Davao City</span></div></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div id="services" class="page-content">
        <div class="container">
            <h2 class="page-title" style="color: var(--primary-yellow);">Services</h2>
            
            <div class="services-grid">
                <?php foreach($services as $svc): ?>
                    <div class="service-item">
                        <i class="fa-solid <?= htmlspecialchars($svc['icon']) ?>"></i>
                        <div class="svc-text">
                            <strong><?= htmlspecialchars($svc['name']) ?> 
                            <?php if($svc['asterisk']): ?> <span class="asterisk">*</span> <?php endif; ?>
                            </strong>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <p style="font-size: 12px; margin-bottom: 30px; color: #888;"><span style="color:red;">*</span> Available in selected branches only.</p>
            <div class="forms-section">
                <div class="forms-left">
                    <h3>Make sure to have the forms you<br>need prior to your visit.</h3>
                    <div class="form-row">
                        <div class="form-info"><strong>Patient Registration Slip</strong></div>
                        <a href="forms/patient-registration-slip.pdf" download class="btn btn-outline"><i class="fa-solid fa-download"></i> Download</a>
                    </div>
                    <div class="form-row">
                        <div class="form-info"><strong>Case Investigation Form</strong></div>
                        <a href="forms/case-investigation-form.pdf" download class="btn btn-outline"><i class="fa-solid fa-download"></i> Download</a>
                    </div>
                </div>
                <div class="forms-right">
                    <button class="btn btn-dark card-nav" data-target="locations"><i class="fa-solid fa-map-location-dot" style="margin-right:8px;"></i> Find Locations</button>
                    <button class="btn btn-dark"><i class="fa-solid fa-house" style="margin-right:8px;"></i> Home Service Appointment</button>
                    <button class="btn btn-yellow"><i class="fa-solid fa-circle-question" style="margin-right:8px;"></i> Frequently Asked Questions</button>
                </div>
            </div>
        </div>
    </div>

    <div id="test-directory" class="page-content">
        <div class="container">
            <div class="test-dir-layout">
                <div class="test-images">
                    <img src="images/ct-scan.jpg" onerror="this.src='https://placehold.co/300x300/e0e0e0/666?text=CT+Scan'" class="img-1" alt="CT Scan">
                    <img src="images/blood-draw.jpg" onerror="this.src='https://placehold.co/300x300/e0e0e0/666?text=Blood+Draw'" class="img-2" alt="Blood Draw">
                    <img src="images/microscope.jpg" onerror="this.src='https://placehold.co/300x300/e0e0e0/666?text=Microscope'" class="img-3" alt="Microscope">
                </div>
                <div class="test-cards">
                    <h2>Our Special Services For You</h2>
                    <p class="sub">Explore Our Wide Range of Diagnostic Services</p>
                    <div class="t-card-row">
                        <div class="t-card bg-red"><i class="fa-solid fa-user-nurse"></i> Test<br>Guidelines</div>
                        <div class="t-desc"><strong>Test Guidelines</strong>Includes test information, patient preparation, sample collection requirement, turn around time and other essential information.</div>
                    </div>
                    <div class="t-card-row">
                        <div class="t-card bg-pink"><i class="fa-solid fa-dna"></i> Featured<br>Tests</div>
                        <div class="t-desc"><strong>Featured Tests</strong>New and recommended tests that might be beneficial for you and your loved ones.</div>
                    </div>
                    <div class="t-card-row">
                        <div class="t-card bg-purple"><i class="fa-solid fa-file-medical"></i> Test<br>Packages</div>
                        <div class="t-desc"><strong>Test Packages</strong>A bundled set of diagnostic tests, often discounted, designed for specific health purposes like checkups or screenings.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="about" class="page-content">
        <div class="container">
            <h2 class="page-title" style="color: var(--primary-yellow);">About Us</h2>
            <div class="about-history">
                <div class="history-text">
                    <h3>Our Story</h3>
                    <p>Founded in 1998, Diagnostic Center began as a single-branch clinical laboratory in Binondo, Manila, with a simple goal: to make accurate and affordable diagnostic healthcare accessible to every Filipino family.</p>
                    <p>Over more than two decades, we have grown into one of the Philippines' most trusted diagnostic networks, expanding to over 25 branches across Metro Manila, Luzon, Visayas, and Mindanao — with more locations opening each year.</p>
                    <p>Our investment in technology has kept us at the forefront of diagnostic medicine. We were among the first regional labs in the Philippines to adopt fully automated hematology and chemistry analyzers, and we continue to upgrade our equipment to ensure the fastest, most reliable results for our patients.</p>
                    <p>Throughout our growth, we have remained committed to our founding principle: that quality healthcare should never be a privilege. With competitive pricing, PhilHealth accreditation, and senior citizen discounts, we ensure that no patient is left without the care they need.</p>
                </div>
                <div class="history-stats">
                    <div class="stat-box"><div class="stat-num">25+</div><div class="stat-label">Branches Nationwide</div></div>
                    <div class="stat-box"><div class="stat-num">28</div><div class="stat-label">Years of Service</div></div>
                    <div class="stat-box"><div class="stat-num">2M+</div><div class="stat-label">Patients Served</div></div>
                    <div class="stat-box"><div class="stat-num">200+</div><div class="stat-label">Tests Available</div></div>
                </div>
            </div>
            
            <div class="accreditations" style="margin-top: 50px;">
                <h3>Accreditations &amp; Memberships</h3>
                <div class="accred-list">
                    <div class="accred-badge"><i class="fa-solid fa-shield-halved"></i><div class="accred-info"><strong>PhilHealth Accredited</strong><span>Philippine Health Insurance Corporation</span></div></div>
                    <div class="accred-badge"><i class="fa-solid fa-award"></i><div class="accred-info"><strong>DOH Licensed</strong><span>Department of Health – Clinical Laboratory</span></div></div>
                    <div class="accred-badge"><i class="fa-solid fa-certificate"></i><div class="accred-info"><strong>ISO 15189 Compliant</strong><span>Medical Laboratories – Quality &amp; Competence</span></div></div>
                    <div class="accred-badge"><i class="fa-solid fa-microscope"></i><div class="accred-info"><strong>PASP Member</strong><span>Philippine Association of Schools of Pathology</span></div></div>
                    <div class="accred-badge"><i class="fa-solid fa-star"></i><div class="accred-info"><strong>PSLM Member</strong><span>Philippine Society of Laboratory Medicine</span></div></div>
                </div>
            </div>

            <div class="leadership" style="margin-top: 40px;">
                <h3>Our Medical Team</h3>
                <div class="leaders-grid">
                    <?php foreach($teamMembers as $member): ?>
                        <div class="leader-card">
                            <div class="leader-img">
                                <img src="<?= htmlspecialchars($member['img']) ?>" onerror="this.src='https://placehold.co/300x140/e0e0e0/666?text=<?= htmlspecialchars($member['placeholder']) ?>'" alt="<?= htmlspecialchars($member['name']) ?>">
                            </div>
                            <div class="leader-info">
                                <strong><?= htmlspecialchars($member['name']) ?></strong>
                                <span><?= htmlspecialchars($member['title']) ?></span>
                                <div class="leader-dept"><?= htmlspecialchars($member['dept']) ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <a href="#">Privacy Statement</a> | <a href="#">Contact Us</a>
            <p>&copy; <?= date('Y'); ?> Diagnostic Center. All Rights Reserved.</p>
        </div>
    </footer>

    <script>
        // Exact same SPA functionality intact
        const navItems = document.querySelectorAll('.nav-item');
        const pages = document.querySelectorAll('.page-content');
        const cardNavs = document.querySelectorAll('.card-nav');

        function switchToPage(targetId) {
            navItems.forEach(nav => nav.classList.remove('active'));
            pages.forEach(page => page.classList.remove('active'));
            
            const targetPage = document.getElementById(targetId);
            if(targetPage) {
                targetPage.classList.add('active');
            }
            
            const matchingNav = document.querySelector(`.nav-item[data-target="${targetId}"]`);
            if (matchingNav) {
                matchingNav.classList.add('active');
            }
            
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        navItems.forEach(item => item.addEventListener('click', () => switchToPage(item.getAttribute('data-target'))));
        cardNavs.forEach(card => card.addEventListener('click', () => switchToPage(card.getAttribute('data-target'))));
    </script>
</body>
</html>
