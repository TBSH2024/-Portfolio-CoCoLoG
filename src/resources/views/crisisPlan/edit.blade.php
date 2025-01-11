<x-app-layout>
    <section class="text-gray-600 body-font relative">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-col text-center w-full mb-4">
            @if (!$crisisPlan)
                <div class="mb-4 p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700">
                    <p>まだクライシスプランが作成されていません。</p>
                    <a href="{{ route('crisis_plan.create') }}" class="text-indigo-500 underline">クライシスプランの作成はこちらをクリックしてください。</a>
                </div>
                @else
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">{{ $user->name }}さんのクライシスプラン編集画面</h1>
            </div>
            <form method="POST" action="{{ route('crisis_plan.update', [$crisisPlan->id]) }}">
                @csrf
                @method('PUT')
                <div class="lg:w-1/2 md:w-2/3 mx-auto">
                    <div class="flex flex-wrap -m-2">

                        <div class="p-2 w-full">
                            <label for="good_actions" class="leading-7 text-sm text-gray-600">状態が良い時 (最大5つ)</label>
                            <div class="space-y-2">
                                @foreach ($crisisPlan->good_actions as $i => $action)
                                    <input type="text" id="good_action_{{ $i + 1 }}" name="good_actions[]" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" placeholder="状態 {{ $i }}つ目" value="{{ old('good_actions.' . $i, $action) }}">
                                @endforeach
                            </div>
                        </div>

                        <div class="p-2 w-full">
                            <label for="neutral_actions" class="leading-7 text-sm text-gray-600">状態が普通の時 (最大5つ)</label>
                            <div class="space-y-2">
                                @foreach ($crisisPlan->neutral_actions as $i => $action)
                                    <input type="text" id="neutral_action_{{ $i }}" name="neutral_actions[]" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" placeholder="状態 {{ $i + 1 }}つ目" value="{{ old('neutral_actions.' . $i, $action) }}">
                                @endforeach
                            </div>
                        </div>

                        <div class="p-2 w-full">
                            <label for="bad_actions" class="leading-7 text-sm text-gray-600">状態が悪い時 (最大5つ)</label>
                            <div class="space-y-2">
                                @foreach ($crisisPlan->bad_actions as $i => $action)
                                    <input type="text" id="bad_action_{{ $i }}" name="bad_actions[]" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" placeholder="状態 {{ $i + 1 }}つ目" value="{{ old('bad_actions.' . $i, $action) }}">
                                @endforeach
                            </div>
                        </div>

                        <div class="p-2 w-full">
                            <button type="submit" class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">クライシスプランを更新する</button>
                        </div>
                    </div>
                </div>
            </form>
            <form method="POST" action="{{ route('crisis_plan.destroy', [$crisisPlan->id]) }}">
            @csrf
            @method('DELETE')
            <div class="p-2 w-full mt-2">
                <button type="submit" class="flex mx-auto text-white bg-pink-500 border-0 py-2 px-8 focus:outline-none hover:bg-pink-600 rounded text-lg">クライシスプランを削除する</button>
            </div>
            @endif
            </form>
        </div>
    </section>
</x-app-layout>
