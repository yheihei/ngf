<?php

define("NGF_CATEGORY_PRIORITY_VALUE_DEFAULT", 1);
define("NGF_CATEGORY_EYECATCH", 'category_eyecatch_img');
define("NGF_CATEGORY_BODY", 'category_body');

/**
 * アイキャッチ画像の機能を有効化
 */

add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 300, 300, true ); // 初期設定の投稿サムネイル値

/**
 * サムネイル画像の定義
 */
 
if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'writing-thumb', 520, 320, true ); //(切り抜かれた大きさ)
	add_image_size( 'archive-thumb', 300, 300, true ); //(切り抜かれた大きさ)
	add_image_size( 'kiji-thumb', 317, 212, true ); //(切り抜かれた大きさ)
	add_image_size( 'art-thumb', 240, 284, true ); //出演者のアイキャッチ定義
}

add_filter( 'post_thumbnail_html', 'custom_attribute' );
function custom_attribute( $html ){
    // サムネイルのimgタグのheight を削除する
    //$html = preg_replace('/(height)="\d*"\s/', '', $html);
    return $html;
}

/*
 * 投稿にアーカイブ(投稿一覧)を持たせるようにします。
 * ※ 記載後にパーマリンク設定で「変更を保存」してください。
 */
function post_has_archive( $args, $post_type ) {
	if ( 'post' == $post_type ) {
		$args['rewrite'] = true;
		$args['has_archive'] = 'blog'; // ページ名
	}
	return $args;
}
add_filter( 'register_post_type_args', 'post_has_archive', 3, 2 );


// 投稿ページかつ特定タグか
function is_single_tag($tag_slug) {
	if( !is_single() ) {
		return false;
	}
	var_dump( $tag_slug );
	$posttags = get_the_tags();
	if ($posttags) {
		foreach($posttags as $tag){
			var_dump( $tag->name );
			if( $tag->name == $tag_slug ) return true; 
		}
	}
	return false;
}

/**
 * 古い記事に終演した旨の文章を表示する
 */
function add_old_content_notice($the_content) {
	if ( is_single() ) {
		// シングルページかつ古い記事の場合 注釈追加
		////////////////////////////
		//除外する過去記事タグ処理
		////////////////////////////
		$define_not_tag_names = array(
		'2017','2018',
		);
		
		$tags = get_the_tags(); // 記事のタグ名を取得
		$not_tag_ids = array();
		
		foreach ( $tags as $tag ) {
			if (in_array($tag->name, $define_not_tag_names)) {
				// 除外する過去記事タグであった場合、注釈を追加
				$notice = 
				'
				<p>
					<a style="font-size:2rem;font-weight:bold; text-decoration:underline;"
					href="'. home_url() . '">
						' . $tag->name . '年の情報です。
						本年度の開催情報はホームページトップからご確認ください
					</a>
					<br>
				</p>
				';
				$the_content = $notice . $the_content;
				break;
			}
		}
	}
	return $the_content;
}
add_filter('the_content','add_old_content_notice');

// ファイルサイズ上限
@ini_set( 'max_execution_time', '100' );
@ini_set( 'post_max_size', '50M');
@ini_set( 'upload_max_size' , '30M' );


// カスタムメニューを設定
function add_custom_menu(){
	register_nav_menus(array(
		'global-navi' => 'グローバルナビ',
		'footer-navi' => 'フッターナビ',
	));
}
add_action('after_setup_theme','add_custom_menu');

/**
 * カテゴリーページで記事一覧ではなく
 * 子カテゴリーの一覧を出す対象のカテゴリーを取得
 */
function getShowChildCategorys() {
	$category_ids = explode(",", get_option('ngf_child_category_show_ids'));
	if(isset($category_ids[0]) && !$category_ids[0]) {
		return [];
	}
	if(!is_numeric($category_ids[0])) {
		return [];
	}

	$show_child_categorys = [];
	foreach($category_ids as $category_id) {
		$show_child_category = get_term_by('id', $category_id, 'category');
		$show_child_categorys[] = $show_child_category;
	}
	return $show_child_categorys;
}

/**
 * 指定のカテゴリーの子カテゴリーリストを取得する
 * @param $parent_term_id
 * @return カテゴリー
 */
function getCategorysChilds($parent_term_id) {
	$child_categorys = get_terms( 'category', array(
		'parent' => $parent_term_id,
		'hide_empty' => false,
		'hierarchical' => false,
		'orderby' => 'term_order',
	));

	return sortCategorysByPriority( $child_categorys );
}

/**
 * カテゴリーリストを優先度でソートする
 * @param object[] $target_categorys
 * @return object[] $categorys_sorted_by_priority
 */
