<li class="nav-item">
    <!-- Main Menu Item -->
    <a class="nav-link menu-link {{ $isActive ? 'active' : '' }}"
        @if (!empty($dropdownRoutes)) href="#{{ Str::slug($label) }}"
         data-bs-toggle="collapse" 
         @else href="{{ route($route) }}" @endif
        role="button" aria-expanded="{{ $isActive() ? 'true' : 'false' }}" aria-controls="{{ Str::slug($label) }}">
        <i class="{{ $icon }}"></i> <span data-key="t-{{ Str::slug($label) }}">{{ $label }}</span>
    </a>
    <!-- Dropdown Menu (if exists) -->
    @if (!empty($dropdownRoutes))
        <div class="collapse menu-dropdown {{ $isActive() ? 'show' : '' }}" id="{{ Str::slug($label) }}">
            <ul class="nav nav-sm flex-column">
                @foreach ($dropdownRoutes as $route => $subLabel)
                    <li class="nav-item">
                        <a href="{{ route($route) }}"
                            class="nav-link {{ request()->routeIs(str($route)->explode('.')->first() . '*') ? 'active' : '' }}"
                            data-key="t-{{ Str::slug($subLabel) }}">
                            {{ $subLabel }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</li>
