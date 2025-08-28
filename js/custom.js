/**
 * Custom Blue Orange Theme JavaScript
 * Enhanced functionality for the WordPress theme
 */

(function() {
    'use strict';

    // Wait for DOM to be ready
    document.addEventListener('DOMContentLoaded', function() {
        
        // Mobile Menu Toggle
        initMobileMenu();
        
        // Smooth Scrolling
        initSmoothScrolling();
        
        // Search Enhancement
        enhanceSearch();
        
        // Back to Top Button
        initBackToTop();
        
        // Image Lazy Loading
        initLazyLoading();
        
        // Form Enhancements
        enhanceForms();
        
        // Accessibility Improvements
        improveAccessibility();
        
        // Hero Slideshow
        initHeroSlideshow();
        

    });

    /**
     * Mobile Menu Toggle Functionality - Disabled
     * Side navigation panel is handled in header.php inline script
     */
    function initMobileMenu() {
        // This function is disabled to prevent conflicts with side navigation panel
        // The mobile menu functionality is now handled by the side navigation panel
        // in header.php inline JavaScript
        console.log('Mobile menu handled by side navigation panel');
    }

    /**
     * Smooth Scrolling for Anchor Links
     */
    function initSmoothScrolling() {
        const anchorLinks = document.querySelectorAll('a[href^="#"]');
        
        anchorLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    e.preventDefault();
                    
                    const headerHeight = document.querySelector('.site-header').offsetHeight;
                    const targetPosition = targetElement.offsetTop - headerHeight - 20;
                    
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });
    }

    /**
     * Search Enhancement
     */
    function enhanceSearch() {
        const searchForms = document.querySelectorAll('.search-form');
        
        searchForms.forEach(form => {
            const searchInput = form.querySelector('.search-field');
            const searchSubmit = form.querySelector('.search-submit');
            
            if (searchInput) {
                // Add search icon
                searchInput.style.paddingRight = '45px';
                
                // Enhance placeholder
                searchInput.addEventListener('focus', function() {
                    this.style.borderColor = 'var(--primary-blue)';
                    this.style.boxShadow = '0 0 5px rgba(44, 90, 160, 0.3)';
                });
                
                searchInput.addEventListener('blur', function() {
                    this.style.borderColor = '#ddd';
                    this.style.boxShadow = 'none';
                });
                
                // Submit on Enter
                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        form.submit();
                    }
                });
            }
        });
    }

    /**
     * Back to Top Button
     */
    function initBackToTop() {
        // Create back to top button
        const backToTopBtn = document.createElement('button');
        backToTopBtn.innerHTML = '↑';
        backToTopBtn.className = 'back-to-top';
        backToTopBtn.setAttribute('aria-label', 'Back to top');
        // CSS styles are handled in style.css
        backToTopBtn.style.opacity = '0';
        backToTopBtn.style.visibility = 'hidden';
        
        document.body.appendChild(backToTopBtn);
        
        // Show/hide button based on scroll position
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopBtn.style.opacity = '1';
                backToTopBtn.style.visibility = 'visible';
            } else {
                backToTopBtn.style.opacity = '0';
                backToTopBtn.style.visibility = 'hidden';
            }
        });
        
        // Scroll to top when clicked
        backToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
        
        // Hover effects
        backToTopBtn.addEventListener('mouseenter', function() {
            this.style.backgroundColor = 'var(--light-orange)';
        });
        
        backToTopBtn.addEventListener('mouseleave', function() {
            this.style.backgroundColor = 'var(--primary-orange)';
        });
    }

    /**
     * Image Lazy Loading
     */
    function initLazyLoading() {
        const images = document.querySelectorAll('img[data-src]');
        
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                    }
                });
            });
            
            images.forEach(img => imageObserver.observe(img));
        } else {
            // Fallback for older browsers
            images.forEach(img => {
                img.src = img.dataset.src;
            });
        }
    }

    /**
     * Form Enhancements
     */
    function enhanceForms() {
        const forms = document.querySelectorAll('form');
        
        forms.forEach(form => {
            const inputs = form.querySelectorAll('input, textarea, select');
            
            inputs.forEach(input => {
                // Add focus effects
                input.addEventListener('focus', function() {
                    this.style.borderColor = 'var(--primary-blue)';
                    this.style.outline = 'none';
                    this.style.boxShadow = '0 0 5px rgba(44, 90, 160, 0.3)';
                });
                
                input.addEventListener('blur', function() {
                    this.style.borderColor = '#ddd';
                    this.style.boxShadow = 'none';
                });
                
                // Validate required fields
                if (input.hasAttribute('required')) {
                    input.addEventListener('invalid', function() {
                        this.style.borderColor = '#e74c3c';
                    });
                    
                    input.addEventListener('input', function() {
                        if (this.validity.valid) {
                            this.style.borderColor = '#27ae60';
                        }
                    });
                }
            });
        });
    }

    /**
     * Accessibility Improvements
     */
    function improveAccessibility() {
        // Add skip link
        const skipLink = document.createElement('a');
        skipLink.href = '#main';
        skipLink.textContent = 'Skip to main content';
        skipLink.className = 'skip-link';
        skipLink.style.cssText = `
            position: absolute;
            top: -40px;
            left: 6px;
            background: var(--primary-blue);
            color: white;
            padding: 8px;
            text-decoration: none;
            z-index: 100000;
            border-radius: 3px;
        `;
        
        skipLink.addEventListener('focus', function() {
            this.style.top = '6px';
        });
        
        skipLink.addEventListener('blur', function() {
            this.style.top = '-40px';
        });
        
        document.body.insertBefore(skipLink, document.body.firstChild);
        
        // Add main landmark if not present
        const main = document.querySelector('main');
        if (main && !main.id) {
            main.id = 'main';
        }
        
        // Improve focus indicators
        const focusableElements = document.querySelectorAll('a, button, input, textarea, select, [tabindex]');
        
        focusableElements.forEach(element => {
            element.addEventListener('focus', function() {
                this.style.outline = '2px solid var(--primary-orange)';
                this.style.outlineOffset = '2px';
            });
            
            element.addEventListener('blur', function() {
                this.style.outline = '';
                this.style.outlineOffset = '';
            });
        });
    }

    /**
     * Utility function to debounce events
     */
    function debounce(func, wait, immediate) {
        let timeout;
        return function executedFunction() {
            const context = this;
            const args = arguments;
            const later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            const callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    }

    // Debounced resize handler
    const debouncedResize = debounce(function() {
        // Handle any resize-specific functionality here
        console.log('Window resized');
    }, 250);
    
    window.addEventListener('resize', debouncedResize);

    /**
     * Hero Slideshow Functionality
     */
    function initHeroSlideshow() {
        const heroSection = document.querySelector('.hero-section');
        if (!heroSection) return;
        
        const slideshow = heroSection.querySelector('.hero-slideshow');
        const slides = slideshow.querySelectorAll('.slide');
        const prevBtn = slideshow.querySelector('.prev-arrow');
        const nextBtn = slideshow.querySelector('.next-arrow');
        const indicators = slideshow.querySelectorAll('.nav-dot');
        
        if (slides.length <= 1) return;
        
        let currentSlideIndex = 0;
        let isTransitioning = false;
        let autoPlayInterval;
        
        // Get settings from data attributes or defaults
        const autoPlay = heroSection.dataset.autoplay !== 'false';
        const slideDuration = parseInt(heroSection.dataset.duration) || 5000;
        
        // Initialize slideshow
        function initSlides() {
            slides.forEach((slide, index) => {
                if (index === 0) {
                    slide.classList.add('active');
                } else {
                    slide.classList.remove('active');
                }
            });
            
            if (indicators.length > 0) {
                indicators[0].classList.add('active');
            }
        }
        
        // Show specific slide
        function showSlide(index) {
            if (isTransitioning || index === currentSlideIndex) return;
            
            isTransitioning = true;
            
            // Remove active class from current slide and indicator
            slides[currentSlideIndex].classList.remove('active');
            if (indicators.length > 0) {
                indicators[currentSlideIndex].classList.remove('active');
            }
            
            // Update current index
            currentSlideIndex = index;
            
            // Add active class to new slide and indicator
            slides[currentSlideIndex].classList.add('active');
            if (indicators.length > 0) {
                indicators[currentSlideIndex].classList.add('active');
            }
            
            // Reset transition flag
            setTimeout(() => {
                isTransitioning = false;
            }, 800);
        }
        
        // Next slide
        function nextSlide() {
            const nextIndex = (currentSlideIndex + 1) % slides.length;
            showSlide(nextIndex);
        }
        
        // Previous slide
        function prevSlide() {
            const prevIndex = (currentSlideIndex - 1 + slides.length) % slides.length;
            showSlide(prevIndex);
        }
        
        // Go to specific slide
        function currentSlide(index) {
            showSlide(index - 1);
        }
        
        // Auto-play functionality
        function startAutoPlay() {
            if (autoPlay && slides.length > 1) {
                autoPlayInterval = setInterval(nextSlide, slideDuration);
            }
        }
        
        function stopAutoPlay() {
            if (autoPlayInterval) {
                clearInterval(autoPlayInterval);
                autoPlayInterval = null;
            }
        }
        
        // Event listeners
        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                stopAutoPlay();
                nextSlide();
                startAutoPlay();
            });
        }
        
        if (prevBtn) {
            prevBtn.addEventListener('click', () => {
                stopAutoPlay();
                prevSlide();
                startAutoPlay();
            });
        }
        
        // Indicator clicks
        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                stopAutoPlay();
                showSlide(index);
                startAutoPlay();
            });
        });
        
        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') {
                stopAutoPlay();
                prevSlide();
                startAutoPlay();
            } else if (e.key === 'ArrowRight') {
                stopAutoPlay();
                nextSlide();
                startAutoPlay();
            }
        });
        
        // Touch/swipe support
        let touchStartX = 0;
        let touchEndX = 0;
        
        slideshow.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        });
        
        slideshow.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        });
        
        function handleSwipe() {
            const swipeThreshold = 50;
            const diff = touchStartX - touchEndX;
            
            if (Math.abs(diff) > swipeThreshold) {
                stopAutoPlay();
                if (diff > 0) {
                    nextSlide(); // Swipe left - next slide
                } else {
                    prevSlide(); // Swipe right - previous slide
                }
                startAutoPlay();
            }
        }
        
        // Pause on hover
        slideshow.addEventListener('mouseenter', stopAutoPlay);
        slideshow.addEventListener('mouseleave', startAutoPlay);
        
        // Pause when page is not visible
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                stopAutoPlay();
            } else {
                startAutoPlay();
            }
        });
        
        // Initialize
        initSlides();
        startAutoPlay();
        
        // Make functions globally available for inline onclick handlers
         window.currentSlide = currentSlide;
         window.nextSlide = nextSlide;
         window.prevSlide = prevSlide;
     }

    // Initialize hero slideshow when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initHeroSlideshow);
    } else {
        initHeroSlideshow();
    }

    /**
     * Contact Form Functionality with AJAX
     */
    function initContactForm() {
        const contactForm = document.getElementById('contact-form');
        if (!contactForm) {
            console.log('Contact form not found');
            return;
        }
        
        // Check if contact_ajax is available
        if (typeof contact_ajax === 'undefined') {
            console.error('contact_ajax object not found. Make sure wp_localize_script is working.');
        } else {
            console.log('Contact form initialized successfully');
        }
        
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form elements
            const submitBtn = contactForm.querySelector('.submit-btn');
            const submitText = submitBtn.querySelector('.btn-text');
            const loadingText = submitBtn.querySelector('.btn-loading');
            const messageDiv = document.querySelector('#form-message');
            
            // Validate form
            if (!validateContactForm(contactForm)) {
                return;
            }
            
            // Show loading state
            submitText.style.display = 'none';
            loadingText.style.display = 'inline';
            submitBtn.disabled = true;
            
            // Clear previous messages
            if (messageDiv) {
                messageDiv.innerHTML = '';
                messageDiv.className = 'form-message';
            }
            
            // Prepare form data
            const formData = new FormData(contactForm);
            formData.append('action', 'submit_contact_form');
            
            // Add nonce from form or AJAX object
            const nonceField = contactForm.querySelector('input[name="contact_nonce"]');
            if (nonceField) {
                formData.append('nonce', nonceField.value);
            } else if (contact_ajax && contact_ajax.nonce) {
                formData.append('nonce', contact_ajax.nonce);
            }
            
            // Get AJAX URL with fallback
            const ajaxUrl = (typeof contact_ajax !== 'undefined' && contact_ajax.ajax_url) 
                ? contact_ajax.ajax_url 
                : '/wp-admin/admin-ajax.php';
            
            console.log('Sending form data to:', ajaxUrl);
            
            // Send AJAX request
            fetch(ajaxUrl, {
                method: 'POST',
                body: formData,
                credentials: 'same-origin'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showFormMessage('Cảm ơn bạn! Chúng tôi đã nhận được thông tin và sẽ liên hệ với bạn sớm nhất có thể.', 'success');
                    contactForm.reset();
                } else {
                    showFormMessage(data.data || 'Có lỗi xảy ra. Vui lòng thử lại sau.', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showFormMessage('Có lỗi xảy ra khi gửi form. Vui lòng thử lại sau.', 'error');
            })
            .finally(() => {
                // Reset button state
                submitText.style.display = 'inline';
                loadingText.style.display = 'none';
                submitBtn.disabled = false;
            });
        });
    }

    function validateContactForm(form) {
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(function(field) {
            const errorMsg = field.parentNode.querySelector('.error-message');
            
            // Remove existing error message
            if (errorMsg) {
                errorMsg.remove();
            }
            
            // Remove error styling
            field.classList.remove('error');
            
            // Check if field is empty
            if (!field.value.trim()) {
                showFieldError(field, 'This field is required.');
                isValid = false;
            } else if (field.type === 'email' && !isValidEmail(field.value)) {
                showFieldError(field, 'Please enter a valid email address.');
                isValid = false;
            }
        });
        
        return isValid;
    }

    function showFieldError(field, message) {
        field.classList.add('error');
        
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-message';
        errorDiv.textContent = message;
        errorDiv.style.color = '#dc3545';
        errorDiv.style.fontSize = '0.875rem';
        errorDiv.style.marginTop = '5px';
        
        field.parentNode.appendChild(errorDiv);
    }

    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function showFormMessage(message, type) {
        const messageDiv = document.querySelector('#form-message');
        if (!messageDiv) return;
        
        // Set message content
        messageDiv.textContent = message;
        messageDiv.className = 'form-message';
        
        // Add type-specific class
        if (type === 'success') {
            messageDiv.classList.add('success');
        } else {
            messageDiv.classList.add('error');
        }
        
        // Style the message
        messageDiv.style.display = 'block';
        messageDiv.style.padding = '15px';
        messageDiv.style.borderRadius = '8px';
        messageDiv.style.marginTop = '20px';
        messageDiv.style.fontWeight = '500';
        
        if (type === 'success') {
            messageDiv.style.backgroundColor = '#d4edda';
            messageDiv.style.color = '#155724';
            messageDiv.style.border = '1px solid #c3e6cb';
        } else {
            messageDiv.style.backgroundColor = '#f8d7da';
            messageDiv.style.color = '#721c24';
            messageDiv.style.border = '1px solid #f5c6cb';
        }
        
        // Auto-hide message after 5 seconds
        setTimeout(function() {
            messageDiv.style.display = 'none';
            messageDiv.innerHTML = '';
            messageDiv.className = 'form-message';
        }, 5000);
    }



    // Initialize contact form when DOM is loaded
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            initContactForm();
            initFloatingContactButton();
        });
    } else {
        initContactForm();
        initFloatingContactButton();
    }

