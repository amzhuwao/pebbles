// Mobile navigation toggle
const navToggle = document.querySelector('.nav-toggle');
const navMenu = document.querySelector('#nav-menu');

if (navToggle && navMenu) {
  navToggle.addEventListener('click', () => {
    const isOpen = navMenu.classList.toggle('open');
    navToggle.setAttribute('aria-expanded', String(isOpen));
  });
}

// Smooth scroll for anchor links
const links = document.querySelectorAll('a[href^="#"]');
links.forEach(link => {
  link.addEventListener('click', event => {
    const targetId = link.getAttribute('href');
    if (!targetId || targetId === '#') return;
    const target = document.querySelector(targetId);
    if (!target) return;
    event.preventDefault();
    const top = target.getBoundingClientRect().top + window.pageYOffset - 70;
    window.scrollTo({ top, behavior: 'smooth' });
    navMenu?.classList.remove('open');
    navToggle?.setAttribute('aria-expanded', 'false');
  });
});

// Simple reveal on scroll
const revealElements = document.querySelectorAll('.card, .stat-card, .profile, .quote, .news-card, .quick-link-card');
const observer = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('visible');
      observer.unobserve(entry.target);
    }
  });
}, { threshold: 0.12 });

revealElements.forEach(el => {
  el.classList.add('pre-reveal');
  observer.observe(el);
});

// Image Slider Functionality (Oak-inspired)
let currentSlideIndex = 0;
const slides = document.querySelectorAll('.slide');
const dots = document.querySelectorAll('.dot');
const totalSlides = slides.length;

function showSlide(index) {
  if (totalSlides === 0) return;
  
  // Wrap around if index is out of bounds
  currentSlideIndex = (index % totalSlides + totalSlides) % totalSlides;
  
  // Update slides
  slides.forEach(slide => slide.classList.remove('active'));
  if (slides[currentSlideIndex]) {
    slides[currentSlideIndex].classList.add('active');
  }
  
  // Update dots
  dots.forEach(dot => dot.classList.remove('active'));
  if (dots[currentSlideIndex]) {
    dots[currentSlideIndex].classList.add('active');
  }
}

function changeSlide(n) {
  showSlide(currentSlideIndex + n);
}

function currentSlide(n) {
  showSlide(n);
}

// Auto-rotate slides every 5 seconds
let sliderAutoplay = setInterval(() => {
  changeSlide(1);
}, 5000);

// Reset autoplay on manual navigation
function resetAutoplay() {
  clearInterval(sliderAutoplay);
  sliderAutoplay = setInterval(() => {
    changeSlide(1);
  }, 5000);
}

// Add event listeners for manual navigation
const prevBtn = document.querySelector('.slider-prev');
const nextBtn = document.querySelector('.slider-next');

if (prevBtn) {
  prevBtn.addEventListener('click', () => {
    changeSlide(-1);
    resetAutoplay();
  });
}

if (nextBtn) {
  nextBtn.addEventListener('click', () => {
    changeSlide(1);
    resetAutoplay();
  });
}

// Add click handlers to dots
dots.forEach((dot, index) => {
  dot.addEventListener('click', () => {
    currentSlide(index);
    resetAutoplay();
  });
});

// Initialize slider
if (totalSlides > 0) {
  showSlide(0);
}
