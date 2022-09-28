@extends('admin.layout.master')

@section('content')
<div class="row">
    <div class="col-3">
        <div class="card bg-warning d-flex justify-content-center align-items-center">
            Today Income
            <span>{{$todayIncome}} ks</span>
        </div>
    </div>
    <div class="col-3">
        <div class="card bg-warning d-flex justify-content-center align-items-center">
            Today Outcome
            <span>{{$todayOutcome}}ks</span>
        </div>
    </div>
    <div class="col-3">
        <div class="card bg-warning d-flex justify-content-center align-items-center">
            User Count
            <span>{{$userCount}}</span>
        </div>
    </div>
    <div class="col-3">
        <div class="card bg-warning d-flex justify-content-center align-items-center">
            Total Order
            <span>{{$orderCount}}</span>
        </div>
    </div>
</div>

<div class="row">
    {{-- sale chart --}}
    <div class="col-6">
        <canvas id="sale"></canvas>
    </div>

    {{-- income outcome --}}
    <div class="col-6">
        <canvas id="inout"></canvas>
    </div>
</div>

@endsection


@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = @json($saleMonths)

  const saleData = {
    labels: labels,
    datasets: [{
      label: 'အရောင်းပိုင်း',
      backgroundColor: 'rgb(255, 99, 132)',
      borderColor: 'rgb(255, 99, 132)',
      data: @json($saleData),
    }]
  };

  const config = {
    type: 'line',
    data: saleData,
    options: {}
  };

  const myChart = new Chart(
    document.getElementById('sale'),
    config
  );


// income outcome chart
const inoutLabel = @json($dayList)

const inoutData = {
  labels: inoutLabel,
  datasets: [{
    label: 'ဝင်ငွေ',
    backgroundColor: 'rgb(255, 99, 132)',
    borderColor: 'rgb(255, 99, 132)',
    data: @json($incomeData),
  },
  {
    label: 'ထွက်ငွေ',
    backgroundColor: 'blue',
    borderColor: 'blue',
    data: @json($outcomeData),
  }]
};

const inoutConfig = {
  type: 'line',
  data: inoutData,
  options: {}
};

 new Chart(
  document.getElementById('inout'),
  inoutConfig
);


</script>
@endsection
