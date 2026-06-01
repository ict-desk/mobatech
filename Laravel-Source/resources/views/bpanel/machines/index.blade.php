@extends('adminlte::page')

@section('title', 'Machines in aanbod')

@section('content_header')
    <h1>Machines in aanbod</h1>
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

        <table id="machines-table"
               class="table table-bordered table-striped mb-0">

            <thead>

                <tr>

                    <th width="40">Aanbod</th>
                    <th width="170">Titel</th>
                    <th width="80">Merk</th>
                    <th width="80">Categorie</th>
                    <th width="80">Bouwjaar</th>
                    <th width="170">Status</th>

                    <th width="170">
                        Acties
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($machines as $machine)

                    <tr>

                        <td>

                            @if($machine->is_active)
                                <i class="fas fa-eye"></i>
                            @endif

                            @if($machine->is_featured)
                                <i class="fas fa-star"></i>
                            @endif

                        </td>

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

</div>

@stop

@section('css')

    <link rel="stylesheet"
          href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap4.min.css">

@stop

@section('js')

    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap4.min.js"></script>

    <script>

        $(function () {

            $('#machines-table').DataTable({

                paging: true,
                searching: false,
                ordering: true,
                info: true,
                autoWidth: false,
                responsive: true,
                pageLength: 25,

                order: [[1, 'asc']],
             
                columnDefs: [

                    {
                        orderable: false,
                        targets: [0, 6]
                    }

                ],

                language: {

                    lengthMenu: "_MENU_ per pagina",
                    zeroRecords: "Geen resultaten gevonden",
                    info: "Pagina _PAGE_ van _PAGES_",
                    infoEmpty: "Geen resultaten beschikbaar",
                    infoFiltered: "(gefilterd uit _MAX_ totaal records)",
                    paginate: {
                        first: "Eerste",
                        last: "Laatste",
                        next: "Volgende",
                        previous: "Vorige"
                    }

                }

            });

        });

    </script>

@stop