const ul = $('#userList');
const url = window.location.protocol + '//' + window.location.hostname + '/roomGetUsers';
const roomURL = $(window.location.pathname.split('/')).get(-1);
let userList;

function refreshData() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: url,
        method: "POST",
        data: {
            roomURL: roomURL
        },
        datatype: "json"
    }).done(function (response) {
        if (userList !== response.data) {
            ul.empty();
            $(response.data).each((elementIndex, element) => {
                ul.append(`<li>${element.name}</li>`);
            });
        }
    }).fail(error => {
        console.log('Error:', error);
    });
}

const interval = setInterval(refreshData, 1000);
