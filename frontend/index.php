<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagnostic Center - Home</title>
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

        /* HERO & CARDS */
        .hero { position: relative; background: url('images/home-page-img.jpg') center/cover; background-color: #333; height: 450px; display: flex; align-items: center; justify-content: flex-end; }
        .action-cards { display: flex; justify-content: center; gap: 20px; margin-top: -60px; position: relative; z-index: 10; }
        .card { display: flex; align-items: center; justify-content: center; gap: 15px; width: 250px; padding: 25px 20px; border-radius: 10px; color: white; font-size: 18px; font-weight: bold; box-shadow: 0 4px 10px rgba(0,0,0,0.15); transition: transform 0.2s; cursor: pointer; }
        .card:hover { transform: translateY(-5px); }
        .card i { font-size: 32px; }
        .card-darkblue { background-color: #1a3b5c; }
        .card-pink { background-color: #c94b7a; }
        .card-green { background-color: #2ab072; }

        /* UTILITY CLASSES FOR DESIGN */
        .mission-vision { display: flex; gap: 30px; margin-bottom: 60px; }
        .mv-card { flex: 1; background: white; padding: 40px; text-align: center; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .mv-card h2 { color: var(--primary-yellow); font-size: 36px; margin-bottom: 15px; }
        footer { border-top: 1px solid #ccc; padding: 20px 0; margin-top: auto; font-size: 14px; color: #666; background: white; text-align: center;}
        
        /* LOGIN FORM STYLES */
        .login-box { background: white; padding: 40px; border-radius: 10px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); max-width: 500px; margin: 0 auto; }
        .form-group { margin-bottom: 20px; text-align: left; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: bold; color: var(--dark-gray); }
        .form-group input { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px; }
        .form-group input:focus { outline: none; border-color: var(--primary-yellow); box-shadow: 0 0 5px rgba(255, 193, 7, 0.3); }
    </style>
</head>
<body>

    <header>
        <div class="container header-content">
            <div class="logo">
                <img src="images/logo.png" onerror="this.src='https://placehold.co/300x80/ffffff/FFC107?text=Diagnostic+Logo'" alt="Company Logo">
            </div>
            <div class="header-buttons">
                <button class="btn btn-yellow card-nav" data-target="portal"><i class="fa-solid fa-lock"></i> Online Results</button>
            </div>
        </div>
    </header>

    <nav>
        <ul class="nav-links container">
            <li class="nav-item active" data-target="home"><a>HOME</a></li>
            <li class="nav-item" data-target="locations"><a>LOCATIONS</a></li>
            <li class="nav-item" data-target="services"><a>SERVICES</a></li>
            <li class="nav-item" data-target="portal"><a>PATIENT PORTAL</a></li>
        </ul>
    </nav>

    <div id="home" class="page-content active">
        <section class="hero"></section>
        <section class="container">
            <div class="action-cards">
                <div class="card card-darkblue card-nav" data-target="portal">
                    <i class="fa-solid fa-clipboard-check"></i><span>Online<br>Results</span>
                </div>
                <div class="card card-pink card-nav" data-target="services">
                    <i class="fa-solid fa-dna"></i><span>Featured<br>Tests</span>
                </div>
                <div class="card card-green card-nav" data-target="locations">
                    <i class="fa-solid fa-map-location-dot"></i><span>Find a<br>Branch</span>
                </div>
            </div>
        </section>
        <section class="container" style="margin-top: 80px; margin-bottom: 60px;">
            <div class="mission-vision">
                <div class="mv-card"><h2>Mission</h2><p>To provide <strong>Quality Diagnostic Healthcare</strong><br>services at <strong>affordable prices</strong>.</p></div>
                <div class="mv-card"><h2>Vision</h2><p>To make <strong>Quality Diagnostic Healthcare</strong><br>services <strong>accessible for all</strong>.</p></div>
            </div>
        </section>
    </div>

    <div id="locations" class="page-content">
        <div class="container"><h2 class="page-title" style="color: var(--primary-yellow);">Our Branches</h2><p align="center">Branch information goes here.</p></div>
    </div>

    <div id="services" class="page-content">
        <div class="container"><h2 class="page-title" style="color: var(--primary-yellow);">Services</h2><p align="center">Services information goes here.</p></div>
    </div>

    <div id="portal" class="page-content">
        <div class="container" style="text-align: center;">
            <i class="fa-solid fa-user-shield" style="font-size: 50px; color: var(--primary-yellow); margin-bottom: 20px;"></i>
            <h2 class="page-title" style="color: var(--dark-gray); margin-bottom: 20px;">Secure Patient Portal</h2>
            <p style="color: #666; margin-bottom: 40px;">Please enter your reference details to access your laboratory results.</p>
            
            <div class="login-box">
                <form action="../backend/login.php" method="POST">
                    <div class="form-group">
                        <label>Reference Number</label>
                        <input type="text" name="ref_number" placeholder="e.g. REF12345" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="last_name" placeholder="e.g. DELAPENA" required>
                    </div>
                    <button type="submit" class="btn btn-yellow" style="width: 100%; padding: 15px; font-size: 18px; margin-top: 10px;">
                        Access Results <i class="fa-solid fa-arrow-right" style="margin-left: 8px;"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2026 Diagnostic Center. All Rights Reserved.</p>
        </div>
    </footer>

    <script>
        const navItems = document.querySelectorAll('.nav-item');
        const pages = document.querySelectorAll('.page-content');
        const cardNavs = document.querySelectorAll('.card-nav');

        function switchToPage(targetId) {
            navItems.forEach(nav => nav.classList.remove('active'));
            pages.forEach(page => page.classList.remove('active'));
            
            const targetPage = document.getElementById(targetId);
            if (targetPage) targetPage.classList.add('active');
            
            const matchingNav = document.querySelector(`.nav-item[data-target="${targetId}"]`);
            if (matchingNav) matchingNav.classList.add('active');
            
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        navItems.forEach(item => item.addEventListener('click', () => switchToPage(item.getAttribute('data-target'))));
        cardNavs.forEach(card => card.addEventListener('click', () => switchToPage(card.getAttribute('data-target'))));
    </script>
</body>
</html>
