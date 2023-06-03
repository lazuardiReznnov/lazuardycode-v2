<x-administrator>
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumblink link="/dashboard">Dashboard</x-breadcrumblink>
            <x-breadcrumblink link="/dashboard/transaction"
                >Transaction</x-breadcrumblink
            >
            <x-breadcrumblink link="/dashboard/transaction/cashflow"
                >cashflow</x-breadcrumblink
            >
            <x-breadcrumbactive>{{ $title }}</x-breadcrumbactive>
        </x-breadcrumb>
    </x-pagetitle>

    <!-- End Page Title -->

    <x-section>
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form Transaction</h5>
                        <form
                            action="/dashboard/transaction/cashflow/{{ $data->slug }}"
                            method="post"
                        >
                            @csrf @method('put')
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
                            <div class="form-floating mb-3">
                                <input
                                    class="form-control @error('tgl') is-invalid @enderror"
                                    placeholder="date"
                                    id="date"
                                    name="tgl"
                                    type="date"
                                    value="{{ old('tgl', $data->tgl) }}"
                                />

                                <label for="date">date</label>
                                @error('tgl')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <select
                                    class="form-select @error('acount_id') is-invalid @enderror"
                                    id="acount"
                                    aria-label="acount"
                                    name="acount_id"
                                >
                                    <option selected>Select Acount</option>
                                    @foreach($datas as $acount)
                                    @if(old('acount_id',
                                    $data->acount_id)==$acount->id)
                                    <option value="{{ $acount->id }}" selected>
                                        {{ $acount->name }} -
                                        {{ $acount->description }}
                                    </option>
                                    @else
                                    <option value="{{ $acount->id }}">
                                        {{ $acount->name }} -
                                        {{ $acount->description }}
                                    </option>
                                    @endif @endforeach
                                </select>
                                <label for="acount">Select Acount</label>
                            </div>

                            <div class="form-floating mb-3">
                                <select
                                    class="form-select @error('transaction') is-invalid @enderror"
                                    id="transaction"
                                    aria-label="transaction"
                                    name="transaction_id"
                                >
                                    <option selected value="0">
                                        Select Transaction
                                    </option>
                                    @foreach($transactions as $transaction)
                                    @if(old('transaction_id',
                                    $data->transaction_id)==$transaction->id)
                                    <option
                                        value="{{ $transaction->id }}"
                                        selected
                                    >
                                        {{ $transaction->name }} -
                                        {{ $transaction->customer->name }}
                                    </option>
                                    @else
                                    <option value="{{ $transaction->id }}">
                                        {{ $transaction->name }} -
                                        {{ $transaction->customer->name }}
                                    </option>
                                    @endif @endforeach
                                </select>
                                <label for="acount">Select Transaction</label>
                                @error('transaction_id')
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
                                <input
                                    class="form-control @error('credit') is-invalid @enderror"
                                    placeholder="credit"
                                    id="credit"
                                    name="credit"
                                    type="text"
                                    value="{{ old('credit', $data->credit) }}"
                                />

                                <label for="credit">credit</label>
                                @error('credit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input
                                    class="form-control @error('debet') is-invalid @enderror"
                                    placeholder="debet"
                                    id="debet"
                                    name="debet"
                                    type="text"
                                    value="{{ old('debet', $data->debet) }}"
                                />

                                <label for="debet">debet</label>
                                @error('debet')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <button type="submit" class="btn btn-success">
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-section>
</x-administrator>
