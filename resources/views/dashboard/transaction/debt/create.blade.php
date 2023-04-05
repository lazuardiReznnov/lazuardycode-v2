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
            <x-breadcrumbactive>{{ $title }}</x-breadcrumbactive>
        </x-breadcrumb>
    </x-pagetitle>

    <!-- End Page Title -->

    <x-section numb="12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Form New transaction Debt</h5>
                <form
                    action="/dashboard/transaction/debt"
                    method="post"
                    enctype="multipart/form-data"
                >
                    @csrf
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
                            for="name"
                            class="col-md-4 col-form-label text-md-end"
                            >{{ __("Invoice Debt Name") }}</label
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
                            for="transaction"
                            class="col-md-4 col-form-label text-md-end"
                            >{{ __("Transaction") }}</label
                        >

                        <div class="col-md-6">
                            <select
                                class="form-select @error('category_product_id') is-invalid @enderror"
                                id="transaction"
                                aria-label="transaction"
                                name="transaction_id"
                            >
                                <option selected value="">
                                    Select transaction
                                </option>
                                @foreach($transactions as $transaction)
                                @if(old('transaction_id')==$transaction->id)
                                <option value="{{ $transaction->id }}" selected>
                                    {{ $transaction->name }}
                                </option>
                                @else
                                <option value="{{ $transaction->id }}">
                                    {{ $transaction->name }}
                                </option>
                                @endif @endforeach
                            </select>

                            @error('transaction_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label
                            for="fintech"
                            class="col-md-4 col-form-label text-md-end"
                            >{{ __("fintech") }}</label
                        >

                        <div class="col-md-6">
                            <select
                                class="form-select @error('fintech_id') is-invalid @enderror"
                                id="fintech"
                                aria-label="fintech"
                                name="fintech_id"
                            >
                                <option selected value="">
                                    Select fintech Product
                                </option>
                                @foreach($fintechs as $fintech)
                                @if(old('fintech_id')==$fintech->id)
                                <option value="{{ $fintech->id }}" selected>
                                    {{ $fintech->name }}
                                </option>
                                @else
                                <option value="{{ $fintech->id }}">
                                    {{ $fintech->name }}
                                </option>
                                @endif @endforeach
                            </select>

                            @error('fintech_product_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label
                            for="acount"
                            class="col-md-4 col-form-label text-md-end"
                            >{{ __("Acount") }}</label
                        >

                        <div class="col-md-6">
                            <select
                                class="form-select"
                                aria-label="acount"
                                id="acount"
                                name="acount_fintech_id"
                            ></select>

                            @error('acount_fintech_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label
                            for="tenor"
                            class="col-md-4 col-form-label text-md-end"
                            >{{ __("tenor") }}</label
                        >

                        <div class="col-md-6">
                            <select
                                name="tenor"
                                id="tenor"
                                class="form-control"
                            >
                                <option value="" selected>
                                    --Select Tenor--
                                </option>
                                <option value="3">3</option>
                                <option value="6">6</option>
                                <option value="9">9</option>
                                <option value="12">12</option>
                            </select>
                            @error('tenor')
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

    <script>
        const name = document.querySelector("#name");
        const slug = document.querySelector("#slug");
        const link = "/dashboard/transaction/debt/checkSlug?name=";

        makeslug(name, slug, link);

        const fintech = document.querySelector("#fintech");
        const acount = document.querySelector("#acount");
        const link2 = "/dashboard/transaction/debt/getacount?acount=";

        fintech.addEventListener("change", function () {
            fetch(link2 + fintech.value)
                .then((response) => response.json())
                .then((response) => {
                    const m = response;
                    let card = "<option>---Choice Acount---</option>";
                    m.forEach(
                        (m) =>
                            (card +=
                                '<option value="' +
                                m.id +
                                '">' +
                                m.name +
                                "</option>")
                    );
                    acount.innerHTML = card;
                });
        });
    </script>
    @push('script')
    <script src="/assets/js/lazuardicode.js"></script>

    @endpush
</x-administrator>
