<h3>Welcome</h3>
<div class="segment">
<p>OpenTKなら「#region OpenTK」へようこそ！業界一番易いだ！</p>
</div>

<h3>[#region OpenTK]について</h3>
<div class="segment">
<p>このサイトはC言語でOpenGLに少しは触れた方、OpenTKの解説が欲しい方がわかるように書いているつもりです。しかし、これからグラフィックスプログラミングを始めたい方にも、C#の解説も含め少しでも協力できたらと思っています。</p>
<p>このサイトはリンクフリーです。また著作権は管理人に帰属します。また、バージョンが変わるなどして、このサイトの記述で正常に動作しない、またはプログラムのバグなどで利用者が被った損害などについて一切保証しません。</p>
<p>このサイトはHTML5とCSS3の要素を一部使用しているため、ブラウザによっては正しい表示がされない場合があります。ご注意ください。また、記事の横幅はフルHD画面の半分にちょうど当てはまるサイズにしています。</p>
<p>このサイトはez-HTMLとEclipseで作成し、IE,GoogleChrome,Firefoxの各最新版で表示の簡単な確認をしています。また、プログラムはMicrosoft Visual Studio 2012 Professionalで作成しています。</p>
<p>このサイトのメインのソースコードはすべてGitHubに置いています。<a href="https://github.com/occar421/region_OpenTK" target="_blank">リンク</a></p>
<p>このサイトではメソッドと呼ぶべきものを関数、プロパティ・フィールドと呼ぶべきものを変数と記述している場合があります。その逆の場合もあります。</p>
</div>

<?php 
require_once 'articles.php';

for ($i = 0; $i < count($titles); $i++){
	print "<h3>" . $i . ":" . $titles[$i]["title"] . "</h3>\n";
	print "<div class=\"segment\">\n";
	print "<p>" . $titles[$i]["description"] . "</p>\n";
	print "<ol class=\"index\">\n";
	for ($j = 0; $j < count($articles[$i]); $j++){
		printf("<li><a href=\"OpenTK%02d-%02d.php%s\">%s</a></li>\n", $i, $j+1, $suffix, $articles[$i][$j]);
	}
	print "</ol>\n</div>\n";
}
?>
