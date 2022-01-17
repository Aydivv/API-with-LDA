<div class="bg">
    <?php
    include_once 'header.php';
    ?>
    <body>
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        .bg {
            background-image: url("img/wall.jpg");
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
    <div class="content">
        <div>
            <h1>WELCOME</h1>
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

        </div>
    </div>
    <style>
        .footer{
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            color: white;
            text-align: center;
            font-size: 15px;
            text-transform: capitalize;
        }
    </style>
    <div class='footer'>
        <span>Copyright © 2022 School of Engineering, Computing & Mathematics with University of Plymouth. All rights reserved.</span>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</div>
</body>
</html>

