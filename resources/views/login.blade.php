<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/app.css')

    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo/logoBgWhite.png?v=1') }}">
    <title>SIMAK</title>

<body class="bg-white max-w-screen min-h-screen font-sans overflow-x-hidden ">
    <div id="bg" class="flex justify-center items-center h-screen w-screen fixed gap-8 sm:gap-4 z-0">
        <div class="w-8 h-screen bg-secondary-2"></div>
        <div class="w-126 sm:w-52 h-screen bg-secondary-2"></div>
        <div class="w-8 h-screen bg-secondary-2"></div>
    </div>
    <div class="z-10 flex flex-col justify-center items-center py-10 w-screen absolute gap-8">
        <img class="aspect-1/1 w-38 rounded-full" src="{{ asset('assets/img/logo/logoBgWhite.png?v=1') }}"
            alt="Logo">
        <h1 class="text-3.5xl sm:text-2xl text-white sm:w-46 text-center">LOGIN TO YOUR ACCOUNT</h1>
        <form id="login-form" class="sm:w-screen flex justify-center px-3">
            <div class="w-194 sm:w-full filter bg-white flex flex-col justify-center items-center gap-8 py-8 sm:px-8 px-36"
            style="box-shadow: 0 0 5px 5px rgba(0, 0, 0, 0.5);">
                <div class="w-full h-15 border-2 sm:border border-black rounded-xl flex items-center px-4 gap-6">
                    <svg width="23" height="23" viewBox="0 0 36 29" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M35.5 3.625C35.5 1.63125 33.925 0 32 0H4C2.075 0 0.5 1.63125 0.5 3.625V25.375C0.5 27.3687 2.075 29 4 29H32C33.925 29 35.5 27.3687 35.5 25.375V3.625ZM32 3.625L18 12.6875L4 3.625H32ZM32 25.375H4V7.25L18 16.3125L32 7.25V25.375Z"
                            fill="black" />
                    </svg>
                    <div class="relative w-full">
                        <input type="text" placeholder="Username" id="username"
                            class="form-input peer w-full focus:outline-none focus:ring-0 focus:border-b-2 focus:border-black transition-all duration-250 placeholder-transparent" />
                        <label for="username"
                            class="form-label absolute text-gray-400 transform -translate-y-10 -translate-x-10 scale-100 transition-all duration-500 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:translate-x-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-gray-400 peer-focus:-translate-y-10 peer-focus:-translate-x-10 peer-focus:scale-125 peer-focus:text-black pointer-events-none"
                            style="top: 0; left: 0;">
                            Username
                        </label>
                    </div>
                </div>
                <div class="w-full h-15 border-2 sm:border border-black rounded-xl flex items-center px-4 gap-6">
                    <svg width="23" height="23" viewBox="0 0 36 29" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M35.5 3.625C35.5 1.63125 33.925 0 32 0H4C2.075 0 0.5 1.63125 0.5 3.625V25.375C0.5 27.3687 2.075 29 4 29H32C33.925 29 35.5 27.3687 35.5 25.375V3.625ZM32 3.625L18 12.6875L4 3.625H32ZM32 25.375H4V7.25L18 16.3125L32 7.25V25.375Z"
                            fill="black" />
                    </svg>
                    <div class="relative w-full">
                        <input type="text" placeholder="Email" id="email"
                            class="form-input peer w-full focus:outline-none focus:ring-0 focus:border-b-2 focus:border-black transition-all duration-250 placeholder-transparent" />
                        <label for="email"
                            class="form-label absolute text-gray-400 transform -translate-y-10 -translate-x-10 scale-100 transition-all duration-500 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:translate-x-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-gray-400 peer-focus:-translate-y-10 peer-focus:-translate-x-10 peer-focus:scale-125 peer-focus:text-black pointer-events-none"
                            style="top: 0; left: 0;">
                            Email
                        </label>
                    </div>
                </div>
                <div class="w-full h-15 border-2 sm:border border-black rounded-xl flex items-center px-4 gap-6">
                    <svg width="23" height="23" viewBox="0 0 36 29" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M35.5 3.625C35.5 1.63125 33.925 0 32 0H4C2.075 0 0.5 1.63125 0.5 3.625V25.375C0.5 27.3687 2.075 29 4 29H32C33.925 29 35.5 27.3687 35.5 25.375V3.625ZM32 3.625L18 12.6875L4 3.625H32ZM32 25.375H4V7.25L18 16.3125L32 7.25V25.375Z"
                            fill="black" />
                    </svg>
                    <div class="relative w-full">
                        <input type="password" placeholder="Password" id="password"
                            class="form-input peer w-full focus:outline-none focus:ring-0 focus:border-b-2 focus:border-black transition-all duration-250 placeholder-transparent" />
                        <label for="name"
                            class="form-label absolute text-gray-400 transform -translate-y-10 -translate-x-10 scale-100 transition-all duration-500 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:translate-x-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-gray-400 peer-focus:-translate-y-10 peer-focus:-translate-x-10 peer-focus:scale-125 peer-focus:text-black pointer-events-none"
                            style="top: 0; left: 0;">
                            
                            Password
                        </label>
                    </div>
                </div>
                {{-- <a href="">FORGOT YOUR PASSWORD?</a> --}}
                <button type="submit" class="text-2xl sm:text-base sm:font-extralight w-79 h-14 border-2 sm:border border-black rounded-full">SIGN IN</button>
            </div>
        </form>
    </div>
    
</body>

</html>
