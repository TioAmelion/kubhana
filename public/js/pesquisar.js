
    $(document).ready(function () {
        fetch_data();
        
        function fetch_data(query = '') {
            $.ajax({
                url: '/autocomplete',
                type: "GET",
                data: {query: query},
                dataType: "json",
                success: function (response) {
                    console.log("QUERY", response);
                    $('#result-search').empty();
                    $('#result-search').prepend(response);
                }
            });
        }

        $(document).on('keyup', '#search-g', function () {
            var query = $(this).val();
            console.log(query);
            fetch_data(query);
        });	
    });
