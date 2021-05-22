<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Kacamata Simple - CW</title>

<link href="<?php echo base_url();?>assets/themes/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/themes/css/datepicker3.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/themes/css/styles.css" rel="stylesheet">
<script src="<?php echo base_url();?>assets/clipboard.js/dist/clipboard.min.js" ></script>
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
				<li class="active">Icons</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Instagram Hijab Caption Post</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Form Elements</div>
					<div class="panel-body">
						<div class="col-md-6">
							<form role="form" action="" method="POST">
							
								<div class="form-group">
									<label>Kode, Paket dan Harga</label>
									<textarea class="form-control" rows="3" name="ket" placeholder="Dior Jelly.... 
Hemat 115....
Fullset 160....
"></textarea>
								</div>

								<div class="form-group">
									<!--<label>Akun</label>
									<div class="radio">
										<label>
											<input type="radio" name="akun" id="akun1" value="0" checked>Akun galeri@yk.hijab
										</label>
									</div>
									<div class="radio">
										<label>
											<input type="radio" name="akun" id="akun2" value="1">Akun 2 
										</label>
									</div>
									<div class="radio">
										<label>
											<input type="radio" name="akun" id="akun3" value="2">Akun 3
										</label>
									</div>-->
								</div>
								<input type="hidden" name="akun" value="1">
								<input type="submit" class="btn btn-primary"></button>
							</form>
						</div>
					</div>
				</div>
			</div><!-- /.col-->
		</div><!-- /.row -->
<?php 
error_reporting();
//$rows = $this->db->query("SELECT * FROM admin where username_admin='".$this->session->userdata('nama')."'")->row_array();

