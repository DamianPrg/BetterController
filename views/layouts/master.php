<!DOCTYPE html>
<html>
	<head>
		<title>Title of web</title>
	</head>
	
	<body>
		<?php $this->load->view('messages') ?>
		
		<div id="content">
			<?php $this->load->view($content_view); ?>
		</div>
	</body>
</html>