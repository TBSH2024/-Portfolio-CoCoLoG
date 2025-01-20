<x-app-layout>
  @section('title', 'CocoLog / 体調入力')
  <section class="text-gray-600 body-font relative">
    <div class="container px-4 max-w-7xl mx-auto mt-2">
      <div class="flex flex-col text-center w-full mb-2">
        @if ($wellnessLog)
          <div class="p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700">
              <p class="font-semibold">既に本日の体調は入力されています。</p>
              <a href="{{ route('wellness.edit', [$wellnessLog->id]) }}" class="text-indigo-500 underline">編集する場合はこちらをクリックしてください。</a>
          </div>
        @endif
      </div>

      <div class="w-2/3 mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h1 class="sm:text-3xl text-2xl font-bold text-center title-font mb-8 text-gray-900 border-b-2 pb-4 border-gray-200">今日の体調</h1>
        @error('input_date')
          <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
        <form action="{{ route('wellness.store') }}" method="POST">
        @csrf
          <div class="flex flex-col">
            <div class="mb-4">
              <label for="input_date" class="leading-7 text-sm text-gray-600 block">入力日<span class="text-xs text-pink-500">（必須）</span></label>
              <input type="date" id="input_date" name="input_date" class="w-1/3 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:ring-2">
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <label for="energy_level" class="leading-7 text-sm text-gray-600">元気度<span class="text-xs text-pink-500">（必須）</span></label>
                <div class="flex space-x-4">
                  <label><input type="radio" name="energy_level" value="0" {{ old('energy_level') == 0 ? 'checked' : '' }} /> 元気</label>
                  <label><input type="radio" name="energy_level" value="1" {{ old('energy_level') == 1 ? 'checked' : '' }} /> 普通</label>
                  <label><input type="radio" name="energy_level" value="2" {{ old('energy_level') == 2 ? 'checked' : '' }} /> 疲れている</label>
                </div>
                @error('energy_level')
                  <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
              </div>

              <div>
                <label for="sleep_quality" class="leading-7 text-sm text-gray-600">昨日の睡眠の質<span class="text-xs text-pink-500">（必須）</span></label>
                <div class="flex space-x-4">
                  <label><input type="radio" name="sleep_quality" value="0" {{ old('sleep_quality') == 0 ? 'checked' : '' }} /> よく眠れた</label>
                  <label><input type="radio" name="sleep_quality" value="1" {{ old('sleep_quality') == 1 ? 'checked' : '' }} /> まぁまぁ</label>
                  <label><input type="radio" name="sleep_quality" value="2" {{ old('sleep_quality') == 2 ? 'checked' : '' }} /> 眠れなかった</label>
                </div>
                @error('sleep_quality')
                  <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
              </div>

              <div>
                <label for="mood" class="leading-7 text-sm text-gray-600">気分<span class="text-xs text-pink-500">（必須）</span></label>
                <select name="mood" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 mr-30 leading-8 transition-colors duration-200 ease-in-out">
                  <option value="">選択してください</option>
                  <option value="1" {{ old('mood') == 1 ? 'selected' : '' }}>非常に良い</option>
                  <option value="2" {{ old('mood') == 2 ? 'selected' : '' }}>良い</option>
                  <option value="3" {{ old('mood') == 3 ? 'selected' : '' }}>普通</option>
                  <option value="4" {{ old('mood') == 4 ? 'selected' : '' }}>悪い</option>
                  <option value="5" {{ old('mood') == 5 ? 'selected' : '' }}>非常に悪い</option>
                </select>
                @error('mood')
                  <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
              </div>

              <div>
                <label for="score" class="leading-7 text-sm text-gray-600">総合点数<span class="text-xs text-pink-500">（必須・5点満点）</span></label>
                <select name="score" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                  <option value="">選択してください</option>
                  <option value="5" {{ old('score') == 5 ? 'selected' : '' }}>5点</option>
                  <option value="4" {{ old('score') == 4 ? 'selected' : '' }}>4点</option>
                  <option value="3" {{ old('score') == 3 ? 'selected' : '' }}>3点</option>
                  <option value="2" {{ old('score') == 2 ? 'selected' : '' }}>2点</option>
                  <option value="1" {{ old('score') == 1 ? 'selected' : '' }}>1点</option>
                </select>
                @error('evaluation')
                  <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="w-full mt-4">
              <label for="comments" class="leading-7 text-sm text-gray-600">コメント</label>
              <textarea id="comments" name="comments" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out" placeholder="体調の状態や、残しておきたいコメントを入力してください。"></textarea>
              @error('comments')
                <span class="text-red-500 text-sm">{{ $message }}</span>
              @enderror
            </div>

            <div class="w-full mt-4">
              <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg transition-colors duration-300">登録する</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>

  <script>
    // 日付入力フィールドに今日の日付をセット
    document.getElementById('input_date').valueAsDate = new Date();
  </script>
</x-app-layout>
