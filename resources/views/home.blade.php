<x-administrator>
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Home</a>
                </li>
                <li class="breadcrumb-item">Pages</li>
                <li class="breadcrumb-item active">Blank</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-10">
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
            </div>
        </div>
    </section>
</x-administrator>
