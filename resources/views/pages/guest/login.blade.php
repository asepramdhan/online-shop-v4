<?php
use function Livewire\Volt\{state};
use function Laravel\Folio\name;
name('login');
state(['email', 'password']);
$login = function () {
  if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
    $this->redirect('/auth/dashboard', navigate: true);
  }
  session()->flash('error', 'Invalid email or password');
}
?>
<x-app-layout>
  @volt
  <div>
    <div class="grid md:grid-cols-12 grid-cols-1 gap-4">
      <div class="md:col-start-5 md:col-span-4">
        @if(session()->has('error'))
        <div class="alert alert-error mb-2">{{ session('error') }}</div>
        @endif
        <x-form wire:submit="login">
          <x-input label="Email" wire:model="email" type="email" autofocus />
          <x-input label="Password" wire:model="password" type="password" />
          <x-slot:actions>
            <x-button label="Cancel" link="/" />
            <x-button label="Login" class="btn-primary" type="submit" spinner="login" />
          </x-slot:actions>
        </x-form>
      </div>
    </div>
  </div>
  @endvolt
</x-app-layout>
