<?php
namespace BF_ClickCounter;

/**
 * ClickCounterBlock Class
 */
class ClickCounterListTable extends \WP_List_Table {

	/**
	 * Column definition.
	 *
	 * @return void
	 */
	function get_columns() {
		return array(
			'counter_key' => __( 'Counter key', BFCC_TEXTDOMAIN ),
			'count'       => __( 'Count Number', BFCC_TEXTDOMAIN ),
		);
	}

	// テーブルのデータを取得する関数
	function prepare_items() {

		$model        = ClickCounterModel::get_instance();
		$counter_data = $model->get_all( \OBJECT );

		// テーブルのデータをセットする
		$columns               = $this->get_columns();
		$hidden                = array();
		$sortable              = array();
		$this->_column_headers = array( $columns, $hidden, $sortable );
		$this->items           = $counter_data;
	}


	public function column_default( $item, $column_name ) {
		return $item->$column_name;
	}

	public function column_counter_key( $item ) {

		$edit_url   = admin_url( 'admin.php?page=bf-click-counter&action=update_count&id=' . $item->id );
		$delete_url = admin_url( 'admin.php?page=bf-click-counter&action=delete&id=' . $item->id );

		// Build row actions
		$actions = array(
			'edit'   => sprintf( '<a href="%s">' . __( 'Edit', BFCC_TEXTDOMAIN ) . '</a>', $edit_url ),
			'delete' => sprintf( '<a href="#" onclick="confirmAndDelete(\'%s\')">' . __( 'Delele', BFCC_TEXTDOMAIN ) . '</a>', $delete_url ),
		);

		// Return the title contents
		return sprintf(
			'<a class="row-title" href="%4$s">%1$s</a> <span style="color:silver">(id:%2$s)</span>%3$s',
			/*$1%s*/ $item->counter_key,
			/*$2%s*/ $item->id,
			/*$3%s*/ $this->row_actions( $actions ),
			/*$4%s*/ $edit_url
		);
	}




}

