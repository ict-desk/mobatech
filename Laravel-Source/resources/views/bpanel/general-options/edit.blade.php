@extends('adminlte::page')

@section('title')

    {{ ucfirst(str_replace('_', ' ', $option_name)) }}

@stop

@section('content_header')

    <div class="d-flex justify-content-between align-items-center">

        <h1>

            {{ ucfirst(str_replace('_', ' ', $option_name)) }} beheren

        </h1>

        <a href="{{ route('general-options.index', $option_name) }}"
           class="btn btn-secondary btn-sm">

            Terug

        </a>

    </div>

@stop

@section('content')

    <div class="card" style="max-width: 800px;">

        <div class="card-body">

            <form method="POST"
                  action="{{ route('general-options.update', [
                        'option_name' => $option_name,
                        'generalOption' => $generalOption->id ?? 0,
                  ]) }}">

                @csrf

                <div class="form-group">

                    <label>Titel</label>

                    <input type="text"
                           name="title"
                           class="form-control"
                           value="{{ old('title', $generalOption->title) }}">

                </div>

                <div class="form-group">

                    <label>Waarde</label>

                    <input type="text"
                           name="value"
                           class="form-control"
                           value="{{ old('value', $generalOption->value) }}">

                </div>

                <div class="form-group">

                    <label>Omschrijving</label>

                    <textarea name="description"
                              class="form-control"
                              rows="4">{{ old('description', $generalOption->description) }}</textarea>

                </div>

                @if($generalOption->new ?? false)

                    <input type="hidden"
                           name="is_new"
                           value="1">

                @endif

                <div class="form-group">

                    <label>Label tekst</label>

                    <input type="text"
                           name="lbl_text"
                           class="form-control"
                           value="{{ old('lbl_text', $generalOption->lbl_text) }}">

                </div>

                <div class="form-group">

                    <label>Icoon</label>

                    <select name="icon_image"
                         id="icon_image"
                         class="form-control">

                        @foreach($icons as $icon)

                            <option value="{{ $icon }}"
                                @selected(old('icon_image', $generalOption->icon_image ?? 'icons/default.svg') === $icon)>

                                {{ basename($icon) }}

                            </option>

                        @endforeach

                    </select>

                    <small class="form-text text-muted">
                        Kies een SVG-icoon uit de centrale iconenmap.
                    </small>

                </div>

                <div class="form-group">

                    <label>Huidig icoon</label>

                    <div>
                        <img id="icon_preview"
                                     src="{{ asset('storage/' . ($generalOption->icon_image ?? 'icons/default.svg')) }}"
                                     alt=""
                                    style="width: 48px; height: 48px;">
                    </div>

                </div>

                <hr>

                <div class="form-check mb-2">

                    <input type="checkbox"
                           name="is_active"
                           class="form-check-input"
                           value="1"
                           @checked($generalOption->is_active)>

                    <label class="form-check-label">

                        Actief

                    </label>

                </div>

                <div class="form-check mb-2">

                    <input type="checkbox"
                           name="is_excluded"
                           class="form-check-input"
                           value="1"
                           @checked($generalOption->is_excluded)>

                    <label class="form-check-label">

                        Excluded

                    </label>

                </div>

                <div class="form-check mb-4">

                    <input type="checkbox"
                           name="is_default"
                           class="form-check-input"
                           value="1"
                           @checked($generalOption->is_default)>

                    <label class="form-check-label">

                        Default

                    </label>

                </div>

                <button type="submit"
                        class="btn btn-primary">

                    Opslaan

                </button>

                <a href="{{ route('general-options.index', $option_name) }}"
                   class="btn btn-secondary">

                    Annuleren

                </a>

            </form>

        </div>

    </div>

        </div>

    </div>

@stop

@section('js')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const select = document.getElementById('icon_image');
    const preview = document.getElementById('icon_preview');

    if (!select || !preview) {
        return;
    }

    select.addEventListener('change', function () {

        preview.src = '/storage/' + this.value;

    });

});

</script>

@stop