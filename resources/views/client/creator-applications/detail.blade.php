<x-app-layout>
    <x-slot name="header">
        <h2 class="request-detail__page-title">案件詳細</h2>
    </x-slot>

    <div class="request-detail">
        <div class="request-detail__card">
            <div class="request-detail__title-row">
                <h1 class="request-detail__title">{{ $application->title }}</h1>
                @if($application->status)
                    <span class="request-detail__badge is-open">募集中</span>
                @else
                    <span class="request-detail__badge is-closed">募集終了</span>
                @endif
            </div>

            <div class="request-detail__meta">
                <div class="request-detail__meta-item">
                    <span class="request-detail__label">Creator</span>
                    <span class="request-detail__value">{{ $application->creator->name }}</span>
                </div>
                <div class="request-detail__meta-item">
                    <span class="request-detail__label">作成日</span>
                    <span class="request-detail__value">
                        {{ optional($application->created_at)->format('Y/m/d H:i') }}
                    </span>
                </div>
                <div class="request-detail__meta-item">
                    <span class="request-detail__label">価格</span>
                    <span class="request-detail__value">
                        ¥{{ number_format($application->price) }}
                    </span>
                </div>
            </div>

            <div class="request-detail__section">
                <h3 class="request-detail__section-title">案件説明</h3>
                <p class="request-detail__description">{{ $application->description }}</p>
            </div>

            <div class="request-detail__actions">
                <a class="request-detail__button is-ghost" href="{{ route('client.creator-applications.index') }}">
                    一覧へ戻る
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
