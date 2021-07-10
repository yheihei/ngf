<?php
/**
 * フッターテンプレート
 *
 * @package ngf
 */

?>
			<section id="cv">
        <div class="wrap">
          <div class="flex_container">
						<?php dynamic_sidebar( 'ngf_ticket' ); ?>
            <div id="access">
              <h2>Access</h2>
              <hr>
              <div class="ja">アクセス</div>
              <div id="google_map_area" style=""></div>
              <p><b>宗次ホール</b>　〒460-0008 名古屋市中区栄4丁目5番14号</br>
              交通アクセス：地下鉄 栄駅12番出口より徒歩4分</br>
              名古屋駅よりタクシーで約20分（料金：約1,200円）</p>
            </div>
          </div>
        </div>
      </section>
				<?php dynamic_sidebar( 'ngf_banner' ); ?>
      </section>
          </main>
    
    <footer class="container">
      <div class="wrap">
        <div class="flex_container">
          <div class="logo">
          <h1><a href="<?php echo home_url(); ?>"><img class="u-max-full-width block-center" src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="Nagoya Guitar Festival" /></a></h1>
          </div>
          <div class="guide clearfix">
            <?php
            wp_nav_menu(array( 
              'theme_location' => 'footer-navi',
              'menu_class' => 'footer_navi_ul',
            ));
            ?>
          </div>
          <div class="share clearfix">
            <ul class="share_ul">
              <li><a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode("http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ); ?>&amp;t=<?php wp_title( '|', true, 'right' ); //ページタイトルを出力 ?><?php bloginfo('name'); ?>"
                   target="_blank" title="Facebookで共有">
              <i class="fa fa-facebook" aria-hidden="true"></i>
              </a></li>
              <li><a href="http://twitter.com/intent/tweet?text=<?php wp_title( ' ', true, 'right' ); //ページタイトルを出力 ?><?php bloginfo('name'); ?>&amp;<?php echo urlencode("http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]); ?>&amp;url=<?php echo urlencode("http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]); ?>"
                   target="_blank" title="Twitterで共有">
              <i class="fa fa-twitter" aria-hidden="true"></i>
              </a></li>
            </ul>
          </div>
        </div>
        <div id="copy">&copy;NAGOYA GUITAR FESTIVAL</div>
      </div>
    </footer>
    <?php wp_footer(); ?>
  </body>
</html>
