<x-app-layout>
  <section class="text-gray-600 body-font relative">
    <div class="container px-5 py-24 mx-auto">
      <div class="flex flex-col text-center w-full mb-4">
        <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">今日の体調</h1>
      </div>
      <div class="lg:w-1/2 md:w-2/3 mx-auto">
      <form action="{{ route('wellness.update', ['id' => $wellnessLog->id]) }}" method="POST">
      @csrf
      @method('PUT')
        <div class="flex flex-wrap -m-2">
          <div class="p-2 w-1/2">
            <div class="relative">
              <label for="date" class="leading-7 text-sm text-gray-600">入力日</label>
              <input type="date" id="input_date" name="input_date" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" value="{{ old('input_date', $wellnessLog->input_date) }}" />
            </div>
          </div>

          <div class="p-2 w-1/2">
            <div class="relative">
              <label for="mood" class="leading-7 text-sm text-gray-600">気分</label>
              <select name="mood" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                <option value="">選択してください</option>
                <option value="1" @if ($wellnessLog->mood === 1) selected @endif>非常に良い</option>
                <option value="2" @if ($wellnessLog->mood === 2) selected @endif>良い</option>
                <option value="3" @if ($wellnessLog->mood === 3) selected @endif>普通</option>
                <option value="4" @if ($wellnessLog->mood === 4) selected @endif>悪い</option>
                <option value="5" @if ($wellnessLog->mood === 5) selected @endif>非常に悪い</option>
              </select>
            </div>
          </div>

          <div class="p-2 w-1/2">
            <div class="relative">
              <label for="energy_level" class="leading-7 text-sm text-gray-600">元気度</label>
              <div class="flex space-x-4">
                <label><input type="radio" name="energy_level" value="0" @if ($wellnessLog->energy_level === 0) checked @endif /> 元気</label>
                <label><input type="radio" name="energy_level" value="1" @if ($wellnessLog->energy_level === 1) checked @endif/> 普通</label>
                <label><input type="radio" name="energy_level" value="2" @if ($wellnessLog->energy_level === 2) checked @endif /> 疲れている</label>
              </div>
            </div>
          </div>

          <div class="p-2 w-1/2">
            <div class="relative">
              <label for="sleep_quality" class="leading-7 text-sm text-gray-600">昨日の睡眠の質</label>
              <div class="flex space-x-4">
                <label><input type="radio" name="sleep_quality" value="0" @if ($wellnessLog->sleep_quality === 0) checked @endif /> よく眠れた</label>
                <label><input type="radio" name="sleep_quality" value="1" @if ($wellnessLog->sleep_quality === 1) checked @endif /> まぁまぁ</label>
                <label><input type="radio" name="sleep_quality" value="2" @if ($wellnessLog->sleep_quality === 2) checked @endif /> 眠れなかった</label>
              </div>
            </div>
          </div>

          <div class="p-2 w-full">
            <div class="relative">
              <label for="comments" class="leading-7 text-sm text-gray-600">コメント</label>
              <textarea id="comments" name="comments" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ old('comments', $wellnessLog->comments ?? '') }}</textarea>
            </div>
          </div>

          <div class="p-2 w-full">
            <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">編集する</button>
          </div>
        </form>
      </div>
      <form method="POST" action="{{ route('wellness.destroy', ['id' => $wellnessLog->id]) }}">
      @csrf
      @method('DELETE')
        <div class="p-2 mt-4 w-full">
            <button class="flex mx-auto text-white bg-pink-500 border-0 py-2 px-8 focus:outline-none hover:bg-pink-600 rounded text-lg">削除する</button>
        </div>
      </form>
      </div>
    </div>
  </section>
</x-app-layout>
