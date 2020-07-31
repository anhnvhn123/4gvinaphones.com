<?php
get_header();

$category = get_the_category();
$paged = 1; //hoặc 0
if (get_query_var('paged')) {
    $paged = get_query_var('paged');
} elseif (get_query_var('page')) {
    $paged = get_query_var('page');
}
$i = 0; ?>
<div class="container">
    <div class="menu-body under-header">
        <ol class="breadcrumb">
            <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo get_home_url() ?>"
                                                                              itemprop="url"><i class="fa fa-home"></i>
                    <span itemprop="title"">Trang Chủ</span></a>
            </li>
            <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a
                        href="<?php echo get_home_url() ?>/<?php echo get_the_category()[0]->slug; ?>"
                        itemprop="url"><span itemprop="title"><?php echo $category[0]->name; ?></span></a>
            </li>
        </ol>
    </div>
    <div class="wrapper">
        <div class="row">
            <div class="col-md-9">
                <div class="category">
                    <div class="category-title">
                        <h2><?php echo $category[0]->name; ?></h2>
                        <div class="category-des">
                            <?php echo $category[0]->description; ?>
                        </div>
                    </div>
                    <div class="category-content">
                        <div class="row item_group">

                            <?php
                            $data = new WP_Query(
                                array(
//                            'numberposts' => -1,
                                    'posts_per_page' => 10,
                                    'paged' => $paged,
                                    'category_name'=>get_the_category()[0]->slug
                                )
                            );

                            while ($data->have_posts()) : $data->the_post(); ?>
                                <div class="news-item news-item-list">
                                    <div class="media">
                                        <div class="pull-left media-left">
                                            <a class="thumbnail" href="<?php the_permalink(); ?>"><img width="150"
                                                                                                       height="150"
                                                                                                       style="width: 190px;min-height: 150px"
                                                                                                       src="<?= the_post_thumbnail_url('home-thumb') ?>"
                                                                                                       class="media-object wp-post-image"
                                                                                                       alt="<?php the_title(); ?>"/>
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading news-item-title"><a
                                                        href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                            <div class="box-meta"><i class="fa fa-user"></i> Post
                                                by: <?php echo get_the_author(); ?> <i class="fa fa-calendar"></i>
                                                at <?php echo get_the_date('d-m-Y'); ?></div>
                                            <div class="news-item-desc">
                                                <p class="description"><?php echo get_the_excerpt(); ?></p>
                                            </div>
                                        </div>
                                        <a class="btn-readmore hidden-sm hidden-xs" href="<?php the_permalink(); ?>">Xem
                                            thêm <i
                                                    class="fa fa-chevron-right"></i></a>
                                    </div>
                                </div>
                            <?php endwhile;
                            $big = 999999999;
                            ?>
                            <?php
                            wp_reset_postdata();
                            ?>
                            <div class="clear-fix"></div>
                            <div class="pagination">
                                <?php
                                echo paginate_links(array(
                                    'base' => add_query_arg('page', '%#%'),
                                    'format' => '',
                                    'current' => $paged,
                                    'total' => $data->max_num_pages,
                                    'prev_text' => __('<<'),
                                    'next_text' => __('>>')
                                ));
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php get_footer(); ?>
            <style>
                .pagination {
                    display: inline-block;
                }

                .pagination a {
                    color: black;
                    float: left;
                    padding: 8px 16px;
                    text-decoration: none;

                    border-radius: 5px;

                }

                .pagination .current {
                    background-color: #4CAF50;
                    color: white;
                    border-radius: 5px;
                }

                .pagination a:hover:not(.active) {
                    background-color: #ddd;
                    border-radius: 5px;
                }

                .pagination span {
                    color: black;
                    float: left;
                    padding: 8px 16px;
                    text-decoration: none;
                }
                @media only screen and (max-width: 425px) {
                    .category-content .news-item .media .news-item-title a{
                        font-size: 14px;
                    }
                }
                @media only screen and (max-width: 325px) {
                    .media-body{
                        width: 100% !important;
                        float: left;
                    }
                }
            </style>
