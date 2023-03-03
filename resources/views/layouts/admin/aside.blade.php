<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link collapsed" href="/home">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- End Dashboard Nav -->

        <li class="nav-item">
            <a
                class="nav-link collapsed"
                data-bs-target="#user-nav"
                data-bs-toggle="collapse"
                href="#"
            >
                <i class="bi bi-person-circle"></i><span>User Management</span
                ><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul
                id="user-nav"
                class="nav-content collapse"
                data-bs-parent="#sidebar-nav"
            >
                <li>
                    <a href="/dashboard/user">
                        <i class="bi bi-circle"></i><span>List User</span>
                    </a>
                </li>
                <li>
                    <a href="/dashboard/user/profile">
                        <i class="bi bi-circle"></i><span>Profile</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a
                class="nav-link collapsed"
                data-bs-target="#auth-nav"
                data-bs-toggle="collapse"
                href="#"
            >
                <i class="bi bi-gear"></i><span>Acount Setting</span
                ><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul
                id="auth-nav"
                class="nav-content collapse"
                data-bs-parent="#sidebar-nav"
            >
                <li>
                    <a href="/dashboard/authorization">
                        <i class="bi bi-circle"></i><span>List User</span>
                    </a>
                </li>
                <li>
                    <a href="/dashboard/user/role">
                        <i class="bi bi-circle"></i><span>Profile</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a
                class="nav-link collapsed"
                data-bs-target="#product-nav"
                data-bs-toggle="collapse"
                href="#"
            >
                <i class="bi bi-gear"></i><span>Product Management</span
                ><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul
                id="product-nav"
                class="nav-content collapse"
                data-bs-parent="#sidebar-nav"
            >
                <li>
                    <a href="/dashboard/product">
                        <i class="bi bi-circle"></i><span>Product List</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Components Nav -->
    </ul>
</aside>
