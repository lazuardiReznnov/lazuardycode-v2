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
                <a class="nav-link" href="/dashboard/product/category"
                    >Category</a
                >
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
                                | Hapus | Edit
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
