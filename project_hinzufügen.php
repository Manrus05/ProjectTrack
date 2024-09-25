<?php
require_once 'db.php';

$titel=isset($_POST['titel']) ? $_POST['titel'] : null;
$maxstunden=isset($_POST['maxstunden']) ? $_POST['maxstunden'] : 0;
$deadlein=strtotime($_POST['deadlein']) ? date('Y.m.d', strtotime($_POST['deadlein'])) : null;

if(empty($deadlein) || empty($maxstunden) || empty($titel)){
	header('location: index.php');
	exit;
}

$stmt=$db->prepare("INSERT INTO `project` (`id`, `titel`, `grad`, `deadlein`, `maxstunden`) VALUES 
(NULL, ?, '0', '$deadlein', ?);");
$stmt->bind_param('si',$titel,$maxstunden);
$stmt->execute();
$id=$db->insert_id;

header('location: index.php');
exit;
?>