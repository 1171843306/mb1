<?php
// 获取文章第一张图片Begin
function catch_that_image() {
global $post, $posts;
$first_img = '';
ob_start();
ob_end_clean();
$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
 
//获取文章中第一张图片的路径并输出
$first_img = $matches [1] [0];
 
//如果文章无图片，获取自定义图片
 
if(empty($first_img)){ //Defines a default image
$first_img = "/images/default.jpg";
 
//请自行设置一张default.jpg图片
}
 
return $first_img;
}
//获取文章第一张图片End
?>
<?php 
/**
 * WordPress 发布文章前必须选择分类
 * http://www.wpdaxue.com/choose-a-category-before-publish.html
 */
add_action('admin_footer-post.php', 'choose_a_category_before_publish');
add_action('admin_footer-post-new.php', 'choose_a_category_before_publish');
function choose_a_category_before_publish(){
  global $post_type;
  if($post_type=='post'){
    echo "<script>
jQuery(function($){
  $('#publish, #save-post').click(function(e){
    if($('#taxonomy-category input:checked').length==0){
      alert('抱歉，发布文章前，请选择一个分类');
      e.stopImmediatePropagation();
      return false;
    }else{
      return true;
    }
  });
  var publish_click_events = $('#publish').data('events').click;
  if(publish_click_events){
    if(publish_click_events.length>1){
      publish_click_events.unshift(publish_click_events.pop());
    }
  }
  if($('#save-post').data('events') != null){
    var save_click_events = $('#save-post').data('events').click;
    if(save_click_events){
      if(save_click_events.length>1){
        save_click_events.unshift(save_click_events.pop());
      }
    }
  }
});
</script>";
  }
}
// 后台精简
function disable_dashboard_widgets() {   
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');//近期评论 
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'normal');//近期草稿
    remove_meta_box('dashboard_primary', 'dashboard', 'core');//wordpress博客  
    remove_meta_box('dashboard_secondary', 'dashboard', 'core');//wordpress其它新闻   
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');//wordresss链入链接  
    remove_meta_box('dashboard_plugins', 'dashboard', 'core');//wordpress链入插件  
    remove_meta_box('dashboard_quick_press', 'dashboard', 'core');//wordpress快速发布   
}  
add_action('admin_menu', 'disable_dashboard_widgets');
//add_filter ('pre_site_transient_update_core', '__return_null');
//remove_action ('load-update-core.php', 'wp_update_plugins');
//add_filter ('pre_site_transient_update_plugins', '__return_null');
//remove_action ('load-update-core.php', 'wp_update_themes');
// 开启小工具

// 新闻幻灯片图片
function thumb_img($soContent){ 
$soImages = '~<img [^\>]*\ />~'; 
preg_match_all( $soImages, $soContent, $thePics ); 
$allPics = count($thePics[0]); 
if( $allPics > 0 ){ 

echo $thePics[0][0]; 

} 
else { 

echo "<img src='"; 
echo bloginfo('template_url'); 
echo "/images/thumb.png'>"; 
} 
}
function get_thumb_img($soContent){ 
  $str='';
$soImages = '~<img [^\>]*\ />~'; 
preg_match_all( $soImages, $soContent, $thePics ); 
$allPics = count($thePics[0]); 
if( $allPics > 0 ){ 

$str.=$thePics[0][0]; 

} 
else { 

$str.= "<img src='"; 
$str.=  get_bloginfo('template_url'); 
$str.= "/images/thumb.png'>"; 
} 
return $str;
} 


//设置主题
add_action( 'after_setup_theme', 'my_setup' );
  
if ( ! function_exists( 'my_setup' ) ):
  
function my_setup() {
  
    // This theme uses post thumbnails
    if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
        add_theme_support( 'post-thumbnails' );
        add_image_size( 'slider-post-thumbnail', 1000, 165, true ); // Slider Thumbnail
    }
}
endif;
  
