
<html>
	<head>
		
		
		
		<script type="text/javascript" src="comments/js/jquery-1.4.3.min.js"></script>
		<script type="text/javascript" src="comments/js/tiny_mce/jquery.tinymce.js"></script>		
		<?php
		include("comments/config.php");	
			if(!empty($_SESSION['id'])){?><script type="text/javascript"	src="comments/js/rcheComment.js"></script><?}
		
		?>
	</head>
	<?php 
				
			$comments->outComments(); 
				

	?>	