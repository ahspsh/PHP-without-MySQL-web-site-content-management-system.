# nomysql-php
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

Introduction to Core Functions
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
tj(“m/test.php”,"Hello, world!");
?>

3.Modification of the contents of the document:
(1)Open the file you want to modify.
(2) Locate the content that needs to be modified.
Dw (Content, Prefix, Postfix);
(3)Submission of amendments.
Example:
<？php
$Filename = "$_GET['ID']";
$content=dw(dk($Filename),"<content>","</content>");//Obtain Text Content

tj();

？>

4. Delete a directory or file:
SC (directory or file);
Example 1: Delete all directories and files in directory a
<？php
sc(“a”);//Danger: DELETED, UNRECOVERABLE!
？>

Example 2: Delete a single file.
<?php
sc("a/test.html");//Danger: Deleted files cannot be recovered!
?>
