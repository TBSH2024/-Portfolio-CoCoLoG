<x-app-layout>
    <section class="text-gray-600 body-font relative">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-col text-center w-full mb-4">
                @if (!$crisisPlanTable)
                    <div class="mb-4 p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700">
                        <p>まだクライシスプランが作成されていません。</p>
                        <a href="{{ route('crisis_plan.create') }}" class="text-indigo-500 underline">クライシスプランの作成はこちらをクリックしてください。</a>
                    </div>
                @else
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">{{ $user->name }}さんの日々の体調ログ</h1>
            </div>

            <div class="overflow-x-auto">
                <table class="table-auto w-full text-left">
                    <thead>
                        <tr class="bg-gray-100 text-gray-600">
                            <th class="px-6 py-3">日付</th>
                            <th class="px-6 py-3">良い状態</th>
                            <th class="px-6 py-3">普通の状態</th>
                            <th class="px-6 py-3">悪い状態</th>
                            <th class="px-6 py-3">リンク先</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logsByDay as $log)
                            <tr class="border-b">
                                <td class="px-6 py-3">{{ $log->input_date }}</td>

                                <td class="px-6 py-3">
                                    @if($log->good_actions)
                                        {{ implode(', ', $log->good_actions) }}
                                    @else
                                        <span class="text-gray-500">無し</span>
                                    @endif
                                </td>

                                <td class="px-6 py-3">
                                    @if($log->neutral_actions)
                                        {{ implode(', ', $log->neutral_actions) }}
                                    @else
                                        <span class="text-gray-500">無し</span>
                                    @endif
                                </td>

                                <td class="px-6 py-3">
                                    @if($log->bad_actions)
                                        {{ implode(', ', $log->bad_actions) }}
                                    @else
                                        <span class="text-gray-500">無し</span>
                                    @endif
                                </td>

                                <td class="px-6 py-3">
                                    <a href="{{ route('logs.edit', $log->id) }}" class="text-indigo-500 hover:text-indigo-600">編集</a>
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
