<!DOCTYPE html>
<html>
<head>
    <title>Texto Extraído</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <form action="{{ route('prueba.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="imagen">Imagen</label>
            <input type="file" class="form-control-file" id="imagen" name="imagen" required>
        </div>
        <button type="submit" class="btn btn-primary">Extraer Texto</button>
    </form>
    @if (isset($texto))
        <div class="card mt-5">
            <div class="card-header">
                Texto Extraído
            </div>
            <div class="card-body">
                {{ $texto }}
            </div>
        </div>
    @endif



    @if($pagado === true)
{{--        mensaje de pago--}}
        <div class="alert alert-success mt-5" role="alert">
            <h4 class="alert-heading">Esta factura fue pagada!</h4>
        </div>
    @endif

    @if($pagado === false)
{{--        factura pagada--}}
        <div class="alert alert-success mt-5" role="alert">
            <h4 class="alert-heading">Esta factura se encuentra pagada!</h4>
        </div>
    @endif

</div>
</body>
</html>
