<?php

namespace App\Http\Controllers;

use App\Models\Child; // マイグレーション・モデル名に合わせて適宜変更してください
use Illuminate\Http\Request;

class ChildController extends Controller
{
    /**
     * 児童一覧の表示
     */
    public function index()
    {
        $children = Child::latest()->paginate(10);
        return view('children.index', compact('children'));
    }

    /**
     * 児童新規登録フォームの表示
     */
    public function create()
    {
        return view('children.create');
    }

    /**
     * 児童情報の保存
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'child_id' => 'required|string|max:255|unique:children,child_id',
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'allergies' => 'nullable|string',          // ★ 追加
            'daily_precautions' => 'nullable|string',  // ★ 追加
            'diagnosis' => 'nullable|string|max:255',
            'sensory_tendencies' => 'nullable|string',
            'panic_response_steps' => 'nullable|string',
        ]);

        Child::create($validated);

        return redirect()->route('dashboard')->with('success', '児童情報を登録しました。');
    }
}
