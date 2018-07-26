<!DOCTYPE html>
<html lang="zh-TW">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title:{
		text: ""
	},
	axisY :{
		includeZero: false,
		prefix: "C"
	},
	toolTip: {
		shared: true
	},
	legend: {
		fontSize: 12
	},
	data: [{
		type: "splineArea",
		showInLegend: true,
		name: "Salaries",
		yValueFormatString: "$#,##0",
		dataPoints: [
			{ x: new Date("2018-07-16T12:00:00+08:00"), y: 36 },
			{ x: new Date("2018-07-16T15:00:00+08:00"), y: 34 },
			{ x: new Date("2018-07-16T18:00:00+08:00"), y: 32 },
			{ x: new Date("2018-07-16T21:00:00+08:00"), y: 32 },
			{ x: new Date("2018-07-17T00:00:00+08:00"), y: 30 },
			{ x: new Date("2018-07-17T03:00:00+08:00"), y: 30 },
			{ x: new Date("2018-07-17T06:00:00+08:00"), y: 29 },
			{ x: new Date("2018-07-17T09:00:00+08:00"), y: 29 },
			{ x: new Date("2018-07-17T12:00:00+08:00"), y: 33 },
			{ x: new Date("2018-07-17T15:00:00+08:00"), y: 35 },
			{ x: new Date("2018-07-17T18:00:00+08:00"),  y: 35 },
			{ x: new Date("2018-07-17T21:00:00+08:00"),  y: 32 },
			{ x: new Date("2018-07-18T00:00:00+08:00"),  y: 32 },
			{ x: new Date("2018-07-18T03:00:00+08:00"),  y: 30 }

		]
 	},
	{
		type: "splineArea",
		showInLegend: true,
		name: "Office Cost",
		yValueFormatString: "$#,##0",
		dataPoints: [
			{ x: new Date("2018-07-16T12:00:00+08:00"), y: 33 },
			{ x: new Date("2018-07-16T15:00:00+08:00"), y: 33 },
			{ x: new Date("2018-07-16T18:00:00+08:00"), y: 31 },
			{ x: new Date("2018-07-16T21:00:00+08:00"), y: 30 },
			{ x: new Date("2018-07-17T00:00:00+08:00"), y: 29 },
			{ x: new Date("2018-07-17T03:00:00+08:00"), y: 29 },
			{ x: new Date("2018-07-17T06:00:00+08:00"), y: 28 },
			{ x: new Date("2018-07-17T09:00:00+08:00"), y: 28 },
			{ x: new Date("2018-07-17T12:00:00+08:00"), y: 31 },
			{ x: new Date("2018-07-17T15:00:00+08:00"), y: 34 },
			{ x: new Date("2018-07-17T18:00:00+08:00"), y: 33 },
			{ x: new Date("2018-07-17T21:00:00+08:00"), y: 31 },
			{ x: new Date("2018-07-18T00:00:00+08:00"), y: 29 },
			{ x: new Date("2018-07-18T03:00:00+08:00"), y: 28 }
		]
 	},
	]
});
chart.render();

}
</script>

    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ secure_asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ secure_asset('css/portfolio-item.css') }}" rel="stylesheet">

  </head>

<style>
	#drawing {
		width: 100%;
		height: 100%;
		position: relative;
	}

	.circle {
		background-color: RGB(239, 89, 90);
		position: absolute;
	}
</style>
  <body>
	@include('frontend.layouts.navbar')
	@yield('content')
	@include('frontend.layouts.footer')
    <!-- Bootstrap core JavaScript -->
    <script src="{{ secure_asset('jquery/jquery.min.js') }}"></script>
    <script src="{{ secure_asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ secure_asset('jquery/canvasjs.min.js') }}"></script>

  </body>

</html>