@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
{{-- <h6 class="fw-semibold">Basic Select</h6>
<select class="js-example-basic-single" name="state">
    <option value="AL">Alabama</option>
    <option value="MA">Madrid</option>
    <option value="TO">Toronto</option>
    <option value="LO">Londan</option>
    <option value="WY">Wyoming</option>
</select> --}}
<select class="js-example-basic-multiple" name="states[]" multiple="multiple">
    <optgroup label="UK">
        <option value="London">London</option>
        <option value="Manchester" selected>Manchester</option>
        <option value="Liverpool">Liverpool</option>
    </optgroup>
    <optgroup label="FR">
        <option value="Paris">Paris</option>
        <option value="Lyon">Lyon</option>
        <option value="Marseille">Marseille</option>
    </optgroup>
    <optgroup label="SP">
        <option value="Madrid" selected>Madrid</option>
        <option value="Barcelona">Barcelona</option>
        <option value="Malaga">Malaga</option>
    </optgroup>
    <optgroup label="CA">
        <option value="Montreal">Montreal</option>
        <option value="Toronto">Toronto</option>
        <option value="Vancouver">Vancouver</option>
    </optgroup>
</select>
@push('scripts')
    <!--select2 cdn-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="/assets/admin/js/pages/select2.init.js"></script>
@endpush
