<x-app-layout>
    <x-slot name="header">
        <h2 class="request-detail__page-title">応募詳細</h2>
    </x-slot>

    <div class="request-detail">
        <div class="request-detail__card">
            <div class="request-detail__title-row">
                <h1 class="request-detail__title">{{ $application->creator->name }}</h1>
                @if($application->status?->value === 'pending')
                    <span class="request-detail__badge is-pending">選考中</span>
                @elseif($application->status?->value === 'accepted')
                    <span class="request-detail__badge is-accepted">採用</span>
                @elseif($application->status?->value === 'rejected')
                    <span class="request-detail__badge is-rejected">見送り</span>
                @endif
            </div>

            <div class="request-detail__meta">
                <div class="request-detail__meta-item">
                    <span class="request-detail__label">応募日</span>
                    <span class="request-detail__value">{{ $application->created_at->format('Y/m/d H:i') }}</span>
                </div>
                <div class="request-detail__meta-item">
                    <span class="request-detail__label">提案価格</span>
                    <span class="request-detail__value">¥{{ number_format($application->proposed_price) }}</span>
                </div>
                <div class="request-detail__meta-item">
                    <span class="request-detail__label">納期見積もり</span>
                    <span class="request-detail__value">{{ $application->delivery_estimate }}</span>
                </div>
            </div>

            <div class="request-detail__section">
                <h3 class="request-detail__section-title">対象案件</h3>
                <a href="{{ route('client.requests.detail', $application->request) }}" class="request-detail__link">
                    {{ $application->request->title }}
                </a>
            </div>

            <div class="request-detail__section">
                <h3 class="request-detail__section-title">応募メッセージ</h3>
                <p class="request-detail__description">{{ $application->message }}</p>
            </div>

            <div class="request-detail__actions">
                <a class="request-detail__button is-ghost" href="{{ route('client.applications.index') }}">
                    応募者一覧へ戻る
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
