    <table>
        <thead>
            <tr>
              
                <th>Nom</th>
                <th>Categorie</th>
                <th>barre code</th>
                <th>Quantite</th>
                <th>Entre</th>
                <th>Sortie</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($marchandises as $marchandise)
                <tr>
                    <td>{{ $marchandise->nom }}</td>
                    <td>
                        {{ $marchandise->categories->nom ?? $marchandise->categories }}
                    </td>
                    <td>{{ $marchandise->barre_code }}</td>
                    <td>{{ $marchandise->solde  }}</td>
                    <td>{{ $marchandise->entres }}</td>
                    <td>{{  $marchandise->sorties  }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

