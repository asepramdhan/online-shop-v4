<?php
use App\Models\Product;
use function Livewire\Volt\{state, with, usesPagination};
with(fn () => ['products' => Product::paginate(10)]);
usesPagination();
state(['headers' => fn () => [
    ['key' => 'id', 'label' => '#', 'class' => 'bg-red-500/20'], # <--- custom CSS
    ['key' => 'image', 'label' => 'Image'],
    ['key' => 'name', 'label' => 'Name'],
    ['key' => 'category', 'label' => 'Category'],
    ['key' => 'price', 'label' => 'Price'],
    ['key' => 'stock', 'label' => 'Stock'],
  ]]);
  $delete = function ($id) {
    Product::find($id)->delete();
    $this->dispatch('products');
  }
?>
<x-dashboard-layout>
  @volt
  <div>
    <x-header title="Product" subtitle="List of Products">
      <x-slot:middle class="!justify-end">
        <x-input icon="o-magnifying-glass" placeholder="Search..." />
      </x-slot:middle>
      <x-slot:actions>
        <x-button icon="o-plus" class="btn-primary" link="/auth/product/create" />
      </x-slot:actions>
    </x-header>
    <x-table :headers="$headers" :rows="$products" link="/auth/product/{id}" with-pagination striped>
      @scope('cell_image', $product)
      <x-avatar :image="asset('storage/' . $product->image)" class="!w-14 !rounded-lg" />
      @endscope
      @scope('cell_category', $product)
      {{$product->category->name}}
      @endscope
      {{-- Special `actions` slot --}}
      @scope('actions', $product)
      <x-button icon="o-trash" wire:click="delete({{ $product->id }})" spinner class="btn-sm" />
      @endscope
    </x-table>
  </div>
  @endvolt
</x-dashboard-layout>
