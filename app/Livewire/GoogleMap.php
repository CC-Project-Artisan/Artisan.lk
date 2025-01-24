<?php

namespace App\Livewire;

use App\Models\Vendor;
use App\Models\Exhibition;
use Livewire\Component;

class GoogleMap extends Component 
{
    public $apiKey; // API Key for Google Maps
    public $locations; // Combined data for vendors and exhibitions

    public function mount() 
    {
        // Get the API key from the configuration
        $this->apiKey = config('services.googleMap.apiKey');

        // Fetch vendors from the database with valid latitude and longitude
        $vendors = Vendor::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get()
            ->map(function ($vendor) {
                return [
                    'type' => 'vendor', // Add type dynamically
                    'name' => $vendor->business_name,
                    'address' => $vendor->business_address,
                    'latitude' => (float) $vendor->latitude,
                    'longitude' => (float) $vendor->longitude,
                ];
            });

        // Fetch exhibitions from the database with valid latitude and longitude
        $exhibitions = Exhibition::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get()
            ->map(function ($exhibition) {
                return [
                    'type' => 'exhibition', // Add type dynamically
                    'name' => $exhibition->exhibition_name,
                    'address' => $exhibition->exhibition_location,
                    'latitude' => (float) $exhibition->latitude,
                    'longitude' => (float) $exhibition->longitude,
                ];
            });

        // Combine vendors and exhibitions into a single array
        $this->locations = $vendors->merge($exhibitions)->toArray();
    }

    public function render()
    {
        return view('livewire.google-map', [
            'apiKey' => $this->apiKey,
            'locations' => $this->locations,
        ]);
    }
}
