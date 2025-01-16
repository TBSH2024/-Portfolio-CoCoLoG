<x-guest-layout>
    @section('title', 'CocoLog')
    <div class="w-full max-w-4xl mx-auto px-6 py-4 bg-white shadow-lg rounded-lg">
        <div class="container mx-auto py-6 px-6 max-w-7xl">

            <div class="text-center mb-10">
                <img src="{{ asset('images/logo.png') }}" alt="logo" class="mx-auto w-48 h-auto mb-6">
                <p class="text-lg text-gray-600 mt-2">日々の体調やクライシスプランを簡単に記録・管理しましょう。</p>
            </div>

            <div class="text-center mb-12">
                <p class="text-xl text-gray-700">CocoLogは、あなたの日々の体調や状態を管理するためのアプリケーションです。</p>
                <p class="text-lg text-gray-600 mt-2">今すぐアカウントを作成して、健康管理を始めましょう。</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
                <div class="text-center bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition duration-200">
                    <svg class="w-16 h-16 text-indigo-600 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12V8a4 4 0 10-8 0v4a4 4 0 100 8h8a4 4 0 100-8z" />
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">会員登録</h3>
                    <p class="text-gray-600 mb-4">新しいアカウントを作成し、すぐに健康管理を始めましょう。</p>
                    <a href="{{ route('register') }}" class="bg-indigo-600 text-white py-2 px-4 rounded-full hover:bg-indigo-700 transition duration-300">会員登録</a>
                </div>

                <div class="text-center bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition duration-200">
                    <svg class="w-16 h-16 text-indigo-600 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">ログイン</h3>
                    <p class="text-gray-600 mb-4">既にアカウントをお持ちですか？ログインしてデータを管理しましょう。</p>
                    <a href="{{ route('login') }}" class="bg-indigo-600 text-white py-2 px-4 rounded-full hover:bg-indigo-700 transition duration-300">ログイン</a>
                </div>
            </div>

            <!-- 機能紹介セクション -->
            <div class="text-center mb-12">
                <h2 class="text-3xl font-semibold text-gray-800 mb-6">CocoLogの主な機能</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <h3 class="text-xl font-semibold text-indigo-600 mb-4">体調の記録</h3>
                        <p class="text-gray-700">毎日の体調や気分を簡単に記録し、健康状態を把握できます。</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <h3 class="text-xl font-semibold text-indigo-600 mb-4">クライシスプランの管理</h3>
                        <p class="text-gray-700">体調に応じたクライシスプランを記録し、必要な時に迅速に対応できます。</p>
                    </div>
                </div>
            </div>

            <!-- 最後のメッセージ -->
            <div class="text-center">
                <p class="text-sm text-gray-500">CocoLogへようこそ！あなたの健康をサポートします。</p>
            </div>
        </div>
    </div>
</x-guest-layout>
