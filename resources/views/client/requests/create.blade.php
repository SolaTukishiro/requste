<x-app-layout class="form">
    <x-slot name="header">
        <h2 class="text-xl font-semibold">案件作成</h2>
    </x-slot>

    <div class="form">
        <form action="{{route('client.requests.store')}}" method="POST">
            @csrf
            <dl>
                <dt>
                    <label for="name">タイトル</label>
                </dt>
                <dd>
                    <input type="text" name="title" id="title" class="border-gray-300 focus:border-indigo-300 focus:ring
                    focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
                </dd>
                <dt>
                    <label for="name">受付状況</label>
                </dt>
                <dd>
                    <input type="radio" name="status" value="1" class="mr-2" checked>受付中
                    <input type="radio" name="status" value="0" class="mr-2" >受付停止中
                </dd>
                <dt>
                    <label for="name">説明</label>
                </dt>
                <dd>
                    <input type="text" name="description" id="description" class="border-gray-300 focus:border-indigo-300 focus:ring
                    focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
                </dd>
                <dt>
                    <label for="name">料金</label>
                </dt>
                <dd>
                    <input type="text" name="price" id="price" class="border-gray-300 focus:border-indigo-300 focus:ring
                    focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
                </dd>
            </dl>
            <div class="form-actions">
                <div>
                    <input type="button" onclick="location.href='{{ route('client.requests.index')}}'" class="form-button" value="戻る">
                    <input type="submit" class="commit form-button" value="登録する">
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
