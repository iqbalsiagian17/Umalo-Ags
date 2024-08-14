@extends('layouts.admin.master')

@section('content')
    <div class="row">
    <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-round">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-icon">
              <div class="icon-big text-center icon-primary bubble-shadow-small">
                <i class="fas fa-users"></i>
              </div>
            </div>
            <div class="col col-stats ms-3 ms-sm-0">
              <div class="numbers">
                <p class="card-category">Customer</p>
                <h4 class="card-title">{{ $customerCount }}</h4> <!-- Display the customer count -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-round">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-icon">
              <div class="icon-big text-center icon-info bubble-shadow-small">
                <i class="fas fa-user-check"></i>
              </div>
            </div>
            <div class="col col-stats ms-3 ms-sm-0">
              <div class="numbers">
                <p class="card-category">Subscribers</p>
                <h4 class="card-title">1303</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-round">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-icon">
              <div class="icon-big text-center icon-success bubble-shadow-small">
                <i class="fas fa-luggage-cart"></i>
              </div>
            </div>
            <div class="col col-stats ms-3 ms-sm-0">
              <div class="numbers">
                <p class="card-category">Sales</p>
                <h4 class="card-title">$ 1,345</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-round">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-icon">
              <div class="icon-big text-center icon-secondary bubble-shadow-small">
                <i class="far fa-check-circle"></i>
              </div>
            </div>
            <div class="col col-stats ms-3 ms-sm-0">
              <div class="numbers">
                <p class="card-category">Order</p>
                <h4 class="card-title">{{ $orderCount }}</h4> <!-- Display the order count -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

        <!-- Statistik Pengunjung Hari Ini -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Jumlah Pengunjung Hari Ini</h4>
                </div>
                <div class="card-body">
                    <h3>{{ $visitorCountToday }}</h3>
                </div>
            </div>
        </div>

        <!-- Grafik Kunjungan Harian Berdasarkan Jam -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Statistik Kunjungan Harian Berdasarkan Jam</h4>
                </div>
                <div class="card-body">
                    <canvas id="hourlyVisitChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Waktu Kunjungan Rata-rata -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Waktu Kunjungan Rata-rata Hari Ini</h4>
                </div>
                <div class="card-body">
                    <h3>{{ gmdate('H:i:s', $averageVisitTimeToday) }}</h3>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('hourlyVisitChart').getContext('2d');
            var hourlyVisitChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [
                        // Labels untuk setiap jam
                        @foreach ($hourlyVisits->keys() as $hour)
                            "{{ $hour }}:00",
                        @endforeach
                    ],
                    datasets: [{
                        label: 'Jumlah Kunjungan',
                        data: [
                            @foreach ($hourlyVisits as $visits)
                                {{ $visits }},
                            @endforeach
                        ],
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Jam'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah Kunjungan'
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
