<?php

namespace BF_PluginBase;

/**
 * Model class
 */
class Model {

	use Singleton;

	/**
	 * SQL for creating a table.
	 *
	 * @var string
	 */
	protected $create_sql;

	/**
	 * Table name
	 *
	 * @var string
	 */
	protected $table_name;

	/**
	 * Create table
	 *
	 * @return void
	 */
	public function create_table() {
		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();
		$table_name      = $this->get_table_name();
		$sql             = sprintf( $this->create_sql, $table_name, $charset_collate );
		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta( $sql );
	}

	/**
	 * Drop table
	 *
	 * @return void
	 */
	public function drop_table() {
		global $wpdb;
		$table_name = $this->get_table_name();
		$sql        = sprintf( "DROP TABLE IF EXISTS $table_name" );
		$wpdb->query( $sql );
	}

	public function get( $conditions = array(), $output_type = ARRAY_A ) {
		global $wpdb;
		$table_name = $this->get_table_name();
		$where_clause = $this->generate_where_clause( $conditions );
		

		$query = null;
		if ( $where_clause ) {
			$query      = $wpdb->prepare( "SELECT * FROM $table_name WHERE $where_clause", array_values($conditions) );
		} else {
			$query      = $wpdb->prepare( "SELECT * FROM $table_name WHERE" );
		}
  
		$results    = $wpdb->get_results( $query, $output_type );	
		
		return $results;
	}

	public function update( $data, $conditions ) {
		global $wpdb;
		$table_name = $this->get_table_name();
		return $wpdb->update( $table_name, $data, $conditions,
			$this->generate_placeholder_array( $data ),
			$this->generate_placeholder_array( $conditions )
		);
	}

	function generate_placeholder_array($data) {
		$placeholders = array();
		foreach ($data as $value) {
			if (is_numeric($value)) {
				$placeholders[] = '%d';
			} else {
				$placeholders[] = '%s';
			}
		}
		return $placeholders;
	}

public function generate_where_clause ( $conditions ) {
	$where_clause = "";
	foreach ((array)$conditions as $key => $value) {
		if (is_numeric($value)) { 
			$where_clause .= "$key = %d AND ";
		} else {
			$where_clause .= "$key = %s AND ";
		}
	}
	return rtrim($where_clause, " AND ");
}


	/**
	 * Get all counter data
	 *
	 * @param string $counter_key counter key name
	 * @return array| null The data array if found, null if not found.
	 */

	 public function get_all( $output_type = ARRAY_A ) {
		global $wpdb;
		$table_name = $this->get_table_name();
		$query      = $wpdb->prepare( "SELECT * FROM $table_name" );
		$results    = $wpdb->get_results( $query, $output_type );

		if ( ! $results ) {
			return null;
		}

		return $results;
	}
	
	public function get_one($conditions = array(), $output_type = ARRAY_A ) {
		$result = $this->get( $conditions, $output_type );
		return $result ? $result[0] : null;
	}

	/**
	 * Return table name.
	 *
	 * @return string
	 */
	public function get_table_name() {
		global $wpdb;
		return $wpdb->prefix . $this->table_name;
	}

}

