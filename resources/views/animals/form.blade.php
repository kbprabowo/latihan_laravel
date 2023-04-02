@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        @if ($errors->any())
          {!! implode('', $errors->all('<div class="alert alert-warning">:message</div>')) !!}
        @endif
        <div class="card">
          <div class="card-header">{{ __('Edit') }}</div>

          <div class="card-body">
            <h1>Edit Data Animal</h1>
            <form action="{{ $animal->id ? '/animals/' . $animal->id : '/animals' }}" method="POST">
              @if ($animal->id)
                @method('put')
              @endif
              @csrf
              <div class="mb-3">
                <label for="name" class="form-label">Masukan nama hewan</label>
                <input type="text" class="form-control" name="name" value="{{ $animal->name }}">
              </div>
              <label class="form-check-label">
                Jenis Hewan
              </label><br>

              <select name="characteristic_id" class="form-select" aria-label="Default select example">
                <option value="0">Pilih karakter hewannya</option>
                @foreach ($characteristics as $characteristic)
                  <option value="{{ $characteristic->id }}" @if ($characteristic->id == $animal->characteristic_id) selected="selected" @endif>
                    {{ $characteristic->name }}
                  </option>
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
