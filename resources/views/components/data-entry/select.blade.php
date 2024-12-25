<div>
    <label for="{{ $name }}">{{ __($label) }}</label>
    <select id="{{ $name }}" name="{{ $name }}" class="form-control js-example-basic-single"
        style="width: 100%;">
        <option value="">{{ $placeholder }}</option>
        @foreach ($options as $key => $value)
            <option value="{{ $key }}" {{ $key == $selected ? 'selected' : '' }}>
                {{ $value }}
            </option>
        @endforeach
    </select>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endpush
