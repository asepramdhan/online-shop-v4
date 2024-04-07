    {{-- This is a sidebar that works also as a drawer on small screens --}}
    {{-- Notice the `main-drawer` reference here --}}
    <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-200">
      {{-- User --}}
      @if($user = auth()->user())
      <x-list-item :item="$user" value="name" sub-value="email" no-separator no-hover class="pt-2">
        <x-slot:actions>
          <x-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="logoff" no-wire-navigate link="/logout" />
        </x-slot:actions>
      </x-list-item>
      <x-menu-separator />
      @endif
      {{-- Activates the menu item when a route matches the `link` property --}}
      <x-menu activate-by-route>
        <x-menu-item title="Dashboard" icon="o-chart-pie" link="/auth/dashboard" />
        <x-menu-item title="Orders" icon="o-gift" link="###" />
        <x-menu-item title="Customers" icon="o-user" link="###" />
        <x-menu-sub title="Warehouse" icon="o-wrench-screwdriver">
          <x-menu-item title="Categories" icon="o-hashtag" link="/auth/category" />
          <x-menu-item title="Products" icon="o-shopping-cart" link="/auth/product" />
        </x-menu-sub>
      </x-menu>
    </x-slot:sidebar>
