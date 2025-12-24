<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">案件一覧</h2>
    </x-slot>
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-wrap -m-4">
                @forelse($requests as $request)
                    <div class="xl:w-1/4 md:w-1/2 p-4">
                        <a href="{{route('client.requests.detail', $request->id)}}">
                            <div class="bg-gray-100 p-6 rounded-lg">
                                <img class="h-40 rounded w-full object-cover object-center mb-6" src="https://dummyimage.com/720x400" alt="content">
                                <h3 class="tracking-widest text-indigo-500 text-xs font-medium title-font">{{$request->client->name}}</h3>
                                <h2 class="text-lg text-gray-900 font-medium title-font mb-4">{{$request->title}}</h2>
                                <div class="leading-relaxed text-base">{{$request->description}}</div>
                            </div>
                        </a>
                    </div>
                @empty
                    <p>案件はまだありません</p>
                @endforelse
            </div>
        </div>
    </section>
</x-app-layout>
