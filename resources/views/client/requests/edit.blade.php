<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">案件修正</h2>
    </x-slot>

    <div class="p-6">
        <form action="{{route('client.requests.update', $request->id)}}" method="POST">
            @csrf
            @method('PATCH')
            <div class="mb-6">
                <div>
                    <label for="name">タイトル</label>
                    <input type="text" name="title" id="title" value="{{$request->title}}" class="border-gray-300 focus:border-indigo-300 focus:ring
                    focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                </div>
                <div>
                    <label for="name">受付状況</label>
                    <input type="radio" name="status" value="1" class="mr-2" @if($request->status == 1) checked @endif>受付中
                    <input type="radio" name="status" value="0" class="mr-2" @if($request->status == 0) checked @endif>受付停止中
                </div>
                <div>
                    <label for="name">説明</label>
                    <input type="text" name="description" id="description" value="{{$request->description}}" class="border-gray-300 focus:border-indigo-300 focus:ring
                    focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                </div>
                <div>
                    <label for="name">料金</label>
                    <input type="text" name="price" id="price" value="{{$request->price}}" class="border-gray-300 focus:border-indigo-300 focus:ring
                    focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                </div>
                <div>
                    <button type="button" onclick="location.href='{{ route('client.requests.detail', $request->id)}}'" class="bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
                    <button type="submit" class="bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">更新</button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
