<x-aside>
    <x-sidebarnav>
        <x-nav-item>
            <x-nav-link href="/home">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </x-nav-link>
        </x-nav-item>
        <x-nav-item>
            <x-nav-link
                href="#"
                data-bs-target="#user-nav"
                data-bs-toggle="collapse"
            >
                <i class="bi bi-person-circle"></i><span>User Management</span
                ><i class="bi bi-chevron-down ms-auto"></i>
            </x-nav-link>
            <x-nav-content id="user-nav" class="collapse">
                <x-nav-content-item link="/dashboard/user">
                    List User
                </x-nav-content-item>
                <x-nav-content-item link="/dashboard/user/profil">
                    Profil
                </x-nav-content-item>
            </x-nav-content>
        </x-nav-item>

        <x-nav-item>
            <x-nav-link
                href="#"
                data-bs-target="#auth-nav"
                data-bs-toggle="collapse"
            >
                <i class="bi bi-gear"></i><span>Acount Setting</span
                ><i class="bi bi-chevron-down ms-auto"></i>
            </x-nav-link>
            <x-nav-content id="auth-nav" class="collapse">
                <x-nav-content-item link="/dashboard/auth">
                    Authorizition
                </x-nav-content-item>
            </x-nav-content>
        </x-nav-item>
    </x-sidebarnav>
</x-aside>
