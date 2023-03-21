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
                <h5 class="card-title">Pricing</h5>
                <form
                    action="/dashboard/product/pricing/{{ $data->slug }}"
                    method="post"
                    enctype="multipart/form-data"
                >
                    @csrf @method('put')

                    <div class="row mb-3">
                        <label
                            for="name"
                            class="col-md-4 col-form-label text-md-end"
                            >{{ __("Cash") }}</label
                        >

                        <div class="col-md-6">
                            <input
                                id="cash"
                                type="text"
                                class="form-control @error('cash') is-invalid @enderror"
                                name="cash"
                                value="{{ old('cash',$data->pricing->cash) }}"
                                autocomplete="cash"
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
                            for="dp"
                            class="col-md-4 col-form-label text-md-end"
                            >{{ __("Downpayment") }}</label
                        >

                        <div class="col-md-6">
                            <input
                                id="dp"
                                type="text"
                                class="form-control @error('dp') is-invalid @enderror"
                                name="dp"
                                value="{{ old('dp',$data->pricing->dp) }}"
                                autocomplete="dp"
                                autofocus
                            />

                            @error('dp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label
                            for="three"
                            class="col-md-4 col-form-label text-md-end"
                            >{{ __("3 Month") }}</label
                        >

                        <div class="col-md-6">
                            <input
                                id="three"
                                type="text"
                                class="form-control @error('three') is-invalid @enderror"
                                name="three"
                                value="{{ old('three', $data->pricing->three) }}"
                                autocomplete="three"
                                autofocus
                            />

                            @error('three')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label
                            for="six"
                            class="col-md-4 col-form-label text-md-end"
                            >{{ __("6 Month") }}</label
                        >

                        <div class="col-md-6">
                            <input
                                id="six"
                                type="text"
                                class="form-control @error('six') is-invalid @enderror"
                                name="six"
                                value="{{ old('six', $data->pricing->six) }}"
                                autocomplete="six"
                                autofocus
                            />

                            @error('six')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label
                            for="nine"
                            class="col-md-4 col-form-label text-md-end"
                            >{{ __("9 Month") }}</label
                        >

                        <div class="col-md-6">
                            <input
                                id="nine"
                                type="text"
                                class="form-control @error('nine') is-invalid @enderror"
                                name="nine"
                                value="{{ old('nine', $data->pricing->nine) }}"
                                autocomplete="nine"
                                autofocus
                            />

                            @error('nine')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label
                            for="twelve"
                            class="col-md-4 col-form-label text-md-end"
                            >{{ __("12 Month") }}</label
                        >

                        <div class="col-md-6">
                            <input
                                id="twelve"
                                type="text"
                                class="form-control @error('twelve') is-invalid @enderror"
                                name="twelve"
                                value="{{ old('twelve', $data->pricing->twelve) }}"
                                autocomplete="twelve"
                                autofocus
                            />

                            @error('twelve')
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
