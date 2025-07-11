<x-layout.adminPage contentClass="flex flex-col justify-start items-center">
    <h1 class="text-2xl font-reguler mb-10">TAMBAH DATA KARYAWAN</h1>
    <form id="userForm" class="w-full">
        @csrf
        <div class="w-full p-10 flex flex-col justify-start items-start gap-8"
            style="box-shadow: 4px 0px 4px 0px rgba(0,0,0,0.25), -4px 0px 4px 0px rgba(0,0,0,0.25), 0px 4px 4px 0px rgba(0,0,0,0.25), 0px -4px 4px 0px rgba(0,0,0,0.25);">
            <div class="w-full h-15 border-2 border-black rounded-xl flex items-center px-4">
                <div class="relative w-full">
                    <select id="users_id" name="users_id"
                        class="form-select peer w-full bg-transparent focus:outline-none focus:ring-0 focus:border-b-2 focus:border-black transition-all duration-250">
                        <option value="id user">Loading...</option>
                    </select>
                    <label for="users_id"
                        class="form-label absolute text-gray-400 transform -translate-y-10 scale-100 transition-all duration-500 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-gray-400 peer-focus:-translate-y-10 peer-focus:scale-125 peer-focus:text-black pointer-events-none"
                        style="top: 0; left: 0;">
                        Akun User
                    </label>
                </div>
            </div>
            <div class="w-full h-15 border-2 border-black rounded-xl flex items-center px-4">
                <div class="relative w-full">
                    <select id="pekerjaan" name="pekerjaan"
                        class="form-select peer w-full bg-transparent focus:outline-none focus:ring-0 focus:border-b-2 focus:border-black transition-all duration-250">
                        <option value="Tukang Bawah">Tukang Bawah</option>
                        <option value="Tukang Jahit">Tukang Jahit</option>
                        <option value="Tukang Bensol">Tukang Bensol</option>
                    </select>
                    <label for="pekerjaan"
                        class="form-label absolute text-gray-400 transform -translate-y-10 scale-100 transition-all duration-500 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-gray-400 peer-focus:-translate-y-10 peer-focus:scale-125 peer-focus:text-black pointer-events-none"
                        style="top: 0; left: 0;">
                        Pekerjaan 
                    </label>
                </div>
            </div>
            <div class="w-full h-15 border-2 border-black rounded-xl flex items-center px-4">
                <div class="relative w-full">
                    <input type="date" placeholder="Tanggal Lahir" id="tanggal_lahir" name="tanggal_lahir"
                        class="form-input peer w-full focus:outline-none focus:ring-0 focus:border-b-2 focus:border-black transition-all duration-250 placeholder-transparent" />
                    <label for=""
                        class="form-label absolute text-gray-400 transform -translate-y-10 scale-100 transition-all duration-500 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-gray-400 peer-focus:-translate-y-10 peer-focus:scale-125 peer-focus:text-black pointer-events-none"
                        style="top: 0; left: 0;">
                        Tanggal Lahir
                    </label>
                </div>
            </div>
            <div class="w-full h-15 border-2 border-black rounded-xl flex items-center px-4">
                <div class="relative w-full">
                    <input type="text" placeholder="Alamat" id="alamat" name="alamat"
                        class="form-input peer w-full focus:outline-none focus:ring-0 focus:border-b-2 focus:border-black transition-all duration-250 placeholder-transparent" />
                    <label for=""
                        class="form-label absolute text-gray-400 transform -translate-y-10 scale-100 transition-all duration-500 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-gray-400 peer-focus:-translate-y-10 peer-focus:scale-125 peer-focus:text-black pointer-events-none"
                        style="top: 0; left: 0;">
                        Alamat
                    </label>
                </div>
            </div>

            <div class="w-full flex justify-between items-center">
                <button class="px-10 py-1 rounded bg-button-false text-white" onclick="window.location.href='/admin/users'">Kembali</button>
                <button type="submit" class="px-10 py-1 rounded bg-button-true text-white">Tambah</button>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", async function() {
            try {
                let response = await fetch("https://backend-simak.trihech.my.id/api/admin/users", {
                    method: "GET",
                    headers: {
                        "Content-Type": "application/json",
                        "Authorization": "Bearer " + '{{ session("api_token") }}'
                    }
                });

                if (!response.ok) throw new Error("Gagal mengambil data");

                let data = await response.json();

                let select = document.getElementById("users_id");
                select.innerHTML = '<option value="" disabled selected>Pilih User</option>'; // Reset opsi

                // Simpan data user ke array untuk referensi nanti
                window.usersData = data.data;

                data.data.forEach(user => {
                    let option = document.createElement("option");
                    option.value = user.id;
                    option.textContent = user.nama_lengkap;
                    select.appendChild(option);
                });

            } catch (error) {
                console.error("Error:", error);
            }
        });
    </script>



    <script>
        document.getElementById("userForm").addEventListener("submit", async function(e) {
            e.preventDefault();

            // Pastikan form ada
            const form = document.getElementById("userForm");
            if (!form) {
                console.error("Form tidak ditemukan!");
                return;
            }


            // Validasi input dengan pengecekan elemen
            const usersIdElement = document.getElementById("users_id");
            const pekerjaanElement = document.getElementById("pekerjaan");
            const tanggalLahirElement = document.getElementById("tanggal_lahir");
            const alamatElement = document.getElementById("alamat");

            const users_id = parseInt(usersIdElement.value);
            const pekerjaan = pekerjaanElement.value.trim();

            const rawTanggalLahir = tanggalLahirElement.value.trim();
            const tanggalObj = new Date(rawTanggalLahir);

            // Format ke dd/mm/yyyy
            const tanggal_lahir = tanggalObj.getDate().toString().padStart(2, '0') + '-' +
                (tanggalObj.getMonth() + 1).toString().padStart(2, '0') + '-' +
                tanggalObj.getFullYear();

            const alamat = alamatElement.value.trim();

            const user = window.usersData.find(user => user.id === users_id);
            const nama = user ? user.nama_lengkap : '';

            // Data yang akan dikirim
            const data = {
                users_id,
                nama, // Tambahkan nama_lengkap di sini
                tanggal_lahir,
                pekerjaan,
                alamat,
            };

            // Log data sebelum dikirim
            console.log("Mengirim data:", data);

            try {
                const response = await fetch("https://backend-simak.trihech.my.id/api/admin/staff-produksi", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Authorization": "Bearer {{ session('api_token') }}"
                    },
                    body: JSON.stringify(data)
                });

                // Log response status
                console.log("Response status:", response.status);

                if (!response.ok) {
                    const errorData = await response.json().catch(() => ({}));
                    throw new Error(errorData.message || `HTTP error! Status: ${response.status}`);
                }

                const result = await response.json();

                if (response.ok) {
                    // Menampilkan SweetAlert jika berhasil
                    Swal.fire({
                        title: 'Berhasil!',
                        text: "Data karyawan berhasil ditambahkan!",
                        icon: 'success',
                        confirmButtonText: 'Oke'
                    }).then(() => {
                        // Redirect ke halaman admin karyawan setelah pop-up ditutup
                        window.location.href = "/admin/karyawan";
                    });
                } else {
                    // Menampilkan SweetAlert jika gagal
                    Swal.fire({
                        title: 'Gagal!',
                        text: result.message || "Terjadi kesalahan",
                        icon: 'error',
                        confirmButtonText: 'Tutup'
                    });
                }
            } catch (error) {
                console.error("Error detail:", error);
                // Menampilkan SweetAlert jika terjadi error saat mengirim data
                Swal.fire({
                    title: 'Error!',
                    text: "Terjadi kesalahan: " + (error.message || "Unknown error"),
                    icon: 'error',
                    confirmButtonText: 'Tutup'
                });
            }
        });

        // Fungsi helper untuk validasi
        function isValidDate(dateString) {
            const date = new Date(dateString);
            return date instanceof Date && !isNaN(date);
        }

        function isValidPhone(phone) {
            // Sesuaikan dengan format nomor telepon yang diinginkan
            return /^[0-9]{10,13}$/.test(phone.replace(/[^0-9]/g, ''));
        }
    </script>


</x-layout.adminPage>