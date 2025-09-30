@@ .. @@
 <?php

 session_start();
 $config = require __DIR__ . '/../constant.php';

 define('ROOT', 'site/');
 define('APPURL', $config['app']['base_url'] . '/');
 define('ADMINURL', $config['app']['admin_url']);

 ?>
 <?php include "connection.php"; ?>
 <!DOCTYPE html>
 <html lang="en">

 <head>
+    <!-- Critical Meta Tags -->
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">
-    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
+    <meta name="description" content="<?php echo htmlspecialchars($config['app']['name']); ?> - Premier educational institution in Chilaw, Sri Lanka. Empowering minds, inspiring futures since 1950.">
+    <meta name="keywords" content="Ananda National College, Chilaw, Sri Lanka, education, school, Buddhist education, academic excellence, secondary education">
+    <meta name="author" content="<?php echo htmlspecialchars($config['app']['name']); ?>">
+    <meta name="robots" content="index, follow">
+    <meta name="theme-color" content="#200769">
+    
+    <!-- Open Graph Meta Tags -->
+    <meta property="og:title" content="<?php echo htmlspecialchars($config['app']['name']); ?> - Empowering Future Leaders">
+    <meta property="og:description" content="Premier educational institution in Chilaw, Sri Lanka. Join us in our mission to empower minds and inspire futures.">
+    <meta property="og:image" content="<?php echo htmlspecialchars($config['branding']['logo_primary']); ?>">
+    <meta property="og:url" content="<?php echo htmlspecialchars($config['app']['base_url']); ?>">
+    <meta property="og:type" content="website">
+    <meta property="og:site_name" content="<?php echo htmlspecialchars($config['app']['name']); ?>">
+    
+    <!-- Twitter Card Meta Tags -->
+    <meta name="twitter:card" content="summary_large_image">
+    <meta name="twitter:title" content="<?php echo htmlspecialchars($config['app']['name']); ?> - Empowering Future Leaders">
+    <meta name="twitter:description" content="Premier educational institution in Chilaw, Sri Lanka.">
+    <meta name="twitter:image" content="<?php echo htmlspecialchars($config['branding']['logo_primary']); ?>">
+    
+    <!-- Canonical URL -->
+    <link rel="canonical" href="<?php echo htmlspecialchars($config['app']['base_url']); ?>">
+    
     <title><?php echo htmlspecialchars($config['app']['name']); ?></title>
-    <meta name="keywords" content="">
-    <meta name="description" content="">
-    <meta name="author" content="">
+    
+    <!-- Favicon and Icons -->
     <link rel="icon" href="<?php echo htmlspecialchars($config['branding']['logo_mark']); ?>" type="image/png" />
+    <link rel="apple-touch-icon" href="<?php echo htmlspecialchars($config['branding']['logo_mark']); ?>">
+    <link rel="manifest" href="/manifest.json">
+    
+    <!-- Preconnect to external domains -->
+    <link rel="preconnect" href="https://fonts.googleapis.com">
+    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
+    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
+    
+    <!-- Critical CSS (inline for performance) -->
+    <style>
+        <?php include 'css/critical-inline.css'; ?>
+    </style>
+    
+    <!-- Non-critical CSS (async loading) -->
+    <link rel="preload" href="css/modern-theme.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
+    <link rel="preload" href="css/enhanced-responsive.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
+    <noscript>
+        <link rel="stylesheet" href="css/modern-theme.css">
+        <link rel="stylesheet" href="css/enhanced-responsive.css">
+    </noscript>
+    
+    <!-- Legacy CSS for fallback -->
     <link rel="stylesheet" href="css/bootstrap.min.css">
-    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
-    <link rel="stylesheet"
-        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
     <link rel="stylesheet" href="css/style.css">
     <link rel="stylesheet" href="css/responsive.css">
-    <link rel="preconnect" href="https://fonts.googleapis.com">
-    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
-    <link
-        href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
-        rel="stylesheet">
-    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
+    
+    <!-- Modern Fonts -->
+    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
+    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
+    
+    <!-- Custom Scrollbar and Effects -->
     <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
-    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
-        media="screen">
+    
+    <!-- Structured Data -->
+    <script type="application/ld+json">
+    {
+        "@context": "https://schema.org",
+        "@type": "EducationalOrganization",
+        "name": "<?php echo htmlspecialchars($config['app']['name']); ?>",
+        "url": "<?php echo htmlspecialchars($config['app']['base_url']); ?>",
+        "logo": "<?php echo htmlspecialchars($config['branding']['logo_primary']); ?>",
+        "description": "Premier educational institution in Chilaw, Sri Lanka, committed to academic excellence and character development since 1950.",
+        "address": {
+            "@type": "PostalAddress",
+            "streetAddress": "<?php echo htmlspecialchars($config['contact']['address']['line1']); ?>",
+            "addressLocality": "Chilaw",
+            "addressCountry": "Sri Lanka"
+        },
+        "telephone": "<?php echo htmlspecialchars($config['contact']['phone_numbers'][0]); ?>",
+        "email": "<?php echo htmlspecialchars($config['contact']['emails'][0]); ?>",
+        "foundingDate": "1950-05-12",
+        "sameAs": [
+            "https://www.facebook.com/anandacollegechilawofficial"
+        ],
+        "hasOfferCatalog": {
+            "@type": "OfferCatalog",
+            "name": "Educational Programs",
+            "itemListElement": [
+                {
+                    "@type": "Offer",
+                    "itemOffered": {
+                        "@type": "Course",
+                        "name": "Secondary Education",
+                        "description": "Comprehensive secondary education program"
+                    }
+                }
+            ]
+        }
+    }
+    </script>