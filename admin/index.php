<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard - Pebbles Elementary</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            max-width: 600px;
            width: 100%;
            padding: 40px;
            text-align: center;
        }

        h1 {
            color: #667eea;
            margin-bottom: 10px;
            font-size: 32px;
        }

        .subtitle {
            color: #666;
            margin-bottom: 30px;
            font-size: 16px;
        }

        .status-box {
            background: #f0f0f0;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            text-align: left;
        }

        .status-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .status-item:last-child {
            margin-bottom: 0;
        }

        .status-icon {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            font-weight: bold;
            color: white;
            font-size: 14px;
        }

        .status-icon.check {
            background: #28a745;
        }

        .status-icon.warning {
            background: #ffc107;
        }

        .status-text {
            flex: 1;
        }

        .button-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-top: 30px;
        }

        @media (max-width: 600px) {
            .button-group {
                grid-template-columns: 1fr;
            }
        }

        .btn {
            display: inline-block;
            padding: 15px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            border: 2px solid;
            text-align: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-color: #667eea;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: white;
            color: #667eea;
            border-color: #667eea;
        }

        .btn-secondary:hover {
            background: #f9f9f9;
        }

        .info-box {
            background: #e7f3ff;
            border-left: 4px solid #2196F3;
            padding: 15px;
            border-radius: 5px;
            text-align: left;
            margin-top: 20px;
            color: #0066cc;
            font-size: 14px;
        }

        .info-box strong {
            display: block;
            margin-bottom: 5px;
        }

        .warning-box {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            border-radius: 5px;
            text-align: left;
            margin-top: 20px;
            color: #856404;
            font-size: 14px;
        }

        .warning-box strong {
            display: block;
            margin-bottom: 5px;
        }

        code {
            background: #f0f0f0;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: 'Courier New', monospace;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>🔐 Pebbles Elementary Admin</h1>
        <p class="subtitle">Content Management System</p>

        <div class="status-box">
            <div class="status-item">
                <div class="status-icon check">✓</div>
                <div class="status-text">Admin files installed</div>
            </div>
            <div class="status-item">
                <div class="status-icon warning">!</div>
                <div class="status-text">Database setup required</div>
            </div>
        </div>

        <div class="button-group">
            <a href="login.php" class="btn btn-primary">Login to Dashboard</a>
            <a href="setup.php" class="btn btn-secondary">Setup Guide</a>
        </div>

        <div class="info-box">
            <strong>First Time Setup?</strong>
            Click "Setup Guide" above to complete the initial configuration including database setup, credentials change, and file permissions.
        </div>

        <div class="warning-box">
            <strong>⚠️ Important:</strong>
            Default login is <code>admin / admin123</code>. Change these credentials immediately in <code>/admin/config.php</code> after setup!
        </div>

        <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd; font-size: 12px; color: #999;">
            <p>For detailed documentation, see:</p>
            <p><code>/admin/README.md</code> or <code>/admin/QUICKSTART.md</code></p>
        </div>
    </div>
</body>

</html>