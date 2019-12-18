<!DOCTYPE html>
<html>
<head>
	<title>Weather Forecasts</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
	<div id="root" class="container">
		<div class="jumbotron">
			<p><h1>Weather Forecasting Tool for PurpleWiFi Staff</h1><br><br></p>
			<form class="form-horizontal" method="post" action="weather">
				@csrf
				<input type="text" id="location" name="location" placeholder="Enter a location" required> 
				<button class="btn btn-warning">Submit</button>
			</form>
			@if(isset($weatherInfo))
			<br>
			<br>
			<div class="row">
				<div class="col-sm-6"><b>Provider name:</b>   MET Office</div>
				<div class="col-sm-6"></div>
			</div>
			<div class="row">
				<div class="col-sm-2"><b>Location</b></div>
				<div class="col-sm-2"><b>Date</b></div>
				<div class="col-sm-2"><b>Minimum Temp(C)</b></div>
				<div class="col-sm-2"><b>Min T. W. Type</b></div>
				<div class="col-sm-2"><b>Maximum Temp(C)</b></div>
				<div class="col-sm-2"><b>Max T. W. Type</b></div>

			</div>
			<div class="row">

				@foreach ($weatherInfo as $info)
				<div class="col-sm-2">
					{{$info}}
				</div>
				@endforeach
			</div>
			@endif

			
		</div>
	</div>
	<!--script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
		<script src="{{asset('js/main.js')}}"></script-->
		</body>
		</html>