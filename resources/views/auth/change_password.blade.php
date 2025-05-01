<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        <form id="reset-form" action="{{ route('login') }}" method="post" class="sm:w-screen flex justify-center px-3">
            @csrf
            <div class="w-194 sm:w-full filter bg-white flex flex-col justify-center items-center gap-8 py-10 sm:px-8 px-36"
                style="box-shadow: 0 0 5px 5px rgba(0, 0, 0, 0.5);">
                <div class="w-full h-15 border-2 sm:border border-black rounded-xl flex items-center px-4 gap-6">
                    <svg width="23" height="22" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M28 2.5C28.663 2.5 29.2989 2.76339 29.7678 3.23223C30.2366 3.70107 30.5 4.33696 30.5 5V35C30.5 35.663 30.2366 36.2989 29.7678 36.7678C29.2989 37.2366 28.663 37.5 28 37.5H13C12.337 37.5 11.7011 37.2366 11.2322 36.7678C10.7634 36.2989 10.5 35.663 10.5 35V5C10.5 4.33696 10.7634 3.70107 11.2322 3.23223C11.7011 2.76339 12.337 2.5 13 2.5H28ZM13 0C11.6739 0 10.4021 0.526784 9.46447 1.46447C8.52678 2.40215 8 3.67392 8 5V35C8 36.3261 8.52678 37.5979 9.46447 38.5355C10.4021 39.4732 11.6739 40 13 40H28C29.3261 40 30.5979 39.4732 31.5355 38.5355C32.4732 37.5979 33 36.3261 33 35V5C33 3.67392 32.4732 2.40215 31.5355 1.46447C30.5979 0.526784 29.3261 0 28 0L13 0Z" fill="black" />
                        <path d="M20.5 35C21.163 35 21.7989 34.7366 22.2678 34.2678C22.7366 33.7989 23 33.163 23 32.5C23 31.837 22.7366 31.2011 22.2678 30.7322C21.7989 30.2634 21.163 30 20.5 30C19.837 30 19.2011 30.2634 18.7322 30.7322C18.2634 31.2011 18 31.837 18 32.5C18 33.163 18.2634 33.7989 18.7322 34.2678C19.2011 34.7366 19.837 35 20.5 35Z" fill="black" />
                    </svg>

                    <div class="relative w-full">
                        <input type="number" placeholder="Code" id="code" name="code"
                            class="form-input peer w-full focus:outline-none focus:ring-0 focus:border-b-2 focus:border-black transition-all duration-250 placeholder-transparent" />
                        <label for="code"
                            class="form-label absolute text-gray-400 transform -translate-y-10 -translate-x-10 scale-100 transition-all duration-500 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:translate-x-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-gray-400 peer-focus:-translate-y-10 peer-focus:-translate-x-10 peer-focus:scale-125 peer-focus:text-black pointer-events-none"
                            style="top: 0; left: 0;">
                            Code
                        </label>
                    </div>
                </div>
                <div class="w-full h-15 border-2 sm:border border-black rounded-xl flex items-center px-4 gap-6">
                    <svg width="23" height="22" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M28 2.5C28.663 2.5 29.2989 2.76339 29.7678 3.23223C30.2366 3.70107 30.5 4.33696 30.5 5V35C30.5 35.663 30.2366 36.2989 29.7678 36.7678C29.2989 37.2366 28.663 37.5 28 37.5H13C12.337 37.5 11.7011 37.2366 11.2322 36.7678C10.7634 36.2989 10.5 35.663 10.5 35V5C10.5 4.33696 10.7634 3.70107 11.2322 3.23223C11.7011 2.76339 12.337 2.5 13 2.5H28ZM13 0C11.6739 0 10.4021 0.526784 9.46447 1.46447C8.52678 2.40215 8 3.67392 8 5V35C8 36.3261 8.52678 37.5979 9.46447 38.5355C10.4021 39.4732 11.6739 40 13 40H28C29.3261 40 30.5979 39.4732 31.5355 38.5355C32.4732 37.5979 33 36.3261 33 35V5C33 3.67392 32.4732 2.40215 31.5355 1.46447C30.5979 0.526784 29.3261 0 28 0L13 0Z" fill="black" />
                        <path d="M20.5 35C21.163 35 21.7989 34.7366 22.2678 34.2678C22.7366 33.7989 23 33.163 23 32.5C23 31.837 22.7366 31.2011 22.2678 30.7322C21.7989 30.2634 21.163 30 20.5 30C19.837 30 19.2011 30.2634 18.7322 30.7322C18.2634 31.2011 18 31.837 18 32.5C18 33.163 18.2634 33.7989 18.7322 34.2678C19.2011 34.7366 19.837 35 20.5 35Z" fill="black" />
                    </svg>

                    <div class="relative w-full">
                        <input type="password" placeholder="New Password" id="password" name="password"
                            class="form-input peer w-full focus:outline-none focus:ring-0 focus:border-b-2 focus:border-black transition-all duration-250 placeholder-transparent" />
                        <label for="password"
                            class="form-label absolute text-gray-400 transform -translate-y-10 -translate-x-10 scale-100 transition-all duration-500 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:translate-x-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-gray-400 peer-focus:-translate-y-10 peer-focus:-translate-x-10 peer-focus:scale-125 peer-focus:text-black pointer-events-none"
                            style="top: 0; left: 0;">
                            New Password
                        </label>
                    </div>
                </div>
                <div class="w-full h-15 border-2 sm:border border-black rounded-xl flex items-center px-4 gap-6">
                    <svg width="23" height="22" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M28 2.5C28.663 2.5 29.2989 2.76339 29.7678 3.23223C30.2366 3.70107 30.5 4.33696 30.5 5V35C30.5 35.663 30.2366 36.2989 29.7678 36.7678C29.2989 37.2366 28.663 37.5 28 37.5H13C12.337 37.5 11.7011 37.2366 11.2322 36.7678C10.7634 36.2989 10.5 35.663 10.5 35V5C10.5 4.33696 10.7634 3.70107 11.2322 3.23223C11.7011 2.76339 12.337 2.5 13 2.5H28ZM13 0C11.6739 0 10.4021 0.526784 9.46447 1.46447C8.52678 2.40215 8 3.67392 8 5V35C8 36.3261 8.52678 37.5979 9.46447 38.5355C10.4021 39.4732 11.6739 40 13 40H28C29.3261 40 30.5979 39.4732 31.5355 38.5355C32.4732 37.5979 33 36.3261 33 35V5C33 3.67392 32.4732 2.40215 31.5355 1.46447C30.5979 0.526784 29.3261 0 28 0L13 0Z" fill="black" />
                        <path d="M20.5 35C21.163 35 21.7989 34.7366 22.2678 34.2678C22.7366 33.7989 23 33.163 23 32.5C23 31.837 22.7366 31.2011 22.2678 30.7322C21.7989 30.2634 21.163 30 20.5 30C19.837 30 19.2011 30.2634 18.7322 30.7322C18.2634 31.2011 18 31.837 18 32.5C18 33.163 18.2634 33.7989 18.7322 34.2678C19.2011 34.7366 19.837 35 20.5 35Z" fill="black" />
                    </svg>

                    <div class="relative w-full">
                        <input type="password" placeholder="Confirm Password" id="password_confirmation" name="password_confirmation"
                            class="form-input peer w-full focus:outline-none focus:ring-0 focus:border-b-2 focus:border-black transition-all duration-250 placeholder-transparent" />
                        <label for="password_confirmation"
                            class="form-label absolute text-gray-400 transform -translate-y-10 -translate-x-10 scale-100 transition-all duration-500 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:translate-x-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-gray-400 peer-focus:-translate-y-10 peer-focus:-translate-x-10 peer-focus:scale-125 peer-focus:text-black pointer-events-none"
                            style="top: 0; left: 0;">
                            Confirm Password
                        </label>
                    </div>
                </div>
                <div class="w-full flex flex-col items-center justify-center gap-4">
                    <p id="error-message" style="color: red;"></p>
                    <button type="submit" class="text-2xl sm:text-base sm:font-extralight w-79 h-14 border-2 sm:border border-black rounded-full">SUBMIT</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        const form = document.getElementById('reset-form');
        const nomorHp = sessionStorage.getItem('nomor_hp');
        console.log(nomorHp);

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const data = {
                nomor_hp: nomorHp,
                code: form.code.value,
                password: form.password.value,
                password_confirmation: form.password_confirmation.value,
            };
            console.log(data);


            try {
                const response = await fetch('http://localhost:8080/api/users/forgot-password/reset', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();
                console.log(result);
                

                if (response.ok) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Password berhasil direset!',
                        icon: 'success',
                        confirmButtonText: 'Oke'
                    });
                } else {
                    Swal.fire({
                        title: 'Gagal!',
                        text: result.message || 'Ada kesalahan saat reset password.',
                        icon: 'error',
                        confirmButtonText: 'Tutup'
                    });
                }
            } catch (error) {
                Swal.fire({
                    title: 'Error!',
                    text: error.message || 'Terjadi kesalahan saat menghubungi server.',
                    icon: 'error',
                    confirmButtonText: 'Tutup'
                });
            }
        });
    </script>
</body>

</html>