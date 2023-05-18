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
                <h5 class="card-title">Form New Product</h5>
                <form
                    action="/dashboard/product"
                    method="post"
                    enctype="multipart/form-data"
                >
                    @csrf

                    <div class="row mb-3">
                        <label
                            for="name"
                            class="col-md-4 col-form-label text-md-end"
                            >{{ __("Product Name") }}</label
                        >

                        <div class="col-md-6">
                            <input
                                id="name"
                                type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                name="name"
                                value="{{ old('name') }}"
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
                                value="{{ old('slug') }}"
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
                            for="category"
                            class="col-md-4 col-form-label text-md-end"
                            >{{ __("Category") }}</label
                        >

                        <div class="col-md-6">
                            <select
                                class="form-select @error('category_product_id') is-invalid @enderror"
                                id="category"
                                aria-label="category"
                                name="category_product_id"
                            >
                                <option selected value="">
                                    Select Category Product
                                </option>
                                @foreach($categories as $category)
                                @if(old('category_product_id')==$category->id)
                                <option value="{{ $category->id }}" selected>
                                    {{ $category->name }}
                                </option>
                                @else
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                                @endif @endforeach
                            </select>

                            @error('category_product_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label
                            for="brand"
                            class="col-md-4 col-form-label text-md-end"
                            >{{ __("Product brand") }}</label
                        >

                        <div class="col-md-6">
                            <input
                                id="brand"
                                type="text"
                                class="form-control @error('brand') is-invalid @enderror"
                                name="brand"
                                value="{{ old('brand') }}"
                                autocomplete="brand"
                                autofocus
                            />

                            @error('brand')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label
                            for="description"
                            class="col-md-4 col-form-label text-md-end"
                            >{{ __("description") }}</label
                        >

                        <div class="col-md-6">
                            <textarea
                                class="form-control tinymce-editor"
                                id="descriptions"
                                name="descriptions"
                                rows="3"
                                >{{ old("descriptions") }}</textarea
                            >

                            @error('descriptions')
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
                                name="save"
                            >
                                Save
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
