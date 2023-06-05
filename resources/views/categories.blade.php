<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <title>Categories</title>

    <!-- Styles -->
    <style>
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css"/>

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
</head>
<body>
<div class="alert alert-success collapse" role="alert" id="alertSuccess">
    This is a success alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
</div>
<table id="myTable" class="table">
    <thead>
    <tr>
        <th scope="col">
            <button type="button" id="newCategoryButton" class="btn btn-secondary btn-sm">New</button>
        </th>
        <th scope="col">Name</th>
        <th scope="col">Created at</th>
        <th scope="col">Updated at</th>
    </tr>
    </thead>
    <tbody>
    {{--    @foreach($categories as $category)--}}
    {{--        <tr>--}}
    {{--            <th scope="row">--}}
    {{--                <button type="button" class="btn btn-secondary btn-sm"--}}
    {{--                        onclick="myShowModal({{$category->id}})">{{$category->id}}</button>--}}
    {{--            </th>--}}
    {{--            <td>{{$category->name}}</td>--}}
    {{--            <td>{{$category->created_at}}</td>--}}
    {{--            <td>{{$category->updated_at}}</td>--}}
    {{--        </tr>--}}
    {{--    @endforeach--}}
    </tbody>
</table>
<!-- Modal for create-->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label for="inputCreateCategoryName" id="inputCreateCategoryId">Name:</label>
                <input id="inputCreateCategoryName" name="categoryName" type="text"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="button" id="saveChangesCreateCategoryButton" class="btn btn-primary btn-sm">Save changes
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal for edit-->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label for="inputEditCategoryName" id="inputEditCategoryId"></label>
                <input id="inputEditCategoryName" name="categoryName" type="text"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="button" id="saveChangesEditCategoryButton" class="btn btn-primary btn-sm">Save changes
                </button>
                <button type="button" id="deleteCategoryButton"
                        class="btn btn-danger btn-sm" data-id="">Delete
                </button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script defer>
    function showCreateModal() {
        $("#createModal").modal();
    }

    function showEditModal(categoryId) {
        let url = '{{route('api.category.show', '')}}' + '/' + categoryId;
        $('#deleteCategoryButton').val(categoryId);
        $.ajax({
            method: "get",
            url: url,
            success: function (response) {
                $("#inputEditCategoryId").text(response.id).val(response.id);
                $("#inputEditCategoryName").val(response.name);
                $("#editModal").modal();
            }
        });
    }

    // $(document).ready(function () {
    let table = loadTable();
    {{--//table.data = load();--}}
    {{--// $.ajaxSetup({--}}
    {{--//     // headers: {--}}
    {{--//     //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
    {{--//     // }--}}
    {{--// });--}}

    $('#deleteCategoryButton').click(function () {
        let id = $("#inputEditCategoryId").val();
        $.ajax({
            method: "delete",
            url: '{{route('api.category.destroy', '')}}' + '/' + id,
            dataType: 'json',
            success: function (data) {
                $("#editModal").modal('hide');
                $("#alertSuccess").text(id + ' category successfully deleted')
                    .fadeIn(300).delay(2000).fadeOut(400);
                table.ajax.reload();
                console.log(data);
            }
        });
    });

    $('#saveChangesEditCategoryButton').click(function () {
        let id = $("#inputEditCategoryId").val();
        $.ajax({
            method: "patch",
            url: '{{route('api.category.update', '')}}' + '/' + id,
            dataType: 'json',
            data: {
                'name': $("#inputEditCategoryName").val()
            },
            success: function (data) {
                $("#editModal").modal('hide');
                $("#alertSuccess").text(id + ' category successfully updated')
                    .fadeIn(300).delay(2000).fadeOut(400);
                table.ajax.reload();
                console.log(data);
            }
        });
    });

    $('#newCategoryButton').click(function () {
        showCreateModal();
    });

    $('#saveChangesCreateCategoryButton').click(function () {
        $("#createModal").modal('hide');
        $.ajax({
            method: "post",
            url: '{{route('api.category.store')}}',
            dataType: 'json',
            data: {
                'name': $("#inputCreateCategoryName").val()
            },
            success: function (data) {
                $("#alertSuccess").text('New category successfully created')
                    .fadeIn(300).delay(2000).fadeOut(400);
                table.ajax.reload();
                console.log(data);
            }
        });
    });
    // $('body').on('click', '#deleteCategoryButton', function () {
    // }).on('click', '#saveChangesEditCategoryButton', function () {
    // }).on('click','#newCategoryButton', function () {
    // }).on('click', '#saveChangesCreateCategoryButton', function () {
    // });
    //});

    function loadTable() {
        return $('#myTable').DataTable({
            ajax: {
                url: "{{route('api.category.index.wrapped')}}",
                dataSrc: 'data'
            },
            stateSave: true,
            columns: [
                {
                    data: 'id',
                    render: function (data, type, row) {
                        return '<button type="button" class="btn btn-secondary btn-sm"\n' +
                            `onclick="showEditModal(${data})">` + data + '</button>';
                    }
                },
                {data: 'name'},
                {data: 'created_at'},
                {data: 'updated_at'}
            ],
            columnDefs: [{
                targets: [2, 3],
                render: function (data, type, row) {
                    return moment(data).format('YYYY/MM/DD/HH:mm:ss');
                }
            }],
            "aaSorting": [[0, 'desc']]
        });
    }

    {{--function doo(){--}}
    {{--    fetch('{{route('api.category.destroy', '')}}' + '/' + '12',  {--}}
    {{--        method: 'DELETE'--}}
    {{--    });--}}
    {{--    window.table.ajax.reload();--}}
    {{--}--}}

</script>
