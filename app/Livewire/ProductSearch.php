<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;

class ProductSearch extends Component
{
    public $search = '';
    public $products = [];
    public $categories = [];
    public $selectedCategory = 'all';

    public function mount()
    {
        $this->categories = Category::all(); // Load categories
        $this->products = []; // Ensure no products are loaded initially
    }

   
    // Add these new methods
    public function updatedSearch()
    {
        $this->performSearch();
    }

    public function updatedSelectedCategory()
    {
        $this->performSearch();
    }

    private function performSearch()
    {
        if (!empty($this->search) || $this->selectedCategory !== 'all') {
            $query = Product::query();

            // Apply category filter if specific category selected
            if ($this->selectedCategory !== 'all') {
                $query->where('category_id', $this->selectedCategory);
            }

            // Apply search term filter if search input not empty
            if (!empty($this->search)) {
                $query->where('productName', 'like', '%' . $this->search . '%');
            }

            // Get filtered results
            $this->products = $query->take(10)->get();
        } else {
            $this->products = [];
        }
    }

    public function resetSearch()
    {
        $this->search = '';
        $this->selectedCategory = 'all';
        $this->products = [];
    }

    public function render()
{
    $this->performSearch();
    return view('livewire.product-search');
}

}
