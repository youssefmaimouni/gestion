<!DOCTYPE html>
<html>

<head>
    <title>{{ $title }}</title>
    <style>
        h2 {
            text-align: center;
            font-size: 18px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: white;
            padding: 30px 0;
        }

        /* Table Styles */

        .fl-table {
            font-size: 12px;
            font-weight: normal;
            border: none;
            width: 100%;
            white-space: nowrap;
            background-color: white;
        }

        .fl-table td,
        .fl-table th {
            text-align: center;
            padding: 8px;
        }

        .fl-table td {
            border-right: 1px solid #f8f8f8;
            font-size: 12px;
        }

        .fl-table thead th {
            color: #ffffff;
            background: #324960;
        }




        .fl-table tr:nth-child(even) {
            background: #F8F8F8;
        }
    </style>
</head>

<body>
    <h1>{{ $title }}</h1>
    @if (isset($start) && isset($end))
        <div>
            <p>De {{ $start }} à {{ $end }}</p>
        </div>
    @endif
    @if (count($marchandises) > 0)
        <div class="table-wrapper">
            <table class="fl-table">
                <thead>
                    <tr>

                        <th class="text-center">Nom</th>
                      
                        <th class="text-center">Categorie</th>
                        <th class="text-center">Quantite</th>
                        <th class="text-center">Entre</th>
                        <th class="text-center">Sortie</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($marchandises as $marchandise)
                        <tr>
                            <td>{{ $marchandise->nom }}</td>


                            <td>
                                {{ $marchandise->categories->nom ?? $marchandise->categories }}
                            </td>
                            <td>{{ $marchandise->solde }}</td>
                            <td>{{ $marchandise->entres }}</td>
                            <td>{{ $marchandise->sorties }}</td>
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
