@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Form') }}</div>

                    <div class="card-body">
                        @if ($animals->id)
                            <h1>Edit Data Animal</h1>
                        @else
                            <h1>Add New Animal</h1>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ $animals->id ? route('update', $animals->id) : route('store') }}">
                            @if ($animals->id)
                                @method('put')
                            @endif
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Masukan nama hewan</label>
                                <input type="text" class="form-control" name="name"
                                    @if ($animals->id) value="{{ $animals->name }}"> @else value="{{ old('name') }}"> @endif
                                    </div>

                                <select name="characteristic_id" class="form-select">
                                    <option value="0">Pilih karakter hewannya</option>
                                    @foreach ($characteristics as $characteristic)
                                        <option @if ($animals->characteristic_id == $characteristic->id) selected @endif
                                            value="{{ $characteristic->id }}"
                                            {{ old('characteristic_id', $animals->characteristic_id) == $characteristic->id ? 'selected' : '' }}>
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
