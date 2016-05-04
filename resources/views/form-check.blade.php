<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
	<form action="{{ route('admin::testpost') }}" method="post" enctype="multipart/form-data">
	{!! csrf_field() !!}
		<input type="hidden" name="type" value="resume">
		<input type="hidden" name="fileCount" value="5">
		<input type="hidden" name="totalCount" value="10">
		<input type="file" name="file" value="" placeholder="">
		<input type="submit" name="" value="">
	</form>
</body>
</html>