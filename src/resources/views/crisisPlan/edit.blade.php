<x-app-layout>
    @section('title', 'CocoLog / クライシスプランの編集')
    <section class="text-gray-600 body-font relative">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-col text-center w-full mb-4">
            @if (!$crisisPlan)
                <div class="mb-4 p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700">
                    <p>まだクライシスプランが作成されていません。</p>
                    <a href="{{ route('crisis_plan.create') }}" class="text-indigo-500 underline">クライシスプランの作成はこちらをクリックしてください。</a>
                </div>
            @else
        </div>
        <form method="POST" action="{{ route('crisis_plan.update', [$crisisPlan->id]) }}">
            @csrf
            @method('PUT')
            <div class="lg:w-2/3 md:w-3/4 sm:w-full mx-auto bg-white p-10 rounded-lg shadow-lg">
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-6 text-gray-900 text-center">{{ $user->name }}さんのクライシスプラン編集画面</h1>
                    <div class="flex flex-wrap -m-2">

                        <!-- 安定している時の項目 -->
                        <div class="p-2 lg:w-3/4 mx-auto">
                            <label for="good_actions" class="leading-7 text-sm text-gray-600 border-b-2 border-blue-500">安定している時の項目 (最大5つ)</label>
                            <div class="space-y-4">
                                @for ($i = 0; $i < 5; $i++)
                                    <input type="text" id="good_action_{{ $i + 1 }}" name="good_actions[]" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-2 px-4 leading-8 transition-colors duration-200 ease-in-out" placeholder="状態 {{ $i + 1 }}つ目" value="{{ old('good_actions.' . $i, $crisisPlan->good_actions[$i] ?? '') }}">
                                    @error('good_actions.' . $i)
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                @endfor
                            </div>
                        </div>

                        <!-- 注意状態の項目 -->
                        <div class="p-2 lg:w-3/4 mx-auto">
                            <label for="neutral_actions" class="leading-7 text-sm text-gray-600 border-b-2 border-yellow-500">注意状態の項目 (最大5つ)</label>
                            <div class="space-y-4">
                                @for ($i = 0; $i < 5; $i++)
                                    <input type="text" id="neutral_action_{{ $i }}" name="neutral_actions[]" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-2 px-4 leading-8 transition-colors duration-200 ease-in-out" placeholder="状態 {{ $i + 1 }}つ目" value="{{ old('neutral_actions.' . $i, $crisisPlan->neutral_actions[$i] ?? '') }}">
                                    @error('neutral_actions.' . $i)
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                @endfor
                            </div>
                        </div>

                        <!-- 要注意状態の項目 -->
                        <div class="p-2 lg:w-3/4 mx-auto">
                            <label for="bad_actions" class="leading-7 text-sm text-gray-600 border-b-2 border-pink-500">要注意状態の項目 (最大5つ)</label>
                            <div class="space-y-4">
                                @for ($i = 0; $i < 5; $i++)
                                    <input type="text" id="bad_action_{{ $i }}" name="bad_actions[]" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-2 px-4 leading-8 transition-colors duration-200 ease-in-out" placeholder="状態 {{ $i + 1 }}つ目" value="{{ old('bad_actions.' . $i, $crisisPlan->bad_actions[$i] ?? '') }}">
                                    @error('bad_actions.' . $i)
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                @endfor
                            </div>
                        </div>

                        <!-- 更新ボタン -->
                        <div class="p-2 w-full">
                            <button type="submit" class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-10 mt-4 focus:outline-none hover:bg-indigo-600 rounded text-lg transition-colors duration-300">クライシスプランを更新する</button>
                        </div>
                    </div>
                </form>
                <form method="POST" action="{{ route('crisis_plan.destroy', [$crisisPlan->id]) }}">
                    @csrf
                    @method('DELETE')
                    <div class="p-2 w-full mt-2">
                        <button type="submit" class="confirm_delete flex mx-auto text-white bg-pink-500 border-0 py-2 px-10 focus:outline-none hover:bg-pink-600 rounded text-lg transition-colors duration-300">クライシスプランを削除する</button>
                    </div>
                </form>
                @endif
                </div>
        </div>
    </section>
</x-app-layout>
