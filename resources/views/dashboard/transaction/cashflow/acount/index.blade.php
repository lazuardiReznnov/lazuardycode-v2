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

    <x-section numb="12">
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
        <div class="row">
            <div class="col-md-6">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a
                        href="/dashboard/transaction/cashflow/acount/create"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        title="Create Acount"
                        class="btn btn-success"
                        ><i class="bi bi-file-plus"></i> Cash In</a
                    >
                </div>
            </div>
            <div class="col-md-6">
                <form
                    action="/dashboard/transaction/cashflow/acount"
                    method="get"
                >
                    <div class="input-group mb-3">
                        <input
                            type="text"
                            class="form-control"
                            placeholder="search"
                            aria-label="search"
                            aria-describedby="search"
                            name="search"
                        />
                        <button
                            class="btn btn-outline-secondary"
                            type="submit"
                            id="search"
                        >
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Acount Transaction</h5>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Acount</th>
                            <th scope="col">Description</th>
                            <th scope="col">state</th>
                            <th scope="col">action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if($datas->count()) @foreach($datas as $data)
                        <tr>
                            <th scope="row">
                                {{ ($datas->currentpage()-1) * $datas->perpage() + $loop->index + 1 }}
                            </th>
                            <td>{{ $data->name }}</td>
                            <td>
                                {{ $data->description }}
                            </td>

                            <td>
                                @php $state=""; @endphp @if($data->state == 0)
                                @php $state = "Pemasukan"; @endphp @else @php
                                $state ="Pengeluaran"@endphp @endif
                                {{ $state }}
                            </td>
                            <td>
                                <a
                                    href="/dashboard/transaction/cashflow/acount/{{ $data->slug }}/edit"
                                    class="badge bg-warning"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Edit transaction"
                                    ><i class="bi bi-pencil-square"></i
                                ></a>
                                <form
                                    action="/dashboard/transaction/cashflow/acount/{{ $data->slug }}"
                                    method="post"
                                    class="d-inline"
                                >
                                    @method('delete') @csrf
                                    <button
                                        class="badge bg-danger border-0"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Delete product"
                                        onclick="return confirm('are You sure ??')"
                                    >
                                        <i class="bi bi-file-x-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach @else
                        <tr>
                            <td colspan="10" class="text-center">
                                Data Not Found
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-md-8">
                        {{ $datas->onEachside(2)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </x-section>
</x-administrator>
