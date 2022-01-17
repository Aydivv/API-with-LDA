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
            background-image: url('img/wall2.jpg');
            background-size: cover;
        }
        h1{
            color:aliceblue;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col">
                <h2><strong>Introduction</strong></h2>
                <br>
                <p>Most people know that women generally live longer than men. Is that just a saying or is it proven by stats?
                    If it is true, what do women do differently that allows them to live longer? Let's find out by using data from the city of Plymouth.</p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <canvas id="LEChart"></canvas>
            </div>
        </div>
        <div class="row">
            <p>As we can see, the average woman in Plymouth lives 4 years longer than the average man. That is a very long period of time. Now what I wanted to find out is why is that? There could be many reasons. It could be due to
            differences in physical health, the ability to take care of oneself or it could also be mental health. The most logical reason is probably physical health. I could not find a direct metric about physical health in Plymouth with regards to gender, but I did find
            data on how many times a year people go to their GP and I found something very interesting. Let's look at the data.</p>
        </div>
        <div class="row">
            <div class="col">
                <canvas id="VisitsChart"></canvas>
            </div>
        </div>
        <div class="row">
            <p>Here we can see that during the time when humans start to get independent and start to take care of themselves (Age 15-24) women go to the GP a lot more than men. This means they
            take care of their body and go get help when it needs help but men on the other hand do not go to the GP and as a result have to go to the GP a lot more often later in life(Age 75-90). This
            also leads to them having a lower life expectancy.</p>
        </div>
        <div class="row  tablerow">
            <h2><strong>Conclusion</strong></h2>
            <p>
                There it is. Want to live longer? Just go to the GP more often, listen to your body and take care of your body. Simple as that.
            </p>
            <br>

            <p>Disclaimer: I do not claim this is right, I know correlation does not mean cause. This is just for fun.</p>
            <br>
            <p>The raw data used for these graphs can be found below.</p>
        </div>
        <div class="row">
            <h2><strong>Male Life Expectancy</strong></h2>
        </div>
        <div class="row  tablerow">
            <div class="col">
                <table class="table border">
                    <thead class="thead-light bg-light">
                    <tr>
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
                    $MaleLE = [];
                    $LEs = $getter->getLE('../data/lifeExpectancyMale.csv');
                    if($LEs)
                    {
                        foreach($LEs as $row)
                        {
                            $HTML .= '<tr class="thead-dark" style="color: white;">';
                            $HTML .= "<td>".$row->getWardCode()."</td>";
                            $HTML .= "<td>".$row->getWards()."</td>";
                            $HTML .= "<td>".$row->getLE()."</td>";
                            $HTML .= "<td>".$row->getLCL()."</td>";
                            $HTML .= "<td>".$row->getUCL()."</td>";
                            $HTML .= "</tr>";
                            $MaleLE[] = $row->getLE();
                        }
                    }
                    echo $HTML;
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <h2><strong>Female Life Expectancy</strong></h2>
        </div>
        <div class="row tablerow">
            <div class="col">
                <table class="table border">
                    <thead class="thead-light bg-light">
                    <tr>
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
                    $FemaleLE = [];
                    $Wards = [];
                    $LEs = $getter->getLE('../data/lifeExpectancyFemale.csv');
                    if($LEs)
                    {

                        foreach($LEs as $row)
                        {
                            $HTML .= '<tr class="thead-dark" style="color: white;">';
                            $HTML .= "<td>".$row->getWardCode()."</td>";
                            $HTML .= "<td>".$row->getWards()."</td>";
                            $HTML .= "<td>".$row->getLE()."</td>";
                            $HTML .= "<td>".$row->getLCL()."</td>";
                            $HTML .= "<td>".$row->getUCL()."</td>";
                            $HTML .= "</tr>";
                            $Wards[] = $row->getWards();
                            $FemaleLE[] = $row->getLE();
                        }
                    }
                    echo $HTML;
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <h2><strong>GP Visits</strong></h2>
        </div>
        <div class="row  tablerow">
            <div class="col">
                <table class="table border">
                    <thead class="thead-light bg-light">
                    <tr>
                        <th> Age Group </th>
                        <th> Female </th>
                        <th> Male </th>
                        <th> Total </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $HTML = "";
                    $Ages  = [];
                    $MaleVisits = [];
                    $FemaleVisits = [];
                    $visits = $getter->getVisits();
                    if($visits)
                    {
                        foreach($visits as $row)
                        {
                            $HTML .= '<tr class="thead-dark" style="color: white;">';
                            $HTML .= "<td>".$row->getAgeGroup()."</td>";
                            $HTML .= "<td>".$row->getFemale()."</td>";
                            $HTML .= "<td>".$row->getMale()."</td>";
                            $HTML .= "<td>".$row->getTotal()."</td>";
                            $HTML .= "</tr>";
                            $Ages[] = $row->getAgeGroup();
                            $FemaleVisits[] = $row->getFemale();
                            $MaleVisits[] = $row->getMale();
                        }
                    }
                    echo $HTML;
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('LEChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($Wards)?>,
            datasets: [{
                label: 'Male Life Expectancy',
                data: <?php echo json_encode($MaleLE)?>,
                backgroundColor: [
                    'rgba(0,255,255, 0.2)'
                ],
                borderColor: [
                    'rgba(0,255,255, 1)'
                ],
                borderWidth: 1
            },{
                label: 'Female Life Expectancy',
                data: <?php echo json_encode($FemaleLE)?>,
                backgroundColor: [
                    'rgb(255,182,193, 0.2)'
                ],
                borderColor: [
                    'rgb(255,182,193, 1)'
                ],
                borderWidth: 1,
            }]
        },
        options: {
            showLines: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Life Expectancy in Plymouth by Ward',
                    color: '#FFFFFF'
                }
            },
            scales: {
                x: {
                    title: {
                        color: '#FFFFFF',
                        display: true,
                        text: 'Wards'
                    },
                    ticks: {
                        color: 'white',
                    },
                    grid:{
                        color:'rgba(255,255,255,0.2)'
                    }
                },
                y: {
                    title: {
                        color: '#ffffff',
                        display: true,
                        text: 'Years'
                    },
                    ticks: {
                        color: 'white',
                    },
                    grid:{
                        color:'rgba(255,255,255,0.2)'
                    }
                }
            }
        }
    });
