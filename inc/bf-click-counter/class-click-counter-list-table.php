<?php
namespace BF_ClickCounter;
/**
 * ClickCounterBlock Class
 */
class ClickCounterListTable extends \WP_List_Table {

    // カラムの定義
    function get_columns() {
        return array(
            'counter_key' => 'カウントキー',
            'count' => 'カウント数'
        );
    }

    // テーブルのデータを取得する関数
    function prepare_items() {
 
        $model = ClickCounterModel::get_instance();
        $counter_data = $model->get_all(\OBJECT);

        // テーブルのデータをセットする
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = array();
        $this->_column_headers = array($columns, $hidden, $sortable);
        $this->items = $counter_data;
    }

   
    public function column_default( $item, $column_name ) {
        return $item->$column_name;        
    }

    public function column_counter_key( $item ) {

        $edit_url = admin_url('admin.php?page=bf-click-counter&action=update_count&id='.$item->id);
        $delete_url = admin_url('admin.php?page=bf-click-counter&action=delete&id='.$item->id);

        //Build row actions
        $actions = array(
            'edit'      => sprintf( '<a href="%s">カウント数を編集</a>', $edit_url ),
            'delete'    => sprintf( '<a href="%s">削除</a>', $delete_url )
        );
        
        //Return the title contents
        return sprintf('<a href="%4$s">%1$s</a> <span style="color:silver">(id:%2$s)</span>%3$s',
            /*$1%s*/ $item->counter_key,
            /*$2%s*/ $item->id,
            /*$3%s*/ $this->row_actions($actions),
            /*$4%s*/ $edit_url
        );
    }

    // カウント数を編集するフォームを表示する関数
    function display_count_field($item) {
        echo '<input type="number" name="count" value="'.$item->count.'" />';
    }


    // カウント数を更新する関数
    function update_count($id, $count) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'bf_click_counter';
        $wpdb->update(
            $table_name,
            array('count' => $count, 'update_datetime' => current_time('mysql')),
            array('id' => $id)
        );
    }

    // 編集画面を表示する関数
    function edit_page() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'bf_click_counter';

        // フォームが送信された場合、カウント数を更新する
        if (isset($_POST['action']) && $_POST['action'] === 'update_count') {
            $this->update_count($_POST['id'], $_POST['count']);
        }

        // 編集する行を取得する
        $counter_data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $_GET['id']));

        // フォームを表示する
        echo '<h2>カウント数を編集</h2>';
        echo '<form method="post">';
        echo '<input type="hidden" name="action" value="update_count" />';
        echo '<input type="hidden" name="id" value="'.$counter_data->id.'" />';
        echo '<table class="form-table">';
        echo '<tr>';
        echo '<th>カウント数</th>';
        echo '<td>';
        $this->display_count_field($counter_data);
        echo '</td>';
        echo '</tr>';
        echo '</table>';
        echo '<p class="submit"><input type="submit" class="button-primary" value="更新" /></p>';
        echo '</form>';
    }

    // 削除画面を表示する関数
    function delete_page() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'bf_click_counter';

        // 削除する行を取得する
        $counter_data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $_GET['id']));

        // 行を削除する
        $wpdb->delete($table_name, array('id' => $_GET['id']));

        // 削除完了メッセージを表示する
        echo '<div class="updated"><p>削除が完了しました。</p></div>';

        // テーブルを再度表示する
        $this->prepare_items();
        $this->display();
    }


}

