<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapport des Ventes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Rapport des Ventes</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventes as $vente)
            <tr>
                <td>{{ $vente->id }}</td>
                <td>{{ $vente->produit->nom }}</td> <!-- Assurez-vous que la relation produit est définie -->
                <td>{{ $vente->quantite }}</td>
                <td>{{ $vente->prix }}</td>
                <td>{{ \Carbon\Carbon::parse($vente->date)->format('d/m/Y') }}</td> <!-- Format de la date -->
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
