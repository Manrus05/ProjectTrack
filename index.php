<?php
require_once 'db.php';

$projecten=array();
$result=$db->query("SELECT p.*, COALESCE(SUM(m.stunden), 0) as stunden 
FROM `project` p 
LEFT JOIN mitarbeiter_stunden m ON m.projectid = p.id 
GROUP BY p.id 
ORDER BY p.id;
");
while($project=$result->fetch_object()){
  $projecten[]=$project;
}
$result->free();

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Project</title>
   <style>
	.project {
		border:1px solid black;
		margin-bottom:1em;
	}
	.titel {
		font-weight:bold;
		background:rgb(200,255,200);
		margin:0.25em 0;
	}
	.grad{
		font-weight:20px;
		background: #a5a5a5;
	}
	.stunden{
		fon-weight:20px;
		background:#18a7ff;
	}
	.maxstunden {
		font-weight:bold;
		margin:0.25em 0;
	}
	.deadlein {
		font-weight:bold;
		margin:0.25em 0;
	}
  </style>
</head>
<body>
<h1>Projecten</h1>
<?php 
foreach($projecten as $project){
	$deadline = strtotime($project->deadlein);
	$today = strtotime(date('d.m.Y'));
	
	if($deadline  <= $today)$color = "red"; 
	else $color = "rgb(200,255,200)";

	if($project->maxstunden <= $project->stunden) $stcolor ="red";
	else $stcolor = "rgb(200,255,200)";
?>
<div class="project" id="project_<?= $project->id ?>"> 
<div class="titel"><?= $project->titel ?></div>
<div class="grad"><?= $project->grad ?>%</div>
<div class="stunden"> <?= $project->stunden ?> stunden</div>
<div class="maxstunden" style="background: <?php echo $stcolor; ?>;">Maximale Arbeitszeit <?= $project->maxstunden?></div>
<div class="deadlein" style="background-color: <?php echo $color; ?>;">Deadlein <?= date('d.m.Y', strtotime($project->deadlein)) ?></div>
<div><a href="project_bearbeiten.php?id=<?= $project->id ?>&grad=<?= $project->grad ?>" >bearbeiten</a></div>
</div>
<?php
}
?>
<h4>Neue Project erstellen</h4>
<form action="project_hinzufügen.php" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
<label> Titel:</label></br><input type="text" name="titel" style="width:150px;" /></br>
<label> Maximale Arbeitszeit:</br>
<input type="text" name="maxstunden" style="width:150px;" /></br>
</label>
<label> Deadlein</br>
<input type="text" name="deadlein" style="width:150px;" placeholder="d.m.Y" /></br>
</label>
	<input type="submit" value="Speichern" />
</form>

<a href="mitarbeiter_stunden.php" >Mitarbeiter Arbeitsstunden</a>
</body>
</html>