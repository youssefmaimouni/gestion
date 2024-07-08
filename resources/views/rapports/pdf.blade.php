<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #4a4a4a;
            font-size: 20px; 
        }

        .table-container {
            overflow-x: auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            background-color: #fff;
            width: 100%; /* Utiliser la largeur maximale pour le contenu PDF */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 5px ; /* Réduire la marge autour de la table */
        }

        th, td {
            padding: 8px 12px; /* Réduire le padding pour compacter les cellules */
            border: 1px solid #ddd;
            text-align: left;
            font-size: 14px; /* Réduire la taille de la police pour économiser de l'espace */
        }

        th {
            background-color: #f4f4f4;
            color: #333;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
            color: #333;
        }

        img {
            width: 30px; /* Réduire la taille de l'image pour économiser de l'espace */
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .empty-message {
            text-align: center;
            color: #aaa;
            font-size: 17px; /* Réduire la taille de la police pour économiser de l'espace */
            margin-top: 30px; /* Réduire l'espace entre le titre et le message vide */
        }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>
    @if (isset($start)&& isset($end))
        <div>   
            <p>De {{ $start }} à {{ $end }}</p>
        </div>
    @endif
    @if (count($marchandises) > 0)
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                      
                        <th>Nom</th>
                        <th>Categorie</th>
                        <th>bare code</th>
                        <th>Quantite</th>
                        <th class="text-center">Entre</th>
                        <th class="text-center">Sortie</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($marchandises as $marchandise)
                        <tr>
                            <td>{{ $marchandise->nom }}</td>
                            @if ($marchandise->barre_code)
                                        <td class="w-fit">{!! DNS1D::getBarcodeHTML($marchandise->barre_code, 'C39', 1, 20) !!}
                                        </td>
                                    @else
                                        <td>Pas de code barre</td>
                                    @endif
                           
                            <td>
                                {{ $marchandise->categories->nom ?? $marchandise->categories }}
                            </td>
                            <td>{{ $marchandise->solde  }}</td>
                            <td>{{ $marchandise->entres }}</td>
                            <td>{{  $marchandise->sorties  }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <h2 class="empty-message">Aucune marchandise</h2>
    @endif
</body>
</html>