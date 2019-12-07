<!DOCTYPE html>
<html>
<head>
	<title>Raffle Winners</title>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
        <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/table.css">
</head>
<body>
	<div class="col-md-6 col-md-offset-3">
<table class="table table">
    <caption class="title"><b>Raffle Winners</b></caption>
    
    <thead>
        <tr>
            <th>Raffle Ticket Number</th>
            <th>Name</th>
            <th>Prize</th>
        </tr>
    </thead>
    <tbody>
    	<?php foreach($winners as $winner){?>
		<tr>
			<td><?php echo $winner['raffle_ticket_no'];?></td>
			<td><?php echo $winner['name'];?></td>
			<td><?php echo $winner['prize'];?></td>
		</tr>
	<?php }?>
	</tbody>
</table>
</div>
</body>
</html>