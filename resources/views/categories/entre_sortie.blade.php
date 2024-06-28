<x-nav-bar>
    <div class=" flex">
        <p class="text-2xl w-2/3 m-3 pl-6 underline underline-offset-4">categories</p>
        <p class="text-xl w-1/3  m-3 pl-6"><a href="{{ route('categories.create') }}" class="text-blue-600 hover:text-blue-900">Ajouter categorie</a> </p>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          

            @foreach($categories as $categorie)
            <div class=" overflow-hidden shadow-sm sm:rounded-lg flex" >
               <a href="{{ route('categories.entre_sortie', $categorie) }}" class="h-52 w-1/2 bg-slate-400 m-3 flex items-center flex-col   text-center justify-center">
                {{ $categorie->nom }} 
               </a>
               
            </div>
            @endforeach
        </div>
    </div>
   
</x-nav-bar>
