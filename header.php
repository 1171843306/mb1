<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>
        <?php if ( is_home() ) {   
            bloginfo('name');   
            } elseif ( is_category() ) {   
            single_cat_title(); echo " - "; bloginfo('name');   
            } elseif (is_single() || is_page() ) {   
            single_post_title(); echo " lambda模板 ";   
            } elseif (is_search() ) {   
            echo "搜索结果"; echo " - "; bloginfo('name');   
            } elseif (is_404() ) {   
            echo '页面未找到!';   
            } else {   
            wp_title('',true);   
            } 
        ?>
    </title>
<meta name="keywords" content="lambda模板">
<meta name="description" content="lambda模板">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8"> 
<link rel="stylesheet" id="metaslider-flex-slider-css" href="<?php bloginfo('template_directory'); ?>/css/flexslider.css" type="text/css" media="all" property="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/main.css">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_head(); ?> 
</head>
<body>
<!--头部-->
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/jss/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.KinSlideshow-1.2.1.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/MSClass.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.media.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/comm.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/base.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/focus.js"></script> 


<!--[if lte IE 6]>
<script src="/001lt40/templates/001lt40/js/DD_belatedPNG_0.0.8a.js" type="text/javascript"></script>
    <script type="text/javascript">
        DD_belatedPNG.fix('div,ul,img,li,input,a,span,p');
    </script>
<![endif]-->
<!--头部-->
<div class="header">
    <div class="header-content">
        <div class="logo">
        <a href="<?php echo get_option('home'); ?>/"><img src="<?php bloginfo('template_url'); ?>/images/fosulogo.png"></a>
        <h2>二级标题</h2>
        </div>
        <!--搜索-->
       <div class="search">
        <form id="search " action="<?php bloginfo('url'); ?>/" target="_blank">
            <input id="keywords" id="s" name="s" name="keywords" class="input-text" type="text" value="<?php the_search_query(); ?>" x-webkit-speech="" placeholder="&nbsp;站内搜索" value="&nbsp;站内搜索" onfocus="if (value =='&nbsp;站内搜索'){value ='<?php the_search_query(); ?>'}" onclick="javascript:this.value=''" onblur="if (value ==''){value='站内搜索'}" alt="search">

            <input class="input-btn" type="submit" value="" onclick="if(document.forms['search'].searchinput.value=='- Search -')document.forms['search'].searchinput.value='';" alt="search">
        </form>


        </div><div class="clear"></div>
    </div>
</div>
    <!--搜索-->

    <!--导航栏-->
<div class="nav">
<div class="nav_conent">
    <ul id="nav_menu">
    <?php 
            wp_nav_menu( array( 'theme_location'=>'PrimaryMenu', 'container_class' => 'on', 'depth' => 2) );
    ?>
  </ul>
  </div><div class="clear"></div>
</div>
 <!--导航栏-->

<!--幻灯片-->
<div class="banner">
    <?php 
    echo do_shortcode("[metaslider id=46]"); 
?>

</div>
<!--头部-->
 
<!--头部-->

<!-- 
使用请注来源谢谢 >_<
Theme Name: fjl模板
Theme URI: www.yzx-fjl.top/wordpress.com
qq:1171843306
Weichat:YZX_FJL
 -->