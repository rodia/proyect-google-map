<?php
/*------------------------------------------------------------------------
* ZT Template 1.5
* ------------------------------------------------------------------------
* Copyright (c) 2008-2011 ZooTemplate. All Rights Reserved.
* @license - Copyrighted Commercial Software
* Author: ZooTemplate
* Websites:  http://www.zootemplate.com
-------------------------------------------------------------------------*/
header('Content-type: text/css; charset: UTF-8');
header('Cache-Control: must-revalidate');
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 3600) . ' GMT');
$url = $_REQUEST['url'];
?>
div.box-red h3.moduletitle{
	-webkit-border-radius:5px 5px 0 0 ;
	-moz-border-radius:5px 5px 0 0 ;
	border-radius:5px 5px 0 0 ;
}
div.box-red div.modulecontent{
	-webkit-border-radius:5px;
	-moz-border-radius:5px;
	border-radius:5px;
}
.inputbox,
.button{
	-webkit-border-radius:5px;
	-moz-border-radius:5px;
	border-radius:5px;
}
.jv-proshow{
	-webkit-border-radius:5px;
	-moz-border-radius:5px;
	border-radius:5px;
}
div.latestnews div.latestnewsitems,
#menusys_mega li.hasChild  ul a {
	-moz-transition: all 0.5s ease 0s;
	-webkit-transition: all 0.5 ease 0s;
	-o-transition: all 0.5s ease 0s;
}

div.latestnews div.latestnewsitems:hover,
#menusys_mega li.hasChild  ul a:hover ,
#menusys_mega li.hasChild  ul a:active,
#menusys_mega li.hasChild  ul a:focus,
#menusys_mega li.hasChild  ul.mega-ul  a.active:hover{
	-webkit-transition: all 0.1s ease 0s;
     -moz-transition: all 0.1s ease 0s;
    -o-transition: all 0.1s  ease 0s;
}
