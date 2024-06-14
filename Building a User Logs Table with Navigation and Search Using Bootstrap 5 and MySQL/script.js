// script.js

let currentPage = 1;
const logsPerPage = 10;

$(document).ready(function () {
    fetchLogs();
    $('#searchInput').on('input', fetchLogs);
});

function fetchLogs() {
    const searchQuery = $('#searchInput').val();
    $.get('fetch_logs.php', { search: searchQuery, page: currentPage }, function (data) {
        renderTable(data.logs);
        renderPagination(data.totalLogs);
    }, 'json');
}

function renderTable(logs) {
    $('#logsTableBody').empty();
    logs.forEach(log => {
        $('#logsTableBody').append(`
            <tr>
                <th scope="row">${log.id}</th>
                <td>${log.user_id}</td>
                <td>${log.action}</td>
                <td>${log.timestamp}</td>
            </tr>
        `);
    });
}

function renderPagination(totalLogs) {
    const totalPages = Math.ceil(totalLogs / logsPerPage);
    $('#pagination').empty();
    for (let i = 1; i <= totalPages; i++) {
        $('#pagination').append(`
            <li class="page-item ${i === currentPage ? 'active' : ''}">
                <a class="page-link" href="#" data-page="${i}">${i}</a>
            </li>
        `);
    }
    $('.page-link').on('click', function (e) {
        e.preventDefault();
        currentPage = $(this).data('page');
        fetchLogs();
    });
}
