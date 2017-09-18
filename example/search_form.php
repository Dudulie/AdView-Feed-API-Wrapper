<h1>Search for a job</h1>

<form method="GET" action="/index.php?current_page=1">
	<div class="form-group">
		<label for="keyword">Keyword</label>
		<input value="<?PHP echo $request->getKeyword(); ?>"
		       id="keyword"
		       name="keyword"
		       class="form-control"
		       placeholder="keyword or job title">
	</div>

	<div class="form-group">
		<label for="location">Location</label>
		<input value="<?PHP echo $request->getLocation(); ?>"
		       id="location"
		       name="location"
		       class="form-control"
		       placeholder="location or postcode">
	</div>
	<input type="submit" class="btn btn-success" value="Search">
</form>
