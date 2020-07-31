
<div class="col-md-3">
    <div class="kmhot">
        <div id="secondary" class="widget-area">
            <aside id="st_blog_posts_widget-2" class="widget widget_st_blog_posts_widget">
                <h3 class="widget-title" style="color: white;background-color: #e43636">KHUYẾN MÃI LỚN</h3>
                <div class="latest-postspopular">
                    <?php $args = array(
                        'posts_per_page'   => 5,
                        'offset'           => 0,
                        'orderby'          => 'date',
                        'order'            => 'DESC',
                        'post_type'        => 'post',
                        'post_status'      => 'publish',
                        'category'	=> 12
                    );
                    $posts_array = get_posts( $args );
                    ?>
                    <?php
                    foreach ( $posts_array as $key=>$post ) : setup_postdata( $post ); ?>
                        <div class="media-widget">
                            <div class="media-body">
                                <div class="entry-title"><a href="<?php echo get_the_permalink(); ?>"><?php the_title() ?></a>
                                </div>
                                <div class="time"><i class="fa fa-calendar"></i> <?php echo get_the_date('d/m/Y') ?></div>

                            </div>
                            <div class="clearfix"></div>
                        </div>
                    <?php endforeach;
                    wp_reset_postdata();
                    ?>
                </div>
            </aside>
        </div>
    </div>
<!--    <div class="under">-->
<!--        <div id="secondary" class="widget-area">-->
<!---->
<!--                <a href="--><?php //echo get_permalink(); ?><!--"><img src="--><?php //echo get_template_directory_uri()?><!--/vinaphone_files/sidebar1.jpg" class="img-responsive wp-post-image" alt="" srcset="" />-->
<!--                                </a>-->
<!--        </div>-->
<!--    </div>-->

    <div class="under">
        <div id="secondary" class="widget-area">
            <aside id="st_blog_posts_widget-3" class="widget widget_st_blog_posts_widget">
                <h3 class="widget-title">XEM NHIỀU NHẤT</h3>
                <div class="latest-postsmostsee">
                    <?php
                    $xem = get_posts(array(
                        'post_type' => 'post',
                        'post_status'   => 'publish',
                        'posts_per_page'   => 5,
                        'offset'           => 0,
                        'orderby'      => 'meta_value_num',
                        'order'        => 'DESC',
                        'meta_key'     => 'wpb_post_views_count',

                    ));
                    ?>
                    <?php
                    foreach ( $xem as $key=>$post ) : setup_postdata( $post ); ?>
                        <div class="media-widget">
                            <div class="media-left">
                                <a href="<?php echo get_permalink(); ?>"><img width="60" height="60" src="<?= the_post_thumbnail_url('home-thumb');?>" class="img-responsive wp-post-image" alt="" srcset="" />
                                </a>
                            </div>
                            <div class="media-body">
                                <div class="entry-title"><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title();?></a>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    <?php endforeach;
                    wp_reset_postdata();
                    ?>
                </div>
            </aside>
        </div>
    </div>
    <div class="dk3g">
        <div id="secondary" class="widget-area">
            <aside id="text-2" class="widget widget_text">
                <div class="textwidget">
                    </a>
                    <br/>
                    <br/>
                    <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fdangky3g4gcom%2F&tabs=timeline&width=300&height=300&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="310" height="300" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                </div>
            </aside>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
<footer id="footer">
    <div class="container">
        <div class=" col-md-4 col-sm-6" >
            <div id="wgContact">
                <a href="<?php echo get_home_url() ?>" >
                    <img src="<?php echo get_template_directory_uri() ?>/assets/images/logo-white.png" alt="Đăng ký Gói cước 3G Vinaphone" class="img-responsive">
                </a>

            </div>
        </div>
        <div class=" col-md-offset-2 col-md-4 col-sm-6" >
            <div id="wgContact"align="center">
                <ul class="contact_footer" >
                    <li> Trang cung cấp thông tin và dịch vụ của Vinaphone</li>
                    <br>
                    <li> Hỗ trợ dịch vụ 3G và các thông tin khác
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<?php include('button-footer.php'); ?>
<style>
    @media (min-width: 768px) {
        .button-footer {
            position: fixed;
            bottom: 50px;
            right: 0px;
            width: 100%;
        }

        .button-footer a img {
            display: inline-block;
            height: 40px;
            width: auto;
            padding-left: 10px;
        }
    }
</style>
<script src="<?php echo get_template_directory_uri(); ?>/vinaphone_files/jquery-1.10.2.min.js.tải xuống"></script>

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/vinaphone_files/es-widget.js.tải xuống"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/vinaphone_files/es-widget-page.js.tải xuống"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/vinaphone_files/wp-embed.min.js.tải xuống"></script>
<!--<script src="--><?php //echo get_template_directory_uri(); ?><!--/vinaphone_files/js.js"></script>-->
<script src="<?php echo get_template_directory_uri(); ?>/vinaphone_files/bootstrap.min.js.tải xuống"></script>
<script>
    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=331160850612796";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

</script>
<script>

    $(function () {
        $('.search-field')
            .addClass('form-control')
            .wrap("<div class='form-group'></div>");
        $('.search-submit')
            .addClass('btn btn-primary btn-block');
        $('.post-content')
            .find('table')
            .addClass('table table-bordered table-striped table-condensed')
            .wrap("<div class='table-responsive'></div>");
        $('.entry')
            .find('table')
            .addClass('table table-bordered table-striped table-condensed')
            .wrap("<div class='table-responsive'></div>");
        $('#es_txt_email')
            .addClass('form-control')
            .wrap("<div class='form-group'></div>");
        $('.es_textbox_button')
            .addClass('btn btn-primary btn-block');
    });

    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/5b582d44df040c3e9e0bf02c/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();


</script>
<script src="<?php echo get_template_directory_uri(); ?>/vinaphone_files/platform.js.tải xuống" async="" defer="" gapi_processed="true"></script>
<script src="<?php echo get_template_directory_uri(); ?>/vinaphone_files/watch.js.tải xuống" type="text/javascript"></script>


</body>

</html>
