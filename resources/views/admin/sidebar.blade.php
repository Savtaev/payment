<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->

        <li class="nav-header">Супер-админ</li>
        <li class="nav-item">
            <a href="{{ route('users.create') }}" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                    Создать пользователя
                    @php
                        //echo route('admin.user.create');
                        //echo route('admin.users');
                    @endphp
                </p>
            </a>
        </li>
    </ul>
</nav>
