<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagnostic Center - Yellow Theme Prototype</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* --- Global Reset & Typography --- */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #f8f9fa; color: #333; display: flex; flex-direction: column; min-height: 100vh; }
        a { text-decoration: none; color: inherit; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        
        /* --- Theme Colors --- */
        :root {
            --primary-yellow: #FFC107;
            --primary-hover: #e0a800;
            --dark-gray: #333;
            --light-gray: #f4f4f4;
        }

        /* --- Buttons --- */
        .btn { padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; transition: 0.2s; }
        .btn-yellow { background-color: var(--primary-yellow); color: var(--dark-gray); }
        .btn-yellow:hover { background-color: var(--primary-hover); }
        .btn-dark { background-color: var(--dark-gray); color: white; }
        .btn-dark:hover { background-color: #111; }
        .btn-outline { border: 2px solid var(--primary-yellow); color: var(--dark-gray); background: transparent; }
        .btn-outline:hover { background: var(--primary-yellow); }

        /* --- Header & Nav --- */
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

        /* --- Page Routing (Hiding/Showing) --- */
        .page-content { display: none; padding: 40px 0; flex: 1; }
        .page-content.active { display: block; }
        .page-title { text-align: center; color: var(--dark-gray); font-size: 36px; margin-bottom: 40px; }

        /* ================= HOME PAGE STYLES ================= */
        .hero { position: relative; background: url('images/home-page-img.jpg') center/cover; height: 450px; display: flex; align-items: center; justify-content: flex-end; }
        .hero-graphic { margin-right: 15%; text-align: center; }
        .hero-graphic img { width: 250px; }
        .action-cards { display: flex; justify-content: center; gap: 20px; margin-top: -60px; position: relative; z-index: 10; }
        .card { display: flex; align-items: center; justify-content: center; gap: 15px; width: 250px; padding: 25px 20px; border-radius: 10px; color: white; font-size: 18px; font-weight: bold; box-shadow: 0 4px 10px rgba(0,0,0,0.15); transition: transform 0.2s; cursor: pointer; }
        .card:hover { transform: translateY(-5px); }
        .card i { font-size: 32px; }
        .card-darkblue { background-color: #1a3b5c; }
        .card-pink { background-color: #c94b7a; }
        .card-yellow { background-color: var(--primary-yellow); color: var(--dark-gray); }
        .card-green { background-color: #2ab072; }

        /* ================= LOCATIONS STYLES ================= */
        .locations-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 30px; }
        .loc-column h3 { background-color: var(--dark-gray); color: var(--primary-yellow); padding: 15px; text-align: center; border-radius: 5px; margin-bottom: 20px; }
        .loc-column ul { list-style: none; }
        .loc-column li { padding: 8px 0; border-bottom: 1px solid #eee; font-size: 15px; color: #555; }
        .badge-new { background-color: #2ab072; color: white; font-size: 10px; padding: 2px 6px; border-radius: 10px; margin-left: 5px; vertical-align: middle; }

        /* ================= SERVICES STYLES ================= */
        .services-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 50px; }
        .service-item { display: flex; align-items: center; gap: 15px; font-size: 16px; color: #444; }
        .service-item i { font-size: 24px; color: var(--primary-yellow); width: 30px; text-align: center; }
        .service-item span.asterisk { color: red; margin-left: 3px; }
        
        .forms-section { display: flex; justify-content: space-between; align-items: flex-start; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .forms-left h3 { color: var(--dark-gray); margin-bottom: 20px; }
        .form-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee; width: 400px; }
        .forms-right { display: flex; flex-direction: column; gap: 15px; width: 300px; }
        .forms-right .btn { width: 100%; padding: 15px; }

        /* ================= TEST DIRECTORY STYLES ================= */
        .test-dir-layout { display: flex; gap: 50px; align-items: center; }
        .test-images { flex: 1; position: relative; height: 500px; }
        .test-images img { position: absolute; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.2); object-fit: cover; border: 5px solid white; }
        .img-1 { width: 250px; height: 250px; top: 0; left: 20px; z-index: 1; }
        .img-2 { width: 200px; height: 200px; top: 150px; left: 200px; z-index: 2; border: 5px solid var(--primary-yellow); }
        .img-3 { width: 220px; height: 220px; bottom: 0; left: 50px; z-index: 3; }
        
        .test-cards { flex: 1; display: flex; flex-direction: column; gap: 20px; }
        .test-cards h2 { font-size: 32px; color: var(--dark-gray); }
        .test-cards p.sub { color: #666; margin-bottom: 20px; }
        .t-card-row { display: flex; align-items: center; gap: 20px; }
        .t-card { display: flex; flex-direction: column; align-items: center; justify-content: center; width: 180px; height: 100px; border-radius: 10px; color: white; font-weight: bold; font-size: 18px; text-align: center; flex-shrink: 0; }
        .t-card i { font-size: 24px; margin-bottom: 5px; }
        .t-desc { font-size: 14px; color: #555; }
        .bg-red { background-color: #d9534f; }
        .bg-pink { background-color: #c94b7a; }
        .bg-purple { background-color: #8e44ad; }

        /* ================= ABOUT US STYLES ================= */
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

        /* --- Footer --- */
        footer { border-top: 1px solid #ccc; padding: 20px 0; margin-top: auto; font-size: 14px; color: #666; background: white;}
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
            <li class="nav-item active" data-target="home"><a>HOME</a></li>
            <li class="nav-item" data-target="locations"><a>LOCATIONS</a></li>
            <li class="nav-item" data-target="services"><a>SERVICES</a></li>
            <li class="nav-item" data-target="test-directory"><a>TEST DIRECTORY</a></li>
            <li class="nav-item" data-target="about"><a>ABOUT US</a></li>
        </ul>
    </nav>

    <div id="home" class="page-content active">
        <section class="hero">
            </section>
        
        <section class="container">
            <div class="action-cards">
                <a href="online-results.html" class="card card-darkblue">
                    <i class="fa-solid fa-clipboard-check"></i>
                    <span>Online<br>Results</span>
                </a>
                <div class="card card-pink card-nav" data-target="test-directory">
                    <i class="fa-solid fa-dna"></i>
                    <span>Featured<br>Tests</span>
                </div>
                <div class="card card-green card-nav" data-target="services">
                    <i class="fa-solid fa-stethoscope"></i>
                    <span>Find a<br>Doctor</span>
                </div>
            </div>
        </section>

        <section class="container" style="margin-top: 80px; margin-bottom: 60px;">
            <div class="mission-vision">
                <div class="mv-card">
                    <h2>Mission</h2>
                    <p>To provide <strong>Quality Diagnostic Healthcare</strong><br>services at <strong>affordable prices</strong>.</p>
                </div>
                <div class="mv-card">
                    <h2>Vision</h2>
                    <p>To make <strong>Quality Diagnostic Healthcare</strong><br>services <strong>accessible for all</strong>.</p>
                </div>
            </div>

            <div class="core-values">
                <div class="core-values-header">
                    <h2>Core Values</h2>
                    <p>We consistently deliver to <strong>customers' expectations</strong> by maintaining:</p>
                </div>
                <div class="cv-grid">
                    <div class="cv-item">
                        <i class="fa-regular fa-heart"></i>
                        <div class="cv-text">
                            <h4>Excellent Customer Care</h4>
                            <p>We serve our patients with utmost care and compassion as we cater to their diagnostic needs.</p>
                        </div>
                    </div>
                    <div class="cv-item">
                        <i class="fa-solid fa-hand-holding-medical"></i>
                        <div class="cv-text">
                            <h4>Respect</h4>
                            <p>We treat our colleagues and patients with utmost courtesy and consideration, regardless of their status, race, nationality and beliefs.</p>
                        </div>
                    </div>
                    <div class="cv-item">
                        <i class="fa-solid fa-droplet"></i>
                        <div class="cv-text">
                            <h4>Accuracy</h4>
                            <p>We deliver reliable and accurate results to uphold the trust and confidence of our patients with our services.</p>
                        </div>
                    </div>
                    <div class="cv-item">
                        <i class="fa-solid fa-puzzle-piece"></i>
                        <div class="cv-text">
                            <h4>Ownership</h4>
                            <p>We are responsible to perform our duties to the best of our abilities and take ownership for the results of our actions.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div id="locations" class="page-content container">
        <div class="locations-grid">
            <div class="loc-column">
                <h3>Metro Manila</h3>
                <ul>
                    <li>Binondo</li>
                    <li>Commonwealth</li>
                    <li>Del Monte</li>
                    <li>Novaliches <span class="badge-new">NEW</span></li>
                    <li>Pasig</li>
                    <li>Pioneer</li>
                    <li>San Mateo <span class="badge-new">NEW</span></li>
                    <li>Sta. Maria, Bulacan <span class="badge-new">NEW</span></li>
                </ul>
            </div>
            <div class="loc-column">
                <h3>Luzon</h3>
                <ul>
                    <li>Angeles</li>
                    <li>Antipolo</li>
                    <li>Bacoor</li>
                    <li>Baguio</li>
                    <li>Cabanatuan</li>
                    <li>Dagupan</li>
                </ul>
            </div>
            <div class="loc-column">
                <h3>Visayas</h3>
                <ul>
                    <li>Consolacion, Cebu</li>
                    <li>J. Llorente, Cebu</li>
                    <li>Mactan, Cebu</li>
                    <li>Naga, Cebu</li>
                </ul>
            </div>
            <div class="loc-column">
                <h3>Mindanao</h3>
                <ul>
                    <li>Butuan</li>
                    <li>Cagayan De Oro</li>
                    <li>Davao</li>
                </ul>
            </div>
        </div>
    </div>

    <div id="services" class="page-content container">
        <h2 class="page-title" style="color: var(--primary-yellow);">Services</h2>
        <div class="services-grid">
            <div class="service-item"><i class="fa-solid fa-flask"></i> Fully Automated Lab</div>
            <div class="service-item"><i class="fa-solid fa-ring"></i> CT-Scan<span class="asterisk">*</span></div>
            <div class="service-item"><i class="fa-solid fa-user-doctor"></i> Multi-Specialty Doctors</div>
            <div class="service-item"><i class="fa-solid fa-x-ray"></i> X-Ray</div>
            <div class="service-item"><i class="fa-solid fa-heart-pulse"></i> ECG</div>
            <div class="service-item"><i class="fa-solid fa-house"></i> Home Service</div>
            <div class="service-item"><i class="fa-solid fa-person-breastfeeding"></i> Digital Mammography<span class="asterisk">*</span></div>
            <div class="service-item"><i class="fa-solid fa-person-running"></i> Treadmill Stress Test<span class="asterisk">*</span></div>
            <div class="service-item"><i class="fa-solid fa-syringe"></i> Vaccination</div>
        </div>
        
        <p style="font-size: 12px; margin-bottom: 30px;"><span class="asterisk" style="color:red;">*</span> Available in selected branches only</p>

        <div class="forms-section">
            <div class="forms-left">
                <h3>Make sure to have the forms you<br>need prior to your visit.</h3>
                <div class="form-row">
                    <strong>Patient Registration Slip</strong>
                    <button class="btn btn-outline"><i class="fa-solid fa-download"></i> Download</button>
                </div>
                <div class="form-row">
                    <strong>Case Investigation Form</strong>
                    <button class="btn btn-outline"><i class="fa-solid fa-download"></i> Download</button>
                </div>
            </div>
            <div class="forms-right">
                <button class="btn btn-dark">Find Locations</button>
                <button class="btn btn-dark">Home Service Appointment</button>
                <button class="btn btn-yellow">Frequently Asked Questions</button>
            </div>
        </div>
    </div>

    <div id="test-directory" class="page-content container">
        <div class="test-dir-layout">
            <div class="test-images">
                <img src="https://placehold.co/300x300/e0e0e0/666?text=CT+Scan" class="img-1" alt="CT Scan">
                <img src="https://placehold.co/300x300/e0e0e0/666?text=Blood+Draw" class="img-2" alt="Blood Draw">
                <img src="https://placehold.co/300x300/e0e0e0/666?text=Microscope" class="img-3" alt="Microscope">
            </div>
            <div class="test-cards">
                <h2>Our Special Services For You</h2>
                <p class="sub">Explore Our Wide Range of Diagnostic Services</p>
                
                <div class="t-card-row">
                    <div class="t-card bg-red"><i class="fa-solid fa-user-nurse"></i> Test<br>Guidelines</div>
                    <div class="t-desc">Includes test information, patient preparation, sample collection requirement, turn around time and other essential information.</div>
                </div>
                <div class="t-card-row">
                    <div class="t-card bg-pink"><i class="fa-solid fa-dna"></i> Featured<br>Tests</div>
                    <div class="t-desc">New and recommended tests that might be beneficial for you and your loved ones.</div>
                </div>
                <div class="t-card-row">
                    <div class="t-card bg-purple"><i class="fa-solid fa-file-medical"></i> Test<br>Packages</div>
                    <div class="t-desc">A bundled set of diagnostic tests, often discounted, designed for specific health purposes like checkups or screenings.</div>
                </div>
            </div>
        </div>
    </div>

    <div id="about" class="page-content container">
        <div class="mission-vision">
            <div class="mv-card">
                <h2>Mission</h2>
                <p>To provide <strong>Quality Diagnostic Healthcare</strong><br>services at <strong>affordable prices</strong>.</p>
            </div>
            <div class="mv-card">
                <h2>Vision</h2>
                <p>To make <strong>Quality Diagnostic Healthcare</strong><br>services <strong>accessible for all</strong>.</p>
            </div>
        </div>

        <div class="core-values">
            <div class="core-values-header">
                <h2>Core Values</h2>
                <p>We consistently deliver to <strong>customers' expectations</strong> by maintaining:</p>
            </div>
            <div class="cv-grid">
                <div class="cv-item">
                    <i class="fa-regular fa-heart"></i>
                    <div class="cv-text">
                        <h4>Excellent Customer Care</h4>
                        <p>We serve our patients with utmost care and compassion as we cater to their diagnostic needs.</p>
                    </div>
                </div>
                <div class="cv-item">
                    <i class="fa-solid fa-hand-holding-medical"></i>
                    <div class="cv-text">
                        <h4>Respect</h4>
                        <p>We treat our colleagues and patients with utmost courtesy and consideration, regardless of their status, race, nationality and beliefs.</p>
                    </div>
                </div>
                <div class="cv-item">
                    <i class="fa-solid fa-droplet"></i>
                    <div class="cv-text">
                        <h4>Accuracy</h4>
                        <p>We deliver reliable and accurate results to uphold the trust and confidence of our patients with our services.</p>
                    </div>
                </div>
                <div class="cv-item">
                    <i class="fa-solid fa-puzzle-piece"></i>
                    <div class="cv-text">
                        <h4>Ownership</h4>
                        <p>We are responsible to perform our duties to the best of our abilities and take ownership for the results of our actions.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <a href="#">Privacy Statement</a> | <a href="#">Contact Us</a>
            <p>&copy; 2026 Diagnostic Center. All Rights Reserved.</p>
        </div>
    </footer>

    <script>
        const navItems = document.querySelectorAll('.nav-item');
        const pages = document.querySelectorAll('.page-content');
        const cardNavs = document.querySelectorAll('.card-nav'); // Select our new card buttons

        // Create a reusable function to switch pages
        function switchToPage(targetId) {
            // 1. Remove active class from all nav items and pages
            navItems.forEach(nav => nav.classList.remove('active'));
            pages.forEach(page => page.classList.remove('active'));

            // 2. Show the corresponding page
            document.getElementById(targetId).classList.add('active');

            // 3. Highlight the correct main navigation tab so the user knows where they are
            const matchingNav = document.querySelector(`.nav-item[data-target="${targetId}"]`);
            if (matchingNav) {
                matchingNav.classList.add('active');
            }
            
            // Scroll to top of the page smoothly
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // Listen for clicks on the main Top Navigation
        navItems.forEach(item => {
            item.addEventListener('click', () => {
                switchToPage(item.getAttribute('data-target'));
            });
        });

        // Listen for clicks on the Action Cards
        cardNavs.forEach(card => {
            card.addEventListener('click', () => {
                switchToPage(card.getAttribute('data-target'));
            });
        });
    </script>
</body>
</html>
