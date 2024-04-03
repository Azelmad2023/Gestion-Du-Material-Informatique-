<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
    <style>
        body {
            background-color: #423a8e;
            color: #fff;
        }

        .dashboard-header {
            background-color: #00cccd;
            padding: 20px;
            text-align: center;
        }

        .commune-button,
        .etablissement-button {
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .commune-button:hover{
            background-color: black;

        }
        .etablissement-button:hover {
            background-color: #00cccd;
            color: #423a8e;
        }

        .commune-button {
            background-color: #ffc107;
            color: #423a8e;
        }

        .etablissement-button {
            background-color: #dc3545;
            color: #fff;
        }

        .materiel-table {
            margin-top: 10px;
        }
    </style>
</head>

<body class="container">
    <div class="dashboard-header">
        <h3>Welcome, {{ Auth::guard('admin')->user()->name }}!</h3>
        <a class="btn btn-danger" href="{{ route('admin.logout') }}">Log Out</a>
    </div>

    <h1 class="mt-4">Admin Dashboard</h1>
    <div class="container">
        @foreach($communes as $commune)
            <div class="mb-3">
                <button class="btn commune-button col-12 mb-2" type="button" data-bs-toggle="collapse"
                    data-bs-target="#commune{{ $commune->codeCommune }}" aria-expanded="false"
                    aria-controls="commune{{ $commune->codeCommune }}">
                    Commune: {{ $commune->nomcommune_AR }}
                </button>

                <div class="collapse" id="commune{{ $commune->codeCommune }}">
                    @foreach($commune->etablissements as $etablissement)
                    {{-- <a href="{{ route('add_material_form', ['id' => $etablissement->id]) }}">add</a> --}}
                    <a href="{{ route('add_materail_form', ['id'=>$etablissement->id]) }}">add</a>
                    <a href="{{ route('generate_pdf', ['etablissementId' => $etablissement->id]) }}">Imprimer</a>
                        <button class="btn etablissement-button col-12 mb-2" type="button" data-bs-toggle="collapse"
                            data-bs-target="#etablissement{{ $etablissement->id }}" aria-expanded="false"
                            aria-controls="etablissement{{ $etablissement->id }}">
                            Etablissement: {{ $etablissement->name }}
                        </button>

                        <div class="collapse" id="etablissement{{ $etablissement->id }}">
                            <table class="table materiel-table">
                                <thead>
                                    <tr>
                                        <th>Inventory Number</th>
                                        <th>Type</th>
                                        <th>Brand</th>
                                        <th>Acquisition Date</th>
                                        <th>End of Life</th>
                                        <th>State</th>
                                        <th>Actions</th>
                                        <!-- Add more columns as needed -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($etablissement->materielInformatiques as $materiel)
                                        <tr>
                                            <td>{{ $materiel->Num_Inv }}</td>
                                            <td>{{ $materiel->type }}</td>
                                            <td>{{ $materiel->marque }}</td>
                                            <td>{{ $materiel->dateDacquisition }}</td>
                                            <td>{{ $materiel->EF }}</td>
                                            <td>{{ $materiel->etat }}</td>
                                            <td>
                                                <form action="{{ route('delete_materiel', ['id' => $materiel->Num_Inv]) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                                <a href="{{ route('edit_materiel', ['id' => $materiel->Num_Inv]) }}">Edit</a>

                                            </td>
                                            <!-- Add more columns as needed -->
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
