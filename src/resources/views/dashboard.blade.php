<x-app-layout>
    <div class="container mx-auto py-6 max-w-4xl">

        <div class="mt-6 mb-12">
            <h2 class="text-2xl font-bold mb-4">入力項目</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('crisis_plan.create') }}" class="bg-indigo-600 text-white py-4 text-center rounded-lg shadow">
                    クライシスプランを作成
                </a>
                <a href="{{ route('logs.create') }}" class="bg-indigo-600 text-white py-4 text-center rounded-lg shadow">
                    クライシスプランを記録
                </a>
                <a href="{{ route('wellness.create') }}" class="bg-indigo-600 text-white py-4 text-center rounded-lg shadow">
                    今日の体調を記録
                </a>
            </div>
        </div>

        <h2 class="text-2xl font-bold mb-4">最近の記録 (過去1週間)</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach ($logs as $dayLog)
                <div class="bg-white shadow rounded-lg p-4">
                    <h3 class="text-lg font-bold">{{ $dayLog['date'] }}</h3>

                    <!-- Wellness Logs -->
                    @if ($dayLog['wellness'])
                        <div class="mt-2">
                            <h4 class="font-semibold">元気度: {{ $dayLog['wellness']->mood_label }}</h4>
                        </div>
                    @else
                        <p class="text-gray-500">元気度の記録はありません。</p>
                    @endif

                    @if ($dayLog['crisis'])
                        <div class="mt-4">
                            <h4 class="font-semibold">クライシスプラン: {{ $dayLog['crisis']->status }}</h4>
                            <div class="mt-2">
                                <a href="{{ route('logs.edit', $dayLog['crisis']->id) }}" class="text-indigo-600">編集</a>
                            </div>
                        </div>
                    @else
                        <p class="text-gray-500">クライシスプランの記録はありません。</p>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="mt-6 text-right">
            <a href="{{ route('wellness.index') }}" class="text-indigo-600 font-semibold">元気度の記録一覧を見る</a> |
            <a href="{{ route('logs.index') }}" class="text-indigo-600 font-semibold">クライシスプランの記録一覧を見る</a>
        </div>
    </div>
</x-app-layout>
