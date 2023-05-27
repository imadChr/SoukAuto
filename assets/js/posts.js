// Include external scripts
function includeScript(url) {
    var script = document.createElement('script');
    script.src = url;
    document.head.appendChild(script);
}

includeScript('https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js');
includeScript('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js');

$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();

    // Toggle filter button
    $(".toggle-filter-btn").click(function() {
        $(".filter-form").toggleClass("d-none");
    });

    // Pagination
        $(document).on('click', '.page-link', function(e) {
            e.preventDefault();
            var page = $(this).text();
            var url = window.location.href;
            if (url.indexOf('?page=') > -1) {
                url = url.replace(/page=\d+/, 'page=' + page);
            } else {
                url += '&page=' + page;
            }
            window.location.href = url;
        });
});