<x-nav-bar>
    <div class=" flex">
        <p class="text-2xl w-2/3 m-3 pl-6 underline underline-offset-4">categories</p>
        <p class="text-xl w-1/3  m-3 pl-6"><a href="{{ route('categories.create') }}" class="text-blue-600 hover:text-blue-900">Ajouter categorie</a> </p>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          

            <div class=" overflow-hidden gap-3 grid grid-cols-2 sm:grid-cols-3 justify-items-center">
            @foreach($categories as $categorie)
               <a href="{{ route('marchandises.index', $categorie) }}" class="h-52 w-full bg-slate-400 m-3 flex items-center flex-col rounded hover:border-2 hover:border-gray-100   text-center justify-center ">
                <p class="text-center font-bold text-black text-2xl underline">{{ $categorie->nom }}</p> <br>
                entré:{{ $categorie->total_achetes }} <br>
                sortié:{{ $categorie->total_vendus }} 
               </a>
               
               @endforeach
            </div>
        </div>
    </div>
</x-nav-bar>