<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Custom Right-Click Menu</title>
  <!-- <link rel="stylesheet" href="style.css"> </head> -->
  <style>
    #customMenu {
      background-color: #f2f2f2;
      padding: 5px;
      border: 1px solid #ddd;
      position: absolute;
      /* Menu positioning will be handled by JavaScript */
      display: none;
      /* Initially hidden */
    }

    #customMenu li {
      list-style: none;
      margin-bottom: 5px;
    }

    #customMenu li a {
      text-decoration: none;
      color: black;
    }
  </style>

<body>
  <p>Right-click anywhere on this page to see the custom menu.</p>

  <div id="customMenu " style="display: none;border-radius: 5px;">
    <ul style="justify-content: center;align-items: center;">
      <li>Inspect Element</li>
      <li><a href="#">Copy Link</a></li>
      <li>Save Image (if applicable)</li>
    </ul>
  </div>

  <!-- <script src="script.js"></script>  -->
  <script>
    document.addEventListener('contextmenu', function (event) {
      event.preventDefault();

      // Get mouse click coordinates
      const posX = event.pageX;
      const posY = event.pageY;

      // Position the menu slightly below the click position
      const menu = document.getElementById("customMenu");
      menu.style.top = posY + 5 + "px"; // Add some offset for better placement
      menu.style.left = posX + 5 + "px";

      // Make the menu visible
      menu.style.display = "block";
    });

    document.addEventListener('click', function () {
      const menu = document.getElementById("customMenu");
      menu.style.display = "none";
    });

  </script>
</body>

</html>