</script>

<script>
    const ctx2 = document.getElementById('VisitsChart').getContext('2d');
    const myChart2 = new Chart(ctx2, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($Ages)?>,
            datasets: [{
                label: "Male visits",
                data: <?php echo json_encode($MaleVisits)?>,
                backgroundColor: [
                    'rgba(0,255,255, 0.2)'
                ],
                borderColor: [
                    'rgba(0,255,255, 1)'
                ],
                borderWidth: 1
            },{
                label: 'Female Visits',
                data: <?php echo json_encode($FemaleVisits)?>,
                backgroundColor: [
                    'rgb(255,182,193, 0.2)'
                ],
                borderColor: [
                    'rgb(255,182,193, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Average visits to GP per year',
                    color: '#FFFFFF'
                }
            },
            scales: {
                x: {
                    title: {
                        color: '#FFFFFF',
                        display: true,
                        text: 'Age Group'
                    },
                    ticks: {
                        color: 'white',
                    },
                    grid: {
                        color: 'rgba(255,255,255,0.2)'
                    }
                },
                y: {
                    title: {
                        color: '#ffffff',
                        display: true,
                        text: 'Visits per year'
                    },
                    ticks: {
                        color: 'white',
                    },
                    grid: {
                        color: 'rgba(255,255,255,0.2)'
                    }
                }
            }
        }
    });


</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php
include_once 'footer.php' ?>
