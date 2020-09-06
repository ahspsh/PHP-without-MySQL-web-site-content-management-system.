<?php
session_start();
set_time_limit (0);
date_default_timezone_set("PRC");
function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0)
{
// 动态密匙长度，相同的明文会生成不同密文就是依靠动态密匙
$ckey_length = 4;

// 密匙
$key = md5($key ? $key : $GLOBALS['discuz_auth_key']);

// 密匙a会参与加解密
$keya = md5(substr($key, 0, 16));
// 密匙b会用来做数据完整性验证
$keyb = md5(substr($key, 16, 16));
// 密匙c用于变化生成的密文
$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length) :
substr(md5(microtime()), -$ckey_length)) : '';
// 参与运算的密匙
$cryptkey = $keya . md5($keya . $keyc);
$key_length = strlen($cryptkey);
// 明文，前10位用来保存时间戳，解密时验证数据有效性，10到26位用来保存$keyb(密匙b)，
//解密时会通过这个密匙验证数据完整性
// 如果是解码的话，会从第$ckey_length位开始，因为密文前$ckey_length位保存 动态密匙，以保证解密正确
$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0) . substr(md5($string . $keyb), 0, 16) . $string;
$string_length = strlen($string);
$result = '';
$box = range(0, 255);
$rndkey = array();
// 产生密匙簿
for ($i = 0; $i <= 255; $i++) {
$rndkey[$i] = ord($cryptkey[$i % $key_length]);
}
// 用固定的算法，打乱密匙簿，增加随机性，好像很复杂，实际上对并不会增加密文的强度
for ($j = $i = 0; $i < 256; $i++) {
$j = ($j + $box[$i] + $rndkey[$i]) % 256;
$tmp = $box[$i];
$box[$i] = $box[$j];
$box[$j] = $tmp;
}
// 核心加解密部分
for ($a = $j = $i = 0; $i < $string_length; $i++) {
$a = ($a + 1) % 256;
$j = ($j + $box[$a]) % 256;
$tmp = $box[$a];
$box[$a] = $box[$j];
$box[$j] = $tmp;
// 从密匙簿得出密匙进行异或，再转成字符
$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
}
if ($operation == 'DECODE') {
// 验证数据有效性，请看未加密明文的格式
if ((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyb), 0, 16)) {
return substr($result, 26);
} else {
return '';
}
} else {
// 把动态密匙保存在密文里，这也是为什么同样的明文，生产不同密文后能解密的原因
// 因为加密后的密文可能是一些特殊字符，复制过程可能会丢失，所以用base64编码
return $keyc . str_replace('=', '', base64_encode($result));
}
}







//函数authcode($string, $operation, $key, $expiry)中的$string：字符串，明文或密文；$operation：DECODE表示解密，其它表示加密；$key：密匙；$expiry：密文有效期。




	function curl($url){
           //初始化
        $ch = curl_init();
        //设置选项，包括URL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // https请求 不验证证书和hosts
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        
        $output = curl_exec($ch); //执行并获取HTML文档内容
        //$str = htmlspecialchars($output);//转换为源代码形式
        //释放curl句柄
        curl_close($ch);
    return  $output ;
    }
function kzm($path){//获取扩展名
	$a =pathinfo($path);
return($a['extension']);
}


function hdtp($content,$order=0){
    $pattern="/<img.*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png|\.jpeg|\.?]))[\'|\"].*?[\/]?>/";
    preg_match_all($pattern,$content,$match);
    if(!empty($match[1])){
        if($order == 0){
            return $match[1];
        }
        if(!empty($match[1][$order-1])){
            return $match[1][$order-1];
        }
    }
    return $match[1];
}



function fml($path){//获得父目录
	$path = str_replace('\\','/', rtrim($path,'/'));
	$pos = strrpos($path,'/');
	if($pos === false){
		return $path;
	}
	return substr($path, 0,$pos+1);
}

function wjm($path){//获取文件名
		$a =pathinfo($path);
return($a['filename'] );
	
}
  function lj($lj){//获得某网页全部链接
	$html = dk($lj);
 
$dom = new DOMDocument();
@$dom->loadHTML($html);
 $xpath = new DOMXPath($dom);
$hrefs = $xpath->evaluate("/html/body//a");
 
for ($i = 0; $i < $hrefs->length; $i++) {
       $href = $hrefs->item($i);
    $url[] = $href->getAttribute('href');
    
}
return $url;
}


