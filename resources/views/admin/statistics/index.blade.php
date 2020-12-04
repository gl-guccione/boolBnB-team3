@extends ('layouts.app')

@section('pageName', 'admin_statistics_index')

@section('content')

  <h1>Statistiche</h1>

  <h3>Visite totali di tutti i tuoi appartamenti: {{ $total_views }}</h3>
  <h3>Visite di oggi di tutti i tuoi appartamenti: {{ $today_views }}</h3>

  {{-- including chart.js --}}
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
  {{-- /including chart.js --}}

  {{-- canvas --}}

  <div class="container">
    <div class="row">
      <canvas id="viewsChart" style="width: 100%; height: 300px"></canvas>
    </div>
  </div>

  {{-- /canvas --}}

  {{-- script for generate the chart --}}
  <script>
    var ctx = document.getElementById('viewsChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['{{ $days_names[6] }}', '{{ $days_names[5] }}', '{{ $days_names[4] }}', '{{ $days_names[3] }}', '{{ $days_names[2] }}', '{{ $days_names[1] }}', '{{ $days_names[0] }}'],
            datasets: [{
                label: 'visite',
                data: [{{ $six_days_before_views }}, {{ $five_days_before_views }}, {{ $four_days_before_views }}, {{ $three_days_before_views }}, {{ $two_days_before_views }}, {{ $one_day_before_views }}, {{ $today_views }}],
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