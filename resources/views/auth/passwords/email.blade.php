@extends('welcome')

@section('content')
 
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card"> 
                <div class="card-body">
                    <h3><div class="panel-title" style="text-align: center; color:black;">{{ __('Reestablecer contraseña') }}</div></h3> 
                    <br>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div> 
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo al que se enviará te enviará un correo para reestablecer su contraseña') }}</label>
                             
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn bg-happy-green">
                                     {{ __('Enviar Correo') }} 
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
 
@endsection
