@extends('layouts.app')

@section('content')
    <h3 class="text-center">Valeur du {{$currency_api_id[0]->currency_name}} des 30 derniers jours</h3>
    <canvas id="myChart" width="400" height="400"></canvas>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($dates),
                datasets: [{
                    label: 'Prix en euro',
                    data: @json($currency_prices),
                    backgroundColor: 'rgba(97, 218, 251, 0.2)',
                    borderColor: 'rgba(97, 218, 251, 1)',
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

@endsection
