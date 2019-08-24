<?php
$wabShowMessage = false;

if(isset($_POST['updateSettings'])){
     if (!isset($_POST['wab_update_setting'])) die("Something wrong!");
     if (!wp_verify_nonce($_POST['wab_update_setting'],'wab-update-setting')) die("Something wrong!");
     for($i=0; $i<count($_POST['wab_name']); $i++){
          $wabMkArr[sanitize_text_field(strtolower($_POST['wab_name'][$i]))] = array(
                                                                 'wab_description'   => (!empty($_POST['wab_description'][$i]) && (sanitize_textarea_field($_POST['wab_description'][$i])!='')) ? sanitize_textarea_field($_POST['wab_description'][$i]) : '',
                                                                 'wab_bg_color'      => (!empty($_POST['wab_bg_color'][$i]) && (sanitize_text_field($_POST['wab_bg_color'][$i])!='')) ? sanitize_text_field($_POST['wab_bg_color'][$i]) : ''
                                                                 );
     }
     $wabShowMessage = update_option('wab_settings', $wabMkArr);
}
$wab_settings = get_option('wab_settings');
?>
<div id="wph-wrap-all" class="wrap">
     <div class="settings-banner">
          <h2><?php esc_html_e('WP Alert Bar Settings', WAB_TXT_DOMAIN); ?></h2>
     </div>
     <?php if($wabShowMessage): $this->wab_display_notification('success', 'Your information updated successfully.'); endif; ?>

     <form name="wpre-table" role="form" class="form-horizontal" method="post" action="" id="wab-settings-form">
          <input type="hidden" name="wab_update_setting" value="<?php printf('%s', wp_create_nonce('wab-update-setting')); ?>" />
          <table class="wab-form-table">
          <tr>
               <td colspan="2">
                    <table class="wab-alert-bar-table" width="100%" cellpadding="0" cellspacing="0">
                         <thead>
                              <tr>
                                   <th>#</th>
                                   <th>Title</th>
                                   <th>Description</th>
                                   <th>BG Color</th>
                                   <th><input type="button" class="button button-primary add" value="Add New"></th>
                              <tr>
                         </thead>
                         <tbody class="wab-add-row-tbody">
                              <?php
                              $i=0;
                              if($wab_settings) {
                                   for($i=0; $i<count($wab_settings); $i++){
                                        $wabArrayKey = array_keys($wab_settings)[$i];
                                        ?>
                                        <tr class="wab-add-row-tr">
                                             <td style="vertical-align: top;"><?php printf('%d', $i); ?></td>
                                             <td class="wab_name" style="vertical-align: top;">
                                                  <input type="text" name="wab_name[]" class="wab_name" placeholder="Alert Bar Name" value="<?php esc_attr_e($wabArrayKey); ?>">
                                             </td>
                                             <td class="wab_description" style="vertical-align: top;">
                                                  <textarea name="wab_description[]" class="wab_description" cols="50" rows="1"><?php esc_html_e($wab_settings[$wabArrayKey]['wab_description']); ?></textarea>
                                             </td>
                                             <td class="wab_bg_color" style="vertical-align: top;">
                                                  <input class="wab-wp-color" type="text" name="wab_bg_color[]" id="wab_bg_color_<?php printf('%d', $i); ?>" value="<?php esc_attr_e($wab_settings[$wabArrayKey]['wab_bg_color']); ?>">
                                                  <div id="colorpicker"></div>
                                             </td>
                                             <td style="vertical-align: top;"><a href="#" class="dashicons dashicons-no delete">&nbsp;</a></td>
                                        <tr>
                                        <?php
                                   }
                              } else{ ?>
                                        <tr class="wab-add-row-tr">
                                             <td style="vertical-align: top;"><?php printf('%d', $i+1); ?></td>
                                             <td class="wab_name" style="vertical-align: top;">
                                                  <input type="text" name="wab_name[]" class="wab_name" placeholder="Alert Bar Name">
                                             </td style="vertical-align: top;">
                                             <td class="wab_description" style="vertical-align: top;">
                                                  <textarea name="wab_description[]" class="wab_description" cols="50" rows="1"></textarea>
                                             </td>
                                             <td class="wab_bg_color" style="vertical-align: top;">
                                                  <input class="wab-wp-color" type="text" name="wab_bg_color[]" id="wab_bg_color_<?php printf('%d', $i+1); ?>">
                                                  <div id="colorpicker"></div>
                                             </td>
                                             <td style="vertical-align: top;"></td>
                                        <tr>
                              <?php } ?>
                         </tbody>
                    </table>
               </td>
          </tr>
          <tr class="wab_shortcode">
               <th scope="row">
                    <label for="wab_shortcode"><?php esc_html_e('Shortcode: ', WAB_TXT_DOMAIN); ?></label>
               </th>
               <td>
                    <input type="text" name="wab_shortcode" id="wab_shortcode" class="regular-text" value="[wp_alert_bars]" readonly />
               </td>
          </tr>
          </table>
          <p class="submit"><button id="updateSettings" name="updateSettings" class="button button-primary"><?php esc_attr_e('Update Settings', WAB_TXT_DOMAIN); ?></button></p>
     </form>
</div>