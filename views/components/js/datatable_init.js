
    document.addEventListener('DOMContentLoaded', function() {

        $('#Programmer_tbl').DataTable({
            ordering: [],
            language: {
                search: "",
                searchPlaceholder: "Search programmer..."
            },

        });

        $('#programmer_details_tbl').DataTable({
            language: {
                search: "",
                searchPlaceholder: "Search Project..."
            },

        });
    });

    let activeEditId = null;

    function formatDate(dateString) {
        const [year, month, day] = dateString.split('-');
        const date = new Date(year, month - 1, day);

        return date.toLocaleDateString('en-US', {
            month: 'long',
            day: 'numeric',
            year: 'numeric'
        });
    }
