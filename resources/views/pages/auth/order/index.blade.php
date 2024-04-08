<?php
use App\Models\Order;
use function Livewire\Volt\{state, with, usesPagination};
with(fn () => ['orders' => Order::with('user', 'products')->paginate(10)]);
usesPagination();
state(['headers' => fn () => [
  ['key' => 'id', 'label' => '#', 'class' => 'bg-red-500/20'], # <--- custom CSS
  ['key' => 'created_at', 'label' => 'Date'],
  ['key' => 'user_id', 'label' => 'Customer'],
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
    <x-table :headers="$headers" :rows="$orders" link="/auth/category/{id}" with-pagination striped>
      @scope('cell_id', $order)
      <strong>{{ $this->loop->iteration }}</strong>
      @endscope
      @scope('cell_user_id', $order)
      {{ $order->user->name }}
      @endscope
      @scope('cell_created_at', $order)
      {{ $order->created_at->format('d-m-Y') }}
      @endscope
      @scope('cell_status', $order)
      @if($order->status == 1)
      <span class="badge badge-success">Paid</span>
      @elseif($order->status == 0)
      <span class="badge badge-warning">Unpaid</span>
      @elseif($order->status == 2)
      <span class="badge badge-danger">Cancelled</span>
      @elseif($order->status == 3)
      <span class="badge badge-primary">Delivered</span>
      @endif
      @endscope
    </x-table>
  </div>
  @endvolt
</x-dashboard-layout>