function bl($dir = '*_')
{ //遍历
    $dirInfo = array();
    foreach (glob($dir, GLOB_NOSORT) as $v) {
        
        if (!is_dir($v) ) {
              $dirInfo[] = $v;
        
        }

        if (is_dir($v)) {
			 $dirInfo[] = $v;
            $dirInfo = array_merge($dirInfo, bl($v . '/*'));
        }
       
        
    }

    return $dirInfo;
}

function bqy($a)
{ //标签云
    $bqy = array();
    foreach ($a as $v) {
        
       $bqy[]= '<a href="/index.php?bq='.$v.'" title="'.$v.'">'.$v.'</a>';
        
}
    return $bqy;
}
function ss($s,$dir="*_")
{ //搜索
$ss=array();
    foreach (bl($dir) as $v) {
        if (is_dir($v) ) {
          if(bh(bm($v),$s)) { 
              $ss[] = '<a target="_blank" href="'.bm($v).'" title="'.bm($v).'">'.bm($v).'</a>';
       
        }
        }
        if (!is_dir($v)) {
           
        if(bh(bm($v),$s)) { 
             $ss[] = '<a target="_blank" href="'.bm($v).'" title="'.bm($v).'">'.bm($v).'</a>';
        }
              if(bh(dk($v),$s)) { 
               $b= dw(dk($v),'<title>','</title>');
                
              $ss[] = '<a target="_blank" href="'.bm($v).'" title="'.$b[1][0].'">'.$b[1][0].'</a>';
              
        }
        }
    }
    
    
    return qc($ss);
   
}
function ml( $dir ){    //生成目录
 if(!cz($dir)){
   return   mkdir ( $dir , 0777);
 }
}
 function lmbl($dir){  //目录遍历
    $files=array();   
    $queue=array($dir);  
    while($data=each($queue)){  
        $path=$data['value'];  
        if(is_dir($path) && $handle=opendir($path)){  
            while($file=readdir($handle)){  
                if($file=='.'||$file=='..') continue;  
                $files[] = $real_path=$path.'/'.$file;  
                if (is_dir($real_path)) $queue[] = $real_path;  
            }  
        }  
        closedir($handle);  
    }  
     return $files;  
     
     
     
} 


 
function mls($shu='25',$jb='1',$bs="a",$wjm=".html") //目录生成
{
$x=count(glob("$bs*/$bs*"));
$y=count(glob("$bs*/$bs*/$bs*"));
$z=count(glob("$bs*/$bs*/$bs*/$bs*"));
$a="$bs".floor($x/$shu);
$b="/$bs".floor($y/$shu);
$c="/$bs".floor($z/$shu);
if($jb==1){
return $a."/$bs".$x."/".$wjm;
}
if($jb==2){
return $a.$b."/$bs".$y."/".$wjm;
}
if($jb==3){
return $a.$b.$c."/$bs".$z."/".$wjm;
}
}
function caiji($wz,$dq,$dh,$ljq,$ljh,$lj) //内容采集
{
//print_r(bl('a0'));
$s=dk($wz);

$d=dw($s,$dq,$dh);
$i=dw($d[1][0],$ljq,$ljh);
//print_r($i);
foreach($i as $k=> $v){
    if($k!=0){
   // echo $i[$k][0];
   $img=dw($i[$k][0],'.') ;

   tj($lj.md5($i[$k][0]).'.'.end($img),dk( $i[$k][0]));
   $a[$i[$k][0]]=md5($i[$k][0]).'.'.end($img);
}
    
}

return th($d[1][0],$a);
}
function bh($s_fu, $s_zi) //字符串包含
{
    if($s_zi!=""){
    return stristr($s_fu, $s_zi);
    }
}

function dk($l) //打开一个链接或文件，返回字符串
{
    if (bh($l, 'http')) {

        return curl($l);

    } else {

        return @file_get_contents($l);
    }


}

function dw($s, $q = "", $h = "", $id = "") //定位字符
{
	
    if ($h == "") {

        $a = explode($q, $s);
        return $a;

    } else {
        $ass = explode($q, $s);
        foreach ($ass as $v) {
            $as[] = explode($h, $v);

        }
		
		
        if ($id == "") {

            return $as;
        } else {
            return $as[$id];
        }

    }
}
function tj($l,$s, $zhuijia = "") //添加内容
{
   if(!cz(dirname($l))){
    mkdir(dirname($l), 0777, true);
}
    if ($zhuijia == "") {
        file_put_contents($l, $s);
    } else {
        file_put_contents($l, $s, FILE_APPEND);

    }
}


