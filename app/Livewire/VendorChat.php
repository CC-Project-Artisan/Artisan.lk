<?php

namespace App\Livewire;

use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VendorChat extends Component
{
    public $messageInput = '';
    public $messages;
    public $customers;
    public $selectedCustomer = null;
    public $showModal = false;
    public $selectedCustomerId = null;


    protected $rules = [
        'messageInput' => 'required|string|max:255',
        'selectedCustomer' => 'required'
    ];

    public function mount()
    {
        $this->messages = new Collection();
        $this->customers = User::whereHas('sentMessages', function ($query) {
            $query->where('receiver_id', Auth::id());
        })->orWhereHas('receivedMessages', function ($query) {
            $query->where('sender_id', Auth::id());
        })->get();
    }

    public function openChat($customerId)
    {
        $this->selectedCustomerId = $customerId;
        $this->selectedCustomer = $customerId;
        $this->showModal = true;
        $this->loadMessages();
    }

    public function closeChat()
    {
        $this->showModal = false;
        $this->selectedCustomerId = null;
    }

    public function loadMessages()
    {
        if (!$this->selectedCustomer) {
            $this->messages = new Collection();
            return;
        }

        $this->messages = Message::where(function ($query) {
            $query->where('sender_id', Auth::id())
                ->where('receiver_id', $this->selectedCustomer);
        })->orWhere(function ($query) {
            $query->where('sender_id', $this->selectedCustomer)
                ->where('receiver_id', Auth::id());
        })->orderBy('created_at', 'asc')
            ->get();
    }

    public function selectCustomer($customerId)
    {
        $this->selectedCustomer = $customerId;
        $this->loadMessages();
    }

    public function getSelectedCustomerName()
    {
        if (!$this->selectedCustomer) {
            return '';
        }

        $customer = $this->customers->firstWhere('id', $this->selectedCustomer);
        return $customer ? $customer->name : '';
    }


    public function sendMessage()
    {
        // $this->validate();

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $this->selectedCustomer,
            'message' => $this->messageInput
        ]);

        $this->messageInput = '';
        $this->loadMessages();
    }

    public function render()
    {
        return view('livewire.vendor-chat', [
            'messages' => $this->messages ?? new Collection(),
            'customers' => $this->customers ?? new Collection(),
            'selectedCustomerName' => $this->getSelectedCustomerName()
        ]);
    }
}
