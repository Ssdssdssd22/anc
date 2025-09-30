// Contact Page Interactive JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Initialize all interactive features
    initializeParallax();
    initializeFormValidation();
    initializeAnimations();
    initializeMapInteractions();
    initialize3DEffects();
});

// Parallax scrolling effect for hero section
function initializeParallax() {
    const heroSection = document.querySelector('.contact-hero');
    const shapes = document.querySelectorAll('.shape');

    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const rate = scrolled * -0.5;

        if (heroSection) {
            heroSection.style.transform = `translateY(${scrolled * 0.3}px)`;
        }

        // Animate floating shapes at different speeds
        shapes.forEach((shape, index) => {
            const speed = 0.2 + (index * 0.1);
            shape.style.transform = `translateY(${scrolled * speed}px) rotate(${scrolled * 0.05}deg)`;
        });
    });
}

// Enhanced form validation with real-time feedback
function initializeFormValidation() {
    const form = document.getElementById('contactForm');
    const inputs = form.querySelectorAll('input, select, textarea');
    const submitBtn = document.querySelector('.submit-btn');
    const successMessage = document.getElementById('successMessage');

    // Real-time validation
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            validateField(this);
            updateSubmitButton();
        });

        input.addEventListener('blur', function() {
            validateField(this);
            animateField(this);
        });

        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
    });

    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // Final validation
        let isValid = true;
        inputs.forEach(input => {
            if (!validateField(input)) {
                isValid = false;
            }
        });

        if (isValid) {
            submitForm(this, successMessage);
        } else {
            showFormErrors();
        }
    });
}

// Field validation function
function validateField(field) {
    const value = field.value.trim();
    const fieldType = field.type;
    const fieldName = field.name;
    let isValid = true;
    let message = '';

    // Required field validation
    if (field.hasAttribute('required') && !value) {
        isValid = false;
        message = `${getFieldLabel(fieldName)} is required`;
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

    // Display validation message
    showFieldValidation(field, isValid, message);

    return isValid;
}

// Get field label for error messages
function getFieldLabel(fieldName) {
    const labels = {
        'name': 'Full Name',
        'mail': 'Email Address',
        'phone': 'Phone Number',
        'subject': 'Subject',
        'message': 'Message'
    };
    return labels[fieldName] || fieldName;
}

// Show field validation message
function showFieldValidation(field, isValid, message) {
    // Remove existing error/success classes
    field.parentElement.classList.remove('error', 'success');

    if (field.value.trim()) {
        if (isValid) {
            field.parentElement.classList.add('success');
        } else {
            field.parentElement.classList.add('error');
            showFieldError(field, message);
        }
    }
}

// Show field error message
function showFieldError(field, message) {
    let errorElement = field.parentElement.querySelector('.field-error');
    if (!errorElement) {
        errorElement = document.createElement('div');
        errorElement.className = 'field-error';
        field.parentElement.appendChild(errorElement);
    }

    errorElement.textContent = message;
    errorElement.style.color = '#ff6b6b';
    errorElement.style.fontSize = '0.85rem';
    errorElement.style.marginTop = '0.5rem';
    errorElement.style.opacity = '0';
    errorElement.style.transform = 'translateY(-10px)';
    errorElement.style.transition = 'all 0.3s ease';

    // Animate error appearance
    setTimeout(() => {
        errorElement.style.opacity = '1';
        errorElement.style.transform = 'translateY(0)';
    }, 10);
}

// Animate field on focus
function animateField(field) {
    const inputContainer = field.parentElement;
    inputContainer.style.transform = 'scale(1.02)';
    setTimeout(() => {
        inputContainer.style.transform = 'scale(1)';
    }, 200);
}

// Update submit button state
function updateSubmitButton() {
    const form = document.getElementById('contactForm');
    const inputs = form.querySelectorAll('input[required], select[required], textarea[required]');
    const submitBtn = document.querySelector('.submit-btn');

    let allValid = true;
    inputs.forEach(input => {
        if (!input.value.trim()) {
            allValid = false;
        }
    });

    if (allValid) {
        submitBtn.disabled = false;
        submitBtn.style.opacity = '1';
        submitBtn.style.cursor = 'pointer';
    } else {
        submitBtn.disabled = true;
        submitBtn.style.opacity = '0.7';
        submitBtn.style.cursor = 'not-allowed';
    }
}

// Submit form with animation
function submitForm(form, successMessage) {
    const submitBtn = document.querySelector('.submit-btn');
    const btnText = submitBtn.querySelector('.btn-text');
    const btnRipple = submitBtn.querySelector('.btn-ripple');

    // Animate button
    submitBtn.style.transform = 'scale(0.95)';
    btnText.textContent = 'Sending...';

    // Create ripple effect
    btnRipple.style.width = '300px';
    btnRipple.style.height = '300px';

    // Simulate form submission (replace with actual AJAX call)
    setTimeout(() => {
        // Show success message
        successMessage.classList.add('show');

        // Reset form
        form.reset();

        // Reset button
        submitBtn.style.transform = 'scale(1)';
        btnText.textContent = 'Send Message';
        btnRipple.style.width = '0';
        btnRipple.style.height = '0';

        // Reset field states
        const inputs = form.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.parentElement.classList.remove('focused', 'success', 'error');
        });

        // Hide success message after 5 seconds
        setTimeout(() => {
            successMessage.classList.remove('show');
        }, 5000);

    }, 2000);
}