//register post types
/* Slider */
function my_post_type_slider() {
    register_post_type( 'slider',
                array(
                'label' => __('幻灯片'),
                'singular_label' => __('幻灯片', 'twentyeleven'),
                '_builtin' => false,
                'exclude_from_search' => true, // Exclude from Search Results
                'capability_type' => 'page',
                'public' => true,
                'show_ui' => true,
                'show_in_nav_menus' => false,
                'rewrite' => array(
                    'slug' => 'slide-view',
                    'with_front' => FALSE,
                ),
                'query_var' => "slide", // This goes to the WP_Query schema
                'menu_icon' => get_bloginfo('stylesheet_directory') . '/includes/images/icon_slides.png',
                'supports' => array(
                        'title',
                        'custom-fields',
                        'editor',
                        'thumbnail')
                    )
                );
}
  
add_action('init', 'my_post_type_slider');

// 文章缩略图结束
  //分页功能

// 修改HTTPhead信息
function remove_x_pingback($headers) {
unset($headers['X-Pingback']);
return $headers;
}
add_filter('wp_headers', 'remove_x_pingback');

?>

<?php 
  // register_nav_menus();
  register_nav_menus(array('PrimaryMenu'=>'导航','outsidelinks'=>'外部链接','office'=>'网上办公'));
  add_theme_support('nav_menus'); 
?>

