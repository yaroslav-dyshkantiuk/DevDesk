<?php 

if ( ! is_active_sidebar( 'car-sidebar' ) ) {
	return;
}
echo '<aside id="secondary" class="widget-area">';
dynamic_sidebar('car-sidebar');
echo '</aside>';