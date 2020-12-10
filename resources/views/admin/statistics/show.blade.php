@extends ('layouts.app')

@section('pageName', 'admin_statistics_index')

@section('content')

  <div class="container py-4">

    <div class="hero py-4">
      <img class="hero__image py-4" src="{{ asset('img/statistics/show.svg') }}" alt="statistics image">
      <h1 class="hero__title py-4">Statistiche dell'appartamento {{ $flat->title }}</h1>
    </div>

    <h3 class="pt-3 pb-1">Visite totali: {{ $total_views }}</h3>
    <h3 class="pb-4">Visite di oggi: {{ $today_views }}</h3>

    <h3 class="pt-4"> <i class="fas fa-chart-area"></i> Visite settimanali: {{ $last_seven_days_views }}</h3>

  {{-- canvas for chart.js --}}
    <div class="row chart_container">
      <canvas id="viewsChart" style="width: 100%; height: 400px"></canvas>
    </div>
  {{-- /canvas for chart.js --}}

  </div>

@endsection

@section('footerScript')

  {{-- including chart.js --}}
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
  {{-- /including chart.js --}}

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
                backgroundColor: 'rgba(255, 255, 255, 0.0)',
                borderColor: '#29B06F',
                borderWidth: 5
            }]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        precision: 0
                    }
                }]
            }
        }
    });
  </script>
  {{-- /script for generate the chart --}}

@endsection