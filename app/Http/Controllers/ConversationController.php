<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $role = $user->role->value;

        if ($role === 'client') {
            $conversations = Conversation::where('client_id', $user->id)
                ->with([
                    'application.creator',
                    'application.request',
                    'applicationRequest.application.creator',
                    'messages' => fn($q) => $q->latest()->limit(1),
                ])
                ->latest('updated_at')
                ->get();
        } else {
            $conversations = Conversation::where('creator_id', $user->id)
                ->with([
                    'application.request.client',
                    'applicationRequest.client',
                    'applicationRequest.application',
                    'messages' => fn($q) => $q->latest()->limit(1),
                ])
                ->latest('updated_at')
                ->get();
        }

        return view("{$role}.conversations.index", compact('conversations'));
    }

    public function show(Conversation $conversation)
    {
        $this->authorizeAccess($conversation);

        $conversation->load([
            'messages.sender',
            'application.request.client',
            'application.creator',
            'applicationRequest.client',
            'applicationRequest.application.creator',
        ]);

        $role = auth()->user()->role->value;

        return view("{$role}.conversations.show", compact('conversation'));
    }

    public function sendMessage(Conversation $conversation, Request $request)
    {
        $this->authorizeAccess($conversation);

        $request->validate([
            'body' => 'required|max:2000',
        ]);

        $conversation->messages()->create([
            'sender_id' => auth()->id(),
            'body' => $request->body,
        ]);

        $conversation->touch();

        return redirect()->back();
    }

    private function authorizeAccess(Conversation $conversation): void
    {
        $userId = auth()->id();

        if ($conversation->client_id !== $userId && $conversation->creator_id !== $userId) {
            abort(403);
        }
    }
}
