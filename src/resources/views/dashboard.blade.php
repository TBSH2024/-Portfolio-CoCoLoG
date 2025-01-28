<x-app-layout>
    @section('title', 'CocoLog / トップページ')
    <div class="container mx-auto py-6 max-w-4xl">

        <div class="mt-4 mb-12">
            <h2 class="text-2xl font-bold mb-4 text-center">さぁ、体調を記録しましょう！</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('wellness.create') }}" class="bg-sky-500 text-white font-bold py-4 text-center rounded-lg shadow hover:bg-sky-700">
                    今日の体調を記録
                </a>
                <a href="{{ route('logs.create') }}" class="bg-orange-500 text-white font-bold py-4 text-center rounded-lg shadow hover:bg-orange-700">
                    クライス･プランを記録する
                </a>
                <a href="{{ route('crisis_plan.create') }}" class="bg-green-500 text-white font-bold py-4 text-center rounded-lg shadow hover:bg-green-700">
                    クライシス･プランを作成
                </a>
            </div>
        </div>
        
        <div class="mb-10">
            <h2 class="text-2xl font-bold my-4">状態に応じた対処方法</h2>
            <div class="grid grid-cols-3 w-full rounded-lg">
                <div class="rounded-lg mr-2 bg-white border-2 border-sky-500 shadow p-4">
                    <h2 class="text-center border-b-2 border-blue-300 mb-4 font-semibold text-xl text-sky-500">安定状態</h2>
                    @if (!empty($crisisPlanTable->good_methods))
                        @foreach ($crisisPlanTable->good_methods as $method)
                        <p class="text-md">・{{ $method }}</p>
                        @endforeach
                    @else
                        <p class="text-md text-gray-500 text-center">登録されていません</p>
                    @endif
                </div>
                <div class="rounded-lg mr-2 bg-white border-2 border-yellow-500 shadow p-4">
                    <h2 class="text-center border-b-2 border-yellow-300 mb-4 font-semibold text-xl text-yellow-500">注意状態</h2>
                    @if (!empty($crisisPlanTable->neutral_methods))
                        @foreach ($crisisPlanTable->neutral_methods as $method)
                        <p class="text-md">・{{ $method }}</p>
                        @endforeach
                    @else
                        <p class="text-md text-gray-500 text-center">登録されていません</p>
                    @endif
                </div>
                <div class="rounded-lg mr-2 bg-white border-2 border-pink-500 shadow p-4">
                    <h2 class="text-center border-b-2 border-pink-300 mb-4 font-semibold text-xl text-pink-500">要注意状態</h2>
                    @if (!empty($crisisPlanTable->bad_methods))
                        @foreach ($crisisPlanTable->bad_methods as $method)
                        <p class="text-md">・{{ $method }}</p>
                        @endforeach
                    @else
                        <p class="text-md text-gray-500 text-center">登録されていません</p>
                    @endif
                </div>
            </div>
        </div>

        <h2 class="text-2xl font-bold mb-4">直近の記録 (過去1週間)</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach ($logs as $dayLog)
                <div class="bg-white shadow-lg rounded-lg p-4 border border-gray-200">
                    <h3 class="text-lg font-bold">{{ $dayLog['date'] }}</h3>

                    @if ($dayLog['wellness'])
                        <div class="mt-2">
                            <h4 class="text-gray-800 font-bold">総合点数：{{ $dayLog['wellness']['score'] }}</h4>
                        </div>
                    @else
                        <div class="mt-2">
                        <p class="text-gray-500">体調は記録されていません。</p>
                        </div>
                    @endif

                    @if ($dayLog['crisis'])
                        <div class="mt-2">
                            <h4 class="text-gray-800 font-bold">クライシスプランの評価：{{ $dayLog['crisis']->evaluation }}</h4>
                        </div>
                    @else
                        <div class="mt-1">
                            <p class="text-gray-500">クライシスプランの記録がされていません。</p>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="mt-6 text-right">
            <a href="{{ route('wellness.index') }}" class="text-blue-600 font-semibold">日々の体調記録一覧</a> |
            <a href="{{ route('logs.index') }}" class="text-blue-600 font-semibold">日々のクライシスプランの記録一覧</a>
        </div>
    </div>
</x-app-layout>
