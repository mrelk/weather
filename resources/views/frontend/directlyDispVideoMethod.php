<div id="muteYouTubeVideoPlayer" style="height:250px;">
						<script async src="https://www.youtube.com/iframe_api"></script>
						<script>
						function onYouTubeIframeAPIReady() {
						var player;
						player = new YT.Player('muteYouTubeVideoPlayer', {
						videoId: '<?=$videoLink;?>', // YouTube 影片 ID
						width: 450, // 播放器寬度 (in px)
						height: 356, // 播放器長度 (in px)
						playerVars: {
						autoplay: 1, // 自動播放視頻
						controls: 1, // 顯示播放/暫停按鈕
						showinfo: 0, // 隱藏影片標題
						modestbranding: 1, // 隱藏YouTube LOGO
						loop: 1, // 循環播放
						fs: 0, // 隱藏全螢幕視窗按鈕
						cc_load_policty: 0, // 隱藏關閉字幕
						iv_load_policy: 3, // 隱藏影片註釋
						autohide: 0 // 播放時隱藏影片控制按鈕
						},
						events: {
						onReady: function(e) {
						e.target.mute(); // 靜音
						}
						}
						});
						}
						// Written by @labnol
						</script>
						</div>