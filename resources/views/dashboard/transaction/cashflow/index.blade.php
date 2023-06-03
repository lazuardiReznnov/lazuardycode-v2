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

    <x-section>
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
                        href="/dashboard/transaction/cashflow/create"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        title="Transaction In"
                        class="btn btn-success"
                        ><i class="bi bi-file-plus"></i> Cash In</a
                    >
                    <a
                        href="/dashboard/transaction/cashflow/create-out"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        title="Transaction Out"
                        class="btn btn-danger"
                        ><i class="bi bi-file-plus"> Cash Out</i></a
                    >
                    <a
                        href="/dashboard/transaction/cashflow/acount"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        title="Acount"
                        class="btn btn-primary"
                        ><i class="bi bi-tag"></i> Acount</a
                    >
                    <a
                        href="/dashboard/transaction/cashflow/export-excel"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        title="Export Excel"
                        class="btn btn-primary"
                        ><i class="bi bi-file-earmark-spreadsheet"></i> Export
                        Excel</a
                    >
                    <a
                        href="/dashboard/transaction/cashflow/export-pdf"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        title="Export Pdf"
                        class="btn btn-primary"
                        ><i class="bi bi-file-earmark-spreadsheet"></i> Export
                        Pdf</a
                    >
                </div>
            </div>
            <div class="col-md-6">
                <form action="/dashboard/transaction/cashflow" method="get">
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
                <h5 class="card-title">cashflow</h5>
                <p>Date : {{ Date("d M Y") }}</p>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Acount</th>
                            <th scope="col">Date</th>
                            <th scope="col">Description</th>
                            <th scope="col">Debet</th>
                            <th scope="col">Credit</th>
                            <th scope="col">Saldo</th>
                            <th scope="col">action</th>
                        </tr>
                    </thead>
                    @php $ttldebet=0; $ttlcredit=0; @endphp
                    <tbody>
                        @if($datas->count()) @foreach($datas as $data)
                        <tr>
                            <th scope="row">
                                {{ ($datas->currentpage()-1) * $datas->perpage() + $loop->index + 1 }}
                            </th>
                            <td>
                                {{ $data->acount->name }} -
                                {{ $data->acount->description }}
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($data->tgl)->format('d/m/Y') }}
                            </td>

                            <td>
                                {{ $data->description }} <br />
                                @if($data->transaction)
                                {{ $data->transaction->customer->name}} -
                                {{ $data->transaction->product->name }}
                                @endif
                            </td>

                            <td>@currency($data->debet)</td>
                            <td>@currency($data->credit)</td>
                            <td>
                                @php $saldo =
                                ($saldo+$data->credit)-$data->debet @endphp
                                @currency($saldo)
                            </td>
                            <td>
                                <a
                                    href="/dashboard/transaction/cashflow/{{ $data->slug }}/edit"
                                    class="badge bg-warning"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Edit transaction"
                                    ><i class="bi bi-pencil-square"></i
                                ></a>
                                <form
                                    action="/dashboard/transaction/cashflow/{{ $data->slug }}"
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
                            @php $ttldebet = $ttldebet+$data->debet; $ttlcredit
                            = $ttlcredit+$data->credit; @endphp
                        </tr>
                        @endforeach @else
                        <tr>
                            <td colspan="10" class="text-center">
                                Data Not Found
                            </td>
                        </tr>
                        @endif
                        <tr class="fw-bold">
                            <td colspan="4">Total</td>
                            <td>@currency($ttldebet)</td>
                            <td>@currency($ttlcredit)</td>
                            <td>@currency($saldo)</td>
                        </tr>
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
