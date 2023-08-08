	<form method="POST" class="ajaxform w-100" data-source="formajaxurl">
	<div class="card">
	  <div class="card-header header-elements-inline notehistory">
			<h3 class="card-title"><span class="icon-co-big orange profile"></span> Notifications</h3>
			<div class="header-elements">

			</div>
	  </div>
	  <div class="card-body pb-0">
	  	<div id="historywrap">

				<?php
				if ($notifications) {
					echo '<div id="timeline">';
	  				echo '<div>';
					$counter = 1;
					foreach ($notifications as $notification) {
						$current_date = date('m/d/Y', $notification['added_on']);
						echo ((($current_date != $previous_date) && ($counter != 1))? '</section>':'');
						echo (($current_date != $previous_date)? '<section class="year"><h3>'.$current_date.'</h3>':'');
						echo '<section>
										<h4><i class="icon-alarm"></i> '.date('h:i:s A', $notification['added_on']).'</h4>
										<ul>
											<li><b>'.$notification['title'].'</b><br>'.nl2br($notification['message']).'</li>
										</ul>
									</section>';
						$previous_date = $current_date;
						$counter++;
					}
					echo '</section>';
					echo '</div>';
					echo '<div>';
				}else{
					echo '<div>';
					echo '<div>';
					echo '<li class="media content-divider justify-content-center text-muted mx-0">No new notifications</li>';
					echo '<br>';
					echo '<br>';
					echo '</div>';
					echo '</div>';
				}
				?>
			</div>




	  </div>
	</div>
	</form>