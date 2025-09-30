// Modern Interactive Components for School Website

class ModernSchoolWebsite {
    constructor() {
        this.init();
    }

    init() {
        this.setupScrollAnimations();
        this.setupMobileNavigation();
        this.setupLazyLoading();
        this.setupFormEnhancements();
        this.setupPerformanceOptimizations();
        this.setupSEOEnhancements();
        this.setup3DEffects();
        this.setupAccessibility();
    }

    // Scroll Animations
    setupScrollAnimations() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                    
                    // Animate counters
                    if (entry.target.classList.contains('stat-number')) {
                        this.animateCounter(entry.target);
                    }
                }
            });
        }, observerOptions);

        // Observe elements for animation
        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            observer.observe(el);
        });

        // Parallax scrolling
        window.addEventListener('scroll', this.throttle(() => {
            this.handleParallax();
        }, 16));
    }

    // Counter Animation
    animateCounter(element) {
        const target = parseInt(element.textContent);
        const duration = 2000;
        const step = target / (duration / 16);
        let current = 0;

        const timer = setInterval(() => {
            current += step;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            element.textContent = Math.floor(current) + '+';
        }, 16);
    }

    // Parallax Effect
    handleParallax() {
        const scrolled = window.pageYOffset;
        const parallaxElements = document.querySelectorAll('.parallax-element');
        
        parallaxElements.forEach(element => {
            const speed = element.dataset.speed || 0.5;
            const yPos = -(scrolled * speed);
            element.style.transform = `translateY(${yPos}px)`;
        });
    }

    // Mobile Navigation
    setupMobileNavigation() {
        const mobileToggle = document.querySelector('.mobile-nav-toggle');
        const mobileNav = document.querySelector('.mobile-nav');
        
        if (mobileToggle && mobileNav) {
            mobileToggle.addEventListener('click', () => {
                mobileToggle.classList.toggle('active');
                mobileNav.classList.toggle('active');
                document.body.classList.toggle('nav-open');
            });

            // Close on link click
            document.querySelectorAll('.mobile-nav-item').forEach(link => {
                link.addEventListener('click', () => {
                    mobileToggle.classList.remove('active');
                    mobileNav.classList.remove('active');
                    document.body.classList.remove('nav-open');
                });
            });
        }
    }

    // Lazy Loading
    setupLazyLoading() {
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy-load');
                        img.classList.add('loaded');
                        imageObserver.unobserve(img);
                    }
                });
            });

            document.querySelectorAll('img[data-src]').forEach(img => {
                imageObserver.observe(img);
            });
        }
    }

    // Form Enhancements
    setupFormEnhancements() {
        // Real-time validation
        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            const inputs = form.querySelectorAll('input, textarea, select');
            
            inputs.forEach(input => {
                input.addEventListener('blur', () => {
                    this.validateField(input);
                });

                input.addEventListener('input', () => {
                    this.clearFieldError(input);
                });
            });

            form.addEventListener('submit', (e) => {
                if (!this.validateForm(form)) {
                    e.preventDefault();
                }
            });
        });
    }

    validateField(field) {
        const value = field.value.trim();
        const fieldType = field.type;
        let isValid = true;
        let message = '';

        // Required validation
        if (field.hasAttribute('required') && !value) {
            isValid = false;
            message = 'This field is required';
        }

        // Email validation
        if (fieldType === 'email' && value) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(value)) {
                isValid = false;
                message = 'Please enter a valid email address';
            }
        }

        // Phone validation
        if (fieldType === 'tel' && value) {
            const phoneRegex = /^[\+]?[0-9\s\-\(\)]{10,}$/;
            if (!phoneRegex.test(value)) {
                isValid = false;
                message = 'Please enter a valid phone number';
            }
        }

        this.showFieldValidation(field, isValid, message);
        return isValid;
    }

    showFieldValidation(field, isValid, message) {
        const formGroup = field.closest('.form-group-modern');
        if (!formGroup) return;

        // Remove existing states
        formGroup.classList.remove('error', 'success');
        
        // Remove existing error message
        const existingError = formGroup.querySelector('.field-error');
        if (existingError) {
            existingError.remove();
        }

        if (field.value.trim()) {
            if (isValid) {
                formGroup.classList.add('success');
            } else {
                formGroup.classList.add('error');
                
                // Add error message
                const errorDiv = document.createElement('div');
                errorDiv.className = 'field-error';
                errorDiv.textContent = message;
                errorDiv.style.cssText = `
                    color: #dc3545;
                    font-size: 0.875rem;
                    margin-top: 0.5rem;
                    animation: slideInUp 0.3s ease-out;
                `;
                formGroup.appendChild(errorDiv);
            }
        }
    }

    clearFieldError(field) {
        const formGroup = field.closest('.form-group-modern');
        if (formGroup) {
            formGroup.classList.remove('error');
            const errorMsg = formGroup.querySelector('.field-error');
            if (errorMsg) {
                errorMsg.remove();
            }
        }
    }

    validateForm(form) {
        const inputs = form.querySelectorAll('input[required], textarea[required], select[required]');
        let isValid = true;

        inputs.forEach(input => {
            if (!this.validateField(input)) {
                isValid = false;
            }
        });

        return isValid;
    }

    // Performance Optimizations
    setupPerformanceOptimizations() {
        // Preload critical resources
        this.preloadCriticalResources();
        
        // Optimize images
        this.optimizeImages();
        
        // Setup service worker for caching
        this.setupServiceWorker();
    }

    preloadCriticalResources() {
        const criticalResources = [
            '/css/modern-theme.css',
            '/css/enhanced-responsive.css',
            '/js/modern-interactions.js'
        ];

        criticalResources.forEach(resource => {
            const link = document.createElement('link');
            link.rel = 'preload';
            link.href = resource;
            link.as = resource.endsWith('.css') ? 'style' : 'script';
            document.head.appendChild(link);
        });
    }

    optimizeImages() {
        // WebP support detection
        const supportsWebP = () => {
            const canvas = document.createElement('canvas');
            canvas.width = 1;
            canvas.height = 1;
            return canvas.toDataURL('image/webp').indexOf('data:image/webp') === 0;
        };

        if (supportsWebP()) {
            document.documentElement.classList.add('webp');
        } else {
            document.documentElement.classList.add('no-webp');
        }
    }

    setupServiceWorker() {
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/sw.js')
                .then(registration => {
                    console.log('SW registered: ', registration);
                })
                .catch(registrationError => {
                    console.log('SW registration failed: ', registrationError);
                });
        }
    }

    // SEO Enhancements
    setupSEOEnhancements() {
        // Dynamic meta tags
        this.updateMetaTags();
        
        // Structured data
        this.addStructuredData();
        
        // Breadcrumbs
        this.generateBreadcrumbs();
    }

    updateMetaTags() {
        const currentPage = window.location.pathname;
        const pageTitle = document.title;
        
        // Update Open Graph tags
        this.updateMetaTag('og:title', pageTitle);
        this.updateMetaTag('og:url', window.location.href);
        this.updateMetaTag('og:type', 'website');
        
        // Update Twitter Card tags
        this.updateMetaTag('twitter:title', pageTitle);
        this.updateMetaTag('twitter:url', window.location.href);
    }

    updateMetaTag(property, content) {
        let meta = document.querySelector(`meta[property="${property}"]`) || 
                  document.querySelector(`meta[name="${property}"]`);
        
        if (!meta) {
            meta = document.createElement('meta');
            meta.setAttribute(property.startsWith('og:') ? 'property' : 'name', property);
            document.head.appendChild(meta);
        }
        
        meta.setAttribute('content', content);
    }

    addStructuredData() {
        const schoolData = {
            "@context": "https://schema.org",
            "@type": "EducationalOrganization",
            "name": "Ananda National College",
            "url": window.location.origin,
            "logo": "https://i.ibb.co/8xZ8B7F/anc.png",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "Colombo Road",
                "addressLocality": "Chilaw",
                "addressCountry": "Sri Lanka"
            },
            "telephone": "+94 32 222 2345",
            "email": "info@anandacollege.edu.lk"
        };

        const script = document.createElement('script');
        script.type = 'application/ld+json';
        script.textContent = JSON.stringify(schoolData);
        document.head.appendChild(script);
    }

    generateBreadcrumbs() {
        const path = window.location.pathname;
        const segments = path.split('/').filter(segment => segment);
        
        if (segments.length > 0) {
            const breadcrumbContainer = document.querySelector('.breadcrumb-container');
            if (breadcrumbContainer) {
                const breadcrumbHTML = this.createBreadcrumbHTML(segments);
                breadcrumbContainer.innerHTML = breadcrumbHTML;
            }
        }
    }

    createBreadcrumbHTML(segments) {
        let html = '<nav class="breadcrumb-modern" aria-label="Breadcrumb"><ol>';
        html += '<li><a href="/">Home</a></li>';
        
        let currentPath = '';
        segments.forEach((segment, index) => {
            currentPath += '/' + segment;
            const isLast = index === segments.length - 1;
            const title = this.formatBreadcrumbTitle(segment);
            
            if (isLast) {
                html += `<li aria-current="page">${title}</li>`;
            } else {
                html += `<li><a href="${currentPath}">${title}</a></li>`;
            }
        });
        
        html += '</ol></nav>';
        return html;
    }

    formatBreadcrumbTitle(segment) {
        return segment.replace(/-/g, ' ')
                     .replace(/\b\w/g, l => l.toUpperCase());
    }

    // 3D Effects
    setup3DEffects() {
        // Mouse tracking for 3D cards
        document.querySelectorAll('.card-3d').forEach(card => {
            card.addEventListener('mousemove', (e) => {
                this.handle3DCardMovement(e, card);
            });

            card.addEventListener('mouseleave', () => {
                card.style.transform = '';
            });
        });

        // 3D button effects
        document.querySelectorAll('.btn-3d').forEach(btn => {
            btn.addEventListener('mouseenter', () => {
                btn.style.transform = 'translateY(-3px) rotateX(5deg)';
            });

            btn.addEventListener('mouseleave', () => {
                btn.style.transform = '';
            });
        });
    }

    handle3DCardMovement(e, card) {
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        
        const centerX = rect.width / 2;
        const centerY = rect.height / 2;
        
        const rotateX = (y - centerY) / 10;
        const rotateY = (centerX - x) / 10;
        
        card.style.transform = `
            perspective(1000px) 
            rotateX(${rotateX}deg) 
            rotateY(${rotateY}deg) 
            translateZ(20px)
        `;
    }

    // Accessibility
    setupAccessibility() {
        // Keyboard navigation
        this.setupKeyboardNavigation();
        
        // Focus management
        this.setupFocusManagement();
        
        // ARIA enhancements
        this.setupARIAEnhancements();
    }

    setupKeyboardNavigation() {
        document.addEventListener('keydown', (e) => {
            // Escape key closes mobile nav
            if (e.key === 'Escape') {
                const mobileNav = document.querySelector('.mobile-nav');
                const mobileToggle = document.querySelector('.mobile-nav-toggle');
                
                if (mobileNav && mobileNav.classList.contains('active')) {
                    mobileToggle.classList.remove('active');
                    mobileNav.classList.remove('active');
                    document.body.classList.remove('nav-open');
                }
            }
        });
    }

    setupFocusManagement() {
        // Skip link functionality
        const skipLink = document.querySelector('.skip-link');
        if (skipLink) {
            skipLink.addEventListener('click', (e) => {
                e.preventDefault();
                const target = document.querySelector(skipLink.getAttribute('href'));
                if (target) {
                    target.focus();
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        }

        // Focus visible polyfill
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Tab') {
                document.body.classList.add('using-keyboard');
            }
        });

        document.addEventListener('mousedown', () => {
            document.body.classList.remove('using-keyboard');
        });
    }

    setupARIAEnhancements() {
        // Dynamic ARIA labels
        document.querySelectorAll('[data-aria-label]').forEach(element => {
            element.setAttribute('aria-label', element.dataset.ariaLabel);
        });

        // ARIA live regions for dynamic content
        const liveRegion = document.createElement('div');
        liveRegion.setAttribute('aria-live', 'polite');
        liveRegion.setAttribute('aria-atomic', 'true');
        liveRegion.className = 'sr-only';
        liveRegion.id = 'live-region';
        document.body.appendChild(liveRegion);
    }

    // Utility Functions
    throttle(func, limit) {
        let inThrottle;
        return function() {
            const args = arguments;
            const context = this;
            if (!inThrottle) {
                func.apply(context, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        };
    }

    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Performance Monitoring
    measurePerformance() {
        if ('performance' in window) {
            window.addEventListener('load', () => {
                setTimeout(() => {
                    const perfData = performance.getEntriesByType('navigation')[0];
                    console.log('Page Load Time:', perfData.loadEventEnd - perfData.loadEventStart);
                    console.log('DOM Content Loaded:', perfData.domContentLoadedEventEnd - perfData.domContentLoadedEventStart);
                }, 0);
            });
        }
    }

    // Error Handling
    handleErrors() {
        window.addEventListener('error', (e) => {
            console.error('JavaScript Error:', e.error);
            // Send error to analytics if needed
        });

        window.addEventListener('unhandledrejection', (e) => {
            console.error('Unhandled Promise Rejection:', e.reason);
        });
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    new ModernSchoolWebsite();
});

// Progressive Enhancement
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js');
    });
}

// Web Vitals Monitoring
function measureWebVitals() {
    if ('web-vitals' in window) {
        // Measure Core Web Vitals
        getCLS(console.log);
        getFID(console.log);
        getLCP(console.log);
    }
}

// Smooth Scrolling Polyfill
if (!('scrollBehavior' in document.documentElement.style)) {
    const smoothScrollPolyfill = document.createElement('script');
    smoothScrollPolyfill.src = 'https://cdn.jsdelivr.net/gh/iamdustan/smoothscroll@master/src/smoothscroll.js';
    document.head.appendChild(smoothScrollPolyfill);
}

// Export for module usage
if (typeof module !== 'undefined' && module.exports) {
    module.exports = ModernSchoolWebsite;
}