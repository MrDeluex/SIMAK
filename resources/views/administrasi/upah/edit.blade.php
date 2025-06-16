<x-layout.administrasiPage contentClass="flex flex-col justify-start items-center">
    <style>
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>

    <h1 class="text-2xl font-reguler mb-10">Edit Data upah</h1>
    <form action="" class="w-full" id="inputForm">
        <div class="w-full p-10 flex flex-col justify-start items-start gap-8"
            style="box-shadow: 4px 0px 4px 0px rgba(0,0,0,0.25), -4px 0px 4px 0px rgba(0,0,0,0.25), 0px 4px 4px 0px rgba(0,0,0,0.25), 0px -4px 4px 0px rgba(0,0,0,0.25);">

            <div class="w-full h-15 border-2 border-black rounded-xl flex items-center px-4">
                <div class="relative w-full">
                    <select id="staff_produksi_id" name="staff_produksi_id"
                        class="form-select peer w-full bg-transparent focus:outline-none focus:ring-0 focus:border-b-2 focus:border-black transition-all duration-250">
                        <option value="">Pilih Karyawan</option>
                    </select>
                    <label class="form-label absolute text-gray-400 transform -translate-y-10 scale-100 transition-all duration-500"
                        style="top: 0; left: 0;">
                        Pilih Karyawan
                    </label>
                </div>
            </div>

            <div class="w-full h-15 border-2 border-black rounded-xl flex items-center px-4">
                <div class="relative w-full">
                    <select id="barang_id" name="barang_id"
                        class="form-select peer w-full bg-transparent focus:outline-none focus:ring-0 focus:border-b-2 focus:border-black transition-all duration-250">
                        <option value="">Pilih Barang</option>
                    </select>
                    <label class="form-label absolute text-gray-400 transform -translate-y-10 scale-100 transition-all duration-500"
                        style="top: 0; left: 0;">
                        Pilih Barang
                    </label>
                </div>
            </div>

            <div class="flex justify-between w-full gap-10">

                <div class="w-full h-15 border-2 border-black rounded-xl flex items-center px-4">
                    <div class="relative w-full">
                        <input type="date" id="tanggal" name="tanggal"
                            class="form-input peer w-full focus:outline-none focus:ring-0 focus:border-b-2 focus:border-black transition-all duration-250 placeholder-transparent" />
                        <label class="form-label absolute text-gray-400 transform -translate-y-10 scale-100 transition-all duration-500"
                            style="top: 0; left: 0;">
                            Tanggal
                        </label>
                    </div>
                </div>

                <div class="w-80 h-15 border-2 border-black rounded-xl flex items-center px-4">
                    <div class="relative w-full">
                        <input type="number" id="jumlah_dikerjakan" name="jumlah_dikerjakan"
                            class="form-input peer w-full focus:outline-none focus:ring-0 focus:border-b-2 focus:border-black transition-all duration-250 placeholder-transparent" />
                        <label class="form-label absolute text-gray-400 transform -translate-y-10 scale-100 transition-all duration-500"
                            style="top: 0; left: 0;">
                            Jumlah Dikerjakan
                        </label>
                    </div>
                    <p class="tracking-wider">KODI</p>
                </div>

            </div>

            <div class="w-full flex justify-between items-center">
                <button type="button" class="px-10 py-1 rounded bg-button-false text-white" onclick="window.location.href='/staffAdministrasi/upah'">Kembali</button>
                <button type="submit" class="px-10 py-1 rounded bg-button-true text-white">Tambah</button>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", async function() {
            const form = document.getElementById("editForm");
            const staffSelect = document.getElementById("staff_produksi_id");

            let upah = JSON.parse(sessionStorage.getItem("editUpah"));

            if (upah) {
                document.getElementById("tanggal").value = upah.data.tanggal;
                document.getElementById("jumlah_dikerjakan").value = upah.data.jumlah_dikerjakan;
                document.getElementById("staff_produksi_id").innerHTML = '<option value="" disabled>Pilih Karyawan</option>' +
                    data.map(staff => `<option value="${upah.data.staff_produksi.id}" ${upah.data.staff_produksi.id == upah.data.staff_produksi.id ? "selected" : ""}>${upah.data.staff_produksi.nama}</option>`).join("");
            } else {
                alert("Data upah tidak ditemukan!");
                window.location.href = "/staffAdministrasi/upah"; // Redirect jika tidak ada data
            }

            async function loadStaffProduksi(selectedId) {
                try {
                    const res = await fetch("http://backend-simak.trihech.my.id/api/staff-administrasi/staff-produksi", {
                        headers: {
                            "Authorization": "Bearer {{ session('api_token') }}"
                        }
                    });
                    const data = await res.json();
                    staffSelect.innerHTML = '<option value="" disabled>Pilih Karyawan</option>' +
                        data.data.map(staff => `<option value="${staff.id}" ${staff.id == selectedId ? "selected" : ""}>${staff.nama}</option>`).join("");
                } catch (error) {
                    console.error("Error fetching staff produksi:", error);
                }
            }

            async function loadBarangProduksi(selectedId) {
                try {
                    const res = await fetch("http://backend-simak.trihech.my.id/api/staff-administrasi/barang", {
                        headers: {
                            "Authorization": "Bearer {{ session('api_token') }}"
                        }
                    });
                    const data = await res.json();
                    barangSelect.innerHTML = '<option value="" disabled>Pilih Barang</option>' +
                        data.data.map(barang => `<option value="${barang.id}" ${barang.id == selectedId ? "selected" : ""}>${barang.nama}</option>`).join("");
                } catch (error) {
                    console.error("Error fetching barang produksi:", error);
                }
            }

            loadData();

            form.addEventListener("submit", async function(event) {
                event.preventDefault();
                const formData = {
                    staff_produksi_id: staffSelect.value,
                    barang_id: barangSelect.value,
                    tanggal: document.getElementById("tanggal").value,
                    jumlah_dikerjakan: document.getElementById("jumlah_dikerjakan").value
                };

                try {
                    const res = await fetch(`http://backend-simak.trihech.my.id/api/staff-administrasi/barang-upah/${id}`, {
                        method: "PUT",
                        headers: {
                            "Content-Type": "application/json",
                            "Authorization": "Bearer {{ session('api_token') }}"
                        },
                        body: JSON.stringify(formData)
                    });
                    const result = await res.json();
                    if (response.ok) {
                        // Menampilkan SweetAlert untuk sukses
                        Swal.fire({
                            title: 'Berhasil!',
                            text: result.message || "Operasi berhasil!",
                            icon: 'success',
                            confirmButtonText: 'Oke'
                        }).then(() => {
                            window.location.href = "/staffAdministrasi/upah"; // Redirect ke halaman setelah berhasil
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
                    // Menampilkan SweetAlert jika terjadi kesalahan saat request
                    console.error("Error updating data:", error);
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