<!DOCTYPE html>
<html lang="en"><head>
	<title> Example </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">  
 	<script type="text/javascript" src="<?php echo base_url('giaodien'); ?>/1.js"></script>
	<link rel="stylesheet" href="<?php echo base_url('giaodien'); ?>/vendor/bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url('giaodien'); ?>/vendor/font-awesome.css">
 	<link rel="stylesheet" href="<?php echo base_url('giaodien'); ?>/1.css">
  <script type="text/javascript" src="<?php echo base_url('giaodien'); ?>/vendor/jquery-3.2.1.slim.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url('giaodien'); ?>/vendor/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
<form action="<?php echo base_url('Cart/update'); ?>" method='post'>
		<div class="row">

			<table class="table table-inverse">
				<thead>
					<tr>
						<th>STT</th>
						<th>Tên Sản Phẩm</th>
						<th>Giá</th>
						<th>Số Lượng</th>
						<th>Thành Tiền</th>
						<th>Xóa Sản Phẩm</th>
					</tr>
				</thead>
				<tbody>
					<?php if(!empty($cart)){
						foreach ($cart as $row) {
					?>	
					<tr>
						<td><?= $row['id'] ?></td>
						<td><?= $row['name'] ?></td>
						<td><?= number_format($row['price']) ?></td>
						<td><input type="text" name="SoLuong[<?= $row['id'] ?>]" value="<?= $row['qty'] ?>" width="100px"></td>
						<td><?= number_format($row['price'] * $row['qty'])  ?>đ</td>
						<td><a href="<?php echo base_url(); ?>Cart/deletetocart/<?= $row['id'] ?>" class="btn btn-danger">Xóa</a></td>
					</tr>
					<?php	
				}
			}
			?>
				</tbody>
			</table>
		</div>
		<div class="row">
			<h3>Tổng tiền: <span style="color: red"><?= number_format($this->cart->total()); ?>đ</span></h3>
			<button type="submit" class="btn btn-primary update">Update</button>
			<a href="<?php echo base_url(); ?>Cart/deleteallcart" class="btn btn-primary delete">Xóa</a>
			<a href="#" class="btn btn-primary thanhtoan">Thanh Toán</a>
		</div>
</form>
	</div>
	<hr>
	<div class="container">
		<div class="row text-center">
			<?php if(!empty($sanpham)){
				foreach ($sanpham as $row) {
			?>	
			<div class="col-sm-3">
				<div class="card">
					<img class="card-img-top" src="http://placehold.it/200x200" alt="Card image cap">
					<div class="card-block">
						<h4 class="card-title"><?= $row['Tensp'] ?></h4>
						<p class="card-text"><?= $row['Dongia'] ?></p>
						<p class="card-text"><?= $row['Loai'] ?></p>
						<a href="<?php echo base_url(); ?>Cart/<?= $row['Masp'] ?>" class="btn btn-primary">ADD to Cart</a>
					</div>
				</div>
			</div>

			<?php	
				}
			}
			?>
			
		</div>
		<hr>
		<div class="row">
					<nav class="Page navigation example">
						<ul class="pagination">
							<li>
								<a href="<?php echo Base_url('Cart/trang/') ?>" aria-label="Previous">
									<span aria-hidden="true">&laquo;</span>
									<span class="sr-only">Previous</span>
								</a>
							</li>
							<?php
							if(!empty($total)){
								$i = 0;
								for($i = 1; $i<= $total; $i++){
								 ?>
									<li class="page-item"><a class="page-link" href="<?php echo Base_url('Cart/trang/').$i ?>"><?= $i ?></a></li>
							<?php
								}
							}
							 ?>
							
							<li>
								<a href="#" aria-label="Previous">
									<span aria-hidden="true">&raquo;</span>
									<span class="sr-only">Previous</span>
								</a>
							</li>
						</ul>
					</nav>
		</div>
	</div>
</body>
</html>