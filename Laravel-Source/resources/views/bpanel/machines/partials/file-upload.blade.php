<label class="btn btn-primary mb-0"
       title="Bestand uploaden">

    <i class="fas fa-upload"></i>

    <input type="file"
           name="file"
           form="machine-file-upload-form"
           class="d-none"
           accept=".jpg,.jpeg,.png,.pdf"
           onchange="document.getElementById('machine-file-upload-form').submit()">

</label>