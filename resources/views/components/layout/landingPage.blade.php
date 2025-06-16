<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/app.css')

    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo/logoBgWhite.png?v=1') }}">
    <title>{{ $title ?? 'SIMAK' }}</title>
</head>

<style>
    .text-outline {
    -webkit-text-stroke: .3px;
    -webkit-text-stroke-color: black;
    -webkit-text-fill-color: white; 
}
</style>

<body style="background-image: url('{{ asset('assets/img/mainBg.png' )}}');" class="{{ $customClass }} max-w-screen min-h-screen font-sans overflow-x-hidden bg-cover bg-fixed">
    {{ $slot }}
</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.getElementById('menu-toggle');
        const menuClose = document.getElementById('menu-close');
        const mobileMenu = document.getElementById('mobile-menu');
        const body = document.body;

        // Function to close the menu
        function closeMenu() {
            mobileMenu.classList.remove('sm:flex');
            mobileMenu.classList.add('sm:hidden');
            body.classList.remove('overflow-hidden');
        }

        // Toggle menu visibility
        menuToggle.addEventListener('click', function(event) {
            event.stopPropagation();
            console.log('clicked');
            if (mobileMenu.classList.contains('sm:hidden')) {
                mobileMenu.classList.remove('sm:hidden');
                mobileMenu.classList.add('sm:flex');
            } else {
                closeMenu();
            }
        });

        // Close menu when clicking the close button
        menuClose.addEventListener('click', function(event) {
            event.stopPropagation();
            closeMenu();
        });

        // Close menu when clicking outside the menu
        document.addEventListener('click', function(event) {
            if (!mobileMenu.contains(event.target) && !menuToggle.contains(event.target)) {
                closeMenu();
            }
        });

        // Prevent menu click from propagating to document
        mobileMenu.addEventListener('click', function(event) {
            event.stopPropagation();
        });
    });

    let lastScrollY = window.scrollY;

    window.addEventListener('scroll', () => {
        const navbar = document.getElementById('navbar');

        if (window.scrollY > lastScrollY) {
            navbar.classList.add('-translate-y-full');
        } else {
            navbar.classList.remove('-translate-y-full');
        }
        lastScrollY = window.scrollY;
    });
</script>

</html>
