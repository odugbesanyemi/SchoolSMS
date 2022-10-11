var options = {
    chart: {
      type: 'line'
    },
    series: [{
      name: 'income',
      data: [30,40,35,50,49,60,70,91,125]
    },{
        name: 'Expenses',
        data: [10,30,55,50,49,60,70,91,125]
    }],
    xaxis: {
      categories: [1991,1992,1993,1994,1995,1996,1997, 1998,1999]
    }
  }
  
  var chart = new ApexCharts(document.querySelector("#chart"), options);
  chart.render();


// traffic pie chart

var options = {
    series: [44, 55, 13, 33],
    labels:['basic 1', 'basic 2', 'basic 3', 'basic 4'],
    chart: {
    width: 380,
    type: 'donut',
  },
  legend: {
    position: 'right',
    offsetY: 0,
    height: 230,
  }
  };
  var chart = new ApexCharts(document.querySelector("#traffic-pie-chart"), options);
  chart.render();   

