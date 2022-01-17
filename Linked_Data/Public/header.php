<?php

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Home</title>
    <link rel="stylesheet" href="/Public/css/main.css"/>
</head>
<body>
<div class="banner">
    <div class="navbar">
        <a href="index.php"><img src="img/logo.png" class="logo" /></a>
        <ul>
            <li><a class='btn' href="index.php"">home</a></li>
            <li><a class='btn' href="data.php">Data</a></li>
            <div class="dropdown">
                <button type="button" class="btn dropdown-toggle text-white" data-bs-toggle="dropdown" style="font-size: 20px">
                    JSON-LD RDF Data
                </button>
                <ul class="dropdown-menu bg-dark">
                    <li><a class="dropdown-item" href="#">GP visits</a></li>
                    <li><a class="dropdown-item" href="#">Female Life Expectancy</a></li>
                    <li><a class="dropdown-item" href="#">Male Life Expectancy</a></li>
                </ul>
            </div>
        </ul>
    </div>
</div>
</html>