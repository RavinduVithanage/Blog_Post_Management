<x-layout>
    <x-header>Post Index Page</x-header>
    @auth
    <section>
        <div class="mt-4">
            <div class="flex justify-end">
                <a href="{{route('posts.create')}}">
                    <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Create</button>
                </a>
            </div>   
        </div>
    </section>
        
    @endauth
    <dl class="max-w-xl lg:max-w-2xl mx-auto p-4 bg-slate-200 divide-y divide-S dark:text-white dark:divide-gray-700  rounded-md">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
             @foreach ($posts as $post)
                <div class=" lg:max-w-xl flex flex-col pb-3 bg-white rounded-md  ">
                    <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400 pt-2 pl-2">{{$post->title}}</dt>
                    <dd class="text-lg font-semibold pt-2 pl-2">{{$post->message}}</dd>
                    <a href="/posts/{{$post->id}}" class="pt-2 px-3">
                        <button class="relative inline-flex items-center justify-center p-0.5  mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                            <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                Read More
                            </span>
                        </button>
                    </a>
                </div>
             @endforeach
        </div>
    </dl>
</x-layout>