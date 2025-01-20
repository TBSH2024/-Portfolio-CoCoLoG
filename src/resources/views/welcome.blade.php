<x-guest-layout>
    @section('title', 'CocoLog')
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
    <header class="text-white max-w-7xl w-full">
        <div class="container mx-auto flex justify-between items-center py-4 px-4">
        <a href="#">
            <img src="{{ asset('images/logo.png') }}" alt="CocoLogロゴ" class="w-60 h-auto">
        </a>
            <nav>
                <ul class="flex space-x-6">
                    <li>
                        <a href="{{ route('login') }}" class="text-md text-sky-500 font-bold border p-2 border-sky-300 rounded hover:shadow hover:bg-sky-100 cursor-pointer">ログイン</a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}" class="bg-sky-500 text-md text-white font-bold border p-2 border-sky-300 rounded hover:shadow hover:bg-sky-700 cursor-pointer">無料で始める</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="bg-sky-50 w-full">
        <div class="container mx-auto px-6 py-16">
            <div class="text-center mb-12">
                <h1 class="text-6xl font-bold text-gray-600 mt-10 leading-snug">
                    日々の<span class="text-blue-500">体調管理</span><br>
                    <span class="text-blue-500">クライシス･プラン</span>をもっと身近に</h1>
            </div>

            <div class="bg-white rounded-lg p-8 w-2/3 mx-auto mb-20">
                <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">クライシス･プランとは</h2>
                <p class="text-lg leading-relaxed">クライシス･プランは精神疾患を抱えた患者やその周囲の支援者が、病状悪化に備えて作成する計画書です。<br>
                    病状を「安定状態」、「注意状態」、「要注意状態」の3つに分け、その状態に応じた自己対処や支援者の対応をまとめます。
                    クライシス･プランの目的は、再発の兆候や病状の悪化を早期に知ることで、再発を防止することです。
                    また、病状を安定させ目標に向かうための支援ツールにもなります。</p>
            </div>

            <div class="max-w-sm mx-auto mb-20">
                <form action="{{ route('register') }}">
                <button class="w-full p-3 rounded-lg border bg-sky-500 text-center cursor:pointer font-bold text-white hover:bg-sky-700">無料で始める</button>
                </form>
            </div>

            <div class="text-gray-800 mb-12">
                <h2 class="text-4xl font-bold text-center mb-8">CoCoLoGでできること</h2>
                <div class="grid grid-cols-3 max-w-7xl mx-auto text-center">
                    <div class="bg-white rounded-lg py-2 mx-4 pb-8">
                        <h2 class="text-2xl font-semibold my-8">日々の体調の記録</h2>
                        <p class="text-lg">日々の体調を「気分」、「元気度」、「昨日の睡眠の質」で判別し、記録できます。
                    </div>
                    <div class="bg-white rounded-lg py-2">
                        <h2 class="text-2xl font-semibold my-8">クライシス･プランの作成</h2>
                        <p class="text-lg">「安定状態」、「注意状態」、「要注意状態」を5つずつ設定可能なクライシス･プランが作成できます。</p>
                    </div>
                    <div class="bg-white rounded-lg py-2 mx-4">
                        <h2 class="text-2xl font-semibold my-8">クライシス･プランの日々の記録</h2>
                        <p class="text-lg">作成したクライシス･プランを元に日々の状態記録ができます。</p>
                    </div>
                </div>
            </div>
        </div>
        <footer class="py-4">
            <p class="text-center">©2025 CoCoLog. All Rights Reserved.</p>
         </footer>
    </main>
</div>
</x-guest-layout>
