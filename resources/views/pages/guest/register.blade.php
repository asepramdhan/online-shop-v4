<?php
use function Livewire\Volt\{state, rules};
use App\Models\User;
state(['name', 'email', 'password']);
rules([
  'name' => 'required|min:1',
  'email' => 'required|min:1',
  'password' => 'required|min:1',
]);
$register = function () {
  $validatedData = $this->validate();
  $validatedData['password'] = bcrypt($validatedData['password']);
  $user = User::create($validatedData);
  Auth::login($user);
  $this->redirect('/auth/dashboard', navigate: true);
}
?>
<x-app-layout>
  @volt
  <div>
    <div class="grid md:grid-cols-12 grid-cols-1 gap-4">
      <div class="md:col-start-5 md:col-span-4">
        <x-form wire:submit="register">
          <x-input label="Name" wire:model="name" autofocus />
          <x-input label="Email" wire:model="email" type="email" />
          <x-input label="Password" wire:model="password" type="password" />
          <x-slot:actions>
            <x-button label="Cancel" link="/" />
            <x-button label="Register" class="btn-primary" type="submit" spinner="register" />
          </x-slot:actions>
        </x-form>
      </div>
    </div>
  </div>
  @endvolt
</x-app-layout>
