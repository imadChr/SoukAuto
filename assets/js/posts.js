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

    // Add to favorites
    function addToFavorites(post_id) {
        // Send an AJAX request to the server to add or remove the post from the user's favorites
        $.ajax({
            url: '../utility/functions.php?action=addtofavorites',
            method: 'post',
            data: {
                post_id: post_id
            },
            success: function(response) {
                // Update the UI to reflect the changes
                if (response == 'added') {
                    // The post was added to the user's favorites
                    alert('Post added to favorites');
                    const icon = document.querySelector('.e-button ion-icon');
                    icon.setAttribute('name', 'heart-dislike-outline');
                    icon.classList.add('favorite');
                } else if (response == 'removed') {
                    // The post was removed from the user's favorites
                    alert('Post removed from favorites');
                    const icon = document.querySelector('.e-button ion-icon');
                    icon.setAttribute('name', 'heart-outline');
                    icon.classList.remove('favorite');
                }
            },
            error: function() {
                alert('An error occurred');
            }
        });
    }

    const button = document.querySelector('.e-button');
    let isFavorite = false;

    button.addEventListener('click', () => {
        const icon = button.querySelector('ion-icon');
        isFavorite = !isFavorite;
        if (isFavorite) {
            addToFavorites(post_id);
            icon.setAttribute('name', 'heart-dislike-outline');
        } else {
            icon.setAttribute('name', 'heart-outline');
        }
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