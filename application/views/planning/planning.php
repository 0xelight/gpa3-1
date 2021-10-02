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
		<script type='text/javascript'>
			jQuery(document).ready(function ($) {
				var date = new Date();
				var d = date.getDate();
				var m = date.getMonth();
				var y = date.getFullYear();
		
				$('#calendar').fullCalendar({
					header: 
					{
						left: 'prev,next today',
						center: 'title',
						right: 'month,basicWeek,basicDay',
					},
					allDayDefault: false,
					editable: false,
					events: '<?= base_url(); ?>planning/planning_json', //appel le controler pour chercher les reservations
				
					loading: function(bool) 
					{
						if (bool) $('#loading').show();
						else $('#loading').hide();
					},
					eventClick: function(calEvent, jsEvent, view) 
					{
       			 		//alert('Event: ' + calEvent.title);
       					//alert('Url: ' + calEvent.url);
       			 		//alert('View: ' + view.name);
       				 	window.open(calEvent.url, blank);
    			 		return false;
		   			}
				});
			});
		</script>
		<div id='calendar'></div>
	</div><!-- end content -->
	<!-- ***************** - END content - ***************** -->
</div><!-- end main-holder -->
	