<?php
  //面包屑导航
  function wheatv_breadcrumbs() {
    $delimiter = ' > ';
    $name = '首页'; //
    
    if ( !is_home() ||!is_front_page() || is_paged() ) {
   
      global $post;
      $home = get_bloginfo('url');
      echo '<a href="' . $home . '"  class="gray">' . $name . '</a> ' . $delimiter . ' ';
   
      if ( is_category() ) {
        global $wp_query;
        $cat_obj = $wp_query->get_queried_object();
        $thisCat = $cat_obj->term_id;
        $thisCat = get_category($thisCat);
        $parentCat = get_category($thisCat->parent);
        if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
        echo single_cat_title();
   
      } elseif ( is_day() ) {
        echo '<a href="' . get_year_link(get_the_time('Y')) . '"  class="gray">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
        echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '"  class="gray">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
        echo get_the_time('d');
   
      } elseif ( is_month() ) {
        echo '<a href="' . get_year_link(get_the_time('Y')) . '"  class="gray">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
        echo get_the_time('F');
   
      } elseif ( is_year() ) {
        echo get_the_time('Y');
   
      } elseif ( is_single() ) {
        $cat = get_the_category(); $cat = $cat[0];
        // echo $cat->cat_name;
        echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        echo '正文';
   
      } elseif ( is_page()||!$post->post_parent ) {
        the_title();
   
      } elseif ( is_page()||$post->post_parent ) {
        $parent_id  = $post->post_parent;
        $breadcrumbs = array();
        while ($parent_id) {
          $page = get_page($parent_id);
          $breadcrumbs[] = '<a href="http://www.wheatv.com/site/wp-admin/ . get_permalink($page->ID) . "  class="gray">' . get_the_title($page->ID) . '</a>';
          $parent_id  = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
        the_title();
   
      } elseif ( is_search() ) {
        echo get_search_query();
   
      } elseif ( is_tag() ) {
        echo single_tag_title();
   
      } elseif ( is_author() ) {
         global $author;
        $userdata = get_userdata($author);
        echo '由'.$userdata->display_name.'发表';
   
      } elseif ( is_404() ) {
        echo '404 错误';
      }
   
      if ( get_query_var('paged') ) {
        if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
        echo '第' . ' ' . get_query_var('paged').' 页';
        if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
      }
    }else{
      echo $name;
    }
  }

  // 面包屑导航
  
?>

<?php add_theme_support( 'post-formats', array('aside','gallery','link','image','quote') ) ?>

<?php
/*
Plugin Name: WPJAM Blogroll
Plugin URI: http://blog.wpjam.com/m/wpjam-blogroll/
Description: 快速添加友情链接
Version: 0.1
Author: Denis
Author URI: http://blog.wpjam.com/
*/
add_action('admin_init', 'wpjam_blogroll_settings_api_init');
function wpjam_blogroll_settings_api_init() {
    add_settings_field('wpjam_blogroll_setting', '友情链接', 'wpjam_blogroll_setting_callback_function', 'reading');
    register_setting('reading','wpjam_blogroll_setting');
}
 
function wpjam_blogroll_setting_callback_function() {
    echo '<textarea name="wpjam_blogroll_setting" rows="10" cols="50" id="wpjam_blogroll_setting" class="large-text code">' . get_option('wpjam_blogroll_setting') . '</textarea>';
}
 
function wpjam_blogroll(){
    $wpjam_blogroll_setting =  get_option('wpjam_blogroll_setting');
    if($wpjam_blogroll_setting){
        $wpjam_blogrolls = explode("\n", $wpjam_blogroll_setting);
        foreach ($wpjam_blogrolls as $wpjam_blogroll) {
            $wpjam_blogroll = explode("|", $wpjam_blogroll );
            echo '  <a href="'.trim($wpjam_blogroll[0]).'" title="'.esc_attr(trim($wpjam_blogroll[1])).'">'.trim($wpjam_blogroll[1]).'</a>';
        }
    }
}
 
?>



<?php 
  //允许用户投稿时上传文件
// if ( current_user_can('admintest') && !current_user_can('upload_files') )
//    add_action('admin_init', 'allow_contributor_uploads');
 
//    function allow_contributor_uploads() {
//       $contributor = get_role('admintest');
//       $contributor->add_cap('upload_files');
// }

  //允许上传文件
  add_filter('upload_mimes', 'custom_upload_mimes');
   
  function custom_upload_mimes ( $existing_mimes=array() ) {
   
  // unset ($existing_mimes);//禁止上传任何文件
   
  $existing_mimes['jpg|jpeg|gif|png|bmp']='image/image';//允许用户上传jpg|jpeg|gif|png文件
  $existing_mimes['zip']='application/zip'; //允许用户上传zip压缩包
  $existing_mimes['pdf|doc|docx|xls|xlsx|ppt|pptx|rar|zip|flv|swf']='application/pdf'; //允许用户上传pdf|doc|docx|xls|xlsx|ppt|pptx|rar|zip|flv|swf文件
  //$existing_mimes['apk']='application/apk'; //允许用户上传apk包
   
  return $existing_mimes;
   
  }
?>

<?php 
  function the_slug() {
    $post_data = get_post($post->ID, ARRAY_A);
    $slug = $post_data['post_name'];
    return $slug; 
  }
function par_pagenavi($range = 9){
  global $paged, $wp_query;
  if ( !$max_page ) {$max_page = $wp_query->max_num_pages;}
  if($max_page > 1){if(!$paged){$paged = 1;}
  if($paged != 1){echo "<a href='" . get_pagenum_link(1) . "' class='extend' title='跳转到首页'> 返回首页 </a>";}
  previous_posts_link(' 上一页 ');
    if($max_page > $range){
    if($paged < $range){for($i = 1; $i <= ($range + 1); $i++){echo "<a href='" . get_pagenum_link($i) ."'";
    if($i==$paged)echo " class='current'";echo ">$i</a>";}}
    elseif($paged >= ($max_page - ceil(($range/2)))){
    for($i = $max_page - $range; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";
    if($i==$paged)echo " class='current'";echo ">$i</a>";}}
  elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
    for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){echo "<a href='" . get_pagenum_link($i) ."'";if($i==$paged) echo " class='current'";echo ">$i</a>";}}}
    else{for($i = 1; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";
    if($i==$paged)echo " class='current'";echo ">$i</a>";}}
  next_posts_link(' 下一页 ');
    if($paged != $max_page){echo "<a href='" . get_pagenum_link($max_page) . "' class='extend' title='跳转到最后一页'> 最后一页 </a>";}}
}

