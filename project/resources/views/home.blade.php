@extends('layouts.app')
@section('title', 'Dados da loja')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Dados da loja</h5>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 d-flex align-items-center text-center">
                                <h5>Visitas ao cardápio: <strong>{{ $singletonStore->visits_count }}</strong></h5>
                            </div>

                            <div class="col-12 col-md-4 d-flex align-items-center text-center">
                                <qrcode url="{{ config('app.url') }}"></qrcode>
                            </div>
                            <div class="col-12 col-md-4 d-flex align-items-center text-center mt-md-0 mt5">
                                <whatsapp update-url="{{ route('whatsapp.update') }}"
                                          whats="{{ $singletonStore->whatsapp }}"></whatsapp>
                            </div>

                            <div class="col-12 col-md-4">
                                <form action="{{ route('banner.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="banner">Banner</label>
                                        <div class="custom-file ">
                                            <input
                                                    name="banner"
                                                    type="file" accept="image/*"
                                                    id="banner"
                                                    class="custom-file-input"
                                                    onchange="form.submit()"
                                                    required>
                                            <label for="image" class="custom-file-label">Selecionar imagem</label>
                                        </div>
                                    </div>
                                </form>

                                @if(store()->banner)
                                    <img src="{{ route('store.banner') }}" alt="" class="img-thumbnail">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
