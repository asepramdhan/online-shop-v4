<?php
use function Livewire\Volt\{state, rules, mount};
state(['category', 'name']);
rules(['name' => 'required|min:1']);
mount(function () {
  $this->name = $this->category->name;
});
$save = function () {
  $validatedData = $this->validate();
  $this->category->update($validatedData);
  session()->flash('success', 'Category has been updated');
  $this->redirect('/auth/category', navigate: true);
}
?>
<x-dashboard-layout>
  @volt
  <div>
    <x-header title="Category Edit" size="text-xl" separator />
    <x-form wire:submit="save">
      <x-input label="Category Name" wire:model="name" />
      <x-slot:actions>
        <x-button label="Cancel" link="/auth/category" />
        <x-button label="Save" class="btn-primary" type="submit" spinner="save" />
      </x-slot:actions>
    </x-form>
  </div>
  @endvolt
</x-dashboard-layout>
