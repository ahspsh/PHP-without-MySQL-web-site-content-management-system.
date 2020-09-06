#PHP-without-MySQL-web-site-content-management-system.

System introduction:
Compact, flexible and efficient.

Directly generate and edit static suitable for small or micro-site build.




Directory structure:
Function directory: "C".
Template directory: "m".

Introduction of documents:
c/c.php
This is the core function file.
Call Core File
<?php 
require ($_SERVER['DOCUMENT_ROOT'].'/c/c.php');
?>

Introduction to Core Functions:


1. Open a file.

dk (file path and name);
Example:
<？php
echo dk(“m/index.php”);
?>

2. Add a file.

tj(file path and name,content);

Example:
<？php
tj(“a/test.html”,"Hello, world!");
?>

3.Obtain the desired content in the file (used to modify the file content or collection, can also be cross-site data processing)
Grammar:
dw(content,Front Positioning Marker,Rear Positioning Marker)



4.Modification of the contents of the document:
(1)Open the file you want to modify.
(2) Locate the content that needs to be modified.
Dw (Content, Prefix, Postfix);
(3)Submission of amendments.
Example:
<？php
$Filename = "$_GET['ID']";
$content=dw(dk($Filename),"<content>","</content>");//Obtain Text Content

//$Content[1][0]Send to the form for modification, assuming: $_POST["content"] Form Submission"
$a["[t]"]="title";
$a["[d]"]="Web Page Description";
$a["[k]"]="Web Page Keyword";
$a["[c]"]=$_POST["content"];


tj($Filename,th(dk(“m/index.php”),$a));

？>

5. Delete a directory or file:
SC (directory or file);
Example 1: Delete all directories and files in directory a
<？php
sc(“a”);//Danger: DELETED, UNRECOVERABLE!
？>

Example 2: Delete a single file.
<?php
sc("a/test.html");//Danger: Deleted files cannot be recovered!
?>
6. Query whether a file exists:
cz (file path and name);

7.The characters contain:
bh (content, keyword);

8.File List:

Assume the file directory is a.

<?php
$g=glob(“a/*”);//a List all folders and files in alphabetical order under the.
$g=glob(“a/*.html”);All HTML files in the a directory
$g=glob("a/a*.html");A directory for all HTML files beginning with a
$g=glob("a/a1.html");The A1 file under the a directory.




？>
