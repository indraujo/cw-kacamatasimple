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
				<h1 class="page-header">Forms</h1>
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
									<label>Akun</label>
									<div class="radio">
										<label>
											<input type="radio" name="akun" id="akun1" value="0" checked>Akun galerikacamatasimple.id
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
									</div>
								</div>

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
$akun = $_POST['akun'];
//echo $akun;

//$session = "kacamatasimple";
//$session = "kacamatafashionid";
//$session = "kacamatasimplecom";
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
	echo "<br>".$jml_hashtag;

}
elseif ($akun == "2")
{
	foreach ($hashtag as $ht) {
		$tag[] = "#".$ht->hashtag;
	}
	$jml_hashtag = count($tag);
	echo "<br>".$jml_hashtag;

}




$jml_caption = ceil($jml_hashtag/25);
echo "<br>".$jml_caption;

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
echo "<br>";

//PENAWARAN-------------------------------
// membaca output dari form
$output = $_POST['ket'];
echo $output."</br>";

// membuat format huruf kecil semua
//$output = strtolower($output);
//echo $output."</br>";

//menghilangkan enter
$output = trim(preg_replace('/\s+/', ' ', $output));

$output = str_replace('.', '', $output);
$output = strtolower($output);


//hapus harga reseller
$output = str_replace('harga reseller', '', $output);

//ganti nama merk

foreach($merk as $mk)
{
	//echo $mk['kode']." ";
	
	//echo $mk."</br>";
	$m = $mk->merk;
	//echo $m;
	$kode = $mk->kode_merk;
	//echo $kode;
	$key = array_search($m,$merk);
	//echo $key;

	$posisim=strpos($output,$m);
	if ($posisim !== FALSE){
		//echo "Ketemu";
		
		$output = str_replace($m, $kode, $output);
		$ks = $kode;//echo $output;

	}
	else{
		//$ks = 0;
	}
}


if ($ks = '') {
	$ks = "FR";
}


//mencari paket
$fs = strpos($output," fullset");
$hm = strpos($output," hemat");