function get_category_root_id($cat)   
{   
$this_category = get_category($cat); // 取得当前分类   
while($this_category->category_parent) // 若当前分类有上级分类时，循环   
{   
$this_category = get_category($this_category->category_parent); // 将当前分类设为上级分类（往上爬）   
}   
return $this_category->term_id; // 返回根分类的id号   
}

//获取当前分类的名称
function get_article_category_name() {
 $category = get_the_category();
 return $category[0]->cat_name;
}

// 关闭页面评论功能
// function disable_page_comments( $posts ) {
//   if ( is_page()) {
//   $posts[0]->comment_status = 'disabled';
//   $posts[0]->ping_status = 'disabled';
// }
// return $posts;
// }
// add_filter( 'the_posts', 'disable_page_comments' );

/**
 * WordPress 文章标题链接到站外链接
 * http://www.wpdaxue.com/link-post-title-to-external-link.html
 */
function link_format_url($link, $post) {
     if (get_post_meta($post->ID, '站外链接', true)) {
          $link = get_post_meta($post->ID, '站外链接', true);
     }
     return $link;
}
add_filter('post_link', 'link_format_url', 10, 2);




//AJAX
function ajax_load(){
  $pagenum=4;
    if( isset($_GET['action']) && isset($_GET['cat']) && isset($_GET['page'])){
        if($_GET['action'] == 'ajax1'  ){
            $cat=$_GET['cat'];
            $page=$_GET['page'];
        $str='';
        $the_query = new WP_Query( array('cat'=> $cat,'posts_per_page'=>$pagenum,'paged'=>$page));
            if ( $the_query->have_posts()): while ( $the_query->have_posts() ) : $the_query->the_post(); 
            $link=get_the_permalink();
            $title=get_the_title(); 
      if(mb_strlen( $title,'utf-8')>15){
        $title=mb_substr($title,0,15,'utf-8');
        $title.='...';
      }
      $time=get_the_time('m-d-y');
            $str.=<<<endl
                <li>
                      <a href="{$link}" >{$title}</a>
                      <p class="ljh-date">{$time}</p>
                      <div class="clear"></div>
                </li>
endl;
           endwhile;
           endif; 
           wp_reset_postdata();
       header("Content-type: text/html; charset=utf-8"); 
           echo $str;
           exit;
        }
          elseif ($_GET['action'] == 'ajax2') {
          $cat=$_GET['cat'];
          $page=$_GET['page'];
          $str='';  
          $the_query = new WP_Query( array('cat'=> $cat,'posts_per_page'=>$pagenum,'paged'=>$page));
          if ( $the_query->have_posts()): while ( $the_query->have_posts() ) : $the_query->the_post(); 
          $link=get_the_permalink();
          $title=get_the_title(); 
          if(mb_strlen( $title,'utf-8')>25){
            $title=mb_substr($title,0,25,'utf-8');
            $title.='...';
          }
          $time=get_the_time('Y-m-d');
          $img=get_thumb_img(get_the_content());
            $str.=<<<endl
                    <li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-left">
                    <div class="am-u-sm-4 am-list-thumb">
                      <a href="{$link}">{$img}</a>
                    </div>
                    <div class=" am-u-sm-8 am-list-main">

                      <p>{$title}</p>
                      <div class="am-list-item-text">{$time}</div>
                    </div>
                  </li>
endl;
          endwhile;
          endif; 
          wp_reset_postdata();
          header("Content-type: text/html; charset=utf-8"); 
          echo $str;
          exit;
        }
    }
 
}
add_action('init', 'ajax_load');




 ?>
<?php add_theme_support( 'post-formats', array('aside','gallery','link','image','quote') );

?>
