<?php
use function Livewire\Volt\{state, rules};
use App\Models\Customer;
state(['name', 'email', 'phone', 'country_id',
'countries' => [
      [
      'id' => '',
      'name' => 'Select Country',
      'selected' => true,
      ],
      [
      'id' => 1,
      'name' => 'USA',
      ],
      [
      'id' => 2,
      'name' => 'Canada',
      ],
      [
      'id' => 3,
      'name' => 'Mexico',
      ],
      [
      'id' => 4,
      'name' => 'Colombia',
      ],
    ]
]);
rules([
  'name' => 'required|min:1',
  'email' => 'required|min:1',
  'phone' => 'required|min:1',
  'country_id' => 'required',
]);
$create = function () {
  $validatedData = $this->validate();
  $validatedData['user_id'] = auth()->user()->id;
  Customer::create($validatedData);
  session()->flash('success', 'Customer created successfully');
  $this->redirect('/auth/customer', navigate: true);
}
?>
<x-dashboard-layout>
  @volt
  <div class="mb-5">
    <x-header title="Create Customer" subtitle="Create New Customer" />
    <x-form wire:submit='create' class="mb-5">
      <x-input label="Name" wire:model='name' class="mb-3" autofocus />
      <x-input label="Phone Number" type="number" wire:model='phone' class="mb-3" />
      <x-select label="Country" :options="$countries" wire:model="country_id" />
      <x-input label="Email" type="email" wire:model='email' class="mb-3" />
      <x-slot:actions>
        <x-button label="Cancel" link="/auth/customer" />
        <x-button label="Create" class="btn-primary" type="submit" spinner="create" />
      </x-slot:actions>
    </x-form>
  </div>
  @endvolt
</x-dashboard-layout>
