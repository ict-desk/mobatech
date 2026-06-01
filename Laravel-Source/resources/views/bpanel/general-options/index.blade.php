@extends('adminlte::page')

@section('title', 'Opties - overzicht')

@section('content_header')
    <h1>{{ ucfirst(str_replace('_', ' ', $option_name)) }} - overzicht</h1>
@stop

@section('content')

    <a href="{{ route('general-options.create', $option_name) }}"
       class="btn btn-success mb-3">
        Nieuw item toevoegen
    </a>

    <div class="card" style="max-width: 950px;">

        <div class="card-body">

            <table class="table table-bordered table-striped table-sm">

                <thead>
                    <tr>
                        <th>Titel</th>
                        <th>Waarde</th>
                        <th>Omschrijving</th>
                        <th>Label tekst</th>
                        <th class="text-center">Active</th>
                        <th class="text-center">Excluded</th>
                        <th class="text-center">Default</th>
                        <th class="text-center">Acties</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($options as $option)

                        <tr>
                            <td>{{ $option->title }}</td>

                            <td>{{ $option->value }}</td>

                            <td>{{ $option->description }}</td>

                            <td>{{ $option->lbl_text }}</td>

                            <td class="text-center">
                                @if($option->is_active)
                                    ✅
                                @else
                                    ❌
                                @endif
                            </td>

                            <td class="text-center">
                                @if($option->is_excluded)
                                    ✅
                                @else
                                    ❌
                                @endif
                            </td>

                            <td class="text-center">
                                @if($option->is_default)
                                    ✅
                                @else
                                    —
                                @endif
                            </td>

                            <td class="text-center">
                                <div class="btn-group btn-group-sm">

                                    <a href="{{ route('general-options.edit', [
                                            'option_name' => $option_name,
                                            'generalOption' => $option,
                                        ]) }}"
                                       class="btn btn-primary"
                                       title="Bewerken">
                                        <i class="fas fa-pen"></i>
                                    </a>

                                    <a href="{{ route('general-options.delete', [
                                            'option_name' => $option_name,
                                            'generalOption' => $option,
                                        ]) }}"
                                       class="btn btn-danger"
                                       title="Verwijderen"
                                       onclick="return confirm('Item verwijderen?')">
                                        <i class="fas fa-trash"></i>
                                    </a>

                                </div>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="text-center">
                                Geen opties gevonden.
                            </td>
                        </tr>

                    @endforelse
                </tbody>

            </table>

        </div>

    </div>

@stop