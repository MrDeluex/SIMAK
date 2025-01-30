<x-layout.adminPage contentClass="flex flex-col justify-start items-center">
    <h1 class="text-2xl font-reguler mb-10">EDIT DATA USER</h1>
    <form id="userForm" class="w-full">
        <div class="w-full p-10 flex flex-col justify-start items-start gap-8"
            style="box-shadow: 4px 0px 4px 0px rgba(0,0,0,0.25), -4px 0px 4px 0px rgba(0,0,0,0.25), 0px 4px 4px 0px rgba(0,0,0,0.25), 0px -4px 4px 0px rgba(0,0,0,0.25);">
            
            <input type="hidden" id="user_id" value="">

            <div class="w-full h-15 border-2 border-black rounded-xl flex items-center px-4">
                <div class="relative w-full">
                    <input type="text" id="nama_lengkap" name="nama_lengkap"
                        class="form-input peer w-full focus:outline-none focus:ring-0 focus:border-b-2 focus:border-black transition-all duration-250 placeholder-transparent"
                        value="" />
                    <label for="nama_lengkap"
                        class="form-label absolute text-gray-400 transform -translate-y-10 scale-100 transition-all duration-500 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-gray-400 peer-focus:-translate-y-10 peer-focus:scale-125 peer-focus:text-black pointer-events-none"
                        style="top: 0; left: 0;">
                        Nama Lengkap
                    </label>
                </div>
            </div>

            <div class="w-full h-15 border-2 border-black rounded-xl flex items-center px-4">
                <div class="relative w-full">
                    <input type="text" id="email" name="email"
                        class="form-input peer w-full focus:outline-none focus:ring-0 focus:border-b-2 focus:border-black transition-all duration-250 placeholder-transparent"
                        value=""/>
                    <label for="email"
                        class="form-label absolute text-gray-400 transform -translate-y-10 scale-100 transition-all duration-500 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-gray-400 peer-focus:-translate-y-10 peer-focus:scale-125 peer-focus:text-black pointer-events-none"
                        style="top: 0; left: 0;">
                        Email
                    </label>
                </div>
            </div>

            <div class="w-full h-15 border-2 border-black rounded-xl flex items-center px-4">
                <div class="relative w-full">
                    <select id="role" name="role"
                        class="form-select peer w-full bg-transparent focus:outline-none focus:ring-0 focus:border-b-2 focus:border-black transition-all duration-250">
                        <option value="Karyawan">Karyawan</option>
                        <option value="Staff">Staff</option>
                    </select>
                    <label for="role"
                        class="form-label absolute text-gray-400 transform -translate-y-10 scale-100 transition-all duration-500 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-gray-400 peer-focus:-translate-y-10 peer-focus:scale-125 peer-focus:text-black pointer-events-none"
                        style="top: 0; left: 0;">
                        Jabatan
                    </label>
                </div>
            </div>

            <div class="w-full flex justify-between items-center">
                <button class="px-10 py-1 rounded bg-secondary-2 text-white">Kembali</button>
                <button type="submit" class="px-10 py-1 rounded bg-secondary-2 text-white">Update</button>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let user = JSON.parse(sessionStorage.getItem("editUser"));

            if (user) {
                document.getElementById("user_id").value = user.id;
                document.getElementById("nama_lengkap").value = user.nama_lengkap;
                document.getElementById("email").value = user.email;
                document.getElementById("role").value = user.role;
            } else {
                alert("Data user tidak ditemukan!");
                window.location.href = "/admin/users"; // Redirect jika tidak ada data
            }

            document.getElementById("userForm").addEventListener("submit", async function (e) {
                e.preventDefault();

                let userId = document.getElementById("user_id").value;
                let nama = document.getElementById("nama_lengkap").value;
                let email = document.getElementById("email").value;
                let role = document.getElementById("role").value;

                let data = { nama_lengkap: nama, email: email, role: role };

                try {
                    let response = await fetch(`http://localhost:8080/api/admin/users/${userId}`, {
                        method: "PUT",
                        headers: {
                            "Content-Type": "application/json",
                            "Authorization": "Bearer " + '{{ session("api_token") }}'
                        },
                        body: JSON.stringify(data)
                    });

                    let result = await response.json();

                    if (response.ok) {
                        alert("User berhasil diperbarui!");
                        window.location.href = "/admin/users";
                    } else {
                        alert("Gagal memperbarui user: " + result.message);
                    }
                } catch (error) {
                    alert("Terjadi kesalahan: " + error.message);
                }
            });
        });
    </script>
</x-layout.adminPage>
