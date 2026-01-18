<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">案件修正</h2>
    </x-slot>

    <div class="form">
        <form action="{{route('creator.applications.update', $application->id)}}" method="POST">
            @csrf
            @method('PATCH')
            <dl>
                <dt>
                    <label for="name">タイトル</label>
                </dt>
                <dd>
                    <input type="text" name="title" id="title" value="{{$application->title}}" class="textInput">
                </dd>
                <dt>
                    <label for="name">受付状況</label>
                </dt>
                <dd>
                    <input type="radio" name="status" value="1" class="mr-2" @if($application->status == 1) checked @endif>受付中
                    <input type="radio" name="status" value="0" class="mr-2" @if($application->status == 0) checked @endif>受付停止中
                </dd>
                <dt>
                    <label for="name">説明</label>
                </dt>
                <dd>
                    <input type="text" name="description" id="description" value="{{$application->description}}" class="textInput">
                </dd>
                <dt>
                    <label for="name">料金</label>
                </dt>
                <dd>
                    <input type="text" name="price" id="price" value="{{$application->price}}" class="textInput">
                </dd>
            </dl>
            <div class="form-actions">
                <div>
                    <input type="button" onclick="location.href='{{ route('creator.applications.detail', $application->id)}}'" class="form-button" value="戻る">
                    <input type="submit" class="commit form-button" value="登録する">
                    <input type="submit" class="delete form-button" form="delete-form" value="削除">
                </div>
            </div>
        </form>
        <form action="{{ route('creator.applications.destroy', $application->id) }}" method="POST" id="delete-form" hidden>
            @csrf
            @method('DELETE')
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const deleteForm = document.getElementById('delete-form');
            if (!deleteForm) {
                return;
            }
            deleteForm.addEventListener('submit', (event) => {
                if (!window.confirm('この依頼を削除します。よろしいですか？\n※削除後は「削除済み案件一覧」から復元できます。')) {
                    event.preventDefault();
                }
            });
        });
    </script>
</x-app-layout>
