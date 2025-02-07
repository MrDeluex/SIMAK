<x-layout.adminPage contentClass="flex flex-col justify-start items-center">
    <h1 class="text-2xl font-reguler mb-10">INPUT UPAH KARYAWAN</h1>
    <form action="" class="w-full" id="upahForm">
        <div class="w-full p-10 flex flex-col justify-start items-start gap-8"
            style="box-shadow: 4px 0px 4px 0px rgba(0,0,0,0.25), -4px 0px 4px 0px rgba(0,0,0,0.25), 0px 4px 4px 0px rgba(0,0,0,0.25), 0px -4px 4px 0px rgba(0,0,0,0.25);">
            <div class="w-full h-15 border-2 border-black rounded-xl flex items-center px-4">
                <div class="relative w-full">
                    <select id="karyawan_id" name="karyawan_id"
                        class="form-select peer w-full bg-transparent focus:outline-none focus:ring-0 focus:border-b-2 focus:border-black transition-all duration-250">
                        <option value="Karyawann Id">Nama Karyawan</option>
                    </select>
                    <label for="karyawan_id"
                        class="form-label absolute text-gray-400 transform -translate-y-10 scale-100 transition-all duration-500 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-gray-400 peer-focus:-translate-y-10 peer-focus:scale-125 peer-focus:text-black pointer-events-none"
                        style="top: 0; left: 0;">
                        Pilih Karyawan
                    </label>
                </div>
            </div>
            <div class="w-full h-15 border-2 border-black rounded-xl flex items-center px-4">
                <div class="relative w-full">
                    <input type="date" placeholder="Periode Mulai" id="periode_mulai"
                        class="form-input peer w-full focus:outline-none focus:ring-0 focus:border-b-2 focus:border-black transition-all duration-250 placeholder-transparent" />
                    <label for=""
                        class="form-label absolute text-gray-400 transform -translate-y-10 scale-100 transition-all duration-500 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-gray-400 peer-focus:-translate-y-10 peer-focus:scale-125 peer-focus:text-black pointer-events-none"
                        style="top: 0; left: 0;">
                        Periode Mulai
                    </label>
                </div>
            </div>

            <div class="w-full flex justify-between items-center">
                <button class="px-10 py-1 rounded bg-secondary-2 text-white">Kembali</button>
                <button class="px-10 py-1 rounded bg-secondary-2 text-white">Tambah</button>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", async function() {
            try {
                let response = await fetch("http://localhost:8080/api/admin/karyawan", {
                    method: "GET",
                    headers: {
                        "Content-Type": "application/json",
                        "Authorization": "Bearer " + '{{ session("api_token") }}'
                    }
                });


                if (!response.ok) throw new Error("Gagal mengambil data");

                let data = await response.json();

                let select = document.getElementById("karyawan_id");
                select.innerHTML = '<option value="" disabled selected>Pilih Karyawan</option>'; // Reset opsi

                // Simpan data user ke array untuk referensi nanti
                window.karyawansData = data.data;

                data.data.forEach(karyawan => {
                    let option = document.createElement("option");
                    option.value = karyawan.id;
                    option.textContent = karyawan.nama;
                    select.appendChild(option);
                });

            } catch (error) {
                console.error("Error:", error);
            }
        });
    </script>

    <script>
        document.getElementById("upahForm").addEventListener("submit", async function(e) {
            e.preventDefault(); // Mencegah reload

            // Ambil data dari form
            let karyawan_id = document.getElementById("karyawan_id").value;
            let periode_mulai = document.getElementById("periode_mulai").value;
            
            // Data yang akan dikirim ke API
            let data = {
                karyawan_id: karyawan_id,
                periode_mulai: periode_mulai,
            };

            console.log(data);

            try {
                let response = await fetch("http://localhost:8080/api/admin/upah", { // Ganti dengan URL API-mu
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
                    alert("User berhasil ditambahkan!");
                    window.location.href = "/admin/upah"; // Redirect setelah berhasil
                } else {
                    alert("Gagal menambahkan upah: " + result.message);
                }
            } catch (error) {
                alert("Terjadi kesalahan: " + error.message);
            }
        });
    </script>
</x-layout.adminPage>