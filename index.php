<?php require_once 'app.php'; ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">

		<!-- Load CSS Scripts here -->
		<link rel="stylesheet" type="text/css" href="<?php echo $config->path_css; ?>main.css">

		<title><?php echo ucwords($_main); ?></title>
	</head>

	<body>

		<?php include($template_url . 'header.php'); ?>

		<!-- Start of HTML Body-->
		<?php
		try {
			include $template_url . $_main . '.php';
		} catch (Exception $e) {
		    echo 'Something went wrong.';
		}
		?>
		<!-- End of HTML Body-->

		<?php include($template_url . 'footer.php'); ?>

		<!-- Load Javascripts here -->
		<script src="<?php echo $config->path_js; ?>main.js"></script>

	</body>

</html>