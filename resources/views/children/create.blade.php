<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            児童の新規登録
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('children.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- 児童ID・管理番号 -->
                        <div>
                            <label for="child_id" class="block text-sm font-medium text-gray-700">児童ID・管理番号 <span class="text-red-500">*</span></label>
                            <input type="text" name="child_id" id="child_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('child_id') }}" placeholder="例：C-001">
                            @error('child_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- 氏名 -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">児童氏名 <span class="text-red-500">*</span></label>
                            <input type="text" name="name" id="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('name') }}" placeholder="例：山田 太郎">
                            @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- 生年月日 -->
                        <div>
                            <label for="birth_date" class="block text-sm font-medium text-gray-700">生年月日 <span class="text-red-500">*</span></label>
                            <input type="date" name="birth_date" id="birth_date" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('birth_date') }}">
                            @error('birth_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- アレルギー -->
                        <div>
                            <label for="allergies" class="block text-sm font-medium text-gray-700">アレルギー</label>
                            <textarea name="allergies" id="allergies" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="例：卵、牛乳アレルギーなど">{{ old('allergies') }}</textarea>
                            @error('allergies')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- 普段の生活における注意事項 -->
                        <div>
                            <label for="daily_precautions" class="block text-sm font-medium text-gray-700">普段の生活における注意事項</label>
                            <textarea name="daily_precautions" id="daily_precautions" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="例：水分補給のこまめな声かけが必要など">{{ old('daily_precautions') }}</textarea>
                            @error('daily_precautions')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- 診断名 -->
                        <div>
                            <label for="diagnosis" class="block text-sm font-medium text-gray-700">診断名</label>
                            <input type="text" name="diagnosis" id="diagnosis" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('diagnosis') }}">
                            @error('diagnosis')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- 感覚過敏の傾向 -->
                        <div>
                            <label for="sensory_tendencies" class="block text-sm font-medium text-gray-700">感覚過敏の傾向</label>
                            <textarea name="sensory_tendencies" id="sensory_tendencies" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('sensory_tendencies') }}</textarea>
                            @error('sensory_tendencies')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- パニック時の対応手順などの配慮事項 -->
                        <div>
                            <label for="panic_response_steps" class="block text-sm font-medium text-gray-700">パニック時の対応手順などの配慮事項</label>
                            <textarea name="panic_response_steps" id="panic_response_steps" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('panic_response_steps') }}</textarea>
                            @error('panic_response_steps')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900">キャンセル</a>
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-indigo-700">
                                登録する
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>