<?php require "includes/header.php"; ?>
<link rel="stylesheet" href="css/index.css">
<link rel="stylesheet" href="css/home-contact.css">

<!-- Intro Video Container -->
<div id="intro-video-container" style="position: fixed; top: 0; left: 0; width: 100%; height: 100vh; z-index: 9999; background-color: #000; display: flex; justify-content: center; align-items: center; overflow: hidden;">
  <video id="intro-video" autoplay muted style="width: 100%; height: 100%; object-fit: cover;">
    <source src="videos/intro.mp4" type="video/mp4">
    Your browser does not support the video tag.
  </video>
</div>

<!-- Main Content Container - Initially Hidden -->
<div id="main-content" style="opacity: 0; transition: opacity 1.5s ease-in-out;">

<!-- Hero Video Section - Infinite Loop -->
<div class="hero-video-section" style="position: relative; width: 100%; height: 100vh; overflow: hidden;">
  <video id="hero-video" autoplay muted loop style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
    <source src="videos/hero-loop.mp4" type="video/mp4">
    Your browser does not support the video tag.
  </video>
  <!-- <div class="hero-overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); display: flex; flex-direction: column; justify-content: center; align-items: center; color: white; text-align: center; padding: 0 20px;">
    <h1 style="font-size: 3.5rem; margin-bottom: 1rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.7);">Ananda National College</h1>
    <p style="font-size: 1.5rem; max-width: 800px; margin-bottom: 2rem; text-shadow: 1px 1px 2px rgba(0,0,0,0.7);">Empowering minds, inspiring futures, and building tomorrow's leaders today.</p>
    <a href="#about" class="btn btn-primary btn-lg" style="background-color: #200769; border: none; padding: 0.75rem 2rem; font-size: 1.2rem; border-radius: 50px; transition: all 0.3s ease;">Learn More</a>
  </div> -->
</div>

<style>
  .gallery-container {
    overflow: hidden;
    position: relative;
    padding: 4rem 0;
    background: #f8f9fa;
  }

  .gallery-track {
    display: flex;
    animation: scroll 40s linear infinite;
    width: max-content;
  }

  .gallery-item {
    position: relative;
    margin: 0 1rem;
    flex: 0 0 300px;
    transition: transform 0.3s;
  }

  .gallery-item img {
    width: 300px;
    height: 200px;
    object-fit: cover;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }

  .caption {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    padding: 0.5rem;
    text-align: center;
    border-radius: 0 0 8px 8px;
  }

  .category-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    background: rgba(255, 255, 255, 0.9);
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-size: 0.8em;
    color: #333;
  }

  @keyframes scroll {
    0% {
      transform: translateX(0);
    }

    100% {
      transform: translateX(calc(-300px * 14));
    }
  }

  .gallery-track:hover {
    animation-play-state: paused;
  }

  .gallery-item:hover {
    transform: scale(1.05);
  }

  @media (max-width: 768px) {
    .gallery-item {
      flex: 0 0 250px;
    }

    .gallery-item img {
      width: 250px;
      height: 150px;
    }

    @keyframes scroll {
      100% {
        transform: translateX(calc(-250px * 7));
      }
    }
  }
</style>
<!-- end header -->
<section class=" slider_section">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">

        <div class="container-fluid padding_dd">
          <div class="carousel-caption">
            <div class="row">
              <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
                <div class="text-bg">
                  <h2><?php echo htmlspecialchars($config['app']['name']); ?></h2>
                  <p><?php echo htmlspecialchars($config['app']['name']); ?> in Chilaw, established on May 12, 1950, by Sri Bolagala Silalankara Thero, is a prominent Buddhist educational institution in Sri Lanka's Puttalam district. As a national school, it offers both primary and secondary education, emphasizing academic excellence and Buddhist values. Located at <?php echo htmlspecialchars($config['contact']['address']['line1']); ?>, the school has grown significantly since its inception, now boasting a large student body and a dedicated staff committed to nurturing well-rounded individuals.
                  </p>
                </div>
              </div>
              <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12">
                <div class="images_box">
                  <figure><img src="anc/20210208193707_IMG_5979.jpg"></figure>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
  <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  </div>

</section>

