<?php
/**
 * 2019年のトップページを表示するテンプレート
 *
 * @package NGF
 */

get_header(); // header.phpを取得. ?>
<?php
// 必要情報を指定して 過去トップテンプレートを呼び出す.
set_query_var( 'old_year', 2019 );
set_query_var( 'old_header_youtube_video_id', 'I6MrGIldd_k' );
set_query_var( 'old_event_date', '2019.8.3(土)' );
set_query_var( 'old_about_content', '名古屋だけでなく世界からも素晴らしいギタリスト達がこの一日に名古屋に集結！クラシックギターブームを名古屋から生み出す！' );
get_template_part( 'template/top/old', 'index' );
?>
<?php
set_query_var( 'is_cv', false );
get_footer(); // footer.phpを取得.
