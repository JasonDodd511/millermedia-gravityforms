<?php
/**
 * Settings Class File
 *
 * @vendor: Miller Media
 * @package: Gravity Forms Quiz Groups
 * @author: Kevin Carwile
 * @link: 
 * @since: April 10, 2017
 */
namespace MillerMedia\GravityForms;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

/**
 * Plugin Settings
 *
 * @Wordpress\Options
 * @Wordpress\Options\Section( title="General Settings" )
 * @Wordpress\Options\Field( name="classification_taxonomy", type="select", title="Quiz Classification Taxonomy", options="getTaxonomies" )
 */
class Settings extends \Modern\Wordpress\Plugin\Settings
{
	/**
	 * Instance Cache - Required for singleton
	 * @var	self
	 */
	protected static $_instance;
	
	/**
	 * @var string	Settings Access Key ( default: main )
	 */
	public $key = 'main';
	
	/**
	 * Example Options Generator
	 * @see: class annotation for setting3
	 *
	 * @param		mixed			$currentValue				Current settings value
	 * @return		array
	 */ 
	public function getTaxonomies( $currentValue )
	{
		$taxonomies = get_taxonomies( array(), 'objects' );
		$options = array( '' => 'None' );
		
		foreach ( $taxonomies as $taxonomy ) {
			if ( $taxonomy->publicly_queryable and ! in_array( $taxonomy->name, array( 'post_format' ) ) ) {
				$options[ $taxonomy->name ] = esc_html( $taxonomy->label );
			}
		}
		
		return $options;
	}
		
}