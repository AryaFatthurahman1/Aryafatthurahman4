<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jakarta Luxury AI - Luxury Gateway</title>
    <link rel="stylesheet" href="/shared/css/luxury.css">
    <style>
        :root {
            --lux-bg: #010309;
            --lux-bg-alt: #050812;
            --lux-glass: rgba(10, 15, 30, 0.6);
            --lux-border: rgba(255, 255, 255, 0.07);
            --lux-border-bright: rgba(34, 211, 238, 0.25);
            --lux-cyan: #22d3ee;
            --lux-gold: #fbbf24;
            --lux-purple: #a855f7;
            --lux-emerald: #10b981;
            --lux-rose: #f43f5e;
            --lux-text: #f8fafc;
            --lux-text-dim: #94a3b8;
            --lux-text-dark: #475569;
            --lux-radius: 20px;
            --lux-transition: all 0.5s cubic-bezier(0.2, 1, 0.3, 1);
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            background-color: var(--lux-bg);
            color: var(--lux-text);
            font-family: 'Plus Jakarta Sans', sans-serif;
            line-height: 1.6;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .lux-splash {
            padding: 40px;
            background: var(--lux-glass);
            backdrop-filter: blur(25px);
            border: 1px solid var(--lux-border);
            border-radius: var(--lux-radius);
            max-width: 500px;
        }
        .lux-logo {
            font-size: 48px;
            font-weight: 900;
            letter-spacing: -2px;
            margin-bottom: 20px;
            background: linear-gradient(to bottom, #fff 40%, rgba(255,255,255,0.5));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
            position: relative;
        }
        .lux-logo .lux-grad-text {
            background: linear-gradient(90deg, var(--lux-cyan), var(--lux-purple), var(--lux-rose));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .lux-tagline {
            font-size: 18px;
            color: var(--lux-text-dim);
            margin-bottom: 30px;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }
        .lux-progress {
            width: 100%;
            height: 4px;
            background: rgba(255,255,255,0.1);
            border-radius: 2px;
            overflow: hidden;
            margin-top: 20px;
        }
        .lux-progress-bar {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, var(--lux-cyan), var(--lux-purple));
            transition: width 2s ease;
        }
        .lux-footer {
            margin-top: 30px;
            font-size: 12px;
            color: var(--lux-text-dark);
            letter-spacing: 1px;
        }
        .lux-btn {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 16px 32px;
            background: #fff;
            color: #000;
            text-decoration: none;
            border-radius: 100px;
            font-weight: 800;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            transition: var(--lux-transition);
            margin-top: 24px;
        }
        .lux-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 0 30px rgba(255,255,255,0.3);
        }
    </style>
</head>
<body>
    <div class="lux-splash">
        <div class="lux-logo">Jakarta<span class="lux-grad-text">Luxury AI</span></div>
        <div class="lux-tagline">AI-Powered Luxury Solutions - Machine Learning & API Databases</div>
        <a href="/jakarta-luxury-ai/app/dashboard.html" class="lux-btn">Enter Dashboard</a>
        <div class="lux-progress"><div class="lux-progress-bar" id="progress"></div></div>
        <div class="lux-footer">Redirecting to the Quantum Nexus...</div>
    </div>
    <script>
        setTimeout(() => {
            document.getElementById('progress').style.width = '100%';
        }, 100);
        setTimeout(() => {
            window.location.href = '/antigravity-superhub/';
        }, 3000);
    </script>
</body>
</html>