if (isset($_POST['akun'])) {
	$akun = $_POST['akun'];


if ($akun == "0") 
{
	$tag="";
	$jml_hashtag = 25;
//	echo "<br>".$jml_hashtag/25;
}
elseif ($akun == "1") 
{
	foreach ($hashtag as $ht) {
		$tag[] = "#".$ht->hashtag;
	}
	$jml_hashtag = count($tag);
	//echo "<br>".$jml_hashtag;

}
elseif ($akun == "2")
{
	foreach ($hashtag as $ht) {
		$tag[] = "#".$ht->hashtag;
	}
	$jml_hashtag = count($tag);
	//echo "<br>".$jml_hashtag;

}




$jml_caption = ceil($jml_hashtag/25);
//echo "<br>".$jml_caption;

/*
8 Elemen Penting
-Headline
-Penawaran
-Alasan
-Bonus
-Testimoni
-Garansi
-Call toAction
-N.B.
*/

//headline-------------------------------
foreach ($hd as $h) {
	$headline[] = $h->headline;
}
$jml_headline = count($headline);
//echo "<br>";

//PENAWARAN-------------------------------
// membaca output dari form
$caption = $_POST['ket'];
$output = $caption;
echo "Product Code = ".$output."</br>";
//mencari best seller
$bs = strpos($caption,"best seller");
if ($bs !== FALSE){
	$bs = "📛 BEST SELLER 📛
";
}

//menghilangkan enter
$output = trim(preg_replace('/\s+/', ' ', $output));

$output = str_replace('.', '', $output);
$output = str_replace('×', 'x', $output);
$output = strtolower($output);

// Get Code
$codeposition = strpos($output,"kode :");
$sizeposition = strpos($output,"ukuran :");
$materialposition = strpos($output,"bahan :");
$priceposition= strpos($output,"harga :");

$startcode = $codeposition+7;
if($sizeposition>$materialposition){
	$endcode = $materialposition-$codeposition-7;
}
else{
	$endcode = $sizeposition-$codeposition-7;
}
$code = strtoupper(substr($output,$startcode, $endcode));
echo "Kode : ".$code."</br>";

// Get Size
$startsize = $sizeposition+9;
if($sizeposition>$materialposition){
	$endsize = $priceposition-$sizeposition-9;
}
else{
	$endsize = $materialposition-$sizeposition-9;
}
$size = ucwords(substr($output,$startsize, $endsize));
echo "Size : ".$size."</br>";

// Get material
$startmaterial = $materialposition+8;
if($sizeposition>$materialposition){
	$endmaterial = $sizeposition-$materialposition-9;
}
else{
	$endmaterial = $priceposition-$materialposition-8;
}
#$endmaterial = $priceposition-$materialposition-8;
$material = ucwords(substr($output,$startmaterial, $endmaterial));
echo "Material : ".$material."</br>";

// Get Price : 
// Get Price 1 Position
$price1position = strpos($output,"1pcs");
$price2position = strpos($output,"3pcs");
$price3position = strpos($output,"20pcs");

if ($price3position == ""){$price3position = strlen($output);}
if ($price2position == ""){$price2position = strlen($output);}




$startprice1 = $price1position+5;
$endprice1 = $price2position-$price1position-5;
$price1 = substr($output,$startprice1, $endprice1);

#echo "Price 1pcs = ".$price1position." ".$price1."</br>";
$price1_normal = $price1 + 20000;
#echo "harga Normal 1pcs = $price1 ->$price1_normal </br>";

$caption_price1normal = str_replace($price1, "Harga Normal : ".number_format($price1_normal,0,",",".")."/pcs", $price1);
echo $caption_price1normal."</br>" ;

$markup = 15000;
$price1_update = $price1 + $markup;
#echo "harga Promo 1pcs = $price1 ->$price1_update </br>";

$caption_price1promo = str_replace($price1, "Harga Promo : ".number_format($price1_update,0,",",".")."/pcs", $price1);
echo $caption_price1promo."</br>" ;

// Get Price 2 Position
$exc = strpos($output,"dapet 3pcs");
if($exc != ""){
	$startprice2 = $exc-6;
	$endprice2 = 5;
	$price2 = substr($output,$startprice2, $endprice2);
	$price2_update = ($price2*1000) + ($markup*3);
}
else{
	$startprice2 = $price2position+5;
	#echo $startprice2;
	$price3position = strlen($output);
	$endprice2 = $price3position-$price2position-5;
	$price2 = substr($output,$startprice2, $endprice2);
	$price2_update = $price2 + $markup;
}
#echo "Harga Cantik 3pcs : ".$price2_update."</br>";
$caption_price2 = str_replace($price2, "Harga Cantik 3pcs : ".number_format($price2_update,0,",",".")."/pcs", $price2);
echo $caption_price2."</br>" ;

// Get Price 3 Position
if ($price3position != ""){
$startprice3 = $price3position+5;
$endprice3 = strlen($output)-$price3position-5;
$price3 = substr($output,$startprice3, $endprice3);
$price3_update = $price3 + $markup;

#echo "Harga Cantik 20pcs : ".$price2_update."</br>";
$caption_price3 = str_replace($price3, "Harga Reseller 20pcs : ".number_format($price3_update,0,",",".")."/pcs", $price3);
echo $caption_price3."</br>" ;
}
else{
	$caption_price3 = "";
}

$price1pos = strpos($output,"1pcs");
$price2pos = strpos($output,"3pcs");
$price3pos = strpos($output,"20pcs");
if ($price3pos == ""){
	if ($price2pos == ""){
		$caption_price =  
$caption_price1normal."
".$caption_price1promo;
	}
	else{
		$caption_price =  
$caption_price1normal."
".$caption_price1promo."
".$caption_price2;
	}
}
else{
	$caption_price =  
$caption_price1normal."
".$caption_price1promo."
".$caption_price2."
".$caption_price3;
}

echo $caption_price;


// Penawaran
$penawaran = "Dengan bahan premium yang lembut, ringan dan tidak mudah kusut, #hijabsimple pastikan kamu nyaman seharian beraktifitas dan makin produktif cantik.";

// Alasan
$alasan = "📛 Mengapa order di @yk.hijab?
✔️ Banyak koleksi yang keren dan pasti kamu banget!
✔️ Material Premium yang membuat kamu nyaman seharian beraktifitas.
✔️ Promo Terbatas untuk kamu!
✔️ FREE Retur! Jika yang kamu dapatkan tidak sesuai dengan gambar";

//Bonus
$bonus = "📛 PERHATIAN! 📛
Jangan sampai kamu ketinggalan PROMO KHUSUS setiap BULAN nya yah.
Be Your Self dan #BeraniBeda";

//Kelengkapan produk
$koleksi = array(
'0' =>"✔️ Follow @yk.hijab untuk dapatkan PROMO terbatas!",
'1' =>"✔️ Follow @yk.hijab untuk dapatkan Koleksi dan Harga Spesial buat kamu.
✔️ Follow @galerihijabyk.id untuk Koleksi lengkap kami.",
'2' =>
"✔️ Follow @yk.hijab untuk dapatkan HARGA PROMO.
✔️ Follow @galerihijabyk.id untuk koleksi dan Harga lengkap kami.");

$koleksi = $koleksi[$akun];
//Call To Action
/*
foreach ($call as $c) {
	$calltoaction = $c->calltoaction;
}
*/
$calltoaction = "📛 Tunggu apa lagi? Yuk order sebelum kehabisan!
WhatsApp : 0811-1049-307";

//Kemudahan bertransaksi
$fastorder ="🔥 FAST ORDER 🔥
1. Cukup Screenshot/Download foto.
2. Klik link di bio untuk langsung chat kami.
3. Tanyakan kesediaan produk
4. Langsung order sebelum diambil yang lain!";

//NB
$nb = "📌 Catatan 📌
✔️ Untuk produk Best Seller dan Spesial Series jangan ditunda karena cepat habis dan terbatas 
✔️ No Booking Order kecuali reseller 20pcs
#HijabSimple";
?>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Basic Table</div>
					<div class="panel-body">
					<?php

if(isset($_POST['ket']))
{

	
	echo "<table data-toggle='table'  >";
	for ($i=0; $i < $jml_caption; $i++) { 
		$random_headline = rand(0,$jml_headline-1);
		echo "<tr><td>".$i."</td><td> <textarea id='hashtag_".$i."' rows=5 cols=40>
".$bs.$headline[array_rand($headline)]."

Kode : ".$code."
Ukuran : ".$size."
Bahan : ".$material."

📛 Harga : 
".$caption_price."

".$penawaran."

".$alasan."

".$bonus."

".$koleksi."

📛 ".$calltoaction."

".$fastorder."

".$nb;
if ($akun !== "0") {
echo "
.
";
			$c = (($i*25)+1);
			for ($ii=$c; $ii < ($c+25); $ii++) { 
	if (isset($tag[$ii])) {
		echo $tag[$ii]." ";
	}
		
	}
		echo "</textarea></td><td>   <button class='btn btn-primary' id='copy-button' data-clipboard-target='#hashtag_".$i."''>Copy</button>

		</td></tr>";
	}}
	echo "</table>";
}	

}
?>
						
					</div>
				</div>
			</div>

	</div><!--/.main-->

	<script src="<?php echo base_url();?>assets/themes/js/jquery-1.11.1.min.js"></script>
	<script src="<?php echo base_url();?>assets/themes/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>assets/themes/js/chart.min.js"></script>
	<script src="<?php echo base_url();?>assets/themes/js/chart-data.js"></script>
	<script src="<?php echo base_url();?>assets/themes/js/easypiechart.js"></script>
	<script src="<?php echo base_url();?>assets/themes/js/easypiechart-data.js"></script>
	<script src="<?php echo base_url();?>assets/themes/js/bootstrap-datepicker.js"></script>
	<script>
(function(){
    new Clipboard('#copy-button');
})();
</script>
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
