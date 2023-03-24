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
                <i class="bi bi-receipt"></i><span>Product Management</span
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

        <li class="nav-item">
            <a
                class="nav-link collapsed"
                data-bs-target="#customer-nav"
                data-bs-toggle="collapse"
                href="#"
            >
                <i class="bi bi-person"></i><span>Customer Management</span
                ><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul
                id="customer-nav"
                class="nav-content collapse"
                data-bs-parent="#sidebar-nav"
            >
                <li>
                    <a href="/dashboard/customer">
                        <i class="bi bi-circle"></i><span>customer List</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a
                class="nav-link collapsed"
                data-bs-target="#fintech-nav"
                data-bs-toggle="collapse"
                href="#"
            >
                <i class="bi bi-bank"></i><span>fintech Management</span
                ><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul
                id="fintech-nav"
                class="nav-content collapse"
                data-bs-parent="#sidebar-nav"
            >
                <li>
                    <a href="/dashboard/fintech">
                        <i class="bi bi-circle"></i><span>fintech List</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a
                class="nav-link collapsed"
                data-bs-target="#marketing-nav"
                data-bs-toggle="collapse"
                href="#"
            >
                <i class="bi bi-person-badge"></i
                ><span>Marketing Management</span
                ><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul
                id="marketing-nav"
                class="nav-content collapse"
                data-bs-parent="#sidebar-nav"
            >
                <li>
                    <a href="/dashboard/marketing">
                        <i class="bi bi-circle"></i><span>marketing List</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Components Nav -->
    </ul>
</aside>
