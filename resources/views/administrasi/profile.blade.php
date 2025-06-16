<x-layout.administrasiPage contentClass="flex flex-col justify-between items-center gap-7">
    <div class="w-full flex sm:flex-wrap-reverse justify-between items-center">
        <div class="w-189 h-71 sm:h-auto border sm:py-10 px-10 sm:px-4 border-black rounded-xl flex sm:flex-wrap justify-between sm:justify-center items-center gap-8">
            <img class="w-57 h-57 rounded-full border-2 border-black object-cover"
                src="{{ session('user')['foto_profile'] ?? asset('assets/img/profile/default.png') }}">
            <div class="flex-grow sm:w-full h-full flex flex-col justify-center items-center gap-6">
                <h1 class="text-2xl">YOUR PROFILE</h1>
                <form id="profileForm" class="w-full flex flex-col justify-center items-center gap-2">
                    <div class="w-full flex flex-col gap-3">
                        <input type="text" id="idUsers" class="hidden" value="{{ session('user')['id'] }}">
                        <div class="w-full flex justify-start items-center gap-4">
                            <Label class="font-light w-auto">NAMA :</Label>
                            <input type="text" name="nama" id="namaUser"
                                class="flex-grow border-b border-black px-1"
                                disabled>
                        </div>
                        <div class="w-full flex justify-start items-center gap-4">
                            <Label class="font-light w-auto">EMAIL :</Label>
                            <input type="text" name="email" id="emailUser"
                                class="flex-grow border-b border-black px-1"
                                disabled>
                        </div>
                        <div class="w-full flex justify-start items-center gap-4">
                            <Label class="font-light w-auto">ROLE :</Label>
                            <input type="text" name="role" id="roleUser"
                                class="flex-grow border-b border-black px-1"
                                disabled>
                        </div>
                    </div>
                    <button type="submit"
                        class="font-light text-white text-base sm:text-sm w-43 sm:w-36 py-1 rounded-full bg-secondary-2">Update</button>
                </form>
            </div>
        </div>
        <div class="flex-grow flex items-center justify-center ">
            <img class="w-49 h-49 sm:mx-auto sm:my-24" src="{{ asset('assets/img/logo/logoBgWhite.png') }}"
                alt="">
        </div>
    </div>

    <div class="w-full h-76 border border-black rounded-xl flex flex-col justify-between items-center gap-10 py-6"
        style="box-shadow: 4px 4px 4px 0px rgba(0,0,0,0.25);">
        <h1 class="text-2xl">EDIT YOUR PASSWORD</h1>
        <form id="passwordForm" class="w-full px-8 flex flex-col justify-center items-start gap-4">
            <div class="w-full flex sm:flex-col justify-start items-center sm:items-start gap-4">
                <label class="font-light w-auto">Old Password <span class="sm:hidden">:</span></label>
                <input type="password" name="oldPassword" id="oldPassword"
                    class="flex-grow sm:w-full border border-black px-2 py-1 rounded-md">
            </div>
            <div class="w-full flex sm:flex-col justify-start items-center sm:items-start gap-4">
                <label class="font-light w-auto">New Password <span class="sm:hidden">:</span></label>
                <input type="password" name="newPassword" id="newPassword"
                    class="flex-grow sm:w-full border border-black px-2 py-1 rounded-md">
            </div>
            <div class="w-full flex sm:flex-col justify-start items-center sm:items-start gap-4">
                <label class="font-light w-auto">New Password Confirmation <span class="sm:hidden">:</span></label>
                <input type="password" name="confirmPassword" id="confirmPassword"
                    class="flex-grow sm:w-full border border-black px-2 py-1 rounded-md">
            </div>
            <p id="errorMessage" class="text-red-500 text-center w-full hidden">Passwords do not match!</p>
            <div class="w-full justify-center items-center flex gap-10">
                <a href="/staffAdministrasi" class="font-light text-white text-2xl sm:text-base w-43 sm:w-36 h-10 sm:h-10 rounded-full bg-custom-1 flex items-center justify-center">
                    <p>Back</p>
                </a>
                <button type="submit"
                    class="font-light text-white text-2xl sm:text-base w-43 sm:w-36 h-10 sm:h-10 rounded-full bg-secondary-2">Confirm</button>

            </div>
        </form>
    </div>

    <script>
        document.getElementById("passwordForm").addEventListener("submit", async function(event) {
            event.preventDefault(); // Mencegah form terkirim langsung

            let oldPassword = document.getElementById("oldPassword").value;
            let newPassword = document.getElementById("newPassword").value;
            let confirmPassword = document.getElementById("confirmPassword").value;
            let errorMessage = document.getElementById("errorMessage");

            // Validasi new password dan confirm password
            if (newPassword !== confirmPassword) {
                errorMessage.classList.remove("hidden");
                errorMessage.innerText = "Password baru dan konfirmasi harus sama!";
                return;
            } else {
                errorMessage.classList.add("hidden");
            }

            // Data yang dikirim ke API
            const data = {
                old_password: oldPassword,
                new_password: newPassword,
                new_password_confirmation: confirmPassword,
            };

            try {
                const response = await fetch("http://backend-simak.trihech.my.id/api/users/change-password", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Authorization": "Bearer {{ session('api_token') }}"
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();
                console.log(result);

                response.json();

                if (response.ok) {
                    // Menampilkan SweetAlert untuk berhasil
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Password berhasil diubah!',
                        icon: 'success',
                        confirmButtonText: 'Oke'
                    });
                } else {
                    // Menampilkan SweetAlert jika gagal
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Gagal ganti password: ' + result.message,
                        icon: 'error',
                        confirmButtonText: 'Tutup'
                    });
                }
            } catch (error) {
                // Menampilkan SweetAlert jika terjadi error
                Swal.fire({
                    title: 'Error!',
                    text: 'Terjadi kesalahan: ' + error.message,
                    icon: 'error',
                    confirmButtonText: 'Tutup'
                });
            }
        });
    </script>

</x-layout.administrasiPage>