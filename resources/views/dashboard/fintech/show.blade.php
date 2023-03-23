<x-administrator>
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumblink link="/dashboard">Dashboard</x-breadcrumblink>
            <x-breadcrumblink link="/dashboard/fintech"
                >fintech</x-breadcrumblink
            >
            <x-breadcrumbactive>{{ $title }}</x-breadcrumbactive>
        </x-breadcrumb>
    </x-pagetitle>

    <!-- End Page Title -->
    <section class="section profile">
        <div class="btn-group">
            <a
                href="/dashboard/fintech/acountfintech/{{ $data->slug }}"
                data-bs-toggle="tooltip"
                data-bs-placement="top"
                title="Add Image"
                class="btn btn-primary my-3"
                ><i class="bi bi-upload"></i>
            </a>
            <a
                href="/dashboard/fintech/{{ $data->slug }}/edit"
                class="btn btn-warning my-3"
                data-bs-toggle="tooltip"
                data-bs-placement="top"
                title="Edit fintech"
                ><i class="bi bi-pencil-square"></i
            ></a>
            <form
                action="/dashboard/fintech/{{ $data->slug }}"
                method="post"
                class="d-inline"
            >
                @method('delete') @csrf
                <button
                    class="btn btn-danger my-3 rounded-0"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Delete fintech"
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
                        @if($data->image)
                        <img
                            width="200"
                            src="{{ asset('storage/'. $data->image->pic) }}"
                            class="rounded-circle"
                            alt="{{ $data->image->name }}"
                        />
                        <form
                            action="/dashboard/customer/image/{{ $data->slug }}"
                            method="post"
                            class="d-inline"
                        >
                            <input
                                type="hidden"
                                name="id"
                                value="{{ $data->image->id }}"
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
                        @else
                        <img
                            class="rounded-circle mx-auto d-block shadow my-3"
                            src="http://source.unsplash.com/200x200?bank"
                            alt=""
                            width="250"
                        />
                        @endif

                        <h2>{{ $data->name }}</h2>
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
                                    data-bs-target="#card"
                                >
                                    Card
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2">
                            <div
                                class="tab-pane fade show active profile-overview"
                                id="profile-overview"
                            >
                                <h5 class="card-title">Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">
                                        Name
                                    </div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $data->name }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">
                                        Descriptions
                                    </div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $data->descriptions }}
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade billing pt-3" id="card">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Number</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($data->acountfintech->count())
                                        @foreach($data->acountfintech as $fin)
                                        <tr>
                                            <th scope="row">
                                                {{ $loop->iteration}}
                                            </th>
                                            <td>{{ $fin->name }}</td>
                                            <td>{{ $fin->number }}</td>
                                            <td>
                                                <a
                                                    href="/dashboard/fintech/acountfintech/{{ $data->slug }}/edit"
                                                    class="badge bg-warning"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="Edit fintech"
                                                    ><i
                                                        class="bi bi-pencil-square"
                                                    ></i
                                                ></a>
                                                |
                                                <form
                                                    action="/dashboard/fintech/acountfintech/{{ $data->slug }}"
                                                    method="post"
                                                    class="d-inline"
                                                >
                                                    @method('delete') @csrf
                                                    <button
                                                        class="badge bg-danger border-0"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="Delete fintech"
                                                        onclick="return confirm('are You sure ??')"
                                                    >
                                                        <i
                                                            class="bi bi-file-x-fill"
                                                        ></i>
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
                            </div>
                        </div>
                        <!-- End Bordered Tabs -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-administrator>
