@extends('adminlte::page')

@section('title', 'Machines')

@section('content_header')
    <h1>Machines</h1>
@stop

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <form method="GET"
              action="{{ route('machines.index') }}">

            <div class="input-group"
                 style="max-width: 400px;">

                <input type="text"
                       name="search"
                       class="form-control"
                       placeholder="Zoeken op titel, merk of categorie"
                       value="{{ $search }}">

                <div class="input-group-append">

                    <button class="btn btn-primary"
                            type="submit">

                        <i class="fas fa-search text-white"></i>

                    </button>

                    <a href="{{ route('machines.index') }}"
                       class="btn btn-secondary">

                        <i class="fas fa-times text-white"></i>

                    </a>

                </div>

            </div>

        </form>

        <a href="/bpanel/machines/create"
           class="btn btn-success">

            <i class="fas fa-plus text-white"></i>

            Voeg machine toe

        </a>

    </div>

    <div class="card-body table-responsive p-0">

        <table class="table table-bordered table-striped mb-0">

            <thead>

                <tr>

                    <th>ID</th>
                    <th>Titel</th>
                    <th>Merk</th>
                    <th>Categorie</th>
                    <th>Bouwjaar</th>
                    <th>Status</th>

                    <th width="170">
                        Acties
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($machines as $machine)

                    <tr>

                        <td>{{ $machine->id }}</td>

                        <td>{{ $machine->title }}</td>

                        <td>{{ $machine->brand }}</td>

                        <td>{{ $machine->category }}</td>

                        <td>{{ $machine->year }}</td>

                        <td>{{ $machine->stock_status }}</td>

                        <td>

                            <div class="btn-group">

                                <a href="/bpanel/machines/{{ $machine->id }}/edit"
                                   class="btn btn-sm btn-primary">

                                    <i class="fas fa-pen text-white"></i>

                                </a>

                                <a href="/bpanel/machines/{{ $machine->id }}/copy"
                                   class="btn btn-sm btn-warning">

                                    <i class="fas fa-copy text-white"></i>

                                </a>

                                <a href="/bpanel/machines/{{ $machine->id }}/delete"
                                   class="btn btn-sm btn-danger">

                                    <i class="fas fa-trash text-white"></i>

                                </a>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7"
                            class="text-center">

                            Geen machines gevonden

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="card-footer">

        {{ $machines->links() }}

    </div>

</div>

@stop