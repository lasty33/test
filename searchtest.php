<?php
/*
 * Plugin Name: Test Widget
 * Version: 1.0
 * Plugin URI: 
 * Description: 
 * Author: tsuchida
 * Author URI: 
 */

//WP_Widgetを継承してクラスを作成。クラス名は任意
class My_Widget extends WP_Widget {
	//コンストラクタ　クラスと同じ名称
	function My_Widget() {
		// ウィジェットの初期設定
	    $widget_ops = array('classname' => 'widget_test_widget', 'description' => '検索テストウィジェットの説明' );
	    $control_ops = array('width' => 400, 'height' => 300);
	    $this->WP_Widget('TestWidget', '検索テスト', $widget_ops, $control_ops);
	}

	function widget($args, $instance) {
		// ウィジェットのコンテンツ出力
		echo $args['before_widget']."\n";
		echo $args['before_title'].'　'.$args['after_title']."\n";
		echo '<p>検索フォームテスト</p>'."\n";
		
		global $wpdb;
		$category_row = $wpdb->get_results("SELECT term_id,name FROM $wpdb->terms WHERE term_id != '1' AND term_id != '2'");
		
		error_reporting(E_ALL);
		//echo "<form role=search method=get id=searchform action=http://localhost/wp/index.php >";
		echo "<form method='get' id='searchpage' action='http://localhost/wp/search' >";
		echo "<input type='text' name='word'><br>";
		foreach($category_row as $row){
			echo $row->name.":<input type='checkbox' name='cate' value='$row->term_id'><br>";
		}
		
		echo<<<SELECT
				<p><select name="prefecture">
				<option value="">都道府県の選択</option>

				<optgroup label="北海道・東北">
				<option value="北海道">北海道</option>
				<option value="青森県">青森県</option>
				<option value="岩手県">岩手県</option>
				<option value="宮城県">宮城県</option>
				<option value="秋田県">秋田県</option>
				<option value="山形県">山形県</option>
				<option value="福島県">福島県</option>
				</optgroup>

				<optgroup label="関東">
				<option value="東京都">東京都</option>
				<option value="神奈川県">神奈川県</option>
				<option value="埼玉県">埼玉県</option>
				<option value="千葉県">千葉県</option>
				<option value="茨城県">茨城県</option>
				<option value="栃木県">栃木県</option>
				<option value="群馬県">群馬県</option>
				<option value="山梨県">山梨県</option>
				</optgroup>

				<optgroup label="信越・北陸">
				<option value="新潟県">新潟県</option>
				<option value="長野県">長野県</option>
				<option value="富山県">富山県</option>
				<option value="石川県">石川県</option>
				<option value="福井県">福井県</option>
				</optgroup>

				<optgroup label="東海">
				<option value="愛知県">愛知県</option>
				<option value="岐阜県">岐阜県</option>
				<option value="静岡県">静岡県</option>
				<option value="三重県">三重県</option>
				</optgroup>

				<optgroup label="近畿">
				<option value="大阪府">大阪府</option>
				<option value="兵庫県">兵庫県</option>
				<option value="京都府">京都府</option>
				<option value="滋賀県">滋賀県</option>
				<option value="奈良県">奈良県</option>
				<option value="和歌山県">和歌山県</option>
				</optgroup>

				<optgroup label="中国">
				<option value="鳥取県">鳥取県</option>
				<option value="島根県">島根県</option>
				<option value="岡山県">岡山県</option>
				<option value="広島県">広島県</option>
				<option value="山口県">山口県</option>
				</optgroup>

				<optgroup label="四国">
				<option value="徳島県">徳島県</option>
				<option value="香川県">香川県</option>
				<option value="愛媛県">愛媛県</option>
				<option value="高知県">高知県</option>
				</optgroup>

				<optgroup label="九州・沖縄">
				<option value="福岡県">福岡県</option>
				<option value="佐賀県">佐賀県</option>
				<option value="長崎県">長崎県</option>
				<option value="熊本県">熊本県</option>
				<option value="大分県">大分県</option>
				<option value="宮崎県">宮崎県</option>
				<option value="鹿児島県">鹿児島県</option>
				<option value="沖縄県">沖縄県</option>
				</optgroup>

				</select></p>
SELECT;
		
		//echo '<input type=submit value=検索>';
		echo "<input type='submit' id='searchsubmit' value='検索' />";
		echo '</form>';
		
		echo $args['after_widget']."\n";
	}

	function update($new_instance, $old_instance) {
		// 保存したときのウィジェットのオプションを処理
		// $new_instanceには入力データが連想配列で引き渡される
		// $old_instanceにはそれまでの保存されていたオプション値が連想配列で引き渡される。
		// 最後に連想配列でオプション値を返す。
	}

	function form($instance) {
		// 管理画面のウィジェットに出力するフォームを記述
		// $instanceには保存したオプションが連想配列で引き渡される。
//		$name = 'ts_test_'.$this->number;
//		echo '<input type="text" name="'.$name.'" />';
	}
}


function MyWidgetInit() {
	//ウィジェットのクラス名を登録
	register_widget('My_Widget');
}
//widgets_initアクション時にMyWidgetInitを実行
add_action('widgets_init', 'MyWidgetInit');

?>