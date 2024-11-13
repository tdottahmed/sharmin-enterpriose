@props([
    'action' => '',
    'method' => 'POST',
    'model' => null,
    'fields' => [],
])
@php
    $method = $model ? 'PATCH' : $method;
@endphp

<form action="{{ $action }}" method="POST">
    @csrf
    @if ($model)
        @method('PATCH')
    @endif
    {{-- <!-- Dynamically generate fields -->
    @foreach ($fields as $field)
        <x-input 
            :name="$field['name']" 
            :label="$field['label']" 
            :value="$field['value'] ?? ''" 
            :type="$field['type'] ?? 'text'" 
            :options="$field['options'] ?? []" 
            :required="$field['required'] ?? false" 
        />
    @endforeach --}}
    {{ $slot }}

    <!-- Submit Button -->
    <div class="d-flex justify-content-end">
        <x-action.button variant="primary">
            {{ $model ? 'Update' : 'Submit' }}
        </x-action.button>
    </div>
</form>
