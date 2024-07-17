<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown active">
                <a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Starter</li>


            <li class="dropdown {{ setActive([
                    'admin.category.*',
                    'admin.sub-category.*',
                    'admin.child-category.*',
            ])}}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Manage Category</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.category.*'])}}"><a class="nav-link" href="{{ route('admin.category.index') }}">Danh mục</a></li>
                    <li class="{{ setActive(['admin.sub-category.*'])}}"><a class="nav-link" href="{{ route('admin.sub-category.index') }}">Danh mục phụ</a></li>
                    <li class="{{ setActive(['admin.child-category.*'])}}"><a class="nav-link" href="{{ route('admin.child-category.index') }}">Danh mục con</a></li>
                    {{-- <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
                    <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li> --}}
                </ul>
            </li>


            <li class="dropdown {{ setActive([
                    'admin.brand.*',
                    'admin.products.*',
            ])}}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Manage Products</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.brand.*'])}}"><a class="nav-link" href="{{ route('admin.brand.index') }}">Brand</a></li>
                    <li class="{{ setActive(['admin.products.*'])}}"><a class="nav-link" href="{{ route('admin.products.index') }}">Product</a></li>
                    {{-- <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
                    <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li> --}}
                </ul>
            </li>
            <li class="dropdown {{ setActive([
                    'admin.slider.*',
                    'admin.flash-sale.*',
            ])}}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Manage Website</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.slider.*'])}}"><a class="nav-link" href="{{ route('admin.slider.index') }}">Slider</a></li>
                    <li class="{{ setActive(['admin.flash-sale.*'])}}"><a class="nav-link" href="{{ route('admin.flash-sale.index') }}">Flash Sale</a></li>
                    {{-- <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
                    <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li> --}}
                </ul>
            </li>


        </ul>

    </aside>
</div>
