<x-layout.administrasiPage contentClass="flex flex-col justify-start items-center">
    <h1 class="text-2xl font-reguler mb-10">INPUT DATA KARYAWAN</h1>
    <form id="editForm" class="w-full">
        @csrf
        <div class="w-full p-10 flex flex-col justify-start items-start gap-8"
            style="box-shadow: 4px 0px 4px 0px rgba(0,0,0,0.25), -4px 0px 4px 0px rgba(0,0,0,0.25), 0px 4px 4px 0px rgba(0,0,0,0.25), 0px -4px 4px 0px rgba(0,0,0,0.25);">
            <div class="w-full h-15 border-2 border-black rounded-xl flex items-center px-4">
                <div class="relative w-full">
                    <input type="text" placeholder="Nama" id="nama" name="nama"
                        class="form-input peer w-full focus:outline-none focus:ring-0 focus:border-b-2 focus:border-black transition-all duration-250 placeholder-transparent" />
                    <label for=""
                        class="form-label absolute text-gray-400 transform -translate-y-10 scale-100 transition-all duration-500 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-gray-400 peer-focus:-translate-y-10 peer-focus:scale-125 peer-focus:text-black pointer-events-none"
                        style="top: 0; left: 0;">
                        Nama
                    </label>
                </div>
            </div>
            <div class="w-full h-15 border-2 border-black rounded-xl flex items-center px-4">
                <div class="relative w-full">
                    <input type="text" placeholder="Pekerjaan" id="pekerjaan" name="pekerjaan"
                        class="form-input peer w-full focus:outline-none focus:ring-0 focus:border-b-2 focus:border-black transition-all duration-250 placeholder-transparent" />
                    <label for=""
                        class="form-label absolute text-gray-400 transform -translate-y-10 scale-100 transition-all duration-500 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-gray-400 peer-focus:-translate-y-10 peer-focus:scale-125 peer-focus:text-black pointer-events-none"
                        style="top: 0; left: 0;">
                        Pekerjaan
                    </label>
                </div>
            </div>

            <div class="w-full h-15 border-2 border-black rounded-xl flex items-center px-4">
                <div class="relative w-full">
                    <input type="text" placeholder="Alamat" id="alamat" name="alamat"
                        class="form-input peer w-full focus:outline-none focus:ring-0 focus:border-b-2 focus:border-black transition-all duration-250 placeholder-transparent" />
                    <label for="Alamat"
                        class="form-label absolute text-gray-400 transform -translate-y-10 scale-100 transition-all duration-500 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-gray-400 peer-focus:-translate-y-10 peer-focus:scale-125 peer-focus:text-black pointer-events-none"
                        style="top: 0; left: 0;">
                        Alamat
                    </label>
                </div>
            </div>



            <div class="w-full flex justify-between items-center">
                <button class="px-10 py-1 rounded bg-button-false text-white" onclick="window.location.href='/staffAdministrasi/users'">Kembali</button>
                <button type="submit" class="px-10 py-1 rounded bg-button-true text-white">Update</button>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let karyawan = JSON.parse(sessionStorage.getItem("editKaryawan"));

            if (karyawan) {
                document.getElementById("nama").value = karyawan.data.nama;
                document.getElementById("pekerjaan").value = karyawan.data.pekerjaan;
                document.getElementById("alamat").value = karyawan.data.alamat;
            } else {
                alert("Data Karyawan tidak ditemukan!");
                window.location.href = "/staffAdministrasi/staff-produksi"; // Redirect jika tidak ada data
            }

            document.getElementById("editForm").addEventListener("submit", async function(e) {
                e.preventDefault();

                let karyawanId = karyawan.data.id
                let nama = document.getElementById("nama").value;
                let pekerjaan = document.getElementById("pekerjaan").value;
                let alamat = document.getElementById("alamat").value;

                let data = {
                    nama: nama,
                    pekerjaan: pekerjaan,
                    alamat: alamat,
                };

                try {
                    let response = await fetch(
                        `http://localhost:8080/api/staff-administrasi/staff-produksi/${karyawanId}`, {
                            method: "PUT",
                            headers: {
                                "Content-Type": "application/json",
                                "Authorization": "Bearer " + '{{ session('
                                api_token ') }}'
                            },
                            body: JSON.stringify(data)
                        });

                    let result = await response.json();

                    if (response.ok) {
                        // Menampilkan SweetAlert jika berhasil memperbarui
                        Swal.fire({
                            title: 'Berhasil!',
                            text: "Karyawan berhasil diperbarui!",
                            icon: 'success',
                            confirmButtonText: 'Oke'
                        }).then(() => {
                            // Redirect ke halaman /staffAdministrasi/karyawan setelah klik 'Oke'
                            window.location.href = "/staffAdministrasi/karyawan";
                        });
                    } else {
                        // Menampilkan SweetAlert jika gagal memperbarui
                        Swal.fire({
                            title: 'Gagal!',
                            text: "Gagal memperbarui Karyawan: " + result.message,
                            icon: 'error',
                            confirmButtonText: 'Tutup'
                        });
                    }
                } catch (error) {
                    // Menampilkan SweetAlert jika terjadi error saat eksekusi
                    Swal.fire({
                        title: 'Error!',
                        text: "Terjadi kesalahan: " + error.message,
                        icon: 'error',
                        confirmButtonText: 'Tutup'
                    });
                }
            });
        });
    </script>


</x-layout.administrasiPage>