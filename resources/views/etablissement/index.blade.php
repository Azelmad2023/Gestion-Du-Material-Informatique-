<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>
<body class="bg-primary text-white">

    @if (session('error'))
        <div class="alert alert-danger mb-0" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="container mt-4 ">
        <h3 class="mb-4">Name of the Etablissement: {{ Auth::guard('etablissement')->user()->name }}</h3>
        <a href="{{ route('etablissement.logout') }}" class="btn btn-danger mb-4">Log Out</a>

        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Materiel Informatique List</h1>
                <a href="{{ route('etablissement.add_material_form') }}" class="btn btn-success mb-4">Add Material</a>
                <a href="{{ route('etablissement.pdf') }}" class="btn mb-4 btn-warning">Imprimer</a>
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Inventory Number</th>
                            <th scope="col">Type</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Acquisition Date</th>
                            <th scope="col">End of Life</th>
                            <th scope="col">State</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($etablissementWithMateriel->materielInformatiques as $materiel)
                            <tr>
                                <td>{{ $materiel->Num_Inv }}</td>
                                <td>{{ $materiel->type }}</td>
                                <td>{{ $materiel->marque }}</td>
                                <td>{{ $materiel->dateDacquisition }}</td>
                                <td>{{ $materiel->EF }}</td>
                                <td>{{ $materiel->etat }}</td>
                                <!-- Add more columns as needed -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
