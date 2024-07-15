<x-nav-bar>
    <style>
        .qr-code {
            transition: transform 0.3s ease-in-out;
        }
        .enlarged {
            transform: scale(2);
            z-index: 1000;
        }
        @media(max-width: 640px){
    .desc{
        display: none;
    }
}
    </style>
    <div class="fixed font-mon bg-slate-200 grid hidden rounded-md shadow-md " id="deleteGroupModal"
        style="width: 400px; justify-items: center; align-content: space-evenly ;height: 200px; left: 50%; top:50%; transform: translate(-50%, -50%); tabindex="-1"
        aria-labelledby="deleteGroupModalLabel" aria-hidden="true">
        <div class="grid justify-items-center">
            <svg fill="#000" height="60px" width="60px" version="1.1" id="Capa_1"
                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 0 27.963 27.963" xml:space="preserve">
                <g>
                    <g id="c129_exclamation">
                        <path d="M13.983,0C6.261,0,0.001,6.259,0.001,13.979c0,7.724,6.26,13.984,13.982,13.984s13.98-6.261,13.98-13.984
                   C27.963,6.259,21.705,0,13.983,0z M13.983,26.531c-6.933,0-12.55-5.62-12.55-12.553c0-6.93,5.617-12.548,12.55-12.548
                   c6.931,0,12.549,5.618,12.549,12.548C26.531,20.911,20.913,26.531,13.983,26.531z" />
                        <polygon points="15.579,17.158 16.191,4.579 11.804,4.579 12.414,17.158 		" />
                        <path d="M13.998,18.546c-1.471,0-2.5,1.029-2.5,2.526c0,1.443,0.999,2.528,2.444,2.528h0.056c1.499,0,2.469-1.085,2.469-2.528
                    C16.441,19.575,15.468,18.546,13.998,18.546z" />
                    </g>
                    <g id="Capa_1_207_">
                    </g>
                </g>
            </svg>
            <h5 class="font-semibold text-lg" id="deleteGroupModalLabel">Confirmation de la suppression</h5>
        </div>
        <div class="text-sm text-gray-900">
            Êtes-vous sûr de vouloir supprimer cette marchendise?
        </div>
        <div class="flex w-2/3 justify-around">
            <button type="button" class="btn btn-secondary" onclick="hide()"
                data-bs-dismiss="modal">Annuler</button>
            <form action="/marchandises/delete" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id" id="deleteGroupId" value="">
                <button type="submit"
                    class="bg-red-500 text-white p-2 rounded-sm hover:scale-110 hover:bg-red-400">Supprimer</button>
            </form>
        </div>
    </div>
    <div id="cont" class="" >
        <div class=" flex">
            <p class="text-2xl w-2/3 m-3 pl-6 underline underline-offset-4">marchandises</p>
            <p class="text-xl w-1/3  m-3 pl-6"><a href="/marchandises/create"
                    class="text-blue-600 hover:text-blue-900">Ajouter
                    Marchendise</a> </p>
        </div>
        <div class="overflow-x-auto relative shadow-md w-full sm:rounded-lg mb-10">
                
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                    <tr>
                        <th scope="col" class="py-3 px-6 ">image</th>
                        <th scope="col" class="py-3 px-6 ">nom</th>
                        <th scope="col" class="py-3 px-6 hidden sm:block">code QR</th>
                        <th scope="col" class="py-3 px-6 ">categorie</th>
                        <th scope="col" class="py-3 px-6 ">quantite</th>
                        <th scope="col" class="py-3 px-6 hidden sm:block">description</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b hover:bg-gray-200 hover:text-black ">
                    @foreach ($marchandises as $marchandise)
                    <td class="py-3 px-1 text-center flex justify-center">
                        @if (isset($marchandise->image) && $marchandise->image !== null)
                            <img class="image w-10 h-10 rounded-full bg-cover"
                                src="{{ asset('/storage/' . $marchandise->image) }}" alt="" />
                        @else
                            <img class="image w-10 h-10 rounded-full bg-cover"
                                src="{{ asset('/logo.jpg') }}" alt="" />
                        @endif

                    </td>
                        <td class="py-4 px-6  ">{{ $marchandise->nom }}</td>
                     
                                   <td ><abbr title="{{$marchandise->barre_code}}"> {!! QrCode::size(40)->generate(" le nom: ".$marchandise->nom."\n categorie: ".$marchandise->categories->nom."\n quantite: ".$marchandise->quantite) !!}</abbr></td>
                        
                        <td class="py-4 px-6 ">{{ $marchandise->categories->nom }}</td>
                        <td class="py-4 px-6 ">{{ $marchandise->qte }}</td>
                        <td class="py-4 px-6 ">{{ $marchandise->description }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table> 
            </div>
            
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
            document.addEventListener('DOMContentLoaded', function() {
                const qrCodeContainer = document.getElementById('qrCodeContainer');
    
                qrCodeContainer.addEventListener('click', function() {
                    this.classList.toggle('enlarged');
                });
            });
        </script>
    </div>
</x-nav-bar>