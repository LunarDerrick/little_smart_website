<!DOCTYPE html>
<html lang="en">

<?php
require_once("init_db.php");
include_once "helper_list_score.php";
?>

<head>
    <title>Exam Analysis - Little Smart Day Care Centre</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Bootstrap implementation-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!--CSS overwrite-->
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/graph.css">
</head>

<body>
    <nav class="navbar navbar-expand navbar-light bg-custom">
        <a class="navbar-brand" href="index.html">
            <img src="media/logo.png" class="d-inline-block align-top" alt="day care centre logo">
        </a>

        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <b>
                <a class="nav-link" href="roster.php">ADMIN</a>
                </b>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="about.html">About Us</a>
        </ul>
    </nav>

    <section>
        <p id="PC">You are now viewing as <b>Computer</b>.</p>
        <p id="tablet">You are now viewing as <b>Tablet</b>.</p>
        <p id="mobile">You are now viewing as <b>Mobile Device</b>.</p>
        
        <button type="button" class="btn btn-primary mobile" onclick="document.location='roster.php'">Name List</button>
        <button type="button" class="btn btn-primary mobile" onclick="document.location='analysis.php'">Exam Analysis</button>
        <button type="button" class="btn btn-primary mobile" onclick="document.location='feedback.html'">Feedback Inbox</button>
        <button type="button" class="btn btn-primary mobile" onclick="document.location='list_post.html'">Edit Post</button>
        <button type="button" class="btn btn-primary mobile" onclick="document.location='index.html'">Logout</button>
        <h1>Exam Analysis</h1>
        <br>

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0">
                            <picture>
                                <canvas id="barchart_passingrate"></canvas>
                            </picture>
                            <div class="card-body">
                                <h6>Passing Rate of All Subjects</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0">
                            <picture>
                                <canvas id="piechart_gradescience"></canvas>
                            </picture>
                            <div class="card-body">
                                <h6>Grade Distribution for Science</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0">
                            <table id="table-graph">
                                <tr>
                                    <th>Name</th>
                                    <th>Subject</th>
                                    <th>Score</th>
                                </tr>
                                <?php
                                    [$list] = listScore($conn);
                                    buildScore($list);
                                ?>
                            </table>
                            <div class="card-body">
                                <h6>Top Scorer for Each Subject</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0">
                            <picture>
                                <canvas id="barchart_avgscore"></canvas>
                            </picture>
                            <div class="card-body">
                                <h6>Average Score of All Subjects</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>

    <br><br>

    <footer>
        <small><i>
            © 2024 Little Smart Day Care Centre
        </i></small>
    </footer>
    <br>

    <!-- jQuery library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <!-- JS chart library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0/chartjs-plugin-datalabels.min.js"></script>
    <!-- JavaScript files-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            showGraph();
        });

        const showGraph = () => {
            $.post("api_analysis.php", function(data) {
                // importing datalabel plugin
                Chart.register(ChartDataLabels);

                // debug test whether fetch the correct data
                // console.log(data);

                // Passing Rate Bar Chart
                const pass_rate = data["pass_data"];
                const pass_title = [].concat(...pass_rate.map(obj => Object.keys(obj)));
                const pass_value = [].concat(...pass_rate.map(obj => Object.values(obj)));
                pass_title.shift();
                const total = pass_value.shift();
                let pass = [];
                for (let i = 0; i < pass_value.length; i++) {
                    pass.push(pass_value[i] / total);
                }

                // draw vertical bar chart
                new Chart("barchart_passingrate", {
                    type: "bar",
                    data: {
                        labels: pass_title,
                        datasets: [{
                            backgroundColor: ["#fd7f6f", "#7eb0d5", "#b2e061", "#bd7ebe", "#ffb55a"],
                            data: pass
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    // Convert decimal to percentage
                                    label: function(tooltipItem) {
                                        var value = Math.round(tooltipItem.raw * 100); 
                                        return value + '%';
                                    }
                                }
                            },
                            datalabels: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                suggestedMin: 0, // Minimum value for the y-axis
                                suggestedMax: 1, // Maximum value for the y-axis
                                title: {
                                    display: true,
                                    text: 'Percentage(%)'
                                },
                                ticks: {
                                    // convert decimal to percentage
                                    callback: function(value, index, values) {
                                        return (value * 100) + '%';
                                    }
                                }
                            }
                        }
                    }
                });

                // Science Grade Pie Chart
                const science_count = data["gradescience_data"];
                const science_title = [].concat(...science_count.map(obj => Object.keys(obj)));
                const science_value = [].concat(...science_count.map(obj => Object.values(obj)));

                // draw pie chart
                new Chart("piechart_gradescience", {
                    type: "pie",
                    data: {
                        labels: science_title,
                        datasets: [{
                            backgroundColor: ["#0e6573", "#008e89", "#00b680", "#73da5d", "#e0f420",],
                            data: science_value
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                display: false,
                            },
                            datalabels: {
                                color: 'black',
                                labels: {
                                    title: {
                                        font: {
                                            weight: 'bold'
                                        }
                                    }
                                },
                                formatter: (value, ctx) => {
                                    let label = ctx.chart.data.labels[ctx.dataIndex];
                                    return label + ': ' + value;
                                }
                            }
                        }
                    }
                });

                const avg_score = data["avgscore_data"];
                const avg_title = [].concat(...avg_score.map(obj => Object.keys(obj)));
                const avg_value = [].concat(...avg_score.map(obj => Object.values(obj)));

                // draw vertical bar chart
                new Chart("barchart_avgscore", {
                    type: "bar",
                    data: {
                        labels: avg_title,
                        datasets: [{
                            backgroundColor: ["#fd7f6f", "#7eb0d5", "#b2e061", "#bd7ebe", "#ffb55a"],
                            data: avg_value
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    // round to nearest 1 decimal place
                                    label: function(tooltipItem) {
                                        var value = (Math.round(tooltipItem.raw * 10) /10).toFixed(1); 
                                        return value;
                                    }
                                }
                            },
                            datalabels: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                suggestedMin: 0, // Minimum value for the y-axis
                                suggestedMax: 100, // Maximum value for the y-axis
                                title: {
                                    display: true,
                                    text: "Score"
                                },
                            }
                        }
                    }
                });
            })
        }
    </script>
</body>

</html>