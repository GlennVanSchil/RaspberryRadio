<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html><html lang="en">
	<head>
		<!-- CSS -->
		<link rel="stylesheet" href="//meyerweb.com/eric/tools/css/reset/reset.css">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<? echo base_url(); ?>css/style.css">

		<!-- Scripts -->
		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/gsap/1.16.1/TweenMax.min.js"></script>
	</head>
	<body>
		<?php echo exec("whoami"); ?>
		<div class="container">
			<div class="row">
				<div id="add_zender" class="col-lg-4">
					<form class="form" name"form_add_zender" action="<? echo base_url(); ?>index.php/Dashboard/add_zender" method="post">
						<input style="width: 100%" type="text" name="naam" class="form-control" id="naam" placeholder="Naam">
					    <input style="width: 100%" type="url" name="url" class="form-control" id="url" placeholder="URL">
					  	<input style="width: 100%" type="submit" class="btn btn-default" value="Add">
					</form>
				</div>
				<div id="control_panel" class="col-lg-8">
					<div class="controls row">
						<div class="col-lg-12">
							<div class="controls row">
								<div class="controls col-lg-3 col-xs-3" onclick="play()">
									<span class="glyphicon glyphicon-play" aria-hidden="true"></span>
								</div>
								<div class="controls col-lg-3 col-xs-3" onclick="pause()">
									<span class="glyphicon glyphicon-pause" aria-hidden="true"></span>
								</div>
								<div class="controls col-lg-3 col-xs-3" onclick="stop()">
									<span class="glyphicon glyphicon-stop" aria-hidden="true"></span>
								</div>
								<div class="controls col-lg-3 col-xs-3" onclick="poweroff()">
									<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<input type="range" min="0" max="100" value="<?php echo $volume ?>" onchange="setVolume(this.value)"/>
							<span class="glyphicon glyphicon-volume-down" aria-hidden="true"></span>
							<span id="volume"><?php echo $volume ?></span>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<?php foreach ($zenders as $zender) {?>
					<div id="<?php echo $zender[0] ?>" class="zenders col-lg-1 col-md-2 col-sm-2" >
						
						<a id="close" href="#" onclick="document.forms['form_delete_<?php echo $zender[0] ?>'].submit();"></a>
						
						<span class="glyphicon glyphicon-play-circle" aria-hidden="true" onClick="document.forms['form_<?php echo $zender[0] ?>'].submit();"></span>
						<span class="glyphicon-class"><p><?php echo $zender[0] ?></p></span>	
						
						<form name="form_<?php echo $zender[0] ?>" action="<? echo base_url(); ?>index.php/Dashboard/start_radio" method="post">
							<input type="hidden" name="url" value="<?php echo $zender[1] ?>"  />
						</form>
						
						<form name="form_delete_<?php echo $zender[0] ?>" action="<? echo base_url(); ?>index.php/Dashboard/delete_zender" method="post">
							<input type="hidden" name="naam" value="<?php echo $zender[0] ?>"  />
						</form>										
					</div>
				<?php	} ?>
			</div>
		</div>
		<script type="text/javascript">
			function setVolume(volume) {
				$.ajax({
					method: "POST",
					url : "<?php print site_url('/Dashboard/change_volume'); ?>",
					data: {'volume' : volume},
					success : function(data) {
						$("#volume").text(volume);
					},
				});
			}
			
			function play() {
				$.ajax({
					method: "POST",
					url : "<?php print site_url('/Dashboard/play'); ?>",
				});
			}
			
			function pause() {
				$.ajax({
					method: "POST",
					url : "<?php print site_url('/Dashboard/pause'); ?>",
				});
			}
			
			function stop() {
				$.ajax({
					method: "POST",
					url : "<?php print site_url('/Dashboard/stop'); ?>",
				});
			}
			
			function poweroff() {
				$.ajax({
					method: "POST",
					url : "<?php print site_url('/Dashboard/poweroff'); ?>",
				});
			}
		</script>
	</body>
</html> 
