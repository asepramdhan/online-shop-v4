<?php
use function Livewire\Volt\{state};
state([]);
?>
<x-dashboard-layout>
  @volt
  <div>
    <x-header title="Create Product" subtitle="Create New Product" />
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <x-input label="Name" wire:model='name' />
      <x-input label="Name" wire:model='name' />
    </div>
  </div>
  @endvolt
</x-dashboard-layout>
