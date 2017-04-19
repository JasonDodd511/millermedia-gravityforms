<?php
/**
 * Plugin Class File
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

use MillerMedia\GravityForms\FormFields\GroupedQuizQuestion;
use Modern\Wordpress\Framework;

/**
 * Plugin Class
 */
class Plugin extends \Modern\Wordpress\Plugin
{
	/**
	 * Instance Cache - Required
	 * @var	self
	 */
	protected static $_instance;
	
	/**
	 * @var string		Plugin Name
	 */
	public $name = 'Gravity Forms Quiz Groups';
	
	/**
	 * Main Stylesheet
	 *
	 * @Wordpress\Stylesheet( always=true )
	 */
	public $mainStyle = 'assets/css/style.css';
	
	/**
	 * Main Javascript Controller
	 *
	 * @Wordpress\Script( deps={"mwp"}, always=true )
	 */
	public $mainScript = 'assets/js/main.js';
	
	/**
	 * Enqueue scripts and stylesheets
	 * 
	 * @Wordpress\Action( for="wp_enqueue_scripts" )
	 *
	 * @return	void
	 */
	public function enqueueScripts()
	{
		
	}
	
	/**
	 * Add a knowledge area field to the quiz field type of gravity forms
	 * 
	 * @Wordpress\Action( for="gform_field_standard_settings", args=2 )
	 * 
	 * @param	int				$position				The position on the form that is rendering	
	 * @param	string			$form_id				The form id
	 * @return	void
	 */
	public function addKnowledgeArea( $position, $form_id )
	{
		if ( $position == 20 )
		{
			echo $this->getTemplateContent( 'quiz/admin/knowledge-area' );
		}
	}
	
	/**
	 * Build a chart with the quiz results
	 * 
	 * @Wordpress\Shortcode( name="quiz_knowledge_results" )
	 * 
	 * @param	array		$atts				Shortcode attributes
	 * @param	string		$content			Any content wrapped with the shortcode
	 * @return	string
	 */
	public function outputQuizKnowledgeResults( $atts, $content )
	{
		// Require gravity forms api to be loaded
		if ( class_exists( 'GFAPI' ) and class_exists( 'GFQuiz' ) )
		{
			// Allow dynamic setting of form_id via request parameter
			if ( ! isset( $atts[ 'form_id' ] ) and isset( $_REQUEST[ 'form_id' ] ) )
			{
				$atts[ 'form_id' ] = intval( $_REQUEST[ 'form_id' ] );
			}
			
			// Allow dynamic setting of lead_id via request parameter
			if ( ! isset( $atts[ 'lead_id' ] ) and isset( $_REQUEST[ 'lead_id' ] ) )
			{
				$atts[ 'lead_id' ] = intval( $_REQUEST[ 'lead_id' ] );
			}
			
			if ( isset( $atts[ 'form_id' ] ) and isset( $atts[ 'lead_id' ] ) )
			{
				$form    = \GFAPI::get_form( $atts[ 'form_id' ] );
				$lead    = \RGFormsModel::get_lead( $atts[ 'lead_id' ] );
				$results = \GFQuiz::get_instance()->get_quiz_results( $form, $lead );
				
				// Map the results by their field id
				$results_by_id = array();
				foreach( $results[ 'fields' ] as $result )
				{
					$results_by_id[ $result[ 'id' ] ] = $result;
				}
				
				// Group those results according to their knowledge area
				$knowledge_area_results = array();
				foreach( $form[ 'fields' ] as $field )
				{
					if ( $field->type == 'quiz' )
					{
						$area = $field->gquizKnowledgeArea ?: 'General';
						
						if ( ! isset( $knowledge_area_results[ $area ] ) )
						{
							$knowledge_area_results[ $area ] = array();
						}
						
						$knowledge_area_results[ $area ][] = $results_by_id[ $field->id ];
					}				
				}
				
				return $this->getTemplateContent( 'quiz/charts/knowledge-areas', array( 'form' => $form, 'lead' => $lead, 'results' => $results, 'areas' => $knowledge_area_results ) );
			}
		}
		else 
		{
			return "[quiz_knowledge_results] ( This shortcode requires gravity forms + the quiz add-on )";
		}
	}
	
	
}