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

    // Date picker
    $('.datepicker-year').datepicker({
        format: 'yyyy',
        viewMode: 'years',
        minViewMode: 'years',
        startDate: '1970',
        endDate: '2023'
    });

    $('#year').on('changeDate', function() {
        const year = $(this).datepicker('getDate').getFullYear();
        console.log(year);
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
        if (url.indexOf('&page=') > -1) {
            url = url.replace(/&page=\d+/, '&page=' + page);
        } else {
            url += '&page=' + page;
        }
        window.location.href = url;
    });
});



// function addcomment(user_id, post_id) {
//     var comment = $("#comment").val();
//     $.ajax({
//         type: "POST",
//         url: "index.php?action=addcomment",
//         data: {
//             post_id: post_id,
//             user_id: user_id,
//             comment: comment,
//         },
//         success: function(post_id) {
//             // Refresh the comment section
//             loadComments(post_id);
//             $("#comment").val("");
//         }
//     });
// }

// function deletecomment(comment_id , post_id) {
//     $.ajax({
//         type: "POST",
//         url: "index.php?action=deletecomment",
//         data: {
//             comment_id: comment_id,
//         },
//         success: function(post_id) {
//             // Refresh the comment section
//             loadComments(post_id);
//         }
//     });
// }

// function loadComments(post_id) {
//     // Perform an AJAX request to fetch the updated comments
//     $.ajax({
//         type: "GET",
//         url: "index.php?action=getcomments",
//         data: {
//             post_id: post_id,
//         },
//         success: function(response) {
//             // Update the comment section with the new comments
//             alert(response);
//             $(".comments").html(response);
//         }
//     });
// }
