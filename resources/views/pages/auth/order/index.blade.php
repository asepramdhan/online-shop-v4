<?php
use App\Models\Category;
use function Livewire\Volt\{state, with, usesPagination};
with(fn () => ['categories' => Category::paginate(10)]);
usesPagination();
state(['headers' => fn () => [
  ['key' => 'id', 'label' => '#', 'class' => 'bg-red-500/20'], # <--- custom CSS
  ['key' => 'date', 'label' => 'Date'],
  ['key' => 'customer', 'label' => 'Customer'],
  ['key' => 'country', 'label' => 'Country'],
  ['key' => 'status', 'label' => 'Status'],
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
    <x-header title="Orders" subtitle="List of Orders">
      <x-slot:middle class="!justify-end">
        <x-input icon="o-magnifying-glass" placeholder="Search..." />
      </x-slot:middle>
      <x-slot:actions>
        <x-button icon="o-plus" class="btn-primary" />
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
    </x-table>
  </div>
  @endvolt
</x-dashboard-layout>