// Close contact panel function (global)
function closeContactPanel() {
    const panel = document.getElementById('phonePanel');
    if (panel) {
        panel.classList.remove('show');
    }
}

    // Enhanced floating contact button with persistent panel
    function initFloatingContactButton() {
        const floatingBtn = document.getElementById('floatingContactBtn');
        const contactBtn = floatingBtn?.querySelector('.contact-btn');
        const phonePanel = document.getElementById('phonePanel');
        
        if (!floatingBtn || !contactBtn || !phonePanel) return;
        
        let hoverTimeout;
        
        // Show panel on hover
        floatingBtn.addEventListener('mouseenter', () => {
            clearTimeout(hoverTimeout);
            phonePanel.classList.add('show');
        });
        
        // Keep panel open when hovering over it
        phonePanel.addEventListener('mouseenter', () => {
            clearTimeout(hoverTimeout);
            phonePanel.classList.add('show');
        });
        
        // Hide panel with delay when leaving both button and panel
        floatingBtn.addEventListener('mouseleave', (e) => {
            if (!phonePanel.contains(e.relatedTarget)) {
                hoverTimeout = setTimeout(() => {
                    if (!phonePanel.matches(':hover') && !floatingBtn.matches(':hover')) {
                        phonePanel.classList.remove('show');
                    }
                }, 300);
            }
        });
        
        phonePanel.addEventListener('mouseleave', (e) => {
            if (!floatingBtn.contains(e.relatedTarget)) {
                hoverTimeout = setTimeout(() => {
                    if (!phonePanel.matches(':hover') && !floatingBtn.matches(':hover')) {
                        phonePanel.classList.remove('show');
                    }
                }, 300);
            }
        });
        
        // Click to call functionality
        contactBtn.addEventListener('click', (e) => {
            e.preventDefault();
            
            // If panel is visible, keep it open, otherwise show it
            if (!phonePanel.classList.contains('show')) {
                phonePanel.classList.add('show');
            }
            
            // Optional: scroll to contact section if exists
            const contactSection = document.querySelector('.contact-form-section');
            if (contactSection) {
                const elementTop = contactSection.offsetTop;
                const offset = 80; // Adjust this value to show more content above
                window.scrollTo({
                    top: elementTop - offset,
                    behavior: 'smooth'
                });
            }
        });
        
        // Contact button remains visible at all times
        // Removed intersection observer to keep button always visible
    }

    // Make scrollToContact function globally accessible
    window.scrollToContact = function() {
        const contactSection = document.querySelector('.contact-form-section');
        if (contactSection) {
            const elementTop = contactSection.offsetTop;
            const offset = 80; // Adjust this value to show more content above
            window.scrollTo({
                top: elementTop - offset,
                behavior: 'smooth'
            });
        }
    };



})();