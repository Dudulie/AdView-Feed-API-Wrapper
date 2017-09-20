<!doctype html>
<html>
<head>
	<title>AdView Feed API implementation example in PHP</title>

	<script
			src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
			integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g="
			crossorigin="anonymous"></script>

	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
	      rel="stylesheet"
	      integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
	      crossorigin="anonymous">

	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
	      rel="stylesheet"
	      integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
	      crossorigin="anonymous">

	<script type="text/javascript" src="/src/AdView/script.js"></script>
</head>

<body>

<div class="container">
	<?PHP include __DIR__ . '/processor.php'; ?>

	<!-- Lets include search form -->
	<?PHP include __DIR__ . '/search_form.php'; ?>

	<!-- Loop through and show the jobs on site -->
	<?PHP foreach ((array) $jobs as $job): ?>
		<h4>
			<a onmousedown="<?PHP echo $job->onmousedown ?>" href="<?PHP echo $job->url ?>">
				<?PHP echo $job->title; ?>
			</a>
		</h4>
		<h5> <?PHP echo $job->snippet; ?> </h5>
		<span class="fa fa-compass"> <?PHP echo $job->location; ?>  </span>
		<hr>
	<?PHP endforeach; ?>

	<div class="row">
		<div id="pagination" class="col-md-11">
			<b>
				<a class="btn btn-default" id="previous_page" data-current-page="<?PHP echo $paginator->getCurrentPage(); ?>" href="<?PHP echo $paginator->previousPageLink(); ?>">
					Previous
				</a>
				<a class="btn btn-default" href="<?PHP echo $paginator->nextPageLink(); ?>">Next</a>
			</b>
			<hr>
		</div>

		<div class=""><?PHP echo $feed_api->generateTrackingScript(); ?></div>
	</div>

</div>
</body>
</html>
