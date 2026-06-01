@extends('adminlte::page')

@section('title', 'Machine bewerken')

@section('content_header')
    <h1>Machine bewerken</h1>
@endsection

@section('content')

    <form method="POST" action="{{ route('machines.update', $machine) }}">
        @csrf
        @method('PUT')

        <div class="card card-primary card-outline card-outline-tabs">

            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="machine-tabs" role="tablist">

                    <li class="nav-item">
                        <a class="nav-link active" id="tab-general-tab" data-toggle="pill" href="#tab-general" role="tab">
                            Algemeen
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="tab-filess-tab" data-toggle="pill" href="#tab-filess" role="tab">
                            Bestanden
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="tab-extra-tab" data-toggle="pill" href="#tab-extra" role="tab">
                            Extra informatie
                        </a>
                    </li>

                </ul>
            </div>

            <div class="card-body">
                <div class="tab-content" id="machine-tabs-content">

                    <div class="tab-pane fade show active" id="tab-general" role="tabpanel">
                        <div class="row">

                            <div class="col-md-8">

                                <div class="form-group">
                                    <label for="title">Titel</label>
                                    <input
                                        type="text"
                                        name="title"
                                        id="title"
                                        class="form-control"
                                        value="{{ old('title', $machine->title) }}"
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="product_code">Productcode</label>
                                    <input
                                        type="text"
                                        name="product_code"
                                        id="product_code"
                                        class="form-control"
                                        value="{{ old('product_code', $machine->product_code) }}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label for="short_description">Korte omschrijving</label>
                                    <textarea
                                        name="short_description"
                                        id="short_description"
                                        class="form-control"
                                        rows="3"
                                    >{{ old('short_description', $machine->short_description) }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="description">Omschrijving</label>
                                    <textarea
                                        name="description"
                                        id="description"
                                        class="form-control"
                                        rows="10"
                                    >{{ old('description', $machine->description) }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="extra_info">Extra informatie</label>
                                    <textarea
                                        name="extra_info"
                                        id="extra_info"
                                        class="form-control"
                                        rows="10"
                                    >{{ old('extra_info', $machine->extra_info) }}</textarea>
                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group">
                                    <label for="brand">Merk</label>
                                    <select name="brand" id="brand" class="form-control">
                                        <option value="">Kies merk</option>

                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->value }}"
                                                @selected(old('brand', $machine->brand) === $brand->value)>
                                                {{ $brand->lbl_text ?: $brand->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="category">Categorie</label>
                                    <select name="category" id="category" class="form-control">
                                        <option value="">Kies categorie</option>

                                        @foreach($categories as $category)
                                            <option value="{{ $category->value }}"
                                                @selected(old('category', $machine->category) === $category->value)>
                                                {{ $category->lbl_text ?: $category->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="condition">Conditie</label>
                                    <select name="condition" id="condition" class="form-control">
                                        <option value="">Kies conditie</option>

                                        @foreach($conditions as $condition)
                                            <option value="{{ $condition->value }}"
                                                @selected(old('condition', $machine->condition) === $condition->value)>
                                                {{ $condition->lbl_text ?: $condition->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="material">Geschikt voor</label>
                                    <select name="material" id="material" class="form-control">
                                        <option value="">Kies materiaal</option>

                                        @foreach($materials as $material)
                                            <option value="{{ $material->value }}"
                                                @selected(old('material', $machine->material) === $material->value)>
                                                {{ $material->lbl_text ?: $material->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="year">Bouwjaar</label>
                                    <select name="year"
                                            id="year"
                                            class="form-control">

                                        <option value="">Kies bouwjaar</option>

                                        @foreach($years as $year)

                                            <option value="{{ $year->value }}"
                                                @selected(old('year', $machine->year) === $year->value)>

                                                {{ $year->lbl_text ?: $year->title }}

                                            </option>

                                        @endforeach

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="stock_status">Voorraadstatus</label>
                                    <select name="stock_status" id="stock_status" class="form-control">
                                        <option value="">Kies voorraadstatus</option>

                                        @foreach($stockStatuses as $stockStatus)
                                            <option value="{{ $stockStatus->value }}"
                                                @selected(old('stock_status', $machine->stock_status) === $stockStatus->value)>
                                                {{ $stockStatus->lbl_text ?: $stockStatus->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <hr>

                                <div class="form-check mb-2">
                                    <input
                                        type="checkbox"
                                        name="is_active"
                                        id="is_active"
                                        class="form-check-input"
                                        value="1"
                                        {{ old('is_active', $machine->is_active) ? 'checked' : '' }}
                                    >
                                    <label for="is_active" class="form-check-label font-weight-bold">
                                        Zichtbaar in aanbod
                                    </label>
                                </div>

                                <div class="form-check mb-4">
                                    <input
                                        type="checkbox"
                                        name="is_featured"
                                        id="is_featured"
                                        class="form-check-input"
                                        value="1"
                                        {{ old('is_featured', $machine->is_featured ?? false) ? 'checked' : '' }}
                                    >
                                    <label for="is_featured" class="form-check-label font-weight-bold">
                                        Als Uitgelicht aanbod
                                    </label>
                                </div>

                            </div>

                        </div>
                    </div>

                   <div class="tab-pane fade" id="tab-filess" role="tabpanel">

                        @if(strtolower(trim($machine->product_code)) !== 'geen')

                          @include('bpanel.machines.partials.file-manager') 
                        

                        @else

                            <div class="alert alert-warning">
                                Sorry, kan geen Bestanden toevoegen zonder productcode.
                            </div>

                        @endif

                    </div>

                    <div class="tab-pane fade" id="tab-extra" role="tabpanel">
                        <div class="alert alert-info">
                            Extra beheer komt later.
                        </div>
                    </div>

                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    Opslaan
                </button>

                <a href="{{ route('machines.index') }}" class="btn btn-secondary">
                    Terug
                </a>
            </div>

        </div>
    </form>
<form id="machine-file-upload-form"
      method="POST"
      action="{{ route('machines.files.upload', $machine) }}"
      enctype="multipart/form-data">

    @csrf

</form>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.css">
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.js"></script>

    <script>
        $(function () {
            $('#extra_info').summernote({
                height: 300
            });
        });
    </script>
    <script>

    $(function () {

        const hash = window.location.hash;

        if (hash.length > 0) {

            $('.nav-tabs a[href="' + hash + '"]').tab('show');

        }

    });

</script>
@endsection