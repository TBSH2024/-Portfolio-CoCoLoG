<x-app-layout>
  @section('title', 'CocoLog / 体調編集')
  <section class="text-gray-600 body-font relative">
    <div class="container px-4 max-w-7xl mx-auto mt-2">
      <div class="w-2/3 mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h1 class="sm:text-3xl text-2xl font-bold text-center title-font mb-8 text-gray-900 border-b-2 pb-4 border-gray-200">体調の編集</h1>
        <form action="{{ route('wellness.update', ['id' => $wellnessLog->id]) }}" method="POST">
        @csrf
        @method('PUT')
          <div class="flex flex-col">
            <div class="mb-4">
              <label for="input_date" class="leading-7 text-sm text-gray-600 block">入力日<span class="text-xs text-pink-500">（必須）</span></label>
              <input type="date" id="input_date" name="input_date" class="w-1/3 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:ring-2" value="{{ old('input_date', $wellnessLog->input_date) }}" />
              @error('input_date')
                <span class="text-red-500 text-sm">{{ $message }}</span>
              @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <label for="energy_level" class="leading-7 text-sm text-gray-600">元気度<span class="text-xs text-pink-500">（必須）</span></label>
                <div class="flex space-x-4">
                  <label><input type="radio" name="energy_level" value="0" @if ($wellnessLog->energy_level === 0) checked @endif /> 元気</label>
                  <label><input type="radio" name="energy_level" value="1" @if ($wellnessLog->energy_level === 1) checked @endif/> 普通</label>
                  <label><input type="radio" name="energy_level" value="2" @if ($wellnessLog->energy_level === 2) checked @endif /> 疲れている</label>
                </div>
                @error('energy_level')
                  <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
              </div>

              <div>
                <label for="sleep_quality" class="leading-7 text-sm text-gray-600">昨日の睡眠の質<span class="text-xs text-pink-500">（必須）</span></label>
                <div class="flex space-x-4">
                  <label><input type="radio" name="sleep_quality" value="0" @if ($wellnessLog->sleep_quality === 0) checked @endif /> よく眠れた</label>
                  <label><input type="radio" name="sleep_quality" value="1" @if ($wellnessLog->sleep_quality === 1) checked @endif /> まぁまぁ</label>
                  <label><input type="radio" name="sleep_quality" value="2" @if ($wellnessLog->sleep_quality === 2) checked @endif /> 眠れなかった</label>
                </div>
                @error('sleep_quality')
                  <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
              </div>

              <div>
                <label for="mood" class="leading-7 text-sm text-gray-600">気分<span class="text-xs text-pink-500">（必須）</span></label>
                <select name="mood" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 mr-30 leading-8 transition-colors duration-200 ease-in-out">
                  <option value="">選択してください</option>
                  <option value="1" @if ($wellnessLog->mood === 1) selected @endif>非常に良い</option>
                  <option value="2" @if ($wellnessLog->mood === 2) selected @endif>良い</option>
                  <option value="3" @if ($wellnessLog->mood === 3) selected @endif>普通</option>
                  <option value="4" @if ($wellnessLog->mood === 4) selected @endif>悪い</option>
                  <option value="5" @if ($wellnessLog->mood === 5) selected @endif>非常に悪い</option>
                </select>
                @error('mood')
                  <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
              </div>

              <div>
                <label for="score" class="leading-7 text-sm text-gray-600">総合点数<span class="text-xs text-pink-500">（必須・5点満点）</span></label>
                <select name="score" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                  <option value="">選択してください</option>
                  <option value="5" @if ($wellnessLog->score === '5点(満点)') selected @endif>5点</option>
                  <option value="4" @if ($wellnessLog->score === '4点') selected @endif>4点</option>
                  <option value="3" @if ($wellnessLog->score === '3点') selected @endif>3点</option>
                  <option value="2" @if ($wellnessLog->score === '2点') selected @endif>2点</option>
                  <option value="1" @if ($wellnessLog->score === '1点') selected @endif>1点</option>
                </select>
                @error('score')
                  <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
             </div>
          </div>

            <div class="w-full mt-4">
              <label for="comments" class="leading-7 text-sm text-gray-600">コメント</label>
              <textarea id="comments" name="comments" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ old('comments', $wellnessLog->comments ?? '') }}</textarea>
            </div>

            <div class="w-full mt-4">
              <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg transition-colors duration-300">更新する</button>
            </div>
          </form>
            <div class="w-full mt-4">
              <form method="POST" action="{{ route('wellness.destroy', ['id' => $wellnessLog->id]) }}" class="confirm_delete">
              @csrf
              @method('DELETE')
                <button class="flex mx-auto text-white bg-pink-500 border-0 py-2 px-8 focus:outline-none hover:bg-pink-600 rounded text-lg transition-colors duration-300">削除する</button>
              </form>
            </div>
          </div>
      </div>
    </div>
  </section>
</x-app-layout>
