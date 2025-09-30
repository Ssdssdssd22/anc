<?php require "includes/header.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Ananda National College - Premier educational institution in Chilaw, Sri Lanka. Empowering minds, inspiring futures, and building tomorrow's leaders.">
    <meta name="keywords" content="Ananda National College, Chilaw, Sri Lanka, education, school, Buddhist education, academic excellence">
    <meta name="author" content="Ananda National College">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Ananda National College - Empowering Future Leaders">
    <meta property="og:description" content="Premier educational institution in Chilaw, Sri Lanka. Join us in our mission to empower minds and inspire futures.">
    <meta property="og:image" content="<?php echo htmlspecialchars($config['branding']['logo_primary']); ?>">
    <meta property="og:url" content="<?php echo htmlspecialchars($config['app']['base_url']); ?>">
    <meta property="og:type" content="website">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Ananda National College - Empowering Future Leaders">
    <meta name="twitter:description" content="Premier educational institution in Chilaw, Sri Lanka.">
    <meta name="twitter:image" content="<?php echo htmlspecialchars($config['branding']['logo_primary']); ?>">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="<?php echo htmlspecialchars($config['app']['base_url']); ?>">
    
    <!-- Preconnect to external domains -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Critical CSS -->
    <link rel="stylesheet" href="css/modern-theme.css">
    <link rel="stylesheet" href="css/enhanced-responsive.css">
    <link rel="stylesheet" href="css/seo-optimized.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <title><?php echo htmlspecialchars($config['app']['name']); ?> - Empowering Future Leaders</title>
    
    <!-- Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "EducationalOrganization",
        "name": "<?php echo htmlspecialchars($config['app']['name']); ?>",
        "url": "<?php echo htmlspecialchars($config['app']['base_url']); ?>",
        "logo": "<?php echo htmlspecialchars($config['branding']['logo_primary']); ?>",
        "description": "Premier educational institution in Chilaw, Sri Lanka, committed to academic excellence and character development.",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "<?php echo htmlspecialchars($config['contact']['address']['line1']); ?>",
            "addressLocality": "Chilaw",
            "addressCountry": "Sri Lanka"
        },
        "telephone": "<?php echo htmlspecialchars($config['contact']['phone_numbers'][0]); ?>",
        "email": "<?php echo htmlspecialchars($config['contact']['emails'][0]); ?>",
        "foundingDate": "1950-05-12",
        "sameAs": [
            "https://www.facebook.com/anandacollegechilawofficial"
        ]
    }
    </script>
</head>

