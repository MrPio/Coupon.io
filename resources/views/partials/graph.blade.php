<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div>
    <h2>Della seguente promozione sono stati acquisiti in totale {{$promotion->acquired}} coupon.</h2>
    <canvas id="myChart" class="canvas"></canvas>

</div>

<script>
    var Time = [
        'Più di un anno',
        'Quest\'anno',
        'Questo mese',
        'Questa settimana',
        'Oggi',
    ];

    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: Time,
            datasets: [{
                label: 'Coupon acquisiti',
                data: {{$coupons}},
                backgroundColor: 'rgba(117,76,180,0.6)',
                borderColor: 'rgb(40,40,40)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });</script>
