<?php
/**
 * Plugin HTML Template
 *
 * Created:  April 25, 2017
 *
 * @package  Gravity Forms Quiz Groups
 * @author   Kevin Carwile
 * @since    1.3.0
 *
 * Here is an example of how to get the contents of this template while 
 * providing the values of the $title and $content variables:
 * ```
 * $content = $plugin->getTemplateContent( 'quiz/admin/taxonomy', array( 'title' => 'Some Custom Title', 'content' => 'Some custom content' ) ); 
 * ```
 * 
 * @param	Plugin		$this		The plugin instance which is loading this template
 *
 * @param	array		$form		The form properties
 * @param	object		$taxonomy	The taxonomy
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

$selected_terms = isset( $form[ 'classification_terms' ] ) ? (array) $form[ 'classification_terms' ] : array();

?>

<tr>
	<th>
		<?php echo $taxonomy->label ?>
	</th>
	<td>
		<?php 
			$terms = get_terms( array( 'taxonomy' => $taxonomy->name, 'hide_empty' => false ) );
			if ( is_array( $terms ) ) {
				foreach( $terms as $term ) {
					// Create a value that can be easily plain text searched in the database, and is unlikely to appear otherwise
					$term_value = "_t_{$term->term_id}_";
					?>
						<label><input type="checkbox" name="classification_terms[]" value="<?php echo $term_value ?>" <?php if (in_array( $term_value, $selected_terms )): ?>checked="checked"<?php endif; ?>> <?php echo esc_html( $term->name ) ?> [ <?php echo $term->term_id ?> ]</label><br>
					<?php
				}
			}
		?>
	</td>
</tr>