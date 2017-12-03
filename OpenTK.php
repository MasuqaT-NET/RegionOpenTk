<?php
require_once 'OpenTK_articles/articles.php';

if(!array_key_exists('url',$_GET)){
	header("HTTP/1.1 404 Not Found");
	include '../../common/404.html';
	exit;
}

$pageName = $_GET['url'];
if($pageName != "index"){
	$buf = explode("-", $pageName);
	$pageL = (int)$buf[0];
	$pageS = (int)$buf[1];
}

print "<!DOCTYPE html>\n";
print "<head>\n";
print <<< META
<meta charset="UTF-8" />
<meta name="keywords" content="OpenTK" />
<meta name="description" content="Graphics Programming on OpenTK" />
<meta name="author" content="MasuqaT"/>
<meta name="copyright" content="Copyright 製作所T" />
<meta name="generator" content="ez-HTML" />
<meta name="generator" content="Eclipse" />
<meta http-equiv="content-language" content="ja" />

META;
if ($pageName == "index"){
	print "<title>Index | #region OpenTK</title>\n";
}
elseif(array_key_exists($pageL, $articles) && array_key_exists($pageS-1, $articles[$pageL])){
	print "<title>" . $pageName . ":" . $articles[$pageL][$pageS-1] . " | #region OpenTK</title>\n";
}
else {
	print "<title>ページが存在しません | #region OpenTK</title>\n";
}

$suffix = "";
$csses = array("flat", "line");
if(array_key_exists('css', $_GET) && in_array($_GET['css'], $csses)){
	print '<link rel="stylesheet" type="text/css" href="OpenTK_misc/' . $_GET['css'] .'.css" media="all" />';
	$suffix = '@' . $_GET['css'];
}else{
	print '<link rel="stylesheet" type="text/css" href="OpenTK_misc/main.css" media="all" />';
}

print <<< CSS_SCRIPT_LINK

<script type="text/javascript" src="OpenTK_misc/shCore.js"></script>
<script type="text/javascript" src="OpenTK_misc/shBrushCSharpOpenTK.js"></script>
<script type="text/javascript" src="OpenTK_misc/shBrushXaml.js"></script>
<script type="text/javascript" src="OpenTK_misc/shBrushIronPython.js"></script>
<script type="text/javascript" src="OpenTK_misc/shBrushGLSL.js"></script>
<script type="text/javascript" src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=MML_HTMLorMML-full"></script>
<link rel="stylesheet" type="text/css" href="OpenTK_misc/shCore.css" />
<link rel="stylesheet" type="text/css" href="OpenTK_misc/shThemeVisualStudio.css" />
<script type="text/javascript">
SyntaxHighlighter.all();
</script>

CSS_SCRIPT_LINK;
print "</head>\n";

print "<body>\n";

print "<div id=\"wrap\">\n";
print <<< HEADER_TAG
<header>
<h1>#region OpenTK</h1>
<p>OpenTKが<a href="https://github.com/opentk/opentk">GitHub</a>で更新されるようになりました。NuGetから手に入れることができるようになりました。<br />
現在は.NET Coreに対応する機運があるようです。</p>
</header>

HEADER_TAG;

print "<div id=\"main\">\n";
if ($pageName == "index"){
	print "<h2>Index</h2>";
	require_once "OpenTK_articles/index.php";
}
elseif(array_key_exists($pageL, $articles) && array_key_exists($pageS-1, $articles[$pageL])){
	$request = sprintf("OpenTK_articles/%02d-%02d.html", $pageL, $pageS);
	if(file_exists($request)){
		print "<h2>" . $articles[$pageL][$pageS-1] . "</h2>\n";
		require $request;
	}else{
		print "記事データが存在しません\n";
	}
}
else {
	print "ページが存在しません\n";
}
print "</div>\n";

print "<div id=\"bar\">\n";
print <<< BAR_STATIC
<!-- shinobi ct2 -->
<script type="text/javascript" src="http://ct2.gouketu.com/sc/1663809"></script>
<noscript><img src="http://ct2.gouketu.com/ll/1663809" border="0" alt="カウンター" /></noscript>
<!-- /shinobi ct2 -->

BAR_STATIC;
print "<h4>記事</h4>\n";
print "<ul>\n";
print "<li><a href=\"OpenTKindex.php$suffix\">Index</a></li>\n";
for($i = 0; $i < count($titles); $i++){
	printf("<li class=\"expander\"><input type=\"checkbox\" id=\"title%02d\" /><label for=\"title%02d\">%02d:%s</label>\n",$i, $i, $i, $titles[$i]['title']);
	print "<ul>\n";
	for($j = 1; $j <= count($articles[$i]); $j++){
		//print "<a href=\"OpenTK" . $i ."-" . $j . ".php\">" . $i . ":" . $j . "</a><br />\n";
		printf("<li><a href=\"OpenTK%02d-%02d.php%s\">%02d:%s</a></li>\n", $i, $j, $suffix, $j, $articles[$i][$j-1]);
	}
	print "</ul>\n</li>\n";
}
print "</ul>\n";

print "<h4>外部リンク</h4>\n";
print "<ul>\n";
for($i=0; $i < count($links); $i++){
	print "<li><a href=\"" . $links[$i]["url"] . "\">" . $links[$i]["title"] . "</a></li>\n";
}
print "</ul>\n";

print "<h4>Thanks</h4>\n";
print "<ul>\n";
for($i=0; $i < count($thanks); $i++){
	print "<li><a href=\"" . $thanks[$i]["url"] . "\">" . $thanks[$i]["title"] . "</a></li>\n";
}
print "</ul>\n";
print "</div>\n";

print <<< FOOTER_TAG
<footer>
<p>&copy; 2012-2017 <a href="http://masuqat.net/">MasuqaT.NET</a></p>
</footer>

FOOTER_TAG;

print "</div>\n"; //wrap

print <<< ANALYZE
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-61676745-2', 'auto');
  ga('send', 'pageview');

</script>
ANALYZE;
?>