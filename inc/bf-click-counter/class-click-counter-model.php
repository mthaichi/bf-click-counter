<?php
namespace BF_ClickCounter;

/**
 * Click Counter Model class
 */
class ClickCounterModel extends \BF_PluginBase\Model {

	/**
	 * Table name
	 *
	 * @var string
	 */
	protected $table_name = 'bf_click_counter';

	/**
	 * Create table SQL
	 *
	 * @var string
	 */
	protected $create_sql = "CREATE TABLE %s (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        counter_key text NOT NULL,
        count int NOT NULL,
        ip_addr text NOT NULL,
        register_datetime datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        update_datetime datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        UNIQUE KEY id (id)
    ) %s;";

	/**
	 * Activate ( create db table )
	 *
	 * @return void
	 */

	public function activate() {
		$this->create_table();
	}

	/**
	 * Initialize
	 *
	 * @return void
	 */

	public function initialize() {
		add_action( 'init', array( 'load_counter' ) );
	}

	/**
	 * Get counter data
	 *
	 * @param string $counter_key counter key name
	 * @return array| null The data array if found, null if not found.
	 */

	public function get_counter_data ( $counter_key, $output_type = ARRAY_A ) {
		global $wpdb;
		$table_name = $this->get_table_name();
		$query      = $wpdb->prepare( "SELECT * FROM $table_name WHERE counter_key = %s", $counter_key );
		$results    = $wpdb->get_results( $query, $output_type );

		if ( ! $results ) {
			return null;
		}

		return $results[0];
	}



	/**
	 * Get the count value
	 *
	 * @param  $counter_key counter key name
	 * @return int count value
	 */

	public function get_count( $counter_key ) {
		$counter = $this->get_counter_data( $counter_key );

		if ( ! isset( $counter['count'] ) ) {
			return null;
		}
		return $counter['count'];

	}

	/**
	 * Increment the count on the counter
	 *
	 * @param string $counter_key counter key name
	 * @param string $ip_addr IP address
	 * @return int The count value after incrementing
	 */

	public function countup( $counter_key, $ip_addr = null ) {
		global $wpdb;
		$counter = $this->get_one( array( 'counter_key' => $counter_key ) );

		if ( ! is_null( $ip_addr ) && isset( $counter['ip_addr'] ) && $counter['ip_addr'] === $ip_addr ) {
			return $counter['count'];
		}

		$count = 1;
		if ( $counter ) {
			$count = $counter['count'] + 1;
			$wpdb->update(
				$this->get_table_name(),
				array(
					'count'           => $count,
					'ip_addr'         => $ip_addr,
					'update_datetime' => date( 'Y-m-d h:m:s' ),
				),
				array(
					'counter_key' => $counter_key,
				)
			);
		} else {
			$wpdb->insert(
				$this->get_table_name(),
				array(
					'count'           => $count,
					'counter_key'     => $counter_key,
					'ip_addr'         => $ip_addr,
					'update_datetime' => date( 'Y-m-d h:m:s' ),
				)
			);
		}

		return $count;
	}

	/**
	 * delete counter data
	 *
	 * @param $counter_key counter key name
	 * @return void
	 */

	public function delete( $counter_key ) {
		global $wpdb;
		$wpdb->delete( $this->get_table_name(), array( 'counter_key' => $counter_key ) );
	}
}
