<!DOCTYPE html>
<html dir="rtl">
<head>
	<meta charset="utf-8">
</head>
<body>
	<?php
		require_once __DIR__ . '/../src/Ahmedsaoud31/Arabic/Arabic.php';
		use Ahmedsaoud31\Arabic\Arabic;
		echo 'منذ '.Arabic::since('1-1-2015');
	?>
</body>
</html>