</header>
<div class="wave-container">
  <div class="wave-layer">
    <div class="wave"></div>
  </div>
  <div class="wave-layer">
    <div class="wave" style="animation-duration: 12s; animation-delay: -4s;"></div>
  </div>
  <div class="wave-layer">
    <div class="wave" style="animation-duration: 16s; animation-delay: -8s;"></div>
  </div>
</div>

<div class="wave-container2">
  <div class="wave-layer2">
    <div class="wave2"></div>
  </div>
  <div class="wave-layer2">
    <div class="wave2" style="animation-duration: 12s; animation-delay: -4s;"></div>
  </div>
  <div class="wave-layer2">
    <div class="wave2" style="animation-duration: 16s; animation-delay: -8s;"></div>
  </div>
</div>

<!-- about  -->
<div id="about" class="about">
  <div class="container">
    <div class="row">
      <!-- <iframe src="https://www.facebook.com/plugins/video.php?height=314&href=https%3A%2F%2Fwww.facebook.com%2Fanandacollegechilawofficial%2Fvideos%2F413620098283785%2F&show_text=false&width=560&t=0" width="560" height="314" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true"></iframe> -->
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <div class="about-box">
          <h2>About <strong class="yellow">Our Game</strong></h2>
          <p style="font-family: 'Ubuntu' , sans-serif;"> About Our Educational Gaming Initiative at <?php echo htmlspecialchars($config['app']['name']); ?>
            College: Dive into an engaging educational
            experience with us as we leverage gaming for learning and discovery. Our initiative aims to empower students
            through interactive and immersive educational games. Join us to explore new ways of learning, spark
            curiosity, and embrace innovative approaches to education at <?php echo htmlspecialchars($config['app']['name']); ?>!</p>
          <a href="Javascript:void(0)">Read more</a>
        </div>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12  mt-sm-3">
        <div class="about-box d-block center" style="box-shadow: 0px 16px 48px 0px rgba(0, 0, 0, 0.176); height: 100%;">
          <div class="video-container" style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
            <iframe
              src="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2Fanandacollegechilawofficial%2Fvideos%2F413620098283785%2F&show_text=false&t=0"
              style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border:none;overflow:hidden" 
              scrolling="no"
              class="mt-2"
              frameborder="0" 
              allowfullscreen="true"
              allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"
              allowFullScreen="true">
            </iframe>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
<!-- end abouts -->

