import './bootstrap';

import DataTable from 'datatables.net-dt';
//import Bootstrap from 'bootstrap';
// import $ from 'jquery';
// window.$ = $;
$(document).ready(function () {
    $("#loginButton").click(function () {
        axios.all([axios.get('http://localhost:8000/sanctum/csrf-cookie'),
            axios.post('http://localhost:8000/api/v1/login', {
                'email': $('#staticEmail').val(),
                'password': $('#inputPassword').val()
            })])
            .then(axios.spread((firstResponse, secondResponse) => {
                console.log(firstResponse.config.headers, secondResponse.data);
            }))
            .catch(error => console.log(error));

    });
    $("#logoutButton").click(function () {
        axios.get('http://localhost:8000/api/v1/logout')
            .then(function (response) {
                // handle success
                alert('rr');
                console.log(response);
            })
    });
});

//$("#loginModal").modal('show');

function showTable() {

}

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

axios.get('http://localhost:8000/api/v1/categories')
    .then(function (response) {
        // handle success
        console.log(response);
        let categories = response.data.data;
        loadTable(categories);
    })
    .catch(function (error) {
        // handle error
        $("#loginModal").modal('show');
        console.log(error);
    });

function loadTable(arrayData) {
    return new DataTable('#myTable', {
        data: arrayData,
        columns: [
            {data: 'id'},
            {data: 'name'},
            {data: 'created_at'},
            {data: 'updated_at'}
        ],
    });
}

// let table = new DataTable('#myTable', {
//     ajax: {
//         url: "/api/v1/categories",
//         dataSrc: 'data'
//     },
//     stateSave: true,
//     columns: [
//         {data: 'id'},
//         {data: 'name'},
//         {data: 'created_at'},
//         {data: 'updated_at'}
//     ],
// });
