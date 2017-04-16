<?php
/**
 * Plugin HTML Template
 *
 * Created:  April 10, 2017
 *
 * @package  Gravity Forms Quiz Groups
 * @author   Kevin Carwile
 * @since    0.1.0
 *
 * Here is an example of how to get the contents of this template while 
 * providing the values of the $title and $content variables:
 * ```
 * $content = $plugin->getTemplateContent( 'quiz/admin/knowledge-area', array() ); 
 * ```
 * 
 * @param	Plugin		$this		The plugin instance which is loading this template
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

?>

<li class="gquiz-setting-question field_setting">
	<label for="gquiz-knowledge-area" class="section_label">
		<?php esc_html_e( 'Knowledge Area', 'millermedia-gravityforms' ); ?>
	</label>
	<input id="gquiz-knowledge-area" class="fieldwidth-3" size="35" type="text" onkeyup="SetFieldProperty('gquizKnowledgeArea',this.value)">
</li>
