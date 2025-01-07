<div>
    <p>Coustomize and get more information about your order connecting with the seller!</p>
    <!-- Customer List -->
    <div class="card-footer text-muted d-flex justify-content-start align-items-center p-3">
        <input type="text" 
               class="form-control form-control-lg" 
               placeholder="Type message"
               wire:model.defer="messageInput" 
               wire:keydown.enter="sendMessage"
               x-data
               x-on:messageSent.window="$el.focus()">
        <button class="ms-3 btn btn-info" 
                wire:click="sendMessage" 
                wire:loading.attr="disabled"
                {{ empty(trim($messageInput)) ? 'disabled' : '' }}>
            <i class="fas fa-paper-plane"></i>
        </button>
    </div>
</div>
