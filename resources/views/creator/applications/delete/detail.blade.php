<x-app-layout>
    <x-slot name="header">
        <h2 class="request-detail__page-title">案件詳細</h2>
    </x-slot>

    <div class="request-detail">
        <div class="request-detail__card">
            <div class="request-detail__title-row">
                <h1 class="request-detail__title">{{ $application->title }}</h1>
                @if($application->status)
                    <span class="request-detail__badge is-open">受付中</span>
                @else
                    <span class="request-detail__badge is-closed">受付終了中</span>
                @endif
            </div>

            <div class="request-detail__meta">
                <div class="request-detail__meta-item">
                    <span class="request-detail__label">作成日</span>
                    <span class="request-detail__value">
                        {{ $application->created_at->format('Y/m/d H:i') }}
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
                <a class="request-detail__button is-ghost" href="{{ route('creator.applications.deleted.index') }}">
                    一覧へ戻る
                </a>
                <form action="{{ route('creator.applications.deleted.restore', $application->id) }}" id="restore" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="submit" class="form-button submit" value="復元">
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const deleteForm = document.getElementById('restore');
            if (!deleteForm) {
                return;
            }
            deleteForm.addEventListener('submit', (event) => {
                if (!window.confirm('この依頼を復元します。よろしいですか？')) {
                    event.preventDefault();
                }
            });
        });
    </script>
</x-app-layout>
