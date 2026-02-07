<x-app-layout>
    <x-slot name="header">
        <h2 class="request-index__page-title">応募者一覧</h2>
    </x-slot>

    <section class="request-index">
        <nav class="request-tabs" aria-label="応募フィルター">
            <a href="{{ route('client.applications.index', ['tab' => 'pending']) }}"
               class="request-tabs__item {{ $tab === 'pending' ? 'is-active' : '' }}">
                選考中
            </a>
            <a href="{{ route('client.applications.index', ['tab' => 'accepted']) }}"
               class="request-tabs__item {{ $tab === 'accepted' ? 'is-active' : '' }}">
                採用
            </a>
            <a href="{{ route('client.applications.index', ['tab' => 'rejected']) }}"
               class="request-tabs__item {{ $tab === 'rejected' ? 'is-active' : '' }}">
                見送り
            </a>
            <a href="{{ route('client.applications.index', ['tab' => 'all']) }}"
               class="request-tabs__item {{ $tab === 'all' ? 'is-active' : '' }}">
                すべて
            </a>
        </nav>

        <div class="request-index__container">
            <div class="request-index__grid">
                @forelse($applications as $application)
                    <a class="request-index__card" href="{{ route('client.applications.detail', $application) }}">
                        <div class="request-index__card-header">
                            <div>
                                <p class="request-index__client">{{ $application->creator->name }}</p>
                                <h3 class="request-index__title">{{ $application->request->title }}</h3>
                            </div>
                            @if($application->status?->value === 'pending')
                                <span class="request-index__badge is-pending">選考中</span>
                            @elseif($application->status?->value === 'accepted')
                                <span class="request-index__badge is-accepted">採用</span>
                            @elseif($application->status?->value === 'rejected')
                                <span class="request-index__badge is-rejected">見送り</span>
                            @endif
                        </div>
                        <p class="request-index__description">
                            {{ \Illuminate\Support\Str::limit($application->message, 100) }}
                        </p>
                        <div class="request-index__meta">
                            <span class="request-index__price">¥{{ number_format($application->proposed_price) }}</span>
                            <span class="request-index__date">
                                {{ $application->created_at->format('Y/m/d') }}
                            </span>
                        </div>
                    </a>
                @empty
                    <div class="request-index__empty">
                        <p class="request-index__empty-title">応募はまだありません</p>
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
