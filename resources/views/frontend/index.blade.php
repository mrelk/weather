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
			<div style="width:50%;background-color:#54a1d5;">
			  <img class="img-fluid" src="http://placehold.it/500x500" alt="">
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