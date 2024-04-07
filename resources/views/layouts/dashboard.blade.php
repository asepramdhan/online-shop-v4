<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="corporate">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? 'Page Title' }}</title>
  {{-- Add this  --}}
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  {{-- Make sure you have this --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">
  {{-- TinyMCE --}}
  <script src="https://cdn.tiny.cloud/1/86z9mqpamxj7nat92312wl1goqieuaduddcyuk8z2zr45d2u/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body class="font-sans antialiased">
  <x-dashboard-navbar />
  {{-- The main content with `full-width` --}}
  <x-main with-nav full-width>
    <x-sidebar />
    {{-- The `$slot` goes here --}}
    <x-slot:content>
      {{ $slot }}
    </x-slot:content>
  </x-main>
  {{-- TOAST area --}}
  <x-toast />
</body>
</html>
