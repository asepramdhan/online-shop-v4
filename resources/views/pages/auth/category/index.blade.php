<?php
use App\Models\Category;
use function Livewire\Volt\{state, with, usesPagination};
with(fn () => ['categories' => Category::paginate(10)]);
usesPagination();
state(['modalDelete' => false, 'headers' => fn () => [
  ['key' => 'id', 'label' => '#', 'class' => 'bg-red-500/20'], # <--- custom CSS
  ['key' => 'name', 'label' => 'Name'],
  ['key' => 'product', 'label' => 'Product'],
  ['key' => 'created_at', 'label' => 'Created at'],
  ]
]);
$delete = function ($id) {
  Category::find($id)->delete();
  $this->dispatch('categories');
}
?>
<x-dashboard-layout>
  @volt
  <div>
    <x-header title="Categories" subtitle="List of Categories">
      <x-slot:middle class="!justify-end">
        <x-input icon="o-magnifying-glass" placeholder="Search..." />
      </x-slot:middle>
      <x-slot:actions>
        <x-button icon="o-plus" class="btn-primary" link="/auth/category/create" />
      </x-slot:actions>
    </x-header>
    @if(session()->has('success'))
    <x-alert icon="o-exclamation-triangle" class="alert-success mb-3">
      {{ session('success') }}
    </x-alert>
    @endif
    <x-table :headers="$headers" :rows="$categories" link="/auth/category/{id}" with-pagination striped>
      @scope('cell_id', $category)
      <strong>{{ $this->loop->iteration }}</strong>
      @endscope
      @scope('cell_product', $category)
      {{-- hitung produk sesuai category --}}
      ({{ $category->product->count() }}) Product
      @endscope
      @scope('cell_created_at', $category)
      {{ $category->created_at->format('d-m-Y') }}
      @endscope
      {{-- Special `actions` slot --}}
      @scope('actions', $category)
      <x-button icon="o-trash" @click="$wire.modalDelete = true" class="btn-sm" />
      <x-modal wire:model="modalDelete" class="backdrop-blur text-center">
        <div class="mb-5">Are you sure you want to delete this category?</div>
        <x-button label="Cancel" @click="$wire.modalDelete = false" />
        <x-button label="Delete" @click="$wire.modalDelete = false; $wire.delete({{ $category->id }})" />
      </x-modal>
      @endscope
    </x-table>
  </div>
  @endvolt
</x-dashboard-layout>
