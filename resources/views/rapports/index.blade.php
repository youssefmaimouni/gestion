<x-nav-bar>
   
    <div id="cont" class="">
        <div class=" flex-1">
            <div class="flex-1 w-full">
                <p class="text-2xl w-2/3 m-3 pl-6 underline underline-offset-4">Rapport</p>
                <form action="/search" method="get">
                 <div class="">
                     <input type="text" name="search" id="">
                     <button type="submit" class="btn btn-primary">Search</button>
                 </div>
                 </form>
            </div>
        @if (count($marchandises) > 0)
            <div class="overflow-x-auto relative shadow-md w-full sm:rounded-lg mb-10">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                        <tr>
                            <th scope="col" class="py-3 px-6 ">image</th>
                            <th scope="col" class="py-3 px-6 ">nom</th>
                            <th scope="col" class="py-3 px-6 ">barre code</th>
                            <th scope="col" class="py-3 px-6 ">categorie</th>
                            <th scope="col" class="py-3 px-6 ">quantite</th>
                            <th scope="col" class="py-3 px-6 text-center">entre</th>
                            <th scope="col" class="py-3 px-6 text-center">sortie</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($marchandises as $marchandise)
                            <tr class="bg-white border-b hover:bg-gray-200 hover:text-black ">
                                <td class="py-4 px-6">
                                    @if (isset($marchandise->image) && $marchandise->image !== null)
                                        <img class="image w-10 h-10 rounded-full bg-cover"
                                            src="{{ asset('/storage/' . $marchandise->image) }}" alt="" />
                                    @else
                                        <img class="image w-10 h-10 rounded-full bg-cover"
                                            src="{{ asset('/logo.jpg') }}" alt="" />
                                    @endif

                                </td>
                                <td class="py-4 px-6  ">{{ $marchandise->nom }}</td>
                                @if($marchandise->barre_code)
                                   <td ><abbr title="{{$marchandise->barre_code}}"> {!! DNS1D::getBarcodeHTML($marchandise->barre_code, 'C39') !!}</abbr></td>
                        @else
                            <td>Pas de code barre</td>
                        @endif
                                <td class="py-4 px-6 ">
                                    @if ($marchandise->categories)
                                        {{ $marchandise->categories->nom }}
                                    @else
                                        {{ $marchandise->categories }}
                                    @endif
                                </td>
                                <td class="py-4 px-6 ">{{ $marchandise->quantite }}</td>
                                <td class="py-4 px-6 ">
                                   {{$marchandise->entre}}
                                </td>
                                <td class="py-4 px-6 ">
                                    {{$marchandise->sortie}}
                                 </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <h2 class="text-gray-300 text-8xl select-none text-center mt-32">aucune marchendise</h2>
        @endif
        <script>
            function warnning(id) {
                document.getElementById('deleteGroupModal').classList.remove('hidden');
                const deleteGroupIdInput = document.getElementById('deleteGroupId');
                // Set the hidden input field's value to the retrieved group ID
                deleteGroupIdInput.value = id;
                document.getElementById('cont').classList.add('blur-sm');
                document.getElementById('cont').classList.add('pointer-events-none');
            }
        </script>
        <script>
            function hide() {
                document.getElementById('deleteGroupModal').classList.add('hidden');
                document.getElementById('cont').classList.remove('blur-sm');
                document.getElementById('cont').classList.remove('pointer-events-none');
            }
        </script>
        <script>
            function warnning2(id, id_mar) {
                document.getElementById('ajoutEtnte').classList.remove('hidden');
                document.getElementById('cont').classList.add('blur-sm');
                document.getElementById('cont').classList.add('pointer-events-none');

                // Update hidden inputs
                document.getElementById('id_en').value = id;
            }

            function hide2() {
                document.getElementById('ajoutEtnte').classList.add('hidden');
                document.getElementById('cont').classList.remove('blur-sm');
                document.getElementById('cont').classList.remove('pointer-events-none');
            }
        </script>
        <script>
            function warnning3(id, id_mar) {
                document.getElementById('ajoutSortier').classList.remove('hidden');
                document.getElementById('cont').classList.add('blur-sm');
                document.getElementById('cont').classList.add('pointer-events-none');

                // Update hidden inputs
                document.getElementById('id_sor').value = id;
            }

            function hide3() {
                document.getElementById('ajoutSortier').classList.add('hidden');
                document.getElementById('cont').classList.remove('blur-sm');
                document.getElementById('cont').classList.remove('pointer-events-none');
            }
        </script>
    </div>
</x-nav-bar>
