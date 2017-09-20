
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app'
});

var lineItem = '<input type="hidden" value="0" name="line_item_id[]"><div class="col-xs-6 col-md-2"> <div class="form-group"> <input type="text" class="form-control" name="quantity[]" required> </div></div><div class="col-xs-6 col-md-6"> <div class="form-group"> <input type="text" class="form-control" name="description[]"> </div></div><div class="col-xs-6 col-md-2"> <div class="form-group"> <input type="text" class="form-control" name="price[]"> </div></div><div class="col-xs-6 col-md-2"> <div class="form-group"> <input type="text" class="form-control" name="lineTotal[]"> </div></div>';

$( document ).ready(function() {
	$( '.add-line-item' ).click(function() {
		$( '.line-items' ).append( lineItem );
	});

	$( '.zoom' ).elevateZoom({
		zoomType: "inner",
		scrollZoom: true
	});

    $( '#receipt-form' ).validate({
    	errorPlacement: function(error, element) {
            // Don't show error
      	}
    });  

	$( '.submit-receipt' ).click(function() {
		if ( $( '#receipt-form' ).valid() ) {
			$( '#receipt-form' ).submit();
		} else {
			$( '.alert' ).show();
		}
	});
});