<?php
/*
Template Name: トップページ
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
      <section id="archive">
        <div class="wrap">
          <h2>All</h2>
          <hr>
          <div class="ja">全ての記事</div>
          <div class="flex_container">
          
          <?php 
            if ( have_posts() ) :
            // ここから表示する内容を記入
            ?>
          
          <?php while ( have_posts() ) : the_post(); ?>
          <?php
            /*
            $categories = get_the_category();
            $is_artists = false;
            foreach ($categories as $category) {
              if($category->slug === 'artists') {
                $is_artists = true; //出演者記事は除外
                break;
              }
            }
            if($is_artists) continue; //出演者記事は除外
            */
          ?>
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
          <?php if (!is_null(get_previous_posts_link())):?>
          <div class="prev">
            <?php previous_posts_link('<p>< Prev</p>') ?>
          </div>
          <?php endif; ?>
          <?php if (!is_null(get_next_posts_link())):?>
          <div class="next">
            <?php next_posts_link('<p>Next ></p>') ?>
          </div>
          <?php endif; ?>
          <?php endif; ?>
          <?php
              // -------- 投稿のWP_query終了-----------
              wp_reset_postdata();
              ?>
        </div>
      </section>
      
<?php get_footer(); //footer.phpを取得 ?>