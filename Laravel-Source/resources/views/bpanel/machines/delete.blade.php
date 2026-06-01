@extends('adminlte::page')

@section('title', 'Machine verwijderen')

@section('content_header')
    <h1>Machine verwijderen</h1>
@endsection

@section('content')

    <div class="card card-danger">

        <div class="card-header">
            <h3 class="card-title">
                Weet je het zeker?
            </h3>
        </div>

        <div class="card-body">

            <p>
                Je staat op het punt om deze machine te verwijderen:
            </p>

            <p>
                <strong>
                    {{ $machine->title }}
                </strong>
            </p>

            <p class="mb-0">
                Deze actie kan niet ongedaan worden gemaakt.
            </p>

        </div>

        <div class="card-footer">

            <form
                method="POST"
                action="{{ route('machines.destroy', $machine) }}"
            >

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="btn btn-danger"
                >
                    Ja, verwijderen
                </button>

                <a
                    href="{{ route('machines.edit', $machine) }}"
                    class="btn btn-secondary"
                >
                    Annuleren
                </a>

            </form>

        </div>

    </div>

@endsection