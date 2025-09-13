<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductSearch extends Component
{
    use WithPagination;
    public $search = '';
    public function render()
    {
        $products = Product::where('status', 'approved')->where('title', 'like', '%' . $this->search . '%')
            ->orWhere('description', 'like', '%' . $this->search . '%')->paginate(10);
        return view('livewire.product-search', ['products' => $products]);
    }
}
