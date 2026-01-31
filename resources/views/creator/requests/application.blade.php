{{-- resources/views/creator/requests/apply.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">応募</h2>
    </x-slot>

    @if(session('error'))
        <div id="flash-message" class="flash-message flash-message--error">
            {{ session('error') }}
        </div>
    @endif

    <div class="form">
        <form action="{{ route('creator.requests.applicationStore', $request) }}" method="POST" id="applicationForm">
            @csrf

            <dl>
                <dt>タイトル</dt>
                <dd>{{ $request->title }}</dd>

                <dt>説明</dt>
                <dd>{{ $request->description }}</dd>

                <dt>
                    <label for="message">応募メッセージ</label>
                </dt>
                <dd>
                    <input type="text" name="message" id="message" class="textInput">
                </dd>

                <dt>
                    <label for="proposed_price">提案金額（円）</label>
                </dt>
                <dd>
                    <input type="number" name="proposed_price" id="proposed_price" class="textInput" min="0" step="1">
                    <p class="text-sm text-gray-500">
                        依頼金額: ¥{{ number_format($request->price) }}
                    </p>
                </dd>

                <dt>
                    <label for="delivery_estimate">納期目安（日数）</label>
                </dt>
                <dd>
                    <input type="number" name="delivery_estimate" id="delivery_estimate" class="textInput" min="1" step="1">
                </dd>
            </dl>

            <div class="form-actions">
                <div>
                    <button type="button" onclick="location.href='{{ route('creator.requests.detail', $request) }}'" class="form-button">
                        戻る
                    </button>

                    <button type="submit" class="commit form-button">
                        応募する
                    </button>
                </div>
            </div>
        </form>
    </div>

    <style>
        .flash-message {
            padding: 1rem 1.5rem;
            margin-bottom: 1rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: opacity 0.5s ease-out;
        }

        .flash-message--error {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }

        .flash-message.fade-out {
            opacity: 0;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('applicationForm');
            if (!form) return;

            form.addEventListener('submit', (event) => {
                if (!window.confirm('この依頼に応募します。よろしいですか？')) {
                    event.preventDefault();
                }
            });

            // フラッシュメッセージの自動フェードアウト
            const flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
                setTimeout(() => {
                    flashMessage.classList.add('fade-out');
                    setTimeout(() => {
                        flashMessage.remove();
                    }, 500);
                }, 3000);
            }
        });
    </script>
</x-app-layout>
