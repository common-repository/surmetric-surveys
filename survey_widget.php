<?php

class Surmetric_Survey_Widget extends WP_Widget {

	function __construct() {

		$args = array(
			'description' => esc_html__('Widget used to embed your Surmetric survey and collect responses on your WordPress site.', 'sas_domain')
		);

		parent::__construct('sa_survey_widget', 'Surmetric Surveys', $args);
	}

	public function widget($args, $instance) {
		$campaign_id = get_option('surmetric_campaign_id', '');
		$json['color'] = get_option('surmetric_font_color', '#000000');
		$json['background'] = get_option('surmetric_background_color', '#ffffff');
		$json['shadow'] = filter_var(get_option('surmetric_box_shadow', 'false'), FILTER_VALIDATE_BOOLEAN);
		$json['mutedColor'] = get_option('surmetric_muted_color', '#000000');
		$json['fontSize'] = get_option('surmetric_font_size', '16') . "px";
		?>
		<label><?php echo $instance['survey_header']; ?></label>
		<div class="sophware-survey" data-uid="<?php echo $campaign_id; ?>" data-style='<?php echo json_encode($json); ?>'></div>
		<?php
	}

	public function form($instance) {
		$survey_header = !empty($instance['survey_header']) ? $instance['survey_header'] : '';
		?>
		<p>
		 <label for="<?php echo esc_attr($this->get_field_id('survey_header')); ?>"><?php esc_attr_e('Survey Header:', 'sas_domain'); ?></label>
 		 <input class="widefat" id="<?php print esc_attr($this->get_field_id('survey_header')); ?>" name="<?php echo esc_attr($this->get_field_name('survey_header')); ?>" type="text" value="<?php echo esc_attr($survey_header); ?>">
		</p>
		<?php
	}

	public function update($new_instance, $old_instance) {
		$instance = array();
		$instance['survey_header'] = (!empty($new_instance['survey_header'])) ? strip_tags($new_instance['survey_header']) : '';
		return $instance;
	}

}

?>
