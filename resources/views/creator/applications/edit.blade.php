<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">案件修正</h2>
    </x-slot>

    <div class="form">
        <form action="{{route('client.requests.update', $request->id)}}" method="POST">
            @csrf
            @method('PATCH')
            <dl>
                <dt>
                    <label for="name">タイトル</label>
                </dt>
                <dd>
                    <input type="text" name="title" id="title" value="{{$request->title}}" class="textInput">
                </dd>
                <dt>
                    <label for="name">受付状況</label>
                </dt>
                <dd>
                    <input type="radio" name="status" value="1" class="mr-2" @if($request->status == 1) checked @endif>受付中
                    <input type="radio" name="status" value="0" class="mr-2" @if($request->status == 0) checked @endif>受付停止中
                </dd>
                <dt>
                    <label for="name">説明</label>
                </dt>
                <dd>
                    <input type="text" name="description" id="description" value="{{$request->description}}" class="textInput">
                </dd>
                <dt>
                    <label for="name">料金</label>
                </dt>
                <dd>
                    <input type="text" name="price" id="price" value="{{$request->price}}" class="textInput">
                </dd>
            </dl>
            <div class="form-actions">
                <div>
                    <input type="button" onclick="location.href='{{ route('client.requests.detail', $request->id)}}'" class="form-button" value="戻る">
                    <input type="submit" class="commit form-button" value="登録する">
                </div>
                <div>
                    <input type="button" onclick="" class="form-button delete" value="削除">
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
