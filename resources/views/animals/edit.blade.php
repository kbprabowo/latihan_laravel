@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit') }}</div>

                    <div class="card-body">
                        <h1>Edit Data Animal</h1>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="/animals/{{ $animals->id }}" method="POST">
                            @method('put')
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Masukan nama hewan</label>
                                <input type="text" class="form-control" name="name" value="{{ $animals->name }}">
                            </div>
                            <label class="form-check-label">
                                Jenis Hewan
                            </label><br>
                            <select name="characteristic_id" class="form-select" aria-label="Default select example">
                                <option value="0">Pilih karakter hewannya</option>
                                @foreach ($characteristics as $characteristic)
                                    <option @if ($animals->characteristic_id == $characteristic->id) selected @endif
                                        value="{{ $characteristic->id }}">
                                        {{ $characteristic->name }}</option>
                                @endforeach
                            </select><br>
                            <input class="btn btn-primary" type="submit" name="submit" value="save">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
