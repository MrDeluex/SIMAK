<x-layout.adminPage contentClass="flex flex-col justify-start items-center">
    <h1 class="text-2xl font-reguler mb-10">INPUT UPAH KARYAWAN</h1>
    <form action="" class="w-full" id="upahForm">
        <div class="w-full p-10 flex flex-col justify-start items-start gap-8"
            style="box-shadow: 4px 0px 4px 0px rgba(0,0,0,0.25), -4px 0px 4px 0px rgba(0,0,0,0.25), 0px 4px 4px 0px rgba(0,0,0,0.25), 0px -4px 4px 0px rgba(0,0,0,0.25);">

            <!-- Pilih Karyawan -->
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

            <!-- Periode Mulai -->
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

            <div class="w-full flex justify-between items-center">
                <button type="button" class="px-10 py-1 rounded bg-secondary-2 text-white">Kembali</button>
                <button type="submit" class="px-10 py-1 rounded bg-secondary-2 text-white">Tambah</button>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", async function() {
            const form = document.getElementById("upahForm");
            const staffSelect = document.getElementById("staff_produksi_id");

            // Fetch daftar staff produksi
            async function loadStaffProduksi() {
                try {
                    const res = await fetch("http://localhost:8080/api/admin/staff-produksi", {
                        headers: {
                            "Authorization": "Bearer {{ session('api_token') }}"
                        }
                    });
                    const data = await res.json();
                    staffSelect.innerHTML = data.data.map(staff =>
                        `<option value="${staff.id}">${staff.nama}</option>`
                    ).join("");
                } catch (error) {
                    console.error("Error fetching staff produksi:", error);
                }
            }

            loadStaffProduksi();

            // Handle form submit
            form.addEventListener("submit", async function(event) {
                event.preventDefault();

                const formData = {
                    staff_produksi_id: staffSelect.value,
                    periode_mulai: document.getElementById("periode_mulai").value
                };

                try {
                    const res = await fetch("http://localhost:8080/api/admin/upah", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "Authorization": "Bearer {{ session('api_token') }}"
                        },
                        body: JSON.stringify(formData)
                    });

                    const result = await res.json();
                    if (res.ok) {
                        alert(result.message);
                    } else {
                        alert(result.message || "Terjadi kesalahan");
                    }
                } catch (error) {
                    console.error("Error submitting data:", error);
                }
            });
        });
    </script>

</x-layout.adminPage>