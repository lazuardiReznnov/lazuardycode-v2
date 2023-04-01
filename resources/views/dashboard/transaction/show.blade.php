<x-administrator>
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumblink link="/dashboard">Dashboard</x-breadcrumblink>
            <x-breadcrumblink link="/dashboard/transaction"
                >Transaction</x-breadcrumblink
            >
            <x-breadcrumbactive>{{ $title }}</x-breadcrumbactive>
        </x-breadcrumb>
    </x-pagetitle>

    <!-- End Page Title -->
    <section class="section profile">
        <!-- Pesan -->
        <div class="row">
            <div class="col-md-10">
                @if(session()->has('success'))
                <div class="card">
                    <!-- pesan -->

                    <div
                        class="alert alert-success alert-dismissible fade show"
                        role="alert"
                    >
                        {{ session("success") }}

                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="close"
                        ></button>
                    </div>

                    <!-- endpesan -->
                </div>
                @endif
            </div>
        </div>
        <!-- endPesan -->
        <div class="btn-group">
            <a
                href="/dashboard/transaction/image/{{ $data->slug }}"
                data-bs-toggle="tooltip"
                data-bs-placement="top"
                title="Add Image"
                class="btn btn-primary my-3"
                ><i class="bi bi-upload"></i>
            </a>
            <a
                href="/dashboard/transaction/debt/{{ $data->slug }}"
                data-bs-toggle="tooltip"
                data-bs-placement="top"
                title="Add Debt"
                class="btn btn-primary my-3"
                ><i class="bi bi-tag-fill"></i>
            </a>

            <a
                href="/dashboard/transaction/{{ $data->slug }}/edit"
                class="btn btn-warning my-3"
                data-bs-toggle="tooltip"
                data-bs-placement="top"
                title="Edit transaction"
                ><i class="bi bi-pencil-square"></i
            ></a>
            <form
                action="/dashboard/transaction/{{ $data->slug }}"
                method="post"
                class="d-inline"
            >
                @method('delete') @csrf
                <button
                    class="btn btn-danger my-3 rounded-0"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Delete product"
                    onclick="return confirm('are You sure ??')"
                >
                    <i class="bi bi-file-x-fill"></i>
                </button>
            </form>
        </div>
        <div class="row">
            <div class="col-xl">
                <div class="card">
                    <div class="card-body pt-3">
                        <div class="profile-overview" id="profile-overview">
                            <h5 class="card-title">Details Transaction</h5>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Date</div>
                                <div class="col-lg-9 col-md-8">
                                    :
                                    {{ \Carbon\Carbon::parse($data->tgl)->format('d/m/Y') }}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">
                                    Customer
                                </div>
                                <div class="col-lg-9 col-md-8">
                                    : {{ $data->customer->name }}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">
                                    Product
                                </div>
                                <div class="col-lg-9 col-md-8">
                                    : {{ $data->product->name }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl">
                <div class="card">
                    <div class="card-body pt-3">
                        <h5 class="card-title">Transaction Overview</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Downpayment</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Tenor</th>
                                    <th scope="col">Total Amount</th>
                                    <th scope="col">Total Paid</th>
                                    <th scope="col">difference</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>@currency($data->dp)</td>
                                    <td>@currency($data->amount)</td>
                                    <td>{{ $data->tenor }}</td>
                                    <td>
                                        @php $ttm = $data->amount *$data->tenor
                                        @endphp @currency($ttm)
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl">
                <div class="card">
                    <div class="card-body pt-3">
                        <h5 class="card-title">Transaction Debt Overview</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Amount Debt</th>
                                    <th scope="col">Tenor</th>
                                    <th scope="col">Total Debt</th>
                                    <th scope="col">Total Paid Debt</th>
                                    <th scope="col">difference</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($data->debt)
                                <tr>
                                    <td>@currency($data->debt->amount)</td>
                                    <td>{{ $data->debt->tenor }}</td>
                                    <td>
                                        @php $ttb = $data->debt->amount
                                        *$data->debt->tenor @endphp
                                        @currency($ttb)
                                    </td>
                                </tr>
                                @else
                                <tr>
                                    <td colspan="5" class="text-center">
                                        No Data
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-administrator>
