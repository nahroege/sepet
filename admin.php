<?php
/*
Plugin Name: Sepet
Plugin URI: github.com/nahroege/sepet
Description: Bir e-ticaret sepet eklentisidir.Bu eklenti sayesinde wordpress
aracılığla ticaret sitesine dönüşübilecek
Author: Ege ORHAN
Version: 0.2
Author URI: egeorhan.com


Domain Path: /i18n/languages/
*/

?>

<?php
<div class="wrap">
    function sepet_menu() {
        global $wpdb;

        if ($_POST['islem']== 'onayla') { sepet_onay (); }
        if ($_GET['islem']== 'sil') { sepet_sil (); }
        if ($_POST['islem']== 'yolacikar') { yolacikar (); }
        $sorgu = "SELECT * FROM $wpdb->urun order by id desc";
        $sonuclar = $wpdb->get_results($sorgu);
         if ($sonuclar) {
            echo "<strong>Sipariş Listesi:</strong>";
            echo "<ol>";
            foreach ($sonuclar as $sonuc) {
                $metin=stripslashes($sonuc->ipucumetin);
        echo "<li>".$metin;
        echo "-[<a href='".$_SERVER&#91;'PHP_SELF']
          ."?page=plugin.php&islem=sil&silno=".$sonuc->id."'>Sil</a>]";
        echo "-[<a href='".$_SERVER&#91;'PHP_SELF']
          ."?page=plugin.php&degistir=".$sonuc->id."'>Düzenle</a>]</li>";
            }
            echo "</ol>";
        } else { echo "Sipariş bulunmuyor!"; }
        </div>
        if (!isset($_GET['degistir'])) {
    ?>
        <form action="<?php $_SERVER['PHP_SELF'] ?>?plugin.php" method="post" >
           <fieldset>
         <table width="400">
             <tr><td><input type="submit" name="submit" value="<?php
           /* Eğer gunun_ipucu_yazida isimli seçeneğin durumuna göre seçenek
               düğmemize isim veriyoruz*/
              if (get_option('urun_fiyat') == 'hayir') {echo "uygun ürünler";
    }else{ echo "uygun ürün gösterme";} ?>" class="button" /></td></tr>
         </table>
              <INPUT TYPE="hidden" name="islem" value="yazidagoster"></p>
           </fieldset>
         </form>

    <form action="<?php $_SERVER['PHP_SELF'] ?>?page=gunun_ipucu.php" method="post" >
            <fieldset>
            <table width="400">
                <tr><td width="400"><b>Yeni İpucu</b></td></tr>
                <tr><td><textarea name="metin" id="metin" cols="45" rows="6" tabindex="4"></textarea></td></tr>
                <tr><td><input type="submit" name="submit" value="İpucunu Ekle" class="button" tabindex="5" /></td></tr>
            </table>
                <INPUT TYPE="hidden" name="islem" value="ekle"></p>
            </fieldset>
        </form>

    <?php

    } } }
            echo "</div>";
    } // Fonksiyonun sonu
