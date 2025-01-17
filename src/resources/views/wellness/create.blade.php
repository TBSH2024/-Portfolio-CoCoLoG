<x-app-layout>
  @section('title', 'CocoLog / 体調入力')
  <section class="text-gray-600 body-font relative">
    <div class="container px-5 py-24 mx-auto">
      <div class="flex flex-col text-center w-full mb-4">
        @if ($wellnessLog)
          <div class="mb-4 p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700">
              <p>既に本日の体調は入力されています。</p>
              <a href="{{ route('wellness.edit', [$wellnessLog->id]) }}" class="text-indigo-500 underline">編集する場合はこちらをクリックしてください。</a>
          </div>
        @endif
      </div>
      <div class="lg:w-1/2 md:w-2/3 mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h1 class="sm:text-3xl text-2xl font-medium text-center title-font mb-8 text-gray-900">今日の体調</h1>
        <form action="{{ route('wellness.store') }}" method="POST">
        @csrf
          <div class="flex flex-wrap -m-2">
            <div class="p-2 w-1/2">
              <div class="relative">
                <label for="date" class="leading-7 text-sm text-gray-600">入力日</label>
                <input type="date" id="input_date" name="input_date" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                @error('input_date')
                  <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="p-2 w-1/2">
              <div class="relative">
                <label for="mood" class="leading-7 text-sm text-gray-600">気分</label>
                <select name="mood" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                  <option value="">選択してください</option>
                  <option value="1">非常に良い</option>
                  <option value="2">良い</option>
                  <option value="3">普通</option>
                  <option value="4">悪い</option>
                  <option value="5">非常に悪い</option>
                </select>
                @error('mood')
                  <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="p-2 w-1/2">
              <div class="relative">
                <label for="energy_level" class="leading-7 text-sm text-gray-600">元気度</label>
                <div class="flex space-x-4">
                  <label><input type="radio" name="energy_level" value="0" /> 元気</label>
                  <label><input type="radio" name="energy_level" value="1" /> 普通</label>
                  <label><input type="radio" name="energy_level" value="2" /> 疲れている</label>
                </div>
                @error('energy_level')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="p-2 w-1/2">
              <div class="relative">
                <label for="sleep_quality" class="leading-7 text-sm text-gray-600">昨日の睡眠の質</label>
                <div class="flex space-x-4">
                  <label><input type="radio" name="sleep_quality" value="0" /> よく眠れた</label>
                  <label><input type="radio" name="sleep_quality" value="1" /> まぁまぁ</label>
                  <label><input type="radio" name="sleep_quality" value="2" /> 眠れなかった</label>
                </div>
                @error('sleep_quality')
                  <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="p-2 w-full">
              <div class="relative">
                <label for="comments" class="leading-7 text-sm text-gray-600">コメント</label>
                <textarea id="comments" name="comments" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
              </div>
            </div>

            <div class="p-2 w-full">
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
