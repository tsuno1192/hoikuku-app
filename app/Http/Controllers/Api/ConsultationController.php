<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ConsultationTicket;
use App\Models\ConsultationMessage;
use Illuminate\Support\Facades\Auth;


class ConsultationController extends Controller
{
    /**
     * 相談チケット一覧の取得
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // 権限やロールに応じて取得するクエリを分岐（例: 職員なら自分のチケット、カウンセラーなら担当/全チケット）
        $query = ConsultationTicket::with(['messages', 'user', 'counselor']);

        if ($user->role === 'staff') {
            $query->where('user_id', $user->id);
        } elseif ($user->role === 'counselor') {
            // カウンセラーの場合の絞り込み（必要に応じて）
        }

        $tickets = $query->orderBy('updated_at', 'desc')->get();

        return response()->json([
            'status' => 'success',
            'data' => $tickets
        ]);
    }

    /**
     * 新規相談チケットの作成（初回メッセージ同時送信）
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $user = Auth::user();

        // トランザクションなどでチケットと初期メッセージを保存するのが安全です
        $ticket = ConsultationTicket::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'status' => 'open', // 受付中
        ]);

        $message = ConsultationMessage::create([
            'consultation_ticket_id' => $ticket->id,
            'sender_id' => $user->id,
            'message' => $request->message,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => '相談チケットを作成しました。',
            'data' => [
                'ticket' => $ticket,
                'message' => $message,
            ]
        ], 201);
    }

    /**
     * メッセージの送信（既存チケットへの返信）
     */
    public function sendMessage(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $ticket = ConsultationTicket::findOrFail($id);
        $user = Auth::user();

        $message = ConsultationMessage::create([
            'consultation_ticket_id' => $ticket->id,
            'sender_id' => $user->id,
            'message' => $request->message,
        ]);

        // チケットの更新日時を最新にする
        $ticket->touch();

        return response()->json([
            'status' => 'success',
            'data' => $message
        ], 201);
    }

    /**
     * チケットステータスの更新（対応中・完了など）
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:open,in_progress,closed',
        ]);

        $ticket = ConsultationTicket::findOrFail($id);
        
        $ticket->update([
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'ステータスを更新しました。',
            'data' => $ticket
        ]);
    }
}