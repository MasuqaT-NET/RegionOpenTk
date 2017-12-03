<?php
$object = json_decode(file_get_contents("OpenTK_articles/articles.json"), true);

$articles = $object["articles"];
$titles = $object["titles"];
$links = $object["links"];
$thanks = $object["thanks"];
?>