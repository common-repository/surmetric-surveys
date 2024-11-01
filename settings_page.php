<?php

if(!defined('ABSPATH')) {
	exit;
}

wp_enqueue_style('wp-color-picker');
wp_enqueue_script('surmetric_settings_javascript', plugins_url('settings_page.js', __FILE__ ), array('wp-color-picker'), false, true);
if (!array_key_exists('surmetric-settings-nonce', $_POST) || (array_key_exists('surmetric-settings-nonce', $_POST) && wp_verify_nonce($_POST['surmetric-settings-nonce'], 'surmetric-settings-nonce'))) {
  if(array_key_exists('campaign_id', $_POST) && array_key_exists('background_color', $_POST)
  && array_key_exists('font_color', $_POST) && array_key_exists('muted_color', $_POST) && array_key_exists('font_size', $_POST) && array_key_exists('box_shadow', $_POST)) {
    $campaign_id = sanitize_title($_POST['campaign_id']);
    $font_color = sanitize_hex_color($_POST['font_color']);
    $background_color = sanitize_hex_color($_POST['background_color']);
    $muted_color = sanitize_hex_color($_POST['muted_color']);
    $font_size = sanitize_title($_POST['font_size']);
    $box_shadow = sanitize_title($_POST['box_shadow']);
    if (strlen($campaign_id) != 36) {
      ?>
      <div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible">
        <strong>Invalid Campaign ID!</strong>
      </div>
      <?php
    } else {
      update_option('surmetric_campaign_id', $campaign_id);
      update_option('surmetric_font_color', $font_color);
      update_option('surmetric_background_color', $background_colors);
      update_option('surmetric_box_shadow', $box_shadow);
      update_option('surmetric_muted_color', $muted_color);
      update_option('surmetric_font_size', $font_size);
      ?>
      <div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible">
        <strong>Your settings have been updated.</strong>
      </div>
      <?php
    }
  }
} else {
  ?>
  <div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible">
    <strong>Not Authorized!</strong>
  </div>
  <?php
}

$campaign_id = get_option('surmetric_campaign_id', '');
$font_color = get_option('surmetric_font_color', '#000000');
$background_color = get_option('surmetric_background_color', '#ffffff');
$muted_color = get_option('surmetric_muted_color', '#000000');
$font_size = get_option('surmetric_font_size', '16');
$box_shadow = get_option('surmetric_box_shadow', 'true');
?>
<style>body { background-color: white; }</style>
<div class="wrap">
  <h2>Surmetric Options</h2>
  <p>
    This is where you can edit the settings for your survey on your site.<br><br>
    If you need to create your survey vist <a target="_blank" href="https://surmetric.com/register">Surmetric</a>
    and signup to create your super customizable survey with 25 responses absolutely free!<br>
    Once you have updated your Campaign ID you can display your survey on your site by either
    using our survey widget or add to a page with the shortcode: [survey]. However, you can not do both at the same time.<br><br>
    Visit our <a target="_blank" href="https://surmetric.com/howto">how to</a>
    for more information on creating a survey and campaign and getting the Campaign ID for your campaign.<br><br>
  </p>
  <hr>
  <br>
  <form method="POST" action="">
    <input type="hidden" name="surmetric-settings-nonce" value="<?php echo wp_create_nonce('surmetric-settings-nonce'); ?>" />
    <h4>Campaign ID</h4>
    <label for="campaign_id">Your Campaign ID determins which survey is displayed on your site.<br>Add your Campaign ID here:</label>
    <br>
    <input type="text" name="campaign_id" style="width: 300px" value="<?php echo $campaign_id; ?>" />
    <br><br>
    <h4>Font Color</h4>
    <label for="font_color">Your font color will change the color of the survey font and the next, prev buttons when they're active at the bottom of the survey.<br>Chose your font color here:</label>
    <input name="font_color" class="settings-color-picker" type="text" value="<?php echo $font_color ?>"  />
    <br>
    <h4>Background Color</h4>
    <label for="background_color">Your background color determines the color of the entire survey frame, not just the survey itself.<br>Chose your background color here:</label>
    <input name="background_color" class="settings-color-picker" type="text" value="<?php echo $background_color ?>" />
    <br>
    <h4>Muted Color</h4>
    <label for="muted_color">Your muted color the various muted iteractables on the survey, such as the drag icons, the indivdual page buttons, and more.<br>Chose your muted color here:</label>
    <input name="muted_color" class="settings-color-picker" type="text" value="<?php echo $muted_color ?>" />
    <br>
    <h4>Font Size</h4>
    <label for="font_size">Your font size determines the size of the question font and the answers font.<br>Chose your font size here:</label>
    <br>
    <select name="font_size" >
      <option value="10"<?php echo $font_size == 10 ? " selected" : ""; ?>>10</option>
      <option value="12"<?php echo $font_size == 12 ? " selected" : ""; ?>>12</option>
      <option value="14"<?php echo $font_size == 14 ? " selected" : ""; ?>>14</option>
      <option value="16"<?php echo $font_size == 16 ? " selected" : ""; ?>>16</option>
      <option value="18"<?php echo $font_size == 18 ? " selected" : ""; ?>>18</option>
      <option value="20"<?php echo $font_size == 20 ? " selected" : ""; ?>>20</option>
    </select>
    <br>
    <h4>Box Shadow</h4>
    <label for="box_shadow">The box shadow is a shadow around the survey container.<br>Chose wether you want a box shadow here:</label>
    <br>
    <select name="box_shadow">
      <option value="true"<?php echo $box_shadow == "true" ? " selected" : ""; ?>>Yes</option>
      <option value="false"<?php echo $box_shadow == "false" ? " selected" : ""; ?>>No</option>
    </select>
    <br><br>
    <input type="submit" name="submit_campaign_id" class="button button-primary" width="80" value="Save Settings" />
  </form>
</div>
<script>
jQuery(document).ready(function($){
    $('.settings-color-picker').wpColorPicker();
});
</script>
