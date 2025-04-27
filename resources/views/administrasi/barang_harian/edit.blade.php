<x-layout.administrasiPage contentClass="flex flex-col justify-start items-center">
    <style>
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>

    <h1 class="text-2xl font-reguler mb-10">Edit Data Harian</h1>
    <form action="" class="w-full" id="editForm">
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
                <button type="button" class="px-10 py-1 rounded bg-secondary-2 text-white">Kembali</button>
                <button type="submit" class="px-10 py-1 rounded bg-secondary-2 text-white">Tambah</button>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", async function() {
            const form = document.getElementById("editForm");
            const staffSelect = document.getElementById("staff_produksi_id");
            const barangSelect = document.getElementById("barang_id");

            let harian = JSON.parse(sessionStorage.getItem("editHarian"));
            console.log(harian);

            let id = harian?.data?.id; // ambil ID dari data harian 

            if (harian) {
                document.getElementById("tanggal").value = harian.data.tanggal;
                document.getElementById("jumlah_dikerjakan").value = harian.data.jumlah_dikerjakan;
                loadStaffProduksi(harian.data.staff_produksi_id);
                loadBarangProduksi(harian.data.barang.id);
            } else {
                alert("Data harian tidak ditemukan!");
                window.location.href = "/staffAdministrasi/harian"; // Redirect jika tidak ada data
            }

            async function loadStaffProduksi(selectedId) {
                try {
                    const res = await fetch("http://localhost:8080/api/staff-administrasi/staff-produksi", {
                        headers: {
                            "Authorization": "Bearer {{ session('api_token') }}"
                        }
                    });

                    const result = await res.json();
                    const staffSelect = document.getElementById("staff_produksi_id");

                    staffSelect.innerHTML = '<option value="" disabled>Pilih Karyawan</option>' +
                        result.data.map(staff =>
                            `<option value="${staff.id}" ${staff.id == selectedId ? "selected" : ""}>${staff.nama}</option>`
                        ).join("");
                } catch (error) {
                    console.error("Error fetching staff produksi:", error);
                }
            }

            async function loadBarangProduksi(selectedId) {
                try {
                    const res = await fetch("http://localhost:8080/api/staff-administrasi/barang", {
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

            form.addEventListener("submit", async function(event) {
                event.preventDefault();
                const formData = {
                    staff_produksi_id: staffSelect.value,
                    barang_id: barangSelect.value,
                    tanggal: document.getElementById("tanggal").value,
                    jumlah_dikerjakan: document.getElementById("jumlah_dikerjakan").value
                };
                console.log(formData);


                try {
                    const res = await fetch(`http://localhost:8080/api/staff-administrasi/barang-harian/${id}`, {
                        method: "PUT",
                        headers: {
                            "Content-Type": "application/json",
                            "Authorization": "Bearer {{ session('api_token') }}"
                        },
                        body: JSON.stringify(formData)
                    });
                    const result = await res.json();
                    if (res.ok) {
                        // Menampilkan SweetAlert untuk sukses
                        Swal.fire({
                            title: 'Berhasil!',
                            text: result.message,
                            icon: 'success',
                            confirmButtonText: 'Oke'
                        }).then(() => {
                            window.location.href = "/staffAdministrasi/harian"; // Redirect setelah sukses
                        });
                    } else {
                        // Menampilkan SweetAlert untuk kegagalan
                        Swal.fire({
                            title: 'Gagal!',
                            text: result.message || "Terjadi kesalahan",
                            icon: 'error',
                            confirmButtonText: 'Tutup'
                        });
                    }
                } catch (error) {
                    // Menampilkan SweetAlert untuk kesalahan pada request
                    Swal.fire({
                        title: 'Error!',
                        text: "Terjadi kesalahan saat mengirim data.",
                        icon: 'error',
                        confirmButtonText: 'Tutup'
                    });
                }
            });
        });
    </script>
</x-layout.administrasiPage>