<body class="modern-layout">
    <!-- Skip Link for Accessibility -->
    <a href="#main-content" class="skip-link">Skip to main content</a>
    
    <!-- Modern Navigation -->
    <nav class="navbar-modern fixed-top" role="navigation" aria-label="Main navigation">
        <div class="container-modern">
            <div class="nav-container">
                <div class="nav-brand">
                    <a href="<?php echo APPURL ?>" aria-label="Ananda National College Home">
                        <img src="<?php echo htmlspecialchars($config['branding']['logo_primary']); ?>" 
                             alt="<?php echo htmlspecialchars($config['app']['name']); ?> Logo" 
                             width="120" height="60" class="logo-img">
                    </a>
                </div>
                
                <div class="desktop-nav">
                    <ul class="nav-menu" role="menubar">
                        <li role="none"><a href="<?php echo APPURL ?>" class="nav-link-modern active" role="menuitem">Home</a></li>
                        <li role="none"><a href="#about" class="nav-link-modern" role="menuitem">About</a></li>
                        <li role="none"><a href="#academics" class="nav-link-modern" role="menuitem">Academics</a></li>
                        <li role="none"><a href="#clubs" class="nav-link-modern" role="menuitem">Clubs</a></li>
                        <li role="none"><a href="events.php" class="nav-link-modern" role="menuitem">Events</a></li>
                        <li role="none"><a href="contact.php" class="nav-link-modern" role="menuitem">Contact</a></li>
                    </ul>
                </div>
                
                <button class="mobile-nav-toggle" aria-label="Toggle mobile navigation" aria-expanded="false">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </nav>

    <!-- Mobile Navigation -->
    <div class="mobile-nav" role="navigation" aria-label="Mobile navigation">
        <a href="<?php echo APPURL ?>" class="mobile-nav-item">Home</a>
        <a href="#about" class="mobile-nav-item">About</a>
        <a href="#academics" class="mobile-nav-item">Academics</a>
        <a href="#clubs" class="mobile-nav-item">Clubs</a>
        <a href="events.php" class="mobile-nav-item">Events</a>
        <a href="contact.php" class="mobile-nav-item">Contact</a>
    </div>

    <!-- Main Content -->
    <main id="main-content">
        <!-- Hero Section -->
        <section class="hero-section" role="banner">
            <div class="floating-elements" aria-hidden="true">
                <div class="floating-shape"></div>
                <div class="floating-shape"></div>
                <div class="floating-shape"></div>
            </div>
            
            <div class="container-modern">
                <div class="hero-content animate-on-scroll">
                    <h1 class="hero-title">
                        Welcome to<br>
                        <span class="text-gradient"><?php echo htmlspecialchars($config['app']['name']); ?></span>
                    </h1>
                    <p class="hero-subtitle">
                        <?php echo htmlspecialchars($config['app']['tagline']); ?> - 
                        Nurturing excellence since 1950
                    </p>
                    <div class="hero-actions">
                        <a href="#about" class="btn-3d btn-secondary-3d">
                            <i class="fas fa-graduation-cap mr-2"></i>
                            Discover Our Story
                        </a>
                        <a href="admission.php" class="btn-3d btn-accent-3d ml-3">
                            <i class="fas fa-user-plus mr-2"></i>
                            Apply Now
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="stats-section section" aria-labelledby="stats-heading">
            <div class="stats-bg" aria-hidden="true"></div>
            <div class="container-modern">
                <div class="section-header">
                    <h2 id="stats-heading" class="section-title text-white">Our Achievements</h2>
                    <p class="section-subtitle text-white opacity-75">
                        Numbers that reflect our commitment to excellence
                    </p>
                </div>
                
                <div class="grid-responsive grid-4">
                    <div class="stat-card animate-on-scroll">
                        <span class="stat-number" data-target="200">0</span>
                        <span class="stat-label">Expert Teachers</span>
                    </div>
                    <div class="stat-card animate-on-scroll">
                        <span class="stat-number" data-target="3500">0</span>
                        <span class="stat-label">Active Students</span>
                    </div>
                    <div class="stat-card animate-on-scroll">
                        <span class="stat-number" data-target="56">0</span>
                        <span class="stat-label">Classes</span>
                    </div>
                    <div class="stat-card animate-on-scroll">
                        <span class="stat-number" data-target="15">0</span>
                        <span class="stat-label">Active Clubs</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="about-section section" aria-labelledby="about-heading">
            <div class="container-modern">
                <div class="about-content">
                    <div class="about-text animate-on-scroll">
                        <h2 id="about-heading" class="section-title">About Our Institution</h2>
                        <p class="lead">
                            Established in 1950, <?php echo htmlspecialchars($config['app']['name']); ?> has been 
                            a beacon of educational excellence in Sri Lanka for over seven decades.
                        </p>
                        <p>
                            Our institution is committed to fostering a dynamic learning environment where 
                            students thrive academically, creatively, and socially. With a focus on holistic 
                            education, we nurture critical thinking, innovation, and character development.
                        </p>
                        <div class="about-features">
                            <div class="feature-item">
                                <i class="fas fa-award text-gradient"></i>
                                <span>Academic Excellence</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-users text-gradient"></i>
                                <span>Character Development</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-lightbulb text-gradient"></i>
                                <span>Innovation Focus</span>
                            </div>
                        </div>
                        <a href="#academics" class="btn-3d btn-primary-3d mt-4">
                            Learn More About Us
                        </a>
                    </div>
                    
                    <div class="about-image animate-on-scroll">
                        <img src="anc/FB_IMG_1603758503120.jpg" 
                             alt="<?php echo htmlspecialchars($config['app']['name']); ?> campus view"
                             class="img-responsive"
                             loading="lazy">
                    </div>
                </div>
            </div>
        </section>

        <!-- Clubs Section -->
        <section id="clubs" class="section" aria-labelledby="clubs-heading">
            <div class="container-modern">
                <div class="section-header">
                    <h2 id="clubs-heading" class="section-title">Our Vibrant Clubs</h2>
                    <p class="section-subtitle">
                        Discover opportunities to explore your passions and develop new skills
                    </p>
                </div>
                
                <div class="club-grid">
                    <article class="club-card card-3d animate-on-scroll">
                        <div class="club-image">
                            <img src="https://images.pexels.com/photos/1181298/pexels-photo-1181298.jpeg" 
                                 alt="IT Society activities" 
                                 loading="lazy">
                            <div class="club-overlay">
                                <div class="overlay-content">
                                    <h3>Explore Technology</h3>
                                    <p>Join our coding workshops and tech projects</p>
                                </div>
                            </div>
                        </div>
                        <div class="club-content">
                            <h3 class="club-title">IT Society</h3>
                            <p class="club-description">
                                Tech enthusiasts collaborating, learning, and innovating together 
                                in our dynamic IT Society community.
                            </p>
                        </div>
                    </article>

                    <article class="club-card card-3d animate-on-scroll">
                        <div class="club-image">
                            <img src="https://images.pexels.com/photos/1181677/pexels-photo-1181677.jpeg" 
                                 alt="Media Club activities" 
                                 loading="lazy">
                            <div class="club-overlay">
                                <div class="overlay-content">
                                    <h3>Create & Share</h3>
                                    <p>Express your creativity through multimedia</p>
                                </div>
                            </div>
                        </div>
                        <div class="club-content">
                            <h3 class="club-title">Media Club</h3>
                            <p class="club-description">
                                Amplifying creativity through multimedia, film, and storytelling 
                                in a supportive creative community.
                            </p>
                        </div>
                    </article>

                    <article class="club-card card-3d animate-on-scroll">
                        <div class="club-image">
                            <img src="https://images.pexels.com/photos/1752757/pexels-photo-1752757.jpeg" 
                                 alt="Sports Club activities" 
                                 loading="lazy">
                            <div class="club-overlay">
                                <div class="overlay-content">
                                    <h3>Stay Active</h3>
                                    <p>Build teamwork and leadership through sports</p>
                                </div>
                            </div>
                        </div>
                        <div class="club-content">
                            <h3 class="club-title">Sports Club</h3>
                            <p class="club-description">
                                Promoting physical fitness, teamwork, and competitive spirit 
                                through various sporting activities.
                            </p>
                        </div>
                    </article>

                    <article class="club-card card-3d animate-on-scroll">
                        <div class="club-image">
                            <img src="https://images.pexels.com/photos/2280571/pexels-photo-2280571.jpeg" 
                                 alt="Science Club activities" 
                                 loading="lazy">
                            <div class="club-overlay">
                                <div class="overlay-content">
                                    <h3>Discover Science</h3>
                                    <p>Explore the wonders of scientific discovery</p>
                                </div>
                            </div>
                        </div>
                        <div class="club-content">
                            <h3 class="club-title">Science Club</h3>
                            <p class="club-description">
                                Exploring, experimenting, and discovering the wonders 
                                of our natural world through hands-on learning.
                            </p>
                        </div>
                    </article>
                </div>
                
                <div class="text-center mt-5">
                    <a href="#" class="btn-3d btn-primary-3d">
                        <i class="fas fa-eye mr-2"></i>
                        View All Clubs
                    </a>
                </div>
            </div>
        </section>

        <!-- Why Choose Us Section -->
        <section class="section bg-light" aria-labelledby="why-choose-heading">
            <div class="container-modern">
                <div class="section-header">
                    <h2 id="why-choose-heading" class="section-title">Why Choose <?php echo htmlspecialchars($config['app']['name']); ?>?</h2>
                    <p class="section-subtitle">
                        Discover what makes our educational approach unique and effective
                    </p>
                </div>
                
                <div class="grid-responsive grid-3">
                    <div class="feature-card card-3d animate-on-scroll">
                        <div class="feature-icon">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <h3 class="feature-title">Rapid Development</h3>
                        <p class="feature-description">
                            Modern teaching methodologies and innovative tools enable us to deliver 
                            quality education that prepares students for the future.
                        </p>
                    </div>
                    
                    <div class="feature-card card-3d animate-on-scroll">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="feature-title">Expert Team</h3>
                        <p class="feature-description">
                            Our experienced educators and staff bring years of expertise across 
                            multiple subjects and educational approaches.
                        </p>
                    </div>
                    
                    <div class="feature-card card-3d animate-on-scroll">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 class="feature-title">Quality Assurance</h3>
                        <p class="feature-description">
                            Rigorous academic standards and continuous improvement processes 
                            ensure your education meets the highest quality benchmarks.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="section" aria-labelledby="contact-heading">
            <div class="container-modern">
                <div class="section-header">
                    <h2 id="contact-heading" class="section-title">Get In Touch</h2>
                    <p class="section-subtitle">
                        Ready to join our community? We'd love to hear from you
                    </p>
                </div>
                
                <div class="contact-grid">
                    <div class="contact-info animate-on-scroll">
                        <div class="contact-card card-3d">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <h3>Visit Us</h3>
                            <p><?php echo htmlspecialchars($config['contact']['address']['line1']); ?><br>
                               <?php echo htmlspecialchars($config['contact']['address']['line2']); ?></p>
                        </div>
                        
                        <div class="contact-card card-3d">
                            <div class="contact-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <h3>Call Us</h3>
                            <p><?php echo htmlspecialchars($config['contact']['phone_numbers'][0]); ?><br>
                               <?php echo htmlspecialchars($config['contact']['phone_numbers'][1]); ?></p>
                        </div>
                        
                        <div class="contact-card card-3d">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <h3>Email Us</h3>
                            <p><?php echo htmlspecialchars($config['contact']['emails'][0]); ?><br>
                               <?php echo htmlspecialchars($config['contact']['emails'][1]); ?></p>
                        </div>
                    </div>
                    
                    <div class="contact-form-container animate-on-scroll">
                        <form class="contact-form-modern" method="post" action="mail.php" novalidate>
                            <h3 class="form-title">Send us a Message</h3>
                            
                            <div class="form-row">
                                <div class="form-group-modern">
                                    <input type="text" id="name" name="name" class="form-control-modern" 
                                           placeholder=" " required aria-describedby="name-error">
                                    <label for="name" class="form-label-modern">Full Name *</label>
                                </div>
                                
                                <div class="form-group-modern">
                                    <input type="email" id="email" name="mail" class="form-control-modern" 
                                           placeholder=" " required aria-describedby="email-error">
                                    <label for="email" class="form-label-modern">Email Address *</label>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group-modern">
                                    <input type="tel" id="phone" name="phone" class="form-control-modern" 
                                           placeholder=" " aria-describedby="phone-error">
                                    <label for="phone" class="form-label-modern">Phone Number</label>
                                </div>
                                
                                <div class="form-group-modern">
                                    <select id="subject" name="subject" class="form-control-modern" required>
                                        <option value="">Select Subject</option>
                                        <option value="admission">Admission Inquiry</option>
                                        <option value="academic">Academic Information</option>
                                        <option value="events">Events & Activities</option>
                                        <option value="general">General Inquiry</option>
                                    </select>
                                    <label for="subject" class="form-label-modern">Subject *</label>
                                </div>
                            </div>
                            
                            <div class="form-group-modern">
                                <textarea id="message" name="message" class="form-control-modern" 
                                          rows="5" placeholder=" " required aria-describedby="message-error"></textarea>
                                <label for="message" class="form-label-modern">Your Message *</label>
                            </div>
                            
                            <button type="submit" class="btn-3d btn-primary-3d w-100">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta-section" aria-labelledby="cta-heading">
            <div class="container-modern">
                <div class="cta-content">
                    <h2 id="cta-heading" class="cta-title">Ready to Join Our Community?</h2>
                    <p class="cta-subtitle">
                        Take the first step towards an exceptional educational journey
                    </p>
                    <a href="admission.php" class="btn-3d btn-secondary-3d btn-lg">
                        <i class="fas fa-graduation-cap mr-2"></i>
                        Start Your Application
                    </a>
                </div>
            </div>
        </section>
    </main>

    <!-- Breadcrumb Container -->
    <div class="breadcrumb-container"></div>

    <!-- Scripts -->
    <script src="js/modern-interactions.js"></script>
    
    <!-- Schema.org Structured Data (Hidden) -->
    <div class="schema-organization" itemscope itemtype="https://schema.org/EducationalOrganization">
        <span itemprop="name"><?php echo htmlspecialchars($config['app']['name']); ?></span>
        <span itemprop="url"><?php echo htmlspecialchars($config['app']['base_url']); ?></span>
        <div itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
            <span itemprop="streetAddress"><?php echo htmlspecialchars($config['contact']['address']['line1']); ?></span>
            <span itemprop="addressLocality">Chilaw</span>
            <span itemprop="addressCountry">Sri Lanka</span>
        </div>
        <span itemprop="telephone"><?php echo htmlspecialchars($config['contact']['phone_numbers'][0]); ?></span>
        <span itemprop="email"><?php echo htmlspecialchars($config['contact']['emails'][0]); ?></span>
    </div>

    <style>
        /* Additional Inline Styles for Enhanced 3D Effects */
        .feature-card {
            background: var(--white);
            padding: 2rem;
            border-radius: var(--border-radius);
            text-align: center;
            transition: var(--transition);
            transform-style: preserve-3d;
            box-shadow: var(--shadow-light);
        }

        .feature-card:hover {
            transform: translateY(-10px) rotateX(5deg);
            box-shadow: var(--shadow-heavy);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            background: var(--gradient-accent);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: var(--white);
            box-shadow: var(--shadow-medium);
        }

        .feature-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .feature-description {
            color: var(--text-light);
            line-height: 1.6;
        }

        .about-features {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin: 2rem 0;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: rgba(56, 200, 168, 0.1);
            border-radius: var(--border-radius);
            transition: var(--transition);
        }

        .feature-item:hover {
            background: rgba(56, 200, 168, 0.15);
            transform: translateX(10px);
        }

        .feature-item i {
            font-size: 1.5rem;
            width: 40px;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: start;
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .contact-card {
            padding: 2rem;
            text-align: center;
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-light);
            transition: var(--transition);
        }

        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-medium);
        }

        .contact-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 1rem;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 1.5rem;
        }

        .contact-card h3 {
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .form-title {
            text-align: center;
            color: var(--primary-color);
            margin-bottom: 2rem;
            font-size: 2rem;
            font-weight: 700;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 1rem;
        }

        /* Mobile Responsive Adjustments */
        @media (max-width: 768px) {
            .contact-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            
            .form-row {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .about-features {
                gap: 0.5rem;
            }
            
            .feature-item {
                padding: 0.75rem;
            }
        }

        /* Navigation Styles */
        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
            gap: 2rem;
        }

        .logo-img {
            max-height: 60px;
            width: auto;
        }

        @media (max-width: 768px) {
            .desktop-nav {
                display: none;
            }
        }

        @media (min-width: 769px) {
            .mobile-nav-toggle {
                display: none;
            }
        }
    </style>

<?php require "includes/footer.php"; ?>