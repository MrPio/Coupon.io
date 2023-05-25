<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<canvas id="myChart" class="canvas"></canvas>


<script>

    //Da rendere dinamici
    var labels = ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'];
    var data = [12, 19, 3, 5, 2, 3];
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'My Dataset',
                data: data,
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
