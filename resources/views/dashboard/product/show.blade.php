<x-administrator>
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumblink link="/dashboard">Dashboard</x-breadcrumblink>
            <x-breadcrumblink link="/dashboard/product"
                >product</x-breadcrumblink
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
        <div class="btn-group">
            <a
                href="/dashboard/product/image/{{ $data->slug }}"
                data-bs-toggle="tooltip"
                data-bs-placement="top"
                title="Add Image"
                class="btn btn-primary my-3"
                ><i class="bi bi-upload"></i>
            </a>
            <a
                href="/dashboard/product/pricing/{{ $data->slug }}"
                data-bs-toggle="tooltip"
                data-bs-placement="top"
                title="Add Pricing"
                class="btn btn-primary my-3"
                ><i class="bi bi-tag-fill"></i>
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-md">
                        @if($data->image->count())
                        <div class="row">
                            @foreach($data->image as $pic)
                            <div class="col-sm-6">
                                <div class="card mb-3 shadow d-flex">
                                    <img
                                        width="200"
                                        src="{{ asset('storage/'. $pic->pic) }}"
                                        class="my-3 d-block mx-auto"
                                        alt="{{ $pic->name }}"
                                    />
                                    <p class="text-center fw-bold">
                                        {{ $pic->name }}
                                    </p>
                                    <form
                                        action="/dashboard/product/image/{{ $data->slug }}"
                                        method="post"
                                        class="d-inline"
                                    >
                                        <input
                                            type="hidden"
                                            name="id"
                                            value="{{ $pic->id }}"
                                        />
                                        @method('delete') @csrf
                                        <button
                                            class="badge bg-danger"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="Delete Image Unit"
                                            onclick="return confirm('are You sure ??')"
                                        >
                                            <i class="bi bi-file-x-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        @else
                        <img
                            class="rounded-circle mx-auto d-block shadow my-3"
                            src="http://source.unsplash.com/200x200?smartphones"
                            alt=""
                            width="250"
                        />
                        @endif
                    </div>
                    <div class="col-md-6">
                        <!-- List group with active and disabled items -->
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <b>Brand</b><br />
                                {{ $data->brand}}
                            </li>
                            <li class="list-group-item">
                                <b>Category</b><br />
                                {{ $data->CategoryProduct->name }}
                            </li>
                            <li class="list-group-item">
                                <b>Description</b
                                ><br />{{ $data->descriptions }}
                            </li>
                        </ul>
                        <!-- End Clean list group -->
                    </div>
                    <div class="col-md-4">
                        <!-- End Default List group -->
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-uppercase">Pricing</h5>
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Cash</div>
                            <div class="col-lg-9 col-md-8">Kevin Anderson</div>
                        </div>
                        <h5 class="card-title">Installment</h5>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">
                                Downpayment
                            </div>
                            <div class="col-lg-9 col-md-8">0000</div>
                            <div class="col-lg-3 col-md-4 label">3 Month</div>
                            <div class="col-lg-9 col-md-8">0000</div>
                            <div class="col-lg-3 col-md-4 label">6 Month</div>
                            <div class="col-lg-9 col-md-8">0000</div>
                            <div class="col-lg-3 col-md-4 label">9 Month</div>
                            <div class="col-lg-9 col-md-8">0000</div>
                            <div class="col-lg-3 col-md-4 label">12 Month</div>
                            <div class="col-lg-9 col-md-8">0000</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-section>
</x-administrator>
