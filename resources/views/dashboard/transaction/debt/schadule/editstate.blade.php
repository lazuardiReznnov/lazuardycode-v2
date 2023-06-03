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
                link="/dashboard/transaction/debt/{{ $data->debt->slug }}"
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
                    action="/dashboard/transaction/debt/schadule/updatestate/{{ $data->id }}"
                    method="post"
                    enctype="multipart/form-data"
                >
                    @csrf @method('put')
                    <input
                        type="hidden"
                        name="debt_id"
                        value="{{ $data->debt->id }}"
                    />
                    <input
                        type="hidden"
                        name="debt_slug"
                        value="{{ $data->debt->slug }}"
                    />

                    <div class="row mb-3">
                        <label
                            for="tgl"
                            class="col-md-4 col-form-label text-md-end"
                            >{{ __("State") }}</label
                        >

                        <div class="col-md-6">
                            <select
                                id="state"
                                class="form-select"
                                name="status"
                            >
                                <option selected>Choise</option>
                                <option value="1">Paid</option>
                                <option value="0">Unpaid</option>
                            </select>

                            @error('state')
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
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </x-section>
</x-administrator>
