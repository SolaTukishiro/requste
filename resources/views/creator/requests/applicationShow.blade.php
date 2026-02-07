{{-- resources/views/creator/requests/apply.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">応募済依頼一覧</h2>
    </x-slot>

    <div class="request-index__container">
        <div class="request-index__grid">
            @forelse($applicationList as $application)
                <a class="request-index__card" href="{{route('creator.requests.applications.show.detail', $application)}}">
                    <div class="request-index__card-header">
                        <div>
                            <p class="request-index__client">{{ $application->request->client->name }}</p>
                            <h3 class="request-index__title">{{ $application->request->title }}</h3>
                        </div>
                        @if($application->status?->value === 'pending')
                            <span class="request-index__badge is-pending">選考中</span>
                        @elseif($application->status?->value === 'accepted')
                            <span class="request-index__badge is-accepted">採用</span>
                        @elseif($application->status?->value === 'rejected')
                            <span class="request-index__badge is-rejected">見送り</span>
                        @endif
                    </div>
                    <p class="request-index__description">
                        {{ \Illuminate\Support\Str::limit($application->message, 120) }}
                    </p>
                    <div class="request-index__meta">
                        <span class="request-index__price">¥{{ number_format($application->proposed_price) }}</span>
                        <span class="request-index__date">
                                {{ $application->created_at->format('Y/m/d') }}
                        </span>
                    </div>
                </a>
            @empty
                <div class="request-index__empty">
                    <p class="request-index__empty-title">応募した依頼はまだありません</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
