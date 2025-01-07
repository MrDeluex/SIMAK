<x-layout.landingPage customClass="relative">
    <div class="sticky top-0 z-50">
        <nav id="navbar"
            class="text-white font-white flex justify-center sm:justify-between items-center pt-4 px-8 sm:px-4 text-2xl font-reguler relative top-0 left-0 w-full transition-transform duration-300"
            style="background: rgb(217,217,217); background: linear-gradient(180deg, rgba(217,217,217,1) 0%, rgba(217,217,217,0.8) 55%, rgba(255,255,255,0) 100%);">
            <!-- Logo -->
            <a href="/">
                <img class="w-19 sm:w-6 hidden sm:block" src="{{ asset('assets/img/logo/logoBgWhite.png?v=1') }}" alt="Logo">
            </a>

            <!-- Hamburger Icon (Mobile) -->
            <button id="menu-toggle" class="sm:block hidden focus:outline-none">
                <svg class="w-8 h-8" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.33334 6.5H21.6667M4.33334 10.8333H21.6667M4.33334 15.1667H21.6667M4.33334 19.5H21.6667" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>

            <!-- Desktop Navigation -->
            <div id="menu" class="flex sm:hidden space-x-16">
                <div class="w-108 sm:w-32 flex justify-around items-center">
                    <a class="" href="/">Home</a>
                    <a class="" href="#about">About</a>
                </div>
                <!-- Logo -->
                <a href="/">
                    <img class="w-19 sm:w-6" src="{{ asset('assets/img/logo/logoBgWhite.png?v=1') }}" alt="Logo">
                </a>
                <div class="w-108 sm:w-32 flex justify-around items-center">
                    <a class="#advantages" href="">Advantages</a>
                    <a class="#contact" href="">Contact</a>
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
        <a href="/home" class="py-2">Home</a>
        <a href="#about" class="py-2">About</a>
        <a href="#advantages" class="py-2">Adventages</a>
        <a href="#contact" class="py-2">Contact</a>
    </div>

    {{-- HEADER --}}
    <section
        class="text-white pl-32 sm:pl-0 mt-18 sm:mt-8 mb-14 sm:mb-12 flex flex-col justify-center gap-8 sm:gap-2 sm:items-center">
        <h1 class="text-8xl font-extralight sm:text-2xl">SIMAK</h1>
        <p class="text-3.5xl w-170 font-extralight mx-20 sm:mx-0 sm:w-59 sm:text-center sm:text-xxs">Lorem ipsum dolor
            sit amet, consectetur adipiscing elit. Sed
            do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad</p>
        <a href="/login"><button
            class="h-30 sm:h-6 w-140 sm:w-33 font-light text-3.5xl sm:text-xxs border border-white rounded-full bg-primary-2">JOIN
            WITH US
            RIGHT NOW!</button></a>
    </section>

    {{-- ABOUT --}}
    <section id="about" class="w-full bg-white flex justify-center items-center gap-50 sm:gap-9 py-28 sm:py-10">
        <div class="">
            <div class="w-112 h-112 sm:w-37 sm:h-37 rounded-full bg-primary-1"></div>
        </div>
        <div class="flex flex-col gap-6 sm:gap-2">
            <h2 class="text-2xl sm:text-xxs sm:leading-tight">LOREM</h2>
            <h1 class="text-4xl ml-12 sm:ml-3 font-medium sm:text-xxs sm:leading-tight">LOREM IPSUM DOLOR</h1>
            <p class="w-124 sm:w-45 text-2xl sm:text-xxs sm:leading-normal font-extralight  ">Lorem ipsum dolor sit
                amet, consectetur adipiscing elit. Sed do
                eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                reprehenderit in voluptate velit esse</p>
        </div>
    </section>

    {{-- ADVENTAGES --}}
    <section id="advantages" class="flex flex-col py-8">
        <h1 class="text-center text-6.5xl sm:text-2xl tracking-widest sm:tracking-normal">ADVANTAGES</h1>
        <div class="flex justify-center items-end flex-wrap my-6 gap-12">
            <div
                class="aspect-32/19 sm:h-38 h-60 rounded-2xl bg-primary-4 filter drop-shadow-1 relative mt-30 sm:mt-24">
                <div
                    class="aspect-1/1 sm:h-38 h-60 rounded-full absolute top-min30 sm:top-min19 filter drop-shadow-2 bg-primary-4 left-1/2 transform -translate-x-1/2">
                </div>
                <h1
                    class="text-6xl sm:text-2xl font-extralight absolute bottom-8 sm:bottom-4 left-0 right-0 text-center">
                    LOREM</h1>
            </div>
            <div
                class="aspect-32/19 sm:h-38 h-60 rounded-2xl bg-primary-4 filter drop-shadow-1 relative mt-30 sm:mt-24">
                <div
                    class="aspect-1/1 sm:h-38 h-60 rounded-full absolute top-min30 sm:top-min19 filter drop-shadow-2 bg-primary-4 left-1/2 transform -translate-x-1/2">
                </div>
                <h1
                    class="text-6xl sm:text-2xl font-extralight absolute bottom-8 sm:bottom-4 left-0 right-0 text-center">
                    LOREM</h1>
            </div>
            <div
                class="aspect-32/19 sm:h-38 h-60 rounded-2xl bg-primary-4 filter drop-shadow-1 relative mt-30 sm:mt-24">
                <div
                    class="aspect-1/1 sm:h-38 h-60 rounded-full absolute top-min30 sm:top-min19 filter drop-shadow-2 bg-primary-4 left-1/2 transform -translate-x-1/2">
                </div>
                <h1
                    class="text-6xl sm:text-2xl font-extralight absolute bottom-8 sm:bottom-4 left-0 right-0 text-center">
                    LOREM</h1>
            </div>
        </div>
    </section>

    <div class="w-full h-12 bg-white"></div>

    <section class="text-center flex flex-col justify-center items-center py-44 sm:py-14 gap-8 sm:gap-4">
        <h1 class="text-6.5xl sm:text-2xl mb-2">JOIN WITH US</h1>
        <h2 class="text-2xl sm:text-base w-212 sm:w-95 font-light">Lorem ipsum dolor sit amet, consectetur adipiscing
            elit. Sed do eiusmod
            tempor incididunt ut</h2>
            <a href="/login"><button class="text-4xl sm:text-base w-86 sm:w-56 h-18 sm:h-9 border-black border rounded-full">SIGN IN</button></a>
    </section>

    <section id="contact"
        class="bg-white flex flex-col md:flex-col md:flex-wrap h-220 sm:h-full py-20 sm:py-10 px-10 sm:px-5 sm:gap-12">
        <!-- Div 1 -->
        <div class=" flex flex-col justify-start items-center text-center pt-12 gap-4 sm:order-1 sm:w-full">
            <h1 class="text-6.5xl sm:text-2xl mb-4">CONTACT</h1>
            <p class="text-3.5xl sm:text-base font-extralight w-154 sm:w-58">lorem ipsum dolor sit amet, consectetur
                adipiscing elit, Sed do
                eiusmod tempor incididunt</p>
        </div>

        <!-- Div 3 -->
        <div class=" sm:order-3 pt-5  w-154 flex flex-col text-center gap-5 sm:w-full">
            <div class="flex flex-col items-center gap-2">
                <div class="flex items-center">
                    <svg class="w-10 sm:w-6" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M20.5 10.8333C21.6051 10.8333 22.6649 11.2722 23.4463 12.0536C24.2277 12.835 24.6667 13.8949 24.6667 14.9999C24.6667 15.5471 24.5589 16.0889 24.3495 16.5944C24.1401 17.1 23.8332 17.5593 23.4463 17.9462C23.0594 18.3331 22.6001 18.64 22.0946 18.8494C21.589 19.0588 21.0472 19.1666 20.5 19.1666C19.395 19.1666 18.3352 18.7276 17.5538 17.9462C16.7724 17.1648 16.3334 16.105 16.3334 14.9999C16.3334 13.8949 16.7724 12.835 17.5538 12.0536C18.3352 11.2722 19.395 10.8333 20.5 10.8333ZM20.5 3.33325C23.5942 3.33325 26.5617 4.56242 28.7496 6.75034C30.9375 8.93826 32.1667 11.9057 32.1667 14.9999C32.1667 23.7499 20.5 36.6666 20.5 36.6666C20.5 36.6666 8.83337 23.7499 8.83337 14.9999C8.83337 11.9057 10.0625 8.93826 12.2505 6.75034C14.4384 4.56242 17.4058 3.33325 20.5 3.33325ZM20.5 6.66659C18.2899 6.66659 16.1703 7.54456 14.6075 9.10736C13.0447 10.6702 12.1667 12.7898 12.1667 14.9999C12.1667 16.6666 12.1667 19.9999 20.5 31.1833C28.8334 19.9999 28.8334 16.6666 28.8334 14.9999C28.8334 12.7898 27.9554 10.6702 26.3926 9.10736C24.8298 7.54456 22.7102 6.66659 20.5 6.66659Z"
                            fill="black" />
                    </svg>
                    <h2 class="text-3.5xl sm:text-2xl font-light">ADDRES</h2>
                </div>
                <p class="text-2xl sm:text-base font-extralight">Loren ipsun Dolor Sit Amet Con</p>
            </div>
            <div class="flex flex-col items-center gap-2">
                <div class="flex items-center">
                    <svg class="w-10 sm:w-6" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M28 2.5C28.663 2.5 29.2989 2.76339 29.7678 3.23223C30.2366 3.70107 30.5 4.33696 30.5 5V35C30.5 35.663 30.2366 36.2989 29.7678 36.7678C29.2989 37.2366 28.663 37.5 28 37.5H13C12.337 37.5 11.7011 37.2366 11.2322 36.7678C10.7634 36.2989 10.5 35.663 10.5 35V5C10.5 4.33696 10.7634 3.70107 11.2322 3.23223C11.7011 2.76339 12.337 2.5 13 2.5H28ZM13 0C11.6739 0 10.4021 0.526784 9.46447 1.46447C8.52678 2.40215 8 3.67392 8 5V35C8 36.3261 8.52678 37.5979 9.46447 38.5355C10.4021 39.4732 11.6739 40 13 40H28C29.3261 40 30.5979 39.4732 31.5355 38.5355C32.4732 37.5979 33 36.3261 33 35V5C33 3.67392 32.4732 2.40215 31.5355 1.46447C30.5979 0.526784 29.3261 0 28 0L13 0Z"
                            fill="black" />
                        <path
                            d="M20.5 35C21.163 35 21.7989 34.7366 22.2678 34.2678C22.7366 33.7989 23 33.163 23 32.5C23 31.837 22.7366 31.2011 22.2678 30.7322C21.7989 30.2634 21.163 30 20.5 30C19.837 30 19.2011 30.2634 18.7322 30.7322C18.2634 31.2011 18 31.837 18 32.5C18 33.163 18.2634 33.7989 18.7322 34.2678C19.2011 34.7366 19.837 35 20.5 35Z"
                            fill="black" />
                    </svg>
                    <h2 class="text-3.5xl sm:text-2xl font-light">
                        PHONE NUMBER
                    </h2>
                </div>
                <p class="text-2xl sm:text-base font-extralight">Loren ipsun Dolor Sit Amet Con</p>
            </div>
            <div class="flex flex-col items-center gap-2">
                <div class="flex items-center gap-1">
                    <svg class="w-8 sm:w-6" viewBox="0 0 36 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M35.5 3.625C35.5 1.63125 33.925 0 32 0H4C2.075 0 0.5 1.63125 0.5 3.625V25.375C0.5 27.3687 2.075 29 4 29H32C33.925 29 35.5 27.3687 35.5 25.375V3.625ZM32 3.625L18 12.6875L4 3.625H32ZM32 25.375H4V7.25L18 16.3125L32 7.25V25.375Z"
                            fill="black" />
                    </svg>
                    <h2 class="text-3.5xl sm:text-2xl font-light">
                        EMAIL ADDRES
                    </h2>
                </div>
                <p class="text-2xl sm:text-base font-extralight">Loren ipsun Dolor Sit Amet Con</p>
            </div>
        </div>

        <!-- Div 2 -->
        <div class=" w-169 sm:order-2 h-full sm:w-full">
            <div class="w-full border border-black rounded-3xl flex flex-col justify-start items-center p-12 sm:p-6">
                <h1 class="text-6.5xl sm:text-3.5xl mb-20 sm:mb-10">CONTACT FORM</h1>
                <form action="" class="flex flex-col gap-12 w-full items-center ">
                    <input type="text" placeholder="Enter Your Name"
                        class="text-3.5xl sm:text-base font-extralight border-b rounded-lg px-4 border-black w-full">
                    <input type="email" placeholder="Enter a Valid Email Addres"
                        class="text-3.5xl sm:text-base font-extralight border-b rounded-lg px-4 border-black w-full">
                    <input type="text" placeholder="Enter Yout Massage"
                        class="text-3.5xl sm:text-base font-extralight border-b rounded-lg px-4 border-black w-full">

                    <button type="submit"
                        class="w-86 sm:w-39 h-17 sm:h-8 border-black border-2 rounded-full text-4xl sm:text-base">SUBMIT</button>
                </form>
            </div>
        </div>

    </section>
</x-layout.landingPage>
