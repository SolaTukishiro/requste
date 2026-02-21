<x-app-layout>
    <x-slot name="header">
        <h2 class="request-detail__page-title">チャット一覧</h2>
    </x-slot>

    <div class="chat-list">
        @if($conversations->isEmpty())
            <p class="chat-list__empty">チャットはまだありません</p>
        @else
            @foreach($conversations as $conversation)
                <a href="{{ route('client.conversations.show', $conversation) }}" class="chat-list__item">
                    <div class="chat-list__info">
                        @if($conversation->application_request_id)
                            <div class="chat-list__name">{{ $conversation->applicationRequest->application->creator->name ?? '不明' }}</div>
                            <div class="chat-list__request-title">{{ $conversation->applicationRequest->application->title ?? '削除済み案件' }}</div>
                        @else
                            <div class="chat-list__name">{{ $conversation->application->creator->name ?? '不明' }}</div>
                            <div class="chat-list__request-title">{{ $conversation->application->request->title ?? '削除済み案件' }}</div>
                        @endif
                        @if($conversation->messages->first())
                            <div class="chat-list__last-message">{{ Str::limit($conversation->messages->first()->body, 50) }}</div>
                        @endif
                    </div>
                    <div class="chat-list__time">
                        {{ $conversation->updated_at->format('m/d H:i') }}
                    </div>
                </a>
            @endforeach
        @endif
    </div>
</x-app-layout>
