<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $device->names->name ?? 'Document' }}</title>
</head>

<body>
    <div class="barcode">
        <img src="{{ asset('storage/' . $qr->barcode) }}" alt="" width="20%" height="30%">
    </div>
</body>

</html>
