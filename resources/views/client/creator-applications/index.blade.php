<x-app-layout>
    <x-slot name="header">
        <h2 class="application-index__page-title">案件一覧</h2>
    </x-slot>
    <section class="application-index">
        <nav class="request-tabs" aria-label="案件フィルター">
            <a href="{{ route('client.creator-applications.index', ['tab' => 'open']) }}"
               class="request-tabs__item {{ $tab === 'open' ? 'is-active' : '' }}">
                募集中
            </a>
            <a href="{{ route('client.creator-applications.index', ['tab' => 'closed']) }}"
               class="request-tabs__item {{ $tab === 'closed' ? 'is-active' : '' }}">
                募集終了
            </a>
            <a href="{{ route('client.creator-applications.index', ['tab' => 'all']) }}"
               class="request-tabs__item {{ $tab === 'all' ? 'is-active' : '' }}">
                すべて
            </a>
        </nav>
        <div class="request-index__container">
            <div class="request-index__grid">
                @forelse($applications as $application)
                    <a class="request-index__card" href="{{ route('client.creator-applications.detail', $application) }}">
                        <div class="request-index__card-header">
                            <div>
                                <p class="request-index__client">{{ $application->creator->name }}</p>
                                <h3 class="request-index__title">{{ $application->title }}</h3>
                            </div>
                            @if($application->status)
                                <span class="request-index__badge is-open">募集中</span>
                            @else
                                <span class="request-index__badge is-closed">募集終了</span>
                            @endif
                        </div>
                        <p class="request-index__description">
                            {{ \Illuminate\Support\Str::limit($application->description, 120) }}
                        </p>
                        <div class="request-index__meta">
                            <span class="request-index__price">¥{{ number_format($application->price) }}</span>
                            <span class="request-index__date">
                                {{ $application->created_at->format('Y/m/d') }}
                            </span>
                        </div>
                    </a>
                @empty
                    <div class="request-index__empty">
                        <p class="request-index__empty-title">公開中の案件はまだありません</p>
                    </div>
                @endforelse
            </div>

            @if($applications->hasPages())
                <div class="request-index__pagination">
                    {{ $applications->links() }}
                </div>
            @endif
        </div>
    </section>
</x-app-layout>
