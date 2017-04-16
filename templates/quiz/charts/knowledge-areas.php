<?php
/**
 * Plugin HTML Template
 *
 * Created:  April 11, 2017
 *
 * @package  Gravity Forms Quiz Groups
 * @author   Kevin Carwile
 * @since    0.1.0
 *
 * Here is an example of how to get the contents of this template while 
 * providing the values of the $title and $content variables:
 * ```
 * $content = $plugin->getTemplateContent( 'quiz/charts/knowledge-areas', array() ); 
 * ```
 * 
 * @param	Plugin		$this		The plugin instance which is loading this template
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

?>

<div class="knowledge-charts">
	<ul class="table">
		<?php foreach( $areas as $area_name => $results ) : ?>
		<?php
			// Get correct result percentage
			$correct = 0;
			$total = count( $results );
			foreach( $results as $result ) {
				if ( $result[ 'is_correct' ] ) { $correct++; }
			}
			$correct_pct = intval( 100 * ( $correct / $total ) );
		?>
		<li>
			<h3><?php echo $area_name ?></h3>
			<svg xmlns="http://www.w3.org/2000/svg" data-value="<?php echo $correct_pct ?>%">
			  <path class="circle" d="M100,50c27.6,0,50,22.4,50,50s-22.4,50-50,50s-50-22.4-50-50 S72.4,50,100,50"/>
			  <path class="move" d="M100,50c27.6,0,50,22.4,50,50s-22.4,50-50,50s-50-22.4-50-50 S72.4,50,100,50"/>
			  <text x='50%' y='50%' dy=".375em"></text>
			</svg>
		</li>
		<?php endforeach; ?>
	</ul>
</div>