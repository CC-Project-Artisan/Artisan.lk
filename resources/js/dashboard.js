document.addEventListener('DOMContentLoaded', function () {
    // Load the dashboard page in mobile view
    document.getElementById('menuToggle')?.addEventListener('click', function () {
        const sidebar = document.getElementById('sidebar');
        if (sidebar) {
            sidebar.classList.toggle('hidden');
        } else {
            console.error('Sidebar element not found.');
        }
    });

    // Load the selected page
    function loadPage(page) {
        var pages = document.querySelectorAll('.ud-page-wrapper');
        pages.forEach(function (p) {
            p.classList.add('hidden');
        });

        var selectedPage = document.getElementById(page);
        if (selectedPage) {
            selectedPage.classList.remove('hidden');
        } else {
            console.error(`Page with ID '${page}' not found.`);
            return;
        }

        // Update the active state in the sidebar
        var items = document.querySelectorAll('.u-sidebar-value');
        items.forEach(function (item) {
            item.classList.remove('bg-customBlue');
        });

        var activeItem = document.querySelector(`.u-sidebar-value[data-page="${page}"]`);
        if (activeItem) {
            activeItem.classList.add('bg-customBlue');
        } else {
            console.error(`Sidebar item with data-page="${page}" not found.`);
        }

        // Update the breadcrumb
        var breadcrumb = document.getElementById('breadcrumb');
        if (breadcrumb) {
            breadcrumb.textContent =
                ' / ' +
                page.charAt(0).toUpperCase() +
                page.slice(1).replace(/([A-Z])/g, ' $1').trim();
        } else {
            console.error('Breadcrumb element not found.');
        }
    }
});

