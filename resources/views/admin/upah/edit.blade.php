<x-layout.adminPage contentClass="flex flex-col justify-start items-center">
    <style>
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>

    <h1 class="text-2xl font-reguler mb-10">Input Data Upah Mingguan</h1>
    <form class="w-full" id="inputForm">
        <div class="w-full p-10 flex flex-col justify-start items-start gap-8"
            style="box-shadow: 4px 0px 4px 0px rgba(0,0,0,0.25), -4px 0px 4px 0px rgba(0,0,0,0.25), 0px 4px 4px 0px rgba(0,0,0,0.25), 0px -4px 4px 0px rgba(0,0,0,0.25);">

            <!-- ID Karyawan -->
            <div class="w-full h-15 border-2 border-black rounded-xl flex items-center px-4">
                <div class="relative w-full">
                    <select id="id_karyawan" name="id_karyawan"
                        class="form-select peer w-full bg-transparent focus:outline-none focus:ring-0 focus:border-b-2 focus:border-black transition-all duration-250">
                        <option value="">Pilih Karyawan</option>
                        <!-- Tambahkan opsi sesuai data karyawan -->
                    </select>
                    <label class="form-label absolute text-gray-400 transform -translate-y-10 scale-100 transition-all duration-500"
                        style="top: 0; left: 0;">
                        Pilih Karyawan
                    </label>
                </div>
            </div>

            <!-- Minggu ke -->
            <div class="w-full h-15 border-2 border-black rounded-xl flex items-center px-4">
                <div class="relative w-full">
                    <input type="number" id="minggu_ke" name="minggu_ke"
                        class="form-input peer w-full focus:outline-none focus:ring-0 focus:border-b-2 focus:border-black transition-all duration-250 placeholder-transparent" />
                    <label class="form-label absolute text-gray-400 transform -translate-y-10 scale-100 transition-all duration-500"
                        style="top: 0; left: 0;">
                        Minggu Ke-
                    </label>
                </div>
            </div>

            <!-- Total Dikerjakan -->
            <div class="w-full h-15 border-2 border-black rounded-xl flex items-center px-4">
                <div class="relative w-full">
                    <input type="number" id="total_dikerjakan" name="total_dikerjakan"
                        class="form-input peer w-full focus:outline-none focus:ring-0 focus:border-b-2 focus:border-black transition-all duration-250 placeholder-transparent" />
                    <label class="form-label absolute text-gray-400 transform -translate-y-10 scale-100 transition-all duration-500"
                        style="top: 0; left: 0;">
                        Total Dikerjakan
                    </label>
                </div>
                <p class="tracking-wider">KODI</p>
            </div>

            <!-- Total Upah -->
            <div class="w-full h-15 border-2 border-black rounded-xl flex items-center px-4">
                <div class="relative w-full">
                    <input type="number" id="total_upah" name="total_upah"
                        class="form-input peer w-full focus:outline-none focus:ring-0 focus:border-b-2 focus:border-black transition-all duration-250 placeholder-transparent" />
                    <label class="form-label absolute text-gray-400 transform -translate-y-10 scale-100 transition-all duration-500"
                        style="top: 0; left: 0;">
                        Total Upah (Rp)
                    </label>
                </div>
            </div>

            <!-- Periode Mulai dan Selesai -->
            <div class="flex justify-between w-full gap-10">
                <div class="w-full h-15 border-2 border-black rounded-xl flex items-center px-4">
                    <div class="relative w-full">
                        <input type="date" id="periode_mulai" name="periode_mulai"
                            class="form-input peer w-full focus:outline-none focus:ring-0 focus:border-b-2 focus:border-black transition-all duration-250 placeholder-transparent" />
                        <label class="form-label absolute text-gray-400 transform -translate-y-10 scale-100 transition-all duration-500"
                            style="top: 0; left: 0;">
                            Periode Mulai
                        </label>
                    </div>
                </div>

                <div class="w-full h-15 border-2 border-black rounded-xl flex items-center px-4">
                    <div class="relative w-full">
                        <input type="date" id="periode_selesai" name="periode_selesai"
                            class="form-input peer w-full focus:outline-none focus:ring-0 focus:border-b-2 focus:border-black transition-all duration-250 placeholder-transparent" />
                        <label class="form-label absolute text-gray-400 transform -translate-y-10 scale-100 transition-all duration-500"
                            style="top: 0; left: 0;">
                            Periode Selesai
                        </label>
                    </div>
                </div>
            </div>

            <!-- Tombol -->
            <div class="w-full flex justify-between items-center">
                <button type="button" class="px-10 py-1 rounded bg-button-false text-white" onclick="window.location.href='/admin/upah'">Kembali</button>
                <button type="submit" class="px-10 py-1 rounded bg-secondary-2 text-white">Simpan</button>
            </div>
        </div>
    </form>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const data = sessionStorage.getItem("editUpah");

            if (!data) {
                alert("Data upah tidak ditemukan.");
                return;
            }

            const result = JSON.parse(data);
            const upah = result.data.upah;
            const selectedId = upah.staff_produksi_id;

            async function loadStaffProduksi(selectedId) {
                try {
                    const res = await fetch("https://backend-simak.trihech.my.id/api/admin/staff-produksi", {
                        headers: {
                            "Authorization": "Bearer {{ session('api_token') }}"
                        }
                    });

                    const result = await res.json();
                    const staffSelect = document.getElementById("id_karyawan");

                    staffSelect.innerHTML = '<option value="" disabled>Pilih Karyawan</option>' +
                        result.data.map(staff =>
                            `<option value="${staff.id}" ${staff.id == selectedId ? "selected" : ""}>${staff.nama}</option>`
                        ).join("");
                } catch (error) {
                    console.error("Error fetching staff produksi:", error);
                }
            }

            loadStaffProduksi(selectedId);

            document.getElementById("minggu_ke").value = upah.minggu_ke;
            document.getElementById("total_dikerjakan").value = upah.total_dikerjakan;
            document.getElementById("total_upah").value = upah.total_upah;
            document.getElementById("periode_mulai").value = upah.periode_mulai.split('T')[0];
            document.getElementById("periode_selesai").value = upah.periode_selesai.split('T')[0];

            // Simpan ID upah ke variabel global
            window.upahId = upah.id;
        });

        // Submit form
        document.getElementById("inputForm").addEventListener("submit", async function(e) {
            e.preventDefault();

            const id = window.upahId;
            console.log(id);


            const payload = {
                id_karyawan: document.getElementById("id_karyawan").value,
                minggu_ke: document.getElementById("minggu_ke").value,
                total_dikerjakan: document.getElementById("total_dikerjakan").value,
                total_upah: document.getElementById("total_upah").value,
                periode_mulai: document.getElementById("periode_mulai").value,
                periode_selesai: document.getElementById("periode_selesai").value
            };

            console.log(payload);


            try {
                const response = await fetch(`https://backend-simak.trihech.my.id/api/admin/upah/${id}`, {
                    method: "PUT",
                    headers: {
                        "Content-Type": "application/json",
                        "Authorization": "Bearer " + '{{ session("api_token") }}'
                    },
                    body: JSON.stringify(payload)
                });

                Swal.fire({
                    title: 'Berhasil!',
                    text: "Data berhasil diupdate!",
                    icon: 'success',
                    confirmButtonText: 'Oke'
                }).then(() => {
                    window.location.href = "/admin/upah"; // Redirect setelah SweetAlert ditutup
                });
            } catch (error) {
                console.error("Error updating data:", error);
                // Menampilkan SweetAlert jika terjadi error
                Swal.fire({
                    title: 'Error!',
                    text: "Terjadi kesalahan: " + error.message,
                    icon: 'error',
                    confirmButtonText: 'Tutup'
                });
            }
        });
    </script>
</x-layout.adminPage>