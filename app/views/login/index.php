<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Product Management</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: #090d16;
            background-image: 
                radial-gradient(at 10% 20%, rgba(37, 99, 235, 0.15) 0px, transparent 50%),
                radial-gradient(at 90% 80%, rgba(147, 51, 234, 0.15) 0px, transparent 50%);
            color: #f8fafc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .login-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .login-header .badge {
            display: inline-block;
            background: rgba(37, 99, 235, 0.15);
            color: #60a5fa;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            padding: 6px 12px;
            border-radius: 20px;
            margin-bottom: 16px;
            border: 1px solid rgba(37, 99, 235, 0.3);
        }

        .login-header h1 {
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -0.025em;
            color: #ffffff;
        }

        .login-header p {
            font-size: 14px;
            color: #94a3b8;
            margin-top: 8px;
        }

        .alert-error {
            background: rgba(220, 38, 38, 0.15);
            color: #fca5a5;
            padding: 12px 14px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 24px;
            border: 1px solid rgba(220, 38, 38, 0.3);
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 8px;
            color: #cbd5e1;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            font-size: 14px;
            background: rgba(30, 41, 59, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            color: #ffffff;
            outline: none;
            transition: all 0.2s ease;
        }

        .form-control::placeholder {
            color: #64748b;
        }

        .form-control:focus {
            background: rgba(30, 41, 59, 0.9);
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            font-size: 14px;
            font-weight: 600;
            color: #ffffff;
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: 10px;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .btn-submit:hover {
            opacity: 0.95;
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.4);
            transform: translateY(-1px);
        }

        .btn-submit:active {
            transform: translateY(0);
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="login-header">
        <div class="badge">ITE311</div>
        <h1>Product Management</h1>
        <p>Created by Nico Catipan</p>
    </div>

    <?php if (isset($_SESSION['login_error'])): ?>
        <div class="alert-error">
            <?= htmlspecialchars($_SESSION['login_error']) ?>
        </div>
        <?php unset($_SESSION['login_error']); ?>
    <?php endif; ?>

    <form action="<?= site_url('login/authenticate') ?>" method="POST">
        
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" class="form-control" placeholder="Enter username" required autocomplete="off">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
        </div>

        <button type="submit" class="btn-submit">
            Sign In
        </button>

    </form>
</div>

</body>
</html>