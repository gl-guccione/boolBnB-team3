@extends ('layouts.app')

@section('pageName', 'admin_statistics_index')

@section('content')
  {{-- including chart.js --}}
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
  {{-- /including chart.js --}}

  {{-- canvas --}}
  <div>
    <canvas id="viewsChart" width="400" height="400"></canvas>
  </div>
  {{-- /canvas --}}

  {{-- script for generate the chart --}}
  <script>
    var ctx = document.getElementById('viewsChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: 'visualizzazioni',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
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
  {{-- /script for generate the chart --}}

@endsection