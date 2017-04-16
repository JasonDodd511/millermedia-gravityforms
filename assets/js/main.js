/**
 * Plugin Javascript Module
 *
 * Created     April 10, 2017
 *
 * @package    Gravity Forms Quiz Groups
 * @author     Kevin Carwile
 * @since      0.1.0
 */

"use strict";

/**
 * Controller Design Pattern
 *
 * Note: This pattern has a dependency on the "mwp" script
 * i.e. @Wordpress\Script( deps={"mwp"} )
 */
(function( $, undefined ) {
	
	/**
	 * Main Controller
	 *
	 * The init() function is called after the page is fully loaded.
	 *
	 * Data passed into your script from the server side is available
	 * by the mainController.local property inside your controller:
	 *
	 * > var ajaxurl = mainController.local.ajaxurl;
	 *
	 * The viewModel of your controller will be bound to any HTML structure
	 * which uses the data-view-model attribute and names this controller.
	 *
	 * Example:
	 *
	 * <div data-view-model="millermedia-gravityforms">
	 *   <span data-bind="text: title"></span>
	 * </div>
	 */
	var mainController = mwp.controller( 'millermedia-gravityforms', 
	{
		
		/**
		 * Initialization function
		 *
		 * @return	void
		 */
		init: function()
		{
			var circumference = 314;

			$( ".knowledge-charts svg[data-value]" ).each( function() 
			{
				var svg = $(this);
				var progress = svg.find( '.move' );
				var currentClass = progress.attr( 'class' );
				var value = svg.data( 'value' );
				var value2 =  Math.round( circumference - ( value.slice(0,-1) * circumference / 100 ) );
				progress.attr({
					"style": "stroke-dashoffset:" + value2 + "",
					"class": "animate " + currentClass + "",
				});
				svg.find( 'text' ).text( value );
			});
		}
	
	});
	
	/**
	 * Listen for form field changes and update our knowledge area setting accordingly
	 *
	 * @param	event		The dom event
	 * @param	field		The field properties
	 * @param	form		The form
	 * @return	void
	 */
	$(document).bind( 'gform_load_field_settings', function ( event, field, form ) 
	{
		if ( field.type == 'quiz' )
		{
			$( '#gquiz-knowledge-area' ).val( field[ 'gquizKnowledgeArea' ] );
		}
	});		
	
})( jQuery );
 