<?php

namespace App\Livewire;

use App\Models\Vendor; 
use Livewire\Component;

class GoogleMap extends Component 
{
    public $apiKey; // API Key for Google Maps
    public $vendors; // Vendors data

    public function mount() 
    {
        // Get the API key from the configuration
        $this->apiKey = config('services.googleMap.apiKey');
        
        // Fetch vendors from the database with valid latitude and longitude
        $this->vendors = Vendor::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get()
            ->map(function($vendor) {
                return [
                    'business_name' => $vendor->business_name,
                    'business_address' => $vendor->business_address,
                    'latitude' => (float) $vendor->latitude,
                    'longitude' => (float) $vendor->longitude,
                ];
            })
            ->toArray();
    }

    public function render()
    {
        // Debugging Vendors (Optional)
        // Log::info($this->vendors);

        return view('livewire.google-map', [
            'apiKey' => $this->apiKey,
            'vendors' => $this->vendors
        ]);
    }
}
