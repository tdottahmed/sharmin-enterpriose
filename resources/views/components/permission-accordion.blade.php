<div id="permissionsAccordion" class="accordion accordion-flush">
    @foreach ($permissionGroups as $key => $group)
        @php
            $groupId = str($key)->camel();
        @endphp
        <div class="accordion-item material-shadow">
            <h2 class="accordion-header" id="heading-{{ $groupId }}">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapse-{{ $groupId }}" aria-expanded="false"
                    aria-controls="collapse-{{ $groupId }}">
                    {{ $key }}
                </button>
            </h2>
            <div id="collapse-{{ $groupId }}" class="accordion-collapse collapse"
                aria-labelledby="heading-{{ $groupId }}" data-bs-parent="#permissionsAccordion">
                <div class="accordion-body">
                    <div class="form-check mb-2">
                        <input class="form-check-input select-all" type="checkbox" id="selectAll-{{ $groupId }}"
                            data-group="{{ $groupId }}">
                        <label class="form-check-label fw-bold" for="selectAll-{{ $groupId }}">
                            Select All {{ $key }}
                        </label>
                    </div>
                    <div id="permissions-{{ $groupId }}" class="d-flex justify-content-between">
                        @foreach ($group as $permission)
                            <div class="form-check">
                                <input class="form-check-input permission-checkbox" type="checkbox" name="permissions[]"
                                    value="{{ $permission['id'] }}" data-group="{{ $key }}"
                                    id="{{ $key }}-{{ $permission['name'] }}">
                                <label class="form-check-label" for="{{ $key }}-{{ $permission['name'] }}">
                                    {{ $permission['name'] }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.select-all').on('change', function() {
                const group = $(this).data('group');
                $(`.permission-checkbox[data-group="${group}"]`).prop('checked', this.checked);
            });

            // When any permission checkbox is clicked, check if "Select All" should be updated
            $('.permission-checkbox').change(function() {
                const group = $(this).data('group');
                const totalCheckboxes = $(`.permission-checkbox[data-group="${group}"]`).length;
                const checkedCheckboxes = $(`.permission-checkbox[data-group="${group}"]:checked`).length;

                // If all checkboxes are checked, check the "Select All" box, otherwise uncheck it
                if (totalCheckboxes === checkedCheckboxes) {
                    $(`#selectAll-${group}`).prop('checked', true);
                } else {
                    $(`#selectAll-${group}`).prop('checked', false);
                }
            });
        });
    </script>
@endpush
