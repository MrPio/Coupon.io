<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div>
    <h2>Della seguente promozione sono stati acquisiti in totale {{$promotion->acquired}} coupon.</h2>
    <canvas id="myChart" class="canvas"></canvas>

</div>

<script>
    var daysOfWeek = [
        'Domenica',
        'Lunedì',
        'Martedì',
        'Mercoledì',
        'Giovedì',
        'Venerdì',
        'Sabato'
    ];

    // Ottenere la data odierna
    var today = new Date();

    // Creare un array di etichette con i giorni della settimana precedente
    var labels = [];
    for (var i = 0; i <7; i++) {
        var day = new Date(today);
        day.setDate(today.getDate() - i);
        var dayOfWeekIndex = day.getDay(); // Ottenere l'indice del giorno della settimana
        labels.push(daysOfWeek[dayOfWeekIndex]);
    }
    labels[0]="Oggi";
    labels[1]="Ieri";
    labels.push("Altro");

    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
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