function sortCategorysByPriority( $target_categorys ) {
	$categorys = [];
	$sorted_ids_to_priority = [];
	foreach( $target_categorys as $target_category ) {
		$categorys[$target_category->term_id]
			= $target_category;
		$sorted_ids_to_priority[$target_category->term_id] = get_category_priority($target_category->term_id);
	}
	// Priorityを使って降順でソート
	arsort($sorted_ids_to_priority);
	
	// Priorityでソートした結果を返す
	$categorys_sorted_by_priority = [];
	foreach( $sorted_ids_to_priority as $sorted_id => $priority ) {
		$categorys_sorted_by_priority[] = $categorys[$sorted_id];
	}
	return $categorys_sorted_by_priority;
}

/**
 * 対象のカテゴリーの優先度を取得
 * @param int $term_id カテゴリーID
 * @return int $priority
 */
function get_category_priority($term_id) {
	$priority = get_term_meta( $term_id, 'ngf_category_priority', true );
	if( is_null($priority) || $priority === '' || !ctype_digit($priority) ) {
		$priority = NGF_CATEGORY_PRIORITY_VALUE_DEFAULT;
	}
	return $priority;
}

/**
 * 現在開いているページが子カテゴリーリストを開くべきページか
 * @return bool
 */
function is_show_childs_category_page() {
	if( !is_category() ) {
		// カテゴリーページでない場合 false
		return false;
	}

	$current_category_id = get_query_var('cat');

	// 設定から対象のカテゴリーを取得
	$target_categorys = getShowChildCategorys();
	$target_category_ids = [];
	foreach( $target_categorys as $target_category ) {
		$target_category_ids[] = $target_category->term_id;
	}

	if( !in_array( $current_category_id, $target_category_ids ) ) {
		return false;
	}
	return true;
}

/**
 * カテゴリーページのアイキャッチ画像のURLを取得
 */
function get_the_category_eyecatch_url($current_category_id=0) {
	if( !$current_category_id ) {
		// ID 指定がない場合、現在のページのカテゴリーIDでのアイキャッチ取得
		$category_eyecatch_url = '';
		if( !is_category() ) {
			// カテゴリーページでない場合 空文字
			return $category_eyecatch_url;
		}

		$current_category_id = get_query_var('cat');
	}
	$term_meta_values = get_term_meta( $current_category_id, NGF_CATEGORY_EYECATCH );
	if( empty($term_meta_values) ) {
		// アイキャッチ未設定の場合 空文字
		return $category_eyecatch_url;
	}

	$category_eyecatch_url = $term_meta_values[0];
	return $category_eyecatch_url;
}

/**
 * トップに表示するカテゴリーやタグの設定
 */
add_action('admin_menu', 'top_category_menu');
function top_category_menu() {
	add_menu_page('NGFテーマ設定', 'NGFテーマ設定', 'administrator', __FILE__, 'ngf_settings_page','',61);
	add_action( 'admin_init', 'register_ngf_settings' );
}
function register_ngf_settings() {
	// カテゴリーページ設定
	register_setting( 'category-settings-group', 'ngf_child_category_show_ids' );
}
function ngf_settings_page() {
?>
	<div class="wrap">
    <h2>カテゴリーページ表示設定</h2>
    <form method="post" action="options.php">
      <?php 
        settings_fields( 'category-settings-group' );
        do_settings_sections( 'category-settings-group' );
      ?>
      <table class="form-table">
        <tbody>
          <tr>
            <th scope="row">
              <label for="ngf_child_category_show_ids">直近の子カテゴリーの一覧を表示するカテゴリーID</label>
            </th>
              <td>
								<input type="text" 
									id="ngf_child_category_show_ids" 
									class="regular-text" 
									name="ngf_child_category_show_ids" 
									value="<?php echo get_option('ngf_child_category_show_ids'); ?>"
									placeholder="2,8,10,12 (カテゴリーIDをカンマ区切りで入力)"
								>
							</td>
          </tr>
        </tbody>
      </table>
      <?php submit_button(); ?>
    </form>
  </div>
<?php
}

/**
 * ヘッダウィジェット
 */
register_sidebar(
	array(
		'name'          => '<head>に挿入するコンテンツ',
		'id'            => 'ngf_head',
	)
);

/**
 * チケットウィジェットの設定
 */
register_sidebar(
	array(
		'name'          => 'チケットエリアの内容',
		'id'            => 'ngf_ticket',
		'before_widget' => '<div id="ticket">',
		'after_widget'  => '</div>',
	)
);

/**
 * バナーウィジェットの設定
 */
register_sidebar(
	array(
		'name'          => 'バナーエリアの内容',
		'id'            => 'ngf_banner',
		'before_widget' => '<div id="banner" class="wrap">',
		'after_widget'  => '</div>',
	)
);

/**
 * 必要なスクリプトをheadに挿入
 */
function meta_headcustomtags() {
	$google_map_api_key = NGF_GOOGLE_MAP_API_KEY ?? '';
	$headcustomtag      = <<< EOM
<script src="//maps.google.com/maps/api/js?sensor=true&key=${google_map_api_key}&callback"></script>
EOM;
	echo $headcustomtag;
}
add_action( 'wp_head', 'meta_headcustomtags', 99 );
