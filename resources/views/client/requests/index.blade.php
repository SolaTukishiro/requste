<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">案件一覧</h2>
    </x-slot>

    <div class="p-6">
        @forelse($requests as $request)
            <div class="border-b py-2">{{ $request->title }}</div>
        @empty
            <p>案件はまだありません</p>
        @endforelse
    </div>
</x-app-layout>
