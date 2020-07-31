<?php
/*Template Name: Các gói 3G mobi khác */
?>
<?php get_header('mobifone'); ?>
<?php
$loop = new WP_Query(
    array(
        'post_type' => 'goi_cuoc',
        'meta_key'  => 'loai_goi',
        'meta_value'	=> '3g'
    )
);
$thutu=array('592','591');
$id_nhom_goi=array('zing','fb');
?>

<div class="container entry-content">
    <h1><?php echo get_the_title(); ?></h1>
    <?php $datas = get_field('goi_cuoc'); ?>
    <?php
        foreach ($loop->posts as $post) {

            $provider = get_field('nha_mang',$post->ID);
            if ($provider =='mobifone' && in_array($post->ID, $thutu)){
                ?>
                <div class="nhom-goi">
                    <h2 class="nhom-goi-tite" title="<?php echo $post->post_title; ?>"><?php echo $post->post_title; ?></h2>
                    <?php
                    $datas = get_field('goi_cuoc', $post->ID);
                    foreach ($datas as $key => $value) {

                        ?>
                        <div  class="item">
                            <h3><b><?php echo $value['ma_goi_cuoc']; ?></b></h3>
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <td style="width: 30%;">Dung lượng</td>
                                    <td><?php echo $value['toc_do']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 30%;">Giá cước</td>
                                    <td><?php echo product_price($value['gia_cuoc']); ?>đ/<?php echo $value['chu_ky']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 30%;">Cú pháp</td>
                                    <td><strong style="color: red"><?php echo $value['cu_phap']; ?></strong>&nbsp;gửi&nbsp;<strong style="color: red"><?php echo $value['dau_so']; ?></strong></td>
                                </tr>
                                <tr>
                                    <td style="width: 30%;">Cước phát sinh</td>
                                    <td><?php echo $value['cuoc_phat_sinh']; ?></td>
                                </tr>
                                <?php
                                if(strlen($value['mo_ta']) > 0){
                                    ?>
                                    <tr>
                                        <td>Chú thích</td>
                                        <td><?php echo $value['mo_ta']; ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                                <tr>
                                    <td colspan="2">
                                        <?php render_btn_dangky_mobi($value['cu_phap'], $value['dau_so']); ?>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <?php
                        if($key % 2 != 0){
                            echo '<div class="clear-fix"></div>';
                        }
                    }
                    ?>
                </div>
            <?php
            }
        }

    ?>
    <div class="entry-content">
        <?php echo get_the_content(); ?>
    </div>

</div>
<?php get_footer('mobifone'); ?>
