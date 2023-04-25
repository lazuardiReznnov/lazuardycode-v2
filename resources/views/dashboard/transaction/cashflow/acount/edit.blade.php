<x-administrator>
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumblink link="/dashboard">Dashboard</x-breadcrumblink>
            <x-breadcrumblink link="/dashboard/transaction"
                >transaction</x-breadcrumblink
            >
            <x-breadcrumblink link="/dashboard/transaction/cashflow"
                >Cashflow</x-breadcrumblink
            >
            <x-breadcrumblink link="/dashboard/transaction/cashflow/acount"
                >Acount</x-breadcrumblink
            >
            <x-breadcrumbactive>{{ $title }}</x-breadcrumbactive>
        </x-breadcrumb>
    </x-pagetitle>

    <x-section numb="8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Form New Acount</h5>
                <form
                    action="/dashboard/transaction/cashflow/acount/{{ $data->slug }}"
                    method="post"
                >
                    @csrf @method('put')
                    <div class="form-floating mb-3">
                        <input
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="Name"
                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name', $data->name) }}"
                        />

                        <label for="name">Name</label>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input
                            class="form-control @error('slug') is-invalid @enderror"
                            placeholder="slug"
                            id="slug"
                            name="slug"
                            type="text"
                            value="{{ old('slug', $data->slug) }}"
                        />

                        <label for="slug">slug</label>
                        @error('slug')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <textarea
                            class="form-control @error('description') is-invalid @enderror"
                            placeholder="Description"
                            id="description"
                            name="description"
                            >{{ old("description", $data->description) }}</textarea
                        >
                        <label for="description">Description</label>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <select
                            class="form-select @error('slug') is-invalid @enderror"
                            id="state"
                            aria-label="state"
                            name="state"
                        >
                            <option selected>Select State</option>
                            <option value="0">In Come</option>
                            <option value="1">Out Come</option>
                        </select>
                        <label for="state">State</label>
                        @error('state')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </x-section>
    <script>
        const name = document.querySelector("#name");
        const slug = document.querySelector("#slug");
        const link = "/dashboard/transaction/cashflow/acount/checkSlug?name=";

        makeslug(name, slug, link);
    </script>
    @push('script')
    <script src="/assets/js/lazuardicode.js"></script>

    @endpush
</x-administrator>
