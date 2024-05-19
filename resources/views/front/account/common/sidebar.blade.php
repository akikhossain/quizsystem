<ul id="account-panel" class="nav nav-pills flex-column">
    <li class="nav-item">
        <a href="{{ route('account.profile') }}" class="nav-link font-weight-bold" role="tab" aria-controls="tab-login"
            aria-expanded="false"><i class="fas fa-user-alt"></i> My Profile</a>
    </li>
    <li class="nav-item">
        <a href=" " class="nav-link font-weight-bold" role="tab" aria-controls="tab-register" aria-expanded="false"><i
                class="fas fa-shopping-bag"></i>My posts</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('account.logout') }}" class="nav-link font-weight-bold" role="tab"
            aria-controls="tab-register" aria-expanded="false"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </li>
</ul>