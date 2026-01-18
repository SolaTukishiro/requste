<x-app-layout>
    <x-slot name="header">
        <h2 class="application-index__page-title">削除依頼一覧</h2>
    </x-slot>
    <section class="application-index">
        <div class="application-index__container">
            <div class="application-index__grid">
                @forelse($applications as $application)
                    <a class="application-index__card" href="{{route('creator.applications.deleted.detail', $application->id)}}">
                        <div class="application-index__card-header">
                            <div>
                                <p class="application-index__creator">{{ $application->creator->name }}</p>
                                <h3 class="application-index__title">{{ $application->title }}</h3>
                            </div>
                            @if($application->status)
                                <span class="application-index__badge is-open">受付中</span>
                            @else
                                <span class="application-index__badge is-closed">受付終了中</span>
                            @endif
                        </div>
                        <p class="application-index__description">
                            {{ \Illuminate\Support\Str::limit($application->description, 120) }}
                        </p>
                        <div class="application-index__meta">
                            <span class="application-index__price">¥{{ number_format($application->price) }}</span>
                            <span class="application-index__date">
                                {{ $application->created_at->format('Y/m/d') }}
                            </span>
                        </div>
                    </a>
                @empty
                    <div class="application-index__empty">
                        <p class="application-index__empty-title">削除した案件はまだありません</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</x-app-layout>
