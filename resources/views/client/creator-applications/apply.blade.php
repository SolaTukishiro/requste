<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">依頼</h2>
    </x-slot>

    @if(session('error'))
        <div id="flash-message" class="flash-message flash-message--error">
            {{ session('error') }}
        </div>
    @endif

    <div class="form">
        <form action="{{ route('client.creator-applications.store', $application) }}" method="POST" id="applyForm">
            @csrf

            <dl>
                <dt>タイトル</dt>
                <dd>{{ $application->title }}</dd>

                <dt>説明</dt>
                <dd>{{ $application->description }}</dd>

                <dt>
                    <label for="message">依頼メッセージ</label>
                </dt>
                <dd>
                    <input type="text" name="message" id="message" class="textInput">
                </dd>

                <dt>
                    <label for="proposed_price">提案金額（円）</label>
                </dt>
                <dd>
                    <input type="number" name="proposed_price" id="proposed_price" class="textInput" min="0" step="1">
                    @if($application->price)
                        <p class="text-sm text-gray-500">
                            案件金額: ¥{{ number_format($application->price) }}
                        </p>
                    @endif
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
                    <button type="button" onclick="location.href='{{ route('client.creator-applications.detail', $application) }}'" class="form-button">
                        戻る
                    </button>

                    <button type="submit" class="commit form-button">
                        依頼する
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
            const form = document.getElementById('applyForm');
            if (!form) return;

            form.addEventListener('submit', (event) => {
                if (!window.confirm('この案件に依頼します。よろしいですか？')) {
                    event.preventDefault();
                }
            });

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