function hc($a, $q = "", $h = "") //数组合成字符串
{
    if(is_array($a)){
    return $q . implode($h . $q, $a) . $h;
    }

}
function kg($s,$q = array(" ", "　","\t","\n","\r\n","\r"),$h = "") //删除空格
{
    return str_replace($q, $h, $s);
}

function th($s, $a) //替换
{
    return strtr($s, $a);
}

function cd($s)//字符长度
{ 
    return mb_strlen($s, 'UTF8');

}
function zh($s) //字符转html
{
    return htmlspecialchars($s);
}
function zt($s) //html转字符
{
    return htmlspecialchars_decode($s);
    ;
}

function ups($dir,$name,$allowedExts,$size)//文件上传
 {
foreach ($_FILES["file"]["name"] as $k=> $v) {
    
    $temp = explode(".", $_FILES["file"]["name"][$k]);
$extension = end($temp);
    
  if (($_FILES["file"]["size"][$k] < $size)&& in_array($extension, $allowedExts)) {  
     if (file_exists($dir. bm($_FILES["file"]["name"][$k])))
 {
	 echo "<script> alert('".$_FILES["file"]["name"][$k] ."文件已经存在！请修改文件名');location.href='".$_SERVER["HTTP_REFERER"]."'; </script> ";

 }
 else
 {
 tj($dir. bm($_FILES["file"]["name"][$k]),dk($_FILES["file"]["tmp_name"][$k]) )  ;
  echo "<script> alert('文件成功上传至:". $dir. $_FILES["file"]["name"][$k]."');location.href='".$_SERVER["HTTP_REFERER"]."'; </script> ";
 }
 
 }
    
    }
}
function up($dir,$allowedExts,$size)//文件上传
 {
	 
/* .doc     application/msword
.docx   application/vnd.openxmlformats-officedocument.wordprocessingml.document
.rtf       application/rtf
.xls     application/vnd.ms-excel	application/x-excel
.xlsx    application/vnd.openxmlformats-officedocument.spreadsheetml.sheet
.ppt     application/vnd.ms-powerpoint
.pptx    application/vnd.openxmlformats-officedocument.presentationml.presentation
.pps     application/vnd.ms-powerpoint
.ppsx   application/vnd.openxmlformats-officedocument.presentationml.slideshow
.pdf     application/pdf
.swf    application/x-shockwave-flash
.dll      application/x-msdownload
.exe    application/octet-stream
.msi    application/octet-stream
.chm    application/octet-stream
.cab    application/octet-stream
.ocx    application/octet-stream
.rar     application/octet-stream
.tar     application/x-tar
.tgz    application/x-compressed
.zip    application/x-zip-compressed
.z       application/x-compress
.wav   audio/wav
.wma   audio/x-ms-wma
.wmv   video/x-ms-wmv
.mp3 .mp2 .mpe .mpeg .mpg     audio/mpeg
.rm     application/vnd.rn-realmedia
.mid .midi .rmi     audio/mid
.bmp     image/bmp
.gif     image/gif
.png    image/png
.tif .tiff    image/tiff
.jpe .jpeg .jpg     image/jpeg
.txt      text/plain
.xml     text/xml
.html     text/html
.css      text/css
.js        text/javascript
.mht .mhtml   message/rfc822 */	 
	 
if(isset($_POST['tj'])){
	foreach ($_FILES['file']['name'] as $k=> $v ){
		
	
	tj("up/".$_FILES['file']['name'][$k],dk($_FILES['file']['tmp_name'][$k]));
	
	}
	}
 
 }
 
 

