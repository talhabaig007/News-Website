/**
 * Custom scripts for Redirect Control
 *
 * @package Azure News
 */

wp.customize.controlConstructor['cv-redirect'] = wp.customize.Control.extend({
	ready: function() {
		'use strict';
		var control = this;

		control.container.find('.redirect-item').each(function(){
			var singleItem = jQuery(this);
			singleItem.on('click', function(e){
				e.preventDefault();
				var type 	= jQuery(this).data('type'),
					type_id = jQuery(this).data('id');
				switch( type ) {
					case 'section' :
						wp.customize.section(type_id).focus();
						break;

					default :
						wp.customize.control(type_id).focus();
						break;

				}
			});
		});
	}
});