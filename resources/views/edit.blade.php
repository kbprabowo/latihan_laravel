@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h1>Edit Data Animal</h1>
                        <form action="/{{ $animals->id }}" method="POST">
                            @method('put')
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Masukan nama hewan</label>
                                <input type="text" class="form-control" name="name" value={{ $animals->name }}>
                            </div>
                            <label class="form-check-label">
                                Jenis Hewan
                            </label><br>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="0"
                                    {{ $animals->status == '0' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status">
                                    Buas
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="1"
                                    {{ $animals->status == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status">
                                    jinak
                                </label>
                            </div><br>
                            <input class="btn btn-primary" type="submit" name="submit" value="save">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
