const API_URL = 'http://localhost/api';
$(init);

function init() {

    let diets = getDiets();
    let dietsList = '';
    for (let i in diets) {
        dietsList += `<option value='${diets[i].id}'>${diets[i].name}</option>`;
    };
    $('#diet').append(dietsList);

    let schedules = getSchedules();
    let schedulesList = '';
    for (let i in schedules) {
        schedulesList += `<option value='${schedules[i].id}'>${schedules[i].name}</option>`;
    };
    $('#schedule').append(schedulesList);

    $(document).on('click', '#submit', function () {
        let flag = false;
        let data = collect();
        refresh();
        if (!data.client.surname) {
            $('#surname_error').show();
            flag = true;
        }
        if (!data.client.name) {
            $('#name_error').show();
            flag = true;
        }
        if (!data.client.phone) {
            $('#phone_error').show();
            flag = true;
        }
        if (!data.order.start || !data.order.end) {
            $('#period_error').show();
            flag = true;
        }
        if (!data.order.schedule_id) {
            $('#schedule_error').show();
            flag = true;
        }
        if (!data.order.diet_id) {
            $('#diet_error').show();
            flag = true;
        }
        if (data.order.weekday === '0000000') {
            $('#weekday_error').show();
            flag = true;
        }
        if (!flag) {
            createOrder(data);
        }
    });
}

function collect() {
    let weekday = '';
    for (let i = 1; i <= 7; i++) {
        weekday += Number($(`#weekday #${i}`).is(':checked'));
    }
    let data = {
        client: {
            surname: $('#surname input').val(),
            name: $('#name input').val(),
            patronymic: $('#patronymic input').val(),
            phone: $('#phone input').val().substr(2)
        },
        order: {
            diet_id: $('#diet').val(),
            start: $('#period #start').val(),
            end: $('#period #end').val(),
            schedule_id: $('#schedule').val(),
            weekday: weekday,
            comment: $('#comment textarea').val()
        }
    };
    return data;
}

function createOrder(data) {
    return $.ajax({
        // url: 'https://webhook.site/6841806a-51f0-4661-93fb-660040334f85',
        url: API_URL + '/createOrder.php',
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(data),
    }).done(function() {
        alert('done');
    }).fail(function() {
        alert('fail');
    });
}

function getDiets() {
    return $.ajax({
        url: API_URL + '/dietList.php',
        method: 'GET',
        async: false
    }).responseJSON;
}

function getSchedules() {
    return $.ajax({
        url: API_URL + '/scheduleList.php',
        method: 'GET',
        async: false
    }).responseJSON;
}

function refresh() {
    $('#surname_error').hide();
    $('#name_error').hide();
    $('#phone_error').hide();
    $('#period_error').hide();
    $('#diet_error').hide();
    $('#schedule_error').hide();
    $('#weekday_error').hide();
}
