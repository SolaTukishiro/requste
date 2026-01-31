<x-app-layout>
    <x-slot name="header">
        <h2 class="application-index__page-title">公開依頼一覧</h2>
    </x-slot>
    <section class="application-index">
        @if(session('success'))
            <div id="flash-message" class="flash-message flash-message--success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div id="flash-message" class="flash-message flash-message--error">
                {{ session('error') }}
            </div>
        @endif
        <nav class="request-tabs" aria-label="依頼フィルター">
            <a href="{{ route('creator.requests.show', ['tab' => 'open']) }}"
               class="request-tabs__item {{ $tab === 'open' ? 'is-active' : '' }}">
                受付中
            </a>
            <a href="{{ route('creator.requests.show', ['tab' => 'closed']) }}"
               class="request-tabs__item {{ $tab === 'closed' ? 'is-active' : '' }}">
                受付停止中
            </a>
            <a href="{{ route('creator.requests.show', ['tab' => 'all']) }}"
               class="request-tabs__item {{ $tab === 'all' ? 'is-active' : '' }}">
                すべて
            </a>
        </nav>
        <div class="request-index__container">
            <div class="request-index__grid">
                @forelse($requests as $request)
                    <a class="request-index__card" href="{{ route('creator.requests.detail', $request) }}">
                        <div class="request-index__card-header">
                            <div>
                                <p class="request-index__client">{{ $request->client->name }}</p>
                                <h3 class="request-index__title">{{ $request->title }}</h3>
                            </div>
                            @if($request->status)
                                <span class="request-index__badge is-open">受付中</span>
                            @else
                                <span class="request-index__badge is-closed">受付終了中</span>
                            @endif
                        </div>
                        <p class="request-index__description">
                            {{ \Illuminate\Support\Str::limit($request->description, 120) }}
                        </p>
                        <div class="request-index__meta">
                            <span class="request-index__price">¥{{ number_format($request->price) }}</span>
                            <span class="request-index__date">
                                {{ $request->created_at->format('Y/m/d') }}
                            </span>
                        </div>
                    </a>
                @empty
                    <div class="request-index__empty">
                        <p class="request-index__empty-title">作成した依頼はまだありません</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <style>
        .flash-message {
            padding: 1rem 1.5rem;
            margin-bottom: 1rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: opacity 0.5s ease-out;
        }

        .flash-message--success {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #6ee7b7;
        }

        .flash-message--error {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }

        .flash-message.fade-out {
            opacity: 0;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
                // 3秒後にフェードアウト開始
                setTimeout(() => {
                    flashMessage.classList.add('fade-out');
                    // フェードアウト完了後に要素を削除
                    setTimeout(() => {
                        flashMessage.remove();
                    }, 500);
                }, 3000);
            }
        });
    </script>
</x-app-layout>
