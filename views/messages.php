		<?php
		
		if(isset($messages))
		{
			echo "<div class='".$message_css_class."' role='alert'>";
			
			foreach($messages as $message) {
				?>
					<div style="text-align:left;"><?=$message?></div>
					<?php
			}
			
			echo "</div>";
		}
		
		if(isset($errors))
		{
			echo "<div class='".$error_css_class."' role='alert'>";
			
			foreach($errors as $error) {
				?>
					<div style="text-align:left;"><?=$error?></div>
					<?php
			}
			
			echo "</div>";
		}
		
		?>