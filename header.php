<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php wp_title( '|', true, 'right' ); //ページタイトルを出力 ?><?php bloginfo('name'); ?></title>
    <meta name="author" content="Yohei Kokubo">
    <meta name="keywords" content="">
    
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.css">
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/owlcarousel/assets/owl.theme.default.min.css">
    
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); echo '?' . filemtime( get_stylesheet_directory() . '/style.css'); ?>">
    <meta name="copyright" content="Copyright (C) Yhei Web Design All Rights Reserved.">

    <!-- jQuery -->
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <!-- Font awesome -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/font-awesome/css/font-awesome.min.css">
    <!-- google font -->
    <link href="//fonts.googleapis.com/css?family=Cormorant+Garamond:500i" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Tangerine:700" rel="stylesheet">

    <!-- Owl Carousel JS -->
		<script src="<?php echo get_template_directory_uri(); ?>/owlcarousel/owl.carousel.min.js"></script>
		<?php dynamic_sidebar( 'ngf_head' ); ?>
    <?php wp_head(); //wp_headはテーマの</head>タグ直前に必ず挿入します ?>
  </head>

  <?php if(is_page("2017top") || is_tag('2017') || is_single_tag( '2017' ) ): ?>
  <body class="ngf2017">
  <?php else : ?>
  <body>
  <?php endif; ?>

    <script>
      // deviderの描画処理
      $(function(){
        $(document).ready(function(){
    
          var windowWidth = $(window).width();
          //console.log(windowWidth);
          //width = String(windowWidth/2);
          //console.log(width + 'px!');
          //$('.sep').css({'border-right-width' : width+'px', 'border-left-width' : width+'px'});
          $('.sep').css({'border-right-width' : windowWidth+'px'});
          
          $(window).resize(function() {
            var windowWidth = $(window).width();
            //console.log(windowWidth);
            //width = String(windowWidth/2);
            //console.log(width + 'px!');
            //$('.sep').css({'border-right-width' : width+'px', 'border-left-width' : width+'px'});
            $('.sep').css({'border-right-width' : windowWidth+'px'});
          });
          
        });
      });
    </script>
    
    <script type="text/javascript">
    function googleMap() {
    var latlng = new google.maps.LatLng(35.169091, 136.912643);/* 座標 */
    var myOptions = {
    zoom: 14, /*拡大比率*/
    center: latlng,
    scrollwheel: false,
    disableDoubleClickZoom: true,
    draggable: true,
    mapTypeControlOptions: { mapTypeIds: ['style', google.maps.MapTypeId.ROADMAP] }
    };
    var map = new google.maps.Map(document.getElementById('google_map_area'), myOptions);
    /*アイコン設定*/
    var icon = new google.maps.MarkerImage('<?php echo get_template_directory_uri(); ?>/img/pin.png',/*画像url*/
    new google.maps.Size(48,56),/*アイコンサイズ*/
    new google.maps.Point(0,0)/*アイコン位置*/
    );
    var markerOptions = {
    position: latlng,
    map: map,
    icon: icon,
    title: '宗次ホール',/*タイトル*/
    animation: google.maps.Animation.DROP/*アニメーション*/
    };
    var marker = new google.maps.Marker(markerOptions);
    /*取得スタイルの貼り付け*/
    var styleOptions = [
    {
    "stylers": [
    { "hue": '#fae053' }
    ]
    }
    ];
    var styledMapOptions = { name: '宗次ホール' }/*地図右上のタイトル*/
    var sampleType = new google.maps.StyledMapType(styleOptions, styledMapOptions);
    map.mapTypes.set('style', sampleType);
    map.setMapTypeId('style');
    };
    google.maps.event.addDomListener(window, 'load', function() {
    googleMap();
    });
    </script>
    <script>
      
    
    </script>
    <script>
      document.addEventListener( 'wpcf7mailsent', function( event ) {
          ga('send', 'event', 'Contact Form', 'submit');
      }, false );
    </script>
    <!-- Heat Map -->
    <script type="text/javascript">
    window._pt_lt = new Date().getTime();
    window._pt_sp_2 = [];
    _pt_sp_2.push('setAccount,2d62bf23');
    var _protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
    (function() {
        var atag = document.createElement('script'); atag.type = 'text/javascript'; atag.async = true;
        atag.src = _protocol + 'js.ptengine.jp/pta.js';
        var stag = document.createElement('script'); stag.type = 'text/javascript'; stag.async = true;
        stag.src = _protocol + 'js.ptengine.jp/pts.js';
        var s = document.getElementsByTagName('script')[0]; 
        s.parentNode.insertBefore(atag, s); s.parentNode.insertBefore(stag, s);
    })();
</script>
    <!-- /HeatMap -->
    <header>
      <section id="menu">
        <img src="<?php echo get_template_directory_uri(); ?>/img/top_side.png" class="left_side">
        <img src="<?php echo get_template_directory_uri(); ?>/img/top_side.png" class="right_side">
        <div class="wrap">
          <div class="logo">
            <h1><a href="<?php echo home_url(); ?>"><img class="u-max-full-width" src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="Nagoya Guitar Festival" /></a></h1>
          </div>
          
          <div class="menu_right">
            <div class="share clearfix">
              <ul class="share_ul">
                <li><a href="https://www.facebook.com/sharer.php?u=<?php echo urlencode("https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ); ?>&amp;t=<?php wp_title( '|', true, 'right' ); //ページタイトルを出力 ?><?php bloginfo('name'); ?>"
                     target="_blank" title="Facebookで共有">
                <i class="fa fa-facebook" aria-hidden="true"></i>
                </a></li>
                <li><a href="https://twitter.com/intent/tweet?text=<?php wp_title( ' ', true, 'right' ); //ページタイトルを出力 ?><?php bloginfo('name'); ?>&amp;<?php echo urlencode("https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]); ?>&amp;url=<?php echo urlencode("https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]); ?>"
                     target="_blank" title="Twitterで共有">
                <i class="fa fa-twitter" aria-hidden="true"></i>
                </a></li>
              </ul>
            </div>
            <?php
            wp_nav_menu(array( 
              'theme_location' => 'global-navi',
              'container_class' => 'pc_navi',
              'menu_class' => 'pc_navi_ul',
            ));
            ?>
          </div>
          <a class="menu-trigger">
          	<span></span>
          	<span></span>
          	<span></span>
          </a>
          <?php
          wp_nav_menu(array( 
            'theme_location' => 'global-navi',
            'menu_class' => 'sp_navi_ul',
          ));
          ?>
        </div>
        <script>
          $(document).ready(function(){
            $('.menu-trigger').click(function(){
               $(this).toggleClass('active');
               $('ul.sp_navi_ul').slideToggle();
            });
          });
        </script>
      </section>
    </header>