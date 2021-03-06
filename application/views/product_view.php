<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Kacamata Simple - CW</title>

<link href="<?php echo base_url();?>assets/themes/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/themes/css/datepicker3.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/themes/css/styles.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/themes/css/bootstrap-table.css" rel="stylesheet">

<!--Icons-->
<script src="<?php echo base_url();?>assets/themes/js/lumino.glyphs.js"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Product List</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Product List</h1>
			</div>
		</div><!--/.row-->
				
		<?php
		if (!isset($_GET['product_id'])) {
			
		

		?>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Input product</div>
					<div class="panel-body">
						<div class="col-md-6">
							<form role="form" enctype="multipart/form-data" action="<?php echo base_url();?>product/input_product" method="POST" >
							
								<div class="form-group">
									<table>
										<tr>
											<td>
												<label>Product Name</label>
											</td>
											<td>	
												<input name="product_name" type="text"/>
											</td>
										</tr>
										<tr>
											<td>
												<label>Product Desc</label>
											</td>
											<td>
												<textarea name="product_desc"></textarea><br>
											</td>
										</tr>
										<tr>
											<td>
												<label>Product Price</label>
											</td>
											<td>
												<input name="product_price" type="text"/><br>
											</td>
										</tr>
										<tr>
											<td>
												<label>Product Image</label>
											</td>
											<td>
												<input type="file" name="product_image" value=""/><br>
											</td>
										</tr>
									</table>
								</div>
								<input type="submit" class="btn btn-primary"></button>
							</form>
						</div>
					</div>
				</div>
			</div><!-- /.col-->
		</div><!-- /.row -->
		
		<?php
	}

		if (isset($_GET['product_id'])) {
			
		

		?>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Edit product</div>
					<div class="panel-body">
						<div class="col-md-6">
							<form role="form" action="<?php echo base_url("product/update");?>" method="POST">
							
								<div class="form-group">
									<label>Edit product</label>
									<?php foreach($product as $h){?>
									<input type="hidden" name="product_id" value="<?php echo $h->product_id;?>"/>
									<textarea class="form-control" rows="3" name="product" ><?php echo $h->product;?></textarea>
									<?php }?>
								</div>
								<input type="submit" class="btn btn-primary"></button>
							</form>
						</div>
					</div>
				</div>
			</div><!-- /.col-->
		</div><!-- /.row -->
		<?php
	}
	if (!isset($_GET['product_id'])) {

		?>

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Basic Table</div>
					<div class="panel-body">
						<table data-toggle="table"  >
						    <thead>
						    <tr align="center">
						        <th data-align="center">ID product</th>
						        <th data-align="center">Product Name</th>
						        <th data-align="center">Action</th>
						    </tr>
						    </thead>
						    <?php foreach($product as $a){ 
						    	$product_id = $a->product_id;?>
						    <tr >
						        <td ><?php echo $product_id; ?></td>
						        <td ><?php echo $a->product_name; ?></td>
						        <td >
						        		<a href="<?php echo base_url("product/edit?product_id=".$product_id);?>"><button type="submit" class="btn btn-primary">Edit</button></a>
										<a href="<?php echo base_url("product/delete?product_id=".$product_id);?>"><button type="reset" class="btn btn-default">Delete</button></a>
								</td>
						    </tr>
						    <?php } ?>
						</table>
					</div>
				</div>
			</div>
			<?php
		}
		?>
	</div><!--/.main-->

	<script src="<?php echo base_url();?>assets/themes/js/jquery-1.11.1.min.js"></script>
	<script src="<?php echo base_url();?>assets/themes/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>assets/themes/js/chart.min.js"></script>
	<script src="<?php echo base_url();?>assets/themes/js/chart-data.js"></script>
	<script src="<?php echo base_url();?>assets/themes/js/easypiechart.js"></script>
	<script src="<?php echo base_url();?>assets/themes/js/easypiechart-data.js"></script>
	<script src="<?php echo base_url();?>assets/themes/js/bootstrap-datepicker.js"></script>
	<script src="<?php echo base_url();?>assets/themes/js/bootstrap-table.js"></script>
	<script>
		!function ($) {
			$(document).on("click","ul.nav li.parent > a > span.icon", function(){		  
				$(this).find('em:first').toggleClass("glyphicon-minus");	  
			}); 
			$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
</body>

</html>
