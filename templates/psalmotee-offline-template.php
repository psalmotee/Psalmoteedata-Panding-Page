<?php
/**
 * Template Name: PsalmoteeData Offline Purchase
 * Description: Standalone branded layout for the VTUPress offline purchase shortcode.
 *
 * Keep this file inside the companion plugin's templates/ directory.
 */
if (!defined('ABSPATH')) {
    exit;
}

define('PDLP_VERSION', '1.3.0');

$psd_companion_main_file = dirname(__DIR__) . '/psalmoteedata-landing.php';

// Load companion-plugin assets independently of the VTUPress plugin.
wp_enqueue_style(
    'psd-offline-page',
    plugins_url('assets/css/offline.css', $psd_companion_main_file),
    array(),
    PDLP_VERSION
);
wp_enqueue_script(
    'psd-offline-page',
    plugins_url('assets/js/offline.js', $psd_companion_main_file),
    array(),
    PDLP_VERSION,
    true
);


$psd_home_url = home_url('/');
$psd_faq_url = function_exists('get_page_by_path') && get_page_by_path('faq') ? get_permalink(get_page_by_path('faq')) : home_url('#/faq/');
$psd_contact_url = function_exists('get_page_by_path') && get_page_by_path('contact') ? get_permalink(get_page_by_path('contact')) : home_url('#/contact/');
$psd_about_url = function_exists('get_page_by_path') && get_page_by_path('about') ? get_permalink(get_page_by_path('about')) : home_url('#/about/');
$psd_privacy_url = function_exists('get_page_by_path') && get_page_by_path('privacy') ? get_permalink(get_page_by_path('privacy')) : home_url('#/privacy/');
$psd_terms_url = function_exists('get_page_by_path') && get_page_by_path('terms') ? get_permalink(get_page_by_path('terms')) : home_url('#/terms/');
$psd_support_email = 'psalmoteetelecoms@gmail.com';
$psd_phone_display = '+234 805 846 1612';
$psd_phone_href = '+2348058461612';
$psd_year = (int) current_time('Y');
$psd_logo_url = plugins_url('assets/img/assets/img/psalmoteedata-logo.png', dirname(__FILE__));
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    <link rel="stylesheet" id="psalmoteedata-offline-css" href="<?php echo esc_url($psd_offline_css_url); ?>?ver=PDLP_VERSION" media="all">
</head>
<body <?php body_class('psalmotee-offline-body'); ?>>
<?php wp_body_open(); ?>
<div class="psalmotee-offline-page">
    <header class="psd-header">
        <div class="psd-container psd-header-inner">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="psd-brand">
                <img
                    src="<?php echo esc_url($psd_logo_url); ?>"
                    alt="PsalmoteeData"
                    class="psd-brand-logo"
                >

    <span class="psd-brand-name gradient-text">PsalmoteeData</span>
            </a>
            <nav class="psd-nav" aria-label="Main navigation">
                <a href="<?php echo esc_url($psd_home_url); ?>">Home</a>
                <a href="<?php echo esc_url($psd_faq_url); ?>">FAQs</a>
                <a href="<?php echo esc_url($psd_contact_url); ?>">Contact</a>
                <a href="<?php echo esc_url($psd_about_url); ?>">About</a>
            </nav>
            <button class="psd-nav-cta"  id="header-buy-services" type="button">Buy Services <span aria-hidden="true">→</span></button>
        </div>
    </header>

    <main class="psd-main" id="main-content">
        <div class="psd-container">
            <section class="psd-intro" aria-labelledby="psd-page-title">
                <div class="psd-eyebrow">Simple · Convenient · Reliable</div>
                <h1 id="psd-page-title">Your everyday services,<br><span>all in one place.</span></h1>
                <p>Buy airtime and data, pay bills, or check a transaction using our straightforward checkout experience.</p>
                <div class="psd-trust-row" aria-label="Service features">
                    <span class="psd-trust-item"><span class="psd-trust-dot" aria-hidden="true"></span>Easy checkout</span>
                    <span class="psd-trust-item"><span class="psd-trust-dot" aria-hidden="true"></span>Transaction tracking</span>
                    <span class="psd-trust-item"><span class="psd-trust-dot" aria-hidden="true"></span>Digital receipts</span>
                </div>
            </section>

            <section id="purchase" aria-label="Purchase or verify a transaction">
                <?php echo do_shortcode('[vpaccount-offline]'); ?>
            </section>
        </div>
    </main>

    <footer class="psd-footer" id="psd-footer">
        <div class="psd-container">
            <div class="psd-footer-main">
                <section class="psd-footer-brand" aria-label="PsalmoteeData information">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="psd-brand">
                <img
                    src="<?php echo esc_url($psd_logo_url); ?>"
                    alt="PsalmoteeData"
                    class="psd-brand-logo"
                >

    <span class="psd-brand-name gradient-text">PsalmoteeData</span>
            </a>
                    <p class="psd-footer-description">Nigeria's trusted platform for instant airtime, data, electricity, and bill payments. Fast, secure, and always available.</p>
                    <div class="psd-socials" aria-label="Social media">
                        <a href="#" aria-label="Facebook" title="Facebook" class="psd-social-link">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M13.5 21v-8h2.7l.4-3.1h-3.1v-2c0-.9.3-1.5 1.6-1.5h1.7V3.6c-.3 0-1.3-.1-2.5-.1-2.5 0-4.2 1.5-4.2 4.3v2.1H7.3V13h2.8v8h3.4z" fill="currentColor"/></svg>
                        </a>
                        <a href="#" aria-label="Instagram" title="Instagram" class="psd-social-link">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3.5" y="3.5" width="17" height="17" rx="5" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="12" cy="12" r="4" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="17.7" cy="6.5" r="1.2" fill="currentColor"/></svg>
                        </a>
                    </div>
                </section>

                <nav class="psd-footer-company" aria-label="Company links">
                    <h2>Company</h2>
                    <div class="psd-company-links">
                        <a href="<?php echo esc_url($psd_about_url); ?>">About Us</a>
                        <a href="<?php echo esc_url($psd_faq_url); ?>">FAQs</a>
                        <a href="<?php echo esc_url($psd_privacy_url); ?>">Privacy Policy</a>
                        <a href="<?php echo esc_url($psd_terms_url); ?>">Terms of Service</a>
                    </div>
                </nav>

                <section class="psd-footer-contact" aria-label="Contact information">
                    <h2>Contact</h2>
                    <a class="psd-mobile-contact-link" href="<?php echo esc_url($psd_contact_url); ?>">Contact Us <span aria-hidden="true">→</span></a>
                    <div class="psd-contact-details">
                        <a href="mailto:<?php echo esc_attr($psd_support_email); ?>"><span aria-hidden="true">✉</span><?php echo esc_html($psd_support_email); ?></a>
                        <a href="tel:<?php echo esc_attr($psd_phone_href); ?>"><span aria-hidden="true">☎</span><?php echo esc_html($psd_phone_display); ?></a>
                        <p><span aria-hidden="true">◷</span>Available 24/7</p>
                    </div>
                </section>
            </div>

            <div class="psd-footer-bottom">
                <p>© <?php echo esc_html((string) $psd_year); ?> PsalmoteeData. All rights reserved.</p>
                <p class="psd-built-with">Built with <span aria-label="love" role="img">♥</span> Psalmotee Tech</p>
            </div>
        </div>
    </footer>
</div>
<?php wp_footer(); ?>
</body>
</html>
