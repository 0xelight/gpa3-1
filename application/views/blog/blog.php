<!-- ***************** - START Title Bar - ***************** -->
<div class="tools">
	<div class="holder">
		<div class="frame">
			<h1><?php echo $titre ;?></h1>
		</div><!-- end frame -->
	</div><!-- end holder -->
</div><!-- end tools -->
<!-- ***************** - END Title Bar - ***************** -->
<div class="main-holder">
<!-- ***************** - START Content - ***************** -->
	<div id="content" class="content_full_width">
		<div>
			<?php
			if(count($results) > 0)
			{
				foreach ($results as $r)
				{
					echo "<h1>".$r->titre."</h1>";
					echo "<p>".nl2br($r->article)."</p>";
				}
			}
			//echo date('Y-m-d H:i');
			/*$CI=get_instance();
			$log=$CI->session->userdata('login');
			print_r($log);
			var_dump(classe()->compte);*/
			//var_dump($log);?>

		</div><!-- end one_third -->
	</div><!-- end content -->
</div><!-- end main-holder -->
