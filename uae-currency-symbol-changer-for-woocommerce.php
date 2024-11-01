<?php
/**
 * UAE Currency Symbol Changer for WooCommerce
 *
 * @package           UAECurrencySymbolChangerForWooCommerce
 * @author            Cristus Cleetus
 * @copyright         2024 Cristus Cleetus
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       UAE Currency Symbol Changer for WooCommerce
 * Plugin URI:        https://cristuscleetus.com/uae-currency-symbol-changer-for-woocommerce/
 * Description:       This plugin will change the default WooCommerce UAE currency symbol from Arabic "د.إ" to English "AED".
 * Version:           1.0.1
 * Requires at least: 3.0
 * Tested up to:      6.5  
 * Requires PHP:      7.4
 * Author:            Cristus Cleetus
 * Author URI:        https://cristuscleetus.com
 * Text Domain:       uae-currency-symbol-changer-for-woocommerce
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

add_action('admin_init', 'child_plugin_has_parent_plugin');
function child_plugin_has_parent_plugin() {
    if (is_admin() && current_user_can('activate_plugins') && !is_plugin_active('woocommerce/woocommerce.php')) {
        add_action('admin_notices', 'child_plugin_notice');

        // Nonce verification for added security
        if (isset($_GET['activate']) && isset($_GET['plugin_nonce']) && wp_verify_nonce($_GET['plugin_nonce'], 'activate_plugin_nonce')) {
            unset($_GET['activate']);
        }
    }
}

function child_plugin_notice() {
    echo '<div class="error"><p>' . __('UAE Currency Symbol Changer for WooCommerce plugin works only with WooCommerce. Please activate WooCommerce to use this plugin or deactivate this plugin if you are not using WooCommerce.', 'uae-currency-symbol-changer-for-woocommerce') . '</p></div>';
}

add_filter('woocommerce_currency_symbol', 'cc_change_uae_default_currency_symbol', 10, 2);
function cc_change_uae_default_currency_symbol($currency_symbol, $currency) {
    if ($currency === 'AED') {
        $currency_symbol = 'AED ';
    }
    return $currency_symbol;
}
?>
