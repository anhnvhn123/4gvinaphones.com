<?php  
	/* Template Name: Chuyen muc goi cuoc*/
?>
<?php get_header(); ?>
<?php  
	$list_service = json_decode(file_get_contents('http://10.10.1.3/webapi/get_3gvinaphone/'));
	include('mobile_detect.php');
	$detect = new Mobile_Detect();
	var_dump($detect->is('iOS'));
?>
<div class="container">
	<h3>GÓI MI</h3>
	<h4>Gói dịch vụ cơ bản</h4>
	<hr>
	<?php 
	foreach ($list_service as $key => $value) {
	?>
		<h3><?php echo $value->serviceCode; ?></h3>
		<table>
		<tbody>
			<tr>
				<td colspan="2"><b>MI10</b></td>
			</tr>
		<tr>
			<td style="width: 30%;">Giá cước</td>
			<td><?php echo $value->price; ?>đ/30 ngày</td>
		</tr>
		<tr>
			<td style="width: 30%;">Cú pháp</td>
			<td><strong><?php echo $value->serviceCode; ?></strong>&nbsp;gửi&nbsp;<strong>1544</strong></td>
		</tr>
		<tr>
			<td style="width: 30%;"><strong>Đăng ký</strong></td>
			<td>
			<?php  
				if($detect->is('iOS')){
			?>
				<a href="sms:1544&amp;body=DATA M10"><img class="alignnone size-full wp-image-130" src="http://3gvinaphonevn.com/wp-content/uploads/2017/06/btn-reg-ios.png" alt="Đăng ký trên iOS" width="135" height="40"></a>&nbsp;
			<?php
				}else{
			?>
				<a href="sms:1544?body=DATA M10"><img class="alignnone size-full wp-image-129" src="http://3gvinaphonevn.com/wp-content/uploads/2017/06/btn-reg-android.png" alt="Đăng ký trên Android &amp; thiết bị khác" width="135" height="40"></a>
			<?php
				}
			?>
			</td>
		</tr>
		</tbody>
		</table>
	<hr>
	<?php
	}
	?>
</div>
<?php get_footer(); ?>