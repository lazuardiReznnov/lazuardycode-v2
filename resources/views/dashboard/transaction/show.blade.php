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
                href="/dashboard/transaction/debt/{{ $data->debt->slug }}"
                data-bs-toggle="tooltip"
                data-bs-placement="top"
                title="detail Debt"
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
                                        <?php
                                        $ttm = ($data->amount
                                        *$data->tenor)+$data->dp; ?>
                                        @currency($ttm)
                                    </td>
                                    <td>
                                        <?php
                                        $tpb = 0;
                                        $tbb=0;    
                                        $dp=0;
                                        $tf = 0;
                                      ?>

                                        @foreach($data->cashflow as $ca)
                                        @if($ca->acount->name == 20001 &&
                                        $ca->transaction_id == $data->id)
                                        <?php   
                                        $tpb = $tpb+$ca->credit; ?>
                                        @elseif($ca->acount->name==30001 &&
                                        $ca->transaction_id == $data->id)
                                        <?php
                                        $tbb = $tbb+$ca->debet; ?>
                                        @elseif($ca->acount->name==20002 &&
                                        $ca->transaction_id == $data->id)
                                        <?php
                                            $dp = $ca->credit; ?>
                                        @elseif($ca->acount->name==30003 &&
                                        $ca->transaction_id == $data->id)

                                        <?php 
                                            $tf = $tf + $ca->debet; ?> @endif
                                        @endforeach @currency($tpb+$dp)
                                    </td>
                                    <td>@currency($ttm-$tpb)</td>
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
                                    <td>@currency($tbb)</td>
                                    <td>@currency($ttb-$tbb)</td>
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

        <div class="row">
            <div class="col-xl">
                <div class="card">
                    <div class="card-body pt-3">
                        <h5 class="card-title">Transaction Fee Overview</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Amount Fee</th>
                                    <th scope="col">Tenor</th>
                                    <th scope="col">Total Fee</th>
                                    <th scope="col">Total Paid fee</th>
                                    <th scope="col">difference</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>@currency(20000)</td>
                                    <td>{{ $data->tenor }}</td>
                                    <td>@currency($data->tenor * 20000)</td>
                                    <td>@currency($tf)</td>
                                    <td>
                                        @currency(($data->tenor *20000)-$tf)
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
                        <h5 class="card-title">Grand Total</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Total Amount</th>
                                    <th scope="col">Total Debt</th>
                                    <th scope="col">difference</th>
                                    <th scope="col">Total Paid</th>
                                    <th scope="col">Total Debt Paid</th>
                                    <th scope="col">difference</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                       $ttf=($data->tenor*20000); $gtb
                                    =$ttf+$ttb; $tp = $tpb+$dp; $tdp = $tbb+$tf;
                                    ?>
                                    <td>@currency($ttm)</td>
                                    <td>@currency($gtb)</td>
                                    <td>@currency($ttm-$gtb)</td>
                                    <td>@currency($tp)</td>
                                    <td>@currency($tdp)</td>
                                    <td>@currency($tp-$tdp)</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-administrator>
