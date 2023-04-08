@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h1>List nama hewan</h1><br>

                        <form class="row g-3" action="/animals" method="GET">
                            <div class="col-auto"><input class="form-control" type="text" name="name"
                                    placeholder="Cari nama hewan ..">
                            </div>
                            <div class="col-auto">
                                <select name="characteristic_id" class="form-select" name="characteristic">
                                    <option value="0">Semua karakter hewan</option>
                                    @foreach ($characteristics as $characteristic)
                                        <option value="{{ $characteristic->id }}">{{ $characteristic->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-auto"><input class="btn btn-secondary" type="submit" value="Search"></div>
                        </form>
                        <a class="btn btn-info float-end" href="/animals/create">Add New Animal</a>
                        {{-- <form action="{{ route('create') }}">
                            <div class="float-end"><input class="btn btn-info" type="submit" value="Add New Animal"></div>
                        </form> --}}
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>karakteristik</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($animals as $animal)
                                    <tr>
                                        <td> {{ $animal->id }} </td>
                                        <td> {{ $animal->name }} </td>
                                        <td> {{ $animal->characteristic->name }} </td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-primary" href="/animals/{{ $animal->id }}/edit">Edit</a>
                                                <form action="/animals/{{ $animal->id }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <input class="btn btn-danger" type="submit" value="Delete">
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $animals->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
