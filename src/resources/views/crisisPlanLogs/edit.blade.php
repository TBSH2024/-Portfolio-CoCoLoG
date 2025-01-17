<x-app-layout>
    @section('title', 'CocoLog / クライシスプラン記録の編集')
    <section class="text-gray-600 body-font relative">
        <div class="container px-5 py-24 mx-auto max-w-6xl">
            <div class="flex flex-col text-center w-full mb-6">
                </div>
                <form method="POST" action="{{ route('logs.update', [$crisisPlanLog->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <div class="mb-6 text-left">
                            <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900 text-center">
                                {{ $formattedDate }}の状態を編集
                            </h1>
                        <label for="date" class="block text-lg font-semibold text-gray-800 mb-2">入力日</label>
                        <input type="date" id="date" name="input_date" 
                               class="w-1/4 bg-gray-100 rounded border border-gray-300 py-3 px-5 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                               value="{{ old('input_date', $crisisPlanLog->input_date) }}">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @if ($crisisPlanTable->good_actions && count(array_filter($crisisPlanTable->good_actions)) > 0)
                            <div class="border rounded-lg p-6 bg-white shadow-lg">
                                <h2 class="text-lg font-semibold text-gray-800 text-center mb-4 border-b-2 border-blue-500">安定状態</h2>
                                <div class="space-y-2">
                                    @foreach (array_filter($crisisPlanTable->good_actions) as $i => $action)
                                        <div class="flex items-center">
                                            <input type="checkbox" id="good_action_{{ $i }}" name="good_actions[]" 
                                                   value="{{ $action }}" class="mr-3 text-indigo-500"
                                                   {{ in_array($action, old('good_actions', $crisisPlanLog->good_actions)) ? 'checked' : '' }}>
                                            <label for="good_action_{{ $i }}" class="text-gray-700">{{ $action }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- 状態が普通の時 --}}
                        @if ($crisisPlanTable->neutral_actions && count(array_filter($crisisPlanTable->neutral_actions)) > 0)
                            <div class="border rounded-lg p-6 bg-white shadow-lg">
                                <h2 class="text-lg font-semibold text-gray-800 text-center mb-4 border-b-2 border-yellow-500">注意状態</h2>
                                <div class="space-y-2">
                                    @foreach (array_filter($crisisPlanTable->neutral_actions) as $i => $action)
                                        <div class="flex items-center">
                                            <input type="checkbox" id="neutral_action_{{ $i }}" name="neutral_actions[]" 
                                                   value="{{ $action }}" class="mr-3 text-yellow-500"
                                                   {{ in_array($action, old('neutral_actions', $crisisPlanLog->neutral_actions)) ? 'checked' : '' }}>
                                            <label for="neutral_action_{{ $i }}" class="text-gray-700">{{ $action }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if ($crisisPlanTable->bad_actions && count(array_filter($crisisPlanTable->bad_actions)) > 0)
                            <div class="border rounded-lg p-6 bg-white shadow-lg">
                                <h2 class="text-lg font-semibold text-gray-800 text-center mb-4 border-b-2 border-pink-500">要注意状態</h2>
                                <div class="space-y-2">
                                    @foreach (array_filter($crisisPlanTable->bad_actions) as $i => $action)
                                        <div class="flex items-center">
                                            <input type="checkbox" id="bad_action_{{ $i }}" name="bad_actions[]" 
                                                   value="{{ $action }}" class="mr-3 text-pink-500"
                                                   {{ in_array($action, old('bad_actions', $crisisPlanLog->bad_actions)) ? 'checked' : '' }}>
                                            <label for="bad_action_{{ $i }}" class="text-gray-700">{{ $action }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="my-6 text-left">
                        <label for="level" class="block text-lg font-semibold text-gray-800 mb-2">総合評価</label>
                        <select class="block text-lg text-gray-800 mb-2">
                            <option value="">選択してください</option>
                            <option value="1">安定状態</option>
                            <option value="2">安定状態〜注意状態</option>
                            <option value="3">注意状態</option>
                            <option value="4">注意状態〜要注意状態</option>
                            <option value="5">要注意状態</option>
                        </select>
                    </div>

                    <div class="mt-8 text-center">
                        <button type="submit" class="text-white bg-indigo-500 border-0 py-3 px-10 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                            更新する
                        </button>
                    </div>
                </form>
    
                <form method="POST" action="{{ route('logs.destroy', ['id' => $crisisPlanLog->id]) }}">
                    @csrf
                    @method('DELETE')
                    <div class="mt-8 text-center">
                        <button type="submit" class="confirm_delete text-white bg-pink-500 border-0 py-3 px-10 focus:outline-none hover:bg-pink-600 rounded text-lg cursor:pointer">
                            削除する
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>
