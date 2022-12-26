<?php
/**
 * Plugin Name:     Squadwe Plugin
 * Plugin URI:      https://www.squadwe.com/
 * Description:     Squadwe Plugin for WordPress. This plugin helps you to quickly integrate Squadwe live-chat widget on Wordpress websites.
 * Text Domain:     squadwe-plugin
 * Version:         0.2.0
 *
 * @package         squadwe-plugin
 */

add_action('admin_enqueue_scripts', 'admin_styles');
/**
 * Load Squadwe Admin CSS.
 *
 * @since 0.1.0
 *
 * @return {void}.
 */
function admin_styles() {
  wp_enqueue_style('admin-styles', plugin_dir_url(__FILE__) . '/admin.css');
}

 add_action( 'wp_enqueue_scripts', 'squadwe_assets' );
/**
 * Load Squadwe Assets.
 *
 * @since 0.1.0
 *
 * @return {void}.
 */
function squadwe_assets() {
    wp_enqueue_script( 'squadwe-client', plugins_url( '/js/squadwe.js' , __FILE__ ) );
}

add_action( 'wp_enqueue_scripts', 'squadwe_load' );
/**
 * Initialize embed code options.
 *
 * @since 0.1.0
 *
 * @return {void}.
 */
function squadwe_load() {

  // Get our site options for site url and token.
  $squadwe_url = get_option('squadweSiteURL');
  $squadwe_token = get_option('squadweSiteToken');
  $squadwe_widget_locale = get_option('squadweWidgetLocale');
  $squadwe_widget_type = get_option('squadweWidgetType');
  $squadwe_widget_position = get_option('squadweWidgetPosition');
  $squadwe_launcher_text = get_option('squadweLauncherText');

  // Localize our variables for the Javascript embed code.
  wp_localize_script('squadwe-client', 'squadwe_token', $squadwe_token);
  wp_localize_script('squadwe-client', 'squadwe_url', $squadwe_url);
  wp_localize_script('squadwe-client', 'squadwe_widget_locale', $squadwe_widget_locale);
  wp_localize_script('squadwe-client', 'squadwe_widget_type', $squadwe_widget_type);
  wp_localize_script('squadwe-client', 'squadwe_launcher_text', $squadwe_launcher_text);
  wp_localize_script('squadwe-client', 'squadwe_widget_position', $squadwe_widget_position);
}

add_action('admin_menu', 'squadwe_setup_menu');
/**
 * Set up Settings options page.
 *
 * @since 0.1.0
 *
 * @return {void}.
 */
function squadwe_setup_menu(){
    add_options_page('Option', 'Squadwe Settings', 'manage_options', 'squadwe-plugin-options', 'squadwe_options_page');
}

add_action( 'admin_init', 'squadwe_register_settings' );
/**
 * Register Settings.
 *
 * @since 0.1.0
 *
 * @return {void}.
 */
function squadwe_register_settings() {
  add_option('squadweSiteToken', '');
  add_option('squadweSiteURL', '');
  add_option('squadweWidgetLocale', 'en');
  add_option('squadweWidgetType', 'standard');
  add_option('squadweWidgetPosition', 'right');
  add_option('squadweLauncherText', '');

  register_setting('squadwe-plugin-options', 'squadweSiteToken' );
  register_setting('squadwe-plugin-options', 'squadweSiteURL');
  register_setting('squadwe-plugin-options', 'squadweWidgetLocale' );
  register_setting('squadwe-plugin-options', 'squadweWidgetType' );
  register_setting('squadwe-plugin-options', 'squadweWidgetPosition' );
  register_setting('squadwe-plugin-options', 'squadweLauncherText' );
}

/**
 * Render page.
 *
 * @since 0.1.0
 *
 * @return {void}.
 */
