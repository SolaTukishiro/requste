<x-app-layout>
    <x-slot name="header">
        <h2 class="request-detail__page-title">依頼詳細</h2>
    </x-slot>

    <div class="request-detail">
        <div class="request-detail__card">
            <div class="request-detail__title-row">
                <h1 class="request-detail__title">{{ $applicationRequest->application->title }}</h1>
                @if($applicationRequest->status?->value === 'pending')
                    <span class="request-detail__badge is-pending">選考中</span>
                @elseif($applicationRequest->status?->value === 'accepted')
                    <span class="request-detail__badge is-accepted">承認</span>
                @elseif($applicationRequest->status?->value === 'rejected')
                    <span class="request-detail__badge is-rejected">見送り</span>
                @endif
            </div>

            <div class="request-detail__meta">
                <div class="request-detail__meta-item">
                    <span class="request-detail__label">Creator</span>
                    <span class="request-detail__value">{{ $applicationRequest->application->creator->name }}</span>
                </div>
                <div class="request-detail__meta-item">
                    <span class="request-detail__label">依頼日</span>
                    <span class="request-detail__value">
                        {{ optional($applicationRequest->created_at)->format('Y/m/d H:i') }}
                    </span>
                </div>
            </div>

            <div class="request-detail__section">
                <h3 class="request-detail__section-title">案件説明</h3>
                <p class="request-detail__description">{{ $applicationRequest->application->description }}</p>
            </div>

            <div class="request-detail__section">
                <h3 class="request-detail__section-title">依頼内容</h3>
                <div class="request-detail__meta">
                    <div class="request-detail__meta-item">
                        <span class="request-detail__label">提案価格</span>
                        <span class="request-detail__value">¥{{ number_format($applicationRequest->proposed_price) }}</span>
                    </div>
                    <div class="request-detail__meta-item">
                        <span class="request-detail__label">納期見積もり</span>
                        <span class="request-detail__value">{{ $applicationRequest->delivery_estimate }}日</span>
                    </div>
                </div>
            </div>

            <div class="request-detail__section">
                <h3 class="request-detail__section-title">依頼メッセージ</h3>
                <p class="request-detail__description">{{ $applicationRequest->message }}</p>
            </div>

            @if($applicationRequest->status?->value === 'accepted' && $applicationRequest->conversation)
                <div class="request-detail__actions" style="margin-top: 10px;">
                    <a class="request-detail__button is-primary" href="{{ route('client.conversations.show', $applicationRequest->conversation) }}">
                        チャットを開く
                    </a>
                </div>
            @endif

            <div class="request-detail__actions" style="margin-top: 10px;">
                <a class="request-detail__button is-ghost" href="{{ route('client.creator-applications.my-requests') }}">
                    依頼一覧へ戻る
                </a>
                @if($applicationRequest->status?->value === 'pending')
                    <form action="{{ route('client.creator-applications.my-request-destroy', $applicationRequest) }}" method="POST" onsubmit="return confirm('本当に依頼を取り下げますか？この操作は取り消せません。')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="request-detail__button is-danger">
                            依頼を取り下げる
                        </button>
                    </form>
                @endif
            </div>

            @if(session('success'))
                <div class="request-detail__flash is-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="request-detail__flash is-error">{{ session('error') }}</div>
            @endif
        </div>
    </div>
</x-app-layout>
