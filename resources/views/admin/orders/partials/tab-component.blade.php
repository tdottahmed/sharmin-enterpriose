<ul class="nav nav-pills nav-justified my-3" role="tablist">
    <li class="nav-item waves-effect waves-light" role="presentation">
        <a class="nav-link {{ request('status') == 'all' || request('status') == '' ? 'active' : '' }}"
            href="{{ route('orders.index', ['status' => 'all']) }}">
            {{ __('All Orders') }}
        </a>
    </li>
    <li class="nav-item waves-effect waves-light" role="presentation">
        <a class="nav-link {{ request('status') == 'pending' ? 'active' : '' }}"
            href="{{ route('orders.index', ['status' => 'pending']) }}">
            {{ __('Pending Orders') }}
        </a>
    </li>
    <li class="nav-item waves-effect waves-light" role="presentation">
        <a class="nav-link {{ request('status') == 'completed' ? 'active' : '' }}"
            href="{{ route('orders.index', ['status' => 'completed']) }}">
            {{ __('Completed Orders') }}
        </a>
    </li>
    <li class="nav-item waves-effect waves-light" role="presentation">
        <a class="nav-link {{ request('status') == 'cancelled' ? 'active' : '' }}"
            href="{{ route('orders.index', ['status' => 'cancelled']) }}">
            {{ __('Cancelled Orders') }}
        </a>
    </li>
</ul>
