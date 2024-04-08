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
    @auth
    <x-dropdown label="Welcome back, {{ Auth::user()->name }}" class="btn btn-ghost btn-sm" right>
      <x-menu-item title="Dashboard" icon="o-chart-pie" link="/auth/dashboard" />
      @volt
      <x-menu-item title="Logout" icon="o-arrow-right-on-rectangle" wire:click='logout' />
      @endvolt
    </x-dropdown>
    @else
    <x-button label="Login" icon="o-arrow-right-end-on-rectangle" link="/guest/login" class="btn-ghost btn-sm" />
    <x-button label="Register" icon="o-users" link="/guest/register" class="btn-ghost btn-sm" responsive />
    @endauth
    <x-theme-toggle class="btn btn-ghost btn-sm" @theme-changed="console.log($event.detail)" />
  </x-slot:actions>
</x-nav>
