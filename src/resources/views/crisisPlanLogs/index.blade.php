<x-app-layout>
    @section('title', 'CocoLog / クライシスプラン記録一覧')
    <section class="text-gray-600 body-font relative">
        <div class="container px-5 py-6 mx-auto">
            <div class="flex flex-col text-center w-full mb-4">
                @if (!$crisisPlanTable)
                    <div class="mb-4 p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700">
                        <p>まだクライシスプランが作成されていません。</p>
                        <a href="{{ route('crisis_plan.create') }}" class="text-indigo-500 underline">クライシスプランの作成はこちらをクリックしてください。</a>
                    </div>
                @elseif ($logsByDay->isEmpty())
                    <div class="mb-4 p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700">
                        <p>まだデータが入力されていません。</p>
                        <a href="{{ route('logs.create') }}" class="text-indigo-500 underline">体調ログの入力はこちら</a>
                    </div>
                @else
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">{{ $user->name }}さんのクライシスプラン記録一覧</h1>
            </div>

            <div class="overflow-x-auto">
                <table class="table-auto w-4/5 text-center mx-auto" style="table-layout: fixed;">
                    <thead>
                        <tr class="bg-sky-500 text-white text-bold">
                            <th class="px-6 py-3" style="width: 13%;">日付</th>
                            <th class="px-6 py-3" style="width: 12%;">総合評価</th>
                            <th class="px-6 py-3" style="width: 25.3%;">良い状態</th>
                            <th class="px-6 py-3" style="width: 25.3%;">普通の状態</th>
                            <th class="px-6 py-3" style="width: 25.3%;">悪い状態</th>
                            <th class="px-6 py-3" style="width: 12%;">リンク先</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logsByDay as $log)
                            <tr class="border-b-2 border-gray-200 bg-white">
                                <td class="px-6 py-3" style="word-wrap: break-word;">{{ $log->input_date }}</td>

                                <td class="px-6 py-3 text-sm" style="word-wrap: break-word;">
                                    {{ $log->evaluation}}
                                </td>

                                <td class="px-6 py-3 text-sm" style="word-wrap: break-word;">
                                    @if($log->good_actions)
                                        {{ implode(', ', $log->good_actions) }}
                                    @else
                                        <span class="text-gray-500">無し</span>
                                    @endif
                                </td>

                                <td class="px-6 py-3 text-sm" style="word-wrap: break-word;">
                                    @if($log->neutral_actions)
                                        {{ implode(', ', $log->neutral_actions) }}
                                    @else
                                        <span class="text-gray-500">無し</span>
                                    @endif
                                </td>

                                <td class="px-6 py-3 text-sm" style="word-wrap: break-word;">
                                    @if($log->bad_actions)
                                        {{ implode(', ', $log->bad_actions) }}
                                    @else
                                        <span class="text-gray-500">無し</span>
                                    @endif
                                </td>

                                <td class="px-6 py-3">
                                    <a href="{{ route('logs.edit', $log->id) }}" class="text-sm text-indigo-500 hover:text-indigo-600">編集/削除</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </section>
</x-app-layout>
