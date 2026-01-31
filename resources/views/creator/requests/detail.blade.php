<x-app-layout>
    <x-slot name="header">
        <h2 class="request-detail__page-title">案件詳細</h2>
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
                    <span class="request-detail__label">作成日</span>
                    <span class="request-detail__value">
                        {{ optional($request->created_at)->format('Y/m/d H:i') }}
                    </span>
                </div>
                <div class="request-detail__meta-item">
                    <span class="request-detail__label">価格</span>
                    <span class="request-detail__value">
                        ¥{{ number_format($request->price) }}
                    </span>
                </div>
            </div>

            <div class="request-detail__section">
                <h3 class="request-detail__section-title">案件説明</h3>
                <p class="request-detail__description">{{ $request->description }}</p>
            </div>

            <div class="request-detail__actions">
                <a class="request-detail__button is-ghost" href="{{ route('creator.requests.show') }}">
                    一覧へ戻る
                </a>
                @if($request->status)
                    @if($isApplied)
                        <button class="request-detail__button is-primary is-disabled" disabled>
                            応募済み
                        </button>
                    @else
                        <a class="request-detail__button is-primary" href="{{ route('creator.requests.application', $request) }}">
                            応募する
                        </a>
                    @endif
                @endif
            </div>
        </div>
    </div>

    <style>
        .request-detail__button.is-disabled {
            opacity: 0.5;
            cursor: not-allowed;
            pointer-events: none;
        }
    </style>
</x-app-layout>
