<?php
/**
 * Plugin Name: PsalmoteeData Landing Page
 * Plugin URI: https://github.com/psalmotee/Psalmoteedata-Panding-Page
 * Description: Integrates the PsalmoteeData React landing page with WordPress.
 * Version: 1.3.1
 * Author: Psalmotee-Tech
 * Author URI: https://portfolio-psalmotee.netlify.app/
 * Requires at least: 6.0
 * Requires PHP: 7.4
 */

if (!defined('ABSPATH')) {
    exit;
}

// Define the plugin version constant for use in enqueuing assets.
define('PDLP_VERSION', '1.3.1');

/*
|--------------------------------------------------------------------------
| Plugin Constants
|--------------------------------------------------------------------------
*/

define('PDLP_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('PDLP_PLUGIN_URL', plugin_dir_url(__FILE__));


/*
|--------------------------------------------------------------------------
| GitHub Automatic Updates
|--------------------------------------------------------------------------
*/
/**
 * Initialize automatic updates from GitHub Releases.
 *
 * The release must contain an asset named:
 * psalmoteedata-landing.zip
 */
function pdlp_initialize_update_checker() {
    $updater_file = PDLP_PLUGIN_DIR
        . 'plugin-update-checker/plugin-update-checker.php';

    // Avoid errors if the updater library is missing.
    if (!file_exists($updater_file)) {
        return;
    }

    require_once $updater_file;

    $factory = '\YahnisElsts\PluginUpdateChecker\v5p7\PucFactory';

    if (!class_exists($factory)) {
        return;
    }

    $update_checker = $factory::buildUpdateChecker(
        'https://github.com/psalmotee/Psalmoteedata-Panding-Page/',
        __FILE__,
        'psalmoteedata-landing'
    );

    // Use our packaged plugin ZIP instead of GitHub's source ZIP.
    $update_checker->getVcsApi()->enableReleaseAssets(
        '/^psalmoteedata-landing\.zip$/i'
    );
}

add_action('plugins_loaded', 'pdlp_initialize_update_checker');


/*
|--------------------------------------------------------------------------
| Standalone Page Template
|--------------------------------------------------------------------------
*/

/**
 * Register the landing-page template in the WordPress page editor.
 */
function pdlp_register_page_template($templates) {

    $templates['templates/psalmotee-landing-template.php'] =
        'Psalmotee React Landing Page (Standalone)';

    $templates['templates/psalmotee-offline-template.php'] =
        'Psalmotee Offline Account (Standalone)';

    return $templates;
}

add_filter('theme_page_templates', 'pdlp_register_page_template');


/**
 * Load custom standalone templates from this plugin.
 *
 * This bypasses the theme's normal page layout when the
 * standalone template is selected.
 * Supports:
 * - React landing page
 * - Offline account page
 */
function pdlp_load_page_template($template) {

    if (!is_page()) {
        return $template;
    }

    $selected_template = get_page_template_slug(
        get_queried_object_id()
    );

    $custom_templates = array(
        'templates/psalmotee-landing-template.php',
        'templates/psalmotee-offline-template.php',
    );

    if (!in_array($selected_template, $custom_templates, true)) {
        return $template;
    }

    $plugin_template = PDLP_PLUGIN_DIR . $selected_template;

    if (file_exists($plugin_template)) {
        return $plugin_template;
    }

    return $template;
}

add_filter('template_include', 'pdlp_load_page_template', 99);

/**
 * Enqueue the offline page CSS only when the offline shortcode is present.
 */

add_action('wp_enqueue_scripts', function () {
    if (!is_singular()) {
        return;
    }

    global $post;
    if (!$post || !has_shortcode($post->post_content, 'vpaccount-offline')) {
        return;
    }

    $css_file = plugin_dir_path(__FILE__) . 'assets/css/offline.css';
    if (file_exists($css_file)) {
        wp_enqueue_style(
            'psalmoteedata-offline-page',
            plugin_dir_url(__FILE__) . 'assets/css/offline.css',
            [],
            (string) filemtime($css_file)
        );
    }
}, 30);

/*
|--------------------------------------------------------------------------
| Vite Manifest
|--------------------------------------------------------------------------
*/

/**
 * Read the Vite build manifest.
 *
 * Expected location:
 * dist/.vite/manifest.json
 */
function pdlp_get_vite_manifest() {
    $manifest_path = PDLP_PLUGIN_DIR
        . 'dist/.vite/manifest.json';

    if (!file_exists($manifest_path)) {
        return false;
    }

    $manifest_content = file_get_contents($manifest_path);

    if ($manifest_content === false) {
        return false;
    }

    $manifest = json_decode($manifest_content, true);

    if (!is_array($manifest)) {
        return false;
    }

    return $manifest;
}


/*
|--------------------------------------------------------------------------
| React CSS and JavaScript Assets
|--------------------------------------------------------------------------
*/

/**
 * Enqueue the production CSS and JavaScript generated by Vite.
 */
function pdlp_enqueue_assets() {
    $manifest = pdlp_get_vite_manifest();

    if (
        !$manifest ||
        empty($manifest['index.html']['file'])
    ) {
        return;
    }

    $entry = $manifest['index.html'];

    /*
     * Load CSS associated with the main entry.
     */
    if (!empty($entry['css']) && is_array($entry['css'])) {
        foreach ($entry['css'] as $index => $css_file) {
            wp_enqueue_style(
                'pdlp-style-' . $index,
                PDLP_PLUGIN_URL . 'dist/' . $css_file,
                array(),
                PDLP_VERSION
            );
        }
    }

    /*
     * Load CSS from imported dependencies.
     */
    if (!empty($entry['imports']) && is_array($entry['imports'])) {
        foreach ($entry['imports'] as $import_key) {
            if (
                empty($manifest[$import_key]['css']) ||
                !is_array($manifest[$import_key]['css'])
            ) {
                continue;
            }

            foreach (
                $manifest[$import_key]['css'] as $index => $css_file
            ) {
                wp_enqueue_style(
                    'pdlp-import-style-' . md5(
                        $import_key . $index
                    ),
                    PDLP_PLUGIN_URL . 'dist/' . $css_file,
                    array(),
                    PDLP_VERSION
                );
            }
        }
    }

    /*
     * Load the main Vite JavaScript entry.
     */
    wp_enqueue_script(
        'pdlp-app',
        PDLP_PLUGIN_URL . 'dist/' . $entry['file'],
        array(),
        PDLP_VERSION,
        true
    );
}


/**
 * Add type="module" to the Vite JavaScript entry.
 */
function pdlp_make_script_module($tag, $handle, $src) {
    if ($handle !== 'pdlp-app') {
        return $tag;
    }

    // Avoid adding a duplicate type attribute.
    if (strpos($tag, 'type=') !== false) {
        return $tag;
    }

    return str_replace(
        '<script ',
        '<script type="module" ',
        $tag
    );
}

add_filter('script_loader_tag', 'pdlp_make_script_module', 10, 3);


/*
|--------------------------------------------------------------------------
| Conditional Asset Loading
|--------------------------------------------------------------------------
*/

/**
 * Load React assets only on pages that use the standalone template
 * or contain the landing-page shortcode.
 */
function pdlp_maybe_enqueue_assets() {
    $should_load = false;

    /*
     * Check for the standalone page template.
     */
    if (is_page()) {
        $selected_template = get_page_template_slug(
            get_queried_object_id()
        );

        if (
            $selected_template ===
            'templates/psalmotee-landing-template.php'
        ) {
            $should_load = true;
        }
    }

    /*
     * Check for the landing-page shortcode.
     */
    if (!$should_load && is_singular()) {
        global $post;

        if (
            $post instanceof WP_Post &&
            has_shortcode(
                $post->post_content,
                'psalmoteedata_landing'
            )
        ) {
            $should_load = true;
        }
    }

    if ($should_load) {
        pdlp_enqueue_assets();
    }
}

add_action('wp_enqueue_scripts', 'pdlp_maybe_enqueue_assets');


/*
|--------------------------------------------------------------------------
| Landing Page Shortcode
|--------------------------------------------------------------------------
*/

/**
 * Render the React root element.
 *
 * Usage:
 * [psalmoteedata_landing]
 */
function pdlp_render_landing_page() {
    if (!pdlp_get_vite_manifest()) {
        return '<p>The landing page build is missing. Please check the plugin dist folder.</p>';
    }

    return '<div class="psalmotee-app"><div id="root"></div></div>';
}


/**
 * Register the landing-page shortcode.
 */
function pdlp_register_shortcode() {
    add_shortcode(
        'psalmoteedata_landing',
        'pdlp_render_landing_page'
    );
}

add_action('init', 'pdlp_register_shortcode');
