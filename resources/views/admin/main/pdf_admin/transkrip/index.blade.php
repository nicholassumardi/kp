<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>

<body>
    @foreach ($product as $pd)
    <img src="storage/{{$pd->path_foto_kuitansi}}"
        style="width: 450px; height: 300px;">
        <br><br>
    @endforeach

    {{-- <img src="storage/{{$product->path_foto_mahasiswa}}" style="width: 400px; height: 400px;"> --}}


</body>

</html>