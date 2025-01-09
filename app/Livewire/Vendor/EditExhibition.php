<?php

namespace App\Livewire\Vendor;

use Livewire\Component;
use App\Models\Exhibition;
use Livewire\WithFileUploads;
use App\Models\ExhibitionContact;
use App\Models\ExhibitionEmail;

class EditExhibition extends Component
{
    use WithFileUploads;

    public $exhibition;
    public $exhibition_name;
    public $exhibition_description;
    public $exhibition_date;
    public $start_time;
    public $end_time;
    public $exhibition_location;
    public $organization_name;
    public $category_name;
    public $exhibitionBanner;
    public $registration_start_date;
    public $registration_end_date;
    public $max_exhibitors;
    public $vendor_entrance_fee;
    public $regular_price;
    public $student_price;
    public $child_price;
    public $social_media_links = [];
    public $layout;
    public $contact_details = [];
    public $email_addresses = [];

    public function mount($id)
    {
        $this->exhibition = Exhibition::with(['contacts', 'emails'])->findOrFail($id);
        $this->fillExhibitionData();
    }

    public function fillExhibitionData()
    {
        $this->exhibition_name = $this->exhibition->exhibition_name;
        $this->exhibition_description = $this->exhibition->exhibition_description;
        $this->exhibition_date = $this->exhibition->exhibition_date;
        $this->start_time = $this->exhibition->start_time;
        $this->end_time = $this->exhibition->end_time;
        $this->exhibition_location = $this->exhibition->exhibition_location;
        $this->organization_name = $this->exhibition->organization_name;
        $this->category_name = $this->exhibition->category_name;
        $this->registration_start_date = $this->exhibition->registration_start_date;
        $this->registration_end_date = $this->exhibition->registration_end_date;
        $this->max_exhibitors = $this->exhibition->max_exhibitors;
        $this->vendor_entrance_fee = $this->exhibition->vendor_entrance_fee;
        $this->regular_price = $this->exhibition->regular_price;
        $this->student_price = $this->exhibition->student_price;
        $this->child_price = $this->exhibition->child_price;
        $this->social_media_links = $this->exhibition->social_media_links ?? [];
        $this->layout = $this->exhibition->layout;
        
        // Load contact details
        $this->contact_details = $this->exhibition->contacts->map(function($contact) {
            return [
                'name' => $contact->name,
                'telephone' => $contact->telephone
            ];
        })->toArray();

        // Load email addresses
        $this->email_addresses = $this->exhibition->emails->pluck('email')->toArray();
    }

    public function updateExhibition()
    {
        try {
            // Handle banner image uploads
            if ($this->exhibitionBanner) {
                $imageNames = [];
                foreach ($this->exhibitionBanner as $image) {
                    $imageName = time() . '-' . $image->getClientOriginalName();
                    $image->storeAs('public/images', $imageName);
                    $imageNames[] = $imageName;
                }
            }

            // Update exhibition details
            $this->exhibition->update([
                'exhibition_name' => $this->exhibition_name,
                'exhibition_description' => $this->exhibition_description,
                'exhibition_date' => $this->exhibition_date,
                'start_time' => $this->start_time,
                'end_time' => $this->end_time,
                'exhibition_location' => $this->exhibition_location,
                'organization_name' => $this->organization_name,
                'category_name' => $this->category_name,
                'exhibitionBanner' => $imageNames ?? $this->exhibition->exhibitionBanner,
                'registration_start_date' => $this->registration_start_date,
                'registration_end_date' => $this->registration_end_date,
                'max_exhibitors' => $this->max_exhibitors,
                'vendor_entrance_fee' => $this->vendor_entrance_fee,
                'regular_price' => $this->regular_price,
                'student_price' => $this->student_price,
                'child_price' => $this->child_price,
                'social_media_links' => $this->social_media_links,
                'layout' => $this->layout,
            ]);

            // Update contacts
            $this->exhibition->contacts()->delete();
            foreach ($this->contact_details as $contact) {
                if (!empty($contact['name']) && !empty($contact['telephone'])) {
                    $this->exhibition->contacts()->create([
                        'name' => $contact['name'],
                        'telephone' => $contact['telephone']
                    ]);
                }
            }

            // Update emails
            $this->exhibition->emails()->delete();
            foreach ($this->email_addresses as $email) {
                if (!empty($email)) {
                    $this->exhibition->emails()->create([
                        'email' => $email
                    ]);
                }
            }

            session()->flash('message', 'Exhibition updated successfully.');
            return redirect()->route('dashboard');
            
        } catch (\Exception $e) {
            session()->flash('error', 'Error updating exhibition: ' . $e->getMessage());
        }
    }

    public function addContact()
    {
        $this->contact_details[] = ['name' => '', 'telephone' => ''];
    }

    public function removeContact($index)
    {
        unset($this->contact_details[$index]);
        $this->contact_details = array_values($this->contact_details);
    }

    public function addEmail()
    {
        $this->email_addresses[] = '';
    }

    public function removeEmail($index)
    {
        unset($this->email_addresses[$index]);
        $this->email_addresses = array_values($this->email_addresses);
    }

    public function render()
    {
        return view('livewire.vendor.edit-exhibition');
    }
}