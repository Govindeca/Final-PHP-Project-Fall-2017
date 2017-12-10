<?php
require_once("config.php");
require_once("header.php");
?>
<html>
<head>
    <link rel="stylesheet" href="style-2.css" />

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>



<div class="sidenav">
        <div id='wrapper'>
            <div id='content'>

                    <?php include("left-nav.php"); ?>

            </div>
        </div>
</div>

<div class="content">
    <div class="img w3-display-container">

                <img class="mySlides" src="themes/images/2.jpg" style="width:100%">
                <img class="mySlides" src="themes/images/3.jpg" style="width:100%">
                <img class="mySlides" src="themes/images/5.jpg" style="width:100%">
                <img class="mySlides" src="themes/images/6.jpg" style="width:100%">
                <img class="mySlides" src="themes/images/7.jpg" style="width:100%">
                <img class="mySlides" src="themes/images/4.jpg" style="width:100%">
                <img class="mySlides" src="themes/images/8.jpg" style="width:100%">
                <img class="mySlides" src="themes/images/9.jpg" style="width:100%">

                <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
                <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>

</div>

</div>

<!-- Footer -->
<div class="footer">
    <p>Digital restaurant ! <a href="index.php" class="w3-hover-text-green">Taste of India</a></p>
</div>

</body>
</html>




<script>
    var slideIndex = 1;
    showDivs(slideIndex);

    function plusDivs(n) {
        showDivs(slideIndex += n);
    }

    function showDivs(n) {
        var i;
        var x = document.getElementsByClassName("mySlides");
        if (n > x.length) {slideIndex = 1}
        if (n < 1) {slideIndex = x.length}
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        x[slideIndex-1].style.display = "block";
    }

</script>

