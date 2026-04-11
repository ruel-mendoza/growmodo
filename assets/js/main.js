(function () {
  'use strict';

  // ============================================================
  // Mobile Navigation Toggle
  // ============================================================
  var toggle = document.getElementById('nav-toggle');
  var menu   = document.getElementById('primary-menu');

  if (toggle && menu) {
    toggle.addEventListener('click', function () {
      var isOpen = menu.classList.toggle('is-open');
      toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
      toggle.querySelectorAll('span').forEach(function (bar, i) {
        if (isOpen) {
          if (i === 0) bar.style.transform = 'translateY(7px) rotate(45deg)';
          if (i === 1) bar.style.opacity = '0';
          if (i === 2) bar.style.transform = 'translateY(-7px) rotate(-45deg)';
        } else {
          bar.style.transform = '';
          bar.style.opacity = '';
        }
      });
    });

    document.addEventListener('click', function (e) {
      if (!toggle.contains(e.target) && !menu.contains(e.target)) {
        menu.classList.remove('is-open');
        toggle.setAttribute('aria-expanded', 'false');
        toggle.querySelectorAll('span').forEach(function (bar) {
          bar.style.transform = '';
          bar.style.opacity = '';
        });
      }
    });
  }

  // ============================================================
  // Announcement Bar Close
  // ============================================================
  var announcement = document.getElementById('estatein-announcement');
  if (announcement) {
    var closeBtn = announcement.querySelector('.announcement-bar__close');
    if (closeBtn) {
      closeBtn.addEventListener('click', function () {
        announcement.style.maxHeight = announcement.scrollHeight + 'px';
        requestAnimationFrame(function () {
          announcement.style.transition = 'max-height .3s ease, opacity .3s ease, padding .3s ease';
          announcement.style.maxHeight  = '0';
          announcement.style.opacity    = '0';
          announcement.style.padding    = '0';
          announcement.style.overflow   = 'hidden';
        });
        setTimeout(function () {
          announcement.style.display = 'none';
        }, 350);
      });
    }
  }

  // ============================================================
  // Smooth scroll for anchor links
  // ============================================================
  document.querySelectorAll('a[href*="#"]').forEach(function (anchor) {
    anchor.addEventListener('click', function (e) {
      var hash = this.getAttribute('href').split('#')[1];
      if (!hash) return;
      var target = document.getElementById(hash);
      if (target) {
        e.preventDefault();
        var headerHeight = document.getElementById('masthead') ? document.getElementById('masthead').offsetHeight : 0;
        var top = target.getBoundingClientRect().top + window.pageYOffset - headerHeight - 20;
        window.scrollTo({ top: top, behavior: 'smooth' });
      }
    });
  });

  // ============================================================
  // Active nav link on scroll
  // ============================================================
  var sections  = document.querySelectorAll('[id]');
  var navLinks  = document.querySelectorAll('.nav-menu a');

  if (sections.length && navLinks.length) {
    window.addEventListener('scroll', function () {
      var scrollPos = window.pageYOffset + 100;
      sections.forEach(function (section) {
        if (section.offsetTop <= scrollPos && section.offsetTop + section.offsetHeight > scrollPos) {
          navLinks.forEach(function (link) {
            link.parentElement.classList.remove('current-menu-item');
            if (link.getAttribute('href') && link.getAttribute('href').includes('#' + section.id)) {
              link.parentElement.classList.add('current-menu-item');
            }
          });
        }
      });
    }, { passive: true });
  }

  // ============================================================
  // Intersection Observer — fade in on scroll
  // ============================================================
  if ('IntersectionObserver' in window) {
    var style = document.createElement('style');
    style.textContent = [
      '.estatein-fade { opacity: 0; transform: translateY(24px); transition: opacity .6s ease, transform .6s ease; }',
      '.estatein-fade.is-visible { opacity: 1; transform: translateY(0); }',
    ].join('');
    document.head.appendChild(style);

    var fadeTargets = document.querySelectorAll(
      '.property-card, .testimonial-card, .faq-card, .hero__stat-card, .hero__feature-card'
    );

    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1 });

    fadeTargets.forEach(function (el, i) {
      el.classList.add('estatein-fade');
      el.style.transitionDelay = (i % 3) * 0.1 + 's';
      observer.observe(el);
    });
  }

})();
