<!DOCTYPE html>
<html lang="en"><head>
	<title> Example </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">  
 	<!-- <script type="text/javascript" src="<?php echo base_url('giaodien'); ?>/1.js"></script> -->
	<link rel="stylesheet" href="<?php echo base_url('giaodien'); ?>/vendor/bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url('giaodien'); ?>/vendor/font-awesome.css">
 	<link rel="stylesheet" href="<?php echo base_url('giaodien'); ?>/1.css">
  <!-- <script type="text/javascript" src="<?php echo base_url('giaodien'); ?>/vendor/jquery-3.2.1.slim.min.js"></script> -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url('giaodien'); ?>/vendor/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<table class="table table-inverse" id="cart">
				
			</table>
		</div>
		<div class="row">
			
			
			
			
		</div>
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
						<p class="card-text"><?= number_format($row['Dongia']) ?>đ</p>
						<p class="card-text"><?= $row['Loai'] ?></p>
						<button type="button" data-href="<?= $row['Masp'] ?>" class="btn btn-primary addtocart">ADD to Cart</button>
					</div>
				</div>
			</div>

			<?php	
				}
			}
			?>
			
		</div>
		<hr>
		<!-- <div class="row">
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
		</div> -->
	</div>
</body>
<script type="text/javascript">
var url =  '<?= base_url() ?>';	
$(function(){

	//Load giỏ hàng
	$.ajax({
		url: url+'/Cart_ajax/load',
		type: 'POST',
		dataType: 'json',
		data: {},
	})
	.done(function(res) {
		if(res.length != 0){
			update(res);
		}
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		// console.log("complete");
	});
	
	
	$('body').on('click', '.addtocart', function(event) {
		var id = $(this).data('href');
		console.log(id);
		$.ajax({
			url: url+'/Cart_ajax/add/'+id,
			type: 'POST',
			dataType: 'json',
			data: {},
		})
		.done(function(res) {
			update(res);
		})
		.fail(function() {
			console.log("error");
		})
		.always(function(res) {
			// console.log("complete");
		});
		
	});
})

	function update(res){
		var res = Object.values(res); //cover res sang mảng
		var total = 0;
		var html = '<thead>';
		html += '<tr>';
		html += '<th>STT</th>';
		html += '<th>Tên Sản Phẩm</th>';
		html += '<th>Giá</th>';
		html += '<th>Số Lượng</th>';
		html += '<th>Thành Tiền</th>';
			html += '<th>Xóa Sản Phẩm</th>';
		html += '</tr>';
		html += '</thead>';

		res.forEach(function(index) {
			total += index.subtotal;
			html += '<tr>';
			html += '<td>'+index.id+'</td>';
			html += '<td>'+index.name+'</td>';
			html += '<td>'+format_number(index.price)+'đ</td>';
			html += '<td><input type="text" name="SoLuong['+index.id+']" value="'+index.qty+'" width="100px"></td>';
			html += '<td>'+format_number(index.subtotal)+'đ</td>';
			html += '<td><button type="button" data-href="'+index.id+'" class="btn btn-danger">Xóa</button></td>';
			html += '</tr>';
		});
		html+='<tfoot>';
		html+='<tr>';
		html+='<td><h3>Tổng tiền: <span style="color: red">'+format_number(total)+'đ</span></h3></td>';
		html+='<td><button type="button" class="btn btn-primary update">Update</button></td>';
		html+='<td><button type="button" class="btn btn-primary delete">Xóa</button></td>';
		html+='<td><button type="button" class="btn btn-primary thanhtoan">Thanh Toán</button></td>';
		html+='</tr>';
		html+='</tfoot>';
		html+='</table>';

		$('#cart').html(html);
	}
	function format_number(nStr, decSeperate = '.', groupSeperate =',') {
            nStr += '';
            x = nStr.split(decSeperate);
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + groupSeperate + '$2');
            }
            return x1 + x2;
        }
</script>
</html>