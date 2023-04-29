<?php
/*** BENUTZER LOGIN SESSION STARTEN ***/
/*** Quelle:https://www.php-einfach.de/experte/php-codebeispiele/loginscript/ ***/
session_start();
/**********************************************************************/
include($_SERVER['DOCUMENT_ROOT'].'/include/funktionen.php');
include($_SERVER['DOCUMENT_ROOT'].'/include/connection.php');
// include($_SERVER['DOCUMENT_ROOT'].'/include/qrcode.php');
include($_SERVER['DOCUMENT_ROOT'].'/include/browserweiche.php');
// require_once("qrcode.php");
// $aPathinfo=?pathinfo($_SERVER['PHP_SELF']);
// echo?basename($aPathinfo['basename'],?".{$aPathinfo['extension']}");
// echo "GURKE".$_SERVER['PHP_SELF'];
$path=$_SERVER['PHP_SELF'];
    @$path.=$_POST['email']."-";
    @$path.=$_POST['password'].".";
@$id = $_GET['id']; 
LogFile($path,$id); // die id fehlt, falls vorhanden! jn18042017

/*** BLOCK SINGLE IP. ***/
// BlockIP('80.109.46.145'); /* Eigene IP von aussen. */
// BlockIP('91.200.12.24'); /* 91.200.12.24 Ukrainer vom Mai. */
/*** BLOCK COMPLETE IP RANGES. ***/
// BlockIPRange();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<!-- <!-- <!DOCTYPE html> -->
<!--- <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> --->
<!-- <html> -->
<head>
<!--
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
-->
<meta charset="UTF-8">
<!--- <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-8">  -->

<title>Desktopfachkraft</title>

<!link rel="stylesheet" href="include/hauptstil.css" />
<link rel="icon" href="./bilder/fav.ico" type="image/vnd.microsoft.icon">
</head>

<body class="landing" style="background-color:#F2F2F2;">

<div class="info"><?php if(@$_GET['go']=="success") {echo "&nbsp;&nbsp;&nbsp;<a href=/?>Ihre Nachricht wurde erfolgreich gesendet.</a>";exit;} ?></div>

<!div id="bg"><!-- bg mit hintergrundbild. --></div>
        <a href=top></a>
        <a href="./" id="logo" class="Navigation" title="Start"><h1 id="vollebreite" class="titel bigger">Desktopfachkraft</h1>
        <br><p id="small">&nbsp;f&uuml;r Web-, Design und Bildbearbeitung. J. Nickerl</p>
        <br></a>
<div id="wrapper"><!-- Ab HIER kommen die LINKS zur Geltung. Ausserhalb des WRAPPERS sind die Links inaktiv. -jn17072016@11:45 -->

<br>
<?php
//    include($_SERVER['DOCUMENT_ROOT'].'/include/login.php');     /*  */
 /*** SUCHE EINBINDEN ***/
    echo "<div class=suche>";
    include($_SERVER['DOCUMENT_ROOT'].'/suche.php');
    echo "</div>";
?>
<!-- KEINE TOP NAVIGATION MEHR. 30072016 15:14 jn. Da sonst doppelte Links vorkommen. -->
<!-- <a href="./index.php" id="Home" class="Navigation">Home</a> -->
<!-- &nbsp;&nbsp;&#124;&nbsp;&nbsp;<a href="./include/kontakt.php" id="Kontakt, small" class="Navigation">Kontakt</a> -->
<!-- &nbsp;&nbsp;&#124;&nbsp;&nbsp; -->
<!-- <a href="./index.php?id=770" id="About" class="Navigation">&Uuml;ber</a>&nbsp;&nbsp; -->
<!-- <a href="./showreel/index.php" id="Arbeitsprobe" class="Navigation" target="_Arbeitsprobe">Arbeitsprobe</a>&nbsp;&nbsp;&#124;&nbsp;&nbsp; -->
<!-- <a href="./#login" id="login" class="Navigation">Login</a> -->
<!-- SUCHVARIABLE PRUEFEN. SONST KOMMT DER RUSSISCHE WOLF. yandex.ru
<div class=suche><?php include($_SERVER['DOCUMENT_ROOT'].'/suche.php');?></div>
-->

