<?php
// footer.php - Reusable footer with Developers modal
?>
<footer class="footer" role="contentinfo" aria-label="Footer">
  <div class="footer-container">
    
    <!-- Left -->
    <div class="footer-left">
      © <span id="year"><?php echo date('Y'); ?></span> Petroleum Training Institute. 
      <span class="nowrap">All rights reserved.</span>
    </div>

    <!-- Center -->
    <nav class="footer-links" aria-label="Footer links">
      <a class="nav-link text-white" href="feedback.php">Feedback</a>
      <!-- Open modal with button for accessibility -->
      <button id="openDevModal" class="link-button" aria-label="Developer info">Developers</button>
    </nav>

    <!-- Right -->
    <div class="footer-cta" role="group" aria-label="Footer call to actions">
      <a class="btn btn-primary" href="user-signup.php" title="Create Account">
        <i class="fas fa-pencil-alt" aria-hidden="true"></i> Create Account
      </a>
      <a class="btn btn-ghost" href="user-login.php" title="Sign In">
        <i class="fa-solid fa-right-to-bracket" aria-hidden="true"></i> Sign In
      </a>
    </div>
    
  </div>
</footer>

<!-- Developers Modal -->
<div id="devModalOverlay" class="dev-modal-overlay" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="devModalTitle">
  <div class="dev-modal" role="document">
    <button class="close-x" id="devModalCloseX" aria-label="Close developers dialog">&times;</button>
    <header>
      <div style="display:flex;align-items:center;gap:10px">
        <div style="width:44px;height:44px;background:linear-gradient(135deg,#0b6cff,#00bfa6);border-radius:8px;display:flex;align-items:center;justify-content:center;color:white;font-weight:700">PT</div>
        <div>
          <h3 id="devModalTitle" class="title">Developers & Contributors</h3>
          <div class="subtitle">Core team behind the PTI CBT Portal (prototype)</div>
        </div>
      </div>
    </header>

    <div class="dev-grid">
      <div class="dev-card">
        <h5>Lead Developer</h5>
        <p>Rapheal — Backend & Exam Engine</p>
        <p style="margin-top:8px;font-size:12px;color:#4a6b8a">rapheal@example.com</p>
      </div>

      <div class="dev-card">
        <h5>Frontend & Accessibility</h5>
        <p>Rapheal — UI/UX, Responsive Layouts</p>
        <p style="margin-top:8px;font-size:12px;color:#4a6b8a">rapheal@example.com</p>
      </div>

      <div class="dev-card">
        <h5>DevOps</h5>
        <p>Rapheal — Deployment & Security</p>
        <p style="margin-top:8px;font-size:12px;color:#4a6b8a">rapheal@example.com</p>
      </div>

      <div class="dev-card">
        <h5>QA & Testing</h5>
        <p>Rapheal — Test Automation & Reporting</p>
        <p style="margin-top:8px;font-size:12px;color:#4a6b8a">rapheal@example.com</p>
      </div>
    </div>

    <div class="actions">
      <button id="devModalCancel" class="btn btn-secondary" aria-label="Cancel and close">Cancel</button>
    </div>
  </div>
</div>

<!-- Modal Script -->
<script>
(function(){
  const openBtn = document.getElementById('openDevModal');
  const overlay = document.getElementById('devModalOverlay');
  const cancelBtn = document.getElementById('devModalCancel');
  const closeX = document.getElementById('devModalCloseX');
  let lastFocused = null;

  function openModal() {
    lastFocused = document.activeElement;
    overlay.classList.add('show');
    overlay.setAttribute('aria-hidden', 'false');
    closeX.focus();
    document.documentElement.style.overflow = 'hidden';
  }

  function closeModal() {
    overlay.classList.remove('show');
    overlay.setAttribute('aria-hidden', 'true');
    document.documentElement.style.overflow = '';
    if(lastFocused && typeof lastFocused.focus === 'function') lastFocused.focus();
  }

  if(openBtn) openBtn.addEventListener('click', openModal);
  if(cancelBtn) cancelBtn.addEventListener('click', closeModal);
  if(closeX) closeX.addEventListener('click', closeModal);

  overlay.addEventListener('click', function(e){
    if(e.target === overlay) closeModal();
  });

  document.addEventListener('keydown', function(e){
    if(e.key === 'Escape' && overlay.classList.contains('show')) closeModal();
  });

  document.querySelectorAll('.dev-modal').forEach(m=>{
    m.addEventListener('click', e=> e.stopPropagation());
  });
})();
</script>
