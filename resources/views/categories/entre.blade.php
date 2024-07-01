<x-nav-bar>

    <div class="text-sm font-medium text-center text-gray-500  border-gray-200 dark:text-gray-400 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px">
           
            <li class="me-2">
                <a href="{{ route('categories.entre_sortie', $categories) }}"   class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">  Tous</a>
            </li> 
            <li class="me-2">
                <a href="{{ route('categories.entre', $categories) }}"  class="inline-block p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500" aria-current="page">Entrés</a>
            </li>
            <li class="me-2">
                <a href="{{ route('categories.sortie', $categories) }}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Sorties</a>
            </li>
        </ul>
        <table class="w-full text-sm text-left text-gray-500 mb-14">
            <tbody>
                @foreach($entres as $item)
                    <tr class="bg-white  hover:bg-gray-50">
                        <td class="py-4 px-6">{{ $item->type }}</td>
                        <td class="py-4 px-6">{{ $item->date_doc }}</td>
                        <td class="py-4 px-6">
                            {{-- <form action="{{ route('tous.delete', $item) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Supprimer</button>
                            </form> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </x-nav-bar>
    