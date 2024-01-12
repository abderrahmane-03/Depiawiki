// search.js

$(document).ready(function() {
    // Attach an event listener to the search input
    $('input[name="q"]').on('input', function() {
        // Get the search keyword
        var keyword = $(this).val();

        // Call the search API
        $.ajax({
            url: '/path/to/home.php', // Change this path to the correct location of your search.php file
            method: 'GET',
            data: { q: keyword },
            dataType: 'json',
            success: function(data) {
                // Update the UI with search results
                updateSearchResults(data);
            },
            error: function(error) {
                console.error('Error fetching search results:', error);
            }
        });
    });

    // Function to update the UI with search results
    function updateSearchResults(results) {
        // Clear existing search results
        $('.grid').empty();

        // Append new search results to the grid
        results.forEach(function(result) {
            // Build HTML for each search result
            var html = '<div class="rounded mb-5 overflow-hidden shadow-lg flex flex-col">';


            // Append the result to the grid
            $('.grid').append(html);
        });
    }
});