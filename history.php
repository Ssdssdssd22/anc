<?php include "includes/header.php"; ?>

<style>
    .fb-section {
        padding: 4rem 0;
        background: #f8f9fa;
    }
    
    .fb-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
    }
    
    .fb-wrapper {
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        padding: 2rem;
    }

    .fb-page {
        width: 100% !important;
        margin: 0 auto;
    }

    @media (max-width: 768px) {
        .fb-section {
            padding: 2rem 0;
        }
        
        .fb-wrapper {
            padding: 1rem;
        }
    }
</style>

<section class="fb-section">
    <div class="fb-container">
        <h2 class="text-center mb-4">Follow Us on Facebook</h2>
        <div class="fb-wrapper">
            <div class="fb-page" 
                 data-href="https://www.facebook.com/YourSchoolPage" 
                 data-tabs="timeline" 
                 data-width="500" 
                 data-height="600" 
                 data-small-header="false" 
                 data-adapt-container-width="true" 
                 data-hide-cover="false" 
                 data-show-facepile="true">
                <blockquote cite="https://www.facebook.com/YourSchoolPage" 
                            class="fb-xfbml-parse-ignore">
                    <a href="https://www.facebook.com/YourSchoolPage">Your School Name</a>
                </blockquote>
            </div>
        </div>
    </div>
</section>

<!-- Facebook SDK -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" 
        src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v18.0" 
        nonce="YOUR_NONCE_VALUE"></script>

<?php require "includes/footer.php"; ?>