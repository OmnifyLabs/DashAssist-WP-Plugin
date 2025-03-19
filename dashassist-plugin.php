<?php
/**
 * Plugin Name:     DashAssist Plugin
 * Plugin URI:      https://www.dashassist.ai/
 * Description:     DashAssist Plugin for WordPress. This plugin helps you to quickly integrate DashAssist live-chat widget on Wordpress websites.
 * Author:          Omnify Labs
 * Author URI:      https://www.dashassist.ai/
 * Text Domain:     dashassist-plugin
 * Version:         0.1.0
 *
 * @package         dashassist-plugin
 */

add_action('admin_enqueue_scripts', 'admin_styles');
/**
 * Load DashAssist Admin CSS.
 *
 * @since 0.1.0
 *
 * @return {void}.
 */
function admin_styles() {
  wp_enqueue_style('admin-styles', plugin_dir_url(__FILE__) . '/admin.css');
}

 add_action( 'wp_enqueue_scripts', 'dashassist_assets' );
/**
 * Load DashAssist Assets.
 *
 * @since 0.1.0
 *
 * @return {void}.
 */
function dashassist_assets() {
    wp_enqueue_script( 'dashassist-client', plugins_url( '/js/dashassist.js' , __FILE__ ) );
}

add_action( 'wp_enqueue_scripts', 'dashassist_load' );
/**
 * Initialize embed code options.
 *
 * @since 0.1.0
 *
 * @return {void}.
 */
function dashassist_load() {

  // Get our site options for site url and token.
  $dashassist_url = "https://app.dashassist.ai";
  $dashassist_token = get_option('dashassistSiteToken');
  $dashassist_widget_locale = get_option('dashassistWidgetLocale');
  $dashassist_widget_type = get_option('dashassistWidgetType');
  $dashassist_widget_position = get_option('dashassistWidgetPosition');
  $dashassist_launcher_text = get_option('dashassistLauncherText');

  // Localize our variables for the Javascript embed code.
  wp_localize_script('dashassist-client', 'dashassist_token', $dashassist_token);
  wp_localize_script('dashassist-client', 'dashassist_url', $dashassist_url);
  wp_localize_script('dashassist-client', 'dashassist_widget_locale', $dashassist_widget_locale);
  wp_localize_script('dashassist-client', 'dashassist_widget_type', $dashassist_widget_type);
  wp_localize_script('dashassist-client', 'dashassist_launcher_text', $dashassist_launcher_text);
  wp_localize_script('dashassist-client', 'dashassist_widget_position', $dashassist_widget_position);
}

add_action('admin_menu', 'dashassist_setup_menu');
/**
 * Set up Settings options page.
 *
 * @since 0.1.0
 *
 * @return {void}.
 */
function dashassist_setup_menu(){
    add_options_page('Option', 'DashAssist Settings', 'manage_options', 'dashassist-plugin-options', 'dashassist_options_page');
}

add_action( 'admin_init', 'dashassist_register_settings' );
/**
 * Register Settings.
 *
 * @since 0.1.0
 *
 * @return {void}.
 */
function dashassist_register_settings() {
  add_option('dashassistSiteToken', '');
  add_option('dashassistWidgetLocale', 'en');
  add_option('dashassistWidgetType', 'standard');
  add_option('dashassistWidgetPosition', 'right');
  add_option('dashassistLauncherText', '');

  register_setting('dashassist-plugin-options', 'dashassistSiteToken' );
  register_setting('dashassist-plugin-options', 'dashassistWidgetLocale' );
  register_setting('dashassist-plugin-options', 'dashassistWidgetType' );
  register_setting('dashassist-plugin-options', 'dashassistWidgetPosition' );
  register_setting('dashassist-plugin-options', 'dashassistLauncherText' );
}

/**
 * Render page.
 *
 * @since 0.1.0
 *
 * @return {void}.
 */
