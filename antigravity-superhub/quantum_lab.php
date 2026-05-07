<?php
require_once dirname(__DIR__) . '/shared/portal_helpers.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quantum Lab | AntiGravity Universal</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .lab-grid {
            display: grid;
            grid-template-columns: 3fr 1fr;
            gap: 24px;
            margin-top: 40px;
        }
        .circuit-designer {
            height: 600px;
            border-radius: var(--radius-lg);
            overflow: hidden;
            position: relative;
        }
        .circuit-designer img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .gate-palette {
            padding: 24px;
        }
        .gate-item {
            padding: 16px;
            background: rgba(255,255,255,0.03);
            border: 1px solid var(--border);
            border-radius: 12px;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            transition: var(--transition);
        }
        .gate-item:hover {
            background: rgba(34, 211, 238, 0.1);
            border-color: var(--cyan);
        }
        .gate-icon {
            width: 32px;
            height: 32px;
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'JetBrains Mono', monospace;
            font-weight: 700;
            color: var(--cyan);
        }
    </style>
</head>
<body>

<div class="mesh-bg"></div>

<div class="app-container">
    <!-- Sidebar (Same as index) -->
    <aside class="sidebar">
        <a href="index.php" class="sidebar-logo">
            <div class="logo-box">AG</div>
            <div class="logo-text">
                <h2>Anti<span>Gravity</span></h2>
                <p>Universal Nexus V3</p>
            </div>
        </a>
        <nav class="nav-menu">
            <a href="index.php" class="nav-item"><i class="fas fa-th-large"></i> Dashboard</a>
            <a href="index.php#projects" class="nav-item"><i class="fas fa-project-diagram"></i> Repositories</a>
            <a href="#" class="nav-item active"><i class="fas fa-atom"></i> Quantum Lab</a>
            <a href="index.php#services" class="nav-item"><i class="fas fa-bolt"></i> Cloud Services</a>
        </nav>
    </aside>

    <main class="main-wrapper">
        <header class="top-nav">
            <div style="font-size: 18px; font-weight: 800;">QUANTUM LAB <span style="color: var(--text-dark); font-weight: 400;">/ Circuit Designer</span></div>
            <div style="display: flex; gap: 12px;">
                <button class="btn-primary" style="padding: 8px 20px; font-size: 12px;">RUN SIMULATION</button>
            </div>
        </header>

        <section class="section">
            <div class="section-header">
                <h2 class="section-title">Interactive Circuit Designer</h2>
                <p class="section-desc">Design and simulate quantum algorithms in real-time using our proprietary visual interface.</p>
            </div>

            <div class="lab-grid">
                <div class="circuit-designer glass">
                    <img src="assets/mockup.png" alt="Circuit Designer Mockup">
                    <div style="position: absolute; bottom: 32px; left: 32px; right: 32px; display: flex; justify-content: space-between; align-items: center;">
                        <div class="glass-card" style="padding: 12px 24px; border-radius: 100px; display: flex; gap: 24px; font-size: 11px; font-weight: 700; color: var(--text-dim);">
                            <span>QUBITS: 127</span>
                            <span>GATES: 42</span>
                            <span>DEPTH: 18</span>
                        </div>
                        <div style="display: flex; gap: 12px;">
                            <button style="background: rgba(0,0,0,0.5); border: 1px solid var(--border); color: #fff; padding: 10px 20px; border-radius: 10px; cursor: pointer;"><i class="fas fa-save"></i> Save</button>
                            <button style="background: var(--cyan); border: none; color: #000; padding: 10px 24px; border-radius: 10px; font-weight: 800; cursor: pointer;"><i class="fas fa-play"></i> Execute</button>
                        </div>
                    </div>
                </div>

                <div class="gate-palette glass-card">
                    <h4 style="font-size: 12px; text-transform: uppercase; letter-spacing: 1px; color: var(--text-dark); margin-bottom: 24px;">Gate Palette</h4>
                    
                    <div class="gate-item">
                        <div class="gate-icon">H</div>
                        <div>
                            <div style="font-size: 14px; font-weight: 700;">Hadamard</div>
                            <div style="font-size: 11px; color: var(--text-dark);">Superposition gate</div>
                        </div>
                    </div>

                    <div class="gate-item">
                        <div class="gate-icon">X</div>
                        <div>
                            <div style="font-size: 14px; font-weight: 700;">Pauli-X</div>
                            <div style="font-size: 11px; color: var(--text-dark);">Bit-flip gate</div>
                        </div>
                    </div>

                    <div class="gate-item">
                        <div class="gate-icon">CX</div>
                        <div>
                            <div style="font-size: 14px; font-weight: 700;">CNOT</div>
                            <div style="font-size: 11px; color: var(--text-dark);">Entanglement gate</div>
                        </div>
                    </div>

                    <div class="gate-item">
                        <div class="gate-icon">RZ</div>
                        <div>
                            <div style="font-size: 14px; font-weight: 700;">Phase Shift</div>
                            <div style="font-size: 11px; color: var(--text-dark);">Rotational gate</div>
                        </div>
                    </div>

                    <div style="margin-top: 40px;">
                        <h4 style="font-size: 12px; text-transform: uppercase; letter-spacing: 1px; color: var(--text-dark); margin-bottom: 16px;">System Health</h4>
                        <div style="padding: 16px; background: rgba(16, 185, 129, 0.05); border: 1px solid rgba(16, 185, 129, 0.2); border-radius: 12px;">
                            <div style="font-size: 12px; font-weight: 700; color: var(--emerald); margin-bottom: 4px;">Backend: IBM_Oslo</div>
                            <div style="font-size: 10px; color: var(--text-dim);">Queue Time: < 1 min</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="section-header">
                <h2 class="section-title">Quantum Algorithms</h2>
                <p class="section-desc">Pre-built templates for standard quantum computing algorithms.</p>
            </div>

            <div class="projects-grid">
                <div class="glass-card" style="padding: 24px;">
                    <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 12px;">Grover's Algorithm</h3>
                    <p style="font-size: 13px; color: var(--text-dim); margin-bottom: 20px;">Unstructured search algorithm with quadratic speedup.</p>
                    <button style="color: var(--cyan); background: transparent; border: none; font-weight: 700; cursor: pointer; padding: 0;">LOAD TEMPLATE <i class="fas fa-chevron-right"></i></button>
                </div>
                <div class="glass-card" style="padding: 24px;">
                    <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 12px;">Shor's Algorithm</h3>
                    <p style="font-size: 13px; color: var(--text-dim); margin-bottom: 20px;">Integer factorization with exponential speedup.</p>
                    <button style="color: var(--cyan); background: transparent; border: none; font-weight: 700; cursor: pointer; padding: 0;">LOAD TEMPLATE <i class="fas fa-chevron-right"></i></button>
                </div>
                <div class="glass-card" style="padding: 24px;">
                    <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 12px;">Quantum Fourier Transform</h3>
                    <p style="font-size: 13px; color: var(--text-dim); margin-bottom: 20px;">Linear transformation on quantum bits.</p>
                    <button style="color: var(--cyan); background: transparent; border: none; font-weight: 700; cursor: pointer; padding: 0;">LOAD TEMPLATE <i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </section>

        <footer class="footer">
            <div class="footer-logo">Anti<span>Gravity</span></div>
            <p class="footer-copy">© 2026 ANTIGRAVITY ENTERPRISE SYSTEMS • POWERED BY QUANTUM INTELLIGENCE</p>
        </footer>
    </main>
</div>

<script src="js/app.js"></script>
</body>
</html>
