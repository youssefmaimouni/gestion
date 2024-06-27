<x-nav-bar>
        <p class="text-2xl w-4/5 m-3 pl-6 underline underline-offset-4">marchandises</p>
        
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg w-4/5 mb-10">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                    <tr>
                        <th scope="col" class="py-3 px-6">nom</th>
                            <th scope="col" class="py-3 px-6">description</th>
                            <th scope="col" class="py-3 px-6">quantite</th>
                            <th scope="col" class="py-3 px-6">unite</th>
                            <th scope="col" class="py-3 px-6">barre_code</th>
                            <th scope="col" class="py-3 px-6">image</th>
                            <th scope="col" class="py-3 px-6" >action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($marchandises as $marchandise)
                        <tr class="bg-white border-b">
                            <td class="py-4 px-6">{{$marchandise->nom}}</td>
                            <td class="py-4 px-6">{{$marchandise->description}}</td>
                            <td class="py-4 px-6">{{$marchandise->quantite}}</td>
                            <td class="py-4 px-6">{{$marchandise->unite}}</td>
                            <td class="py-4 px-6">{{$marchandise->barre_code}}</td>
                            <td class="py-4 px-6">{{$marchandise->image}}</td>
                            <td class="py-4 px-6"><a href="/user/delete/{{$marchandise->id}}"><button class=" bg-red-600 w-full h-8 rounded-md font-mon hover:scale-95 font-medium hover:bg-red-500 text-white">Delete</button></a><a href="/user/delete/{{$marchandise->id}}"><button class=" bg-red-600 w-full h-8 rounded-md font-mon hover:scale-95 font-medium hover:bg-red-500 text-white">Delete</button></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>        
</x-nav-bar>