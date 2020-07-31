<?php wpb_set_post_views(get_the_ID()); ?>
<?php get_header(); ?>
<?php

while (have_posts()) : the_post(); ?>
    <div class="container">
    <div class="menu-body under-header">
        <ol class="breadcrumb">
            <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo get_home_url() ?>" itemprop="url"><i class="fa fa-home"></i> <span itemprop="title"">Trang Chủ</span></a>
            </li>
            <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo get_home_url() ?>/<?php echo get_the_category()[0]->slug ?>" itemprop="url"><span itemprop="title"><?php echo get_the_category()[0]->name ?></span></a>
            </li>
            <li class="hidden-xs" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><?php echo get_the_title() ?></span>
            </li>
        </ol>
    </div>
    <div class="wrapper">
    <div class="post-content">
    <div class="row">
    <div class="col-md-9">
        <article class="post">
            <div class="post-head">
                <h1 class="post-title"><?php echo get_the_title() ?></h1>
                <div class="meta">
                    <div class="info"> <i class="fa fa-user"></i> <?php echo get_the_author() ?>  -  <i class="fa fa-calendar"></i><?php echo get_the_date('d/m/Y');  ?></div>
                </div>
            </div>
            <div class="post-content thisispost">
                <a class="photo"  title="<?= the_title(); ?>">
                    <img class="home_thumb img-scale" style="max-width: 600px" src="<?= the_post_thumbnail_url('home-thumb') ?>" alt="<?= the_title(); ?>" >
                </a>

                <?php echo get_the_content(); ?>
            </div>
        </article>
<!--        <div class="post-footer">-->
<!--            <div class="comment_fb">-->
<!--                <h5><i class="fa fa-comments" aria-hidden="true"></i> Bình luận</h5>-->
<!--                <div class="fb-comments fb_iframe_widget_loader fb_iframe_widget" data-href="--><?php //echo get_the_permalink() ?><!--" data-order-by="reverse_time" data-width="920" data-numposts="5"></div>-->
<!--            </div>-->
<!--        </div>-->

        <div class="post-footer">
            <div class="comment_fb">
                <h5><i class="fa fa-comments" aria-hidden="true"></i> Bình luận</h5>
                <div class="fb-comments fb_iframe_widget_loader fb_iframe_widget" data-href="<?php echo 'http://4gvinaphones.com'.$_SERVER['REQUEST_URI']; ?>" data-order-by="reverse_time" data-width="920" data-numposts="5"></div>
            </div>
        </div>
    </div>

<?php endwhile;

wp_reset_postdata();
?>
<?php get_footer(); // This fxn gets the footer.php file and renders it ?>

<style>
    /*@media only screen and (max-width: 425px) {*/
        .post .post-content img{
            max-width: 100% !important;
            margin-bottom: 10px;
        }
        .post .post-content{
            color: #6b6464;
        }

    /*}*/
</style>
