function getModels(brand_id) {
    // Make an AJAX request to fetch the models from the database
    $.ajax({
        type: "POST",
        url: "index.php?action=getmodels",
        data: {
            brand_id: brand_id,
        },
        success: function(models) {
            $("#select_model").html(models);
        }
    });
}

// Call the getModels function when the user selects a brand
$("#brand").change(function() {
    var brand_id = $(this).val();
    if (brand_id !== "") {
        getModels(brand_id);
    }
});

