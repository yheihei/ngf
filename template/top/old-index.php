<?php
/**
 * 過去のトップを表示するテンプレート
 * 呼び先から、年代、動画URLを get_query_var() で受け取り 表示する
 *
 * @package NGF
 */

// パラメータを取得する.
$old_year                    = get_query_var( 'old_year', 0 );
$old_header_youtube_video_id = get_query_var( 'old_header_youtube_video_id', '' );
$old_event_date              = get_query_var( 'old_event_date', '' );
$old_about_content           = get_query_var( 'old_about_content', '' );
?>
<section id="cover" style="background-image:url('<?php echo get_template_directory_uri(); ?>/img/cover.png');background-size: cover;">
	<div class="coverinfo">
		<h2>NGF<?php echo esc_html( $old_year ); ?>満員御礼</h2>
		<p><a href="<?php echo home_url();?>">最新のNGFを確認する</a></p>
	</div>
	<div id="player">
		<div class="wrap">
			
			
		</div>
	</div>
</section>
<script>
var tag = document.createElement('script');

tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

var player;
function onYouTubeIframeAPIReady() {
	player = new YT.Player('player', {
		height: '473',
		width: '840',
		videoId: '<?php echo esc_attr( $old_header_youtube_video_id ); ?>',
		playerVars:{
			'rel': '0',
			'showinfo': '0',
			'loop': '1',
			'controls': 0,
		},
		events: {
			'onReady': onPlayerReady,
			'onStateChange': onPlayerStateChange
		}
	});
}

function onPlayerReady(event) {
	event.target.playVideo();
	event.target.mute();
}

