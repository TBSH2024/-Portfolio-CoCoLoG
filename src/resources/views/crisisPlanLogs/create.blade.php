<x-app-layout>
    <section class="text-gray-600 body-font relative">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-col text-center w-full mb-6">
                @if ($crisisPlanLog)
                <div class="mb-4 p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700">
                    <p>既に本日の体調は入力されています。</p>
                    <a href="{{ route('logs.edit', [$crisisPlanLog->id]) }}" class="text-indigo-500 underline">編集する場合はこちらをクリックしてください。</a>
                </div>
                @endif
                @if (!$crisisPlanTable)
                <div class="mb-4 p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700">
                    <p>まだクライシスプランが作成されていません。</p>
                    <a href="{{ route('crisis_plan.create') }}" class="text-indigo-500 underline">クライシスプランの作成はこちらをクリックしてください。</a>
                </div>
                @else
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">
                    {{ $user->name }}さんの日々の体調入力
                </h1>
            </div>
            <form method="POST" action="{{ route('logs.store') }}">
                @csrf
                <div class="lg:w-3/4 md:w-full mx-auto">
                    {{-- 入力日 --}}
                    <div class="mb-6 text-left">
                        <label for="date" class="block text-lg font-semibold text-gray-800 mb-1">入力日</label>
                        <input type="date" id="date" name="input_date" 
                               class="w-full md:w-1/3 bg-gray-100 rounded border border-gray-300 py-2 px-4"
                               value="{{ old('date', now()->toDateString()) }}">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        {{-- 状態が良い時 --}}
                        @if (!empty($crisisPlanTable->good_actions))
                            <div class="border rounded-lg p-4">
                                <h2 class="text-lg font-semibold text-gray-800 text-center mb-2">状態が良い時</h2>
                                <div class="space-y-2">
                                    @foreach ($crisisPlanTable->good_actions as $i => $action)
                                        @if ($action)
                                            <div class="flex items-center">
                                                <input type="checkbox" id="good_action_{{ $i }}" name="good_actions[]" 
                                                       value="{{ $action }}" class="mr-2"
                                                       {{ in_array($action, old('good_actions', [])) ? 'checked' : '' }}>
                                                <label for="good_action_{{ $i }}" class="text-gray-700">{{ $action }}</label>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- 状態が普通の時 --}}
                        @if (!empty($crisisPlanTable->neutral_actions))
                            <div class="border rounded-lg p-4">
                                <h2 class="text-lg font-semibold text-gray-800 text-center mb-2">状態が普通の時</h2>
                                <div class="space-y-2">
                                    @foreach ($crisisPlanTable->neutral_actions as $i => $action)
                                        @if ($action)
                                            <div class="flex items-center">
                                                <input type="checkbox" id="neutral_action_{{ $i }}" name="neutral_actions[]" 
                                                       value="{{ $action }}" class="mr-2"
                                                       {{ in_array($action, old('neutral_actions', [])) ? 'checked' : '' }}>
                                                <label for="neutral_action_{{ $i }}" class="text-gray-700">{{ $action }}</label>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- 状態が悪い時 --}}
                        @if (!empty($crisisPlanTable->bad_actions))
                            <div class="border rounded-lg p-4">
                                <h2 class="text-lg font-semibold text-gray-800 text-center mb-2">状態が悪い時</h2>
                                <div class="space-y-2">
                                    @foreach ($crisisPlanTable->bad_actions as $i => $action)
                                        @if ($action)
                                            <div class="flex items-center">
                                                <input type="checkbox" id="bad_action_{{ $i }}" name="bad_actions[]" 
                                                       value="{{ $action }}" class="mr-2"
                                                       {{ in_array($action, old('bad_actions', [])) ? 'checked' : '' }}>
                                                <label for="bad_action_{{ $i }}" class="text-gray-700">{{ $action }}</label>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- 提出ボタン --}}
                    <div class="mt-8 text-center">
                        <button type="submit" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                            状態を記録する
                        </button>
                    </div>
                </div>
            @endif
            </form>
        </div>
    </section>
    <script>
    // 日付入力フィールドに今日の日付をセット
    document.getElementById('date').valueAsDate = new Date();
  </script>
</x-app-layout>
