<?php

namespace App\Http\Controllers;

use App\Services\ShiftOptimizerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShiftOptimizationController extends Controller
{
    protected ShiftOptimizerService $optimizerService;

    // コンストラクタでサービスを紐付ける（依存性の注入）
    public function __construct(ShiftOptimizerService $optimizerService)
    {
        $this->optimizerService = $optimizerService;
    }

    /**
     * シフトの自動割り当てを実行する
     */
    public function generate(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'staff_ids' => ['required', 'array'],
            'staff_ids.*' => ['integer'],
        ]);

        try {
            // サービス側の処理を呼び出す
            $result = $this->optimizerService->optimize(
                $validated['start_date'],
                $validated['end_date'],
                $validated['staff_ids']
            );

            return response()->json([
                'message' => 'シフトの自動割り当て案を作成しました。',
                'data' => $result
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'シフトの自動生成に失敗しました。',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}