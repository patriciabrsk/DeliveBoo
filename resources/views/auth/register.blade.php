@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" id="form">
                        @csrf

                        <div class="form-group row mb-2">
                            <label for="name_restaurant" class="col-md-4 col-form-label text-md-right">{{ __('Nome
                                Ristorante*')
                                }}</label>

                            <div class="col-md-6">
                                <input id="name_restaurant" type="text"
                                    class="form-control @error('name_restaurant') is-invalid @enderror"
                                    name="name_restaurant" value="{{ old('name_restaurant') }}" required
                                    autocomplete="name_restaurant" autofocus>

                                @error('name_restaurant')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail*')
                                }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password*')
                                }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm
                                Password*') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>


                        {{-- Custom field --}}
                        <div class="form-group row mb-2">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo*')
                                }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text"
                                    class="form-control @error('address') is-invalid @enderror" name="address"
                                    value="{{ old('address') }}" required autocomplete="address" autofocus>

                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <label for="vat_number" class="col-md-4 col-form-label text-md-right">{{ __('Partita Iva*')
                                }}</label>

                            <div class="col-md-6">
                                <input id="vat_number" type="text"
                                    class="form-control @error('vat_number') is-invalid @enderror" name="vat_number"
                                    value="{{ old('vat_number') }}" required autocomplete="vat_number" autofocus
                                    minlength="11" maxlength="11">

                                @error('vat_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <label for="image_url" class="col-md-4 col-form-label text-md-right">{{ __('Immagine
                                profilo*')
                                }}</label>

                            <div class="col-md-6">
                                <input id="image_url" type="file"
                                    class="form-control @error('image_url') is-invalid @enderror" name="image_url"
                                    required autofocus>

                                @error('image_url')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <span class="col-md-5 col-form-label text-md-right">Categorie*</span>
                            @error('categories')
                            <span class="invalid-feedback" role="alert">
                                <strong>At least one category has to be checked</strong>
                            </span>
                            @enderror
                            <div class="categorie col-md-6 ml-2 d-flex flex-wrap ">

                                @foreach ($types as $type)
                                <div class="col-6">
                                    <input class="custom-control-input @error('types') is-invalid @enderror"
                                        name="types[]" type="checkbox" value="{{$type->id}}" id="type-{{$type->id}}">
                                    <label class="custom-control-label" for="type-{{$type->id}}">
                                        {{$type->name_type}}
                                    </label>
                                    @if ($loop->last)
                                    <span class="invalid-feedback" role="alert">
                                        <strong>At least one category has to be checked</strong>
                                    </span>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button {{-- type="submit" --}} class="btn btn-primary" id="btn-submit">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function checkLength(param, length = 1, max = false) {

        if (max) {
            return param.length == length
        } else {
            return param.length >= length
        }
    }

    document.getElementById('btn-submit').addEventListener('click', (event) => {
        const form = document.getElementById('form')

        const inputs = form.elements;
        const errors = [];

        if (!checkLength(inputs.name_restaurant.value.trim())) {
            errors.push('Il nome del ristorante è obbligatorio')
        }

        if (!checkLength(inputs.address.value.trim())) {
            errors.push('L\'indirizzo è obbligatorio')
        }

        if (!checkLength(inputs.password.value.trim(), 8)) {
            errors.push('La password è obbligatorio e deve essere almeno 8 caratteri')
        }

        if (!checkLength(inputs.password_confimration.value.trim(), 8)) {
            errors.push('La password va confermata')
        }

        if (!checkLength(inputs.vat_number.value.trim(), 11, true)) {
            errors.push('La Partita Iva è obbligatoria e di 11 caratteri')
        }

        // if(!elements.email.match(/^(([^<>()[]\.,;:\s@"]+(.[^<>()[]\.,;:\s@"]+)*)|(".+"))@(([[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}])|(([a-zA-Z-0-9]+.)+[a-zA-Z]{2,}))$/)) {
        //     errors.push('La mail è obbligatoria e deve essere una mail fatta bene dio santo')
        // }

        console.error(errors)
    })
</script>
@endsection