<!-- <hr noshade> -->

<?php
     if (!@$_GET['id']) {
//    $qry = "SELECT DISTINCT * FROM artikel WHERE access NOT LIKE 'admin' AND access NOT LIKE 'guest' ORDER BY id DESC";
    $qry = "SELECT DISTINCT * FROM artikel WHERE access NOT LIKE 'admin' ORDER BY id DESC";

// var_dump($qry);
    if (!$qry = $dbhandle->query($qry)) {
        echo "<pre>Fehler bei der Abfrage: Artikel Liste.</pre>";
        exit;}
/************************************************************************************/
/************************************************************************************/
/************************************************************************************/
/*****************     A R T I K E L  -  L I ST E     *******************************/
/************************************************************************************/
/************************************************************************************/
/************************************************************************************/
    $content="";
    $content.="<pre>";
    $content.="<ol id=\"liste\">";
    $i = 0;
    while ($artikelarray = $qry->fetch_object()) {
    $content.="<li id=\"liste\">";

    /***  E I N    N E U    ERSTELLTER  ARTIKEL WIRD MIT EINEM SYMBOL HERVORGEHOBEN  ***/
    $i++;
    if ($i==1) {
        $content.="<article style=\"background-image:url('../bilder/upload/neu.svg');background-repeat:no-repeat;\" class=\"liste\">";
        } else {
        $content.="<article class=liste>";
        }
// echo nl2br("One line.\nAnother line.");        
// strip_tags($artikelarray->text, '<br>');
// echo htmlentities(strip_tags($current_page["content"]));
// $content.="<a href=\"".$_SERVER['PHP_SELF']."?id=".$artikelarray->id."\" name=\"".nl2br($artikelarray->id)."\" id=\"gelb xbig newfontlight uppercase\" title=\"".strip_tags($artikelarray->text)."\">";
$content.="<a href=\"".$_SERVER['PHP_SELF']."?id=".$artikelarray->id."\" name=\"".strip_tags($artikelarray->id)."\" id=\"gelb xbig newfontlight uppercase\" title=\"".htmlentities(strip_tags($artikelarray->text))."\">";

        $content.= "<pre>".$artikelarray->titel."</pre>";
            if (!$artikelarray->bild || @$artikel->bild=="") {
            $content.="";} 
            else { 
                $content.="<img src=".$artikelarray->bild." id=\"Artikel_Bild_Breite\">";}
        $content.= "<p class=\"small morespacing schwarz\" id=\"linksbuendig\">".$artikelarray->einleitung."</p>";
        $content.="</li>";
    }
    $content.="<ol>";
    $content.="</pre>";
} 
echo "<!--<h4>Artikel</h4>LISTE-->".@$content;
 ?>


<!---
<video width="480" height="268" autoplay nocontrols loop>
    <source src="tpose.mp4" type="video/mp4"> 
    Ihr Browser kann dieses Video nicht wiedergeben.<br>
</video>
--->

 <?php
 /************************************************************************************/
