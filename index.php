<?php
session_start();
require 'config.php';
require 'LanguageClass.php';

if(!empty($_GET['lang']))
    $_SESSION['lang'] = $_GET['lang'];

$lang = new Language();
?>

<a href="index.php?lang=en">English</a>
<a href="index.php?lang=pt-br">Português</a>
<hr /><br>
<button><?php $lang->get('BUY'); ?></button>
<button><?php $lang->get('LOGOUT'); ?></button>
<h1><?php $lang->get('TITLE'); ?></h1>
<p><?php $lang->get('PARAGRAPH'); ?></p>
<div><?php $lang->get('DIV'); ?></div>
<header><?php $lang->get('HEADER'); ?></header>

<?php $lang->get('CATEGORY') ?>: <?php $lang->get('CATEGORY_PHOTOS'); ?><br>

<hr/>
<?php 
$sql = "SELECT id, (SELECT value FROM lang WHERE lang.lang = :lang AND lang.name = categories.lang_item) as name FROM categories";
$sql = $pdo->prepare($sql);
$sql->bindValue(':lang', $lang->getLanguage());
$sql->execute();

if ($sql->rowCount() > 0) {
    foreach ($sql->fetchAll() as $item) {
        echo $item['name'].'<br>';
    }
}
?>
<hr/>