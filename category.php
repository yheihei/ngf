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
      <section id="archive" style="padding-bottom: 40px;">
        <div class="wrap">
          <?php $category = get_queried_object(); ?>
          <h2>
          <?php 
          $category_display_name = str_replace("-", " ", $category->slug);
          echo $category_display_name;
          ?></h2>
          <hr>
          <div class="ja"><?php echo $category->name; ?></div>
          <?php
          $current_category_id = get_query_var('cat');
          $post_id = 'category_' . $current_category_id;
          $category_eyecatch_url = get_field(NGF_CATEGORY_EYECATCH,$post_id);  
          if( $category_eyecatch_url ): 
              // アイキャッチ表示
              ?>
          <img class='eyecatch eyecatch--full' src="<?= $category_eyecatch_url ?>"">
          <?php endif; ?>
          <?php
          $category_body = get_field(NGF_CATEGORY_BODY,$post_id); 
          ?>
          <?php if( $category_body ): ?>
          <div class="post_contents">
            <?php echo $category_body; ?>
          </div>
          <?php endif; ?>
          <div class="flex_container">
          
          <?php 
          ////////////////////////////
          //除外する過去記事タグ処理
          ////////////////////////////
          $define_not_tag_names = array(
            '2017','2018',
          );
          
          $tags = get_tags();
          $not_tag_ids = array();
          
          foreach ( $tags as $tag ) {
            if (in_array($tag->name, $define_not_tag_names)) {
              // 除外する過去記事タグであった場合、tag_idを保存
              $not_tag_ids[] = $tag->term_taxonomy_id;
            }
          }
          ?>

          <?php if(is_show_childs_category_page()) :

            // 直近の子カテゴリーの一覧を表示する場合
            $child_categorys = getCategorysChilds( $current_category_id );
            ?>
            <?php foreach($child_categorys as $child_category): 
              $category_link = get_category_link($child_category->term_taxonomy_id);
              $thumbnail = get_category_thumbnail($child_category->term_taxonomy_id);     
              ?>
              <div class="performance">
                <div class="eyecatch">
                  <a href="<?= $category_link ?>" title="<?= $child_category->name ?>" target="_self">
                    <img src="<?= $thumbnail ?>">
                  </a>
                </div>
                <h3><a href="<?= $category_link ?>" title="<?= $child_category->name ?>" target="_self"><?= $child_category->name ?></a></h3>
              </div>
            <?php endforeach; ?>

          <?php else: 
            // 記事一覧を表示する場合
            ?>
            
            <?php
            //　--------- 投稿情報を表示　---------
            $paged = get_query_var('paged') ? get_query_var('paged') : 1;
            $args = array(
              'category_name' => $category->slug,
              'tag__not_in' => $not_tag_ids, // タグを含まない
              'paged' => $paged,
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
            <?php
                // -------- 投稿のWP_query終了-----------
                wp_reset_postdata();
                ?>
            <?php else: ?>
              <p>Coming soon...</p>
            <?php endif; ?>

          <?php endif; ?>
          
        </div>
      </section>
      
<?php get_footer(); //footer.phpを取得 ?>