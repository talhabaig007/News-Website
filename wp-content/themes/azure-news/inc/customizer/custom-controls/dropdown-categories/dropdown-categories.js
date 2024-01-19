/**
 * Custom scripts for Dropdown Categories Control
 *
 * @package Azure News
 */

wp.customize.controlConstructor['cv-dropdown-categories'] = wp.customize.Control.extend({

	ready: function() {

		'use strict';

		var control = this;

		control.container.on( 'change', 'select', function() {
			control.setting.set( jQuery( this ).val() );
		} );

	}

});