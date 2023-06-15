import './bootstrap';

import DataTable from 'datatables.net-dt';
// import $ from 'jquery';
//
// window.$ = $;
//import Bootstrap from 'bootstrap';



// function delete_cookie(name, path, domain) {
//     if (get_cookie(name)) {
//         document.cookie = name + "=" +
//             ((path) ? ";path=" + path : "") +
//             ((domain) ? ";domain=" + domain : "") +
//             ";expires=Thu, 01 Jan 1970 00:00:01 GMT; SameSite=None; Secure=true";
//     }
// }
//


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


//$("#editModal").modal('show'); // modal();
//});
// function loadCategories() {
//     return axios.get('http://localhost:8000/api/v1/categories')
//         .then(function (response) {
//             // handle success
//             // console.log(response);
//             //let categories = response.data.data;
//             return response;
//         })
//         .catch(function (error) {
//             // handle error
//             // $("#loginModal").modal('show');
//             console.log(error);
//         });
// }
//$('#screen').hide();
$(document).ready(function () {

    function delete_cookie( name, path, domain ) {
        if( get_cookie( name ) ) {
            document.cookie = name + "=" +
                ((path) ? ";path="+path:"")+
                ((domain)?";domain="+domain:"") +
                ";expires=Thu, 01 Jan 1970 00:00:01 GMT" +
                ";SameSite=Lax";
        }
    }
    function get_cookie(name){
        return document.cookie.split(';').some(c => {
            return c.trim().startsWith(name + '=');
        });
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

    $("#loginModal").modal('show');
    let table;
    console.log(document.cookie);
    $("#loginButton").click(function () {
            // axios.post('http://localhost:8000/api/v1/login', {
            //     'email': $('#staticEmail').val(),
            //     'password': $('#inputPassword').val()
            // }).then(function (response) {
            //             if (response.status === 200) {
            //                 console.log(document.cookie);
            //                 $('#screen').show();
            //                 function get_cookie(name) {
            //                     return document.cookie.split(';').some(c => {
            //                         return c.trim().startsWith(name + '=');
            //                     });
            //                 }
            //
            //                 $.ajaxSetup({
            //                     headers: {
            //                         'X-XSRF-TOKEN': get_cookie('XSRF-TOKEN')
            //                     }
            //                 });
            //
            //
            //                 window.table = new DataTable('#myTable', {
            //                     ajax: {
            //                         url: "/api/v1/categories",
            //                         dataSrc: 'data',
            //                         error: function (xhr, error, code) {
            //                             console.log(xhr, code);
            //                             $("#loginModal").modal('show');
            //                             window.table.destroy();
            //                         }
            //                     },
            //                     stateSave: true,
            //                     columns: [
            //                         {
            //                             title: 'Id',
            //                             data: 'id'
            //                         },
            //                         {
            //                             title: 'Name',
            //                             data: 'name'
            //                         },
            //                         {
            //                             title: 'Created at',
            //                             data: 'created_at'
            //                         },
            //                         {
            //                             title: 'Updated at',
            //                             data: 'updated_at'
            //                         }
            //                     ],
            //                 });
            //                 $("#loginModal").modal('hide');
            //             } else {
            //                 $("#loginModal").modal('show');
            //             }
            //         })
            //         .catch(error => console.log(error));
            // });
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
                    function get_cookie(name) {
                        return document.cookie.split(';').some(c => {
                            return c.trim().startsWith(name + '=');
                        });
                    }

                    //console.log('csrf', $('meta[name="csrf-token"]').attr('content'));

                    $.ajaxSetup({
                        headers: {
                            'X-XSRF-TOKEN': get_cookie('XSRF-TOKEN')
                            //'CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });


                    window.table = new DataTable('#myTable', {
                        ajax: {
                            url: "/api/v1/categories",
                            dataSrc: 'data',
                            error: function (xhr, error, code) {
                                console.log(xhr, code);
                                $("#loginModal").modal('show');
                                window.table.destroy();
                            }
                        },
                        stateSave: true,
                        columns: [
                            {
                                title: 'Id',
                                data: 'id'
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

    // console.log(document.cookie);
    // function get_cookie(name) {
    //     return document.cookie.split(';').some(c => {
    //         return c.trim().startsWith(name + '=');
    //     });
    // }

    // window.delCookie = function(){
    //
    //     delete_cookie('XSRF-TOKEN', '/', '');
    //     console.log(document.cookie);
    // };
    //
    window.test = function(){
        window.table = new DataTable('#myTable', {
            ajax: {
                url: "/api/v1/categories",
                dataSrc: 'data',
                error: function (xhr, error, code) {
                    console.log(xhr, code);
                    $("#loginModal").modal('show');
                    window.table.destroy();
                }
            },
            stateSave: true,
            columns: [
                {
                    title: 'Id',
                    data: 'id'
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
});