/*************************************************************************************/
/********         E I N E N       A R T I K E L     A U S B E G E N .         ********/
/*************************************************************************************/
/*************************************************************************************/
/*** UEBERPRUEFEN OB IN DER VARIABLE $id NUR ZAHLEN VORKOMMEN ***/
/************************************************************************************/
@$id = $_GET['id']; /*** Notice: Undefined index: id in E:\xampp\htdocs\index.php on line 4, daher @ ***/
if (!$id) {} else { /*** Wenn keine $id verwendet wird, brauch ich auch nichts pruefen.  ***/
    /*** Variable ?id=artikel nr, darf nur Zahlen enthalten.  ***/
    if (!preg_match("#^[0-9]+$#", $id)) { /*** preg_match("#^[a-zA-Z0-9]+$#", $id) ***/
    echo "<pre style=\"color:red;\">Abbruch! Ungueltige Eingabe. Sie werden weitergeleitet.</pre><META http-equiv='refresh' content='3; http://".$_SERVER['SERVER_NAME']."'>";
    exit;
    } else {// echo 'Gueltige Abfrage. Variable mit Buchstaben und Zahlen.'; }
    } // Ende pregmatch check.
}
/*** ENDE UEBERPRUEFEN **/
/************************************************************************************/
/***   ARTIKEL AUSGEBEN     ********************************************************+/
/************************************************************************************/
// Die Variable $id wurde ueberprueft und fuer gut befunden.
if (isset($id)) {
    $queryID = "SELECT DISTINCT * FROM artikel WHERE id='";
    $queryID.= $_GET['id'];
    $queryID.= "'"; 
    if (!$resultID = $dbhandle->query($queryID)) {// Fehlerausgabe. 
        echo "<pre>Fehler bei der Abfrage des Artikels! Ich breche die Verbindung jetzt ab.</pre>";
        exit;} 
/************************************************************************************/
    $artikelID = $resultID->fetch_object();
if (!$artikelID){echo "<pre>Der Artikel ".$_GET['id']." ist nicht vorhanden. Sie werden weitergeleitet.</pre><META http-equiv='refresh' content='3; http://".$_SERVER['SERVER_NAME']."'>";
exit;
} 
// else {echo "<pre>weiter.</pre>";exit;}
//    $artikel.="<a name=\"titel\"></a>";
    @$artikel.=$content;
    /* $artikel.="<link rel=\"stylesheet\" type=\"text/css\" href=\"./stile/artikel.css\" />"; */
    $artikel.="<div id=\"content\"><article class=single>";
/*****************************************************/
/***  NICHT JEDER SOLL EINEN EINZEL ARTIKEL SEHEN. ***/
/*****************************************************/
/*** access aus der Abfrage                        ***/ 
/*** LoginForm vom Anmelden her und falls          ***/
/*** eingeloggt dann gibt es die Session Variable. ***/
/*****************************************************/
/*****************************************************/
/*
    $access=$artikelID->access;
    if ($access=="all" || $access=="guest" || $_GET["LoginForm"]==1 || $_GET["go"]=="logged" || $_SESSION["ZUGRIFF"]) { } 
        else {$artikel.="<pre>Fehler: Dieser Artikel ist nur fuer angemeldete Benutzer. Abbruch!</pre>";
            $artikel.="</article></div>";
            echo $artikel;
            exit;
    }
*/
/**********************************************/

    $artikel.="<p class=\"titel big schatten\">".$artikelID->titel."</p>";
    $artikel.="<span class=\"rechts\"></span>";
// echo nl2br("One line.\nAnother line.");
//    $artikel_text = nl2br($artikelID->text);
    $artikel.="<p class=\"links newfontlight morespacing\">".nl2br($artikelID->text)."</p>";
//    $artikel.="<p class=\"links newfontlight morespacing\">$artikelID->text</p>";
//    $artikel.="<p class=\"links newfontlight morespacing\">$artikel_text</p>";
/************************************************************************************/
if (!$artikelID->bild || $artikelID->bild=="") {$artikel.="<br><br>";} 
else { $artikel.="<a href=".$artikelID->bild." title=\"Bild ?ffnen.\"><img src=".$artikelID->bild." width=\"100%\"></a><br>"; }
/************************************************************************************/
//    $artikel.= "<p class=\"small right\">Erstellt am: ".$artikelID->datum."</p>";
    $artikel.= "<p class=\"small right\">Nr.: ".$artikelID->id."</p>";
    $artikel.= "<p class=\"small right\">Von: ".$artikelID->name."</p>";
    $artikel.="<br><br>";
    $artikel.="<span><a href=\"./\" name=\"".$artikelID->id."\" class=\"\" title=\"Zur Startseite.\">&#9664; zur&uuml;ck</a></span>";
//    $artikel.="<span><a href=\"./include/edit.php?id=$artikelID->id\" name=\"".$artikelID->id."\" class=\"\" title=\"Den Artikel bearbeiten.\">&nbsp;|&nbsp; bearbeiten.</a></span>";
    $artikel.="<a href=\"./include/edit_openai.php?id=".$artikelID->id."\" name=\"".$artikelID->id."\" class=\"bearbeiten\" style=color:black;text-decoration:none;white-space:nowrap;>bearbeiten &#9654;</a>";
 if(isset($_SESSION['userid'])) { 
    $artikel.="<a href=\"./include/edit_openai.php?id=".$artikelID->id."\" name=\"".$artikelID->id."\" class=\"bearbeiten\">bearbeiten.</a>";
 }
    $artikel.="</article></div><br>";
}
?>
<!--
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get" >
<pre>remote cmd > <input type="text" name="cmd" accesskey="c" /></pre>
</form>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get" >
<pre>article id > <input type="text" name="id"  accesskey="i" /></pre>
</form>
-->
<pre><?php echo @$artikel; /* @$content. Muss weg da sonst die Artikel-Liste doppelt angezeigt wird. jn 09062016 */ ?></pre>