function squadwe_options_page() {
  ?>
  <div>
    <h2>Squadwe Settings</h2>
    <form method="post" action="options.php" class="squadwe--form">
      <?php settings_fields('squadwe-plugin-options'); ?>
      <div class="form--input">
        <label for="squadweSiteToken">Squadwe Website Token</label>
        <input
          type="text"
          name="squadweSiteToken"
          value="<?php echo get_option('squadweSiteToken'); ?>"
        />
      </div>
      <div class="form--input">
        <label for="squadweSiteURL">Squadwe Installation URL</label>
        <input
          type="text"
          name="squadweSiteURL"
          value="<?php echo get_option('squadweSiteURL'); ?>"
        />
      </div>
      <hr />

      <div class="form--input">
        <label for="squadweWidgetType">Widget Design</label>
        <select name="squadweWidgetType">
          <option value="standard" <?php selected(get_option('squadweWidgetType'), 'standard'); ?>>Standard</option>
          <option value="expanded_bubble" <?php selected(get_option('squadweWidgetType'), 'expanded_bubble'); ?>>Expanded Bubble</option>
        </select>
      </div>
      <div class="form--input">
        <label for="squadweWidgetPosition">Widget Position</label>
        <select name="squadweWidgetPosition">
          <option value="left" <?php selected(get_option('squadweWidgetPosition'), 'left'); ?>>Left</option>
          <option value="right" <?php selected(get_option('squadweWidgetPosition'), 'right'); ?>>Right</option>
        </select>
      </div>
      <div class="form--input">
        <label for="squadweWidgetLocale">Language</label>
        <select name="squadweWidgetLocale">
          <option <?php selected(get_option('squadweWidgetLocale'), 'ar'); ?> value="ar">العربية (ar)</option>
          <option <?php selected(get_option('squadweWidgetLocale'), 'ca'); ?> value="ca">Català (ca)</option>
          <option <?php selected(get_option('squadweWidgetLocale'), 'cs'); ?> value="cs">čeština (cs)</option>
          <option <?php selected(get_option('squadweWidgetLocale'), 'da'); ?> value="da">dansk (da)</option>
          <option <?php selected(get_option('squadweWidgetLocale'), 'de'); ?> value="de">Deutsch (de)</option>
          <option <?php selected(get_option('squadweWidgetLocale'), 'el'); ?> value="el">ελληνικά (el)</option>
          <option <?php selected(get_option('squadweWidgetLocale'), 'en'); ?> value="en">English (en)</option>
          <option <?php selected(get_option('squadweWidgetLocale'), 'es'); ?> value="es">Español (es)</option>
          <option <?php selected(get_option('squadweWidgetLocale'), 'fa'); ?> value="fa">فارسی (fa)</option>
          <option <?php selected(get_option('squadweWidgetLocale'), 'fi'); ?> value="fi">suomi, suomen kieli (fi)</option>
          <option <?php selected(get_option('squadweWidgetLocale'), 'fr'); ?> value="fr">Français (fr)</option>
          <option <?php selected(get_option('squadweWidgetLocale'), 'hi'); ?> value="hi'">हिन्दी (hi)</option>
          <option <?php selected(get_option('squadweWidgetLocale'), 'hu'); ?> value="hu">magyar nyelv (hu)</option>
          <option <?php selected(get_option('squadweWidgetLocale'), 'id'); ?> value="id">Bahasa Indonesia (id)</option>
          <option <?php selected(get_option('squadweWidgetLocale'), 'it'); ?> value="it">Italiano (it)</option>
          <option <?php selected(get_option('squadweWidgetLocale'), 'ja'); ?> value="ja">日本語 (ja)</option>
          <option <?php selected(get_option('squadweWidgetLocale'), 'ko'); ?> value="ko">한국어 (ko)</option>
          <option <?php selected(get_option('squadweWidgetLocale'), 'ml'); ?> value="ml">മലയാളം (ml)</option>
          <option <?php selected(get_option('squadweWidgetLocale'), 'nl'); ?> value="nl">Nederlands (nl) </option>
          <option <?php selected(get_option('squadweWidgetLocale'), 'no'); ?> value="no">norsk (no)</option>
          <option <?php selected(get_option('squadweWidgetLocale'), 'pl'); ?> value="pl">język polski (pl)</option>
          <option <?php selected(get_option('squadweWidgetLocale'), 'pt_BR'); ?> value="pt_BR">Português Brasileiro (pt-BR)
          <option <?php selected(get_option('squadweWidgetLocale'), 'pt'); ?> value="pt">Português (pt)</option>
          <option <?php selected(get_option('squadweWidgetLocale'), 'ro'); ?> value="ro">Română (ro)</option>
          <option <?php selected(get_option('squadweWidgetLocale'), 'ru'); ?> value="ru">русский (ru)</option>
          <option <?php selected(get_option('squadweWidgetLocale'), 'sv'); ?> value="sv">Svenska (sv)</option>
          <option <?php selected(get_option('squadweWidgetLocale'), 'ta'); ?> value="ta">தமிழ் (ta)</option>
          <option <?php selected(get_option('squadweWidgetLocale'), 'tr'); ?> value="tr">Türkçe (tr)</option>
          <option <?php selected(get_option('squadweWidgetLocale'), 'vi'); ?> value="vi">Tiếng Việt (vi)</option>
          <option <?php selected(get_option('squadweWidgetLocale'), 'zh_CN'); ?> value="zh_CN">中文 (zh-CN)</option>
          <option <?php selected(get_option('squadweWidgetLocale'), 'zh_TW'); ?> value="zh_TW">中文 (台湾) (zh-TW)</option>
          <option <?php selected(get_option('squadweWidgetLocale'), 'zh'); ?> value="zh'">中文 (zh)</option>
        </select>
      </div>
      <?php if (get_option('squadweWidgetType') == 'expanded_bubble') : ?>
        <div class="form--input">
          <label for="squadweLauncherText">Launcher Text (Optional)</label>
          <input
            type="text"
            name="squadweLauncherText"
            value="<?php echo get_option('squadweLauncherText'); ?>"
          />
        </div>
      <?php endif; ?>
      <?php submit_button(); ?>
    </form>
  </div>
<?php
}
