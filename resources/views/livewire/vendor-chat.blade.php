<div>
    <!-- Customer List -->
    @foreach ($customers as $customer)
        <div class="user-item p-3 border-bottom cursor-pointer hover:bg-gray-100"
            wire:click="openChat({{ $customer->id }})">
            <h5>{{ $customer->name }}</h5>
        </div>
    @endforeach

    <!-- Centered Chat Modal with Blur -->
    @if ($showModal)
        <div class="fixed inset-0 z-50 overflow-y-auto backdrop-blur-sm bg-gray-500/30 mt-5" aria-labelledby="modal-title"
            role="dialog" aria-modal="true">
            <!-- Center container -->
            <div class="flex items-center justify-center min-h-screen">
                <!-- Modal card -->
                <div class="relative w-full max-w-md mx-auto bg-white rounded-xl shadow-2xl m-4">
                    <!-- Modal content -->
                    <div class="bg-customBrown px-4 py-3 rounded-t-xl flex justify-between items-center">
                        <h3 class="text-white font-bold">
                            {{ optional($customers->firstWhere('id', $selectedCustomerId))->name }}</h3>
                        <button wire:click="closeChat" class="text-white hover:text-gray-200">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <div class="max-h-[60vh] overflow-y-auto p-4">
                        @foreach ($messages as $message)
                            <div
                                class="flex {{ $message->sender_id === Auth::id() ? 'justify-end' : 'justify-start' }} mb-4">
                                <div class="max-w-xs lg:max-w-md {{ $message->sender_id === Auth::id() ? 'bg-customBrown text-white' : 'bg-customGray text-white' }} rounded-lg px-4 py-2">
                                    <p class="text-sm">{{ $message->message }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="bg-gray-50 p-4 rounded-b-xl">
                        <div class="flex gap-2">
                            <input type="text" wire:model="messageInput" wire:keydown.enter="sendMessage"
                                class="flex-1 rounded-lg border-gray-300 focus:ring-info focus:border-info"
                                placeholder="Type a message...">
                            <button wire:click="sendMessage"
                                class="px-4 py-2 bg-customBrown text-white rounded-lg hover:bg-info-dark">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
