<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quantum Hackathon 2026 | AntiGravity Event</title>
    <link rel="stylesheet" href="../shared/css/luxury.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .hack-hero {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 0 24px;
        }
        .countdown {
            display: flex;
            gap: 40px;
            margin-top: 60px;
        }
        .cd-item { text-align: center; }
        .cd-val { font-size: 48px; font-weight: 900; color: #fff; font-family: 'JetBrains Mono'; }
        .cd-lbl { font-size: 10px; text-transform: uppercase; letter-spacing: 2px; color: var(--lux-text-dark); }
        
        .event-card {
            padding: 40px;
            text-align: left;
        }
    </style>
</head>
<body>

<div class="lux-mesh"></div>

<nav class="fixed top-0 left-0 w-full p-8 flex justify-between items-center z-50">
    <div style="font-weight: 900; color: #fff; font-size: 20px;">QUANTUM<span class="lux-grad-text">HACK</span></div>
    <div style="display: flex; gap: 32px;">
        <a href="#" style="color: #fff; text-decoration: none; font-size: 12px; font-weight: 700;">CHALLENGES</a>
        <a href="#" style="color: #fff; text-decoration: none; font-size: 12px; font-weight: 700;">PRIZES</a>
        <a href="#" style="color: #fff; text-decoration: none; font-size: 12px; font-weight: 700;">MENTORS</a>
    </div>
    <a href="#" class="lux-btn" style="padding: 10px 24px; font-size: 11px;">REGISTER NOW</a>
</nav>

<section class="hack-hero">
    <div class="badge" style="background: rgba(168, 85, 247, 0.1); border-color: rgba(168, 85, 247, 0.3); color: var(--lux-purple); padding: 8px 24px; border-radius: 100px; font-size: 11px; font-weight: 800; letter-spacing: 2px; margin-bottom: 32px; border: 1px solid;">GLOBAL CHALLENGE 2026</div>
    <h1 class="lux-h1">The Future of <br><span class="lux-grad-text">Computation</span></h1>
    <p style="font-size: 18px; color: var(--lux-text-dim); max-width: 700px; margin-top: 24px;">
        Join the world's brightest minds in Berlin and online for a 48-hour sprint to solve humanity's most complex problems using quantum advantage.
    </p>

    <div class="countdown">
        <div class="cd-item"><div class="cd-val">12</div><div class="cd-lbl">Days</div></div>
        <div class="cd-item"><div class="cd-val">08</div><div class="cd-lbl">Hours</div></div>
        <div class="cd-item"><div class="cd-val">42</div><div class="cd-lbl">Minutes</div></div>
        <div class="cd-item"><div class="cd-val">15</div><div class="cd-lbl">Seconds</div></div>
    </div>
</section>

<section style="padding: 100px 48px; max-width: 1400px; margin: 0 auto;">
    <div class="lux-grid">
        <div class="lux-card event-card">
            <div style="font-size: 32px; color: var(--lux-cyan); margin-bottom: 24px;"><i class="fas fa-microchip"></i></div>
            <h3 style="font-size: 24px; font-weight: 800; margin-bottom: 12px;">Circuit Optimization</h3>
            <p style="color: var(--lux-text-dim); font-size: 14px;">Develop novel compilers and error-correcting codes for NISQ devices.</p>
        </div>
        <div class="lux-card event-card">
            <div style="font-size: 32px; color: var(--lux-purple); margin-bottom: 24px;"><i class="fas fa-dna"></i></div>
            <h3 style="font-size: 24px; font-weight: 800; margin-bottom: 12px;">Quantum Biology</h3>
            <p style="color: var(--lux-text-dim); font-size: 14px;">Simulate molecular dynamics and protein folding with exponential speedup.</p>
        </div>
        <div class="lux-card event-card">
            <div style="font-size: 32px; color: var(--lux-rose); margin-bottom: 24px;"><i class="fas fa-shield-alt"></i></div>
            <h3 style="font-size: 24px; font-weight: 800; margin-bottom: 12px;">PQC Cryptography</h3>
            <h3 style="font-size: 24px; font-weight: 800; margin-bottom: 12px;">Secure Communication</h3>
            <p style="color: var(--lux-text-dim); font-size: 14px;">Build the next generation of post-quantum resistant security protocols.</p>
        </div>
    </div>
</section>

<footer style="padding: 60px; border-top: 1px solid var(--lux-border); text-align: center;">
    <p style="font-size: 11px; font-family: 'JetBrains Mono'; color: var(--lux-text-dark); letter-spacing: 3px;">POWERED BY ANTIGRAVITY ENGINE • IN COLLABORATION WITH OQC & PSIQUANTUM</p>
</footer>

<script>
    // Simple Countdown Logic
    const countdown = () => {
        const vals = document.querySelectorAll('.cd-val');
        // This is just a static visual update for now
    }
</script>
</body>
</html>