function dashassist_options_page() {
  ?>
  <div>
    <h2>DashAssist Settings</h2>
    <form method="post" action="options.php" class="dashassist--form">
      <?php settings_fields('dashassist-plugin-options'); ?>
      <div class="form--input">
        <label for="dashassistSiteToken">DashAssist Website Token</label>
        <input
          type="text"
          name="dashassistSiteToken"
          value="<?php echo get_option('dashassistSiteToken'); ?>"
        />
      </div>
      <hr />

      <div class="form--input">
        <label for="dashassistWidgetType">Widget Design</label>
        <select name="dashassistWidgetType">
          <option value="standard" <?php selected(get_option('dashassistWidgetType'), 'standard'); ?>>Standard</option>
          <option value="expanded_bubble" <?php selected(get_option('dashassistWidgetType'), 'expanded_bubble'); ?>>Expanded Bubble</option>
        </select>
      </div>
      <div class="form--input">
        <label for="dashassistWidgetPosition">Widget Position</label>
        <select name="dashassistWidgetPosition">
          <option value="left" <?php selected(get_option('dashassistWidgetPosition'), 'left'); ?>>Left</option>
          <option value="right" <?php selected(get_option('dashassistWidgetPosition'), 'right'); ?>>Right</option>
        </select>
      </div>
      <div class="form--input">
        <label for="dashassistWidgetLocale">Language</label>
        <select name="dashassistWidgetLocale">
          <option <?php selected(get_option('dashassistWidgetLocale'), 'ar'); ?> value="ar">العربية (ar)</option>
          <option <?php selected(get_option('dashassistWidgetLocale'), 'ca'); ?> value="ca">Català (ca)</option>
          <option <?php selected(get_option('dashassistWidgetLocale'), 'cs'); ?> value="cs">čeština (cs)</option>
          <option <?php selected(get_option('dashassistWidgetLocale'), 'da'); ?> value="da">dansk (da)</option>
          <option <?php selected(get_option('dashassistWidgetLocale'), 'de'); ?> value="de">Deutsch (de)</option>
          <option <?php selected(get_option('dashassistWidgetLocale'), 'el'); ?> value="el">ελληνικά (el)</option>
          <option <?php selected(get_option('dashassistWidgetLocale'), 'en'); ?> value="en">English (en)</option>
          <option <?php selected(get_option('dashassistWidgetLocale'), 'es'); ?> value="es">Español (es)</option>
          <option <?php selected(get_option('dashassistWidgetLocale'), 'fa'); ?> value="fa">فارسی (fa)</option>
          <option <?php selected(get_option('dashassistWidgetLocale'), 'fi'); ?> value="fi">suomi, suomen kieli (fi)</option>
          <option <?php selected(get_option('dashassistWidgetLocale'), 'fr'); ?> value="fr">Français (fr)</option>
          <option <?php selected(get_option('dashassistWidgetLocale'), 'hi'); ?> value="hi'">हिन्दी (hi)</option>
          <option <?php selected(get_option('dashassistWidgetLocale'), 'hu'); ?> value="hu">magyar nyelv (hu)</option>
          <option <?php selected(get_option('dashassistWidgetLocale'), 'id'); ?> value="id">Bahasa Indonesia (id)</option>
          <option <?php selected(get_option('dashassistWidgetLocale'), 'it'); ?> value="it">Italiano (it)</option>
          <option <?php selected(get_option('dashassistWidgetLocale'), 'ja'); ?> value="ja">日本語 (ja)</option>
          <option <?php selected(get_option('dashassistWidgetLocale'), 'ko'); ?> value="ko">한국어 (ko)</option>
          <option <?php selected(get_option('dashassistWidgetLocale'), 'ml'); ?> value="ml">മലയാളം (ml)</option>
          <option <?php selected(get_option('dashassistWidgetLocale'), 'nl'); ?> value="nl">Nederlands (nl) </option>
          <option <?php selected(get_option('dashassistWidgetLocale'), 'no'); ?> value="no">norsk (no)</option>
          <option <?php selected(get_option('dashassistWidgetLocale'), 'pl'); ?> value="pl">język polski (pl)</option>
          <option <?php selected(get_option('dashassistWidgetLocale'), 'pt_BR'); ?> value="pt_BR">Português Brasileiro (pt-BR)
          <option <?php selected(get_option('dashassistWidgetLocale'), 'pt'); ?> value="pt">Português (pt)</option>
          <option <?php selected(get_option('dashassistWidgetLocale'), 'ro'); ?> value="ro">Română (ro)</option>
          <option <?php selected(get_option('dashassistWidgetLocale'), 'ru'); ?> value="ru">русский (ru)</option>
          <option <?php selected(get_option('dashassistWidgetLocale'), 'sv'); ?> value="sv">Svenska (sv)</option>
          <option <?php selected(get_option('dashassistWidgetLocale'), 'ta'); ?> value="ta">தமிழ் (ta)</option>
          <option <?php selected(get_option('dashassistWidgetLocale'), 'tr'); ?> value="tr">Türkçe (tr)</option>
          <option <?php selected(get_option('dashassistWidgetLocale'), 'vi'); ?> value="vi">Tiếng Việt (vi)</option>
          <option <?php selected(get_option('dashassistWidgetLocale'), 'zh_CN'); ?> value="zh_CN">中文 (zh-CN)</option>
          <option <?php selected(get_option('dashassistWidgetLocale'), 'zh_TW'); ?> value="zh_TW">中文 (台湾) (zh-TW)</option>
          <option <?php selected(get_option('dashassistWidgetLocale'), 'zh'); ?> value="zh'">中文 (zh)</option>
        </select>
      </div>
      <?php if (get_option('dashassistWidgetType') == 'expanded_bubble') : ?>
        <div class="form--input">
          <label for="dashassistLauncherText">Launcher Text (Optional)</label>
          <input
            type="text"
            name="dashassistLauncherText"
            value="<?php echo get_option('dashassistLauncherText'); ?>"
          />
        </div>
      <?php endif; ?>
      <?php submit_button(); ?>
    </form>
  </div>
<?php
}
