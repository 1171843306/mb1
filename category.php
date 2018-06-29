<?php get_header();?>  

<!--主体-->
<div class="container">
<div class="content content-ny">
  <div class="content-ny-box">
  <?php get_sidebar(); ?>

  <div class="ny-right">
    <div class="ny-right-title"> 当前位置：<?php wheatv_breadcrumbs(); ?></div>
    <div class="ny-right-content news-list02">
      <ul>
      <?php   query_posts(array("category__in" => array(get_query_var("cat")), "post__in" => get_option("sticky_posts")));
                                while(have_posts()) : the_post(); ?>

        <li><a href="<?php the_permalink(); ?>" title="<?php the_title();?>" target="#target"><?php echo wp_trim_words( get_the_title(), 20 );?></a><span><?php echo the_time('Y-m-d');?></span></li>
        <?php endwhile;wp_reset_query();?>

  <?php while(have_posts()) : the_post(); ?><?php if(!is_sticky()){?>
                      
                      <li><a href="<?php the_permalink();?>"><?php the_title();?></a><span>[<?php the_time('Y-m-d') ?>]</span></li>

        <?php } endwhile;?>
      </ul>
      <div class="pagination">
        <center><?php par_pagenavi(9); ?></center>
      </div>
      <div class="clear"> </div>

    
      <div class="paging right"><div class="manu"></div></div>
   </div> 
  
  
  </div>
</div>
</div>
</div>




<?php get_footer(); ?>
