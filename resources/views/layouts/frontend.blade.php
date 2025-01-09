<!-- this is the entry point -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>{{config('app.name')}}</title>

    @include('layouts.head')
    @livewireStyles
</head>

<body>
    @include('layouts.nav')

    <div id="searchModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-75">
        <div class="w-3/4 p-4 overflow-y-auto text-white bg-gray-900 rounded-lg h-3/4">
            
            <div class="mt-4">
                @livewire('product-search')
            </div>
        </div>
    </div>

    <!-- Page Contents -->
    <div class="page-content pt-[87px]">
        @yield('pages')
        @livewireScripts
    </div>

    @include('layouts.footer')

<script>
    function toggleSearchModal() {
        const modal = document.getElementById('searchModal');
        if (modal) {
            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden'); // Show modal
                Livewire.emit('resetSearch'); // Emit resetSearch event
            } else {
                modal.classList.add('hidden'); // Hide modal
            }
        }
    }

</script>

</body>

</html>