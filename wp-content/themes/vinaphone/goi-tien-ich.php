<?php
/*Template Name: Gói cước tiện ích*/
?>
<?php get_header(); ?>

<?php
$loop = new WP_Query(
    array(
        'post_type' => 'goi_cuoc',
        'meta_key'  => 'loai_goi',
        'meta_value'	=> '3g',
        'order' => 'asc',
        'orderby' => 'ID',
    )
);
$id_tienich = array('591','592','638');
?>
<div class="container">
    <div class="menu-body under-header">
        <ol class="breadcrumb">
            <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo get_home_url() ?>" itemprop="url"><i class="fa fa-home"></i> <span itemprop="title"">Trang Chủ</span></a>
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
                <h1 class="post-title" style="color: #0060b1;font-size: 34px;"><?php echo get_the_title() ?></h1>
            </div>

            <div class="tag-relate">
                <?php
                foreach ($loop->posts as $post) {
                if (in_array($post->ID, $id_tienich)){

                $ghi_chu = get_field('ghi_chu', $post->ID);
                ?>
                <div id="<?php echo $id_nhom_goi[$i]; ?>" class="nhom-goi" style="margin-top: 40px">
                    <h2 class="nhom-goi-tite" title="#<?php echo $id_nhom_goi[$i]; ?>"
                        style="border-bottom: 5px solid #2b8fe2;font-size: 22px"><?php echo $post->post_title; ?></h2>

                    <p><b>Ghi chú :</b> <?php echo(($ghi_chu != '') ? $ghi_chu : 'Không có'); ?></p>

                    <div class="row">
                        <?php
                        $datas = get_field('goi_cuoc', $post->ID);
                        foreach ($datas as $key => $value) {
                        if ($key % 2 == 0){
                        ?>
                        <div class="row">
                            <?php
                            }
                            ?>
                            <div class="col-md-6 col-sm-6 category-list" style="border: 1px solid #0060b0;margin-right: 1%;margin-bottom:1%">
                                <h3 align="center"
                                    style="border:5px double #0060b0;background-color: #0060b0;color: #FFFFFF">
                                    <b><?php echo $value['ma_goi_cuoc']; ?></b></h3>
                                <table style="width: 100%;" class="table table-striped">
                                    <tbody>
                                    <tr>
                                        <td style="width: 30%;">Dung lượng</td>
                                        <td><?php echo $value['toc_do']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Giá cước</td>
                                        <td><?php echo product_price($value['gia_cuoc']); ?>
                                            đ/<?php echo $value['chu_ky']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Cú pháp</td>
                                        <td><strong style="color: red"><?php echo $value['cu_phap']; ?></strong>&nbsp;gửi&nbsp;<strong
                                                style="color: red"><?php echo $value['dau_so']; ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Cước phát sinh</td>
                                        <td><?php echo $value['cuoc_phat_sinh']; ?></td>
                                    </tr>
                                    <?php
                                    if (strlen($value['mo_ta']) > 0) {
                                        ?>
                                        <tr>
                                            <td>Chú thích</td>
                                            <td><?php echo $value['mo_ta']; ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="2" style="text-align: center;">
                                            <?php render_btn_dangky($value['cu_phap'], $value['dau_so']); ?>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                            if ($key % 2 != 0) {
                                echo '<div class="clear-fix"></div></div>';

                            }
                            }
                            ?>
                        </div>
                    </div>

                    <?php
                    }
                }
                    ?>
                </div>
                <div class="post-content thisispost">
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

<?php
wp_reset_postdata();
?>
<?php get_footer(); // This fxn gets the footer.php file and renders it ?>