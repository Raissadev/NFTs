<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
var options = {
  chart: {
    type: 'line',
    height: '300px',
    toolbar: {
        show: false,
    }
  },
  series: [{
    name: 'sales',
    data: [ <?php (new App\Models\Api\BlockchainMetrics)->graphics(); ?> ]
  }],
  xaxis: {
    categories: []
  },
  grid: {
    borderColor: '#342e57',
  },
  yaxis: {
    labels: {
        style: {
            colors: '#8f8e9a',
            fontSize: '12px',
            fontFamily: 'Inter, sans-serif',
            fontWeight: 500,
            cssClass: 'apexcharts-yaxis-label',
        },
    }
  },
  xaxis: {
    labels: {
        style: {
            colors: '#8f8e9a',
            fontSize: '12px',
            fontFamily: 'Inter, sans-serif',
            fontWeight: 500,
        },
    },
    axisBorder: {
        color: '#342e57',
    },
    axisTicks: {
        color: '#342e57',
    }
  },
  fill: {
    colors: ['#76b3ee', '#76b3ee'],
    type:'gradient',
    gradient: {
      shadeIntensity: 1,
      gradientToColors: 'black',
      opacityFrom: 0.2,
  },
  },
  stroke: { curve: 'smooth' },

}

var chart = new ApexCharts(document.querySelector("#chart"), options);

chart.render();
</script>