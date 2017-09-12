
<?php

  header('content-type: text/html; charset=utf8');
	ob_start();

	/*Ürünleri veritabanından bulalım */

$urunler = SELECT *FROM urunler WHERE id = 'id' ORDER BY sira ASC";
$sepetListe = mysqli_query($baglan, $Modulsorgula);
while ($sepetSonuc = mysqli_fetch_assoc($sepetListe)) {
	/* Sepetimi Göster */
if(isset($_GET['sepetListe']))
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
			<a href="?sepetim=true">[Sepeti Göster]</a> |
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


?>
