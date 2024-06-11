<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div>
        @foreach ($devices as $device)
            <div class="barcode" style="page-break-after: always">
                <img src="{{ public_path('storage/' . $device) }}" alt="" width="25%" height="40%">
            </div>
        @endforeach
    </div>
</body>

</html>
