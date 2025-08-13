function formatRupiah(angka) {
    return "Rp " + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

const literInput = document.getElementById("liter");
const hargaInput = document.getElementById("harga_per_liter");
const totalInput = document.getElementById("total");
const formPertamina = document.getElementById("pertaminaForm");

if (literInput && hargaInput && totalInput && formPertamina) {
    literInput.addEventListener("input", hitungTotal);
    hargaInput.addEventListener("input", hitungTotal);

    function hitungTotal() {
        const liter = parseFloat(literInput.value) || 0;
        const harga = parseFloat(hargaInput.value) || 0;
        totalInput.value = liter * harga;
    }

    formPertamina.addEventListener("submit", function (e) {
        e.preventDefault();

        const transaksi = {
            jenis_bbm: document.getElementById("jenis_bbm").value,
            liter: parseFloat(literInput.value),
            harga_per_liter: parseFloat(hargaInput.value),
            total: parseFloat(totalInput.value),
        };

        fetch("/pertamina/simpan", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            body: JSON.stringify(transaksi),
        })
            .then((res) => res.json())
            .then((result) => {
                if (result.message === "Berhasil disimpan") {
                    isiStruk(transaksi);
                    printStrukOnly();

                    // 🔹 Reset semua input setelah cetak
                    document.getElementById("jenis_bbm").value = "";
                    literInput.value = "";
                    hargaInput.value = "";
                    totalInput.value = "";
                } else {
                    alert("Gagal menyimpan");
                }
            })
            .catch((err) => console.error(err));
    });

    function isiStruk(data) {
        const body = `
            Jenis BBM : ${data.jenis_bbm}<br>
            Liter     : ${data.liter} L<br>
            Harga/Ltr : ${formatRupiah(data.harga_per_liter)}<br>
            Total     : ${formatRupiah(data.total)}<br>
        `;
        document.getElementById("strukBody").innerHTML = body;
        document.getElementById("strukArea").style.display = "block";
    }

    function printStrukOnly() {
        const data = document.getElementById("strukBody").innerHTML;

        const printHTML = `
        <html>
        <head>
            <title>Nota Pertamina</title>
            <style>
                @page {
                    size: A4;
                    margin: 20mm;
                }
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                }
                h2, h4 {
                    text-align: center;
                    margin: 0;
                }
                hr {
                    margin: 10px 0;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 20px;
                }
                th, td {
                    border: 1px solid black;
                    padding: 8px;
                    text-align: left;
                }
                th {
                    background: #f2f2f2;
                }
                .total {
                    text-align: right;
                    font-weight: bold;
                }
                .footer {
                    margin-top: 50px;
                    display: flex;
                    justify-content: space-between;
                }
                .footer div {
                    text-align: center;
                }
            </style>
        </head>
        <body>
            <h2>Pertamina</h2>
            <h4>Bukti Pembelian BBM</h4>
            <hr>

            <table>
                <tr>
                    <th>Jenis BBM</th>
                    <td>${document.getElementById("jenis_bbm").value}</td>
                </tr>
                <tr>
                    <th>Liter</th>
                    <td>${literInput.value} L</td>
                </tr>
                <tr>
                    <th>Harga/Liter</th>
                    <td>${formatRupiah(hargaInput.value)}</td>
                </tr>
                <tr>
                    <th>Total</th>
                    <td>${formatRupiah(totalInput.value)}</td>
                </tr>
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

        const w = window.open("", "", "width=800,height=1000");
        w.document.write(printHTML);
        w.document.close();
        w.print();
    }
}
