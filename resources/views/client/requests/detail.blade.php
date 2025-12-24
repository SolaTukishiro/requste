<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">案件詳細</h2>
    </x-slot>

    <div class="p-6">
        @if($request->status)
            <p>受付状況：受付中</p>
        @else
            <p>受付状況：受付終了中</p>
        @endif
            <p>説明：</p>
            <p>{{ $request->description }}</p>

            <p>値段：¥{{ $request->price }}</p>

            <p class="text-sm text-gray-500">
                作成日：{{ $request->created_at->format('Y/m/d H:i') }}
            </p>

        <a href="{{ route('client.requests.index') }}">
            一覧へ戻る
        </a>
    </div>
</x-app-layout>
