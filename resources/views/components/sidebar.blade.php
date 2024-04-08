    {{-- This is a sidebar that works also as a drawer on small screens --}}
    {{-- Notice the `main-drawer` reference here --}}
    <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-200">
      <x-menu activate-by-route>
        <x-menu-item title="Dashboard" icon="o-chart-pie" link="/auth/dashboard" />
        <x-menu-item title="Orders" icon="o-gift" link="/auth/order" />
        <x-menu-item title="Customers" icon="o-user" link="/auth/customer" />
        <x-menu-sub title="Warehouse" icon="o-wrench-screwdriver">
          <x-menu-item title="Categories" icon="o-hashtag" link="/auth/category" />
          <x-menu-item title="Products" icon="o-shopping-cart" link="/auth/product" />
        </x-menu-sub>
      </x-menu>
    </x-slot:sidebar>
