const ul = $('#userList');
const url = window.location.protocol + '//' + window.location.hostname + '/roomGetUsers';
const roomURL = $(window.location.pathname.split('/')).get(-1);
let name = '';
let userList;

$('#generateButton').on('click', () => {
    console.log('Removing...');
    $('#generateButton').remove();
});

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
        if (userList !== response.data.users) {
            ul.empty();
            $(response.data.users).each((elementIndex, element) => {
                ul.append(`<li>${element.name}</li>`);
            });
        }
        if (name !== response.data.pickedName && response.data.pickedName.length > 0) {
            name = response.data.pickedName[0]['name'];
            $('#recievedName').text(`Dobili ste: ${name}`);
            $('#generateButton').remove();
        }
    }).fail(error => {
        console.log('Error:', error);
    });
}

const interval = setInterval(refreshData, 1000);
