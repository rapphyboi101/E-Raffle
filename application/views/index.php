<!DOCTYPE html>
<html>
    <head>
        <title>Raffle Draw</title>	
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
        <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
		<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/navbarclock.js"></script>-->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
    </head>
	<body>
		<div class="text-prize">
			<br>
			<br>
			<br>
			<br>
			<br>
		<p>Current Prize</p>
		<div class="col-md-6 col-md-offset-3">
		<input type="text" class="form-control" name="prize" id="prize">
		</div>
		<br>
		</div>
		<div class="maincontent">
			<div id="output">START RAFFLE DRAW</div>
			<div id="alert"></div>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<div class ="row">
				<div class = "col-md-8 imgholder col-md-offset-2">
					<img src="<?php echo base_url();?>assets/img/micto.png">
					<img src="<?php echo base_url();?>assets/img/baliwag-logo.png">
					<img src="<?php echo base_url();?>assets/img/yes.png">
				</div>
			</div>
			<!--<div><p id="instruction">Press <strong>'S'</strong> on your keyboard to Start Raffle</p></div>-->
			<script>
				var thePrize = $("#prize").val();
				var total_num = '<?php echo $all?>'
				var numvar = 0, //variable to prevent a key from pressing multiple times
					datafromform = ''; //make sure you have this variable empty to prevent empty modal showing
				$('body').keydown(function(e){
					//starts generating number if letter 'S' key is pressed
					if(e.keyCode == 219 && numvar == 0){
						$("#output").show();
						if(datafromform != ''){
							$('#myModal').modal('toggle'); //closes modal if datafromform if is not empty
						}
						//random number animator here
						animationTimer = setInterval(function() {
							var randnum = Math.floor(Math.random() * 1105),//generate random number
								strnum = ""+randnum+""; //convert number to string
							
								$('#output').text(''+randnum);
						
						}, 10);//milliseconds before 	generating new number again
						/*$('#instruction').text("Press 'X' to Stop Raffle");//set new instruction to the user*/
						
						numvar = numvar + 1;
					}
					
					
					//stops generating number if letter 'X' key is pressed
					if(e.keyCode == 221) {
						numvar = 0;//numvar is put back to zero
						clearInterval(animationTimer);//stops raffle
						var output = $('#output').text();
						var prize = $('#prize').val();
						var $_base_url = '<?=base_url()?>';
						$("#output").hide();
						//Ajax POST that sends the value of 'res' variable to send.php
						$.ajax({
						   type: "POST",
						   url: $_base_url + 'index.php/Raffle/send2',
						   data: {
						   	output: output,
						   	prize: prize
						   },
						   dataType : 'json',
						   success: function($data){
							   //show query result from send.php back to #alert of this page

							   console.log($data);
							   if ($data.length == 0) {
							   	$("#queryresult").text("Play Again");
							   	$("#nameresult").text("");
							   	$("#departmentresult").text("");
							   	$("#prizeresult").text("");
							   }
							   /*if ($data = 'Play again'){
							   		console.log('Wow');
							   }
							   else{*/
							   $('#queryresult').text($data[0].raffle_ticket_no);
							   $('#nameresult').text($data[0].name);
							   $('#departmentresult').text($data[0].department);
							   $('#prizeresult').text($("#prize").val());
							// }
						   }
						});
						$("#myModal").modal({backdrop: "static"});//show modalwith winner's name
						$('#instruction').text("Press 'S' to Start Raffle");//set new instruction to the user
						datafromform = 'good';//datafromform has now a value
					}
				});
			</script>
		</div>
		<div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body">
						<p>And the Winner is <br>
							<strong id="queryresult"></strong><br>
							<strong id="nameresult"></strong><br>
							<strong id="departmentresult"></strong><br>
							<strong id="prizeresult"></strong></p>
					</div>
				</div>
			</div>
		</div>
	</body>	
</html>