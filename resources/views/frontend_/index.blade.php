@extends('frontend.layouts.master')
@section('title', 'Home')
@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-8">
			  <img class="img-fluid" src="{{asset('/img/video.png')}}" alt="">
			</div>

			<div class="col-md-4">
			<?php
				//Get weather_descript table information
				// Only get last add information to display
				$results = DB::table('weather_description')->count();
				$description = DB::table('weather_description')->get();
			?>
			  <h6 class="my-4"><?= $description[($results-1)]->title; ?></h6>
			  <h6 ><?= $description[($results-1)]->date; ?></h6>
			  <p><?= $description[($results-1)]->short_descript ?></p>
			  <a href="#"><img class="img-fluid" src="{{ asset('/img/readMoreBtn.png') }}" style="width:60px;" Align="right" alt=""></a>
			  
			</div>
			

		</div>
		
		<div class="row">
			<div class="col-md-6">
			  <img class="img-fluid" src="http://placehold.it/500x500" alt="">
			</div>
			<div class="col-md-6">
				<div class="row">
					<div>
						<div style="height:20px;"></div>
						<div style="height:290px;">
							<img class="img-fluid" src="{{asset('/img/liveVideoTitle.png')}}" style="width:30px;height:150px;"  alt="">
						</div>
						<div style="height:130px;">
							<img Align="left" src="{{asset('/img/preparation.png')}}" style="width:30px;height:80px;right:0" alt="">
						</div>
					</div>
					<div class="col-md-10">
						<div style="height:20px;"></div>
						<div style="height:290px;text-align:right;">
							<?php
							//Get weather_advertising table information
							// Only get last add information to display
							$results = DB::table('weather_advertising')->count();
							$advertising = DB::table('weather_advertising')->get();
							$liveVideo = DB::table('weather_liveVideo')->get();
							$imgPath = "/img/".$advertising[($results-1)]->picName;
							//echo $imgPath;
							//echo $liveVideo[0]->isLive;
							if ($liveVideo[0]->isLive == 1) {
							?>
							<img class="right" src="{{asset('/img/liveVideoTip.jpg')}}" style="width:130px;height:30px;" Align=left alt="">
							<a style="color:#ff0000;text-align:right;">Weather Live Stream</a>
							
							<a href="<?=$advertising[($results-1)]->link;?>"><img class="img-fluid" src="{{asset('/img/liveVideoImg.jpg')}}"  alt=""></a>
							<?php } else { ?>
							<img class="right" src="{{asset('/img/liveVideoTip.jpg')}}" style="width:130px;height:30px;right:0" alt="">
							<a href="<?=$advertising[($results-1)]->link;?>"><img class="img-fluid" src="{{asset('/img/liveVideoImg.jpg')}}" style="height:250px;right:0"  alt=""></a>
							<?php }// end of liveVideo check?>
						</div>
						<div style="height:130px;">
							<a href="<?=$advertising[($results-1)]->link;?>"><img class="img-fluid" src="{{ asset('/img/advertising.jpg') }}" style="height:125px;right:0" alt=""></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row" style="height:10px;background-color:#345b82;"></div>
		<div class="row" style="background-color:#345b82;">
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
			<div style="width:5%;">
				</div>
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
								<img class="img-fluid" src="{{asset('/img/service_1.png')}}" style="width:100%;background-color: transparent; border: 0;" alt="">
							</div>
							<div style="height:10px;"></div>
							<div style="width:70%;text-align:left;color:#eae554;">	
								<a><?php echo $info->serviceTitle;?></a>
							</div>
							<div style="height:10px;"></div>
							<div style="width:80%;text-align:left;color:#ffffff;">	
								<a><?php echo $info->description;?></a>
							</div>
							<div style="width:80%;text-align:right;">
								<a href="<?=$info->linkPath;?>"><img class="img-fluid" src="{{ asset('/img/readMoreBtn.png') }}" style="width:60px;" alt=""></a></div>
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
				<div><?php echo $service;?></div>
			</div>  
		</div>
	</div>
<section class="page.section clearfix">
</section>
<section class="page.section cta">
</section>
@endsection