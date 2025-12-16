</div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

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


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- Element Selection ---
        const sidebarContainer = document.getElementById('sidebar-container');
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const collapse_icon = document.getElementById('collapse-icon');
        const logoTitle = document.getElementById('logo-title');
        const logoImg = document.getElementById('logo-img');
        const linkTexts = document.querySelectorAll('.link-text');


        // --- State Variables ---
        const expandedWidth = 'w-60';
        const collapsedWidth = 'w-20';
        const expandedImgClasses = ['h-10', 'sm:h-12', 'mr-1'];
        const collapsedImgClasses = ['h-8', 'sm:h-8', 'mx-auto'];

        // Tailwind's typical large breakpoint (1024px)
        const lgBreakpoint = 1034;

        // --- Core Sidebar Management Functions ---

        function setSidebarState(isExpanding, animate = true) {
            // Disable transition for immediate setting if not animating
            if (!animate) {
                sidebarContainer.classList.remove('transition-all', 'duration-300', 'ease-in-out');
            } else {
                sidebarContainer.classList.add('transition-all', 'duration-300', 'ease-in-out');
            }

            if (isExpanding) {
                // EXPAND
                sidebarContainer.classList.remove(collapsedWidth);
                sidebarContainer.classList.add(expandedWidth);

                collapse_icon.classList.remove('rotate-180');
                collapse_icon.classList.add('rotate-0');;
                logoTitle.classList.remove('opacity-0', 'h-0', 'overflow-hidden');
                logoTitle.classList.add('opacity-100', 'h-auto');

                logoImg.classList.remove('opacity-0', 'h-0', 'overflow-hidden', 'hidden');
                logoImg.classList.add('opacity-100', 'h-auto'); // Show text after the width transition starts

                setTimeout(() => {
                    linkTexts.forEach(span => {
                        span.classList.remove('opacity-0', 'hidden');
                        span.classList.add('opacity-100');
                    });
                }, animate ? 100 : 0);

                logoImg.classList.remove(...collapsedImgClasses);
                logoImg.classList.add(...expandedImgClasses);

            } else {
                // COLLAPSE
                sidebarContainer.classList.remove(expandedWidth);
                sidebarContainer.classList.add(collapsedWidth);

                collapse_icon.classList.remove('rotate-0', 'rotate-90')
                collapse_icon.classList.add('rotate-180')
                // Hide text elements
                logoTitle.classList.add('opacity-0', 'h-0', 'overflow-hidden');
                logoTitle.classList.remove('opacity-100', 'h-auto');

                logoImg.classList.add('opacity-0', 'h-0', 'overflow-hidden', 'hidden');
                logoImg.classList.remove('opacity-100', 'h-auto');



                linkTexts.forEach(span => {
                    span.classList.add('opacity-0', 'hidden');
                    span.classList.remove('opacity-100');
                });

                logoImg.classList.remove(...expandedImgClasses);
                logoImg.classList.add(...collapsedImgClasses);
            }
        }

        // --- Auto-Collapse Logic ---

        function handleResize() {
            const isSmallScreen = window.innerWidth < lgBreakpoint;
            const isCurrentlyExpanded = sidebarContainer.classList.contains(expandedWidth);

            if (isSmallScreen && isCurrentlyExpanded) {
                // Auto-collapse on small screens
                setSidebarState(false, true); // Animate the collapse
            } else if (!isSmallScreen && !isCurrentlyExpanded) {
                // Auto-expand on large screens (optional, but good for returning to desktop view)
                // We use false for no animation here, to snap to the correct state quickly
                setSidebarState(true, false);
            }
        }

        // --- Initialization and Event Listeners ---

        // 1. Check state on initial load (no animation for first paint)
        handleResize();

        // 2. Listen for window resize events
        window.addEventListener('resize', handleResize);

        // 3. Keep the manual toggle button for user override
        sidebarToggle.addEventListener('click', function() {
            const isCurrentlyExpanded = sidebarContainer.classList.contains(expandedWidth);
            setSidebarState(!isCurrentlyExpanded, true); // Always animate manual toggle
        });


        // --- DataTables initialization (Kept from original) ---
        $('#Programmer_tbl').DataTable({
            language: {
                search: "",
                searchPlaceholder: "Search programmer..."
            },
            dom: 'ft'
        });
    });
</script>

</html>