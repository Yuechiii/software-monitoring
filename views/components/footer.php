</div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>


<!-- FOR SEARCHABLE DROPDOWN -->
<script>
    document.querySelectorAll('.project-select').forEach(select => {
        new TomSelect(select, {
            placeholder: "Search project...",
            allowEmptyOption: true,
            highlight: true,
            maxOptions: 200 // or whatever fits
        });
    });
</script>

<script>
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

    // The Global Click Listener
    document.addEventListener('click', function(event) {
        // If nothing is being edited, do nothing

        if (activeEditId === null) return;

        const container = document.getElementById(`deadline-container-${activeEditId}`);

        // Check if the click was OUTSIDE the active container
        // We also check !event.target.closest('button') to ensure 
        // we don't accidentally close it while clicking the "Edit" button itself
        if (container && !container.contains(event.target)) {
            closeEditState(activeEditId);
            activeEditId = null;
        }
    });

    function toggleEdit(id, isEditing) {
        // 1. If we are opening a new edit session
        if (isEditing) {
            // Close any previously open edit form first
            if (activeEditId !== null && activeEditId !== id) {
                closeEditState(activeEditId);
            }

            // Open the requested edit form
            openEditState(id);
            activeEditId = id;
        }
        // 2. If we are closing the current one (Cancel/Save)
        else {
            closeEditState(id);
            activeEditId = null;
        }
    }

    // Helper: Show Input, Hide Text
    function openEditState(id) {
        document.getElementById(`view-state-${id}`).classList.add('hidden');
        document.getElementById(`edit-state-${id}`).classList.remove('hidden');
        // Optional: Focus the input automatically
        document.getElementById(`input-title-${id}`).focus();
    }

    // Helper: Hide Input, Show Text
    function closeEditState(id) {
        const view = document.getElementById(`view-state-${id}`);
        const edit = document.getElementById(`edit-state-${id}`);

        if (view && edit) {
            view.classList.remove('hidden');
            edit.classList.add('hidden');
        }
    }

    function saveInlineEdit(id) {
        const projectSelect = document.getElementById(`input-project-${id}`);
        const dateInput = document.getElementById(`input-date-${id}`);

        const newProjectId = projectSelect.value;
        const newProjectText = projectSelect.options[projectSelect.selectedIndex].text;
        const newDate = dateInput.value;
        // Send POST request
        fetch('<?= PAGES_PATH . "/dashboard.php?f=UpdateDeadline" ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json', // send JSON
                },
                body: JSON.stringify({
                    id: id,
                    project_id: newProjectId,
                    deadline: newDate
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update UI
                    document.getElementById(`title-display-${id}`).innerText = newProjectText;
                    document.getElementById(`date-display-${id}`).innerText = formatDate(newDate);

                    // Update dataset for future edits
                    const container = document.getElementById(`deadline-container-${id}`);
                    container.dataset.projectId = newProjectId;
                    container.dataset.deadline = newDate;

                    // Close edit
                    toggleEdit(id, false);
                } else {
                    alert('Failed to update deadline: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while updating the deadline.');
            });
    }
</script>

<script>
    let currentDeleteItem = null;

    /**
     * Step 1: Open the modal and store the target ID
     */
    function prepareDelete(id) {
        // Save the ID in the hidden input
        document.getElementById('deleteTargetId').value = id;
        // Call your existing openModal function
        openModal('Delete');
    }

    /**
     * Step 2: The actual deletion logic
     */
    async function executeDeletion() {
        const id = document.getElementById('deleteTargetId').value;
        const btn = document.getElementById('btnConfirmDelete');

        const originalText = btn.innerText;
        btn.innerText = "Deleting...";
        btn.disabled = true;

        try {
            // Ensure the URL is dashboard.php (or your actual filename)
            const response = await fetch('<?= PAGES_PATH . "/dashboard.php?f=delete_deadline" ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                // Aligning with PHP $_POST['deadline_id']
                body: `deadline_id=${encodeURIComponent(id)}`
            });

            const result = await response.json();

            if (result.success) {
                closeModal('Delete');
                location.reload();
            } else {
                alert("Error: " + result.message);
            }
        } catch (error) {
            console.error("Critical error:", error);
            alert("Failed to parse server response. Check PHP logs.");
        } finally {
            btn.innerText = originalText;
            btn.disabled = false;
        }
    }
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


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- Element Selection ---
        const sidebarContainer = document.getElementById('sidebar-container');
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebarOverlay = document.getElementById('sidebar-overlay');
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
            console.log(`Setting sidebar state to ${isExpanding ? 'expanded' : 'collapsed'}, animate: ${animate}`);
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


        window.toggleSidebar = function(open) {
            const isOpen = !sidebarContainer.classList.contains('-translate-x-full');
            const shouldOpen = open !== undefined ? open : !isOpen;

            if (shouldOpen) {
                // MOBILE OPEN → force expanded state
                sidebarContainer.classList.remove(collapsedWidth);
                sidebarContainer.classList.add(expandedWidth);

                setSidebarState(true, true); // show logo + text instantly

                sidebarContainer.classList.remove('-translate-x-full');
                sidebarOverlay.classList.remove('hidden');
            } else {
                // MOBILE CLOSE → slide out
                sidebarContainer.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
            }
        };


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
            const isMobile = window.innerWidth < lgBreakpoint;

            if (isMobile) {
                toggleSidebar();
            } else {
                const isCurrentlyExpanded = sidebarContainer.classList.contains(expandedWidth);
                setSidebarState(!isCurrentlyExpanded, true);
            }
        });



        // --- DataTables initialization (Kept from original) ---
        $('#Programmer_tbl').DataTable({
            language: {
                search: "",
                searchPlaceholder: "Search programmer..."
            },

        });
    });
</script>

</html>