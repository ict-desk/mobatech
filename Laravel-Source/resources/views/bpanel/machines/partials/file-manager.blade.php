<div class="btn-toolbar mb-3" role="toolbar">

    <div class="btn-group btn-group-sm" role="group">

        @include('bpanel.machines.partials.file-upload')

        <a href="{{ route('machines.edit', $machine) }}?tab=files&refresh={{ time() }}#tab-files"
           class="btn btn-secondary btn-sm"
           title="Vernieuwen">

            <i class="fas fa-sync-alt"></i>

        </a>

    </div>

</div>

@if(count($folderFiles) === 0)

    <div class="alert alert-warning">
        Geen bestanden gevonden in productmap.
    </div>

@else

    <div class="d-flex flex-wrap" style="overflow: visible;">

        @foreach($folderFiles as $file)

            @php

                $extension = strtolower(
                    pathinfo($file, PATHINFO_EXTENSION)
                );

                $isImage = in_array($extension, [
                    'jpg',
                    'jpeg',
                    'png',
                    'webp',
                    'gif',
                ]);

                $publicUrl = url('storage/' . $file);

            @endphp

            <div class="card mr-2 mb-2 position-relative"
                 style="width: 140px; overflow: visible;">

                <div class="dropdown position-absolute"
                     style="top: 5px; right: 5px; z-index: 10;">

                    <button class="btn btn-sm btn-dark"
                            type="button"
                            data-toggle="dropdown"
                            title="Acties"
                            style="padding: 2px 6px; line-height: 1;">

                        <i class="fas fa-ellipsis-h"></i>

                    </button>

                    <div class="dropdown-menu dropdown-menu-right"
                         style="
                            font-size: 12px;
                            min-width: 160px;
                            z-index: 99999;
                         ">

                        <a href="#"
                            class="dropdown-item"
                            onclick="
                                    event.preventDefault();

                                    let newName = prompt(
                                        'Nieuwe bestandsnaam:',
                                        '{{ pathinfo(basename($file), PATHINFO_FILENAME) }}'
                                    );

                                    if (newName && newName.trim() !== '') {
                                        window.location.href =
                                            '{{ route('machines.files.rename.get', ['machine' => $machine]) }}'
                                            + '?old_file={{ urlencode(basename($file)) }}'
                                            + '&new_file=' + encodeURIComponent(newName);
                                    }
                            ">

                                <i class="fas fa-edit mr-2"></i>

                                Hernoemen

                            </a>

                        <a href="#"
                           class="dropdown-item"
                           onclick="navigator.clipboard.writeText('{{ $publicUrl }}')">

                            <i class="fas fa-link mr-2"></i>

                            Kopieer link

                        </a>

                        @if($isImage)

                            <a href="{{ route('machines.files.setmainimage.get', [
                                    'machine' => $machine,
                                    'file' => basename($file),
                                ]) }}"
                               class="dropdown-item"
                               onclick="return confirm('Als hoofdafbeelding instellen?')">

                                <i class="fas fa-image mr-2"></i>

                                Hoofdafbeelding maken

                            </a>

                        @endif

                        <div class="dropdown-divider"></div>

                        <a href="{{ route('machines.files.delete.get', [
                                'machine' => $machine,
                                'file' => basename($file),
                            ]) }}"
                           class="dropdown-item text-danger"
                           onclick="return confirm('Bestand verwijderen?')">

                            <i class="fas fa-trash mr-2"></i>

                            Verwijderen

                        </a>

                    </div>

                </div>

                @if($isImage)

                    <a href="{{ asset('storage/' . $file) }}"
                       target="_blank"
                       title="Bekijken">

                        <img src="{{ asset('storage/' . $file) }}"
                             class="card-img-top"
                             style="height: 100px; object-fit: cover;">

                    </a>

                @else

                    <div class="d-flex align-items-center justify-content-center"
                         style="height: 100px; font-size: 40px;">

                        <a href="{{ asset('storage/' . $file) }}"
                           target="_blank"
                           title="Bekijken">

                            <i class="fas fa-file"></i>

                        </a>

                    </div>

                @endif

                <div class="card-body p-2">

                    <small style="word-break: break-word; font-size: 11px;">

                        {{ basename($file) }}

                    </small>

                </div>

            </div>

        @endforeach

    </div>

@endif