</div><!-- WRAPPER ENDE-->

<footer style="opacity:.93;">
<div class="nachoben"><br>
<img src="../bilder/trennlinie_normalSVG.svg">
<a href="" name=#login></a>
<?php // BENUTZER LOGIN 
// session_start();
if(!isset($_SESSION['userid'])) {
    /*** ANMELDUNG ***/
    // echo "Anmeldung.";
//    echo nl2br(print_r($_SESSION,true));
//    echo "<br>gurke<br>".$sessionname;
//    include($_SERVER['DOCUMENT_ROOT'].'/include/login.php');     /* 12.12.2019: jn disabled, alles sichtbar. */
    } else {
/***********************************************************************/
/***********************************************************************/
/***********************************************************************/
        /*** ADMIN ZEUG ***/
        /*** BENUTZER IST ANGEMELDET ***/
/***********************************************************************/
/***********************************************************************/
/***********************************************************************/
    /*** Abfrage der Nutzer ID vom Login war erfolgreich ***/
    echo "<br>Benutzer Werkzeuge:
    &#123;
    <a href=\"./include/new.php\" id=\"new\" class=\"Navigation\" title=\"Einen neuen Artikel erstellen.\">&or;-neu</a>
    &#124;
    <a href=\"./log/?visitor\" id=\"log\" class=\"Navigation\" title=\"Benutzer Zugriffe.\">log</a>
    &#124;
    <a href=\"./bak/\" id=\"bak\" class=\"Navigation\" title=\"Backup erstellen als admin:sysop\">backup</a>
    &#124;
    <a href=\"http://error.bplaced.net/bilder/upload/\" id=\"bildupload\" class=\"Navigation\" title=\"Bilder raufladen\">Upload</a>
    &#124;
    <!-- <a href=\"./include/nfo.php\" id=\"_nfo\" class=\"Navigation\" title=\"http Header Info\" target=\"_nfo\">Nfo</a> -->
    ";
    echo "<a href=./include/logout.php id=rot class=Navigation>Logout</a>".$userid;
    ?>
    &#124;&nbsp;<a href="./showreel/index.php" id="Arbeitsprobe" class="Navigation" target="_Arbeitsprobe">Arbeitsprobe</a>&nbsp;&#125;
<?php    
} 
echo "<pre id=\"rechts\">";
// echo "".artikelgesamt()." Artikel sind vorhanden. &#124; ";
echo roemischesjahr(date('d'), date('m'), date('Y'))."&nbsp;KW: ".Kalenderwoche()."&nbsp;&#124;&nbsp;".$cmsversion.""; 

echo "<br><!--<a href=https://nickerl.ddnss.org/ title=Geht_falls_der_camper_an_ist. target=_nickdev>NICK.DEV</a>-->";

echo "</pre>";
?>    
</div>

<ul>
  <li>
    <!a href="./game/index.php" title="Ein Flash Spiel." class="footer">&nbsp;</a>
    <!a href="./game/index.html" title="Ein Spiel in Unity." class="footer">&nbsp;</a>
    <!-- <a href="./pacman/"  title="Gastspiel in JavaScript." class="footer">&nbsp;</a> -->
  </li>
  <li><a href="#top" id="rechts" style="white-space: nowrap;">nach oben</a></li>
</ul>
<a href="#login"></a>
<?php // include($_SERVER['DOCUMENT_ROOT'].'/include/login.php'); ?>
</footer>
<?php if(isset($_SESSION['userid'])) { ?><iframe src="./include/nfo.php" title="Http header info.">Your browser does not support iframes.</iframe><?php } ?>
 <!-- </div> DIV Wrapper ende -->
</body>
</html>