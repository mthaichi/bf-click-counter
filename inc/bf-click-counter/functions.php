<?php
namespace BF_ClickCounter;

function get_option ( $key ) {
    $plugin = Plugin::get_instance();
    return $plugin->option_page->get_option( $key );

}