document.addEventListener("DOMContentLoaded", function () {
    const openModal = document.getElementById("popUp");
    const closeModal = document.getElementById("closeModal");
    const modal = document.getElementById("modalAlfa");
    const saveBarang = document.getElementById("saveBarang");
    const dataTable = document.getElementById("dataTable");
    const submitBtn = document.getElementById("submitBtnAlfa");

    // Pastikan semua elemen ada
    if (
        !(
            openModal &&
            closeModal &&
            modal &&
            saveBarang &&
            dataTable &&
            submitBtn
        )
    ) {
        return;
    }

    let transaksi = [];
    let editIndex = null;

    const formatRupiah = (angka) => "Rp " + angka.toLocaleString("id-ID");

    const refreshTable = () => {
        dataTable.innerHTML = "";
        transaksi.forEach((item, index) => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td class="border px-2 py-1">${index + 1}</td>
                <td class="border px-2 py-1">${item.nama_barang}</td>
                <td class="border px-2 py-1">${item.qty}</td>
                <td class="border px-2 py-1">${formatRupiah(item.harga)}</td>
                <td class="border px-2 py-1">${formatRupiah(item.total)}</td>
                <td class="border px-2 py-1 flex justify-center items-center gap-1">
                    <button class="edit bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded">Edit</button>
                    <button class="hapus px-2 py-1 rounded text-white bg-red-600 hover:bg-red-700 border border-white">Hapus</button>
                </td>
            `;

            row.querySelector(".edit").addEventListener("click", () => {
                editIndex = index;
                document.getElementById("nama_barang").value = item.nama_barang;
                document.getElementById("qty").value = item.qty;
                document.getElementById("harga").value = item.harga;
                modal.classList.remove("hidden");
            });

            row.querySelector(".hapus").addEventListener("click", () => {
                if (confirm(`Hapus barang "${item.nama_barang}"?`)) {
                    transaksi.splice(index, 1);
                    refreshTable();
                }
            });

            dataTable.appendChild(row);
        });
    };

    const isiStruk = () => {
        const strukBody = document.getElementById("strukBody");
        strukBody.innerHTML = "";
        let totalBelanja = 0;

        transaksi.forEach((item) => {
            strukBody.innerHTML += `${item.nama_barang} (${
                item.qty
            }) - ${formatRupiah(item.total)}<br>`;
            totalBelanja += item.total;
        });

        strukBody.innerHTML += `<hr style="margin: 8px 0;">`;
        strukBody.innerHTML += `<strong>Total: ${formatRupiah(
            totalBelanja
        )}</strong>`;
    };

    const printStrukOnly = () => {
        let totalBelanja = transaksi.reduce((sum, item) => sum + item.total, 0);

        const printHTML = `
            <html>
            <head>
                <title>Nota Penjualan</title>
                <style>
                    body { font-family: Arial, sans-serif; margin: 20px; }
                    h2, h4 { text-align: center; margin: 0; }
                    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                    th, td { border: 1px solid black; padding: 8px; text-align: center; }
                    th { background: #f2f2f2; }
                    .total { text-align: right; font-weight: bold; }
                    .footer { margin-top: 40px; display: flex; justify-content: space-between; }
                    .footer div { text-align: center; }
                </style>
            </head>
            <body>
                <h2>Nama Toko / Usaha</h2>
                <h4>Alamat Toko, No. Telp</h4>
                <hr>

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
                        ${transaksi
                            .map(
                                (item, i) => `
                            <tr>
                                <td>${i + 1}</td>
                                <td>${item.nama_barang}</td>
                                <td>${item.qty}</td>
                                <td>${formatRupiah(item.harga)}</td>
                                <td>${formatRupiah(item.total)}</td>
                            </tr>
                        `
                            )
                            .join("")}
                        <tr>
                            <td colspan="4" class="total">Total Belanja</td>
                            <td>${formatRupiah(totalBelanja)}</td>
                        </tr>
                    </tbody>
                </table>

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
        `;

        const printWindow = window.open("", "", "width=800,height=1000");
        printWindow.document.write(printHTML);
        printWindow.document.close();
        printWindow.print();
    };

    // Buka modal
    openModal.addEventListener("click", () => {
        editIndex = null;
        document.getElementById("nama_barang").value = "";
        document.getElementById("qty").value = "";
        document.getElementById("harga").value = "";
        modal.classList.remove("hidden");
    });

    // Tutup modal
    closeModal.addEventListener("click", () => {
        modal.classList.add("hidden");
        editIndex = null;
    });

    // Simpan barang
    saveBarang.addEventListener("click", () => {
        const nama_barang = document.getElementById("nama_barang").value.trim();
        const qty = Number(document.getElementById("qty").value);
        const harga = Number(document.getElementById("harga").value);

        if (!nama_barang || qty <= 0 || harga <= 0) {
            alert("Isi semua data barang dengan benar!");
            return;
        }

        if (editIndex === null) {
            transaksi.push({ nama_barang, qty, harga, total: qty * harga });
        } else {
            transaksi[editIndex] = {
                nama_barang,
                qty,
                harga,
                total: qty * harga,
            };
            editIndex = null;
        }

        refreshTable();
        modal.classList.add("hidden");
    });

    // Submit
    submitBtn.addEventListener("click", () => {
        if (transaksi.length === 0) {
            alert("Tidak ada data untuk disimpan!");
            return;
        }

        fetch("/alfamart/simpan", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]'
                ).content,
            },
            body: JSON.stringify({ transaksi }),
        })
            .then((res) => res.json())
            .then((result) => {
                if (result.message === "Berhasil disimpan") {
                    isiStruk();
                    printStrukOnly();
                    transaksi = [];
                    refreshTable();
                } else {
                    alert("Gagal menyimpan");
                }
            })
            .catch((err) => console.error(err));
    });
});
