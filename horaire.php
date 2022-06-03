<?php include "header.php" ?> 
<body>
		<section>
		<header class="major">
			<h1>HORAIRES</h1>
		<br>
		
									<div class="table-wrapper">
										<table class="alt">
											<thead>
												<tr>
													<th>ligne A</th>
													<th>ligne B</th>
													<th>ligne C</th>
												</tr>
											</thead>
											<tbody>
												
												<tr> <?php $h=6; 
													while ($h < 24) { ?>
													<td> bus 1: <?php echo $h ?>h</td>
													<td>bus 3: <?php echo $h ?>h </td>
													<td> bus 5: <?php echo $h ?>h </td>
													
											
												</tr>
												<tr>
													<td> bus 2: <?php echo $h+1 ?>h </td>
													<td>bus 4: <?php echo $h+1 ?>h</td>
													<td> bus 6:<?php echo $h+1 ?>h</td>
													
											
												</tr>

												<?php $h=$h+2; }?>
											<?php //}?>

											</tbody>
											
										</table>
									</div>

	
			</section>
					

			
			


	</body> 
<?php include "footer.php"; ?>
</html>