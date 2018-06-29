<?php get_header();?>  

<!--主体-->
<div class="container">
<div class="content">

   <?php get_sidebar(); ?>
    <!--菜单--> 
    <!--头部-->
    <div class="ny-right">
      <div class="ny-right-title">当前位置：<?php wheatv_breadcrumbs(); ?></div>
      <div class="ny-right-content">
        <h1 class="right-main-title"><?php the_title(); ?></h1>
        <div class="right-sub-title"><span><?php echo the_time('Y-m-d');?></span><span><script type="text/javascript" src="./images/submit_ajax.ashx"></script>2人浏览</span></div>
       
 <?php if (have_posts()) : ?>                    
      <?php while (have_posts()) : the_post(); ?>

      <div class="right-main-show">
        <?php the_content() ?> 
      </div>

      <?php endwhile; ?>
      <?php else : ?>
      <?php endif; ?>
       
        <div class="clear"> </div>
        <div class="next-page">
          <ul>
            <li>上一篇：</span><a href="<?php the_permalink(); ?>"><?php previous_post_link('%link'); ?></a></li>
            <li><span class="blue">下一篇：</span><a href="<?php the_permalink(); ?>"><?php next_post_link('%link'); ?></a></li>
          </ul>
        </div>
        <!--评论部分--> 
      </div>
     </div>
</div>
</div>
<div class="clear"></div>

<?php get_footer(); ?>
