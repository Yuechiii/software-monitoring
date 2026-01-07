</div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script src="<?= VIEWS_JS_PATH . '/responsive.js' ?>"></script>
<script src="<?= VIEWS_JS_PATH . '/datatable_init.js' ?>"></script>

<!-- FOR SEARCHABLE DROPDOWN -->
<script>
    document.querySelectorAll('.project-select').forEach(select => {
        new TomSelect(select, {
            placeholder: "Search project...",
            allowEmptyOption: true,
            highlight: true,
            maxOptions: 200
        });
    });


    document.querySelectorAll('.assign_project-select').forEach(select => {
        new TomSelect(select, {
            placeholder: "Search programmer...",
            allowEmptyOption: true,
            highlight: true,
            maxOptions: 200
        });
    });
</script>

<!-- FOR OPENING AND CLOSING MODALS -->
<script>
    function openModal(type) {
        console.log(type);
        // Finds 'modalDelay' or 'modalProject' based on the word passed in
        const modal = document.getElementById('modal' + type);
        const box = document.getElementById('box' + type);

        if (!modal || !box) {
            console.error("Modal not found for type: " + type);
            return;
        }

        // 1. Show the main container
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        // 2. Animate the inner box
        setTimeout(() => {
            box.classList.remove('scale-95', 'opacity-0');
            box.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeModal(type) {
        const modal = document.getElementById('modal' + type);
        const box = document.getElementById('box' + type);

        box.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 300);
    }
</script>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const button = document.getElementById('user-menu-button');
        const dropdown = document.getElementById('user-menu-dropdown');
        const arrow = document.getElementById('dropdown-arrow');

        function toggleDropdown() {
            const isExpanded = button.getAttribute('aria-expanded') === 'true';

            // Toggle visibility
            if (isExpanded) {
                dropdown.classList.add('hidden');
                arrow.classList.remove('rotate-180');
                button.setAttribute('aria-expanded', 'false');
            } else {
                dropdown.classList.remove('hidden');
                arrow.classList.add('rotate-180');
                button.setAttribute('aria-expanded', 'true');
            }
        }

        button.addEventListener('click', function(e) {
            e.stopPropagation(); // Prevents the click from immediately bubbling up to the document close listener
            toggleDropdown();
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                if (!dropdown.classList.contains('hidden')) {
                    toggleDropdown(); // Use the toggle function to collapse it
                }
            }
        });
    });
</script>




</html>