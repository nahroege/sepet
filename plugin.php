<?php
/*
Plugin Name: Sepet
Plugin URI: #
Description: Bir e-ticaret sepet eklentisidir.Bu eklenti sayesinde wordpress
aracılığla ticaret sitesine dönüşübilecek
Author: Ege ORHAN
Version: 0.1
Author URI: egeorhan.com


Domain Path: /i18n/languages/
*/

?>
<?php
add_action('admin_menu', 'yonetime_ekle');
function yonetime_ekle() {
    add_submenu_page('options-general.php', 'Sepet', 'Sepet', 10, __FILE__, 'sepet_menü');
}
?>
<?php
global $wpdb;
$spt=$wpdb ->get_result(
	"SELECT ID,urunler FROM $wpdb-> urunler where post_status='draft'
  <?php
     $posts = $wpdb->query("SELECT ID, post_title FROM wp_posts WHERE post_status = 'future' AND post_type='post' ORDER BY post_date ASC LIMIT 0,10")

     echo $urun[0]->id;


     if ($urun) {
       echo '<ul>';
       foreach ($urun as $urun) {
          echo '<li>' . $urun->id . '</li>';
       }
     }
  ?>


);
  ?>
<?php
header('content-type: text/html; charset=utf8');
ob_start();

	/* Ürünlerim */
	$urunler = array(1,2,3,4,5);

	/* Sepetimi Göster */
	if(isset($_GET['sepetim']))
	{
		echo '<h2>Sepetim ('.count($_COOKIE['urun']).')</h2>';
			if(isset($_COOKIE['urun']))
			{
				foreach($_COOKIE['urun'] as $urun => $val)
				{
					echo '
						<div style="border:1px solid #ddd;padding:10px;
margin-bottom:10px;">
						<h2>Ürün ' . $urun . ' </h2>
						<p>SELECT * FROM urun</p>
						<a href="?cikart='.$urun.'">[Sepetten Çıkart]</a>
					</div>';
				}
			}
			else
			{
				echo "Sepetinizde Hiç Ürün Bulunmamaktadır.";
			}

	}
	else
	{
		/* Sepet'te Kaç Tane Ürün Var */
		if(isset($_COOKIE['urun']))
		{
			echo 'Şuan Sepetinizde <strong>('.count($_COOKIE['urun']).')
</strong> Adet Ürün Bulunuyor
			<a href="?sepetimn=true">[Sepeti Göster]</a> |
 <a href="?bosalt=true">[Sepeti Boşalt]</a> ';
		}
		else
		{
			echo "Sepetinizde Hiç Ürün Bulunmamaktadır.";
		}

		/* Ürünleri Listeleyelim */
		foreach($urunler as $urun)
		{
			echo '
				<div style="border:1px solid #ddd;padding:10px;margin-bottom:10px;">
				<h2>Ürün ' . $urun . ' </h2>
				<p>Ürün Açıklaması</p>
				'.(isset($_COOKIE['urun'] [$urun]) ? '<a href="?cikart='.$urun.'">
[Sepetten Çıkart]</a>' : '<a href="?ekle='.$urun.'">[Sepete Ekle]</a>' ).'
			</div>';
		}
	}

	/* Sepete Ürün Ekle */
	if(isset($_GET['ekle']))
	{
		$id = $_GET['ekle'];

		setcookie('urun['.$id.']', $id, time() + 86400);
		header('Location:'.$_SERVER['HTTP_REFERER']);
	}

	/* Sepeti Boşalt */
	if(isset($_GET['bosalt']))
	{
		foreach($_COOKIE['urun'] as $key => $val)
		{
			setcookie('urun['.$key.']', $key, time() - 86400);
		}
		header('Location:'.$_SERVER['HTTP_REFERER']);
	}

	/* Sepetten Çıkart */
	if(isset($_GET['cikart']))
	{
		setcookie('urun['.$_GET['cikart'].']', $_GET['cikart'], time() - 86400);
		header('Location:'.$_SERVER['HTTP_REFERER']);
	}

/*sepeti onayla*/
if (isset($GET['ONAYLA']))
{
  $sql = $wpdb->prepare( "INSERT INTO $wpdb->sec_urun (id,ad, fiyat ) VALUES ( %d, %s, %f )", 15, 'fiyat', '');
//$sql değişkeninin değeri aşağıdaki gibi olacaktır:
// $sql = INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value ) VALUES ( 15, 'imdb_puani', 8.7 )

$kayitid = $wpdb->query($sql);
}




?>
