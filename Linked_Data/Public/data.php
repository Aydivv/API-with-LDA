<?php

include_once 'header.php';
include_once '../src/model/DataAccess.php';
include_once '../src/model/GPvisit.php';
include_once '../src/model/LifeExpectancy.php';

if(!isset($getter)){
    $getter = new DataAccess();
}

?>
    <style>
        body {
            background-color: black;
            background-size: cover;
        }

        .container-fluid{
            border: 1px solid #ffffff;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col">
                <table class="table">
                    <thead>
                    <tr class="table-dark">
                        <th>Ward Code</th>
                        <th>Wards</th>
                        <th>Life Expectancy</th>
                        <th>Lower Confidence Limit</th>
                        <th>Higher Confidence Limit</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $HTML = "";
                    $LEs = $getter->getLE('../data/lifeExpectancyMale.csv');
                    if($LEs)
                    {
                        foreach($LEs as $row)
                        {
                            $HTML .= '<tr class="table-dark">';
                            $HTML .= "<td>".$row->getWardCode()."</td>";
                            $HTML .= "<td>".$row->getWards()."</td>";
                            $HTML .= "<td>".$row->getLE()."</td>";
                            $HTML .= "<td>".$row->getLCL()."</td>";
                            $HTML .= "<td>".$row->getUCL()."</td>";
                            $HTML .= "</tr>";
                        }
                    }
                    echo $HTML;
                    ?>
                    </tbody>
                </table>
            </div>

        </div>
        <div class="row">
            <div class="col">
                <table class="table">
                    <thead>
                    <tr class="table-dark">
                        <th>Ward Code</th>
                        <th>Wards</th>
                        <th>Life Expectancy</th>
                        <th>Lower Confidence Limit</th>
                        <th>Higher Confidence Limit</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $HTML = "";
                    $LEs = $getter->getLE('../data/lifeExpectancyFemale.csv');
                    if($LEs)
                    {

                        foreach($LEs as $row)
                        {
                            $HTML .= '<tr class="table-dark">';
                            $HTML .= "<td>".$row->getWardCode()."</td>";
                            $HTML .= "<td>".$row->getWards()."</td>";
                            $HTML .= "<td>".$row->getLE()."</td>";
                            $HTML .= "<td>".$row->getLCL()."</td>";
                            $HTML .= "<td>".$row->getUCL()."</td>";
                            $HTML .= "</tr>";
                        }
                    }
                    echo $HTML;
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table">
                    <thead>
                    <tr class="table-dark">
                        <th> Age Group </th>
                        <th> Female </th>
                        <th> Male </th>
                        <th> Total </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $HTML = "";
                    $visits = $getter->getVisits();
                    if($visits)
                    {
                        foreach($visits as $row)
                        {
                            $HTML .= '<tr class="table-dark">';
                            $HTML .= "<td>".$row->getAgeGroup()."</td>";
                            $HTML .= "<td>".$row->getFemale()."</td>";
                            $HTML .= "<td>".$row->getMale()."</td>";
                            $HTML .= "<td>".$row->getTotal()."</td>";
                            $HTML .= "</tr>";
                        }
                    }
                    echo $HTML;
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


<?php
include_once 'footer.php' ?>
