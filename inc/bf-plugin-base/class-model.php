<?php

namespace BF_PluginBase;

Class Model {

    use Singleton;

    protected $create_sql;
    protected $table_name;

    public function create_table() {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $table_name = get_table_name();
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( str_replace('%CHARSET_COLLATE%', $charset_collate, $this->create_sql ) );   
    }

    /**
     * DBで使うテーブル名を返す
     * 
     * @access public
     * @return void
     */
    function get_table_name() {
        global $wpdb;
        return $wpdb->prefix . $this->table_name;
    }    

}

