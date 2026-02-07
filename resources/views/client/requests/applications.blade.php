<x-app-layout>
    <x-slot name="header">
        <h2 class="request-detail__page-title">応募一覧</h2>
    </x-slot>

    <div class="request-detail">
        <div class="request-detail__card">
            <div class="request-detail__title-row">
                <h1 class="request-detail__title">{{ $request->title }}</h1>
                @if($request->status)
                    <span class="request-detail__badge is-open">受付中</span>
                @else
                    <span class="request-detail__badge is-closed">受付終了中</span>
                @endif
            </div>

            <div class="request-detail__meta">
                <div class="request-detail__meta-item">
                    <span class="request-detail__label">応募数</span>
                    <span class="request-detail__value">{{ $request->applications->count() }}件</span>
                </div>
                <div class="request-detail__meta-item">
                    <span class="request-detail__label">価格</span>
                    <span class="request-detail__value">¥{{ number_format($request->price) }}</span>
                </div>
            </div>

            <div class="request-detail__section">
                <h3 class="request-detail__section-title">応募一覧</h3>

                @forelse($request->applications as $application)
                    <a href="{{ route('client.requests.applications.detail', [$request, $application]) }}" class="application-card">
                        <div class="application-card__header">
                            <div class="application-card__creator">{{ $application->creator->name }}</div>
                            @if($application->status?->value === 'pending')
                                <span class="application-card__badge is-pending">選考中</span>
                            @elseif($application->status?->value === 'accepted')
                                <span class="application-card__badge is-accepted">採用</span>
                            @elseif($application->status?->value === 'rejected')
                                <span class="application-card__badge is-rejected">見送り</span>
                            @endif
                        </div>
                        <p class="application-card__message">{{ \Illuminate\Support\Str::limit($application->message, 100) }}</p>
                        <div class="application-card__meta">
                            <span class="application-card__price">¥{{ number_format($application->proposed_price) }}</span>
                            <span class="application-card__date">{{ $application->created_at->format('Y/m/d') }}</span>
                        </div>
                    </a>
                @empty
                    <div class="application-card__empty">
                        <p>まだ応募はありません</p>
                    </div>
                @endforelse
            </div>

            <div class="request-detail__actions">
                <a class="request-detail__button is-ghost" href="{{ route('client.requests.detail', $request) }}">
                    案件詳細へ戻る
                </a>
            </div>
        </div>
    </div>
</x-app-layout>