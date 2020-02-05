@extends('layouts.app')

@section('content')
    <canvas id="myChart" width="400" height="400"></canvas>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>

    <h3 class="text-center">Valeur du Bitcoin des 30 derniers jours</h3>
    <div class="d-flex justify-content-right align-items-center flex-row">
        <ul class="list-group">
            @for ($today=0; $today<=30; $today++)
                <li class="list-group-item">{{date('d-m-Y', strtotime('today - '.$today.' days'))}}</li>
            @endfor

        </ul>
        <ul class="list-group">
            @foreach($response as $item)
                <li class="list-group-item">{{$item->close}} €</li>
            @endforeach
        </ul>
    </div>

@endsection
