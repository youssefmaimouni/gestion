<x-nav-bar>
    <div id="cont" class="">
        <div class="flex-1">
            <div class="flex-1 w-full">
                <p class="text-2xl w-2/3 m-3 pl-6 underline underline-offset-4">Rapport</p>
            </div>
            <form action="{{ route('rapports.pdf') }}" method="POST">
                @csrf
                <div>
                    <button type="submit">Download</button>
                </div>
            </form>
            @if (count($marchandises) > 0)
                <div class="overflow-x-auto relative shadow-md w-full sm:rounded-lg mb-10">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3 px-6">Image</th>
                                <th scope="col" class="py-3 px-6">Nom</th>
                                <th scope="col" class="py-3 px-6">Barre Code</th>
                                <th scope="col" class="py-3 px-6">Categorie</th>
                                <th scope="col" class="py-3 px-6">Quantite</th>
                                <th scope="col" class="py-3 px-6 text-center">Entre</th>
                                <th scope="col" class="py-3 px-6 text-center">Sortie</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($marchandises as $marchandise)
                                <tr class="bg-white border-b hover:bg-gray-200 hover:text-black">
                                    <td class="py-4 px-6">
                                        @if (isset($marchandise->image) && $marchandise->image !== null)
                                            <img class="w-10 h-10 rounded-full bg-cover"
                                                 src="{{ asset('/storage/' . $marchandise->image) }}" alt="" />
                                        @else
                                            <img class="w-10 h-10 rounded-full bg-cover"
                                                 src="{{ asset('/logo.jpg') }}" alt="" />
                                        @endif
                                    </td>
                                    <td class="py-4 px-6">{{ $marchandise->nom }}</td>
                                    <td class="py-4 px-6">
                                        @if ($marchandise->barre_code)
                                            <abbr title="{{ $marchandise->barre_code }}">
                                                {!! DNS1D::getBarcodeHTML($marchandise->barre_code, 'C39') !!}
                                            </abbr>
                                        @else
                                            Pas de code barre
                                        @endif
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $marchandise->categories->nom ?? $marchandise->categories }}
                                    </td>
                                    <td class="py-4 px-6">{{ $marchandise->quantite }}</td>
                                    <td class="py-4 px-6">{{ $marchandise->entre }}</td>
                                    <td class="py-4 px-6">{{ $marchandise->sortie }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <h2 class="text-gray-300 text-8xl select-none text-center mt-32">Aucune marchandise</h2>
            @endif
        </div>
    </div>
</x-nav-bar>
