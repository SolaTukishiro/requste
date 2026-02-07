<x-app-layout>
    <x-slot name="header">
        <h2 class="request-detail__page-title">応募詳細</h2>
    </x-slot>

    <div class="request-detail">
        <div class="request-detail__card">
            <div class="request-detail__title-row">
                <h1 class="request-detail__title">{{ $application->request->title }}</h1>
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
                    <span class="request-detail__label">クライアント</span>
                    <span class="request-detail__value">{{ $application->request->client->name }}</span>
                </div>
                <div class="request-detail__meta-item">
                    <span class="request-detail__label">応募日</span>
                    <span class="request-detail__value">
                        {{ optional($application->created_at)->format('Y/m/d H:i') }}
                    </span>
                </div>
            </div>

            <div class="request-detail__section">
                <h3 class="request-detail__section-title">案件説明</h3>
                <p class="request-detail__description">{{ $application->request->description }}</p>
            </div>

            <div class="request-detail__section">
                <h3 class="request-detail__section-title">応募内容</h3>
                <div class="request-detail__meta">
                    <div class="request-detail__meta-item">
                        <span class="request-detail__label">提案価格</span>
                        <span class="request-detail__value">¥{{ number_format($application->proposed_price) }}</span>
                    </div>
                    <div class="request-detail__meta-item">
                        <span class="request-detail__label">納期見積もり</span>
                        <span class="request-detail__value">{{ $application->delivery_estimate }}</span>
                    </div>
                </div>
            </div>

            <div class="request-detail__section">
                <h3 class="request-detail__section-title">応募メッセージ</h3>
                <p class="request-detail__description">{{ $application->message }}</p>
            </div>

            <div class="request-detail__actions">
                <a class="request-detail__button is-ghost" href="{{ route('creator.requests.applications.show') }}">
                    応募一覧へ戻る
                </a>
                @if($application->status?->value === 'pending')
                    <form action="{{ route('creator.requests.applications.destroy', $application) }}" method="POST" onsubmit="return confirm('本当に応募を取り下げますか？この操作は取り消せません。')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="request-detail__button is-danger">
                            応募を取り下げる
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>