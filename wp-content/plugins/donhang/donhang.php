<?php
/*
 Plugin Name: donhang
 */
?>
<?php  
	add_action( 'admin_menu', 'donhang' );
	function donhang(){
	    add_menu_page( 'don-hang', 'Đơn hàng', 'edit_others_posts', 'don-hang',  'show_donhang', 'dashicons-welcome-widgets-menus', 28 );
		// remove_menu_page('edit.php?post_type=page');
		remove_menu_page('upload.php');
		remove_menu_page('edit-comments.php');
		remove_menu_page('tools.php');
		remove_menu_page('index.php');
		remove_menu_page('profile.php');
	}
	function show_donhang() {
		global $wpdb;
		$ds_donhang = $wpdb->get_results("SELECT * FROM donhang WHERE status = 1 ORDER BY create_date DESC", OBJECT);
	?>
	<h1>Danh sách đơn hàng</h1>
	<div class="screen-width gio-hang-main">
		<table class="table" border="1" cellspacing="0" cellpadding="5">
			<tr>
				<th>ID</th>
				<th>Ngày tạo</th>
				<th>Họ và tên</th>
				<th>Số điện thoại</th>
				<th>Email</th>
				<th>Địa chỉ</th>
				<th>Tổng tiền</th>
				<th>Sản phẩm</th>
			</tr>
		<?php  
			foreach ($ds_donhang as $key => $value) {
				$sanpham = json_decode($value->sanpham);
		?>
			<tr>
				<td><?php echo $value->id; ?></td>
				<td><?php echo date('H:i d/m/Y', strtotime($value->create_date)); ?></td>
				<td><?php echo $value->fullname; ?></td>
				<td><b><?php echo $value->phone; ?></b></td>
				<td><?php echo $value->email; ?></td>
				<td><?php echo $value->address; ?></td>
				<td><b><?php echo $value->tongtien; ?></b></td>
				<td>
					<table border="1" cellspacing="0" cellpadding="5" style="width: 250px;">
				<?php
					foreach ($sanpham as $sp) {
						$post = get_post($sp->pid);
						// var_dump($post);
				?>
					<tr>
						<td>
							<a href="<?php echo get_permalink($post->ID); ?>" target="_blank"><?php echo $post->post_name; ?></a>
						</td>
						<td><?php echo $sp->soluong; ?></td>
					</tr>
				<?php
					}
				?>
					</table>
				</td>
			</tr>
		<?php
			}
		?>
		</table>
	</div>

	<?php
	}
?>