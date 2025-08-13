// Ambil elemen
const openModalBtn = document.getElementById("openModal");
const closeModalBtn = document.getElementById("closeModal");
const modal = document.getElementById("modal");
const form = document.getElementById("transaksiForm");
const dataTable = document.getElementById("dataTable");
const submitBtn = document.getElementById("submitBtn");

const namaInput = document.getElementById("nama_barang");
const qtyInput = document.getElementById("qty");
const hargaInput = document.getElementById("harga");

if (
    openModalBtn &&
    closeModalBtn &&
    modal &&
    form &&
    dataTable &&
    submitBtn &&
    namaInput &&
    qtyInput &&
    hargaInput
) {
    let noUrut = 1;
    let transaksi = [];

    // Format Rupiah
    function formatRupiah(angka) {
        let number_string = angka.toString().replace(/[^,\d]/g, ""),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }
        rupiah = split[1] !== undefined ? rupiah + "," + split[1] : rupiah;
        return "Rp " + rupiah;
    }

    function toNumber(str) {
        return parseInt(str.replace(/[^\d]/g, "")) || 0;
    }

    // Render Tabel Data
    function renderTable() {
        dataTable.innerHTML = "";
        transaksi.forEach((item, index) => {
            const row = document.createElement("tr");
            row.innerHTML = `
            <td class="border px-2 py-1 text-center">${index + 1}</td>
            <td class="border px-2 py-1">${item.nama_barang}</td>
            <td class="border px-2 py-1 text-center">${item.qty}</td>
            <td class="border px-2 py-1 text-right">${formatRupiah(
                item.harga
            )}</td>
            <td class="border px-2 py-1 text-right">${formatRupiah(
                item.total
            )}</td>
            <td class="border px-2 py-1 text-center">
                <div class="flex justify-center gap-2">
                    <button type="button" class="edit-btn px-2 py-1 rounded text-white bg-yellow-500 hover:bg-yellow-600">Edit</button>
                    <button type="button" class="hapus-btn px-2 py-1 rounded text-white bg-red-600 hover:bg-red-700 border border-black">Hapus</button>
                </div>
            </td>
        `;
            dataTable.appendChild(row);
        });
    }

    // Render Struk untuk cetak
    function isiStruk(dataTransaksi) {
        let total = dataTransaksi.reduce((acc, item) => acc + item.total, 0);

        let body = `
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                ${dataTransaksi
                    .map(
                        (item, index) => `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${item.nama_barang}</td>
                        <td>${item.qty}</td>
                        <td>${formatRupiah(item.harga)}</td>
                        <td>${formatRupiah(item.total)}</td>
                    </tr>
                `
                    )
                    .join("")}
                <tr>
                    <td colspan="4" style="text-align: right; font-weight: bold;">Total Belanja</td>
                    <td>${formatRupiah(total)}</td>
                </tr>
            </tbody>
        </table>
    `;

        document.getElementById("strukBody").innerHTML = body;
    }

    // Cetak Struk A4
    function printStrukOnly() {
        const struk = document.getElementById("strukArea").innerHTML;
        const win = window.open("", "", "width=800,height=1000");

        win.document.write(`
        <html>
            <head>
                <title>Nota Penjualan</title>
                <style>
                    @page { size: A4; margin: 20mm; }
                    body { font-family: Arial, sans-serif; font-size: 14px; margin: 20px; }
                    h2, h4 { text-align: center; margin: 0; }
                    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                    th, td { border: 1px solid black; padding: 8px; text-align: center; }
                    th { background-color: #f2f2f2; }
                    .footer { margin-top: 40px; display: flex; justify-content: space-between; }
                    .footer div { text-align: center; }
                </style>
            </head>
            <body onload="window.print(); window.close();">
                <h2>Indomaret</h2>
                <h4>Alamat Toko, No. Telp</h4>
                <hr>
                ${struk}
                <div class="footer">
                    <div>
                        <p>Pembeli</p><br><br>
                        <p>__________________</p>
                    </div>
                    <div>
                        <p>Kasir</p><br><br>
                        <p>__________________</p>
                    </div>
                </div>
            </body>
        </html>
    `);
        win.document.close();
    }

    // Event Modal
    openModalBtn.addEventListener("click", () => {
        form.dataset.mode = "add";
        form.dataset.editIndex = "";
        form.reset();
        modal.classList.remove("hidden");
    });

    closeModalBtn.addEventListener("click", () => {
        modal.classList.add("hidden");
        form.reset();
    });

    // Submit Form
    form.addEventListener("submit", (e) => {
        e.preventDefault();

        const namaBarang = namaInput.value.trim();
        const qty = parseInt(qtyInput.value) || 0;
        const harga = parseInt(hargaInput.value) || 0;

        if (!namaBarang || qty <= 0 || harga <= 0) {
            alert("Mohon isi semua field dengan benar!");
            return;
        }

        const total = qty * harga;
        const mode = form.dataset.mode;
        const editIndex = form.dataset.editIndex;

        if (mode === "add") {
            transaksi.push({ nama_barang: namaBarang, qty, harga, total });
        } else if (mode === "edit") {
            transaksi[editIndex] = {
                nama_barang: namaBarang,
                qty,
                harga,
                total,
            };
        }

        renderTable();
        modal.classList.add("hidden");
        form.reset();
        form.dataset.mode = "add";
        form.dataset.editIndex = "";
    });

    // Delegasi Event Edit / Hapus
    dataTable.addEventListener("click", (e) => {
        const target = e.target;

        if (target.classList.contains("hapus-btn")) {
            if (confirm("Yakin ingin menghapus data ini?")) {
                const rowIndex = target.closest("tr").rowIndex - 1;
                transaksi.splice(rowIndex, 1);
                renderTable();
            }
        }

        if (target.classList.contains("edit-btn")) {
            const rowIndex = target.closest("tr").rowIndex - 1;
            const item = transaksi[rowIndex];

            namaInput.value = item.nama_barang;
            qtyInput.value = item.qty;
            hargaInput.value = item.harga;

            form.dataset.mode = "edit";
            form.dataset.editIndex = rowIndex;
            modal.classList.remove("hidden");
        }
    });

    // Simpan & Cetak
    document.getElementById("submitBtn").addEventListener("click", function () {
        const rows = dataTable.querySelectorAll("tr");
        const transaksi = [];

        rows.forEach((row) => {
            const nama_barang = row.cells[1]?.textContent?.trim();
            const qty = parseInt(row.cells[2]?.textContent);
            const harga = toNumber(row.cells[3]?.textContent);
            const total = toNumber(row.cells[4]?.textContent);

            if (nama_barang) {
                transaksi.push({ nama_barang, qty, harga, total });
            }
        });

        // Cek setelah array terisi
        if (transaksi.length === 0) {
            alert("Tidak ada data untuk disimpan!");
            return; // ⬅ keluar dari click handler, jadi gak lanjut print
        }

        fetch("/transaksi/simpan", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            body: JSON.stringify({ transaksi }),
        })
            .then((response) => response.json())
            .then((result) => {
                if (result.message === "Berhasil disimpan") {
                    isiStruk(transaksi);
                    printStrukOnly();
                    dataTable.innerHTML = "";
                    noUrut = 1;
                } else {
                    alert("Gagal menyimpan");
                }
            });
    });
}
