<table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
    @isset($header)
        <thead class="bg-indigo-600">
            <tr>
                <th scope="col" style="width: 10px;">
                    <div class="form-check">
                        <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                    </div>
                </th>
                {{ $header }}
            </tr>
        </thead>
    @endisset

    @isset($body)
        <tbody>
            <tr>
                <td scope="row">
                    <div class="form-check">
                        <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                    </div>
                </td>
                {{ $body }}
            </tr>
        </tbody>
    @endisset

    @isset($footer)
        <tfoot>
            {{ $footer }}
        </tfoot>
    @endisset
</table>

@push('styles')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="/assets/admin/js/pages/datatables.init.js"></script>
    <!-- App js -->
@endpush
