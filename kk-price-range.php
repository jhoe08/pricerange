<?php
/*
Plugin Name: Price Range
Plugin URI: 
Description: Simple Price Range
Version: 1.0
Author: Dalia
Author URI: 
License: GPL2
*/

class kako_priceRange extends WP_Widget {

	// constructor
  function __construct(){
      parent::__construct(false, $name = __('Range', 'kk_price_range') );
  }

	// widget form creation
	function form($instance) {

		// Check values
		if( $instance ) {
		     $title = esc_attr($instance['title']);		     
		     $textarea = esc_textarea($instance['textarea']);
		} else {
		     $title = '';
		     $textarea = '';
		}
		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'kk_price_range'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('textarea'); ?>"><?php _e('Textarea:', 'kk_price_range'); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id('textarea'); ?>" name="<?php echo $this->get_field_name('textarea'); ?>"><?php echo $textarea; ?></textarea>
		</p>
<?php
	}
	// update widget
	function update($new_instance, $old_instance) {
	      $instance = $old_instance;
	      // Fields
	      $instance['title'] = strip_tags($new_instance['title']);
	      $instance['textarea'] = strip_tags($new_instance['textarea']);
	     return $instance;
	}

	// display widget
	function widget($args, $instance) {
		extract( $args );
		// style
		wp_enqueue_style( 'mypricerange-style', plugins_url('widget-pricerange.css', __FILE__) );
		wp_enqueue_script( 'mypricerange-script', plugins_url('myprice-range.js', __FILE__) );
		
		// these are the widget options
		$title = apply_filters('widget_title', $instance['title']);
		$textarea = $instance['textarea'];

		echo $before_widget;
		// Display the widget
		echo '<div class="widget-text wp_widget_plugin_box">';

?>
	
		<div><h4 style="text-align: center; padding-top:15px; padding-bottom:15px;"><?=$title;?><span class="homeCost">$300,000</span></h4></div>
		
		<div id="slider-container">
		  <div id="js-slider" class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content">
		  	<div class="slider-range-inverse" style="width: 100%;"></div>
		  	<div class="ui-slider-range ui-corner-all ui-widget-header ui-slider-range-min" style="width: 0%;"></div>
		  	<span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;">
		  		<span class="dot">
		  			<span class="handle-track" style="width: 1000px; left: 0px;"></span> 
		  		</span> 
		  	</span> 
		  </div>
		</div>

		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="row">
					<div class="col-md-4">
						<ul style="width:225px" class="list-inline savings-calculator-results">
							<li class="savings-calculator-results-label">Buyer Cashback</li>
							<li class="buyerCashback savings-calculator-results-amount">$1,000</li>
						</ul>
					</div>

					<div class="col-md-4">
						<ul style="width:225px" class="list-inline savings-calculator-results">
							<li class="savings-calculator-results-label">Seller Savings<br>(Outside Buyer)</li>
							<li class="homeSavings savings-calculator-results-amount">$1,050</li>
						</ul>
					</div>

					<div class="col-md-4">
						<ul style="width:225px" class="list-inline savings-calculator-results">
							<li class="savings-calculator-results-label">Seller Savings<br>(BetterWay Buyer)</li>
							<li class="sellerBetterwayBuyer savings-calculator-results-amount">$2,100</li>
						</ul>
					</div>
			</div>
			</div>
		</div>
		
		<div>
			<p style="text-align: center; font-size: 14px; margin-top: 20px;"><?=$textarea;?></p>
		</div>

<?php
		echo '</div>';
		echo $after_widget;
	}
}

// register widget
add_action('widgets_init', create_function('', 'return register_widget("kako_priceRange");'));


function wpb_widgets_init() {
 
    register_sidebar( array(
        'name' => __( 'Price Range Section', 'kk_price_range' ),
        'id' => 'kk-price-range-sidebar',
        'description' => __( 'The Price Range section appears every time it called.', 'kk_price_range' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>'
    ) );
 }

// register sidebar
add_action( 'widgets_init', 'wpb_widgets_init' );