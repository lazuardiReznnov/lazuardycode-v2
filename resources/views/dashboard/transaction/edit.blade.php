<x-administrator>
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumblink link="/dashboard">Dashboard</x-breadcrumblink>
            <x-breadcrumblink link="/dashboard/transaction"
                >transaction</x-breadcrumblink
            >
            <x-breadcrumbactive>{{ $title }}</x-breadcrumbactive>
        </x-breadcrumb>
    </x-pagetitle>

    <!-- End Page Title -->

    <x-section numb="12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Form Edit transaction</h5>
                <form
                    action="/dashboard/transaction/{{ $data->slug }}"
                    method="post"
                    enctype="multipart/form-data"
                >
                    @csrf @method('put')
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
                                value="{{ old('tgl', $data->tgl) }}"
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
                            >{{ __("Invoice Name") }}</label
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
                            for="category"
                            class="col-md-4 col-form-label text-md-end"
                            >{{ __("customer") }}</label
                        >

                        <div class="col-md-6">
                            <select
                                class="form-select @error('category_product_id') is-invalid @enderror"
                                id="customer"
                                aria-label="customer"
                                name="customer_id"
                            >
                                <option selected value="">
                                    Select customer
                                </option>
                                @foreach($customers as $customer)
                                @if(old('customer_id',
                                $data->customer_id)==$customer->id)
                                <option value="{{ $customer->id }}" selected>
                                    {{ $customer->name }}
                                </option>
                                @else
                                <option value="{{ $customer->id }}">
                                    {{ $customer->name }}
                                </option>
                                @endif @endforeach
                            </select>

                            @error('customer_id')
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
                                @if(old('category_product_id',
                                $data->product->category_product_id)==$category->id)
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
                            for="product_id"
                            class="col-md-4 col-form-label text-md-end"
                            >{{ __("product") }}</label
                        >

                        <div class="col-md-6">
                            <select
                                class="form-select"
                                aria-label="product_id"
                                id="product"
                                name="product_id"
                            >
                                @if(old('product_id',
                                $data->product_id)==$data->product->id)
                                <option value="{{ $data->product_id}}" selected>
                                    {{ $data->product->name }}
                                </option>
                                @endif
                            </select>

                            @error('product_id')
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
                                @if($data->tenor==3)
                                <option value="three" selected>
                                    {{ $data->tenor }}
                                </option>
                                @elseif($data->tenor==6)
                                <option value="six" selected>
                                    {{ $data->tenor }}
                                </option>
                                @elseif($data->tenor==9)
                                <option value="nine" selected>
                                    {{ $data->tenor }}
                                </option>
                                @elseif($data->tenor==12)
                                <option value="twelve" selected>
                                    {{ $data->tenor }}
                                </option>
                                @else
                                <option value="three">3</option>
                                <option value="six">6</option>
                                <option value="nine">9</option>
                                <option value="twelve">12</option>
                                @endif
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
                                value="{{ old('dp', $data->dp) }}"
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
                                value="{{ old('amount', $data->amount) }}"
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
        const link = "/dashboard/transaction/checkSlug?name=";

        makeslug(name, slug, link);

        const category = document.querySelector("#category");
        const product = document.querySelector("#product");
        const link2 = "/dashboard/transaction/getproduct?category=";

        category.addEventListener("change", function () {
            fetch(link2 + category.value)
                .then((response) => response.json())
                .then((response) => {
                    const m = response;
                    let card = "<option>---Choice Product---</option>";
                    m.forEach(
                        (m) =>
                            (card +=
                                '<option value="' +
                                m.id +
                                '">' +
                                m.name +
                                "</option>")
                    );
                    product.innerHTML = card;
                });
        });

        const amount = document.querySelector("#amount");
        const tenor = document.querySelector("#tenor");

        tenor.addEventListener("change", function () {
            fetch(
                "/dashboard/transaction/getamount?product=" +
                    product.value +
                    "&tenor=" +
                    tenor.value
            )
                .then((response) => response.json())
                .then(
                    (data) => (
                        (amount.value = data.amount), (dp.value = data.dp)
                    )
                );
        });
    </script>
    @push('script')
    <script src="/assets/js/lazuardicode.js"></script>

    @endpush
</x-administrator>
