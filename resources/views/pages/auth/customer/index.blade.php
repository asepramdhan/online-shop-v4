<?php
use App\Models\Customer;
use function Livewire\Volt\{state, with, usesPagination};
with(fn () => ['customers' => Customer::with('user')->paginate(10)]);
usesPagination();
state(['headers' => fn () => [
  ['key' => 'avatar', 'label' => ''],
  ['key' => 'name', 'label' => 'Name'],
  ['key' => 'country', 'label' => 'Country'],
  ['key' => 'email', 'label' => 'Email'],
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
    <x-header title="Customers" subtitle="List of Customers">
      <x-slot:middle class="!justify-end">
        <x-input icon="o-magnifying-glass" placeholder="Search..." />
      </x-slot:middle>
      <x-slot:actions>
        <x-button icon="o-plus" class="btn-primary" link="/auth/customer/create" />
      </x-slot:actions>
    </x-header>
    @if(session()->has('success'))
    <x-alert icon="o-exclamation-triangle" class="alert-success mb-3">
      {{ session('success') }}
    </x-alert>
    @endif
    <x-table :headers="$headers" :rows="$customers" link="/auth/customer/{id}" with-pagination striped>
      @scope('cell_avatar', $customer)
      <x-avatar :image="asset('storage/' . $customer->avatar)" class="!w-14 !rounded-lg" />
      @endscope
    </x-table>
  </div>
  @endvolt
</x-dashboard-layout>
