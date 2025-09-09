<?php
// index.php - PTI CBT Portal (with Developers modal)
// Converted from provided HTML to PHP while preserving styles, links, logic and markup.

$pageTitle = "PTI Computer-Based Testing Portal — Petroleum Training Institute";
$logoPath  = 'image/PTI.jpg';
$year      = date('Y');
include 'header.php';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title><?php echo htmlspecialchars($pageTitle); ?></title>

  <!-- Font: Inter (system fallback) -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">

  <!-- Link to Custom CSS-->
   <link rel="stylesheet" href="css/styles.css">

  <!-- FontAwesome for optional icons (progressive enhancement) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <meta name="description" content="PTI Computer-Based Testing (CBT) Portal — secure, 24/7 accessible, with instant results and analytics for students and administrators." />

  <!-- Modal-specific styles (kept local so integrating this file is simple) -->
  <style>
    /* Modal overlay & card */
    .dev-modal-overlay {
      position: fixed;
      inset: 0;
      background: rgba(3, 10, 18, 0.6);
      display: none; /* shown when active */
      align-items: center;
      justify-content: center;
      z-index: 1200;
      padding: 24px;
      backdrop-filter: blur(6px) saturate(1.05);
    }

    .dev-modal-overlay.show {
      display: flex;
      animation: fadeIn .16s ease-out;
    }

    @keyframes fadeIn { from { opacity: 0; transform: translateY(6px) } to { opacity: 1; transform: translateY(0) } }

    .dev-modal {
      width: 100%;
      max-width: 720px;
      background: linear-gradient(180deg, #ffffff, #fbfdff);
      border-radius: 12px;
      box-shadow: 0 12px 40px rgba(8,20,40,0.25);
      padding: 20px;
      position: relative;
      border: 1px solid rgba(10, 40, 80, 0.04);
      font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
    }

    .dev-modal header {
      display: flex;
      gap: 12px;
      align-items: center;
      margin-bottom: 10px;
    }

    .dev-modal .title {
      font-size: 18px;
      margin: 0;
      font-weight: 700;
      color: #07203a;
    }

    .dev-modal .subtitle {
      font-size: 13px;
      color: #4a6b8a;
      margin-top: 2px;
    }

    .dev-modal .close-x {
      position: absolute;
      right: 12px;
      top: 12px;
      background: transparent;
      border: none;
      font-size: 16px;
      color: #6b7b8a;
      cursor: pointer;
    }

    .dev-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px 18px;
      margin-top: 12px;
    }

    .dev-card {
      background: rgba(8,28,48,0.03);
      border-radius: 8px;
      padding: 12px;
      border: 1px solid rgba(8,28,48,0.04);
    }

    .dev-card h5 { margin: 0 0 6px 0; font-size: 14px }
    .dev-card p { margin: 0; font-size: 13px; color: #32506a }

    .dev-modal .actions {
      display:flex;
      gap:10px;
      justify-content:flex-end;
      margin-top:18px;
      align-items:center;
    }

    /* Make modal responsive */
    @media (max-width:640px) {
      .dev-modal { padding: 14px; border-radius: 10px }
      .dev-grid { grid-template-columns: 1fr }
      .dev-modal .actions { flex-direction: column-reverse; align-items: stretch }
      .dev-modal .actions .btn { width: 100% }
      .dev-modal .close-x { right: 10px; top: 10px }
    }

    /* Small helper for link-style button in footer */
    .link-button {
      background: none;
      border: none;
      color: inherit;
      font: inherit;
      cursor: pointer;
      padding: 6px 8px;
      border-radius: 6px;
    }

    .link-button:focus { outline: 3px solid rgba(3,102,214,0.12); }

  </style>
</head>
<body>
  <div class="site" role="main">

    <!-- Header -->
    <header class="header" role="banner" aria-label="PTI CBT header">
    
    </header>

    <!-- HERO -->
    <section class="hero" aria-labelledby="heroHeading">
      <div class="hero-card" role="region" aria-label="Main introduction">
        <div class="eyebrow" aria-hidden="true">
          <span class="pill"><i class="fa-solid fa-shield-halved" style="font-size:12px"></i> Secure &amp; Accredited</span>
          <small class="muted">CBT center • Remote proctoring ready</small>
        </div>

        <h2 id="heroHeading">PTI Computer-Based Testing Portal</h2>
        <p class="lead">Empowering the future of energy through advanced assessments. Take secure exams, track progress, and receive instant results — designed for students and educators at the Petroleum Training Institute.</p>

        <div class="cta-group" role="group" aria-label="Primary call to actions">
          <a class="btn btn-primary" href="user-login.php" title="Student Login">
            <i class="fa-solid fa-right-to-bracket" aria-hidden="true"></i>
            Student Login
          </a>
          <a class="btn btn-ghost" href="user-signup.php" title="Student Signup">
            <i class="fa-regular fas fa-pencil-alt" aria-hidden="true"></i>
            Student Signup
          </a>
         
        </div>

        <!-- short accessibility / trust strip -->
        <div style="margin-top:22px;display:flex;gap:12px;flex-wrap:wrap">
          <small class="muted"><strong>Exam Window:</strong> 24/7 availability</small>
          <small class="muted">•</small>
          <small class="muted"><strong>Support:</strong> support@pti.edu.ng</small>
        </div>
      </div>

      <!-- Right visual column: stats + illustration -->
      
    </section>

    <!-- FEATURES -->
    <section id="features" class="features" aria-label="CBT features & benefits">
      <!-- Feature 1 -->
      <div class="feature">
        <!-- Inline SVG icon (accessibility friendly) -->
        <svg class="icon" viewBox="0 0 24 24" fill="none" aria-hidden="true" role="img" focusable="false">
          <rect x="3" y="3" width="18" height="18" rx="3" fill="currentColor" opacity="0.08"></rect>
          <path d="M8 12h8M8 16h8M8 8h8" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
        <div>
          <h4>24/7 Accessibility</h4>
          <p>Take your exams anytime. Our cloud-based CBT platform supports flexible scheduling and remote access.</p>
        </div>
      </div>

      <!-- Feature 2 -->
      <div class="feature">
        <svg class="icon" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 2v6" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/><path d="M12 16v6" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/><circle cx="12" cy="12" r="8" stroke="currentColor" stroke-width="1.4" fill="currentColor" opacity="0.04"/></svg>
        <div>
          <h4>Instant Results</h4>
          <p>Automatic grading for objective questions means learners receive immediate feedback and performance summaries.</p>
        </div>
      </div>

      <!-- Feature 3 -->
      <div class="feature">
        <svg class="icon" viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="3" y="7" width="18" height="14" rx="2" stroke="currentColor" stroke-width="1.4" fill="currentColor" opacity="0.04"/><path d="M8 7v-2a4 4 0 0 1 8 0v2" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>
        <div>
          <h4>Secure Testing</h4>
          <p>Proctoring-ready features, secure sessions, and tamper-resistant question delivery ensure exam integrity.</p>
        </div>
      </div>

      <!-- Feature 4 -->
      <div class="feature">
        <svg class="icon" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 6h16M4 12h9M4 18h12" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"></svg>
        <div>
          <h4>Performance Analytics</h4>
          <p>Robust dashboards for students and instructors. Track progress, item analysis, and trends over time.</p>
        </div>
      </div>
    </section>

    <?php include 'footer.php'; ?>


  <!-- Minimal JS for mobile nav toggle + graceful fallback + modal behavior -->
  <script>
     (function(){
      const toggle = document.getElementById('mobileToggle');
      const navLinks = document.getElementById('navLinks');

      toggle.addEventListener('click', function(){
        const expanded = this.getAttribute('aria-expanded') === 'true';
        this.setAttribute('aria-expanded', String(!expanded));
        navLinks.classList.toggle('show');
      });

      // Small enhancement: smooth scroll to anchors on the page (for the demo placeholders)
      document.querySelectorAll('a[href^="#"]').forEach(a=>{
        a.addEventListener('click', function(e){
          const target = this.getAttribute('href');
          if(target === '#' || target === '') return;
          // Let browser handle external or real anchors; for placeholders just prevent default jump
          if(document.querySelector(target)){
            e.preventDefault();
            document.querySelector(target).scrollIntoView({behavior:'smooth', block:'start'});
            // close mobile menu if open
            if(navLinks.classList.contains('show')) {
              navLinks.classList.remove('show');
              toggle.setAttribute('aria-expanded','false');
            }
          }
        });
      });

      // Set current year in footer (progressive enhancement)
      const y = new Date().getFullYear();
      const el = document.getElementById('year');
      if(el) el.textContent = y;

     

    })();
  </script>
</body>
</html>
