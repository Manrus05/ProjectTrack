<?php
$id=isset($_GET['id']) ? $_GET['id'] : 0;
$grad=isset($_GET['grad']) ? $_GET['grad'] : 0;
if($id<=0){
	header('location: index.php');
	exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Project Bearbeiten</title>
</head>
<body>
<h1>Bearbeitung</h1>
<form action="project_update.php" method="post" enctype="multipart/form-data" accept-charset="UTF-8">

<input type="hidden" name="id" value="<?= $id ?>" />
<label>Grad ändern:</label></br>
<input type="text" name="grad" value="<?= $grad ?>" style="width:150px;" /></br>

<label>Arbeitszeit eingeben:</label></br>
<input type="text" name="stunden"  style="width:150px;" /></br>

<label>Nutzername eingeben:</label></br>
<input type="text" name="nutzername"  style="width:150px;" />
	</br><input type="submit" value="Speichern" />
</form>
</body>
</html>