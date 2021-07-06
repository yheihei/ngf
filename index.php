<?php
/*
Template Name: トップページ
*/
?>
<?php get_header(); //header.phpを取得 ?>
	<?php
		$is_movie_play = false;
	?>
		<section id="cover" style="background-image:url('<?php echo esc_attr( get_template_directory_uri() ); ?>/img/cover_2020.jpg');"
			class="cover cover--large-height" >
			<?php if ( $is_movie_play ) : ?>
				<div id="player">
					<div class="wrap">
						<!-- 動画コンテンツが挿入される -->
					</div>
				</div>
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
							videoId: 'I6MrGIldd_k',
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
			<?php endif; ?>
			<img class="cover__headline-image" src='<?php echo esc_attr( get_template_directory_uri() ); ?>/img/webtop_word_2021.png'>
    </section>
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
      <?php 
			/**
			 * 除外する過去記事タグ処理.
			 */
			$ignore_tag_names = array(
				'2017',
				'2018',
				'2019',
			);
			$current_tags   = get_tags();
			$ignore_tag_ids = array();
			foreach ( $current_tags as $current_tag ) {
				if ( in_array( $current_tag->name, $ignore_tag_names, true ) ) {
					// 除外する過去記事タグであった場合、tag_idを保存.
					$ignore_tag_ids[] = $current_tag->term_taxonomy_id;
				}
			}
			?>
      <div class="owl-carousel owl-theme">
        <?php
          //　--------- 投稿情報を表示　---------
          $args = array(
            'post_type' => 'post', //カスタム投稿名
            'posts_per_page' => 6,        // 表示数
            'tag' => 'notice',
            'tag__not_in' => $ignore_tag_ids, // タグを含まない
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
            <div class="empty"
              style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/empty.png?2018');"></div>
            <!--<img src="<?php echo get_template_directory_uri(); ?>/img/empty.png">-->
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
          <div class="card">
            <div class="title">
              <h1>名古屋ギターフェスティバル 2021</h1>
              <p><time>2021.8.28(土)</time> 名古屋・栄 宗次ホール</p>
            </div>
            <div class="body flex_container">
              <div class="info">
                <h2>About</h2>
                <hr noshade>
                
                <?php 
                	$page_info = get_page_by_path('about');
                	$page = get_post($page_info);
                	//echo $page->post_content;
                ?>
                <h3><?= $page->post_title ?></h3>
                <p>
                  <?php $description = get_post_meta($page->ID , 'description' , true); 
                  echo $description; ?>
                </p>
                <div class="more">
                    <a href="<?php echo get_permalink( $page->ID ); ?>">...More</a>
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
                <a href="<?php echo home_url()."/blog/"; ?>">...More</a>
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
                'post_type' => 'post', //カスタム投稿名
                'posts_per_page' => 3,        // 表示数
                'tag' => 'topics',
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
                <a href="<?php echo esc_url( home_url() ); ?>/tag/topics/">...More</a>
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
            'post_type' => 'post', //カスタム投稿名
            'posts_per_page' => 4,        // 表示数
            'category_name' => 'artists',
            'tag__not_in' => $ignore_tag_ids, // タグを含まない
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
                  <?php $catch_copy_css = get_post_meta(get_the_ID() , 'catch_copy_css' , true); ?>
                  <div class="catch_copy <?php echo $post_name;?>"><p class="<?php echo $catch_copy_css; ?> "><?php echo $english_name; ?></p></div>
                </div>
                <h3><a href="<?php echo get_permalink(get_the_ID()); ?>"><?php echo $english_name; ?><br><big><?php echo $post_title; ?></big></a></h3>
                <p><?php echo $catch_copy; ?></p>
              </div>
            <?php endwhile; ?>
            </div>
            <div class="more">
              <a href="<?php echo esc_url( home_url() ); ?>/category/artists/">...More</a>
            </div>
          <?php
          else: ?>
						<div class="coming-soon">
							<p class="coming-soon__headline">Coming Soon...</p>
						</div>
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
          <?php
          //　--------- 投稿情報を表示　---------
          $args = array(
            'post_type' => 'post', //カスタム投稿名
            'posts_per_page' => 6,        // 表示数
            'category_name' => 'performance',
            'tag__not_in' => $ignore_tag_ids, // タグを含まない
          );
          $the_query = new WP_Query( $args );// 新規WP query を作成　変数args で定義したパラメータを参照
          if ( $the_query->have_posts() ) :
          // ここから表示する内容を記入
          ?>
          <div class="flex_container">
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
          </div>
          <div class="more clearfix">
            <a href="<?php echo esc_url( home_url() ); ?>/category/performance/">...More</a>
          </div>
          <?php else: ?>
						<div class="coming-soon">
							<p class="coming-soon__headline">Coming Soon...</p>
						</div>
          <?php endif;
          wp_reset_postdata();
          ?>
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
                'post_type' => 'post', //カスタム投稿名
                'posts_per_page' => 6,        // 表示数
                'category_name' => 'column',
                'tag__not_in' => $ignore_tag_ids, // タグを含まない
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
                <a href="<?php echo esc_url( home_url() ); ?>/category/column/">...More</a>
              </div>
              <?php else: ?>
              <p>Coming Soon...</p>
              <?php endif;
              wp_reset_postdata();
              ?>
        </div>
      </section>

      
      
<?php get_footer(); //footer.phpを取得 ?>