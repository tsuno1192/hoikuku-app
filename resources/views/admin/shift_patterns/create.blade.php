@extends('layouts.admin') {{-- レイアウトはお使いのプロジェクトに合わせて調整してください --}}

@section('content')
<div class="container">
    <h2>シフトパターン新規作成</h2>

    <form action="{{ route('admin.shift_patterns.store') }}" method="POST">
        @csrf

        {{-- パターン名 --}}
        <div class="mb-3">
            <label for="name" class="form-label">シフトパターン名（例: 早番、遅番）</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- 開始時間 --}}
        <div class="mb-3">
            <label for="start_time" class="form-label">開始時間</label>
            <input type="time" class="form-control @error('start_time') is-invalid @enderror" id="start_time" name="start_time" value="{{ old('start_time') }}" required>
            @error('start_time')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- 終了時間 --}}
        <div class="mb-3">
            <label for="end_time" class="form-label">終了時間</label>
            <input type="time" class="form-control @error('end_time') is-invalid @enderror" id="end_time" name="end_time" value="{{ old('end_time') }}" required>
            @error('end_time')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- 必要スキルと人数設定 --}}
        <div class="mb-4">
            <label class="form-label">必要資格と人数設定</label>
            <div class="card p-3">
                @foreach($skills as $index => $skill)
                    <div class="row align-items-center mb-2">
                        <div class="col-md-6">
                            {{-- チェックボックスの配列としてスキルIDを渡す --}}
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                       name="skills[{{ $index }}][id]" 
                                       value="{{ $skill->id }}" 
                                       id="skill_{{ $skill->id }}"
                                       {{ old("skills.$index.id") == $skill->id ? 'checked' : '' }}>
                                <label class="form-check-label" for="skill_{{ $skill->id }}">
                                    {{ $skill->name }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            {{-- 必要人数入力欄 --}}
                            <div class="input-group input-group-sm">
                                <input type="number" class="form-control" 
                                       name="skills[{{ $index }}][required_count]" 
                                       value="{{ old("skills.$index.required_count", 1) }}" 
                                       min="1" placeholder="必要人数">
                                <span class="input-group-text">人</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @error('skills')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">登録する</button>
        <a href="{{ route('admin.shift_patterns.index') }}" class="btn btn-secondary">キャンセル</a>
    </form>
</div>
@endsection