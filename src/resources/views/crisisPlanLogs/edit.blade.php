<x-app-layout>
    <section class="text-gray-600 body-font relative">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-col text-center w-full mb-6">
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">
                    {{ $formattedDate }}の体調を編集
                </h1>
            </div>
            <form method="POST" action="{{ route('logs.update', [$crisisPlanLog->id]) }}">
                @csrf
                @method('PUT')
                <div class="lg:w-3/4 md:w-full mx-auto">
                    <div class="mb-6 text-left">
                        <label for="date" class="block text-lg font-semibold text-gray-800 mb-1">入力日</label>
                        <input type="date" id="date" name="input_date" 
                               class="w-full md:w-1/3 bg-gray-100 rounded border border-gray-300 py-2 px-4"
                               value="{{ old('input_date', $crisisPlanLog->input_date) }}">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @if ($crisisPlanTable->good_actions && count(array_filter($crisisPlanTable->good_actions)) > 0)
                            <div class="border rounded-lg p-4">
                                <h2 class="text-lg font-semibold text-gray-800 text-center mb-2">状態が良い時</h2>
                                <div class="space-y-2">
                                    @foreach (array_filter($crisisPlanTable->good_actions) as $i => $action)
                                        <div class="flex items-center">
                                            <input type="checkbox" id="good_action_{{ $i }}" name="good_actions[]" 
                                                   value="{{ $action }}" class="mr-2"
                                                   {{ in_array($action, old('good_actions', $crisisPlanLog->good_actions)) ? 'checked' : '' }}>
                                            <label for="good_action_{{ $i }}" class="text-gray-700">{{ $action }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if ($crisisPlanTable->neutral_actions && count(array_filter($crisisPlanTable->neutral_actions)) > 0)
                            <div class="border rounded-lg p-4">
                                <h2 class="text-lg font-semibold text-gray-800 text-center mb-2">状態が普通の時</h2>
                                <div class="space-y-2">
                                    @foreach (array_filter($crisisPlanTable->neutral_actions) as $i => $action)
                                        <div class="flex items-center">
                                            <input type="checkbox" id="neutral_action_{{ $i }}" name="neutral_actions[]" 
                                                   value="{{ $action }}" class="mr-2"
                                                   {{ in_array($action, old('neutral_actions', $crisisPlanLog->neutral_actions)) ? 'checked' : '' }}>
                                            <label for="neutral_action_{{ $i }}" class="text-gray-700">{{ $action }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if ($crisisPlanTable->bad_actions && count(array_filter($crisisPlanTable->bad_actions)) > 0)
                            <div class="border rounded-lg p-4">
                                <h2 class="text-lg font-semibold text-gray-800 text-center mb-2">状態が悪い時</h2>
                                <div class="space-y-2">
                                    @foreach (array_filter($crisisPlanTable->bad_actions) as $i => $action)
                                        <div class="flex items-center">
                                            <input type="checkbox" id="bad_action_{{ $i }}" name="bad_actions[]" 
                                                   value="{{ $action }}" class="mr-2"
                                                   {{ in_array($action, old('bad_actions', $crisisPlanLog->bad_actions)) ? 'checked' : '' }}>
                                            <label for="bad_action_{{ $i }}" class="text-gray-700">{{ $action }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="mt-8 text-center">
                        <button type="submit" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                            更新する
                        </button>
                    </div>
                </div>
            </form>

            <form method="POST" action="{{ route('logs.destroy', ['id' => $crisisPlanLog->id]) }}">
                @csrf
                @method('DELETE')
                <div class="mt-8 text-center">
                    <button type="submit" class="text-white bg-pink-500 border-0 py-2 px-8 focus:outline-none hover:bg-pink-600 rounded text-lg">
                        削除する
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>
