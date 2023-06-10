<x-administrator>
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumblink link="/dashboard">Dashboard</x-breadcrumblink>
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
                <div class="btn-group">
                    <a
                        class="btn btn-primary"
                        href="/dashboard/transaction/create"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        title="Add Product"
                        ><i class="bi bi-file-plus"></i
                    ></a>
                </div>
            </div>
            <div class="col-md-6">
                <form action="/dashboard/transaction" method="get">
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
                <h5 class="card-title">Product List</h5>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>

                            <th scope="col">Date</th>
                            <th scope="col">invoice</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Product</th>
                            <th scope="col">Total Mount</th>
                            <th scope="col">Total Paid</th>
                            <th scope="col">difference</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($datas->count()) @foreach($datas as $data)
                        <tr>
                            <th scope="row">
                                {{ ($datas->currentpage()-1) * $datas->perpage() + $loop->index + 1 }}
                            </th>

                            <td>
                                {{ \Carbon\Carbon::parse($data->tgl)->format('d/m/Y') }}
                            </td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->customer->name}}</td>
                            <td>{{ $data->product->name}}</td>
                            <td>
                                @php $ttlmount = 0; $ttlmount =
                                ($data->tenor*$data->amount)+$data->dp @endphp
                                @currency($ttlmount)
                            </td>
                            @php $ttb = 0; $ttt = 0; $td = 0; @endphp
                            <td>
                                @foreach($data->cashflow as $ca)
                                @if($ca->acount->name == 20001 &&
                                $ca->transaction_id == $data->id)

                                <?php $ttb = $ttb+$ca->credit; ?>@endif
                                @if($ca->acount->name == 20002 &&
                                $ca->transaction_id == $data->id)
                                <?php 
                                $ttt =
                                $ca->credit ?> @endif @endforeach
                                <?php 
                                    $td = $ttb+$ttt;
                                ?>
                                @currency($td)
                            </td>
                            <td>@currency($ttlmount-$td)</td>
                            <td>
                                <a
                                    href="/dashboard/transaction/{{ $data->slug }}"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Detail transaction"
                                    class="badge bg-success"
                                >
                                    <i class="bi bi-eye-fill"></i>
                                </a>
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
