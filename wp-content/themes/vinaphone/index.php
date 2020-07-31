<?php
$i=0;

$goi_big = array();
    $goi =  get_field('goi_cuoc', 757);
    foreach ($goi as $key => $value) {
        if($i <4){
            $goi = $value;
            $i++;
            array_push($goi_big, $goi);
        }
    }
$dung_luong_goi_big = array('4,8 GB','7 GB','22 GB','36 GB');
?>
<?php
$i=0;

$goi_max = array();
$goi =  get_field('goi_cuoc', 744);
foreach ($goi as $key => $value) {
    if($i <4){
        $goi = $value;
        $i++;
        array_push($goi_max, $goi);
    }
}
$dung_luong_goi_max = array('3.8 GB','5.8 GB','15 GB','30 GB');

?>
<?php get_header() ?>
<div class="container">
<div class="menu-body under-header">
    <ol class="breadcrumb">
        <li><a href="<?php echo get_home_url() ?>"><i class="fa fa-home"></i> Home</a>
        </li>
    </ol>
</div>
<div class="wrapper">
<div class="row">
<div class="col-md-9 col-sm-6 content-slide">
<section class="content-wrapper">
    <div class="row mobi">
        <div class="xanhxanh"></div>
    </div>
    <div class="home-slide">
        <div id="home_slide" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <?php $sliderlist = get_field('slide_list',3594); ?>
                <?php foreach ($sliderlist as $key=>$item): ?>
                    <div class="item <?php echo (($key == 0)? 'active':''); ?>">

                        <a href="<?php echo get_home_url()."/".$item["url_link"]; ?>"><img src="<?php echo $item["image"]; ?>" alt="" class="img-responsive">
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="row mobi">
        <div class="do"></div>
        <div class="cam"></div>
        <div class="xanh"></div>
    </div>
</section>
    <section class="3g-package">
        <div class="package-title">
            <h2>Gói BIG Vinaphone</h2>
            <div class="form-group row">
                <?php
                foreach ($goi_big as $key => $value) {
                    ?>
                    <div class="col-md-3">
                        <div class="category-list">
                            <div class="category-content"> <h3 class="category-title">Trải nghiệm gói <?php echo $value['ma_goi_cuoc']; ?></h3>
                                <div class="category-desc">
                                    <ul style="text-align: justify;">
                                        <li><strong>Giá cước</strong>: <?php echo product_price($value['gia_cuoc']); ?>đ</li>
                                    </ul>
                                    <ul style="text-align: justify;">
                                        <li><strong>Data tốc độ cao</strong>: <?php echo $dung_luong_goi_big[$key];?></li>
                                    </ul>
                                    <ul style="text-align: justify;">
                                        <li><strong>Soạn</strong>:&nbsp;<?php echo $value['cu_phap']; ?><strong> Gửi</strong> <?php echo $value['dau_so']; ?></li>
                                    </ul>
                                    <ul style="text-align: justify;">
                                        <li><strong>Thời gian&nbsp;sử dụng</strong>: <?php echo $value['chu_ky']; ?></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="category-button text-center">
                                <?php render_btn_dangky($value['cu_phap'], $value['dau_so']); ?>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                <?php
                }
                ?>

            </div>
        </div>
    </section>
    <section class="3g-package">
        <div class="package-title">
            <h2>Gói MAX Vinaphone</h2>
            <div class="form-group row">
                <?php
                foreach ($goi_max as $key => $value) {
                    ?>
                    <div class="col-md-3">
                        <div class="category-list">
                            <div class="category-content"> <h3 class="category-title" style="background-color: #e43636;">Trải nghiệm gói <?php echo $value['ma_goi_cuoc']; ?></h3>
                                <div class="category-desc">
                                    <ul style="text-align: justify;">
                                        <li><strong>Giá cước</strong>: <?php echo product_price($value['gia_cuoc']); ?>đ</li>
                                    </ul>
                                    <ul style="text-align: justify;">
                                        <li><strong>Data tốc độ cao</strong>: <?php echo $dung_luong_goi_max[$key];?></li>
                                    </ul>
                                    <ul style="text-align: justify;">
                                        <li><strong>Soạn</strong>:&nbsp;<?php echo $value['cu_phap']; ?><strong> Gửi</strong> <?php echo $value['dau_so']; ?></li>
                                    </ul>
                                    <ul style="text-align: justify;">
                                        <li><strong>Thời gian&nbsp;sử dụng</strong>: <?php echo $value['chu_ky']; ?></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="category-button text-center">
                                <?php render_btn_dangky($value['cu_phap'], $value['dau_so']); ?>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                <?php
                }
                ?>

            </div>
        </div>
    </section>
<div class="section news">
<div class="row">
<div class="col-sm-6">
    <div id="exTab3">
        <ul class="nav nav-pills">
            <li class="active"> <a href="<?php get_home_url()?>/thu-thuat/" data-toggle="tab" aria-expanded="true">Thủ thuật</a>
            </li>
        </ul>
        <div class="tab-content clearfix">
            <div class="tab-pane active" id="1b">
                <ul>
                    <?php $args = array(
                        'posts_per_page'   => 5,
                        'offset'           => 0,
                        'orderby'          => 'date',
                        'order'            => 'DESC',
                        'post_type'        => 'post',
                        'post_status'      => 'publish',
                        'category'	=> 11
                    );
                    $posts_array = get_posts( $args );
                    ?>
                    <?php
                    foreach ( $posts_array as $post ) : setup_postdata( $post ); ?>
                        <li>
                            <div class="media news_item">
                                <div class="media-left">
                                    <a href="<?php the_permalink(); ?>"> <img width="150" height="150" src="<?php the_post_thumbnail_url('home-thumb') ?>" class="media-object wp-post-image" alt=""> </a>
                                </div>
                                <div class="media-body"> <a href="<?php the_permalink(); ?>"><h4 class="media-heading"><?php the_title(); ?></h4></a>
                                </div>
                            </div>
                        </li>
                    <?php endforeach;
                    wp_reset_postdata();
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-6">
    <div id="exTab">
        <ul class="nav nav-pills">
            <li class="active"> <a href="<?php get_home_url()?>/khuyen-mai/" data-toggle="tab" aria-expanded="true">Khuyến mãi</a>
            </li>
        </ul>
        <div class="tab-content clearfix">
            <div class="tab-pane active" id="1c">
                <ul>
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
                    foreach ( $posts_array as $post ) : setup_postdata( $post ); ?>
                        <li>
                            <div class="media news_item">
                                <div class="media-left">
                                    <a href="<?php the_permalink(); ?>"> <img width="150" height="150" src="<?php the_post_thumbnail_url('home-thumb') ?>" class="media-object wp-post-image" alt=""> </a>
                                </div>
                                <div class="media-body"> <a href="<?php the_permalink(); ?>"><h4 class="media-heading"><?php the_title(); ?></h4></a>
                                </div>
                            </div>
                        </li>
                    <?php endforeach;
                    wp_reset_postdata();
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
<?php get_footer() ?>