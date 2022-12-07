<?php
/**
 * 2021年のトップページを表示するテンプレート
 *
 * @package NGF
 */

get_header(); // header.phpを取得. ?>
<?php
// 必要情報を指定して 過去トップテンプレートを呼び出す.
set_query_var( 'old_year', 2021 );
set_query_var( 'old_header_youtube_video_id', 'VcQjxGRn2S8' );
set_query_var( 'old_event_date', '2021.8.28(土)' );
set_query_var( 'old_about_content', '第8回を迎えた名古屋ギターフェスティバル、今年も2公演でお届けします。昨年は残念ながら中止となってしまいましたが今年はパワーアップして様々な工夫を凝らして帰ってきます！' );
get_template_part( 'template/top/old', 'index' );
?>
<?php
set_query_var( 'footer_is_cv', false );
get_footer(); // footer.phpを取得.
