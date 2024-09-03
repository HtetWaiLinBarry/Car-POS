<!DOCTYPE HTML>
<head>
<title>Classic White</title>
<meta charset="utf-8">
<!-- Google Fonts -->
<link href='http://fonts.googleapis.com/css?family=Parisienne' rel='stylesheet' type='text/css'>
<!-- CSS Files -->
<link rel="stylesheet" type="text/css" media="screen" href="css/styles.css">
<link rel="stylesheet" type="text/css" media="screen" href="menu/css/simple_menu.css">
<!-- Contact Form -->
<link href="contact-form/css/styles.css" media="screen" rel="stylesheet" type="text/css">
<link href="contact-form/css/uniform.css" media="screen" rel="stylesheet" type="text/css">
<!-- JS Files -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script src="js/jquery.tools.min.js"></script>
<script>
$(function () {
    $("#prod_nav ul").tabs("#panes > div", {
        effect: 'fade',
        fadeOutSpeed: 400
    });
});
</script>
<script>
$(document).ready(function () {
    $(".pane-list li").click(function () {
        window.location = $(this).find("a").attr("href");
        return false;
    });
});
</script>
</head>
<body>
<div class="header">
  <div id="site_title"><a href="CustomerHome.php"><a href="CustomerHome.php"><h2>TSM</h2></a></div>
  <!-- Main Menu -->
  <ol id="menu">
    <li class="active_menu_item"><a href="CustomerHome.php">Home</a>
      <!-- sub menu -->
      <ol>
        <li><a href="CustomerHome.php">HOME</a></li>
        <li><a href="CustomerTools.php">TOOLS</a></li>
        <li><a href="ShoppingCart.php">CART</a></li>
      </ol>
    </li>
    <!-- END sub menu -->
    <li><a href="#">Popular Pages</a>
      <!-- sub menu -->
      <ol>
        <li><a href="ShoppingCart.php">Shopping Cart</a></li>
        <li><a href="CustomerRegister.php">Register</a></li>
        <li><a href="CustomerLogout.php">Log Out</a></li>
        <li><a href="CarDisplay.php">Vehicle Display</a></li>
      </ol>
    </li>
    <!-- END sub menu -->
    <li><a href="AboutUs.php">About Us</a></li>
    <li><a href="Galleries.php">Galleries</a>
      <!-- sub menu -->
      <ol>
        <li><a href="gallery-simple.html">Simple</a></li>
        <li><a href="portfolio.html">Filterable</a></li>
        <li><a href="gallery-fader.html">Fade Scroll</a></li>
        <li><a href="video.html">Video</a></li>
        <li class="last"><a href="photogrid.html">PhotoGrid</a></li>
      </ol>
    </li>
  </ol>
</div>
</body>
</html>