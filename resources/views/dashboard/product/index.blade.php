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
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <a
                    class="nav-link"
                    href="/dashboard/product/category"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Category Product"
                    ><i class="bi bi-bookmark-plus"></i
                ></a>
            </li>
            <li class="nav-item">
                <a
                    class="nav-link"
                    href="/dashboard/product/create"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Add Product"
                    ><i class="bi bi-file-plus"></i
                ></a>
            </li>
        </ul>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Product List</h5>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>

                            <th scope="col">Brand</th>
                            <th scope="col">Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($datas->count()) @foreach($datas as $data)
                        <tr>
                            <th scope="row">
                                {{ ($datas->currentpage()-1) * $datas->perpage() + $loop->index + 1 }}
                            </th>

                            <td>{{ $data->brand }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->categoryproduct->name}}</td>
                            <td>
                                <a
                                    href="/dashboard/product/{{ $data->slug }}"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Detail Product"
                                    class="badge bg-success"
                                >
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                |
                                <form
                                    action="/dashboard/product/{{ $data->slug }}"
                                    method="post"
                                    class="d-inline"
                                >
                                    @method('delete') @csrf
                                    <button
                                        class="badge bg-danger"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Delete product"
                                        onclick="return confirm('are You sure ??')"
                                    >
                                        <i class="bi bi-file-x-fill"></i>
                                    </button>
                                </form>
                                |
                                <a
                                    href="/dashboard/product/{{ $data->slug }}/edit"
                                    class="badge bg-warning"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Edit product"
                                    ><i class="bi bi-pencil-square"></i
                                ></a>
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
