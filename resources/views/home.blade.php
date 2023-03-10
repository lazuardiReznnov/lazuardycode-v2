<x-administrator>
    <x-pagetitle title="Dashboard">
        <x-breadcrumb>
            <x-breadcrumbactive>Dashboard</x-breadcrumbactive>
        </x-breadcrumb>
    </x-pagetitle>

    <!-- End Page Title -->

    <x-section numb="12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Welcome</h5>
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session("status") }}
                </div>
                @endif

                {{ __("You are logged in!") }}
            </div>
        </div>
    </x-section>
</x-administrator>
