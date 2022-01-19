<div class="bg">
    <?php
    include_once 'header.php';
    ?>
    <body>
    <style>
        body {
            background-image: url('img/wallpaperindex.jpg');
            background-size: cover;
        }
        h1{
            color:aliceblue;
        }
    </style>

    <div class="container-fluid">
        <div class="row justify-content-center align-self-center">
            <p style="padding-top: 80px; font-size: 35px;"><strong>WELCOME</strong></p>
            <p><strong>Everyone wants to know how to live longer.</strong>
                <br> The purpose of this website is to find out how we can live past our life expectancy.
                <br>I used datasets about people in plymouth to figure out what affects
                <br>life expectancy and why some people live longer than others.</p>
            <p>
                <br>This website uses two datasets with three csv files.
                <br>You can find them below:
                <br><a href="https://plymouth.thedata.place/dataset/life-expectancy-plymouth"><u>Life Expectancy in Plymouth</u></a>
                <br><a href="https://plymouth.thedata.place/dataset/gender-age-all-visits-plymouth/resource/1b95bf56-00e6-4ea5-aa5f-13d6d0decf5a"><u>Visits to the GP</u></a>
            </p>
            <p style="padding-bottom: 80px">For use in machine to machine communication you can find the JSON-LD RDF formatted data <a href="../LifeExpectancy"><u>here</u></a>.</p>
    </div>

<?php
include_once 'footer.php' ?>



