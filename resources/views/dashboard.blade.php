<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- 1. 管理者・スタッフ向け機能 --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">
                    管理者・スタッフ向け機能
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    {{-- シフトマトリックス --}}
                    @if(Route::has('admin.shifts.matrix'))
                        <a href="{{ route('admin.shifts.matrix') }}" class="block p-4 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition">
                            <div class="font-bold text-blue-900">シフトマトリックス</div>
                            <div class="text-xs text-blue-700 mt-1">admin.shifts.matrix</div>
                        </a>
                    @endif

                    {{-- シフト最適化作成 --}}
                    @if(Route::has('admin.shifts.optimize'))
                        <a href="{{ route('admin.shifts.optimize') }}" class="block p-4 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition">
                            <div class="font-bold text-blue-900">シフト自動最適化</div>
                            <div class="text-xs text-blue-700 mt-1">admin.shifts.optimize</div>
                        </a>
                    @endif

                    {{-- 保育士向け相談受信ボックス --}}
                    @if(Route::has('admin.consultations.index'))
                        <a href="{{ route('admin.consultations.index') }}" class="block p-4 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition">
                            <div class="font-bold text-blue-900">相談受信ボックス</div>
                            <div class="text-xs text-blue-700 mt-1">admin.consultations.index</div>
                        </a>
                    @endif

                    {{-- todo-app タスク連携 --}}
                    @if(Route::has('todos.index'))
                        <a href="{{ route('todos.index') }}" class="block p-4 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition">
                            <div class="font-bold text-blue-900">todo-app タスク連携</div>
                            <div class="text-xs text-blue-700 mt-1">todos.index</div>
                        </a>
                    @endif

                    @if(Route::has('admin.documentations.review'))
                        <a href="{{ route('admin.documentations.review') }}" class="block p-4 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition">
                            <div class="font-bold text-blue-900">顔認証レビュー</div>
                            <div class="text-xs text-blue-700 mt-1">admin.documentations.review</div>
                        </a>
                    @endif

                    @if(Route::has('admin.children.faces'))
                        <a href="{{ route('admin.children.faces') }}" class="block p-4 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition">
                            <div class="font-bold text-blue-900">参照顔写真登録</div>
                            <div class="text-xs text-blue-700 mt-1">admin.children.faces</div>
                        </a>
                    @endif
                </div>
            </div>

            {{-- 2. 共通・閲覧機能 --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">
                    支援・ドキュメンテーション
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- 支援ダッシュボード --}}
                    @if(Route::has('support.index'))
                        <a href="{{ route('support.index') }}" class="block p-4 bg-emerald-50 border border-emerald-200 rounded-lg hover:bg-emerald-100 transition">
                            <div class="font-bold text-emerald-900">支援ダッシュボード</div>
                            <div class="text-xs text-emerald-700 mt-1">support.index</div>
                        </a>
                    @endif

                    {{-- ドキュメンテーション一覧 --}}
                    @if(Route::has('documentations.index'))
                        <a href="{{ route('documentations.index') }}" class="block p-4 bg-emerald-50 border border-emerald-200 rounded-lg hover:bg-emerald-100 transition">
                            <div class="font-bold text-emerald-900">ドキュメンテーション一覧</div>
                            <div class="text-xs text-emerald-700 mt-1">documentations.index</div>
                        </a>
                    @endif

                    @foreach([
                        'contact-notes.index' => '連絡帳AI要約',
                        'naps.index' => '午睡チェック',
                        'attendance.index' => '登園・検温',
                        'albums.index' => '成長アルバム',
                        'care-logs.index' => 'おむつ・ミルク・食事',
                    ] as $route => $label)
                        @if(Route::has($route))
                            <a href="{{ route($route) }}" class="block p-4 bg-emerald-50 border border-emerald-200 rounded-lg hover:bg-emerald-100 transition">
                                <div class="font-bold text-emerald-900">{{ $label }}</div>
                                <div class="text-xs text-emerald-700 mt-1">{{ $route }}</div>
                            </a>
                        @endif
                    @endforeach

                    @if(auth()->user()->isStaff() && Route::has('allergies.index'))
                        <a href="{{ route('allergies.index') }}" class="block p-4 bg-emerald-50 border border-emerald-200 rounded-lg hover:bg-emerald-100 transition">
                            <div class="font-bold text-emerald-900">アレルギー配膳ガード</div>
                            <div class="text-xs text-emerald-700 mt-1">allergies.index</div>
                        </a>
                    @endif
                </div>
            </div>

            {{-- 3. 保護者向け機能 --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">
                    保護者向け機能
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- 保護者向け相談画面 --}}
                    @if(Route::has('consultations.create'))
                        <a href="{{ route('consultations.create') }}" class="block p-4 bg-amber-50 border border-amber-200 rounded-lg hover:bg-amber-100 transition">
                            <div class="font-bold text-amber-900">相談・問合せ作成</div>
                            <div class="text-xs text-amber-700 mt-1">consultations.create</div>
                        </a>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>