function onPlayerStateChange(event) {
}
</script>
<main class="container">
	<section class="white_back devider">
		
	</section>
	<script>
		// カルーセルを動作させる
		$(document).ready(function(){
			var windowWidth = $(window).width();
			if(windowWidth < 426) {
			
				$(".owl-carousel").owlCarousel(
					{
						loop: true,
						nav: false,
						dots: true,
						margin: 4,
						items: 1,
						autoplay: true
					}
				);
			} else if(windowWidth <= 960){
				$(".owl-carousel").owlCarousel(
					{
						loop: true,
						nav: false,
						dots: true,
						margin: 4,
						items: 2,
						autoplay: true
					}
				);
			} else if(windowWidth <= 1440) {
				$(".owl-carousel").owlCarousel(
					{
						loop: true,
						nav: false,
						dots: true,
						margin: 4,
						items: 4,
						autoplay: true
					}
				);
			} else if(windowWidth > 1440) {
				$(".owl-carousel").owlCarousel(
					{
						loop: true,
						nav: false,
						dots: true,
						margin: 4,
						items: 6,
						autoplay: true
					}
				);
			}
		});
	</script>
	<div class="owl-carousel owl-theme">
		<?php
			//　--------- 投稿情報を表示　---------
			$args = array(
				'post_type' => 'post', //カスタム投稿名
				'posts_per_page' => -1,        // 表示数
				'tag'            => "notice+${old_year}",
			);
			$the_query = new WP_Query( $args );// 新規WP query を作成　変数args で定義したパラメータを参照
			if ( $the_query->have_posts() ) :
			// ここから表示する内容を記入
			?>
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
		<div class="topic">
			<a href="<?php the_permalink(); ?>">
			<?php if(has_post_thumbnail()) : ?>
				<?php the_post_thumbnail( 'kiji-thumb' ); ?>
			<?php else : ?>
				<img src="<?php echo get_template_directory_uri(); ?>/img/empty.png">
			<?php endif; ?>
			<h2><?php the_title(); ?></h2>
			</a>
		</div>
			<?php endwhile; ?>
			<?php endif; ?>
	</div>
	
	<section class="white_back">
	<section id="about" class="clearfix">
		<div class="wrap">
			<div class="card" style="background: #fae053;">
				<div class="title">
					<h1 style="color:black;">名古屋ギターフェスティバル <?php echo esc_attr( $old_year ); ?></h1>
					<p style="color:black;"><time><?php echo esc_attr( $old_event_date ); ?></time> 名古屋・栄 宗次ホール</p>
				</div>
				<hr noshade>
				<div class="body flex_container">
					<div class="info">
						<h2>About</h2>
						<hr noshade>
						
						<?php 
							$page_info = get_page_by_path('about');
							$page = get_post($page_info);
							//echo $page->post_content;
						?>
						<h3>名古屋ギターフェスティバルとは</h3>
						<p>
						<?php echo esc_html( $old_about_content ); ?>
						</p>
						<div class="more">
								<!--<a href="<?php echo get_permalink( $page->ID ); ?>">...More</a>-->
						</div>
					</div>
					<div class="sign clearfix">
						<div><img class="u-max-full-width" src="<?php echo get_template_directory_uri(); ?>/img/sign.png"</div>
						<p>
						名古屋ギターフェスティバル</br>
						実行委員会委員長</br>
						生田直基</br>
						</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section id="news_area">
		<div class="wrap">
			<div class="flex_container">
				<div id="news">
					<h2>Latest News</h2>
					<hr>
					<?php
					$filter_cat_id = get_cat_ID( '出演者' ); //出演者のカテゴリーは除外する
					//　--------- 投稿情報を表示　---------
					$args = array(
						'post_type' => 'post', //カスタム投稿名
						'posts_per_page' => 3,        // 表示数
						'category__not_in' => $filter_cat_id,
						'tag'              => $old_year,
					);
					$the_query = new WP_Query( $args );// 新規WP query を作成　変数args で定義したパラメータを参照
					if ( $the_query->have_posts() ) :
					// ここから表示する内容を記入
					?>
					<ul>
						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<li>
							<time><?php the_time('Y.m.d'); ?></time><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</li>
						<?php endwhile; ?>
					</ul>
					<div class="more">
						<!--<a href="<?php echo home_url()."/blog/"; ?>">...More</a>-->
					</div>
					<?php endif; ?>
				</div>
				<div id="topics">
					<h2>Topics</h2>
					<hr>
					<?php
					$filter_cat_id = get_cat_ID( '出演者' ); //出演者のカテゴリーは除外する
					//　--------- 投稿情報を表示　---------
					$args = array(
						'post_type'        => 'post', //カスタム投稿名
						'posts_per_page'   => 3,        // 表示数
						'tag'              => "topics+${old_year}",
						'category__not_in' => $filter_cat_id,
					);
					$the_query = new WP_Query( $args );// 新規WP query を作成　変数args で定義したパラメータを参照
					if ( $the_query->have_posts() ) :
					// ここから表示する内容を記入
					?>
					<ul>
						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<li>
							<time><?php the_time('Y.m.d'); ?></time><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</li>
						<?php endwhile; ?>
					</ul>
					<div class="more">
						<!--<a href="/tag/topics/">...More</a>-->
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
	
	<section id="artists">
		<div class="wrap">
			<h2>Artists</h2>
			<hr>
			<div class="ja">出演</div>
			
			<?php
			//　--------- 投稿情報を表示　---------
			$args = array(
				'post_type'      => 'post', //カスタム投稿名
				'posts_per_page' => -1,        // 表示数
				'category_name'  => 'artists',
				'tag'            => $old_year,
			);
			$the_query = new WP_Query( $args );// 新規WP query を作成　変数args で定義したパラメータを参照
			if ( $the_query->have_posts() ) : ?>
				<div class="flex_container">
				<?php 
				while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<?php $catch_copy = get_post_meta(get_the_ID() , 'catch_copy' , true); ?>
					<?php $english_name = get_post_meta(get_the_ID() , 'english_name' , true); ?>
					<div class="artist">
						<div class="catch">
							<div class="eyecatch"><a href="<?php echo get_permalink(get_the_ID()); ?>"><?php echo get_the_post_thumbnail( get_the_ID(), 'art-thumb',array( 'class' => 'u-max-full-width' ) ); ?></a></div>
							<div class="catch_copy <?php echo $post_name;?>"><p><?php echo $english_name; ?></p></div>
						</div>
						<h3><a href="<?php echo get_permalink(get_the_ID()); ?>"><?php echo $english_name; ?><br><big><?php echo $post_title; ?></big></a></h3>
						<p><?php echo $catch_copy; ?></p>
					</div>
				<?php endwhile; ?>
				</div>
				<div class="more">
					<!--<a href="/category/artists/">...More</a>-->
				</div>
			<?php
			else: ?>
				<p>Comming Soon...</p>
			<?php endif;
			wp_reset_postdata();
			?>
		</div>
	</section>
	<section id="performances">
		<div class="wrap">
			<h2>Performance</h2>
			<hr>
			<div class="ja">演奏を聴く</div>
			<div class="flex_container">
			<?php
			//　--------- 投稿情報を表示　---------
			$args = array(
				'post_type'      => 'post', //カスタム投稿名
				'posts_per_page' => -1,        // 表示数
				'category_name'  => 'performance',
				'tag'            => $old_year,
			);
			$the_query = new WP_Query( $args );// 新規WP query を作成　変数args で定義したパラメータを参照
			if ( $the_query->have_posts() ) :
			// ここから表示する内容を記入
			?>
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<div class="performance">
					<div class="eyecatch">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_self">
						<?php if(has_post_thumbnail()) : ?>
								<?php the_post_thumbnail( 'kiji-thumb' ); ?>
						<?php else : ?>
							<img src="<?php echo get_template_directory_uri(); ?>/img/empty.png">
						<?php endif; ?>
						</a></div>
					<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_self"><?php the_title(); ?></a></h3>
				</div>
			<?php endwhile; ?>
			<?php endif; ?>
			</div>
			<div class="more clearfix">
				<!--<a href="/category/performance/">...More</a>-->
			</div>
		</div>
	</section>
	<section id="columun">
		<div class="wrap">
			<h2>Column</h2>
			<hr>
			<div class="ja">特集</div>
			<?php
					//　--------- 投稿情報を表示　---------
					$args = array(
						'post_type'      => 'post', //カスタム投稿名
						'posts_per_page' => -1,        // 表示数
						'category_name'  => 'column',
						'tag'            => $old_year,
					);
					$the_query = new WP_Query( $args );// 新規WP query を作成　変数args で定義したパラメータを参照
					if ( $the_query->have_posts() ) :
					// ここから表示する内容を記入
					?>
					<div class="flex_container">
						<?php while ( $the_query->have_posts() ) : $the_query->the_post();
							// -------- ここから繰り返し---------- ?>
						<div class="performance">
							<div class="eyecatch">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_self">
								<?php if(has_post_thumbnail()) : ?>
										<?php the_post_thumbnail( 'kiji-thumb' ); ?>
								<?php else : ?>
									<img src="<?php echo get_template_directory_uri(); ?>/img/empty.png">
								<?php endif; ?>
								</a></div>
							<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_self"><?php the_title(); ?></a></h3>
						</div>
						<?php endwhile; ?>
					</div>
					<div class="more clearfix">
						<!--<a href="/category/column/">...More</a>-->
					</div>
					<?php endif; ?>
		</div>
</section>
