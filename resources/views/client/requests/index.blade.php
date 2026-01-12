<x-app-layout>
    <x-slot name="header">
        <h2 class="request-index__page-title">案件一覧</h2>
    </x-slot>
    <section class="request-index">
        <div class="request-index__container">
            <div class="request-index__grid">
                @forelse($requests as $request)
                    <a class="request-index__card" href="{{ route('client.requests.detail', $request->id) }}">
                        <div class="request-index__card-header">
                            <div>
                                <p class="request-index__client">{{ $request->client->name }}</p>
                                <h3 class="request-index__title">{{ $request->title }}</h3>
                            </div>
                            @if($request->status)
                                <span class="request-index__badge is-open">受付中</span>
                            @else
                                <span class="request-index__badge is-closed">受付終了中</span>
                            @endif
                        </div>
                        <p class="request-index__description">
                            {{ \Illuminate\Support\Str::limit($request->description, 120) }}
                        </p>
                        <div class="request-index__meta">
                            <span class="request-index__price">¥{{ number_format($request->price) }}</span>
                            <span class="request-index__date">
                                {{ $request->created_at->format('Y/m/d') }}
                            </span>
                        </div>
                    </a>
                @empty
                    <div class="request-index__empty">
                        <p class="request-index__empty-title">案件はまだありません</p>
                        <p class="request-index__empty-text">新しい案件が登録されるとここに表示されます。</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</x-app-layout>
