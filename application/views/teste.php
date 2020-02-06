<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<script type="text/javascript">
	var blob = new Blob(["Hello, world!"], { type: 'text/plain' });
	var blobUrl = URL.createObjectURL(blob);

	var xhr = new XMLHttpRequest;
	xhr.responseType = 'blob';

	xhr.onload = function() {
	   var recoveredBlob = xhr.response;

	   var reader = new FileReader;

	   reader.onload = function() {
	     var blobAsDataUrl = reader.result;
	     window.location = blobAsDataUrl;
	   };

	   reader.readAsDataURL(recoveredBlob);
	};

	xhr.open('GET', blobUrl);
	xhr.send();
	alert(blobUrl);
</script>
</body>
</html>