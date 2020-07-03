<?php
/**
 * アーティスト一覧ページ
 *
 * @package NGF
 */

?>
<?php get_header(); //header.phpを取得 ?>

    <main class="container">
      <section class="white_back">
        <div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
          <div class="wrap archive">
            <?php if(function_exists('bcn_display'))
            {
                bcn_display();
            }?>
          </div>
        </div>
      <section id="artists_archive">
        <div class="wrap">
          <?php $category = get_queried_object(); ?>
          <h2><?php echo $category->slug; ?></h2>
          <hr>
					<div class="ja"><?php echo $category->name; ?></div>
					<?php
						////////////////////////////
						//除外する過去記事タグ処理
						////////////////////////////
						$define_not_tag_names = array(
							'2017','2018', '2019',
						);
						
						$tags = get_tags();
						$not_tag_ids = array();
						
						foreach ( $tags as $tag ) {
							if (in_array($tag->name, $define_not_tag_names)) {
								// 除外する過去記事タグであった場合、tag_idを保存
								$not_tag_ids[] = $tag->term_taxonomy_id;
							}
						}
						// --------- 投稿情報を表示---------
						$args = array(
							'category_name' => $category->slug,
							'tag__not_in'   => $not_tag_ids, // タグを含まない.
						);
						$the_query = new WP_Query( $args ); // 新規WP query を作成変数argsで定義したパラメータを参照.
						if ( $the_query->have_posts() ) :
							?>
							<div class="flex_container">
								<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
									<?php $catch_copy = get_post_meta(get_the_ID() , 'catch_copy' , true); ?>
									<?php $english_name = get_post_meta(get_the_ID() , 'english_name' , true); ?>
									<div class="artist">
										<div class="catch">
											<div class="eyecatch"><a href="<?php the_permalink(); ?>"><?php echo the_post_thumbnail( 'art-thumb',array( 'class' => 'u-max-full-width' ) ); ?></a></div>
											<?php $catch_copy_css = get_post_meta(get_the_ID() , 'catch_copy_css' , true); ?>
											<div class="catch_copy <?php echo get_post_field( 'post_name', get_the_ID() );?>"><p class="<?php echo $catch_copy_css; ?>"><?php echo $english_name; ?></p></div>
										</div>
										<h3><a href="<?php the_permalink(); ?>"><?php echo $english_name; ?><br><big><?php echo the_title(); ?></big></a></h3>
										<p><?php echo $catch_copy; ?></p>
									</div>
								<?php endwhile; ?>
								</div>
								<?php if (!is_null(get_previous_posts_link())):?>
								<div class="prev">
									<?php previous_posts_link('<p>< Prev</p>') ?>
								</div>
								<?php endif; ?>
								<?php if (!is_null(get_next_posts_link())):?>
								<div class="next clearfix">
									<?php next_posts_link('<p>Next ></p>') ?>
								</div>
								<?php endif; ?>
								<?php
										// -------- 投稿のWP_query終了-----------
										wp_reset_postdata();
										?>
							</div>
						<?php else : ?>
							<div class="coming-soon">
								<p class="coming-soon__headline">Coming Soon...</p>
							</div>
						<?php endif; ?>
			</section>
<?php get_footer(); // footer.phpを取得. ?>