function setWater($imgSrc,$markImg,$markText,$TextColor,$markPos,$fontType,$markType)//图片水印
{
    
    
 /**
$imgSrc：目标图片，可带相对目录地址，
$markImg：水印图片，可带相对目录地址，支持PNG和GIF两种格式，如水印图片在执行文件mark目录下，可写成：mark/mark.gif
$markText：给图片添加的水印文字
$TextColor：水印文字的字体颜色
$markPos：图片水印添加的位置，取值范围：0~9
0：随机位置，在1~8之间随机选取一个位置
1：顶部居左 2：顶部居中 3：顶部居右 4：左边居中
5：图片中心 6：右边居中 7：底部居左 8：底部居中 9：底部居右
$fontType：具体的字体库，可带相对目录地址
$markType：图片添加水印的方式，img代表以图片方式，text代表以文字方式添加水印
  */
  $srcInfo = @getimagesize($imgSrc);
  $srcImg_w  = $srcInfo[0];
  $srcImg_h  = $srcInfo[1];
     
  switch ($srcInfo[2]) 
  { 
    case 1: 
      $srcim =imagecreatefromgif($imgSrc); 
      break; 
    case 2: 
      $srcim =imagecreatefromjpeg($imgSrc); 
      break; 
    case 3: 
      $srcim =imagecreatefrompng($imgSrc); 
      break; 
    default: 
      die("不支持的图片文件类型"); 
      exit; 
  }
     
  if(!strcmp($markType,"img"))
  {
    if(!file_exists($markImg) || empty($markImg))
    {
      return;
    }
       
    $markImgInfo = @getimagesize($markImg);
    $markImg_w  = $markImgInfo[0];
    $markImg_h  = $markImgInfo[1];
       
    if($srcImg_w < $markImg_w || $srcImg_h < $markImg_h)
    {
      return;
    }
       
    switch ($markImgInfo[2]) 
    { 
      case 1: 
        $markim =imagecreatefromgif($markImg); 
        break; 
      case 2: 
        $markim =imagecreatefromjpeg($markImg); 
        break; 
      case 3: 
        $markim =imagecreatefrompng($markImg); 
        break; 
      default: 
        die("不支持的水印图片文件类型"); 
        exit; 
    }
       
    $logow = $markImg_w;
    $logoh = $markImg_h;
  }
     
  if(!strcmp($markType,"text"))
  {
    $fontSize = 16;
    if(!empty($markText))
    {
      if(!file_exists($fontType))
      {
        return;
      }
    }
    else {
      return;
    }
       
    $box = @imagettfbbox($fontSize, 0, $fontType,$markText);
    $logow = max($box[2], $box[4]) - min($box[0], $box[6]);
    $logoh = max($box[1], $box[3]) - min($box[5], $box[7]);
  }
     
  if($markPos == 0)
  {
    $markPos = rand(1, 9);
  }
     
  switch($markPos)
  {
    case 1:
      $x = +5;
      $y = +5;
      break;
    case 2:
      $x = ($srcImg_w - $logow) / 2;
      $y = +5;
      break;
    case 3:
      $x = $srcImg_w - $logow - 5;
      $y = +15;
      break;
    case 4:
      $x = +5;
      $y = ($srcImg_h - $logoh) / 2;
      break;
    case 5:
      $x = ($srcImg_w - $logow) / 2;
      $y = ($srcImg_h - $logoh) / 2;
      break;
    case 6:
      $x = $srcImg_w - $logow - 5;
      $y = ($srcImg_h - $logoh) / 2;
      break;
    case 7:
      $x = +5;
      $y = $srcImg_h - $logoh - 5;
      break;
    case 8:
      $x = ($srcImg_w - $logow) / 2;
      $y = $srcImg_h - $logoh - 5;
      break;
    case 9:
      $x = $srcImg_w - $logow - 5;
      $y = $srcImg_h - $logoh -5;
      break;
    default: 
      die("此位置不支持"); 
      exit;
  }
     
  $dst_img = @imagecreatetruecolor($srcImg_w, $srcImg_h);
     
  imagecopy ( $dst_img, $srcim, 0, 0, 0, 0, $srcImg_w, $srcImg_h);
     
  if(!strcmp($markType,"img"))
  {
    imagecopy($dst_img, $markim, $x, $y, 0, 0, $logow, $logoh);
    imagedestroy($markim);
  }
     
  if(!strcmp($markType,"text"))
  {
    $rgb = explode(',', $TextColor);
       
    $color = imagecolorallocate($dst_img, $rgb[0], $rgb[1], $rgb[2]);
    imagettftext($dst_img, $fontSize, 0, $x, $y, $color, $fontType,$markText);
  }
     
  switch ($srcInfo[2]) 
  { 
    case 1:
      imagegif($dst_img, $imgSrc); 
      break; 
    case 2: 
      imagejpeg($dst_img, $imgSrc); 
      break; 
    case 3: 
      imagepng($dst_img, $imgSrc); 
      break;
    default: 
      die("不支持的水印图片文件类型"); 
      exit; 
  }
     
  imagedestroy($dst_img);
  imagedestroy($srcim);
}


