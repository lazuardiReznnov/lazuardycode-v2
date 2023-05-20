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
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Form Upload New Product</h5>
                <form
                    action="/dashboard/product/store-excel"
                    method="post"
                    enctype="multipart/form-data"
                >
                    @csrf
                    <div class="row mb-3">
                        <label
                            for="pic"
                            class="col-md-4 col-form-label text-md-end"
                            >{{ __("Upload File") }}</label
                        >

                        <div class="col-md-6">
                            <img
                                width="200"
                                class="img-preview img-fluid mb-2"
                                alt=""
                            />

                            <input
                                id="pic"
                                type="file"
                                class="form-control @error('excl') is-invalid @enderror"
                                name="excl"
                                value="{{ old('excl') }}"
                                onchange="previewImage()"
                                autocomplete="excl"
                                autofocus
                            />
                            @error('excl')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3 ms-1">
                        <div class="col-md text-md-center">
                            <button
                                class="btn btn-primary"
                                type="submit"
                                name="save"
                            >
                                Upload
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </x-section>

    @push('script')
    <script src="/assets/js/lazuardicode.js"></script>

    @endpush
</x-administrator>
