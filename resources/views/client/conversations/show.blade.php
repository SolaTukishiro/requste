<x-app-layout>
    <x-slot name="header">
        <h2 class="request-detail__page-title">チャット</h2>
    </x-slot>

    <div class="chat">
        <a href="{{ route('client.conversations.index') }}" class="chat__back">&larr; チャット一覧へ戻る</a>

        <div class="chat__header">
            @if($conversation->application_request_id)
                <h3 class="chat__header-title">{{ $conversation->applicationRequest->application->creator->name ?? '不明' }}</h3>
                <p class="chat__header-subtitle">{{ $conversation->applicationRequest->application->title ?? '削除済み案件' }}</p>
            @else
                <h3 class="chat__header-title">{{ $conversation->application->creator->name ?? '不明' }}</h3>
                <p class="chat__header-subtitle">{{ $conversation->application->request->title ?? '削除済み案件' }}</p>
            @endif
        </div>

        <div class="chat__messages" id="chat-messages">
            @forelse($conversation->messages as $message)
                <div class="chat__bubble {{ $message->sender_id === auth()->id() ? 'is-mine' : 'is-other' }}">
                    @if($message->sender_id !== auth()->id())
                        <div class="chat__sender">{{ $message->sender->name }}</div>
                    @endif
                    <div class="chat__body">{{ $message->body }}</div>
                    <div class="chat__time">{{ $message->created_at->format('m/d H:i') }}</div>
                </div>
            @empty
                <p class="chat__empty">メッセージはまだありません。最初のメッセージを送りましょう！</p>
            @endforelse
        </div>

        <form action="{{ route('client.conversations.sendMessage', $conversation) }}" method="POST" class="chat__form">
            @csrf
            <textarea name="body" class="chat__input" placeholder="メッセージを入力..." rows="1" required maxlength="2000"></textarea>
            <button type="submit" class="chat__send">送信</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const el = document.getElementById('chat-messages');
            if (el) el.scrollTop = el.scrollHeight;
        });
    </script>
</x-app-layout>
