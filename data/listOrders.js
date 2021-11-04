const API_URL = 'http://localhost/api';
$(init);

function init() {

    let orders = getOrders();
    let ordersList = '';
    for (let i in orders) {
        ordersList += `<tr>
            <td>${orders[i].surname} ${orders[i].name} ${orders[i].patronymic ? orders[i].patronymic : ''}</td>
            <td>+7${orders[i].phone}</td>
            <td>${orders[i].date}</td>
            <td>${orders[i].diet}</td>
            <td>${orders[i].start} - ${orders[i].end}</td>
            <td>${orders[i].schedule}</td>
            <td>${weekdays(orders[i].weekday)}</td>
            <td>${orders[i].comment ? orders[i].comment : ''}</td>
        </tr>`;
    };
    $('table').append(ordersList);

    console.table(orders);
}

function getOrders() {
    return $.ajax({
        url: API_URL + '/orderList.php',
        method: 'GET',
        async: false
    }).responseJSON;
}
function weekdays(number) {
    number = Number(number);
    let days = [];
    let weekdays = ['ВС','СБ','ПТ','ЧТ','СР','ВТ','ПН'];
    for (let i = 0; number > 0; number = Math.floor(number/10), i++) {
        if (number % 10) {
            days.push(weekdays[i]);
        }
    }
    return days.reverse().join(', ');
}
