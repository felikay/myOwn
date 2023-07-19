<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin panel</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="{{asset('css/admin_style.css')}}">
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

@include('adminHeader');
<body>
<div style="display: flex; justify-content: center; margin-top: 50px;">
    <div style="display: flex; flex-direction: column; align-items: center;">
        <canvas id="myChart" width="400" height="400"></canvas>
        <h2 style="text-align: center; margin-top: 20px;">User Types</h2>
    </div>

    <div style="display: flex; margin-left: 15px;">
        <div style="display: flex; flex-direction: column; align-items: center;">
            <h2 style="text-align: center; margin-bottom: 20px;">Top 7 Highest Sold Arts</h2>
            <canvas id="postedChart" width="400" height="400"></canvas>
        </div>
        <div style="display: flex; flex-direction: column; align-items: center; margin-left: 15px;">
            <h2 style="text-align: center; margin-bottom: 20px;">Top 7 arts on demand</h2>
            <canvas id="bidsChart" width="400" height="400"></canvas>
        </div>
    </div>
</div>

<script>
    // Fetch the data from the backend
    var chartData = {!! json_encode($chartData) !!};
    var postedLabels = {!! json_encode($postedLabels) !!};
    var postedPrices = {!! json_encode($postedPrices) !!};
    var postedColors = {!! json_encode($postedColors) !!};
    var bidsLabels = {!! json_encode($bidsLabels) !!};
    var bidsCount = {!! json_encode($bidsCount) !!};
    var bidsPrices = {!! json_encode($bidsPrices) !!};
    var bidsColors = {!! json_encode($bidsColors) !!};

    // Extract the labels and counts
    var labels = Object.keys(chartData);
    var counts = Object.values(chartData);

    // Create the pie chart
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                data: counts,
                backgroundColor: ['#5752a1', '#904e49', '#75a152']
            }]
        },
        options: {
            responsive: false,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'User Types',
                    font: {
                        size: 16,
                        weight: 'bold'
                    }
                }
            },
            legend: {
                display: true,
                position: 'right'
            }
        }
    });

    // Prepare the dataset for the posted chart
    var postedDataset = {
        labels: postedLabels,
        datasets: [{
            data: postedPrices,
            borderColor: '#000',
            borderWidth: 2,
            fill: true,
            backgroundColor: 'rgba(255, 255, 255, 1)',
            pointBackgroundColor: '#000',
            pointRadius: 5,
            pointHoverRadius: 8
        }]
    };

    // Create the posted chart
    var ctxPosted = document.getElementById('postedChart').getContext('2d');
    var postedChart = new Chart(ctxPosted, {
        type: 'line',
        data: postedDataset,
        options: {
            responsive: false,
            maintainAspectRatio: false,
            legend: {
                display: false,
            },
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Product Name',
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    }
                },
                y: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Reserve Price',
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    },
                    ticks: {
                        color: '#000',
                        beginAtZero: true,
                    },
                    grid: {
                        color: '#fff',
                        lineWidth: 2
                    }
                }
            }
        }
    });

    // Prepare the dataset for the bids chart
    var bidsDataset = {
        labels: bidsLabels,
        datasets: [{
            data: bidsCount,
            backgroundColor: '#032027',
            borderColor: 'grey',
            borderWidth: 2,
            hoverBackgroundColor: '#ff0000',
            hoverBorderColor: '#000'
        }]
    };

    // Create the bids chart
    var ctxBids = document.getElementById('bidsChart').getContext('2d');
    var bidsChart = new Chart(ctxBids, {
        type: 'bar',
        data: bidsDataset,
        options: {
            responsive: false,
            maintainAspectRatio: false,
            legend: {
                display: false,
            },
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Product Name',
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    },
                    ticks: {
                        color: '#000'
                    },
                    grid: {
                        color: '#fff',
                        lineWidth: 2
                    }
                },
                y: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Number of Bids',
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    },
                    ticks: {
                        color: '#000',
                        beginAtZero: true,
                    },
                    grid: {
                        color: '#fff',
                        lineWidth: 2
                    }
                }
            }
        }
    });
</script>
</body>
</html>
