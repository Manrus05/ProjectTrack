<?php
require_once 'db.php';

$nutzern=array();
$result=$db->query("SELECT m.nutzername, m.projectid, p.titel, COALESCE(SUM(m.stunden), 0) as stunden 
FROM mitarbeiter_stunden m 
LEFT JOIN project p ON p.id = m.projectid 
GROUP BY m.nutzername, m.projectid, p.titel 
ORDER BY m.nutzername, m.projectid;
");
while($nutzer=$result->fetch_object()){
  $nutzern[]=$nutzer;
}
$result->free();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Arbeitszeiten</title>
</head>
<body>
<h1>Arbeitszeiten</h1>
<table border="1" cellspacing="0" style="border-collapse:collapse;">
<tr>
    <th>Mitarbeiter</th>
	<th>Projekt</th>
	<th>Stundenanzahl</th>
  </tr>
<?php
foreach($nutzern as $nutzer){
?>
<tr>
    <th><?= $nutzer->nutzername?></th>
	<td><?= $nutzer->titel ?></td>
	<td><?= $nutzer->stunden ?></td>
  </tr>
<?php
}
?>
</table>
<a href="index.php" >Startseite-></a>
</body>
</html>