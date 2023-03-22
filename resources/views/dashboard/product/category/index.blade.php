<x-administrator>
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumblink link="/dashboard">Dashboard</x-breadcrumblink>
            <x-breadcrumblink link="/dashboard/product"
                >Product</x-breadcrumblink
            >
            <x-breadcrumbactive>{{ $title }}</x-breadcrumbactive>
        </x-breadcrumb>
    </x-pagetitle>
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
                        href="/dashboard/product/CategoryProduct/create"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        title="Add Product"
                        ><i class="bi bi-file-plus"></i
                    ></a>
                </div>
            </div>
            <div class="col-md-6">
                <form action="/dashboard/product/CategoryProduct" method="get">
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
                            <th scope="col">Pic</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
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
                                @if($data->image)
                                <img
                                    width="50"
                                    src="{{ asset('storage/'. $data->image->pic) }}"
                                    class="my-3 d-block mx-auto"
                                    alt="{{ $data->image->name }}"
                                />
                                @else
                                <img
                                    class="rounded-circle mx-auto d-block shadow my-3"
                                    src="http://source.unsplash.com/200x200?smartphones"
                                    alt=""
                                    width="50"
                                />
                                @endif
                            </td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->descriptions}}</td>
                            <td>
                                <a
                                    href="/dashboard/product/CategoryProduct/{{ $data->slug }}/edit"
                                    class="badge bg-warning"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Edit product"
                                    ><i class="bi bi-pencil-square"></i
                                ></a>
                                |
                                <form
                                    action="/dashboard/product/CategoryProduct/{{ $data->slug }}"
                                    method="post"
                                    class="d-inline"
                                >
                                    @method('delete') @csrf
                                    <button
                                        class="badge bg-danger border-0"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Delete Category"
                                        onclick="return confirm('are You sure ??')"
                                    >
                                        <i class="bi bi-file-x-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach @else
                        <tr>
                            <td colspan="6" class="text-center">
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
