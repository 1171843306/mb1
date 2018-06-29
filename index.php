<?php get_header();?>  


<!--主体-->
<div class="container">
<div class="content">
    <div class="content-left">
        <div class="link1">
            <div class="area-title">
<?php query_posts(array('category_name'=>'kslj','orderby'=>date,'order'=>DSC,'posts_per_page'=>5)); ?>
                <div class="name yh"><?php single_cat_title(); ?></div>
            </div>
            <div class="link1-content yh">
                <ul><?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> 
                    <li><?php thumb_img($post->post_content);?><a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><?php echo wp_trim_words( get_the_title(), 4 );?></a></li>
                     <?php endwhile; ?>
                      <!-- post navigation -->
                    <?php else: ?>
                      <h3>找不到文章</h3>
                    <?php endif; ?>
                    <?php wp_reset_query() ?>
                </ul>
            </div>
        </div>
        <div class="area3">
            <div class="area-title">
            <?php query_posts(array('category_name'=>'zysj','orderby'=>date,'order'=>DSC,'posts_per_page'=>4)); ?>
                <div class="name yh"><?php single_cat_title(); ?></div>
                <div class="more more3"><a href="">更多&gt;&gt;</a></div>
            </div>
            <div class="area3-content">
                <ul><?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <li><span style="color:#d0332e;padding-right:10px; font-size: 12px;">&gt;&gt;</span><a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><?php echo wp_trim_words( get_the_title(), 10 );?></a></li>
                      <?php endwhile; ?>
                      <!-- post navigation -->
                    <?php else: ?>
                      <h3>找不到文章</h3>
                    <?php endif; ?>
                    <?php wp_reset_query() ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="content-right">
        <div class="area1">
            <div class="area-title1">
             <?php query_posts(array('category_name'=>'kcjj','orderby'=>date,'order'=>DSC,'posts_per_page'=>1)); ?>
                <div class="name yh"><?php single_cat_title(); ?></div>
                <div class="more"><a href="http://web.fosu.edu.cn/test1/2017/03/25/87/">更多&gt;&gt;</a></div>
            </div>
            <div class="area1-content">
             <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <p><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 370,"..."); ?></p>
                <?php endwhile; ?>
                      <!-- post navigation -->
                    <?php else: ?>
                      <h3>找不到文章</h3>
                    <?php endif; ?>
                    <?php wp_reset_query() ?>
            </div>
        </div>
        <div class="area2">
            <div class="area-title-2">
            <?php query_posts(array('category_name'=>'kcdt','orderby'=>date,'order'=>DSC,'posts_per_page'=>5)); ?>
                <div class="name yh name2"><?php single_cat_title(); ?></div>
                <div class="more"><a href="http://localhost/wordpress/?cat=10">更多&gt;&gt;</a></div>
            </div>
            <div class="area2-content">
                <ul>
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <li><span style="color:#d0332e;padding-right:10px; font-size: 12px;">&gt;&gt;</span><a href="<?php the_permalink(); ?>" title="<?php the_title();?>" target="#target"><?php echo wp_trim_words( get_the_title(), 20 );?></a>
                    </li>
                 <?php endwhile; ?>
                      <!-- post navigation -->
                    <?php else: ?>
                      <h3>找不到文章</h3>
                    <?php endif; ?>
                    <?php wp_reset_query() ?>
                </ul>
            </div>
        </div>
        <div class="area4">
            <div class="area-title2">
             <?php query_posts(array('category_name'=>'zjjs','orderby'=>date,'order'=>DSC,'posts_per_page'=>2)); ?>
                <div class="name yh"><?php single_cat_title(); ?></div>
                <div class="more"><a href="">更多&gt;&gt;</a></div>
            </div>
            <div class="area4-content">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <dl>
                    <dt><?php thumb_img($post->post_content);?></dt>
                    <dd>
                        <p class="title"><a href="<?php the_permalink(); ?>" target="#target"><?php the_title_attribute(); ?></a></p>
                        <p class="info"><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 110,"..."); ?></p>
                    </dd>
                </dl>
                 <?php endwhile; ?>
                      <!-- post navigation -->
                    <?php else: ?>
                      <h3>找不到文章</h3>
                    <?php endif; ?>
                    <?php wp_reset_query() ?>
            </div>
        </div>
        <div class="area5">
            <div class="area-title2">
             <?php query_posts(array('category_name'=>'jxdg','orderby'=>date,'order'=>DSC,'posts_per_page'=>7)); ?>
                <div class="name yh"><?php single_cat_title(); ?></div>
                <div class="more"><a href="http://localhost/wordpress/?cat=21">更多&gt;&gt;</a></div>
            </div>
            <div class="area5-content">
                <ul><?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> 
                    <li>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title();?>" target="#target"><?php echo wp_trim_words( get_the_title(), 20 );?></a>
                    </li>
                     <?php endwhile; ?>
                      <!-- post navigation -->
                    <?php else: ?>
                      <h3>找不到文章</h3>
                    <?php endif; ?>
                    <?php wp_reset_query() ?>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
<?php get_footer(); ?>



<!-- 
使用请注来源谢谢 >_<
Theme Name: fjl模板
Theme URI: www.yzx-fjl.top/wordpress.com
更多资源：https://github.com/1171843306
qq:1171843306
Weichat:YZX_FJL
 -->