function slt($big_img, $width, $height, $small_img) {//原始大图地址，缩略图宽度，高度，缩略图地址
$imgage = getimagesize($big_img); //得到原始大图片
switch ($imgage[2]) { // 图像类型判断
case 1:
$im = imagecreatefromgif($big_img);
break;
case 2:
$im = imagecreatefromjpeg($big_img);
break;
case 3:
$im = imagecreatefrompng($big_img);
break;
}
$src_W = $imgage[0]; //获取大图片宽度
$src_H = $imgage[1]; //获取大图片高度
$tn = imagecreatetruecolor($width, $height); //创建缩略图
imagecopyresampled($tn, $im, 0, 0, 0, 0, $width, $height, $src_W, $src_H); //复制图像并改变大小
imagejpeg($tn, $small_img); //输出图像
}
function bd($a) //表单值给变量
{
    import_request_variables($a);

}
function sj($a="Y-m-d h:i:s") //日期时间
{
    date_default_timezone_set('PRC');
    return date($a); //网站日期和时间

}
function qc($a)//去除数组重复值
{ 
    return array_flip(array_flip($a));
}
function cs($s_fu, $s_zi)//在字符串中出现的次数
{ 
    return substr_count($s_fu, $s_zi);
}
function jm($s)//加密
{ 
    return md5($s . 'QQ290060876');

}
function cz($f) //文件是否存在
{
    return file_exists($f);
}

function szbh($a, $s) //数组包含
{
    return in_array($s, $a);
}
function bm($s)//字符串编码转换
{ 
$encode = mb_detect_encoding($s, array("ASCII", "UTF-8", "GB2312", "GBK","ISO-8859-1", "BIG5"));
if($encode =="UTF-8"){
	return $s;
	}else{

return mb_convert_encoding($s, "UTF-8", $encode);
	}
}
function qchtml($s) //去除html格式
{
    return strip_tags($s);
}
function gm($j, $x) //更改文件名
{
    rename($j, $x);
}

function fz($j, $x) //复制
{
    copy($j, $x);
}
function px($a, $px = "") //排序(默认降序）
{
    if (is_array($a)) {
        foreach ($a as $a) {
            $ttt[filemtime($a)] = $a;
        }
        if ($px == "") {
            krsort($ttt);
            return $ttt;
        } else {
            ksort($ttt);
            return $ttt;
        }
    }
}
function fg($str,$split_length=1,$charset="UTF-8"){
  if(func_num_args()==1){
    return preg_split('/(?<!^)(?!$)/u', $str);
  }
  if($split_length<1)return false;
  $len = mb_strlen($str, $charset);
  $arr = array();
  for($i=0;$i<$len;$i+=$split_length){
    $s = mb_substr($str, $i, $split_length, $charset);
    $arr[] = $s;
  }
  return $arr;
}
function jq($s, $c, $wz = "0") //字符串截取
{
    return substr($s, $wz, $c);
}
function xsd($s1, $s2, $bf="") //字符串相似度
{
    if($bf==""){
    return similar_text($s1, $s2); 
    }else{
        similar_text($s1, $s2, $percent);  
      return   $percent. "%";
    }
}



function gjc($s) //关键词提取
{
    

$a = explode("\r\n", (dk('conn/fenci.txt')));

return  th($s,array_flip($a));
	

   
}




if (isset($_GET['tc'])) { //退出

session_destroy();
    echo "<script> alert('退出成功！');location.href='/index.php'; </script> ";
    
}
function sc($lj) //关键词提取
{
    if (is_dir($lj)) { //删除目录
        foreach (bl($lj) as $v) {
            if (!is_dir($v)) { //删除内容
                unlink($v);
            } else {
                rmdir($v);
            }
        }
        rmdir($lj);

    } else {
        unlink($lj);
        if (count(glob(dirname($lj) . '/*')) == 0) {
            rmdir(dirname($lj));
        }
    }



    
}


function tu($content,$order=0){
    $pattern="/<img.*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png|\.jpeg|\.?]))[\'|\"].*?[\/]?>/";
    preg_match_all($pattern,$content,$match);
    if(!empty($match[1])){
        if($order == 0){
            return $match[1];
        }
        if(!empty($match[1][$order-1])){
            return $match[1][$order-1];
        }
    }

}


?>
