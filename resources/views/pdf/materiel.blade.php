<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>
<style>
    .table-container {
        overflow-x: auto;
        margin-top: 20px;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        font-size: 14px;
    }

    th, td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }
</style>
</head>
<body>
<div class="container mt-4 table-container">
    <h2>Materiel Informatiques Table</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Inventory Number</th>
                    <th>Type</th>
                    <th>Brand</th>
                    <th>Acquisition Date</th>
                    <th>End of Life</th>
                    <th>State</th>
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
                        <!-- Add more columns as needed -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
