<x-layout.adminPage contentClass="flex flex-col justify-start items-center">
    <h1 class="text-2xl font-reguler mb-10">INPUT DATA USER</h1>
    <form id="userForm" class="w-full">
        <div class="w-full p-10 flex flex-col justify-start items-start gap-8"
            style="box-shadow: 4px 0px 4px 0px rgba(0,0,0,0.25), -4px 0px 4px 0px rgba(0,0,0,0.25), 0px 4px 4px 0px rgba(0,0,0,0.25), 0px -4px 4px 0px rgba(0,0,0,0.25);">
            <div class="w-full h-15 border-2 border-black rounded-xl flex items-center px-4">
                <div class="relative w-full">
                    <input type="text" placeholder="Nama Lengkap" id="nama_lengkap" name="nama_lengkap"
                        class="form-input peer w-full focus:outline-none focus:ring-0 focus:border-b-2 focus:border-black transition-all duration-250 placeholder-transparent" />
                    <label for=""
                        class="form-label absolute text-gray-400 transform -translate-y-10 scale-100 transition-all duration-500 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-gray-400 peer-focus:-translate-y-10 peer-focus:scale-125 peer-focus:text-black pointer-events-none"
                        style="top: 0; left: 0;">
                        Nama Lengkap
                    </label>
                </div>
            </div>
            <div class="w-full h-15 border-2 border-black rounded-xl flex items-center px-4">
                <div class="relative w-full">
                    <input type="text" placeholder="Email" id="email" name="email"
                        class="form-input peer w-full focus:outline-none focus:ring-0 focus:border-b-2 focus:border-black transition-all duration-250 placeholder-transparent" />
                    <label for=""
                        class="form-label absolute text-gray-400 transform -translate-y-10 scale-100 transition-all duration-500 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-gray-400 peer-focus:-translate-y-10 peer-focus:scale-125 peer-focus:text-black pointer-events-none"
                        style="top: 0; left: 0;">
                        Email
                    </label>
                </div>
            </div>
            <div class="w-full h-15 border-2 border-black rounded-xl flex items-center px-4">
                <div class="relative w-full">
                    <input type="text" placeholder="Nomor Handphone" id="nomor_hp" name="nomor_hp"
                        class="form-input peer w-full focus:outline-none focus:ring-0 focus:border-b-2 focus:border-black transition-all duration-250 placeholder-transparent" />
                    <label for=""
                        class="form-label absolute text-gray-400 transform -translate-y-10 scale-100 transition-all duration-500 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-gray-400 peer-focus:-translate-y-10 peer-focus:scale-125 peer-focus:text-black pointer-events-none"
                        style="top: 0; left: 0;">
                        Nomor Handphone
                    </label>
                </div>
            </div>
            <div class="w-full h-15 border-2 border-black rounded-xl flex items-center px-4">
                <div class="relative w-full">
                    <select id="role" name="role"
                        class="form-select peer w-full bg-transparent focus:outline-none focus:ring-0 focus:border-b-2 focus:border-black transition-all duration-250">
                        <option value="StaffProduksi">Staff Produksi</option>
                        <option value="StaffAdministrasi">Staff Administrasi</option>
                    </select>
                    <label for="role"
                        class="form-label absolute text-gray-400 transform -translate-y-10 scale-100 transition-all duration-500 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-gray-400 peer-focus:-translate-y-10 peer-focus:scale-125 peer-focus:text-black pointer-events-none"
                        style="top: 0; left: 0;">
                        Jabatan
                    </label>
                </div>
            </div>

            <div class="w-full flex justify-between items-center">
                <button class="px-10 py-1 rounded bg-button-false text-white">Kembali</button>
                <button type="submit" class="px-10 py-1 rounded bg-button-true text-white">Tambah</button>
            </div>
        </div>
    </form>
    <script>
        document.getElementById("userForm").addEventListener("submit", async function(e) {
            e.preventDefault(); // Mencegah reload

            // Ambil data dari form
            let nama = document.getElementById("nama_lengkap").value;
            let email = document.getElementById("email").value;
            let nomor_hp = document.getElementById("nomor_hp").value;
            let role = document.getElementById("role").value;

            // Data yang akan dikirim ke API
            let data = {
                nama_lengkap: nama,
                email: email,
                nomor_hp: nomor_hp,
                role: role
            };

            try {
                let response = await fetch("https://backend-simak.trihech.my.id/api/admin/users", { // Ganti dengan URL API-mu
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        'Authorization': 'Bearer ' + '{{ session("api_token") }}' // Kalau butuh token
                    },
                    body: JSON.stringify(data)
                });

                let result = await response.json();
                console.log(result);


                if (response.ok) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'User berhasil ditambahkan!',
                        icon: 'success',
                        confirmButtonText: 'Oke'
                    }).then(() => {
                        window.location.href = "/admin/users"; // Redirect setelah klik "Oke"
                    });
                } else {
                    Swal.fire({
                        title: 'Gagal!',
                        text: result.message || 'Gagal menambahkan user.',
                        icon: 'error',
                        confirmButtonText: 'Tutup'
                    });
                }
            } catch (error) {
                Swal.fire({
                    title: 'Error!',
                    text: error.message || 'Terjadi kesalahan.',
                    icon: 'error',
                    confirmButtonText: 'Tutup'
                });
            }
        });
    </script>
</x-layout.adminPage>