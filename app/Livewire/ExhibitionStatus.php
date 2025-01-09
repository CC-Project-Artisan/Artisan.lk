<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Exhibition;
use App\Notifications\ExhibitionAccepted;
use App\Notifications\ExhibitionRejected;
use App\Notifications\ExhibitionActivated;
use App\Notifications\ExhibitionDeactivated;
use Carbon\Carbon;

class ExhibitionStatus extends Component
{
    public $exhibitionId;
    public $exhibition;
    public $isActive;
    public $status;

    // Mount method to get the exhibition id
    public function mount($exhibitionId)
    {
        $this->exhibitionId = $exhibitionId;
        $this->exhibition = Exhibition::with('user')->find($this->exhibitionId);
        $this->isActive = $this->exhibition->isActive;
        $this->status = $this->exhibition->status;
    }

    // Method to accept the exhibition
    public function accept()
    {
        $this->exhibition = Exhibition::with('user')->find($this->exhibitionId);
        if ($this->exhibition) {
            $this->exhibition->status = 'approved';
            $this->exhibition->status_updated_at = Carbon::now();
            $this->exhibition->save();
            $this->status = 'approved';
            session()->flash('message', 'Exhibition accepted successfully. Please complete the payment.');

            // Send notification to the user
            if ($this->exhibition->user) {
                $this->exhibition->user->notify(new ExhibitionAccepted($this->exhibition));
            }
        }
    }

    // Method to reject the exhibition
    public function reject()
    {
        $this->exhibition = Exhibition::with('user')->find($this->exhibitionId);
        if ($this->exhibition) {
            $this->exhibition->status = 'rejected';
            $this->exhibition->status_updated_at = Carbon::now();
            $this->exhibition->save();
            $this->status = 'rejected';
            session()->flash('message', 'Exhibition rejected successfully.');

            // Send notification to the user
            if ($this->exhibition->user) {
                $this->exhibition->user->notify(new ExhibitionRejected($this->exhibition));
            }
        }
    }

    // Method to toggle the active status
    public function toggleActiveStatus()
    {
        $this->exhibition = Exhibition::with('user')->find($this->exhibitionId);
        if ($this->exhibition) {
            // Toggle the isActive status
            $this->exhibition->isActive = !$this->exhibition->isActive;
            $this->exhibition->status_updated_at = Carbon::now();
            $this->exhibition->save();

            $this->isActive = $this->exhibition->isActive;
            $status = $this->exhibition->isActive ? 'activated' : 'deactivated';
            session()->flash('message', "Exhibition $status successfully.");

            // Send notification to the user
            if ($this->exhibition->user) {
                if ($this->exhibition->isActive) {
                    $this->exhibition->user->notify(new ExhibitionActivated($this->exhibition));
                } else {
                    $this->exhibition->user->notify(new ExhibitionDeactivated($this->exhibition));
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.exhibition-status', [
            'exhibition' => $this->exhibition,
            'status' => $this->status,
            'isActive' => $this->isActive,
        ]);
    }
}
