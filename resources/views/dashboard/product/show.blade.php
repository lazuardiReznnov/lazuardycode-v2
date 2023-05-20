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

            <a
                href="/dashboard/product/{{ $data->slug }}/edit"
                class="btn btn-warning my-3"
                data-bs-toggle="tooltip"
                data-bs-placement="top"
                title="Edit product"
                ><i class="bi bi-pencil-square"></i
            ></a>
            <form
                action="/dashboard/product/{{ $data->slug }}"
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
            <div class="col-xl-4">
                <div class="card">
                    <div
                        class="card-body profile-card pt-4 d-flex flex-column align-items-center"
                    >
                        @if($data->image->count())
                        <div class="row">
                            @foreach($data->image as $pic)
                            <div class="col-sm-6">
                                <img
                                    src="{{ asset('storage/'. $pic->pic) }}"
                                    class="my-3 rounded-circle"
                                    alt="{{ $pic->name }}"
                                />

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
                                        title="Delete Image"
                                        onclick="return confirm('are You sure ??')"
                                    >
                                        <i class="bi bi-file-x-fill"></i>
                                    </button>
                                </form>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="row">
                            <div class="col-sm-4">
                                <img
                                    class="rounded-circle mx-auto d-block shadow my-3"
                                    src="http://source.unsplash.com/200x200?smartphones"
                                    alt=""
                                />
                            </div>
                        </div>

                        @endif

                        <h2 class="text-center">{{ $data->name }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button
                                    class="nav-link active"
                                    data-bs-toggle="tab"
                                    data-bs-target="#profile-overview"
                                >
                                    Overview
                                </button>
                            </li>

                            <li class="nav-item">
                                <button
                                    class="nav-link"
                                    data-bs-toggle="tab"
                                    data-bs-target="#pricing"
                                >
                                    Pricing
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2">
                            <div
                                class="tab-pane fade show active profile-overview"
                                id="profile-overview"
                            >
                                <h5 class="card-title">Details Product</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">
                                        Brand
                                    </div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $data->brand }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">
                                        Category
                                    </div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $data->CategoryProduct->name }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">
                                        Description
                                    </div>
                                    <div class="col-lg-9 col-md-8">
                                        {!! $data->descriptions !!}
                                    </div>
                                </div>
                            </div>
                            @if($data->pricing)
                            <div
                                class="tab-pane fade profile-overview pt-3"
                                id="pricing"
                            >
                                <h5 class="card-title">
                                    @currency($data->pricing->cash)
                                </h5>
                                <h5 class="card-title">Installment</h5>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">
                                        Downpayment
                                    </div>
                                    <div class="col-lg-9 col-md-8">
                                        @currency($data->pricing->dp)
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">
                                        3 Month
                                    </div>
                                    <div class="col-lg-9 col-md-8">
                                        @currency($data->pricing->three)
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">
                                        6 Month
                                    </div>
                                    <div class="col-lg-9 col-md-8">
                                        @currency($data->pricing->six)
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">
                                        9 Month
                                    </div>
                                    <div class="col-lg-9 col-md-8">
                                        @currency($data->pricing->nine)
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">
                                        12 Month
                                    </div>
                                    <div class="col-lg-9 col-md-8">
                                        @currency($data->pricing->twelve)
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <!-- End Bordered Tabs -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-administrator>
