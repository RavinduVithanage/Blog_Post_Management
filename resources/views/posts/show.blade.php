<x-layout>
    <section>
        <div class="mt-4">
            <div class="flex justify-end">
               @can('update',$post)
                <a href="{{route('posts.edit',$post->id)}}">
                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit</button>
                </a>
               @endcan
               @can('delete',$post)
                <form action="{{route('posts.destroy',$post->id)}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">Delete</button>
                </form>
               @endcan 
            </div>   
        </div>
    </section>

    <div class="max-w-4xl bg-slate-50 mx-auto mt-5 p-4 rounded-md">
    <h1 class="max-w-6xl mt-2 lg:mt-5 space-y-20 text-indigo-900 font-bold">{{$post->title}}</h1>
    <main class="max-w-6xl mt-5 lg:mt-10 space-y-20">
        <p class="text-gray-600">{{$post->message}}</p>
    </main>
    </div>
</x-layout>