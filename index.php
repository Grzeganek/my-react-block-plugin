<?php

/*
  Plugin Name: My React Block Plugin
  Version: 1.0
  Author: Grzeganek
  Description: Ein einfacher React-Testblock.
  Author URI: https://github.com/LearnWebCode
*/

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function blockregister() {
    register_block_type( __DIR__ . '/build' );
}
add_action( 'init', 'blockregister' );

// Details-Seite hinzufügen
function my_plugin_add_details_page() {
    add_submenu_page(
        null, // Versteckt die Seite aus dem Hauptmenü
        'Details zu My React Block Plugin', // Seitentitel
        'Details anzeigen', // Titel im Plugin-Link
        'manage_options', // Berechtigungsstufe
        'my-react-block-plugin-details', // Slug der Seite
        'my_plugin_details_page' // Callback-Funktion für die Ausgabe der Seite
    );
}
add_action( 'admin_menu', 'my_plugin_add_details_page' );

// Callback-Funktion für die Details-Seite
function my_plugin_details_page() {
    echo '<div class="wrap">';
    echo '<h1>Details zu My React Block Plugin</h1>';
    echo '<p>Hier kannst du alle Details zu deinem Plugin einfügen, wie Anweisungen, Funktionen und Kontaktinformationen.</p>';
    echo '</div>';
}

// Link „Details anzeigen“ zur Zeile mit Autor hinzufügen, mit JavaScript für ein Pop-up
function my_plugin_row_meta($links, $file) {
    if ( plugin_basename(__FILE__) === $file ) {
        $popup_link = '<a href="#" onclick="openPopup()">Details anzeigen</a>';
        $links[] = $popup_link;
    }
    return $links;
}
add_filter('plugin_row_meta', 'my_plugin_row_meta', 10, 2);

// JavaScript für das Pop-up-Fenster hinzufügen
function my_plugin_enqueue_popup_script() {
    ?>
    <script type="text/javascript">
        function openPopup() {
            window.open(
                "<?php echo admin_url('admin.php?page=my-react-block-plugin-details'); ?>",
                "Details anzeigen",
                "width=600,height=400,resizable,scrollbars"
            );
            return false; // Verhindert das Standardverhalten des Links
        }
    </script>
    <?php
}
add_action('admin_footer', 'my_plugin_enqueue_popup_script');
