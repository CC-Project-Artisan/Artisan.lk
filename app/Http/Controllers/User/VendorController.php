<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Models\Exhibition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    public function registerVendor(Request $request)
    {
        $request->validate([
            'business_name' => 'required|string|max:255',
            'business_description' => 'nullable|string',
            'business_category' => 'nullable|string',
            'business_phone' => 'required|string|max:255|unique:vendors',
            'business_email' => 'required|string|email|max:255|unique:vendors',
            'business_address' => 'nullable|string',
        ]);

        $user = Auth::user();

        // Initialize latitude and longitude
        $latitude = null;
        $longitude = null;

        // Fetch latitude and longitude from Google Maps API
        if ($request->business_address) {
            $geoData = $this->fetchCoordinates($request->business_address);

            if ($geoData['status'] === 'OK') {
                $latitude = $geoData['results'][0]['geometry']['location']['lat'];
                $longitude = $geoData['results'][0]['geometry']['location']['lng'];
            }
        }

        // Create a new Vendor entry
        $vendor = new Vendor([
            'user_id' => $user->id,
            'business_name' => $request->business_name,
            'business_description' => $request->business_description,
            'business_category' => $request->business_category,
            'business_phone' => $request->business_phone,
            'business_email' => $request->business_email,
            'business_address' => $request->business_address,
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);

        $vendor->save();

        // Update the user's role to 'vendor'
        $user->role = 'vendor';
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Vendor profile created successfully.');
    }

    public function registerExhibition(Request $request)
    {
        $request->validate([
            'exhibition_name' => 'required|string|max:255',
            'exhibition_description' => 'nullable|string',
            'exhibition_location' => 'required|string',
            'exhibition_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'organization_name' => 'nullable|string',
        ]);

        // Initialize latitude and longitude
        $latitude = null;
        $longitude = null;

        // Fetch latitude and longitude from Google Maps API
        if ($request->exhibition_location) {
            $geoData = $this->fetchCoordinates($request->exhibition_location);

            if ($geoData['status'] === 'OK') {
                $latitude = $geoData['results'][0]['geometry']['location']['lat'];
                $longitude = $geoData['results'][0]['geometry']['location']['lng'];
            }
        }

        // Save the exhibition to the database
        $exhibition = new Exhibition([
            'user_id' => Auth::id(),
            'exhibition_name' => $request->exhibition_name,
            'exhibition_description' => $request->exhibition_description,
            'exhibition_location' => $request->exhibition_location,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'exhibition_date' => $request->exhibition_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'organization_name' => $request->organization_name,
        ]);

        $exhibition->save();

        return redirect()->route('dashboard')->with('success', 'Exhibition registered successfully.');
    }

    public function updateStoreDetails(Request $request)
    {
        $request->validate([
            'business_name' => 'required|string|max:255',
            'business_description' => 'nullable|string',
            'business_category' => 'nullable|string',
            'business_phone' => 'required|string|max:255',
            'business_email' => 'required|string|email|max:255',
            'business_address' => 'nullable|string',
        ]);

        $user = Auth::user();
        $vendor = Vendor::where('user_id', $user->id)->first();

        if ($vendor) {
            // Initialize latitude and longitude
            $latitude = null;
            $longitude = null;

            // Fetch latitude and longitude from Google Maps API
            if ($request->business_address) {
                $geoData = $this->fetchCoordinates($request->business_address);

                if ($geoData['status'] === 'OK') {
                    $latitude = $geoData['results'][0]['geometry']['location']['lat'];
                    $longitude = $geoData['results'][0]['geometry']['location']['lng'];
                }
            }

            // Update vendor details
            $vendor->update([
                'business_name' => $request->business_name,
                'business_description' => $request->business_description,
                'business_category' => $request->business_category,
                'business_phone' => $request->business_phone,
                'business_email' => $request->business_email,
                'business_address' => $request->business_address,
                'latitude' => $latitude,
                'longitude' => $longitude,
            ]);

            return redirect()->route('dashboard')->with('success', 'Store details updated successfully.');
        }

        return redirect()->route('dashboard')->with('error', 'Vendor profile not found.');
    }

    public function mapPage(Request $request)
    {
        // Query vendors
        $vendors = Vendor::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        // Query exhibitions
        $exhibitions = Exhibition::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        // Pass data to the map view
        return view('pages.map', [
            'vendors' => $vendors,
            'exhibitions' => $exhibitions,
            'apiKey' => config('services.googleMap.apiKey'),
        ]);
    }

    private function fetchCoordinates($address)
    {
        $apiKey = config('services.googleMap.apiKey');
        $geoApiUrl = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($address) . "&key={$apiKey}";
        $response = file_get_contents($geoApiUrl);

        return json_decode($response, true);
    }
}
