<?php
use function Livewire\Volt\{state};
state([]);
?>
<x-dashboard-layout>
  @volt
  <div>
    <x-header title="Product Edit" size="text-xl" separator />
    edit product
  </div>
  @endvolt
</x-dashboard-layout>
