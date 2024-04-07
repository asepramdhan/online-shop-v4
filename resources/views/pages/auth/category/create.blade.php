<?php
use function Livewire\Volt\{state, rules};
use App\Models\Category;
state(['name']);
rules([
  'name' => 'required|min:1',
]);
$save = function () {
  $validatedData = $this->validate();
  Category::create($validatedData);
  session()->flash('success', 'Category created successfully');
  $this->redirect('/auth/category', navigate: true);
}
?>
<x-dashboard-layout>
  @volt
  <div class="mb-5">
    <x-header title="Create Product" subtitle="Create New Product" />
    <x-form wire:submit='save' class="mb-5">
      <x-input label="Name" wire:model='name' class="mb-3" autofocus />
      <x-slot:actions>
        <x-button label="Cancel" link="/auth/category" />
        <x-button label="Save" class="btn-primary" type="submit" spinner="save" />
      </x-slot:actions>
    </x-form>
  </div>
  @endvolt
</x-dashboard-layout>
