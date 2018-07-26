@extends('frontend.layouts.master')
@section('title', 'Home')
@section('content')

	<div class="container">
		<div class="row">
			<?php
				$liveVideo = DB::table('weather_livevideo')->get();
			?>
			<div style="width:60%;">
				<iframe width="100%" height="100%" src="{{ $liveVideo[1]->onlinelink }}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
			</div>
			<div style="width:40%;background-image:url({{ secure_asset('/img/desBackground.jpg') }});">
				<div style="width:95%;padding:10px;">
				<?php
					//Get weather_descript table information
					// Only get last add information to display
					$results = DB::table('weather_description')->count();
					$description = DB::table('weather_description')->get();
				?>
				  <h6 style="color:#ffffff;"><?= $description[($results-1)]->title; ?></h6>
				  <h6 style="color:#eae554;"><?= $description[($results-1)]->date; ?></h6>
				  <h6 style="color:#ffffff;"><?= $description[($results-1)]->short_descript ?></h6>
				  <a href="#"><img class="img-fluid" src="{{ secure_asset('/img/readMoreBtn.png') }}" style="width:60px;" Align="right" alt=""></a>
					<br><br>
				 </div>
			</div>
		</div>

		<div class="row">
			<div style="width:50%;background-color:#54a1d5;padding:40px;">
				<img src="{{ secure_asset('/img/TaiwanWeather.png') }}" style="width:300px;">

				<div style="width:100%;" align="right">
				<ul class="nav nav-pills background-color:#ffffff" id="pills-tab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="pills-now-tab" data-toggle="pill" href="#pills-now" role="tab" aria-controls="pills-now" aria-selected="true">現況</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="pills-time-tab" data-toggle="pill" href="#pills-time" role="tab" aria-controls="pills-time" aria-selected="false">逐時</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="pills-weekend-tab" data-toggle="pill" href="#pills-weekend" role="tab" aria-controls="pills-weekend" aria-selected="false">一週</a>
					</li>
				</ul>
				</div>
				<div class="row" style="padding:10px;text-color:#ffffff;background-color:#3177bd;">
					<div style="width:40%;" align="center">
						<a id="dispText" style="color:#ffffff;">中山區</a>
					</div>
					<?php
						$tempCity = "";
						$results = DB::table('taiwan_location')->count();
						$location = DB::table('taiwan_location')->get();
						//echo $location;
					?>
					<div style="width:60%;" align="right">
						<form name="locationForm" align="right">
						<script>
							department=new Array();
							department[0]=["請選擇鄉鎮"];
						</script>

						<select id='city' onChange="renew(this.selectedIndex);">
							<option>請選擇縣市</option>
							<?php
								echo $location;
								echo $results;
								$tempName = "";
								$countIdx = 0;
								$subIdx = 0;
								$tempTown = "";
								foreach ( $location as $info):
									if ($tempName != $info->cityName) {
								?>
										<option value={{ $info->cityName}}><?php echo $info->cityName;?></option>
										<script>
											department[<?=$countIdx;?>] = [<?=$tempTown;?>];
										</script>
								<?php
										$tempName = $info->cityName;
										$countIdx++;
										$subIdx = 0;
										$tempTown = "";
									} else {
										if ($tempTown != "") {
											$tempTown .= ",";
										}
									}
									$tempTown .= "\"".$info->townName."\"";
									echo $tempTown;
								endforeach;
							?>
							<script>
								department[<?=$countIdx;?>] = [<?=$tempTown;?>];
							</script>
						</select>

						<select id='town' onChange="modifyDisText(this.selectedIndex);">
							<option>請選擇鄉鎮</option>
						</select>
					</div>

				</div>

				<script>
					function renew(index){
						document.locationForm.town.options[i]=new Option("請選擇鄉鎮", "請選擇鄉鎮");
						for(var i=1;i<department[index].length;i++)
							document.locationForm.town.options[i]=new Option(department[index][i], department[index][i]);	// 設定新選項
						document.locationForm.town.length=department[index].length+1;	// 刪除多餘的選項
					}

					function modifyDisText(index) {
						document.getElementById("dispText").innerHTML=document.locationForm.town.options[index].value;


						var xmlHttp = new XMLHttpRequest();
						var locationUri = "/"+encodeURIComponent(document.locationForm.city.value)
							+"/"+encodeURIComponent(document.locationForm.town.options[index].value);

						xmlHttp.open( "GET", "http://official-site-api.weatherrisk.com/weather/now"+locationUri, false ); // false for synchronous request
						//alert("http://official-site-api.weatherrisk.com/weather/now"+locationUri);
						xmlHttp.send( null );
						//alert("http://official-site-api.weatherrisk.com/weather/now/%E8%87%BA%E5%8C%97%E5%B8%82/%E4%B8%AD%E5%B1%B1%E5%8D%80");

						var obj = JSON.parse(xmlHttp.responseText);
						document.getElementById("dispTemplate").innerHTML=obj.temp+"°C";

						document.getElementById("stationName").innerHTML=obj.station+"測站";

						//alert(obj.weather);
						document.getElementById("aqiValue").innerHTML=obj.air_quality;
						document.getElementById("aqiStatus").innerHTML=obj.desc;

						var dispWeather = document.getElementById("dispWeatherIcon");
					　　//alert(obj.temp);

						if (obj.weather == "晴") {
							//alert(obj.weather);
							dispWeather.setAttribute("src", "{{secure_asset('/img/weather/23.png')}}");
						} else if (obj.weather == "多雲") {
							//alert(obj.weather);
							dispWeather.setAttribute("src", "{{secure_asset('/img/weather/18.png')}}");
						}  else if (obj.weather == "雨") {
							//alert(obj.weather);
							dispWeather.setAttribute("src", "{{secure_asset('/img/weather/3.png')}}");
						}

						//alert(obj.weather);
						//alert(obj.air_quality);
						//alert(obj.temp);
						//alert(obj.station);
						return xmlHttp.responseText;
					}
				</script>

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
							fontSize: 10
						},
						data: [{
							type: "splineArea",
							showInLegend: true,
							name: "最高溫",
							yValueFormatString: "#,##0",
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
							name: "最低溫",
							yValueFormatString: "#,##0",
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
				<div class="tab-content" id="pills-tabContent">
				  <div class="tab-pane fade show active" id="pills-now" role="tabpanel" aria-labelledby="pills-now-tab">
					<div class="row">
						<div style="width:50%;">
							<div style="background-color:#1e5993;padding:10px;" align="center">
								<img id="dispWeatherIcon" src="{{secure_asset('/img/weather/23.png')}}" style="width:220px;">
							</div>
							<div align="center" style="padding:20px;background-color:#16497e;">
								<h4 style="color:#ffffff">溫度</h4>
								<h4 id="dispTemplate" style="color:#ffffff">32</h4>
							</div>
						</div>
						<div style="width:50%;background-color:#ecf0f3;padding:20px;">
							<div>
								<img src="{{secure_asset('/img/aqiQuality.png')}}" style="width:120px;">
							</div>
							<div>
								<h id="stationName">中山測站</h>
							</div >
							<div style="width:100%;text-align:center;margin:0 auto;" align="center">
								<h1 style="color:#ffffff;background-color:RGB(239, 89, 90);text-align:center;" id="aqiValue">30</h1>
							</div>
							<div style="width:100%;text-align:center;margin:0 auto;" align="center">
								<h style="color:#ffffff;background-color:RGB(239, 89, 90);text-align:center;" id="aqiStatus">Good</h>
							</div>
						</div>
					</div>
				  </div>
				  <div class="tab-pane fade" id="pills-time" role="tabpanel" aria-labelledby="pills-time-tab">
					<div id="chartContainer" style="height: 150px; width: 100%;">ddd</div>
				  </div>
				  <div class="tab-pane fade" id="pills-weekend" role="tabpanel" aria-labelledby="pills-weekend-tab">show weekendly</div>
				</div>
			</div>
			<div style="width:50%;background-color:#ecf0f3;">
				<div class="row" style="width:100%;">
					<div style="width:20%;padding:10px;">
						<div style="height:20px;"></div>
						<div style="height:275px;padding:0px 0px 0px 30px;">
							<img src="{{secure_asset('/img/liveVideoTitle.png')}}" style="width:20px;height:150px;" alt="">
						</div>
						<div style="height:10px"></div>
						<div style="padding:0px 0px 0px 80%;">
							<img Align="left" src="{{secure_asset('/img/preparation.png')}}" style="width:30px;height:80px;right:0" alt="">
						</div>
					</div>
					<div style="width:80%;">
						<div style="height:20px;"></div>
						<div style="text-align:right;">
							<img class="right" src="{{secure_asset('/img/liveVideoTip.jpg')}}" style="width:130px;height:30px;" Align=left alt="">
							<?php
							//Get weather_advertising table information
							// Only get last add information to display
							$results = DB::table('weather_advertising')->count();
							$advertising = DB::table('weather_advertising')->get();
							$imgPath = "/img/".$advertising[($results-1)]->picname;
							$videoLink = $liveVideo[0]->offlinelink;
							//echo $videoLink;
							//echo $imgPath;
							//echo $liveVideo[0]->isLive;
							if ($liveVideo[0]->islive == 1) {
								$videoLink = $liveVideo[0]->onlinelink;
							?>
							<a style="color:#ff0000;text-align:right;">Weather Live Stream</a>
							<?php } else {
								$videoLink = $liveVideo[0]->offlinelink;
								}// end of liveVideo check
							?>
							</div>
						<div style="width:100%;">
						<iframe width="100%" height="250px" src="{{ $videoLink }}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
						</div>
						<div style="height:10px"></div>
						<div >
							<a href="<?=$advertising[($results-1)]->link;?>"><img class="img-fluid" src="{{ secure_asset('/img/advertising.jpg') }}"  alt=""></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row" style="background-color:#345b82;padding:10px">
			<div style="width:5%;">
			</div>
			<div style="text-align:right;width:25%;">
				<div style="width:20px"></div>
				<div style="text-align:right;color:#ffffff;">
					<h3 style="text-align:right;">我們的服務</h3>
					<h3 style="text-align:right;">Our<br>Service</h3>
					<p></p>
					<h3></h3>
					<ul>
						<p>希望透過不同產業間的合作</p>
						<p>提升加值應用服務</p>
						<p>的深度及範圍</p>
					</ul>
				</div>
			</div>
			<div style="width:5%;"></div>
			<?php
				$results = DB::table('service')->count();
				$service = DB::table('service')->paginate(9);
			?>
			<div style="width:65%;">
				<div class="row">
					<div style="width:5%;">
					</div>
					<div style="width:95%;">
						<?php
						$colCount = 0;
						foreach ($service as $info):
							if ($colCount == 0) {
						?>
								<div class="row">

						<?php
							}
						?>
						<div style="width:30%;text-align:center;">
							<div style="width:80%;text-align:center;">
								<img class="img-fluid" src="{{secure_asset("/img/{$info->picpath}")}}" style="width:100%;background-color: transparent; border: 0;" alt="">
							</div>
							<div style="height:10px;"></div>
							<div style="width:70%;text-align:left;color:#eae554;">
								<a><?php echo $info->servicetitle;?></a>
							</div>
							<div style="height:10px;"></div>
							<div style="width:80%;text-align:left;color:#ffffff;">
								<a><?php echo $info->description;?></a>
							</div>
							<div style="width:80%;text-align:right;">
								<a href="<?=$info->linkpath;?>"><img class="img-fluid" src="{{ secure_asset('/img/readMoreBtn.png') }}" style="width:60px;" alt=""></a>
							</div>
							<div style="height:10px;"></div>
						</div>
						<?php
							$colCount++;
							if ($colCount >= 3) {
								$colCount =0;
						?>
							</div>
						<?php
							}
						?>

						<?php
							endforeach;
						?>

						<?php
						if ($colCount < 3 && $colCount > 0) {
						?>
							</div>
						<?php
						}
						?>
					</div>
				</div>
				<div><?php echo $service;?></div>
			</div>
		</div>
		<div class="row" style="background-image:url({{ secure_asset('/img/lastVideoServiceBk.jpg') }});">

			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="width:100%;text-align:center;padding:40px;">
				<h1 style="color:#ffffff;">氣象影音</h1>
				<h3 style="color:#ffffff;"><font color="#ffffff">OUR</font> <font color="#eae554">VIDEO</font></h3>
				<!-- Indicators -->
				<?php
					$results = DB::table('weather_ourvideo')->count();
					$ourVideo = DB::table('weather_ourvideo')->get();
				?>

				<div id="demo" class="carousel slide" data-ride="carousel">

					<!-- Indicators -->
					<ul class="carousel-indicators">
						<?php
							for($nIdx = 0; $nIdx < $results/4; $nIdx++){
								if ($nIdx == 0) {
						?>
								<li data-target="#demo" data-slide-to="{{ $nIdx }}"
									class="active"></li>
						<?php
								} else {
						?>
								<li data-target="#demo" data-slide-to="{{ $nIdx }}"></li>
						<?php
								}
							}
						?>
						<!--<li data-target="#demo" data-slide-to="0" class="active"></li>
						<li data-target="#demo" data-slide-to="1"></li>
						<li data-target="#demo" data-slide-to="2"></li>-->
					</ul>

					<!-- The slideshow -->
					<div class="carousel-inner">
						<?php
							$count = 0;
							for($nIdx = 0; $nIdx < $results/4; $nIdx++) {
								if ($nIdx == 0) {
						?>
							<div class="carousel-item active">
						<?php
								} else {
						?>
							<div class="carousel-item">
						<?php
								}

								$subLoopEnd = 0;
								if (($nIdx*4 + 4) > $results) {
									$subLoopEnd = $results;
								} else {
									$subLoopEnd = ($nIdx*4 + 4);
								}
								for ($subIdx = $nIdx*4; $subIdx < $subLoopEnd; $subIdx++) {
						?>
								<a href={{$ourVideo[$subIdx]->linkpath}}><img src="{{ secure_asset("/img/{$ourVideo[$subIdx]->picpath}")}}" alt="" style="width:200px;"></a>
						<?php
								}
						?>
							</div>
						<?php
							}
						?>
						<!--<div class="carousel-item">
							<img src="ourVideo2.jpg" alt="Chicago">
						</div>
						<div class="carousel-item">
							<img src="ourVideo3.jpg" alt="New York">
						</div>-->
					</div>

					<!-- Left and right controls -->
					<a class="carousel-control-prev" href="#demo" data-slide="prev">
						<span class="carousel-control-prev-icon"></span>
					</a>
					<a class="carousel-control-next" href="#demo" data-slide="next">
						<span class="carousel-control-next-icon"></span>
					</a>

				</div>
			</div>
		</div>
	</div>
<section class="page.section clearfix">
</section>
<section class="page.section cta">
</section>
@endsection