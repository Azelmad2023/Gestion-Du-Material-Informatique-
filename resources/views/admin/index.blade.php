<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Custom CSS -->
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
    <!-- Dashboard Header -->
    <div class="dashboard-header">
        <h3>Welcome, {{ Auth::guard('admin')->user()->name }}!</h3>
        <a class="btn btn-danger" href="{{ route('admin.logout') }}">Log Out</a>
    </div>

    <!-- Main Content -->
    <h1 class="mt-4">Admin Dashboard</h1>

    <div class="container">
        <!-- Commune Dropdown -->
        <select id="commune_dropdown">
            <option value="">Select Commune</option>
            @foreach($communes as $commune)
                <option value="{{ $commune->codeCommune }}">{{ $commune->nomcommune_AR }}</option>
            @endforeach
        </select>
        <!-- Etablissement Dropdown -->
        <select id="etablissement_dropdown">
            <option value="">Select Etablissement</option>
        </select>

        <!-- Material Informatique Table -->
        <div class="table-responsive">
            <table class="table table-striped table-hover materiel-table" id="material_informatique_table">

                <tbody>
                    <!-- Table content will be dynamically updated -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- JavaScript Functionality -->
    <script>
        $(document).ready(function() {
            // Fetch Etablissements for selected Commune
            $('#commune_dropdown').change(function() {
                var communeId = $(this).val();
                $.ajax({
                    url: '/fetch-etablissements/' + communeId,
                    type: 'GET',
                    success: function(data) {
                        $('#etablissement_dropdown').html(data);
                        $('#material_informatique_table tbody').empty(); // Clear material informatique table
                    }
                });
            });

            // Fetch Material Informatique for selected Etablissement
            $('#etablissement_dropdown').change(function() {
                var etablissementId = $(this).val();
                $.ajax({
                    url: '/fetch-materiel-informatique/' + etablissementId,
                    type: 'GET',
                    success: function(data) {
                        $('#material_informatique_table tbody').html(data);
                    }
                });
            });
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
