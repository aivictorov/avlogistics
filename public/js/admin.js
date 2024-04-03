document.addEventListener('DOMContentLoaded', function () {
    search();
})

function search() {
    searchField = document.getElementById('search');
    
    if (searchField) table = searchField.closest('table');
    if (searchField && table) links = table.querySelectorAll('a');
    if (searchField && table && links) {
        searchField.addEventListener('input', function () {
            links.forEach(function (link) {
                if (link.innerText != '' && !link.innerText.toLowerCase().includes(searchField.value.toLowerCase())) {
                    link.closest('tr').classList.add('d-none');
                } else {
                    link.closest('tr').classList.remove('d-none');
                }
            });
        });
    }
};