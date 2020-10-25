<!DOCTYPE html>
<html>
<head>
    <meta charset = "UTF-8">
    <meta name = "viewport" content="width = device-width, initial-scale = 1">
    <link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <title>MIMI ферма Оренда</title>
    <link rel="stylesheet" type = "text/css" href = "orenda_style.css">
    <link rel = "stylesheet"  type = "text/css" href="parallax.css">
    <div id = "logo">
        <a href="index.php"><img src="images/37702954_644400432593664_2638298895540551680_n.jpg"></a>
    </div>
   </head>
<body>
    <div id = "main-container">
        <h1>Mimi ферма Оренда</h1>

        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <a class="navbar-brand" href = "#">Начало</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class = "nav-item">
                        <a class = "nav-link" href="why_bio.html">Защо био?</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.html">Регистрация/Влез</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about_us.html">За нас</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://www.facebook.com/%D0%91%D0%B8%D0%BE-%D0%A4%D0%B5%D1%80%D0%BC%D0%B0-%D0%9E%D1%80%D0%B5%D0%BD%D0%B4%D0%B0-644396835927357/" target="_blank">За контакти</a>
                    </li>
                    <li class = "nav-item">
                        <input placeholder = "Търсене (на български)" class = "form-control col-2" type = "text"
                                name = "search" id = "search"/>
                        <span class = "list-group" id = "list"></span>
                    </li>
                </ul>
                <script src = search.js></script>
            </div>
        </nav>
    </div>

</body>
<div class = "parallax"></div>
<?php
include('orenda_cart.php');
?>
<section>
    <footer>
        </hr>
        <p>Био ферма Оренда <?php echo date('Y');?> &reg;</p>
    </footer>
</section>
</html>