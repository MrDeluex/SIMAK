<x-layout.userPage contentClass="flex flex-col justify-between items-center gap-7">
    <input type="file" id="uploadInput" accept="image/*" style="display: none" />

    <div class="w-full flex sm:flex-wrap-reverse justify-between items-center">
        <div class="w-full h-71 sm:h-auto border sm:py-10 px-10 sm:px-4 border-black rounded-xl flex sm:flex-wrap justify-between sm:justify-center items-center gap-8">
            <div id="foto_profile" class="w-52 h-52 bg-primary-3 rounded-full border-2 border-black"></div>
            <div class="flex-grow sm:w-full h-full flex flex-col justify-center items-center gap-6">
                <h1 class="text-2xl">YOUR PROFILE</h1>
                <div class="w-full flex flex-col gap-3">
                    <div class="w-full flex justify-start items-center gap-4">
                        <Label class="font-light w-auto">NAMA :</Label>
                        <input id="namaUser" type="text" disable name="nama" class="flex-grow border-b border-black">
                    </div>
                    <div class="w-full flex justify-start items-center gap-4">
                        <Label class="font-light w-auto">EMAIL :</Label>
                        <input id="emailUser" type="text" disable name="nama" class="flex-grow border-b border-black">
                    </div>
                    <div class="w-full flex justify-start items-center gap-4">
                        <Label class="font-light w-auto">ROLE :</Label>
                        <input id="roleUser" type="text" disable name="nama" class="flex-grow border-b border-black">
                    </div>
                </div>
            </div>
        </div>
        <img class="w-40 h-40 mx-32 sm:mx-auto sm:my-24" src="{{ asset('assets/img/logo/logoBgWhite.png') }}" alt="">
    </div>

    <div class="w-full h-76 border border-black rounded-xl flex flex-col justify-between items-center gap-10 py-6"
        style="box-shadow: 4px 4px 4px 0px rgba(0,0,0,0.25);">
        <h1 class="text-2xl">EDIT YOUR PASSWORD</h1>
        <form id="passwordForm" class="w-full px-8 flex flex-col justify-center items-start gap-4">
            <div class="w-full flex sm:flex-col justify-start items-center sm:items-start gap-4">
                <Label class="font-light w-auto">Old Password <span class="sm:hidden">:</span></Label>
                <input type="text" name="oldPassword" id="oldPassword" class="flex-grow sm:w-full border border-black rounded-md">
            </div>
            <div class="w-full flex sm:flex-col justify-start items-center sm:items-start gap-4">
                <Label class="font-light w-auto">New Password <span class="sm:hidden">:</span></Label>
                <input type="text" name="newPassword" id="newPassword" class="flex-grow sm:w-full border border-black rounded-md">
            </div>
            <div class="w-full flex sm:flex-col justify-start items-center sm:items-start gap-4">
                <Label class="font-light w-auto">New Password Confirmation <span class="sm:hidden">:</span></Label>
                <input type="text" name="confirmPassword" id="confirmPassword" class="flex-grow sm:w-full border border-black rounded-md">
            </div>

            <p id="errorMessage" class="text-red-500 text-center w-full hidden">Passwords do not match!</p>
            <div class="w-full justify-center items-center flex gap-10">
                <a href="{{ url()->previous() }}" class="font-light text-white text-2xl sm:text-base w-43 sm:w-36 h-10 sm:h-10 rounded-full bg-custom-1 flex items-center justify-center">
                    <p>Back</p>
                </a>
                <button type="submit"
                    class="font-light text-white text-2xl sm:text-base w-43 sm:w-36 h-10 sm:h-10 rounded-full bg-secondary-2">Confirm</button>

            </div>
        </form>
    </div>

    <script>
        async function fetchUser() {
            try {
                const response = await fetch('http://localhost:8080/api/profile', {
                        method: 'GET',
                        headers: {
                            'Authorization': 'Bearer ' + '{{ session("api_token") }}'
                        }
                    });

                const data = await response.json();
                console.log('Data:', data);

                const namaUser = document.getElementById('namaUser');
                if (namaUser) namaUser.value = data.data.nama_lengkap;

                const emailUser = document.getElementById('emailUser');
                if (emailUser) emailUser.value = data.data.email;

                const roleUser = document.getElementById('roleUser');
                if (roleUser) roleUser.value = data.data.role;

                return data;
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        }

        fetchUser();
    </script>

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

            console.log(data);


            try {
                const response = await fetch("http://localhost:8080/api/users/change-password", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Authorization": "Bearer {{ session('api_token') }}"
                    },
                    body: JSON.stringify(data)
                });
                console.log(response);


                const result = await response.json();
                console.log(result);

                if (response.ok) {
                    alert("Password berhasil diubah!");
                    location.reload(); // ini buat refresh halaman
                } else {
                    alert("Gagal ganti password: " + result.message);
                }
            } catch (error) {
                alert("Terjadi kesalahan: " + error.message);
            }
        });
    </script>

<script>
    const fotoDiv = document.getElementById('foto_profile');
    const fileInput = document.getElementById('uploadInput');

    // Klik div buat trigger file input
    fotoDiv.addEventListener('click', () => {
        fileInput.click();
    });

    // Upload otomatis saat file dipilih
    fileInput.addEventListener('change', async () => {
        const file = fileInput.files[0];
        if (!file) return;

        const formData = new FormData();
        formData.append('photo', file);

        try {
            const response = await fetch('http://localhost:8080/api/users/upload-photo', {
                method: 'POST',
                body: formData,
                credentials: 'include', 
                headers: {
                        "Content-Type": "application/json",
                        "Authorization": "Bearer {{ session('api_token') }}"
                    },
            });

            const data = await response.json();
            console.log(data);

            // Ganti preview profil jadi gambar yang dipilih
            const reader = new FileReader();
            reader.onload = function (e) {
                fotoDiv.style.backgroundImage = `url('${e.target.result}')`;
            };
            reader.readAsDataURL(file);

        } catch (err) {
            console.error('Gagal upload foto:', err);
        }
    });
</script>

</x-layout.userPage>