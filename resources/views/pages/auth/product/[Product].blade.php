<?php
use function Livewire\Volt\{state, rules, mount, usesFileUploads};
use App\Models\Category;
usesFileUploads();
state(['product', 'categories', 'name', 'category_id', 'image', 'description', 'price', 'stock',
'config' => fn () => [
    'plugins' => 'autoresize',
    'min_height' => 250,
    'max_height' => 450,
    'statusbar' => false,
    'toolbar' => 'undo redo | quickimage quicktable',
    'quickbars_selection_toolbar' => 'bold italic link',
  ],
]);
rules([
  'name' => 'required|min:1',
  'category_id' => 'required',
  'image' => 'required',
  'description' => 'required',
  'price' => 'required',
  'stock' => 'required',
]);
mount(function () {
  $this->categories = Category::all();
  $this->name = $this->product->name;
  $this->category_id = $this->product->category_id;
  $this->image = $this->product->image;
  $this->description = $this->product->description;
  $this->price = $this->product->price;
  $this->stock = $this->product->stock;
});
$update = function () {
  $validatedData = $this->validate();
  $validatedData['slug'] = Str::slug($this->name) . '-' . Str::random(10);
  // buat kondisi jika gambar tidak diganti, tetap simpan gambar lama, dan jika diganti, simpan gambar baru dan hapus gambar lama
  if ($this->image != $this->product->image) {
    $validatedData['image'] = $this->image->store('images', 'public');
    $oldImage = public_path('storage/' . $this->product->image);
    if (file_exists($oldImage)) {
      unlink($oldImage);
    }
  }
  $this->product->update($validatedData);
  session()->flash('success', 'Product has been updated');
  $this->redirect('/auth/product', navigate: true);
}
?>
<x-dashboard-layout>
  @volt
  <div class="mb-5">
    <x-header title="Create Product" subtitle="Create New Product" />
    <x-form wire:submit='update' class="mb-5">
      <x-input label="Name" wire:model='name' class="mb-3" autofocus />
      <x-select label="Category" :options="$categories" wire:model="category_id" class="mb-3" />
      <x-file wire:model='image' label="Image" accept="image/png, image/jpeg" class="mb-3">
        <img src="{{ asset('storage/' . $this->image) ?? '/img/blank produk.jpg' }}" class="h-40 rounded-lg" />
      </x-file>
      <x-editor wire:model="description" label="Description" hint="The full product description" class="mb-3" :config="$config" />
      <x-input label="Price" wire:model="price" class="mb-3" />
      <x-input label="Stock" wire:model="stock" class="mb-3" />
      <x-slot:actions>
        <x-button label="Cancel" link="/auth/product" />
        <x-button label="Update" class="btn-primary" type="submit" spinner="update" />
      </x-slot:actions>
    </x-form>
  </div>
  @endvolt
</x-dashboard-layout>