//mencari keberadaan paket
$fs=strpos($output,"fullset");
if ($fs !== FALSE){
	//echo "Ketemu fullset = ".$fs;
	$posisifs = $fs;
	$harga_fs = substr($output, ($posisifs+8),6);
	$harga_fs_update = $harga_fs + 15000;
	echo "harga fullset = $harga_fs ->$harga_fs_update </br>";

	$capfullset = str_replace($fs, number_format($harga_fs_update,0,",",".")." - Paket Fullset
(FREE Box, Case, Certificate dan Lap)
Kelengkapan Seperti Original", $fs);

}
else {
	//echo "Tidak ketemu fullset";
	$posisifs = 1000;
}

$hm=strpos($output,"hemat");
if ($hm !== FALSE){
	//echo "Ketemu hemat = ".$hm;
	$posisihm = $hm;
	$harga_hm = substr($output, ($posisihm+6),6);
	$harga_hm_update = $harga_hm + 15000;
	echo "harga hemat = ".$harga_hm."-> ".$harga_hm_update."</br>";

	$caphemat = str_replace($hm, number_format($harga_hm_update,0,",",".")." - Paket Hemat
(FREE Case dan Lap)", $hm);

}
else {
	//echo "Tidak ketemu hemat";
	$posisihm = 1000;
}


if ($posisifs < $posisihm) {
	$posisi = $posisifs;
}
else {
	$posisi = $posisihm;
}

//kode produk
$kode = substr($output, 0,$posisi);

$array_kode = explode(" ", $kode);
foreach ($array_kode as $ak) {
	$aku[] = ucfirst($ak);
	//echo $aku."</br>";
}
$kode = implode(" ", $aku);

//$kode = ucfirst($kode);
echo "</br>Kode : ".$kode." -> #KS_".$ks."</br>";
echo "<textarea id='kode' rows=1 cols=40>".$kode."</textarea><button class='button' id='copy-button' data-clipboard-target='#kode'>Copy</button>";


//Alasan
$alasan = "📛 Mengapa order di kacamatasimple.id?
✔️ Tersedia Banyak koleksi dari brand ternama yang pastinya keren dan kamu banget!
✔️ Promo khusus setiap bulannya untuk kamu!
✔️ FREE Retur! Jika yang kamu dapatkan tidak sesuai dengan gambar";
//foreach ($al as $a) {
//	$alasan = $a->alasan;
//}

//Bonus
//foreach ($bn as $b) {
//	$bonus = $b->bonus;
//}
$bonus = "📛 AWAS! 📛
Jangan sampai kamu ketinggalan PROMO TERBATAS nya yah. Dapatkan Promo menarik setiap bulannya, dan promo dadakan setiap minggu nya.";

//Kelengkapan produk
$koleksi = array(
'0' =>"✔️ Follow @kacamatasimple.id untuk dapatkan PROMO terbatas!",
'1' =>"✔️ Follow @kacamatasimple.id untuk dapatkan HARGA PROMO.
✔️ Follow @galerikacamatasimple.id untuk melihat-lihat koleksi kami.",
'2' =>
"✔️ Follow @kacamatasimple.id untuk dapatkan HARGA PROMO.
✔️ Follow @galerikacamatasimple.id untuk melihat-lihat koleksi kami.");

$koleksi = $koleksi[$akun];
//Call To Action
foreach ($call as $c) {
	$calltoaction = $c->calltoaction;
}

//Kemudahan bertransaksi
$fastorder ="🔥 FAST ORDER 🔥
1. Cukup Screenshot/Download foto.
2. Kirim melalui instagram/whatsapp/line kami.";

//NB
$nb = "📌 Catatan 📌
✔️ Terima Pembuatan Lensa -/+/silinder (CRMC / Progresif / Photochromic / Bluray / Essilor)
✔️ No Booking Order
✔️ Siapa CEPAT dia DAPAT!
#KacamataSimple";
?>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Basic Table</div>
					<div class="panel-body">
					<?php

if(isset($_POST['ket']))
{

if ($fs !== FALSE and $hm !== FALSE) {

	echo "<table data-toggle='table'  >";
	for ($i=0; $i < $jml_caption; $i++) { 
		$random_headline = rand(0,$jml_headline-1);
		echo "<tr><td>".$i."</td><td> <textarea id='hashtag_".$i."' rows=5 cols=40>
".$headline[array_rand($headline)]."
.
Kode : ".$kode."
Warna : (Sesuai Gambar)
Kualitas : Premium / Super (Best Quality)
.
✔️ Harga : 
".$capfullset."
.
".$caphemat."
.
".$alasan."
.
".$bonus."
.
".$koleksi."
.
📛 ".$calltoaction."
.
".$fastorder."
.
".$nb;
if ($akun !== "0") 
{
	echo "
.
	";
		$c = (($i*25)+1);
		for ($ii=$c; $ii < ($c+25); $ii++) { 
if (isset($tag[$ii])) {
	echo $tag[$ii]." ";
}



	
		}
	}
		echo "</textarea></td><td>     <button class='btn btn-primary' id='copy-button' data-clipboard-target='#hashtag_".$i."''>Copy</button>

		</td></tr>";
	}
	echo "</table>";
}

else if ($fs != '' and $hm == '') {
	echo $jml_caption;
	echo "<table data-toggle='table'  >";
	for ($i=0; $i < $jml_caption; $i++) { 
		$random_headline = rand(0,$jml_headline-1);

		echo "<tr><td>".$i."</td><td> <textarea id='hashtag_".$i."' rows=5 cols=40>
".$headline[array_rand($headline)]."
.
Kode : ".$kode."
Warna : (Sesuai Gambar)
Kualitas : Premium / Super (Best Quality)
.
✔️ Harga : 
".$capfullset."
.
".$alasan."
.
".$bonus."
.
".$koleksi."
.
📛 ".$calltoaction."
.
".$fastorder."
.
".$nb;
if ($akun !== "0") 
{
echo "
.
";
		$c = (($i*25)+1);
		for ($ii=$c; $ii < ($c+25); $ii++) { 
if (isset($tag[$ii])) {
	echo $tag[$ii]." ";
}
		}
	}
		echo "</textarea></td><td>     <button class='btn btn-primary' id='copy-button' data-clipboard-target='#hashtag_".$i."''>Copy</button>

		</td></tr>";
	}
	echo "</table>";
}

else if ($hm != '' and $fs =='') {
	echo "<table data-toggle='table'  >";
	for ($i=0; $i < $jml_caption; $i++) { 
		$random_headline = rand(0,$jml_headline-1);
		echo "<tr><td>".$i."</td><td> <textarea id='hashtag_".$i."' rows=5 cols=40>
".$headline[array_rand($headline)]."
.
Kode : ".$kode."
Warna : (Sesuai Gambar)
Kualitas : Premium / Super (Best Quality)
.
✔️ Harga : 
".$caphemat."
.
".$alasan."
.
".$bonus."
.
".$koleksi."
.
📛 ".$calltoaction."
.
".$fastorder."
.
".$nb;
if ($akun !== "0") 
{
echo "
.
";
		$c = (($i*25)+1);
		for ($ii=$c; $ii < ($c+25); $ii++) { 
if (isset($tag[$ii])) {
	echo $tag[$ii]." ";
}
		}
	}
		echo "</textarea></td><td>   <button class='btn btn-primary' id='copy-button' data-clipboard-target='#hashtag_".$i."''>Copy</button>

		</td></tr>";
	}
	echo "</table>";
}	



	

	//$output = str_replace($harga_d[0], number_format($harga_u[0],0,",","."), $output);
	//$output = str_replace($harga_d[1], number_format($harga_u[1],0,",","."), $output);
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
