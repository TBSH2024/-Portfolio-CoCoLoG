<x-app-layout>
    <div class="container mx-auto py-6">
        <!-- グラフセクション -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-4">健康状態の推移</h2>
            <div class="bg-white shadow rounded-lg p-6">
                <canvas id="healthChart"></canvas>
                <div class="mt-4 text-right">
                    <select id="timeRange" class="border rounded px-4 py-2">
                        <option value="7">過去1週間</option>
                        <option value="30">過去1か月</option>
                        <option value="all">全期間</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- 横並びの記録セクション -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-4">最近の記録</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Wellness Logs -->
                @foreach ($wellnessLogs as $log)
                <div class="bg-white shadow rounded-lg p-4">
                    <h3 class="text-lg font-bold">元気度: {{ $log->score }}</h3>
                    <p class="text-gray-600">{{ $log->comment }}</p>
                    <div class="mt-4">
                        <a href="{{ route('wellness.edit', $log->id) }}" class="text-indigo-600">編集</a> |
                        <form action="{{ route('wellness.destroy', $log->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600">削除</button>
                        </form>
                    </div>
                </div>
                @endforeach

                <!-- Crisis Plan Logs -->
                @foreach ($crisisPlanLogs as $log)
                <div class="bg-white shadow rounded-lg p-4">
                    <h3 class="text-lg font-bold">状態: {{ $log->state }}</h3>
                    <p class="text-gray-600">アクション: {{ implode(', ', $log->actions) }}</p>
                    <div class="mt-4">
                        <a href="{{ route('logs.edit', $log->id) }}" class="text-indigo-600">編集</a> |
                        <form action="{{ route('logs.destroy', $log->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600">削除</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- クイックアクセスセクション -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-4">クイックアクセス</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('crisis_plan.create') }}" class="bg-indigo-600 text-white py-4 text-center rounded-lg">
                    クライシスプランを作成
                </a>
                <a href="{{ route('logs.create') }}" class="bg-indigo-600 text-white py-4 text-center rounded-lg">
                    クライシスプランログを入力
                </a>
                <a href="{{ route('wellness.create') }}" class="bg-indigo-600 text-white py-4 text-center rounded-lg">
                    今日の体調を記録
                </a>
            </div>
        </div>
    </div>

    <script>
        // Chart.jsのグラフ描画スクリプト (仮)
        const ctx = document.getElementById('healthChart').getContext('2d');
        const healthChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($labels), // 日付の配列
                datasets: [
                    {
                        label: '元気度スコア',
                        data: @json($scores), // スコアの配列
                        borderColor: 'rgba(75, 192, 192, 1)',
                        tension: 0.1,
                    },
                ],
            },
        });
    </script>
</x-app-layout>