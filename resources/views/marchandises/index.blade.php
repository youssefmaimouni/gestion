<x-nav-bar>
    <div class=" flex">
        <p class="text-2xl w-2/3 m-3 pl-6 underline underline-offset-4">marchandises</p>
        <p class="text-xl w-1/3  m-3 pl-6"><a href="/marchandises/create" class="text-blue-600 hover:text-blue-900">Ajouter Marchendise</a> </p>
    </div>
        
        <div class="overflow-x-auto relative shadow-md w-full sm:rounded-lg mb-10">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                    <tr>
                        <th scope="col" class="py-3 px-6 ">nom</th>
                            <th scope="col" class="py-3 px-6 ">description</th>
                            <th scope="col" class="py-3 px-6 ">quantite</th>
                            <th scope="col" class="py-3 px-6 ">unite</th>
                            <th scope="col" class="py-3 px-6 ">barre_code</th>
                            <th scope="col" class="py-3 px-6 ">image</th>
                            <th scope="col" class="py-3 px-6 text-center" >action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($marchandises as $marchandise)
                        <tr class="bg-white border-b hover:bg-gray-300 hover:text-black ">
                            <td class="py-4 px-6  ">{{$marchandise->nom}}</td>
                            <td class="py-4 px-6 ">{{$marchandise->description}}</td>
                            <td class="py-4 px-6 ">{{$marchandise->quantite}}</td>
                            <td class="py-4 px-6 ">{{$marchandise->unite}}</td>
                            <td class="py-4 px-6 ">{{$marchandise->barre_code}}</td>
                            <td class="py-4 px-6 ">{{$marchandise->image}}</td>
                            <td class="py-4 px-6 justify-between text-center"><a href="/marchandises/{{$marchandise->id}}" class="text-red-600 hover:text-red-900">Supprimer</a>   <a href="/marchandises/{{$marchandise->id}}/edit"class="text-blue-600 hover:text-blue-900 ml-4">Modifier</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>        
</x-nav-bar>