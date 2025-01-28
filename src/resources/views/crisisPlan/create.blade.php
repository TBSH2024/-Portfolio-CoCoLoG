<x-app-layout>
  @section('title', 'CocoLog / クライシスプランの作成')
  <section class="text-gray-600 body-font relative">
    <div class="container px-4 max-w-7xl mx-auto mt-2">
      <div class="flex flex-col text-center w-full mb-2">
        @if ($crisisPlan)
          <div class="mb-4 p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700">
            <p class="font-semibold">既にクライシスプランが作成されています。</p>
            <a href="{{ route('crisis_plan.edit', $crisisPlan->id) }}" class="text-indigo-500 underline">編集する場合はこちらをクリックしてください。</a>
          </div>
        @endif
      </div>

      @if (!$crisisPlan)
      <form method="POST" action="{{ route('crisis_plan.store') }}">
        @csrf
        <div class="lg:w-2/3 md:w-3/4 sm:w-full mx-auto bg-white p-10 rounded-lg shadow-lg">
          <h1 class="sm:text-3xl text-2xl font-medium title-font mb-6 text-gray-900 text-center">{{ $user->name }}さんのクライシスプラン作成画面</h1>
          
          <div class="grid grid-cols-2 gap-8 mb-8">
            <!-- 安定状態 -->
            <div>
              <label for="good_actions" class="leading-7 text-md font-semibold text-blue-600 border-b-2 border-blue-300">安定状態の項目 (最大5つ)</label>
              @error('good_actions')
                <span class="text-red-500 text-sm">{{ $message }}</span>
              @enderror
              <div class="space-y-4">
                @for ($i = 1; $i <= 5; $i++)
                  <input type="text" id="good_action_{{ $i }}" name="good_actions[]" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-2 px-4 transition-colors duration-200 ease-in-out" placeholder="{{ $i }}つ目" value="{{ old('good_actions.' . ($i - 1)) }}">
                @endfor
              </div>
            </div>

            <div>
              <label for="good_methods" class="leading-7 text-md font-semibold text-blue-600 border-b-2 border-blue-300">安定状態の対処法 (最大3つ)</label>
              @error('good_methods')
                <span class="text-red-500 text-sm">{{ $message }}</span>
              @enderror
              <div class="space-y-4">
                @for ($i = 1; $i <= 3; $i++)
                  <input type="text" id="good_method_{{ $i }}" name="good_methods[]" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-2 px-4 transition-colors duration-200 ease-in-out" placeholder="{{ $i }}つ目" value="{{ old('good_methods.' . ($i - 1)) }}">
                @endfor
              </div>
            </div>
          </div>

          <div class="grid grid-cols-2 gap-8 mb-8">
            <!-- 注意状態 -->
            <div>
              <label for="neutral_actions" class="leading-7 text-md font-semibold text-yellow-600 border-b-2 border-yellow-300">注意状態の項目 (最大5つ)</label>
              @error('neutral_actions')
                <span class="text-red-500 text-sm">{{ $message }}</span>
              @enderror
              <div class="space-y-4">
                @for ($i = 1; $i <= 5; $i++)
                  <input type="text" id="neutral_action_{{ $i }}" name="neutral_actions[]" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-yellow-500 focus:bg-white focus:ring-2 focus:ring-yellow-200 text-base outline-none text-gray-700 py-2 px-4 transition-colors duration-200 ease-in-out" placeholder="{{ $i }}つ目" value="{{ old('neutral_actions.' . ($i - 1)) }}">
                @endfor
              </div>
            </div>

            <div>
              <label for="neutral_methods" class="leading-7 text-md font-semibold text-yellow-600 border-b-2 border-yellow-300">注意状態の対処法 (最大3つ)</label>
              @error('neutral_methods')
                <span class="text-red-500 text-sm">{{ $message }}</span>
              @enderror
              <div class="space-y-4">
                @for ($i = 1; $i <= 3; $i++)
                  <input type="text" id="neutral_method_{{ $i }}" name="neutral_methods[]" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-yellow-500 focus:bg-white focus:ring-2 focus:ring-yellow-200 text-base outline-none text-gray-700 py-2 px-4 transition-colors duration-200 ease-in-out" placeholder="{{ $i }}つ目" value="{{ old('neutral_methods.' . ($i - 1)) }}">
                @endfor
              </div>
            </div>
          </div>

          <div class="grid grid-cols-2 gap-8 mb-8">
            <!-- 要注意状態 -->
            <div>
              <label for="bad_actions" class="leading-7 text-md font-semibold text-pink-600 border-b-2 border-pink-300">要注意状態の項目 (最大5つ)</label>
              @error('bad_actions')
                <span class="text-red-500 text-sm">{{ $message }}</span>
              @enderror
              <div class="space-y-4">
                @for ($i = 1; $i <= 5; $i++)
                  <input type="text" id="bad_action_{{ $i }}" name="bad_actions[]" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-pink-500 focus:bg-white focus:ring-2 focus:ring-pink-200 text-base outline-none text-gray-700 py-2 px-4 transition-colors duration-200 ease-in-out" placeholder="{{ $i }}つ目" value="{{ old('bad_actions.' . ($i - 1)) }}">
                @endfor
              </div>
            </div>

            <div>
              <label for="bad_methods" class="leading-7 text-md font-semibold text-pink-600 border-b-2 border-pink-300">要注意状態の対処法 (最大3つ)</label>
              @error('bad_methods')
                <span class="text-red-500 text-sm">{{ $message }}</span>
              @enderror
              <div class="space-y-4">
                @for ($i = 1; $i <= 3; $i++)
                  <input type="text" id="bad_method_{{ $i }}" name="bad_methods[]" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-pink-500 focus:bg-white focus:ring-2 focus:ring-pink-200 text-base outline-none text-gray-700 py-2 px-4 transition-colors duration-200 ease-in-out" placeholder="{{ $i }}つ目" value="{{ old('bad_methods.' . ($i - 1)) }}">
                @endfor
              </div>
            </div>
          </div>

          <div class="text-center mt-6">
            <button type="submit" class="text-white bg-indigo-500 border-0 py-2 px-10 focus:outline-none hover:bg-indigo-600 rounded text-lg transition-colors duration-300">クライシスプランを作成</button>
          </div>
        </div>
      </form>
      @endif
    </div>
  </section>
</x-app-layout>
