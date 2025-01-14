<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('daily.create') }}">日常管理入力</a>
    <a href="{{ route('crisis_plan.create') }}">クライシスプラン作成</a>
    <a href="{{ route('crisis_plan.edit') }}">クライシスプランの編集</a>
    <a href="{{ route('logs.create') }}">クライシスプランの入力</a>
    <a href="{{ route('logs.index') }}">入力一覧</a>
</x-app-layout>
