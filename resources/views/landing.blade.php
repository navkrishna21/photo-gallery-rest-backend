<!DOCTYPE html>
<html>
	<head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width,initial-scale=1.0">
	    <meta name="csrf-token" content="{{csrf_token()}}">
	    <title>Image Gallery</title>
	    <link href=" {{ mix('css/app.css') }}" rel="stylesheet">
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.css" />
	</head>
	<body>
	      <div id="app"><app></app></div>
	      <script src="{{ mix('js/bootstrap.js') }}"></script>
	      <script src="{{ mix('js/app.js') }}"></script>
	      <!-- built files will be auto injected -->
	</body>
</html>