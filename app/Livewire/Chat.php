<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class Chat extends Component
{
    public $messages;
    public $messageInput = '';
    public $receiverId;

    public function mount($receiverId)
    {
        $this->receiverId = $receiverId;
        $this->loadMessages();
    }

    public function loadMessages()
    {
        $this->messages = Message::where(function ($query) {
            $query->where('sender_id', Auth::id())
                ->where('receiver_id', $this->receiverId);
        })->orWhere(function ($query) {
            $query->where('sender_id', $this->receiverId)
                ->where('receiver_id', Auth::id());
        })->orderBy('created_at', 'asc')
            ->get()
            ->toArray();
    }

    public function sendMessage()
    {
        if (empty(trim($this->messageInput))) {
            return;
        }

        $this->validate([
            'messageInput' => 'required|string|max:255',
        ]);

        try {
            Message::create([
                'sender_id' => Auth::id(),
                'receiver_id' => $this->receiverId,
                'message' => trim($this->messageInput),
            ]);

            $this->reset('messageInput');  // Reset specifically messageInput
            $this->loadMessages();
            $this->dispatchBrowserEvent('messageSent');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to send message');
        }
    }

    public function render()
    {
        return view('livewire.chat', [
            'messages' => $this->messages ?? []
        ]);
    }
}
