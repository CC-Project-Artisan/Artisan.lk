<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview</title>
    @include('layouts.head')

</head>

<body style="display: flex;">
    <!-- Add toggle button -->
    <!-- <aside class="fixed-radio-buttons">
        <div class="flex justify-between items-center p-4">
            <h2 class="text-center text-3xl" style="color:#8b5e34; font-family: Georgia, serif;">Choose Layout</h2>
            <button id="sidebarToggle" class="bg-white rounded-full p-2 shadow-md">
                <i class="fas fa-chevron-left" id="toggleIcon"></i>
            </button>
        </div>
        <button id="acceptLayout" class="bg-blue-500 px-4 py-2 rounded mt-4">Accept Layout</button>

        <input type="hidden" name="layout" id="selected-layout" value="layout1">

        <div class="card" onclick="changeLayout('layout1')">
            <div class="image-container">
                <img src="https://i0.wp.com/www.bishoprook.com/wp-content/uploads/2021/05/placeholder-image-gray-16x9-1.png?ssl=1" class="card-img-top" alt="layoutImg">
                <div class="overlay-text">Layout 1</div>
            </div>
            <input type="radio" id="layout1" name="layout" value="layout1" checked style="display: none;">
        </div>

        <div class="card" onclick="changeLayout('layout2')">
            <div class="image-container">
                <img src="https://i0.wp.com/www.bishoprook.com/wp-content/uploads/2021/05/placeholder-image-gray-16x9-1.png?ssl=1" class="card-img-top" alt="layoutImg">
                <div class="overlay-text">Layout 2</div>
            </div>
            <input type="radio" id="layout2" name="layout" value="layout2" style="display: none;">
        </div>

        <div class="card" onclick="changeLayout('layout3')">
            <div class="image-container">
                <img src="https://i0.wp.com/www.bishoprook.com/wp-content/uploads/2021/05/placeholder-image-gray-16x9-1.png?ssl=1" class="card-img-top" alt="layoutImg">
                <div class="overlay-text">Layout 3</div>
            </div>
            <input type="radio" id="layout3" name="layout" value="layout3" style="display: none;">
        </div>
    </aside> -->

    <aside class="fixed-radio-buttons">
        <div class="flex justify-between items-center p-4">
            <h2 class="text-center text-3xl" style="color:#8b5e34; font-family: Georgia, serif;">Choose Layout</h2>
            <button id="sidebarToggle" class="bg-white rounded-full p-2 shadow-md">
                <i class="fas fa-chevron-left" id="toggleIcon"></i>
            </button>
        </div>
        <button id="acceptLayout" class="bg-blue-500 px-4 py-2 rounded mt-4">Accept Layout</button>

        <input type="hidden" name="layout" id="selected-layout" value="{{ $exhibition->layout ?? 'layout1' }}">

        <div class="card" onclick="changeLayout('layout1')">
            <div class="image-container">
                <img src="https://i0.wp.com/www.bishoprook.com/wp-content/uploads/2021/05/placeholder-image-gray-16x9-1.png?ssl=1" class="card-img-top" alt="layoutImg">
                <div class="overlay-text">Layout 1</div>
            </div>
            <input type="radio" id="layout1" name="layout" value="layout1" {{ ($exhibition->layout ?? 'layout1') == 'layout1' ? 'checked' : '' }} style="display: none;">
        </div>

        <div class="card" onclick="changeLayout('layout2')">
            <div class="image-container">
                <img src="https://i0.wp.com/www.bishoprook.com/wp-content/uploads/2021/05/placeholder-image-gray-16x9-1.png?ssl=1" class="card-img-top" alt="layoutImg">
                <div class="overlay-text">Layout 2</div>
            </div>
            <input type="radio" id="layout2" name="layout" value="layout2" {{ ($exhibition->layout ?? '') == 'layout2' ? 'checked' : '' }} style="display: none;">
        </div>

        <div class="card" onclick="changeLayout('layout3')">
            <div class="image-container">
                <img src="https://i0.wp.com/www.bishoprook.com/wp-content/uploads/2021/05/placeholder-image-gray-16x9-1.png?ssl=1" class="card-img-top" alt="layoutImg">
                <div class="overlay-text">Layout 3</div>
            </div>
            <input type="radio" id="layout3" name="layout" value="layout3" {{ ($exhibition->layout ?? '') == 'layout3' ? 'checked' : '' }} style="display: none;">
        </div>
    </aside>
    <div id="preview-content" class="preview-container">
        <!-- Preview content will be loaded here -->
    </div>

    <script>
        function getQueryParams() {
            const params = {};
            const queryString = window.location.search.substring(1);
            const regex = /([^&=]+)=([^&]*)/g;
            let m;
            while (m = regex.exec(queryString)) {
                params[decodeURIComponent(m[1])] = decodeURIComponent(m[2]);
            }
            return params;
        }

        function loadLayout(layout) {
            const params = getQueryParams();
            const previewContent = document.getElementById('preview-content');
            previewContent.innerHTML = '';

            fetch(`/preview/${layout}`)
                .then(response => response.text())
                .then(html => {
                    previewContent.innerHTML = html;
                    // Populate the layout with form data
                    for (const key in params) {
                        if (params.hasOwnProperty(key)) {
                            const element = previewContent.querySelector(`[data-key="${key}"]`);
                            if (element) {
                                element.textContent = params[key];
                            }
                        }
                    }
                })
                .catch(error => console.error('Error loading layout:', error));
        }

        function changeLayout(layout) {
            document.getElementById('selected-layout').value = layout;
            document.getElementById(layout).checked = true;

            // Remove active class from all cards
            document.querySelectorAll('.card').forEach(card => {
                card.classList.remove('active');
            });

            // Add active class to selected card
            document.querySelector(`#${layout}`).closest('.card').classList.add('active');

            loadLayout(layout);
        }

        document.querySelectorAll('input[name="layout"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                loadLayout(this.value);
            });
        });

        // Initialize the default layout
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.querySelector('.fixed-radio-buttons');
            const previewContent = document.getElementById('preview-content');
            const toggleIcon = document.getElementById('toggleIcon');

            // Highlight the default active layout
            const defaultLayout = document.getElementById('layout1');
            if (defaultLayout) {
                defaultLayout.closest('.card').classList.add('active');
                loadLayout('layout1');
            }

            if (sidebarToggle && sidebar && toggleIcon) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('collapsed');
                    previewContent.classList.toggle('expanded');
                    toggleIcon.classList.toggle('fa-chevron-right');
                    toggleIcon.classList.toggle('fa-chevron-left');
                });
            }
        });

        // Handle accept button click
        document.getElementById('acceptLayout').addEventListener('click', function() {
            const selectedLayout = document.getElementById('selected-layout').value;
            window.opener.location.href = `/exhibitions/form?layout=${selectedLayout}`;
            window.close();
        });
    </script>
</body>

</html>