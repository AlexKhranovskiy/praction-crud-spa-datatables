<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <title></title>

    <!-- Styles -->
    <style>
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<!-- Modal for login-->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Authentication</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="staticEmail" value="user@example.com">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPassword" value="password">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="loginButton" class="btn btn-primary btn-sm">Login</button>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<div class="container-sm">
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div id="screen" class="col-12 col-md-8 col-lg-6 col-xl-5" style="display:none">
                    <button type="button" class="btn btn-secondary btn-sm" id="logoutButton">Logout</button>
                    <table id="myTable" class="table">
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
{{--<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>--}}
{{--<script>--}}
{{--    let dataSet = [--}}
{{--        [1, 'Tiger Nixon', '2011/04/25', '2011/04/25'],--}}
{{--        [2, 'Garrett Winters', '2011/07/25', '2011/07/25'],--}}
{{--    ];--}}


{{--    $(document).ready(function () {--}}
{{--        $('#myTable').DataTable({--}}
{{--            data: [--}}
{{--                {"id": 1, "name": "Tiger Nixon", "created_at": "2011/04/25", "updated_at": "2011/04/25"}--}}
{{--            ],--}}
{{--            columnDefs: [{--}}
{{--                "defaultContent": "-",--}}
{{--                "targets": "_all"--}}
{{--            }],--}}
{{--            columns: [--}}
{{--                {data: 'id'},--}}
{{--                {data: 'name'},--}}
{{--                {data: 'created_at'},--}}
{{--                {data: 'updated_at'}--}}
{{--            ],--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}
</body>
</html>
