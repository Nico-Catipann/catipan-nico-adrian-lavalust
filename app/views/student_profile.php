<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
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

        /* Profile Header Section */
        .profile-header {
            display: flex;
            align-items: center;
            gap: 24px;
            border-bottom: 1px solid #111111;
            padding-bottom: 24px;
            margin-bottom: 24px;
        }
        .pic-frame {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: #111111;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 1px solid #111111;
            flex-shrink: 0;
        }
        .profile-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        .pic-initial {
            color: #ffffff;
            font-size: 2rem;
            font-weight: 700;
        }
        .profile-title h1 {
            font-size: 1.8rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: -0.02em;
            margin-bottom: 4px;
        }
        .profile-title p {
            font-size: 0.8rem;
            font-weight: 700;
            color: #666666;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        /* Details Section */
        .info-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.9rem;
            border-bottom: 1px solid #e5e5e5;
            padding-bottom: 12px;
        }
        .info-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }
        .label {
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.05em;
            color: #444444;
        }
        .value {
            font-weight: 600;
            color: #111111;
            text-align: right;
        }

        /* Skill Badges */
        .badge-list {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
            justify-content: flex-end;
        }
        .badge {
            border: 1px solid #111111;
            padding: 2px 8px;
            font-size: 0.75rem;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 0.05em;
            border-radius: 4px;
        }

        /* Footer Socials */
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
    </style>
</head>
<body>
    <div class="container">
        <nav class="navbar">
            <a href="<?= site_url('student') ?>" class="nav-link">Home</a>
            <a href="<?= site_url('student/profile') ?>" class="nav-link active">Student Profile</a>
        </nav>

        <main class="card">
            <div class="profile-header">
                <div class="pic-frame">
    <?php if (file_exists('images/pic1.jpg')): ?>
        <img src="<?= base_url('images/pic1.jpg') ?>" alt="Profile Picture" class="profile-img">
    <?php else: ?>
        <span class="pic-initial"><?= isset($name) ? strtoupper(substr($name, 0, 1)) : 'S' ?></span>
    <?php endif; ?>
</div>
                <div class="profile-title">
                    <h1><?= html_escape($name) ?></h1>
                    <p>Student ID: <?= html_escape($student_id) ?></p>
                </div>
            </div>

            <div class="info-list">
                <div class="info-item">
                    <span class="label">Course</span>
                    <span class="value"><?= html_escape($course) ?></span>
                </div>
                <div class="info-item">
                    <span class="label">Year & Section</span>
                    <span class="value"><?= html_escape($year) ?> — <?= html_escape($section) ?></span>
                </div>
                <div class="info-item">
                    <span class="label">Email Address</span>
                    <span class="value"><?= html_escape($email) ?></span>
                </div>
                <div class="info-item">
                    <span class="label">Skills</span>
                    <div class="badge-list">
                        <?php foreach (explode(',', $skills) as $skill): ?>
                            <span class="badge"><?= html_escape(trim($skill)) ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="info-item">
                    <span class="label">Hobbies</span>
                    <span class="value"><?= html_escape($hobbies) ?></span>
                </div>
                <div class="info-item">
                    <span class="label">Address</span>
                    <span class="value"><?= html_escape($address) ?></span>
                </div>
                <div class="info-item">
                    <span class="label">Contact Number</span>
                    <span class="value"><?= html_escape($contact) ?></span>
                </div>  
            </div>
        </main>

        <footer class="card footer-card">
            <span class="footer-brand">&copy; <?= date('Y') ?> Student Portal</span>
            <div class="social-links">
                <a href="https://github.com" target="_blank" class="social-link">GitHub</a>
                <a href="https://linkedin.com" target="_blank" class="social-link">LinkedIn</a>
                <a href="https://twitter.com" target="_blank" class="social-link">Twitter / X</a>
                <a href="mailto:student@example.com" class="social-link">Email</a>
            </div>
        </footer>
    </div>
</body>
</html>