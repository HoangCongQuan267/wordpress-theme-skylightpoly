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
    });

    /**
     * Mobile Menu Toggle Functionality
     */
    function initMobileMenu() {
        const menuToggle = document.querySelector('.menu-toggle');
        const navigation = document.querySelector('.main-navigation');
        
        if (menuToggle && navigation) {
            menuToggle.addEventListener('click', function() {
                const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
                
                menuToggle.setAttribute('aria-expanded', !isExpanded);
                navigation.classList.toggle('active');
                
                // Add animation class
                navigation.style.transition = 'all 0.3s ease';
                
                if (window.innerWidth <= 768) {
                    if (!isExpanded) {
                        navigation.style.display = 'flex';
                        navigation.style.flexDirection = 'column';
                        setTimeout(() => {
                            navigation.style.opacity = '1';
                            navigation.style.transform = 'translateY(0)';
                        }, 10);
                    } else {
                        navigation.style.opacity = '0';
                        navigation.style.transform = 'translateY(-10px)';
                        setTimeout(() => {
                            navigation.style.display = 'none';
                        }, 300);
                    }
                }
            });
            
            // Close menu when clicking outside
            document.addEventListener('click', function(event) {
                if (!menuToggle.contains(event.target) && !navigation.contains(event.target)) {
                    menuToggle.setAttribute('aria-expanded', 'false');
                    navigation.classList.remove('active');
                    if (window.innerWidth <= 768) {
                        navigation.style.display = 'none';
                    }
                }
            });
            
            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    navigation.style.display = 'flex';
                    navigation.style.flexDirection = 'row';
                    navigation.style.opacity = '1';
                    navigation.style.transform = 'translateY(0)';
                    menuToggle.setAttribute('aria-expanded', 'false');
                    navigation.classList.remove('active');
                }
            });
        }
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
        backToTopBtn.style.cssText = `
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background-color: var(--primary-orange);
            color: white;
            border: none;
            border-radius: 50%;
            font-size: 20px;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        `;
        
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
            this.style.transform = 'scale(1.1)';
        });
        
        backToTopBtn.addEventListener('mouseleave', function() {
            this.style.backgroundColor = 'var(--primary-orange)';
            this.style.transform = 'scale(1)';
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

})();