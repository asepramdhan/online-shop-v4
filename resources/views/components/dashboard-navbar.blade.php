<?php
use function Livewire\Volt\{state};
state([]);
$logout = function () {
  Auth::logout();
  $this->redirect('/guest/login', navigate: true);
}
?>
<x-nav sticky full-width>
  <x-slot:brand>
    <label for="main-drawer" class="lg:hidden mr-3">
      <x-icon name="o-bars-3" class="cursor-pointer" />
    </label>
    <div>
      <a href="/" wire:navigate>Online Shop</a>
    </div>
  </x-slot:brand>
  <x-slot:actions>
    <x-button icon="o-bell" class="btn-ghost btn-sm relative">
      <x-badge value="2" class="badge-error absolute -right-2 -top-2" />
    </x-button>
    <x-theme-toggle class="btn btn-ghost btn-sm" @theme-changed="console.log($event.detail)" />
    @volt
    <x-form wire:submit='logout'>
      <x-button icon="o-arrow-right-on-rectangle" type="submit" class="btn-ghost btn-sm" />
    </x-form>
    @endvolt
  </x-slot:actions>
</x-nav>
