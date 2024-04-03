<!-- resources/views/etablissement/pdf.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etablissement PDF</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Include any additional styles or meta tags needed for your PDF -->
</head>
<body>

    <h1>Etablissement Materiel Informatique List</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Inventory Number</th>
                <th>Type</th>
                <th>Brand</th>
                <th>Acquisition Date</th>
                <th>End of Life</th>
                <th>State</th>
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

    <!-- You can customize the content and styling based on your requirements -->

    <!-- Include Bootstrap JS if needed -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
