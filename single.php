<?php
/*
Template Name: トップページ
*/
?>
<?php get_header(); //header.phpを取得 ?>

    <main class="container">
      <section class="white_back">
        <div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
          <div class="wrap">
            <?php if(function_exists('bcn_display'))
            {
                bcn_display();
            }?>
          </div>
        </div>
      <section id="post">
        <div class="wrap">
          <?php if ( have_posts() ) : //条件分岐：投稿があるなら ?>
            <?php while ( have_posts() ) : the_post();//繰り返し処理開始 ?>
              <h1><?php the_title(); ?></h1>
              <hr>
              <?php //カテゴリーの表示
                $cat = get_the_category();
                $cat = $cat[0];
              ?>
              <?php if($cat->slug === 'artists') : // artistページのみ日付表示なし ?>
              <div class="ja"><?php echo $cat->cat_name ?></div>
              <?php else : ?>
              <div class="ja"><?php echo $cat->cat_name ?>　<time><?php the_time('Y.m.d'); ?></time></div>
              <?php endif; ?>
              
              <div class="eyecatch">
                <?php the_post_thumbnail( 'full', array( 'class' => 'u-max-full-width' ) ); ?>
              </div>
              
              <div class="contents">
                <?php the_content(); ?>
              </div>
              
              <h3>みんなにシェアする</h3>
              <div class="button-area">
               <div class="button-whole">
                  <a class="button-link opensub" id="twitter"
                     href="http://twitter.com/intent/tweet?text=<?php echo urlencode(the_title("","",0)); ?>%7c<?php bloginfo('name'); ?>&amp;<?php echo urlencode(get_permalink()); ?>&amp;url=<?php echo urlencode(get_permalink()); ?>"
                     target="_blank" title="Twitterで共有">
                     <i class="fa fa-twitter"></i>
                  </a>
               </div>
               <div class="button-whole">
                  <a class="button-link opensub" id="facebook"
                     href="http://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink()); ?>&amp;t=<?php echo urlencode(the_title("","",0)); ?>|<?php bloginfo('name'); ?>"
                     target="_blank" title="Facebookで共有">
                     <i class="fa fa-facebook"></i>
                  </a>
               </div>
               <div class="button-whole">
                  <a class="button-link opensub" id="hatena"
                     href="http://b.hatena.ne.jp/add?mode=confirm&amp;url=<?php echo urlencode(get_permalink()); ?>&amp;title=<?php echo urlencode(the_title("","",0)).'|'. get_bloginfo('name'); ?>"
                     target="_blank"
                     data-hatena-bookmark-title="<?php the_permalink(); ?>"
                     title="このエントリーをはてなブックマークに追加">
                     <strong>B!</strong>
                  </a>
               </div>
              </div>
    
              <?php endwhile; ?>
              
              <?php wp_related_posts()?>
              
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