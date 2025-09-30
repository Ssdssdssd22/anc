<?php require "includes/header.php"; ?>
<link rel="stylesheet" href="css/contact.css">

<!-- 3D Contact Hero Section -->
<div class="contact-hero">
    <div class="hero-content">
        <div class="hero-background">
            <div class="floating-shapes">
                <div class="shape shape-1"></div>
                <div class="shape shape-2"></div>
                <div class="shape shape-3"></div>
                <div class="shape shape-4"></div>
            </div>
        </div>
        <div class="hero-text">
            <h1 class="hero-title">
                <span class="title-word">Get</span>
                <span class="title-word">In</span>
                <span class="title-word">Touch</span>
            </h1>
            <p class="hero-subtitle">Connect with us and discover endless possibilities</p>
        </div>
    </div>
</div>

<!-- 3D Contact Section -->
<div class="contact-section">
    <div class="container">
        <div class="contact-grid">
            <!-- Contact Information Cards -->
            <div class="contact-info">
                <div class="info-header">
                    <h2>Let's Connect</h2>
                    <p>We're here to help and answer any questions you might have</p>
                </div>

                <div class="contact-cards">
                    <div class="contact-card">
                        <div class="card-icon">
                            <div class="icon-container">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 5a2 2 0 0 1 2-2h3.28a1 1 0 0 1 .948.684l1.498 4.493a1 1 0 0 1-.502 1.21l-2.257 1.13a11.042 11.042 0 0 0 5.516 5.516l1.13-2.257a1 1 0 0 1 1.21-.502l4.493 1.498a1 1 0 0 1 .684.949V19a2 2 0 0 1-2 2h-1C9.716 21 3 14.284 3 6V5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                        <div class="card-content">
                            <h3>Phone</h3>
                            <p>+94 32 222 2345</p>
                            <p>+94 32 222 2346</p>
                        </div>
                    </div>

                    <div class="contact-card">
                        <div class="card-icon">
                            <div class="icon-container">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2 4a2 2 0 0 1 2-2h4l2 5-2.5 1.5a11 11 0 0 0 5 5L14 11l5 2v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                        <div class="card-content">
                            <h3>Email</h3>
                            <p>info@anandacollege.edu.lk</p>
                            <p>principal@anandacollege.edu.lk</p>
                        </div>
                    </div>

                    <div class="contact-card">
                        <div class="card-icon">
                            <div class="icon-container">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25s-7.5-4.108-7.5-11.25a7.5 7.5 0 1 1 15 0Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                        <div class="card-content">
                            <h3>Location</h3>
                            <p>Colombo Road, Chilaw</p>
                            <p>Sri Lanka</p>
                        </div>
                    </div>

                    <div class="contact-card">
                        <div class="card-icon">
                            <div class="icon-container">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                        <div class="card-content">
                            <h3>Office Hours</h3>
                            <p>Monday - Friday: 7:30 AM - 3:30 PM</p>
                            <p>Saturday: 7:30 AM - 1:00 PM</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3D Contact Form -->
            <div class="contact-form-container">
                <div class="form-header">
                    <h2>Send us a Message</h2>
                    <p>Fill out the form below and we'll get back to you as soon as possible</p>
                </div>

                <form class="contact-form" method="post" action="mail.php" id="contactForm">
                    <div class="form-group">
                        <div class="input-container">
                            <input type="text" id="name" name="name" placeholder="Your Name" required>
                            <label for="name">Full Name</label>
                            <div class="input-highlight"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-container">
                            <input type="email" id="email" name="mail" placeholder="Your Email" required>
                            <label for="email">Email Address</label>
                            <div class="input-highlight"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-container">
                            <input type="tel" id="phone" name="phone" placeholder="Your Phone">
                            <label for="phone">Phone Number</label>
                            <div class="input-highlight"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-container">
                            <select id="subject" name="subject" required>
                                <option value="">Select Subject</option>
                                <option value="admission">Admission Inquiry</option>
                                <option value="academic">Academic Information</option>
                                <option value="events">Events & Activities</option>
                                <option value="general">General Inquiry</option>
                                <option value="complaint">Complaint/Suggestion</option>
                            </select>
                            <label for="subject">Subject</label>
                            <div class="input-highlight"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-container">
                            <textarea id="message" name="message" placeholder="Your Message" rows="5" required></textarea>
                            <label for="message">Message</label>
                            <div class="input-highlight"></div>
                        </div>
                    </div>

                    <div class="form-submit">
                        <button type="submit" class="submit-btn">
                            <span class="btn-text">Send Message</span>
                            <div class="btn-ripple"></div>
                            <div class="btn-glow"></div>
                        </button>
                        <div class="success-message" id="successMessage">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 12l2 2 4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            <span>Message sent successfully!</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Interactive Map Section -->
        <div class="map-section">
            <div class="map-header">
                <h2>Find Us</h2>
                <p>Visit us at our beautiful campus in Chilaw</p>
            </div>
            <div class="map-container">
                <div class="map-wrapper">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6651.546588770832!2d79.79176119336493!3d7.571352378623728!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2c96468fbc719%3A0x5358555a23a785db!2sAnanda%20National%20College!5e0!3m2!1sen!2slk!4v1713470141625!5m2!1sen!2slk"
                        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                    <div class="map-overlay">
                        <div class="overlay-content">
                            <h3>Ananda National College</h3>
                            <p>Colombo Road, Chilaw, Sri Lanka</p>
                            <button class="get-directions-btn">Get Directions</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 3D Background Elements -->
<div class="background-elements">
    <div class="bg-element bg-element-1"></div>
    <div class="bg-element bg-element-2"></div>
    <div class="bg-element bg-element-3"></div>
    <div class="bg-element bg-element-4"></div>
</div>

<script src="js/contact.js"></script>

<?php require "includes/footer.php"; ?>
