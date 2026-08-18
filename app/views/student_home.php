<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: #ffffff;
            color: #111111;
            display: flex;
            justify-content: center;
            min-height: 100vh;
            padding: 40px 20px;
        }
        .container {
            width: 100%;
            max-width: 880px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* Center Navigation */
        .navbar {
            display: flex;
            gap: 8px;
            background: #ffffff;
            padding: 6px;
            border-radius: 12px;
            border: 1px solid #111111;
            max-width: 360px;
            margin: 0 auto;
            width: 100%;
        }
        .nav-link {
            flex: 1;
            text-align: center;
            padding: 8px 16px;
            text-decoration: none;
            color: #111111;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-radius: 6px;
            transition: all 0.2s ease;
        }
        .nav-link:hover {
            background: #f0f0f0;
        }
        .nav-link.active {
            background: #111111;
            color: #ffffff;
        }

        /* Card Component */
        .card {
            background: #ffffff;
            padding: 32px;
            border-radius: 16px;
            border: 1px solid #111111;
        }

        /* Top Grid Layout */
        .top-row {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 20px;
        }
        @media (max-width: 768px) {
            .top-row {
                grid-template-columns: 1fr;
            }
        }

        /* Left Box: PIC */
        .pic-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            min-height: 220px;
        }
        .pic-frame {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: #111111;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 12px;
        }
        .pic-label {
            font-size: 0.75rem;
            font-weight: 700;
            color: #666666;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        /* Right Box: VIEW PROFILE */
        .view-profile-card {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .badge {
            display: inline-block;
            border: 1px solid #111111;
            color: #111111;
            font-size: 0.7rem;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 20px;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }
        .view-profile-card h1 {
            font-size: 1.8rem;
            font-weight: 800;
            margin-bottom: 8px;
            letter-spacing: -0.02em;
            text-transform: uppercase;
        }
        .view-profile-card p {
            color: #555555;
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 20px;
            max-width: 420px;
        }
        .btn {
            display: inline-block;
            background: #111111;
            color: #ffffff;
            padding: 10px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border: 1px solid #111111;
            transition: all 0.2s ease;
        }
        .btn:hover {
            background: #ffffff;
            color: #111111;
        }

        /* Middle Box: ABOUT ME */
        .about-card h2 {
            font-size: 1.1rem;
            font-weight: 800;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1px solid #111111;
            padding-bottom: 8px;
        }
        .about-card p {
            color: #333333;
            font-size: 0.92rem;
            line-height: 1.7;
        }

        /* Bottom Section: FOOTER SOCIALS */
        footer.footer-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 32px;
            flex-wrap: wrap;
            gap: 12px;
        }
        .footer-brand {
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .social-links {
            display: flex;
            gap: 16px;
        }
        .social-link {
            color: #111111;
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1px solid transparent;
            transition: border-color 0.2s ease;
        }
        .social-link:hover {
            border-bottom: 1px solid #111111;
        }
        .pic-frame {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: #111111;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 12px;
    overflow: hidden; /* Ensures the image clips neatly to the circle */
    border: 1px solid #111111;
}

.profile-img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Prevents image stretching */
    display: block;
}

/* Modal Overlay & Box */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(2px);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000;
}
.modal-box {
    background: #ffffff;
    border: 1px solid #111111;
    border-radius: 16px;
    padding: 28px;
    max-width: 400px;
    width: 90%;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}
.modal-box h3 {
    font-size: 1.1rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 8px;
}
.modal-box p {
    font-size: 0.88rem;
    color: #444444;
    margin-bottom: 20px;
    line-height: 1.5;
}
.modal-btn {
    background: #111111;
    color: #ffffff;
    border: 1px solid #111111;
    padding: 8px 22px;
    border-radius: 6px;
    font-weight: 700;
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    cursor: pointer;
    transition: all 0.2s ease;
}
.modal-btn:hover {
    background: #ffffff;
    color: #111111;
}
    </style>
</head>
<body>
    <div class="container">
        <!-- Top Navigation -->
        <nav class="navbar">
            <a href="<?= site_url('student') ?>" class="nav-link active">Home</a>
            <a href="<?= site_url('student/profile') ?>" class="nav-link">Student Profile</a>
        </nav>

        <!-- Top Section: PIC & VIEW PROFILE -->
        <div class="top-row">
          <!-- Left: PIC -->
<div class="card pic-card">
    <div class="pic-frame">
        <img 
            src="<?= base_url('images/pic1.jpg') ?>" 
            alt="Profile Picture" 
            class="profile-img"
        >
    </div>
    <span class="pic-label">Profile Picture</span>
</div>
            <!-- Right: VIEW PROFILE -->
            <div class="card view-profile-card">
                <span class="badge">LavaLust Application</span>
                <h1>Student Portal</h1>
                <p>Welcome to my Student Portal. To view my Student Profile, click the button below.</p>
                <a href="<?= site_url('student/profile') ?>" class="btn">View Profile</a>
            </div>
        </div>

        <!-- Middle Section: ABOUT ME -->
        <!-- Middle Section: ABOUT ME -->
<div class="card about-card">
    <h2>About Me</h2>
    <p>
        Hello! I am an 3rd year IT student passionate about building clean, efficient web applications and exploring modern frameworks. Outside of my coursework and Web Systems projects, I like to balance my time between physical sports and interactive hobbies.
    </p>
    <p style="margin-top: 12px;">
        When I'm not writing code or at school, you'll usually find me out on the field playing football or following live matches. For downtime, I enjoy unwinding with competitive video games or heading over to the billiards table to play.
    </p>
</div>

        <!-- Bottom Section: FOOTER SOCIALS -->
        <footer class="card footer-card">
            <span class="footer-brand">&copy; <?= date('Y') ?> Student Portal</span>
            <div class="social-links">
                <a href="https://github.com/Nico-Catipann" target="_blank" class="social-link">GitHub</a>
                <a href="https://www.facebook.com/nico.catipan.75/" target="_blank" class="social-link">Facebook</a>
                <a href="https://www.instagram.com/thiskidsavvy/" target="_blank" class="social-link">Instagram</a>
            </div>
        </footer>
    </div>

    <!-- Access Denied Pop-up Modal -->
    <?php if (isset($_SESSION['flash_error'])): ?>
        <div class="modal-overlay" id="accessModal">
            <div class="modal-box">
                <h3>Access Restricted</h3>
                <p><?= html_escape($_SESSION['flash_error']) ?></p>
                <button class="modal-btn" onclick="closeModal()">Dismiss</button>
            </div>
        </div>

        <script>
            function closeModal() {
                document.getElementById('accessModal').style.display = 'none';
            }
        </script>
        <?php unset($_SESSION['flash_error']); ?>
    <?php endif; ?>
</body>
</html>
</body>
</html>