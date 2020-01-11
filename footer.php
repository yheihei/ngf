      <section id="cv">
        <div class="wrap">
          <div class="flex_container">
            <div id="ticket">
              <h2>Ticket</h2>
              <hr>
              <div class="ja">チケット</div>
              <h3>チケット情報</h3>
              <p><b>2019年8月3日（土）　昼夜２公演</b></br></p>
              <table class="table2" border=1>
                <tr><th class="first">公演</th><th class="second">開演</th><th>開場</th><th>一般</th><th>学生</th><th>チャリティシート</th></tr>
                <tr><td><b>第1部</b></td><td>14:00</td><td>(13:30)</td><td>2,500円</td><td>1,500円</td><td>2,750円</td></tr>
                <tr><td><b>第2部</b></td><td>18:00</td><td>(17:30)</td><td>3,000円</td><td>1,800円</td><td>3,300円</td></tr>
              </table>
              <div class="set">
                <div class="title">
                  昼夜セット券
                </div>
                <div class="price">
                  5,000円
                </div>
                <div class="note">
                  ※学生及びチャリティシートのセット券はございません。
                </div>
              </div>
              <div class="m_note">
                ※学生及びチャリティシートのセット券はございません。
              </div>
              <p class="note">●各自由席。  ●チャリティーシート…A・B席中央23列限定の指定席。</br>
●本公演はハーフ60の設定を行いません。  ●各部休憩を含む上演2時間程度の予定。</p>
              <p>チケット発売日<br>
              5月19日（日） 10:00より<br>
</p>
              <h3>チケット販売</h3>
              <ul>
                <li>
                  <div class="flex_container">
                    <div class="ticket_info soji">
                      <p><a href="http://www.munetsuguhall.com/ticket/index2.php">宗次ホールチケットセンター</a></br><small>(営業時間 10:00 〜 16:00)</small></p>
                    </div>
                    <div class="contact soji">
                      <p><i class="fa fa-phone-square" aria-hidden="true"></i> <a href="tel:0522651718">052-265-1718</a></p>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="flex_container">
                    <div class="ticket_info">
                      <p><a href="https://t.pia.jp/pia/event/event.do?eventCd=1921847">チケットぴあ</a></p>
                    </div>
                    <div class="contact clearfix">
                      <p><i class="fa fa-phone-square" aria-hidden="true"></i> <a href="tel:0570029999">0570-02-9999</a></p>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
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
