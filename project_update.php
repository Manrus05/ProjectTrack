<?php
require_once 'db.php';

$id=isset($_POST['id']) ? $_POST['id'] : 0;
$grad=isset($_POST['grad']) ? $_POST['grad'] : 0;
$stunden=isset($_POST['stunden']) ? $_POST['stunden'] : 0;
$nutzername=isset($_POST['nutzername']) ? $_POST['nutzername'] : null;
if(empty($nutzername)){
	header('location: project_bearbeiten.php');
	exit;
}
$stmt=$db->prepare("update project set grad=? where id=? limit 1");
$stmt->bind_param('ii',$grad,$id);
$stmt->execute();

$stmt=$db->prepare("INSERT INTO `mitarbeiter_stunden` (`id`, `projectid`, `nutzername`, `stunden`) VALUES 
(NULL, ?, ?, ?)");
$stmt->bind_param('isi',$id,$nutzername,$stunden);
$stmt->execute();
$id=$db->insert_id;

header('location: index.php');
exit;
?>