<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Material Informatique</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body class="container">
    <h1>Edit Material Informatique</h1>

    <form method="POST" action="{{ route('update_materiel', ['id' => $materiel->Num_Inv]) }}">
        @csrf
        @method('PUT') <!-- Use the PUT method for updates -->

        <div class="mb-3">
            <label for="num_inv" class="form-label">Inventory Number</label>
            <input type="text" class="form-control" id="num_inv" name="num_inv" value="{{ $materiel->Num_Inv }}" required>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <input type="text" class="form-control" id="type" name="type" value="{{ $materiel->type }}" required>
        </div>

        <div class="mb-3">
            <label for="marque" class="form-label">Marque</label>
            <input type="text" class="form-control" id="marque" name="marque" value="{{ $materiel->marque }}" required>
        </div>

        <div class="mb-3">
            <label for="date_dacquisition" class="form-label">Date D'acquisition</label>
            <input type="date" class="form-control" id="date_dacquisition" name="date_dacquisition" value="{{ $materiel->dateDacquisition }}" required>
        </div>

        <div class="mb-3">
            <label for="ef" class="form-label">End of Life</label>
            <input type="date" class="form-control" id="ef" name="ef" value="{{ $materiel->EF }}" required>
        </div>

        <div class="mb-3">
            <label for="etat" class="form-label">Etat</label>
            <input type="text" class="form-control" id="etat" name="etat" value="{{ $materiel->etat }}" required>
        </div>

        <!-- Add more fields as needed -->

        <button type="submit" class="btn btn-primary">Update Material</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>