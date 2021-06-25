$(document).ready(function () {
	showGraph();

});

function showGraph()
{
	{
		$.post("data",
		function (data)
		{
			data = JSON.parse(data)			
			var timestamp = [];
			var values = [];		
			
			for (var i in data) {							
				timestamp.push(data[i].datetime_info);
				values.push(data[i].value_info);
			}			

			var chartdata = {
				labels: timestamp,
				datasets: [
					{
						label: "Temperatura",
						lineTension: 0.3,
						backgroundColor: "rgba(2,117,216,0.2)",
						borderColor: "rgba(2,117,216,1)",
						pointRadius: 5,
						pointBackgroundColor: "rgba(2,117,216,1)",
						pointBorderColor: "rgba(255,255,255,0.8)",
						pointHoverRadius: 5,
						pointHoverBackgroundColor: "rgba(2,117,216,1)",
						pointHitRadius: 50,
						pointBorderWidth: 2,
						data: values
					}
				]
			};
			
			console.log(chartdata.datasets[0].data);
			var graphTarget = $("#graphCanvas");

			var lineGraph = new Chart(graphTarget, {
				type: 'line',
				data: chartdata,
				options: {
					scales: {
					  xAxes: [{
						time: {
						  unit: 'date'
						},
						gridLines: {
						  display: false
						},
						ticks: {
						  maxTicksLimit: 7
						}
					  }],
					  yAxes: [{
						ticks: {
						  min: -20,
						  max: 70,
						  maxTicksLimit: 5
						},
						gridLines: {
						  color: "rgba(0, 0, 0, .125)",
						}
					  }],
					},
					legend: {
					  display: false
					}
				  }
			});
		});
	}
	setTimeout(showGraph, 5000);
}
