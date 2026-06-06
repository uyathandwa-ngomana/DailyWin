@php
    $user = Auth::user();
    $links = [
        ['label' => 'Dashboard', 'route' => 'dashboard', 'icon' => 'dashboard', 'show' => true, 'active' => request()->routeIs('dashboard')],
        ['label' => 'Tasks', 'route' => 'tasks.index', 'icon' => 'assignment', 'show' => $user && ! $user->isGuest(), 'active' => request()->routeIs('tasks.*')],
        ['label' => 'Categories', 'route' => 'categories.index', 'icon' => 'category', 'show' => $user && $user->isAdmin(), 'active' => request()->routeIs('categories.*')],
        ['label' => 'Admin', 'route' => 'admin.index', 'icon' => 'admin_panel_settings', 'show' => $user && $user->isAdmin(), 'active' => request()->routeIs('admin.*')],
        ['label' => 'Users', 'route' => 'users.index', 'icon' => 'group', 'show' => $user && $user->isAdmin() && Route::has('users.index'), 'active' => request()->routeIs('users.*')],
        ['label' => 'Profile', 'route' => 'profile.edit', 'icon' => 'person', 'show' => true, 'active' => request()->routeIs('profile.*')],
    ];
@endphp

<header class="sticky top-0 z-40 flex h-16 items-center justify-between border-b border-outline-variant bg-surface px-gutter lg:hidden">
    <a href="{{ route('dashboard') }}" class="flex items-center gap-sm font-bold text-primary">
        <span class="material-symbols-outlined">task_alt</span>
        <span>DailyWin</span>
    </a>

    <div class="flex items-center gap-md">
        <span class="text-sm font-medium text-on-surface-variant">{{ $user?->name }}</span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="material-symbols-outlined text-on-surface-variant" aria-label="Log out">logout</button>
        </form>
    </div>
</header>

<aside class="fixed left-0 top-0 z-40 hidden h-full w-[280px] flex-col border-r border-outline-variant bg-surface p-md shadow-sm lg:flex">
    <a href="{{ route('dashboard') }}" class="mb-xl px-sm">
        <div class="flex items-center gap-sm text-primary">
            <span class="material-symbols-outlined text-[32px]">task_alt</span>
            <span class="text-2xl font-extrabold">DailyWin</span>
        </div>
        <p class="mt-xs text-sm text-on-surface-variant">Taskie AZU</p>
    </a>

    <nav class="flex-1 space-y-xs">
        @foreach ($links as $link)
            @if ($link['show'])
                <a href="{{ route($link['route']) }}"
                    class="flex items-center gap-md rounded-lg px-md py-sm transition {{ $link['active'] ? 'bg-secondary-container text-on-secondary-container font-bold' : 'text-on-surface-variant hover:bg-surface-container-high' }}">
                    <span class="material-symbols-outlined">{{ $link['icon'] }}</span>
                    <span>{{ $link['label'] }}</span>
                </a>
            @endif
        @endforeach
    </nav>

    <div class="border-t border-outline-variant pt-md">
        <div class="mb-md rounded-xl bg-primary-container p-md text-on-primary-container">
            <p class="text-sm font-semibold">{{ $user?->name }}</p>
            <p class="text-xs opacity-80">{{ str_replace('_', ' ', $user?->role?->value ?? 'member') }}</p>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex w-full items-center gap-md rounded-lg px-md py-sm text-left text-on-surface-variant transition hover:bg-surface-container-high">
                <span class="material-symbols-outlined">logout</span>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>

<nav class="fixed bottom-0 left-0 z-40 flex h-16 w-full items-center justify-around border-t border-outline-variant bg-surface px-sm shadow-lg lg:hidden">
    @foreach (array_slice($links, 0, 5) as $link)
        @if ($link['show'])
            <a href="{{ route($link['route']) }}" class="flex min-w-0 flex-1 flex-col items-center justify-center text-xs {{ $link['active'] ? 'font-bold text-primary' : 'text-on-surface-variant' }}">
                <span class="material-symbols-outlined">{{ $link['icon'] }}</span>
                <span class="truncate">{{ $link['label'] }}</span>
            </a>
        @endif
    @endforeach
</nav>
