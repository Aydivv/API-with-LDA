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
                <p>Most people know that women generally live longer than men. Is that just a saying or is it proven by statistics?
                    If it is true, what do women do differently that leads to them having a longer lifespan? Let's find out by using data from the city of Plymouth.</p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <canvas id="LEChart"></canvas>
            </div>
        </div>
        <div class="row">
            <p>As we can see, the average woman in Plymouth lives 4 years longer than the average man. That is a very long period of time. This can be attributed to several reasons. It could be due to
            differences in physical health, the ability to take care of oneself or it could also be mental health. The most logical reason is probably physical health. A direct metric about physical health in Plymouth with regards to gender could not be found, however something that is very interesting is
            the data on how many times a year people go to their GP.</p>
        </div>
        <div class="row">
            <div class="col">
                <canvas id="VisitsChart"></canvas>
            </div>
        </div>
        <div class="row">
            <p>From observing the above graph, it is clear that Females start to seek more medical help than males once they reach adolosnce. This is not because females
                need more medical attention than males, but simply because men associate seeking help with weakness, as they are conditioned to do so from early childhood.
                Males overtake females in seeking medical help at the age of 75-90 which means they only seek help when they desperately have to;
                but as prevention is better than cure, this trend in the males might cause them to have a shorter life span than their female counterparts.</p>
        </div>
        <div class="row  tablerow">
            <h2><strong>Conclusion</strong></h2>
            <p>
                There it is. Want to live longer? Just go to the GP more often, listen to your body and take care of your body. Simple as that.
            </p>
            <br>

            <p>You can read more about this <a href="https://ourworldindata.org/why-do-women-live-longer-than-men"><u>here</u></a>.</p>
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
