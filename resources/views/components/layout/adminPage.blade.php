<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/app.css')

    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo/logoBgWhite.png?v=1') }}">
    <title>{{ $title ?? 'SIMAK Admin' }}</title>
</head>

<body class="{{ $bodyClass ?? '' }}flex max-w-screen overflow-x-hidden pl-63 sm:pl-0">

    {{-- SIDEBAR --}}
    <section id="menu" class="z-50 bg-secondary-1 text-white w-63 h-screen fixed top-0 left-0 flex flex-col justify-start gap-12 sm:-translate-x-full transition-transfom duration-300">
        <div class="bg-secondary-2 font-light flex flex-col justify-center items-center w-full h-53"
            style="box-shadow: 0px 4px 4px 0px rgba(0,0,0,0.25);">
            <img class="w-24 mb-4" src="{{ asset('assets/img/logo/logoBgWhite.png') }}" alt="">
            <p>SISTEM MANAGEMEN</p>
            <div class="flex justify-between items-center w-full">
                <span class="w-18 h-1 bg-white"></span>
                KARYAWAN
                <span class="w-18 h-1 bg-white"></span>
            </div>
        </div>
        <div class="bg-secondary-2 w-full h-103 py-5"
            style="box-shadow: 0 -4px 4px rgba(0, 0, 0, 0.25), 0 4px 4px rgba(0, 0, 0, 0.25);">
            <div class="w-full flex flex-col justify-start items-center gap-2">
                <a href="/admin/" class="w-full">
                    <div class="border-y border-white w-full h-12 px-3 flex justify-start items-center gap-6">
                        <svg width="23" height="23" viewBox="0 0 23 23" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M17.25 15.0938H18.6875V18.6875H17.25V15.0938ZM14.375 11.5H15.8125V18.6875H14.375V11.5ZM7.90625 18.6875C6.95348 18.6864 6.04006 18.3074 5.36635 17.6337C4.69263 16.9599 4.31364 16.0465 4.3125 15.0938H5.75C5.75 15.5202 5.87646 15.9371 6.11339 16.2917C6.35033 16.6463 6.68709 16.9227 7.08109 17.0859C7.47509 17.2491 7.90864 17.2918 8.32691 17.2086C8.74518 17.1254 9.12939 16.92 9.43095 16.6184C9.73251 16.3169 9.93787 15.9327 10.0211 15.5144C10.1043 15.0961 10.0616 14.6626 9.89837 14.2686C9.73516 13.8746 9.45879 13.5378 9.1042 13.3009C8.7496 13.064 8.33272 12.9375 7.90625 12.9375V11.5C8.85937 11.5 9.77346 11.8786 10.4474 12.5526C11.1214 13.2265 11.5 14.1406 11.5 15.0938C11.5 16.0469 11.1214 16.961 10.4474 17.6349C9.77346 18.3089 8.85937 18.6875 7.90625 18.6875Z"
                                fill="white" />
                            <path
                                d="M20.125 1.4375H2.875C2.49375 1.4375 2.12812 1.58895 1.85853 1.85853C1.58895 2.12812 1.4375 2.49375 1.4375 2.875V20.125C1.4375 20.5062 1.58895 20.8719 1.85853 21.1415C2.12812 21.411 2.49375 21.5625 2.875 21.5625H20.125C20.5061 21.5619 20.8714 21.4103 21.1408 21.1408C21.4103 20.8714 21.5619 20.5061 21.5625 20.125V2.875C21.5625 2.49375 21.411 2.12812 21.1415 1.85853C20.8719 1.58895 20.5062 1.4375 20.125 1.4375ZM20.125 7.90625H10.0625V2.875H20.125V7.90625ZM8.625 2.875V7.90625H2.875V2.875H8.625ZM2.875 20.125V9.34375H20.125L20.1264 20.125H2.875Z"
                                fill="white" />
                        </svg>
                        <p>DASHBOARD</p>
                    </div>
                </a>
                <a href="/admin/dataKaryawan" class="w-full">
                    <div class="border-y border-white w-full h-12 px-3 flex justify-start items-center gap-6">
                        <svg width="23" height="23" viewBox="0 0 23 23" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M17.25 15.0938H18.6875V18.6875H17.25V15.0938ZM14.375 11.5H15.8125V18.6875H14.375V11.5ZM7.90625 18.6875C6.95348 18.6864 6.04006 18.3074 5.36635 17.6337C4.69263 16.9599 4.31364 16.0465 4.3125 15.0938H5.75C5.75 15.5202 5.87646 15.9371 6.11339 16.2917C6.35033 16.6463 6.68709 16.9227 7.08109 17.0859C7.47509 17.2491 7.90864 17.2918 8.32691 17.2086C8.74518 17.1254 9.12939 16.92 9.43095 16.6184C9.73251 16.3169 9.93787 15.9327 10.0211 15.5144C10.1043 15.0961 10.0616 14.6626 9.89837 14.2686C9.73516 13.8746 9.45879 13.5378 9.1042 13.3009C8.7496 13.064 8.33272 12.9375 7.90625 12.9375V11.5C8.85937 11.5 9.77346 11.8786 10.4474 12.5526C11.1214 13.2265 11.5 14.1406 11.5 15.0938C11.5 16.0469 11.1214 16.961 10.4474 17.6349C9.77346 18.3089 8.85937 18.6875 7.90625 18.6875Z"
                                fill="white" />
                            <path
                                d="M20.125 1.4375H2.875C2.49375 1.4375 2.12812 1.58895 1.85853 1.85853C1.58895 2.12812 1.4375 2.49375 1.4375 2.875V20.125C1.4375 20.5062 1.58895 20.8719 1.85853 21.1415C2.12812 21.411 2.49375 21.5625 2.875 21.5625H20.125C20.5061 21.5619 20.8714 21.4103 21.1408 21.1408C21.4103 20.8714 21.5619 20.5061 21.5625 20.125V2.875C21.5625 2.49375 21.411 2.12812 21.1415 1.85853C20.8719 1.58895 20.5062 1.4375 20.125 1.4375ZM20.125 7.90625H10.0625V2.875H20.125V7.90625ZM8.625 2.875V7.90625H2.875V2.875H8.625ZM2.875 20.125V9.34375H20.125L20.1264 20.125H2.875Z"
                                fill="white" />
                        </svg>
                        <p>DATA KARYAWAN</p>
                    </div>
                </a>
                <a href="/admin/upah" class="w-full">
                    <div class="border-y border-white w-full h-12 px-3 flex justify-start items-center gap-6">
                        <svg width="23" height="23" viewBox="0 0 23 23" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M17.25 15.0938H18.6875V18.6875H17.25V15.0938ZM14.375 11.5H15.8125V18.6875H14.375V11.5ZM7.90625 18.6875C6.95348 18.6864 6.04006 18.3074 5.36635 17.6337C4.69263 16.9599 4.31364 16.0465 4.3125 15.0938H5.75C5.75 15.5202 5.87646 15.9371 6.11339 16.2917C6.35033 16.6463 6.68709 16.9227 7.08109 17.0859C7.47509 17.2491 7.90864 17.2918 8.32691 17.2086C8.74518 17.1254 9.12939 16.92 9.43095 16.6184C9.73251 16.3169 9.93787 15.9327 10.0211 15.5144C10.1043 15.0961 10.0616 14.6626 9.89837 14.2686C9.73516 13.8746 9.45879 13.5378 9.1042 13.3009C8.7496 13.064 8.33272 12.9375 7.90625 12.9375V11.5C8.85937 11.5 9.77346 11.8786 10.4474 12.5526C11.1214 13.2265 11.5 14.1406 11.5 15.0938C11.5 16.0469 11.1214 16.961 10.4474 17.6349C9.77346 18.3089 8.85937 18.6875 7.90625 18.6875Z"
                                fill="white" />
                            <path
                                d="M20.125 1.4375H2.875C2.49375 1.4375 2.12812 1.58895 1.85853 1.85853C1.58895 2.12812 1.4375 2.49375 1.4375 2.875V20.125C1.4375 20.5062 1.58895 20.8719 1.85853 21.1415C2.12812 21.411 2.49375 21.5625 2.875 21.5625H20.125C20.5061 21.5619 20.8714 21.4103 21.1408 21.1408C21.4103 20.8714 21.5619 20.5061 21.5625 20.125V2.875C21.5625 2.49375 21.411 2.12812 21.1415 1.85853C20.8719 1.58895 20.5062 1.4375 20.125 1.4375ZM20.125 7.90625H10.0625V2.875H20.125V7.90625ZM8.625 2.875V7.90625H2.875V2.875H8.625ZM2.875 20.125V9.34375H20.125L20.1264 20.125H2.875Z"
                                fill="white" />
                        </svg>
                        <p>UPAH KARYAWAN</p>
                    </div>
                </a>
                <a href="/admin/dataKaryawan" class="w-full">
                    <div class="border-y border-white w-full h-12 px-3 flex justify-start items-center gap-6">
                        <svg width="23" height="23" viewBox="0 0 23 23" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M17.25 15.0938H18.6875V18.6875H17.25V15.0938ZM14.375 11.5H15.8125V18.6875H14.375V11.5ZM7.90625 18.6875C6.95348 18.6864 6.04006 18.3074 5.36635 17.6337C4.69263 16.9599 4.31364 16.0465 4.3125 15.0938H5.75C5.75 15.5202 5.87646 15.9371 6.11339 16.2917C6.35033 16.6463 6.68709 16.9227 7.08109 17.0859C7.47509 17.2491 7.90864 17.2918 8.32691 17.2086C8.74518 17.1254 9.12939 16.92 9.43095 16.6184C9.73251 16.3169 9.93787 15.9327 10.0211 15.5144C10.1043 15.0961 10.0616 14.6626 9.89837 14.2686C9.73516 13.8746 9.45879 13.5378 9.1042 13.3009C8.7496 13.064 8.33272 12.9375 7.90625 12.9375V11.5C8.85937 11.5 9.77346 11.8786 10.4474 12.5526C11.1214 13.2265 11.5 14.1406 11.5 15.0938C11.5 16.0469 11.1214 16.961 10.4474 17.6349C9.77346 18.3089 8.85937 18.6875 7.90625 18.6875Z"
                                fill="white" />
                            <path
                                d="M20.125 1.4375H2.875C2.49375 1.4375 2.12812 1.58895 1.85853 1.85853C1.58895 2.12812 1.4375 2.49375 1.4375 2.875V20.125C1.4375 20.5062 1.58895 20.8719 1.85853 21.1415C2.12812 21.411 2.49375 21.5625 2.875 21.5625H20.125C20.5061 21.5619 20.8714 21.4103 21.1408 21.1408C21.4103 20.8714 21.5619 20.5061 21.5625 20.125V2.875C21.5625 2.49375 21.411 2.12812 21.1415 1.85853C20.8719 1.58895 20.5062 1.4375 20.125 1.4375ZM20.125 7.90625H10.0625V2.875H20.125V7.90625ZM8.625 2.875V7.90625H2.875V2.875H8.625ZM2.875 20.125V9.34375H20.125L20.1264 20.125H2.875Z"
                                fill="white" />
                        </svg>
                        <p>DATA BARANG</p>
                    </div>
                </a>
            </div>
            <div class="flex justify-center items-center w-full mt-14">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M5 21C4.45 21 3.97933 20.8043 3.588 20.413C3.19667 20.0217 3.00067 19.5507 3 19V5C3 4.45 3.196 3.97933 3.588 3.588C3.98 3.19667 4.45067 3.00067 5 3H12V5H5V19H12V21H5ZM16 17L14.625 15.55L17.175 13H9V11H17.175L14.625 8.45L16 7L21 12L16 17Z"
                        fill="white" />
                </svg>
                <button id="logoutButton" class="">Log Out</button>

            </div>
        </div>
    </section>

    <section class="w-full">
        <nav id="navbar" class="z-40 w-full bg-white sm:fixed sm:top-0 h-15 px-10 sm:px-6 flex sm:justify-between justify-end items-center "
            style="box-shadow: 0px 4px 4px 0px rgba(0,0,0,0.25);">
            <button id="menu-toggle" class="sm:block hidden focus:outline-none">
                <svg class="w-8 h-8" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.33334 6.5H21.6667M4.33334 10.8333H21.6667M4.33334 15.1667H21.6667M4.33334 19.5H21.6667" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
            <div class="flex justify-end items-center gap-3 h-full">
                <div class="flex flex-col justify-center items-center sm:items-end">
                    <h1>Nama Lengkap</h1>
                    <p>Role</p>
                </div>
                <div class="aspect-1/1 w-11 bg-primary-1 rounded-full"></div>
            </div>
        </nav>

        <div class="w-full p-5 sm:mt-15 {{ $contentClass ?? '' }}">
            {{ $slot }}
        </div>

    </section>

    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const sidebar = document.getElementById('menu');
        const body = document.querySelector('body');

        menuToggle.addEventListener('click', () => {
            console.log("clicked");
            sidebar.classList.toggle('sm:-translate-x-full')
        });

        body.addEventListener('click', (e) => {
            if (!sidebar.contains(e.target) && !menuToggle.contains(e.target)) {
                sidebar.classList.add('sm:-translate-x-full')
            }
        });

        sidebar.addEventListener('click', (e) => {
            e.stopPropagation();
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
    
</body>

</html>