<section class="mt-lg-5">
  <div class="container-fluid padding_dd">
    <div id="myCarousel1" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#myCarousel1" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel1" data-slide-to="1"></li>
        <li data-target="#myCarousel1" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">

        <?php
        $query = "SELECT * FROM `events` ORDER BY `event_id` DESC LIMIT 3";
        $result = Database::search($query);
        $EVENTS_num = $result->num_rows;
        for ($x = 0; $x < $EVENTS_num; $x++) {
          $data = $result->fetch_assoc();
          if ($data["image_type"] == 1) {
            $val = '<img src="' . $data["image"] . '" width="100%">';
          } else {
            $val = '<figure><img src="' . $data['image'] . '"></figure>';
          }
          $active = "";
          if ($x == 0) {
            $active = "active";
          }
          echo ('<div class="carousel-item ' . $active . '">

          <div class="container-fluid padding_dd">
            <div class="carousel-caption">
              <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
                  <div class="text-bg">
                    <h2>' . $data["topic"] . '</h2>
                    <p>' . $data["caption"] . '</p>
                    <a href="single-event.php?id=' . $data["event_id"] . '">Read more</a> <a href="events.php">More</a>
                  </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 rounded border-radius-lg">
                  <div class="images_box rounded">
                  ' . $val . '
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        ');
        } ?>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#myCarousel1" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#myCarousel1" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  </div>

</section>

<!-- our -->
<div id="important" class="important">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="titlepage">
          <h2>Some <strong class="yellow">important facts</strong></h2>
          <span>"Key facts presented succinctly for easy understanding and quick reference."</span>
        </div>
      </div>
    </div>
  </div>



  <div class="important_bg">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="col-6 col-sm-4 col-md-2 mb-4">
          <div class="important_box">
            <h3>200+</h3>
            <span>Teachers</span>
          </div>
        </div>
        <div class="col-6 col-sm-4 col-md-2 mb-4">
          <div class="important_box">
            <h3>56+</h3>
            <span>Classes</span>
          </div>
        </div>
        <div class="col-6 col-sm-4 col-md-2 mb-4">
          <div class="important_box">
            <h3>15+</h3>
            <span>Clubs</span>
          </div>
        </div>
        <div class="col-6 col-sm-4 col-md-2 mb-4">
          <div class="important_box">
            <h3>3500+</h3>
            <span>Students</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<!-- end our -->

<!-- Courses -->
<div id="courses" class="Courses">
  <div class="container-fluid padding_left3">
    <div class="row">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <div class="box_bg">
          <div class="box_bg_img">
            <div class="row">
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="box_my">
                  <figure><img src="https://i.ibb.co/p6g00Ny9/images-q-tbn-ANd9-Gc-Qs769-KK91yd00-Qg5-C0-Hp-CZ65-H5-VMDl-Xkl5-TA-s.png"></figure>
                  <div class="overlay">
                    <h3>IT Society</h3>
                    <p>Tech enthusiasts collaborating, learning, and innovating together in the IT Society community.
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="box_my">
                  <figure><img src="https://i.ibb.co/k2qJnkyM/images-q-tbn-ANd9-Gc-Qc8-CT3tjsz-Tbn-HNz-Yq-Q5mck-O4-KKq-UUpgrfbo0-Ly4d4vprp-Qy-CMKl3g-Iwgaxq-Ea-BSv.png"></figure>
                  <div class="overlay">
                    <h3>Media Club</h3>
                    <p>Amplifying creativity through multimedia, film, and storytelling in a supportive community.</p>
                  </div>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="box_my">
                  <figure><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcScbKVgKHEG2TsSw-IQ3mbyidhKTOO5UN8d6Q&s"></figure>
                  <div class="overlay">
                    <h3>Sports Club</h3>
                    <p>Organizing, leading, and optimizing for success in today's dynamic Sports environments.</p>
                  </div>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="box_my">
                  <figure><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ691jODlkC0zdkkduYhJW_y73pWkhKaHZFZA&s"></figure>
                  <div class="overlay">
                    <h3>Science Club</h3>
                    <p>Exploring, experimenting, and discovering wonders in our natural world together.</p>
                  </div>
                </div>
              </div>



            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 border_right">
        <div class="box_text">
          <div class="titlepage">
            <h2>School <strong class="yellow"> Clubs</strong></h2>
          </div>
          <p>School clubs play a vital role in enhancing the overall educational experience by providing students with
            opportunities to explore their interests, develop new skills, and build lasting relationships. These clubs
            serve as platforms for students to engage in extracurricular activities that complement their academic
            pursuits. From academic clubs focusing on subjects like science, literature, and mathematics to creative
            clubs such as art, music, and drama, students can choose from a diverse range of options based on their
            passions and talents. Participating in school clubs not only fosters personal growth and leadership skills
            but also promotes teamwork and collaboration. Ultimately, school clubs contribute significantly to the
            holistic development of students, enriching their educational journey beyond the classroom.</p>
          <a href="Javascript:void(0)">Read more</a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end Courses -->

<!-- learn -->


<div id="learn" class="learn">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="titlepage">
          <h2>About <strong class="yellow">Our School</strong></h2>
          <span>About Our School: <?php echo htmlspecialchars($config['app']['name']); ?> is committed to fostering a dynamic learning environment where
            students thrive academically, creatively, and socially. With a focus on holistic education, we nurture
            critical thinking, innovation, and character development. Our dedicated faculty and diverse programs ensure
            a well-rounded educational experience, preparing students for success in a rapidly changing world. At <?php echo htmlspecialchars($config['app']['name']); ?>, excellence is our standard, and every student's journey is valued and supported.</span>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="learn_box">
          <figure><img src="anc/FB_IMG_1603758503120.jpg" alt="img" /></figure>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- MAKE -->
<div class="make">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="titlepage">
          <h2 class="">Word from <strong class="white_colo">Principal</strong></h2>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
        <div class="make_text mt-lg-5">
          <p>As the Principal of <?php echo htmlspecialchars($config['app']['name']); ?>, I am committed to providing a nurturing and inspiring
            educational environment where every student can flourish. We prioritize academic excellence, character
            development, and holistic growth. Our dedicated faculty and staff are here to support each student's journey
            towards success and fulfillment. Together, we strive to empower our students to become confident,
            responsible, and lifelong learners. Welcome to <?php echo htmlspecialchars($config['app']['name']); ?>, where learning transforms lives.
          </p>
          <a href="staff.php" class="mt-lg-5">SCHOOL STAFF</a>
        </div>
      </div>
      <div class="col-xl-5 col-lg-6 col-md-5 col-sm-12 offset-lg-2">
        <div class="make_img col-lg-8">
          <figure><img src="https://i.ibb.co/YbsY4V5/principal.jpg" alt="Ananda Principal's Photo"></figure>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end MAKE -->
<!-- end learn -->


<!-- contact -->
<div id="contact" class="contact">
  <div class="container-fluid padding_left2">
    <div class="white_color">
      <div class="row">

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
          <div class="contact-map-card">
            <iframe
              src="<?php echo htmlspecialchars($config['contact']['map']['embed_src']); ?>"
              width="100%" height="420" style="border:0;" allowfullscreen="" loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"></iframe>
            <div class="map-card-info">
              <div>
                <h3>Visit Our Campus</h3>
                <p><?php echo htmlspecialchars($config['contact']['map']['plain_address']); ?></p>
              </div>
              <a class="map-directions" href="<?php echo htmlspecialchars($config['contact']['map']['directions_link']); ?>" target="_blank" rel="noopener">Get Directions</a>
            </div>
          </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
          <form class="home-contact-form" method="post" action="mail.php">
            <div class="home-contact-heading">
              <p class="eyebrow">We'd love to hear from you</p>
              <h2>Contact <span>Us</span></h2>
              <p class="description">Have a question about admissions, events, or campus life? Send us a message and our team will reply soon.</p>
            </div>
            <div class="home-contact-grid">
              <div class="form-field">
                <label for="homeContactName">Full Name <span>*</span></label>
                <input id="homeContactName" name="name" type="text" required placeholder="e.g. Kasun Perera">
              </div>
              <div class="form-field">
                <label for="homeContactEmail">Email <span>*</span></label>
                <input id="homeContactEmail" name="mail" type="email" required placeholder="you@example.com">
              </div>
              <div class="form-field">
                <label for="homeContactPhone">Phone</label>
                <input id="homeContactPhone" name="phone" type="tel" placeholder="Optional">
              </div>
              <div class="form-field">
                <label for="homeContactSubject">Subject <span>*</span></label>
                <select id="homeContactSubject" name="subject" class="native-select" required>
                  <option value="">Select one</option>
                  <option value="admission">Admission Inquiry</option>
                  <option value="academic">Academic Information</option>
                  <option value="events">Events & Activities</option>
                  <option value="general">General Inquiry</option>
                  <option value="complaint">Complaint / Suggestion</option>
                </select>
              </div>
              <div class="form-field form-field--full">
                <label for="homeContactMessage">Message <span>*</span></label>
                <textarea id="homeContactMessage" name="message" rows="5" required placeholder="Share your thoughts with us"></textarea>
              </div>
            </div>
            <div class="home-contact-footer">
              <div class="form-meta">
                <span class="required-note">* Required fields</span>
                <span class="response-note">We aim to respond within two working days.</span>
              </div>
              <button type="submit" class="home-contact-submit">Send Message</button>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>

  <!-- end contact -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const introVideo = document.getElementById('intro-video');
      const introContainer = document.getElementById('intro-video-container');
      const mainContent = document.getElementById('main-content');
      const heroVideo = document.getElementById('hero-video');
      
      // Preload the hero video
      heroVideo.load();
      
      // Function to handle the transition
      function handleTransition() {
        // Start fading out the intro video
        introContainer.style.opacity = '0';
        introContainer.style.transition = 'opacity 1.5s ease-in-out';
        
        // Start fading in the main content
        mainContent.style.opacity = '1';
        
        // Start playing the hero video
        heroVideo.play();
        
        // After the transition completes, hide the intro container completely
        setTimeout(() => {
          introContainer.style.display = 'none';
          
          // Add a scroll event listener to animate content as user scrolls
          window.addEventListener('scroll', revealOnScroll);
        }, 1500);
      }
      
      // Listen for the timeupdate event on the video
      introVideo.addEventListener('timeupdate', function() {
        // When video reaches 10 seconds, start the transition
        if (introVideo.currentTime >= 10) {
          handleTransition();
          
          // Remove the event listener to prevent multiple triggers
          introVideo.removeEventListener('timeupdate', arguments.callee);
        }
      });
      
      // Fallback in case video doesn't play or has issues
      setTimeout(() => {
        // If the video hasn't triggered the transition yet, do it now
        if (introContainer.style.opacity !== '0') {
          handleTransition();
        }
      }, 10000);
      
      // Function to reveal elements as user scrolls
      function revealOnScroll() {
        const elements = document.querySelectorAll('.box_my, .about-box, .box_bg, .titlepage');
        
        elements.forEach(element => {
          const elementTop = element.getBoundingClientRect().top;
          const windowHeight = window.innerHeight;
          
          if (elementTop < windowHeight - 100) {
            element.classList.add('animate__animated', 'animate__fadeInUp');
            element.style.opacity = '1';
          }
        });
      }
      
      // Function to adjust topic font size based on content length
      const carouselTitles = document.querySelectorAll('.carousel .text-bg h2');
      
      carouselTitles.forEach(title => {
        const textLength = title.textContent.trim().length;
        
        // Apply different classes based on text length
        if (textLength > 50) {
          title.classList.add('very-long-text');
        } else if (textLength > 30) {
          title.classList.add('long-text');
        }
        
        // Make sure text fits in container
        ensureTextFits(title);
      });
      
      // Function to progressively reduce font size until text fits
      function ensureTextFits(element) {
        const container = element.parentElement;
        const containerWidth = container.clientWidth;
        
        // Start with current font size and reduce if needed
        let currentSize = parseFloat(window.getComputedStyle(element).fontSize);
        let textWidth = element.scrollWidth;
        
        // Reduce font size until text fits (with a reasonable minimum)
        while (textWidth > containerWidth && currentSize > 14) {
          currentSize -= 1;
          element.style.fontSize = currentSize + 'px';
          textWidth = element.scrollWidth;
        }
      }
    });
    
    // Existing gallery code
    document.querySelector('.gallery-track')?.addEventListener('mouseenter', () => {
      document.querySelector('.gallery-track').style.animationPlayState = 'paused';
    });

    document.querySelector('.gallery-track')?.addEventListener('mouseleave', () => {
      document.querySelector('.gallery-track').style.animationPlayState = 'running';
    });

    // Touch support for mobile devices
    let touchStartX = 0;
    let touchEndX = 0;

    const galleryTrack = document.querySelector('.gallery-track');
    if (galleryTrack) {
      galleryTrack.addEventListener('touchstart', (e) => {
        touchStartX = e.touches[0].clientX;
        galleryTrack.style.animationPlayState = 'paused';
      });

      galleryTrack.addEventListener('touchmove', (e) => {
        touchEndX = e.touches[0].clientX;
        const diff = touchStartX - touchEndX;
        galleryTrack.style.transform = `translateX(${-diff}px)`;
      });

      galleryTrack.addEventListener('touchend', () => {
        galleryTrack.style.animationPlayState = 'running';
      });
    }
  </script>
  <!--  footer -->
  <script>
    // This example adds a marker to indicate the position of Bondi Beach in Sydney,
    // Australia.
    function initMap() {
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 11,
        center: {
          lat: 7.5723195049342475,
          lng: 79.79889487282725
        },
      });

      // var image = 'images/anclogo.png';
      var image = 'images/maps-and-flags.png';
      var beachMarker = new google.maps.Marker({
        position: {
          lat: 7.5723195049342475,
          lng: 79.79889487282725
        },
        map: map,
        icon: image
      });
    }
  </script>
  <?php require "includes/footer.php"; ?>
</div> <!-- End of main-content div -->