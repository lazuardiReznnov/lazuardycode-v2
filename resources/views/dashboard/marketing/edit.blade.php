<x-administrator>
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumblink link="/dashboard">Dashboard</x-breadcrumblink>
            <x-breadcrumblink link="/dashboard/marketing"
                >Marketing</x-breadcrumblink
            >
            <x-breadcrumbactive>{{ $title }}</x-breadcrumbactive>
        </x-breadcrumb>
    </x-pagetitle>

    <!-- End Page Title -->

    <x-section numb="12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Form Edit</h5>
                <form
                    action="/dashboard/marketing/{{ $data->slug }}"
                    method="post"
                    enctype="multipart/form-data"
                >
                    @csrf @method('put')

                    <div class="row mb-3">
                        <label
                            for="pic"
                            class="col-md-4 col-form-label text-md-end"
                            >{{ __("picture") }}</label
                        >
                        <div class="col-md-6">
                            @if($data->image)
                            <img
                                width="100"
                                src="{{ asset('storage/'. $data->image->pic) }}"
                                class="my-3 d-block"
                                alt="{{ $data->image->name }}"
                            />
                            <input
                                type="hidden"
                                name="old_pic"
                                value="{{ $data->image->pic }}"
                            />
                            @else

                            <img
                                width="200"
                                class="img-preview img-fluid mb-2"
                                alt=""
                            />
                            @endif
                            <input
                                id="pic"
                                type="file"
                                class="form-control @error('pic') is-invalid @enderror"
                                name="pic"
                                value="{{ old('pic') }}"
                                onchange="previewImage()"
                                autocomplete="pic"
                                autofocus
                            />
                            @error('pic')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label
                            for="name"
                            class="col-md-4 col-form-label text-md-end"
                            >{{ __("Name") }}</label
                        >

                        <div class="col-md-6">
                            <input
                                id="name"
                                type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                name="name"
                                value="{{ old('name', $data->name) }}"
                                autocomplete="name"
                                autofocus
                            />

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label
                            for="slug"
                            class="col-md-4 col-form-label text-md-end"
                            >{{ __("Slug") }}</label
                        >

                        <div class="col-md-6">
                            <input
                                id="slug"
                                type="text"
                                class="form-control @error('slug') is-invalid @enderror"
                                name="slug"
                                value="{{ old('slug', $data->slug) }}"
                                autocomplete="slug"
                                autofocus
                            />

                            @error('slug')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label
                            for="nik"
                            class="col-md-4 col-form-label text-md-end"
                            >{{ __("KTP") }}</label
                        >

                        <div class="col-md-6">
                            <input
                                id="nik"
                                type="number"
                                class="form-control @error('nik') is-invalid @enderror"
                                name="nik"
                                value="{{ old('nik', $data->nik) }}"
                                autocomplete="nik"
                                autofocus
                            />

                            @error('nik')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label
                            for="email"
                            class="col-md-4 col-form-label text-md-end"
                            >{{ __("Email") }}</label
                        >

                        <div class="col-md-6">
                            <input
                                id="email"
                                type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                name="email"
                                value="{{ old('email', $data->email) }}"
                                autocomplete="email"
                                autofocus
                            />

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label
                            for="phone"
                            class="col-md-4 col-form-label text-md-end"
                            >{{ __("Phone") }}</label
                        >

                        <div class="col-md-6">
                            <input
                                id="phone"
                                type="text"
                                class="form-control @error('phone') is-invalid @enderror"
                                name="phone"
                                value="{{ old('phone',$data->phone) }}"
                                autocomplete="phone"
                                autofocus
                            />

                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label
                            for="address"
                            class="col-md-4 col-form-label text-md-end"
                            >{{ __("address") }}</label
                        >

                        <div class="col-md-6">
                            <textarea
                                class="form-control"
                                id="address"
                                name="address"
                                rows="3"
                                >{{ old("address", $data->address) }}</textarea
                            >

                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3 ms-1">
                        <div class="col-md text-md-end">
                            <button
                                class="btn btn-primary"
                                type="submit"
                                name="update"
                            >
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </x-section>

    <script>
        const name = document.querySelector("#name");
        const slug = document.querySelector("#slug");
        const link = "/dashboard/product/checkSlug?name=";

        makeslug(name, slug, link);
    </script>
    @push('script')
    <script src="/assets/js/lazuardicode.js"></script>

    @endpush
</x-administrator>
