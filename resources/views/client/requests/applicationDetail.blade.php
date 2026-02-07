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
                <p class="request-detail__description">{{ $request->title }}</p>
            </div>

            <div class="request-detail__section">
                <h3 class="request-detail__section-title">応募メッセージ</h3>
                <p class="request-detail__description">{{ $application->message }}</p>
            </div>

            @if($application->status?->value === 'pending')
                <div class="request-detail__actions">
                    <form action="{{ route('client.applications.accept', $application) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="request-detail__button is-primary" onclick="return confirm('このクリエイターを採用しますか？')">
                            採用する
                        </button>
                    </form>
                    <form action="{{ route('client.applications.reject', $application) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="request-detail__button is-danger" onclick="return confirm('この応募を見送りますか？')">
                            見送る
                        </button>
                    </form>
                </div>
            @endif

            @if($application->status?->value === 'accepted' && $application->conversation)
                <div class="request-detail__actions" style="margin-top: 10px;">
                    <a class="request-detail__button is-primary" href="{{ route('client.conversations.show', $application->conversation) }}">
                        チャットを開く
                    </a>
                </div>
            @endif

            <div class="request-detail__actions">
                <a class="request-detail__button is-ghost" href="{{ route('client.requests.applications', $request) }}">
                    応募一覧へ戻る
                </a>
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