// Show form errors
function showFormErrors() {
    // Add shake animation to form
    const form = document.querySelector('.contact-form');
    form.style.animation = 'shake 0.5s ease-in-out';

    setTimeout(() => {
        form.style.animation = '';
    }, 500);
}

// Initialize scroll animations
function initializeAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);

    // Observe elements for animation
    const animateElements = document.querySelectorAll('.contact-card, .contact-form, .map-container');
    animateElements.forEach(el => {
        observer.observe(el);
    });

    // Add CSS for animations
    const style = document.createElement('style');
    style.textContent = `
        .animate-in {
            animation: slideInFade 0.8s ease-out forwards;
        }

        @keyframes slideInFade {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .field-error {
            opacity: 1;
            transform: translateY(0);
        }
    `;
    document.head.appendChild(style);
}

// Initialize map interactions
function initializeMapInteractions() {
    const getDirectionsBtn = document.querySelector('.get-directions-btn');

    if (getDirectionsBtn) {
        getDirectionsBtn.addEventListener('click', function() {
            const address = 'Ananda National College, Colombo Road, Chilaw, Sri Lanka';
            const googleMapsUrl = `https://www.google.com/maps/dir/?api=1&destination=${encodeURIComponent(address)}`;
            window.open(googleMapsUrl, '_blank');
        });
    }

    // Add hover effects to map
    const mapContainer = document.querySelector('.map-container');
    if (mapContainer) {
        mapContainer.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.02)';
            this.style.transition = 'transform 0.3s ease';
        });

        mapContainer.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    }
}

// Initialize 3D effects
function initialize3DEffects() {
    // Add mouse tracking for 3D card effects
    const cards = document.querySelectorAll('.contact-card');

    cards.forEach(card => {
        card.addEventListener('mousemove', function(e) {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            const centerX = rect.width / 2;
            const centerY = rect.height / 2;

            const rotateX = (y - centerY) / 10;
            const rotateY = (centerX - x) / 10;

            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateZ(20px)`;
        });

        card.addEventListener('mouseleave', function() {
            card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) translateZ(0px)';
        });
    });

    // Add floating animation to background elements
    const bgElements = document.querySelectorAll('.bg-element');
    bgElements.forEach((element, index) => {
        element.style.animationDelay = `${index * 2}s`;
    });

    // Add typing effect to hero title
    const titleWords = document.querySelectorAll('.title-word');
    titleWords.forEach((word, index) => {
        setTimeout(() => {
            word.style.animation = 'bounceIn 0.8s ease-out forwards';
        }, index * 200);
    });

    // Add CSS for bounceIn animation
    const bounceStyle = document.createElement('style');
    bounceStyle.textContent = `
        @keyframes bounceIn {
            0% {
                opacity: 0;
                transform: translateY(50px) scale(0.3);
            }
            50% {
                opacity: 1;
                transform: translateY(-10px) scale(1.05);
            }
            70% {
                transform: translateY(2px) scale(0.98);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
    `;
    document.head.appendChild(bounceStyle);
}

// Smooth scroll for navigation
document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelectorAll('a[href^="#"]');

    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();

            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);

            if (targetSection) {
                targetSection.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});

// Performance optimization: Throttle scroll events
function throttle(func, limit) {
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

// Apply throttling to scroll events
const throttledParallax = throttle(initializeParallax, 16);
window.addEventListener('scroll', throttledParallax);
