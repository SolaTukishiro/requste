<x-app-layout>
    <x-slot name="header">
        <h2 class="request-index__page-title">依頼者一覧</h2>
    </x-slot>

    <section class="request-index">
        <nav class="request-tabs" aria-label="依頼フィルター">
            <a href="{{ route('creator.application-requests.index', ['tab' => 'pending']) }}"
               class="request-tabs__item {{ $tab === 'pending' ? 'is-active' : '' }}">
                選考中
            </a>
            <a href="{{ route('creator.application-requests.index', ['tab' => 'accepted']) }}"
               class="request-tabs__item {{ $tab === 'accepted' ? 'is-active' : '' }}">
                承認
            </a>
            <a href="{{ route('creator.application-requests.index', ['tab' => 'rejected']) }}"
               class="request-tabs__item {{ $tab === 'rejected' ? 'is-active' : '' }}">
                見送り
            </a>
            <a href="{{ route('creator.application-requests.index', ['tab' => 'all']) }}"
               class="request-tabs__item {{ $tab === 'all' ? 'is-active' : '' }}">
                すべて
            </a>
        </nav>

        <div class="request-index__container">
            <div class="request-index__grid">
                @forelse($applicationRequests as $appRequest)
                    <a class="request-index__card" href="{{ route('creator.application-requests.detail', $appRequest) }}">
                        <div class="request-index__card-header">
                            <div>
                                <p class="request-index__client">{{ $appRequest->client->name }}</p>
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
                            {{ \Illuminate\Support\Str::limit($appRequest->message, 100) }}
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
                        <p class="request-index__empty-title">依頼はまだありません</p>
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
</x-app-layout>
