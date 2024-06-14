// script.js

const logs = [
    { id: 1, userId: 'user123', action: 'Login', timestamp: '2024-06-14 10:00:00' },
    { id: 2, userId: 'user456', action: 'Logout', timestamp: '2024-06-14 10:05:00' },
    // Add more sample logs here
];

const logsPerPage = 10;
let currentPage = 1;
let filteredLogs = logs;

$(document).ready(function () {
    renderTable();
    renderPagination();
    $('#searchInput').on('input', handleSearch);
});

function handleSearch() {
    const searchQuery = $('#searchInput').val().toLowerCase();
    filteredLogs = logs.filter(log =>
        log.userId.toLowerCase().includes(searchQuery) ||
        log.action.toLowerCase().includes(searchQuery) ||
        log.timestamp.toLowerCase().includes(searchQuery)
    );
    currentPage = 1;
    renderTable();
    renderPagination();
}

function renderTable() {
    const startIndex = (currentPage - 1) * logsPerPage;
    const endIndex = startIndex + logsPerPage;
    const logsToDisplay = filteredLogs.slice(startIndex, endIndex);
    $('#logsTableBody').empty();
    logsToDisplay.forEach(log => {
        $('#logsTableBody').append(`
            <tr>
                <th scope="row">${log.id}</th>
                <td>${log.userId}</td>
                <td>${log.action}</td>
                <td>${log.timestamp}</td>
            </tr>
        `);
    });
}

function renderPagination() {
    const totalPages = Math.ceil(filteredLogs.length / logsPerPage);
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
        renderTable();
        renderPagination();
    });
}
