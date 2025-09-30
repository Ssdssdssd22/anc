<?php require "includes/header.php"; ?>

<!-- Skip Link for Accessibility -->
<a href="#main-content" class="skip-link">Skip to main content</a>

<!-- Critical CSS Inline -->
<style>
/* Critical above-the-fold styles */
.modern-hero {
    min-height: 100vh;
    background: linear-gradient(135deg, #200769 0%, #341ca0 50%, #38c8a8 100%);
    display: flex;
    align-items: center;
    position: relative;
    overflow: hidden;
    color: white;
}

.hero-content-modern {
    position: relative;
    z-index: 2;
    text-align: center;
    padding: 2rem;
    max-width: 1200px;
    margin: 0 auto;
}

.hero-title-modern {
    font-size: clamp(2.5rem, 6vw, 5rem);
    font-weight: 800;
    margin-bottom: 1.5rem;
    line-height: 1.1;
    text-shadow: 0 4px 20px rgba(0,0,0,0.3);
}

.hero-subtitle-modern {
    font-size: clamp(1.1rem, 2.5vw, 1.5rem);
    margin-bottom: 2rem;
    opacity: 0.95;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.btn-modern {
    display: inline-flex;
    align-items: center;
    padding: 1rem 2rem;
    margin: 0.5rem;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    transform: translateZ(0);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.btn-primary-modern {
    background: linear-gradient(135deg, #f4b328 0%, #ff6b35 100%);
    color: white;
}

.btn-secondary-modern {
    background: linear-gradient(135deg, #38c8a8 0%, #20b2aa 100%);
    color: white;
}

.btn-modern:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
    text-decoration: none;
    color: white;
}

.floating-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 1;
}

.floating-shape {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    animation: float 6s ease-in-out infinite;
}

.shape-1 { width: 120px; height: 120px; top: 20%; left: 10%; animation-delay: 0s; }
.shape-2 { width: 80px; height: 80px; top: 60%; right: 15%; animation-delay: 2s; }
.shape-3 { width: 100px; height: 100px; bottom: 30%; left: 20%; animation-delay: 4s; }

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0.6; }
    50% { transform: translateY(-20px) rotate(180deg); opacity: 0.8; }
}

.section-modern {
    padding: 5rem 0;
    position: relative;
}

.container-modern {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

@media (max-width: 768px) {
    .section-modern { padding: 3rem 0; }
    .container-modern { padding: 0 1rem; }
    .btn-modern { padding: 0.8rem 1.5rem; margin: 0.25rem; }
}
</style>

<!-- Main Content -->
<main id="main-content">
    <!-- Modern Hero Section -->
    <section class="modern-hero" role="banner">
        <div class="floating-bg" aria-hidden="true">
            <div class="floating-shape shape-1"></div>
            <div class="floating-shape shape-2"></div>
            <div class="floating-shape shape-3"></div>
        </div>
        
        <div class="hero-content-modern">
            <h1 class="hero-title-modern">
                Welcome to<br>
                <span style="background: linear-gradient(45deg, #f4b328, #ff6b35); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                    <?php echo htmlspecialchars($config['app']['name']); ?>
                </span>
            </h1>
            <p class="hero-subtitle-modern">
                <?php echo htmlspecialchars($config['app']['tagline']); ?> - 
                Nurturing excellence in education since 1950, building tomorrow's leaders today.
            </p>
            <div class="hero-actions">
                <a href="#about" class="btn-modern btn-primary-modern">
                    <i class="fas fa-graduation-cap" style="margin-right: 0.5rem;"></i>
                    Discover Our Story
                </a>
                <a href="admission.php" class="btn-modern btn-secondary-modern">
                    <i class="fas fa-user-plus" style="margin-right: 0.5rem;"></i>
                    Apply Now
                </a>
            </div>
        </div>
    </section>

    <!-- Enhanced Stats Section -->
    <section class="section-modern" style="background: linear-gradient(135deg, #200769 0%, #341ca0 100%); color: white;">
        <div class="container-modern">
            <div style="text-align: center; margin-bottom: 4rem;">
                <h2 style="font-size: clamp(2.5rem, 4vw, 3.5rem); font-weight: 800; margin-bottom: 1rem;">
                    Our Achievements in Numbers
                </h2>
                <p style="font-size: 1.2rem; opacity: 0.9; max-width: 600px; margin: 0 auto;">
                    Decades of excellence reflected in our growing community
                </p>
            </div>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
                <div style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 12px; padding: 2rem; text-align: center; transition: all 0.3s ease; transform-style: preserve-3d;">
                    <div style="font-size: 3rem; font-weight: 800; color: #f4b328; margin-bottom: 0.5rem;">200+</div>
                    <div style="font-size: 1.1rem; text-transform: uppercase; letter-spacing: 1px;">Expert Teachers</div>
                </div>
                
                <div style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 12px; padding: 2rem; text-align: center; transition: all 0.3s ease; transform-style: preserve-3d;">
                    <div style="font-size: 3rem; font-weight: 800; color: #f4b328; margin-bottom: 0.5rem;">3500+</div>
                    <div style="font-size: 1.1rem; text-transform: uppercase; letter-spacing: 1px;">Active Students</div>
                </div>
                
                <div style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 12px; padding: 2rem; text-align: center; transition: all 0.3s ease; transform-style: preserve-3d;">
                    <div style="font-size: 3rem; font-weight: 800; color: #f4b328; margin-bottom: 0.5rem;">56+</div>
                    <div style="font-size: 1.1rem; text-transform: uppercase; letter-spacing: 1px;">Classes</div>
                </div>
                
                <div style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 12px; padding: 2rem; text-align: center; transition: all 0.3s ease; transform-style: preserve-3d;">
                    <div style="font-size: 3rem; font-weight: 800; color: #f4b328; margin-bottom: 0.5rem;">15+</div>
                    <div style="font-size: 1.1rem; text-transform: uppercase; letter-spacing: 1px;">Active Clubs</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced About Section -->
    <section id="about" class="section-modern" style="background: #f8f9fa;">
        <div class="container-modern">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center;">
                <div>
                    <h2 style="font-size: clamp(2rem, 4vw, 3rem); font-weight: 800; color: #200769; margin-bottom: 1.5rem;">
                        About Our <span style="color: #f4b328;">Institution</span>
                    </h2>
                    <p style="font-size: 1.2rem; color: #6c757d; margin-bottom: 1.5rem; line-height: 1.7;">
                        Established in 1950, <?php echo htmlspecialchars($config['app']['name']); ?> has been a beacon of educational excellence in Sri Lanka for over seven decades.
                    </p>
                    <p style="color: #6c757d; margin-bottom: 2rem; line-height: 1.7;">
                        Our institution is committed to fostering a dynamic learning environment where students thrive academically, creatively, and socially. With a focus on holistic education, we nurture critical thinking, innovation, and character development.
                    </p>
                    
                    <div style="display: flex; flex-direction: column; gap: 1rem; margin-bottom: 2rem;">
                        <div style="display: flex; align-items: center; gap: 1rem; padding: 1rem; background: rgba(56, 200, 168, 0.1); border-radius: 12px;">
                            <i class="fas fa-award" style="font-size: 1.5rem; color: #38c8a8; width: 40px;"></i>
                            <span style="font-weight: 600; color: #2c3e50;">Academic Excellence</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 1rem; padding: 1rem; background: rgba(244, 179, 40, 0.1); border-radius: 12px;">
                            <i class="fas fa-users" style="font-size: 1.5rem; color: #f4b328; width: 40px;"></i>
                            <span style="font-weight: 600; color: #2c3e50;">Character Development</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 1rem; padding: 1rem; background: rgba(32, 7, 105, 0.1); border-radius: 12px;">
                            <i class="fas fa-lightbulb" style="font-size: 1.5rem; color: #200769; width: 40px;"></i>
                            <span style="font-weight: 600; color: #2c3e50;">Innovation Focus</span>
                        </div>
                    </div>
                    
                    <a href="#clubs" class="btn-modern btn-primary-modern">
                        <i class="fas fa-arrow-right" style="margin-right: 0.5rem;"></i>
                        Learn More About Us
                    </a>
                </div>
                
                <div style="position: relative; border-radius: 12px; overflow: hidden; box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2); transform: perspective(1000px) rotateY(-5deg); transition: all 0.3s ease;">
                    <img src="anc/FB_IMG_1603758503120.jpg" 
                         alt="<?php echo htmlspecialchars($config['app']['name']); ?> campus view"
                         style="width: 100%; height: 400px; object-fit: cover;"
                         loading="lazy">
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced Clubs Section -->
    <section id="clubs" class="section-modern">
        <div class="container-modern">
            <div style="text-align: center; margin-bottom: 4rem;">
                <h2 style="font-size: clamp(2.5rem, 4vw, 3.5rem); font-weight: 800; color: #200769; margin-bottom: 1rem; position: relative;">
                    Our Vibrant Clubs
                    <span style="position: absolute; bottom: -10px; left: 50%; transform: translateX(-50%); width: 60px; height: 4px; background: linear-gradient(135deg, #f4b328 0%, #ff6b35 100%); border-radius: 2px;"></span>
                </h2>
                <p style="font-size: 1.2rem; color: #6c757d; max-width: 600px; margin: 0 auto;">
                    Discover opportunities to explore your passions and develop new skills
                </p>
            </div>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
                <!-- IT Society -->
                <article style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: all 0.3s ease; transform-style: preserve-3d; cursor: pointer;">
                    <div style="position: relative; height: 250px; overflow: hidden;">
                        <img src="https://images.pexels.com/photos/1181298/pexels-photo-1181298.jpeg" 
                             alt="IT Society activities" 
                             style="width: 100%; height: 100%; object-fit: cover; transition: all 0.3s ease;"
                             loading="lazy">
                        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(45deg, #200769, #38c8a8); opacity: 0; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; color: white;">
                            <div style="text-align: center;">
                                <h3 style="margin-bottom: 0.5rem;">Explore Technology</h3>
                                <p>Join our coding workshops and tech projects</p>
                            </div>
                        </div>
                    </div>
                    <div style="padding: 1.5rem;">
                        <h3 style="font-size: 1.5rem; font-weight: 700; color: #200769; margin-bottom: 0.5rem;">IT Society</h3>
                        <p style="color: #6c757d; font-size: 0.95rem; line-height: 1.6;">
                            Tech enthusiasts collaborating, learning, and innovating together in our dynamic IT Society community.
                        </p>
                    </div>
                </article>

                <!-- Media Club -->
                <article style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: all 0.3s ease; transform-style: preserve-3d; cursor: pointer;">
                    <div style="position: relative; height: 250px; overflow: hidden;">
                        <img src="https://images.pexels.com/photos/1181677/pexels-photo-1181677.jpeg" 
                             alt="Media Club activities" 
                             style="width: 100%; height: 100%; object-fit: cover; transition: all 0.3s ease;"
                             loading="lazy">
                        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(45deg, #200769, #38c8a8); opacity: 0; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; color: white;">
                            <div style="text-align: center;">
                                <h3 style="margin-bottom: 0.5rem;">Create & Share</h3>
                                <p>Express your creativity through multimedia</p>
                            </div>
                        </div>
                    </div>
                    <div style="padding: 1.5rem;">
                        <h3 style="font-size: 1.5rem; font-weight: 700; color: #200769; margin-bottom: 0.5rem;">Media Club</h3>
                        <p style="color: #6c757d; font-size: 0.95rem; line-height: 1.6;">
                            Amplifying creativity through multimedia, film, and storytelling in a supportive creative community.
                        </p>
                    </div>
                </article>

                <!-- Sports Club -->
                <article style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: all 0.3s ease; transform-style: preserve-3d; cursor: pointer;">
                    <div style="position: relative; height: 250px; overflow: hidden;">
                        <img src="https://images.pexels.com/photos/1752757/pexels-photo-1752757.jpeg" 
                             alt="Sports Club activities" 
                             style="width: 100%; height: 100%; object-fit: cover; transition: all 0.3s ease;"
                             loading="lazy">
                        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(45deg, #200769, #38c8a8); opacity: 0; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; color: white;">
                            <div style="text-align: center;">
                                <h3 style="margin-bottom: 0.5rem;">Stay Active</h3>
                                <p>Build teamwork and leadership through sports</p>
                            </div>
                        </div>
                    </div>
                    <div style="padding: 1.5rem;">
                        <h3 style="font-size: 1.5rem; font-weight: 700; color: #200769; margin-bottom: 0.5rem;">Sports Club</h3>
                        <p style="color: #6c757d; font-size: 0.95rem; line-height: 1.6;">
                            Promoting physical fitness, teamwork, and competitive spirit through various sporting activities.
                        </p>
                    </div>
                </article>

                <!-- Science Club -->
                <article style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: all 0.3s ease; transform-style: preserve-3d; cursor: pointer;">
                    <div style="position: relative; height: 250px; overflow: hidden;">
                        <img src="https://images.pexels.com/photos/2280571/pexels-photo-2280571.jpeg" 
                             alt="Science Club activities" 
                             style="width: 100%; height: 100%; object-fit: cover; transition: all 0.3s ease;"
                             loading="lazy">
                        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(45deg, #200769, #38c8a8); opacity: 0; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; color: white;">
                            <div style="text-align: center;">
                                <h3 style="margin-bottom: 0.5rem;">Discover Science</h3>
                                <p>Explore the wonders of scientific discovery</p>
                            </div>
                        </div>
                    </div>
                    <div style="padding: 1.5rem;">
                        <h3 style="font-size: 1.5rem; font-weight: 700; color: #200769; margin-bottom: 0.5rem;">Science Club</h3>
                        <p style="color: #6c757d; font-size: 0.95rem; line-height: 1.6;">
                            Exploring, experimenting, and discovering the wonders of our natural world through hands-on learning.
                        </p>
                    </div>
                </article>
            </div>
            
            <div style="text-align: center; margin-top: 3rem;">
                <a href="#" class="btn-modern btn-primary-modern">
                    <i class="fas fa-eye" style="margin-right: 0.5rem;"></i>
                    View All Clubs
                </a>
            </div>
        </div>
    </section>

    <!-- Enhanced Contact Section -->
    <section id="contact" class="section-modern">
        <div class="container-modern">
            <div style="text-align: center; margin-bottom: 4rem;">
                <h2 style="font-size: clamp(2.5rem, 4vw, 3.5rem); font-weight: 800; color: #200769; margin-bottom: 1rem; position: relative;">
                    Get In Touch
                    <span style="position: absolute; bottom: -10px; left: 50%; transform: translateX(-50%); width: 60px; height: 4px; background: linear-gradient(135deg, #f4b328 0%, #ff6b35 100%); border-radius: 2px;"></span>
                </h2>
                <p style="font-size: 1.2rem; color: #6c757d; max-width: 600px; margin: 0 auto;">
                    Ready to join our community? We'd love to hear from you
                </p>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: start;">
                <!-- Contact Info -->
                <div style="display: flex; flex-direction: column; gap: 2rem;">
                    <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); text-align: center; transition: all 0.3s ease;">
                        <div style="width: 60px; height: 60px; margin: 0 auto 1rem; background: linear-gradient(135deg, #200769, #341ca0); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem;">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h3 style="color: #200769; margin-bottom: 0.5rem;">Visit Us</h3>
                        <p style="color: #6c757d;">
                            <?php echo htmlspecialchars($config['contact']['address']['line1']); ?><br>
                            <?php echo htmlspecialchars($config['contact']['address']['line2']); ?>
                        </p>
                    </div>
                    
                    <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); text-align: center; transition: all 0.3s ease;">
                        <div style="width: 60px; height: 60px; margin: 0 auto 1rem; background: linear-gradient(135deg, #f4b328, #ff6b35); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem;">
                            <i class="fas fa-phone"></i>
                        </div>
                        <h3 style="color: #200769; margin-bottom: 0.5rem;">Call Us</h3>
                        <p style="color: #6c757d;">
                            <?php echo htmlspecialchars($config['contact']['phone_numbers'][0]); ?><br>
                            <?php echo htmlspecialchars($config['contact']['phone_numbers'][1]); ?>
                        </p>
                    </div>
                    
                    <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); text-align: center; transition: all 0.3s ease;">
                        <div style="width: 60px; height: 60px; margin: 0 auto 1rem; background: linear-gradient(135deg, #38c8a8, #20b2aa); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem;">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h3 style="color: #200769; margin-bottom: 0.5rem;">Email Us</h3>
                        <p style="color: #6c757d;">
                            <?php echo htmlspecialchars($config['contact']['emails'][0]); ?><br>
                            <?php echo htmlspecialchars($config['contact']['emails'][1]); ?>
                        </p>
                    </div>
                </div>
                
                <!-- Contact Form -->
                <div style="background: white; border-radius: 12px; padding: 3rem; box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15); position: relative; overflow: hidden;">
                    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(135deg, rgba(56, 200, 168, 0.05), rgba(32, 7, 105, 0.05)); pointer-events: none;"></div>
                    
                    <h3 style="text-align: center; color: #200769; margin-bottom: 2rem; font-size: 2rem; font-weight: 700; position: relative; z-index: 1;">
                        Send us a Message
                    </h3>
                    
                    <form method="post" action="mail.php" style="position: relative; z-index: 1;">
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                            <div style="position: relative;">
                                <input type="text" name="name" required 
                                       style="width: 100%; padding: 1rem 1.5rem; border: 2px solid #e9ecef; border-radius: 12px; font-size: 1rem; transition: all 0.3s ease; background: white;"
                                       placeholder="Full Name">
                            </div>
                            <div style="position: relative;">
                                <input type="email" name="mail" required 
                                       style="width: 100%; padding: 1rem 1.5rem; border: 2px solid #e9ecef; border-radius: 12px; font-size: 1rem; transition: all 0.3s ease; background: white;"
                                       placeholder="Email Address">
                            </div>
                        </div>
                        
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                            <div style="position: relative;">
                                <input type="tel" name="phone" 
                                       style="width: 100%; padding: 1rem 1.5rem; border: 2px solid #e9ecef; border-radius: 12px; font-size: 1rem; transition: all 0.3s ease; background: white;"
                                       placeholder="Phone Number (Optional)">
                            </div>
                            <div style="position: relative;">
                                <select name="subject" required 
                                        style="width: 100%; padding: 1rem 1.5rem; border: 2px solid #e9ecef; border-radius: 12px; font-size: 1rem; transition: all 0.3s ease; background: white;">
                                    <option value="">Select Subject</option>
                                    <option value="admission">Admission Inquiry</option>
                                    <option value="academic">Academic Information</option>
                                    <option value="events">Events & Activities</option>
                                    <option value="general">General Inquiry</option>
                                </select>
                            </div>
                        </div>
                        
                        <div style="margin-bottom: 2rem;">
                            <textarea name="message" rows="5" required 
                                      style="width: 100%; padding: 1rem 1.5rem; border: 2px solid #e9ecef; border-radius: 12px; font-size: 1rem; transition: all 0.3s ease; background: white; resize: vertical;"
                                      placeholder="Your Message"></textarea>
                        </div>
                        
                        <button type="submit" class="btn-modern btn-primary-modern" style="width: 100%; justify-content: center;">
                            <i class="fas fa-paper-plane" style="margin-right: 0.5rem;"></i>
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section style="background: linear-gradient(135deg, #200769 0%, #341ca0 100%); color: white; text-align: center; padding: 4rem 0; position: relative; overflow: hidden;">
        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 100 100\"><circle cx=\"50\" cy=\"50\" r=\"2\" fill=\"rgba(255,255,255,0.1)\"/></svg>'); opacity: 0.3;"></div>
        
        <div class="container-modern" style="position: relative; z-index: 2;">
            <h2 style="font-size: clamp(2rem, 4vw, 3rem); margin-bottom: 1rem; font-weight: 700;">
                Ready to Join Our Community?
            </h2>
            <p style="font-size: 1.2rem; margin-bottom: 2rem; opacity: 0.9;">
                Take the first step towards an exceptional educational journey
            </p>
            <a href="admission.php" class="btn-modern btn-secondary-modern" style="font-size: 1.1rem; padding: 1.2rem 2.5rem;">
                <i class="fas fa-graduation-cap" style="margin-right: 0.5rem;"></i>
                Start Your Application
            </a>
        </div>
    </section>
</main>

<!-- Enhanced JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 3D Card Effects
    document.querySelectorAll('article').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px) rotateX(5deg) rotateY(2deg)';
            this.style.boxShadow = '0 15px 35px rgba(0, 0, 0, 0.2)';
            
            const overlay = this.querySelector('div[style*="opacity: 0"]');
            if (overlay) {
                overlay.style.opacity = '0.9';
            }
            
            const img = this.querySelector('img');
            if (img) {
                img.style.transform = 'scale(1.1)';
            }
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = '';
            this.style.boxShadow = '0 4px 6px rgba(0, 0, 0, 0.1)';
            
            const overlay = this.querySelector('div[style*="opacity"]');
            if (overlay) {
                overlay.style.opacity = '0';
            }
            
            const img = this.querySelector('img');
            if (img) {
                img.style.transform = 'scale(1)';
            }
        });
    });

    // Contact card hover effects
    document.querySelectorAll('div[style*="text-align: center; transition"]').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
            this.style.boxShadow = '0 8px 25px rgba(0, 0, 0, 0.15)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = '';
            this.style.boxShadow = '0 4px 6px rgba(0, 0, 0, 0.1)';
        });
    });

    // Form enhancements
    const formInputs = document.querySelectorAll('input, select, textarea');
    formInputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.style.borderColor = '#38c8a8';
            this.style.boxShadow = '0 0 0 3px rgba(56, 200, 168, 0.1)';
            this.style.transform = 'translateY(-2px)';
        });
        
        input.addEventListener('blur', function() {
            this.style.borderColor = '#e9ecef';
            this.style.boxShadow = 'none';
            this.style.transform = '';
        });
    });

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe sections for scroll animations
    document.querySelectorAll('section').forEach(section => {
        section.style.opacity = '0';
        section.style.transform = 'translateY(50px)';
        section.style.transition = 'all 0.8s ease-out';
        observer.observe(section);
    });

    // Performance monitoring
    if ('performance' in window) {
        window.addEventListener('load', () => {
            setTimeout(() => {
                const perfData = performance.getEntriesByType('navigation')[0];
                console.log('Page Load Time:', perfData.loadEventEnd - perfData.loadEventStart, 'ms');
            }, 0);
        });
    }
});

// Service Worker Registration
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js')
            .then(registration => console.log('SW registered'))
            .catch(error => console.log('SW registration failed'));
    });
}
</script>

<!-- Load non-critical CSS asynchronously -->
<script>
function loadCSS(href) {
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = href;
    document.head.appendChild(link);
}

// Load additional stylesheets after page load
window.addEventListener('load', () => {
    loadCSS('css/seo-optimized.css');
    loadCSS('https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css');
});
</script>

<?php require "includes/footer.php"; ?>