<x-layout.landingPage bg="bg-white" customClass="flex flex-col justify-between items-center text-white">
    <div class="sticky top-0 z-50 w-full">
        <nav id="navbar"
            class="w-full flex justify-between items-center px-12 sm:px-2 mt-8 sm:mt:0 transition-transform duration-300">
            <!-- Logo -->
            <a href="/">
                <img class="w-19 sm:w-6 hidden sm:block" src="{{ asset('assets/img/logo/SIMAK1.png?v=1') }}"
                    alt="Logo">
            </a>

            <!-- Hamburger Icon (Mobile) -->
            <button id="menu-toggle" class="sm:block hidden focus:outline-none">
                <svg class="w-8 h-8" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.33334 6.5H21.6667M4.33334 10.8333H21.6667M4.33334 15.1667H21.6667M4.33334 19.5H21.6667"
                        stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>

            <!-- Desktop Navigation -->
            <div id="menu" class="w-full flex justify-between items-center sm:hidden">
                <a href="/" class="cursor-default"><div class="h-28 sm:h-12 w-28 sm:w-12 bg-cover bg-center"
                    style="background-image: url('{{ asset('assets/img/logo/SIMAK1.png?v=1') }}');"></div></a>
                <div
                    class="flex justify-around items-center gap-14 sm:gap-3 text-2xl sm:text-base px-14 sm:px-0 font-light">
                    <a href="/home">Home</a>
                    <a href="/home#about">About</a>
                    <a href="/home#advantages">Advantages</a>
                    <a href="/home#contact">Contact</a>
                </div>
            </div>
        </nav>
    </div>
    <div id="mobile-menu"
        class="hidden sm:hidden flex-col justify-start items-center z-1000 w-1/2 h-screen bg-blue-900 text-white fixed top-0 right-0 text-base">
        <button id="menu-close" class="self-start mt-8 ml-4 focus:outline-none">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        <a href="/" class="py-2">Home</a>
        <a href="#about" class="py-2">About</a>
        <a href="#advantages" class="py-2">Adventages</a>
        <a href="#contact" class="py-2">Contact</a>
    </div>

    <section class="flex flex-col justify-center items-center mt-32">
        <div class="flex flex-col justify-center items-center">
            <h1 class="text-7xl sm:text-3.5xl font-light ">WELCOME TO SIMAK</h1>
            <p class="text-base sm:text-xxs font-light mt-2 sm:mt-0">Kelola gaji karyawan dengan lebih mudah, cepat, dan
                tepat menggunakan SIMAK
            </p>
        </div>
        <a href="/home">
        <button
            class="w-124 sm:w-66 h-20 sm:h-11 border border-white rounded-full text-3.5xl sm:text-2xl mt-12 sm:mt-7 font-extralight">LEARN
            MORE</button>
            </a>
    </section>

    <div class="w-full flex justify-center mt-36 mb-4">
        <svg class="sm:w-12 sm:h-12 w-17 h-17" viewBox="0 0 68 68" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M0.75 34C0.75 18.327 0.75 10.487 5.6185 5.6185C10.487 0.75 18.3235 0.75 34 0.75C49.673 0.75 57.513 0.75 62.3815 5.6185C67.25 10.487 67.25 18.3235 67.25 34C67.25 49.673 67.25 57.513 62.3815 62.3815C57.513 67.25 49.6765 67.25 34 67.25C18.327 67.25 10.487 67.25 5.6185 62.3815C0.75 57.513 0.75 49.6765 0.75 34Z"
                stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path
                d="M53.278 14.75H53.243M49.75 34C49.75 38.1772 48.0906 42.1832 45.1369 45.1369C42.1832 48.0906 38.1772 49.75 34 49.75C29.8228 49.75 25.8168 48.0906 22.8631 45.1369C19.9094 42.1832 18.25 38.1772 18.25 34C18.25 29.8228 19.9094 25.8168 22.8631 22.8631C25.8168 19.9094 29.8228 18.25 34 18.25C38.1772 18.25 42.1832 19.9094 45.1369 22.8631C48.0906 25.8168 49.75 29.8228 49.75 34Z"
                stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </div>

</x-layout.landingPage>
