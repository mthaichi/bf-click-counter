<?php
namespace BF_ClickCounter;

class ClickCounterModel extends \BF_PluginBase\Model {
    
    protected $table_name = "bf_click_counter";
    protected $results;
    protected $create_sql = "CREATE TABLE %s (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        keyname text NOT NULL,
        count int NOT NULL,
        ipaddress text NOT NULL,
        register_datetime datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        update_datetime datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        UNIQUE KEY id (id)
    ) %s;";

    public function activate_action () {
        register_activation_hook( __FILE__, array( $this, 'create_table' ) );
    }

    public function load_counter() {
        global $wpdb;
        $this->results = $wpdb->get_results("SELECT * FROM $this->table_name");
    }

    public function create_table() {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $table_name = $this->get_table_name();
        $sql = sprintf($this->create_sql, $table_name, $charset_collate);
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        var_dump($sql);
        dbDelta($sql);
    }
}
