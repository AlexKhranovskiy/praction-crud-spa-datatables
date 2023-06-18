import './bootstrap';

import DataTable from 'datatables.net-dt';

// Make a request for a user with a given ID
// axios.get('/api/user')
//     .then(function (response) {
//         // handle success
//         alert('rr');
//         console.log(response);
//     })
//     .catch(function (error) {
//         // handle error
//         $("#loginModal").modal('show');
//         console.log(error);
//     })
//     .finally(function () {
//         // always executed
//     });

$(document).ready(function () {

    let getCookie = function get_cookie(name) {
        return document.cookie.split(';').some(c => {
            return c.trim().startsWith(name + '=');
        });
    };

    function delete_cookie(name, path, domain) {
        if (getCookie(name)) {
            document.cookie = name + "=" +
                ((path) ? ";path=" + path : "") +
                ((domain) ? ";domain=" + domain : "") +
                ";expires=Thu, 01 Jan 1970 00:00:01 GMT" +
                ";SameSite=Lax";
        }
    }

    // const BASE_URL = 'http://localhost:8000/api/v1/categories';
    // const getCategories = async () => {
    //     try {
    //         const response = await axios.get(`${BASE_URL}`);
    //         const tableData = response.data;
    //         console.log(`GET: Here's categories data`, tableData);
    //         return tableData;
    //     } catch (errors) {
    //         console.error(errors);
    //     }
    // };

    $.ajaxSetup({
        headers: {
            'X-XSRF-TOKEN': getCookie('XSRF-TOKEN')
        }
    });

    const loadTable = function () {
        return new DataTable('#myTable', {
            ajax: {
                url: "/api/v1/categories",
                dataSrc: 'data',
                error: function (xhr, error, code) {
                    console.log(xhr, code);
                    $("#loginModal").modal('show');
                    window.table.destroy();
                    $('#screen').hide();
                },
            },
            stateSave: true,
            columns: [
                {
                    title: 'Id',
                    data: 'id',
                    render: function (data, type, row) {
                        return '<button type="button" class="btn btn-secondary btn-sm"\n' +
                            `onclick="showEditModal(${data})">` + data + '</button>';
                    }
                },
                {
                    title: 'Name',
                    data: 'name'
                },
                {
                    title: 'Created at',
                    data: 'created_at'
                },
                {
                    title: 'Updated at',
                    data: 'updated_at'
                }
            ],
        });
    };

    $("#newCategoryButton").click(function () {
        $("#createModal").modal('show');
    });

    console.log(document.cookie);
    $("#loginButton").click(function () {
        axios.all([axios.get('/sanctum/csrf-cookie'),
            axios.post('/api/v1/login', {
                'email': $('#staticEmail').val(),
                'password': $('#inputPassword').val()
            })])
            .then(axios.spread((firstResponse, secondResponse) => {
                console.log(firstResponse.config.headers, secondResponse);
                if (secondResponse.status === 200) {
                    console.log(document.cookie);
                    $('#screen').show();
                    window.table = loadTable();

                    $("#loginModal").modal('hide');
                } else {
                    $("#loginModal").modal('show');
                }
            }))
            .catch(error => console.log(error));
    });
    $("#logoutButton").click(function () {
        axios.get('/api/v1/logout')
            .then(function (response) {
                // handle success
                console.log(response);
                $("#loginModal").modal('show');
                window.table.destroy();
                $('#screen').hide();
            });

        delete_cookie('XSRF-TOKEN', '/', '');
        console.log(document.cookie);
    });

    $("#saveChangesCreateCategoryButton").click(function () {
        axios.post('/api/v1/categories', {
            'name': $('#inputCreateCategoryName').val()
        }).then(function (response) {
            // handle success
            console.log(response);
            $("#createModal").modal('hide');
            window.table.ajax.reload();
        }).catch(error => {
            console.log(error);
            window.table.destroy();
            $("#createModal").modal('hide');
            window.table = loadTable();
        });
    });

    $("#saveChangesEditCategoryButton").click(function () {
        let id = $('#inputEditCategoryId').val();
        axios.patch('/api/v1/categories/' + id, {
            'name': $('#inputEditCategoryName').val()
        }).then(function (response) {
            // handle success
            console.log(response);
            $("#editModal").modal('hide');
            window.table.ajax.reload();
        }).catch(error => {
            console.log(error);
            window.table.destroy();
            $("#editModal").modal('hide');
            window.table = loadTable();
        });
    });

    $("#deleteCategoryButton").click(function () {
        let id = $('#inputEditCategoryId').val();
        axios.delete('/api/v1/categories/' + id)
            .then(function (response) {
                // handle success
                console.log(response);
                $("#editModal").modal('hide');
                window.table.ajax.reload();
            }).catch(error => {
            console.log(error);
            window.table.destroy();
            $("#editModal").modal('hide');
            $("#loginModal").modal('show');
            window.table = loadTable();
        });
    });

    window.showEditModal = function (id) {
        axios.get('/api/v1/categories/' + id)
            .then(function (response) {
                // handle success
                console.log(response);
                $("#inputEditCategoryId").text(response.data.id).val(response.data.id);
                $("#inputEditCategoryName").val(response.data.name);
                $("#editModal").modal().val();
            }).catch(error => console.log(error));

    };

    window.table = loadTable();
});




