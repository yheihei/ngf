<?php
/**
 * 2018年のトップページを表示するテンプレート
 *
 * @package NGF
 */

get_header(); // header.phpを取得. ?>
<?php
// 必要情報を指定して 過去トップテンプレートを呼び出す.
set_query_var( 'old_year', 2018 );
set_query_var( 'old_header_youtube_video_id', 'YB-j_pvidq4' );
set_query_var( 'old_event_date', '2018.8.4(土)' );
set_query_var( 'old_about_content', '名古屋からギター芸術を世界に発信し続ける生田直基主催による、名古屋のためのクラシックギターイベントです。今年はウィーン国際コンクールなど、6つの国際コンクールで優勝した世界的ギタリスト「Gabriel Bianco」を筆頭に数々の著名ギタリスト、フルート奏者などが集結。最高のホールで世界トップレベルの演奏に触れるチャンス。' );
get_template_part( 'template/top/old', 'index' );
?>
<?php
set_query_var( 'footer_is_cv', false );
get_footer(); // footer.phpを取得.
