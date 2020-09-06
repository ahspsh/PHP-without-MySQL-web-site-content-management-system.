<?php 
require ($_SERVER['DOCUMENT_ROOT'].'/c/c.php');//Call Core Function

$a['[t]']="Without MYSQL CMS";//Set Home Title
$a['[d']="Introduction to the website";//Introduction to Setting Up a Web Site
$a['[k]']="Keyword";//Set Site Keyword
$c[]="Text 1<br />";
$c[]="Text 2<br />";
$c[]="More content…<br />";
$a['[c]']=hc($c);//String composition of text content

echo th(dk($_SERVER['DOCUMENT_ROOT'].'/m/index.php'),$a);//Open the template and make a template tag replacement,And output to the page.
?>
