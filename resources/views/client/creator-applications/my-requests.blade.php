<x-app-layout>
    <x-slot name="header">
        <h2 class="request-index__page-title">依頼済み案件一覧</h2>
    </x-slot>

    <section class="request-index">
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
            <a href="{{ route('client.creator-applications.my-requests', ['tab' => 'pending']) }}"
               class="request-tabs__item {{ $tab === 'pending' ? 'is-active' : '' }}">
                選考中
            </a>
            <a href="{{ route('client.creator-applications.my-requests', ['tab' => 'accepted']) }}"
               class="request-tabs__item {{ $tab === 'accepted' ? 'is-active' : '' }}">
                承認
            </a>
            <a href="{{ route('client.creator-applications.my-requests', ['tab' => 'rejected']) }}"
               class="request-tabs__item {{ $tab === 'rejected' ? 'is-active' : '' }}">
                見送り
            </a>
            <a href="{{ route('client.creator-applications.my-requests', ['tab' => 'all']) }}"
               class="request-tabs__item {{ $tab === 'all' ? 'is-active' : '' }}">
                すべて
            </a>
        </nav>

        <div class="request-index__container">
            <div class="request-index__grid">
                @forelse($applicationRequests as $appRequest)
                    <a class="request-index__card" href="{{ route('client.creator-applications.my-request-detail', $appRequest) }}">
                        <div class="request-index__card-header">
                            <div>
                                <p class="request-index__client">{{ $appRequest->application->creator->name }}</p>
                                <h3 class="request-index__title">{{ $appRequest->application->title }}</h3>
                            </div>
                            @if($appRequest->status?->value === 'pending')
                                <span class="request-index__badge is-pending">選考中</span>
                            @elseif($appRequest->status?->value === 'accepted')
                                <span class="request-index__badge is-accepted">承認</span>
                            @elseif($appRequest->status?->value === 'rejected')
                                <span class="request-index__badge is-rejected">見送り</span>
                            @endif
                        </div>
                        <p class="request-index__description">
                            {{ \Illuminate\Support\Str::limit($appRequest->message, 120) }}
                        </p>
                        <div class="request-index__meta">
                            <span class="request-index__price">¥{{ number_format($appRequest->proposed_price) }}</span>
                            <span class="request-index__date">
                                {{ $appRequest->created_at->format('Y/m/d') }}
                            </span>
                        </div>
                    </a>
                @empty
                    <div class="request-index__empty">
                        <p class="request-index__empty-title">依頼した案件はまだありません</p>
                    </div>
                @endforelse
            </div>

            @if($applicationRequests->hasPages())
                <div class="request-index__pagination">
                    {{ $applicationRequests->links() }}
                </div>
            @endif
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
                setTimeout(() => {
                    flashMessage.classList.add('fade-out');
                    setTimeout(() => { flashMessage.remove(); }, 500);
                }, 3000);
            }
        });
    </script>
</x-app-layout>
