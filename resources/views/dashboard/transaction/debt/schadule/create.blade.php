<x-administrator>
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumblink link="/dashboard">Dashboard</x-breadcrumblink>
            <x-breadcrumblink link="/dashboard/transaction"
                >transaction</x-breadcrumblink
            >
            <x-breadcrumblink link="/dashboard/transaction/debt"
                >transaction Debt</x-breadcrumblink
            >
            <x-breadcrumblink
                link="/dashboard/transaction/debt/{{ $data->slug }}"
                >{{ $data->name }}</x-breadcrumblink
            >
            <x-breadcrumbactive>{{ $title }}</x-breadcrumbactive>
        </x-breadcrumb>
    </x-pagetitle>

    <!-- End Page Title -->

    <x-section numb="12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Form New transaction Debt</h5>
                <form
                    action="/dashboard/transaction/debt/schadule"
                    method="post"
                    enctype="multipart/form-data"
                >
                    @csrf
                    <input
                        type="hidden"
                        name="debt_id"
                        value="{{ $data->id }}"
                    />
                    <input
                        type="hidden"
                        name="debt_slug"
                        value="{{ $data->slug }}"
                    />

                    <div class="row mb-3">
                        <label
                            for="tgl"
                            class="col-md-4 col-form-label text-md-end"
                            >{{ __("tgl") }}</label
                        >

                        <div class="col-md-6">
                            <input
                                id="tgl"
                                type="date"
                                class="form-control @error('tgl') is-invalid @enderror"
                                name="tgl"
                                value="{{ old('tgl') }}"
                                autocomplete="tgl"
                                autofocus
                            />

                            @error('tgl')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label
                            for="amount"
                            class="col-md-4 col-form-label text-md-end"
                            >{{ __("amount") }}</label
                        >

                        <div class="col-md-6">
                            <input
                                id="amount"
                                type="text"
                                class="form-control @error('amount') is-invalid @enderror"
                                name="amount"
                                value="{{ old('amount') }}"
                                autocomplete="amount"
                                autofocus
                            />

                            @error('amount')
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
</x-administrator>
