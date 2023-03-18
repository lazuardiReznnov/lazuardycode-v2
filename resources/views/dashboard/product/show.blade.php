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
        <ul class="nav justify-content-start">
            <li class="nav-item">
                <a
                    href="/dashboard/product/image/{{ $data->slug }}"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Add Image"
                    class="btn btn-primary my-3"
                    ><i class="bi bi-plus-circle"></i
                ></a>
            </li>
        </ul>
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
                            <li class="list-group-item">
                                <h5 class="card-title">Harga</h5>

                                <!-- Default List group -->
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <b>Cash</b><br />{{ $data->cash }}
                                    </li>
                                    <li class="list-group-item">
                                        <h5>Cicilan</h5>
                                        <p class="fw-bold">
                                            Down Payment : <br />
                                            @currency($data->dp)
                                        </p>
                                        <hr />
                                        <!-- List group Numbered -->
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                <b>3 Bulan :</b>
                                                <br />@currency($data->three)
                                            </li>
                                            <li class="list-group-item">
                                                <b>6 Bulan :</b> <br />
                                                @currency($data->six)
                                            </li>
                                            <li class="list-group-item">
                                                <b>9 Bulan :</b>
                                                <br />@currency($data->nine)
                                            </li>
                                            <li class="list-group-item">
                                                <b>12 Bulan :</b>
                                                <br />@currency($data->twelve)
                                            </li>
                                        </ul>
                                        <!-- End List group Numbered -->
                                    </li>
                                    <li class="list-group-item"></li>
                                </ul>
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
    </x-section>
</x-administrator>
