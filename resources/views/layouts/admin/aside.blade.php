<x-aside>
    <x-sidebarnav>
        <!-- Home -->
        <x-nav-item>
            <x-nav-link href="/home">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </x-nav-link>
        </x-nav-item>
        <!-- end Home -->

        <!-- user -->
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
        <!-- End User -->

        <!-- Auth -->
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
        <!-- end Auth -->

        <!-- Product -->
        <x-nav-item>
            <x-nav-link
                href="#"
                data-bs-target="#product-nav"
                data-bs-toggle="collapse"
            >
                <i class="bi bi-receipt"></i><span>Product Management</span
                ><i class="bi bi-chevron-down ms-auto"></i>
            </x-nav-link>
            <x-nav-content id="product-nav" class="collapse">
                <x-nav-content-item link="/dashboard/product">
                    Product List
                </x-nav-content-item>
            </x-nav-content>
        </x-nav-item>
        <!-- End Prpduct -->
        <!-- Customer -->
        <x-nav-item>
            <x-nav-link
                href="#"
                data-bs-target="#customer-nav"
                data-bs-toggle="collapse"
            >
                <i class="bi bi-person"></i><span>Customer Management</span
                ><i class="bi bi-chevron-down ms-auto"></i>
            </x-nav-link>
            <x-nav-content id="customer-nav" class="collapse">
                <x-nav-content-item link="/dashboard/customer">
                    Customer List
                </x-nav-content-item>
            </x-nav-content>
        </x-nav-item>
        <!-- End Customer -->

        <!-- Fintech -->
        <x-nav-item>
            <x-nav-link
                href="#"
                data-bs-target="#fintech-nav"
                data-bs-toggle="collapse"
            >
                <i class="bi bi-bank"></i><span>fintech Management</span
                ><i class="bi bi-chevron-down ms-auto"></i>
            </x-nav-link>
            <x-nav-content id="fintech-nav" class="collapse">
                <x-nav-content-item link="/dashboard/fintech">
                    fintech List
                </x-nav-content-item>
            </x-nav-content>
        </x-nav-item>
        <!-- End Fintech -->

        <!-- Marketing -->
        <x-nav-item>
            <x-nav-link
                href="#"
                data-bs-target="#marketing-nav"
                data-bs-toggle="collapse"
            >
                <i class="bi bi-person-badge"></i
                ><span>Marketing Management</span
                ><i class="bi bi-chevron-down ms-auto"></i>
            </x-nav-link>
            <x-nav-content id="marketing-nav" class="collapse">
                <x-nav-content-item link="/dashboard/marketing">
                    Marketing List
                </x-nav-content-item>
            </x-nav-content>
        </x-nav-item>
        <!-- End Marketing -->

        <!-- Transaction -->
        <x-nav-item>
            <x-nav-link
                href="#"
                data-bs-target="#transaction-nav"
                data-bs-toggle="collapse"
            >
                <i class="bi bi-person-badge"></i
                ><span>Transaction Management</span
                ><i class="bi bi-chevron-down ms-auto"></i>
            </x-nav-link>
            <x-nav-content id="transaction-nav" class="collapse">
                <x-nav-content-item link="/dashboard/transaction">
                    Transaction List
                </x-nav-content-item>
                <x-nav-content-item link="/dashboard/transaction/cashflow">
                    Cashflow
                </x-nav-content-item>
                <x-nav-content-item link="/dashboard/transaction/debt">
                    Debt
                </x-nav-content-item>
                <x-nav-content-item link="/dashboard/transaction/fee">
                    Fee Data
                </x-nav-content-item>
            </x-nav-content>
        </x-nav-item>
        <!-- End Transaction -->
    </x-sidebarnav>
</x-aside>
