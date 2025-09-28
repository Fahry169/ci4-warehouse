<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kartu Barang - <?= esc($barang['kode_barang']) ?></title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            font-size: 12pt;
            line-height: 1.6;
            color: #000;
            margin: 0;
            padding: 20px;
        }
        
        .letterhead {
            text-align: center;
            border-bottom: 3px solid #000;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        
        .company-name {
            font-size: 18pt;
            font-weight: bold;
            margin-bottom: 5px;
            text-transform: uppercase;
        }
        
        .company-address { font-size: 11pt; margin-bottom: 3px; }
        .company-contact { font-size: 10pt; font-style: italic; }
        
        .document-title {
            text-align: center;
            font-size: 16pt;
            font-weight: bold;
            margin: 30px 0;
            text-decoration: underline;
        }
        
        .print-date {
            text-align: right;
            margin-bottom: 20px;
            font-size: 11pt;
        }
        
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        
        .info-table td {
            padding: 8px;
            border: 1px solid #000;
            vertical-align: top;
        }
        
        .info-table .label {
            background-color: #f0f0f0;
            font-weight: bold;
            width: 30%;
        }
        
        .signature-section {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }
        
        .signature-box { text-align: center; width: 200px; }
        .signature-line {
            border-bottom: 1px solid #000;
            height: 50px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="letterhead">
        <div class="company-name"><?= esc($company_name) ?></div>
        <div class="company-address"><?= esc($company_address) ?></div>
        <div class="company-contact">
            <?= esc($company_phone) ?> | <?= esc($company_email) ?>
        </div>
    </div>
    
    <div class="print-date">
        Jakarta, <?= esc($print_date) ?>
    </div>
    
    <div class="document-title">
        KARTU BARANG
    </div>
    
    <div class="content">
        <p>Berikut ini adalah data barang yang tersimpan dalam sistem gudang:</p>
        
        <table class="info-table">
            <tr>
                <td class="label">Kode Barang</td>
                <td><?= esc($barang['kode_barang']) ?></td>
            </tr>
            <tr>
                <td class="label">Nama Barang</td>
                <td><?= esc($barang['nama']) ?></td>
            </tr>
            <tr>
                <td class="label">Kategori</td>
                <td><?= esc($barang['kategori']) ?></td>
            </tr>
            <tr>
                <td class="label">Jumlah</td>
                <td><?= esc($barang['jumlah']) ?> <?= esc($barang['satuan']) ?></td>
            </tr>
            <tr>
                <td class="label">Lokasi</td>
                <td><?= esc($barang['lokasi']) ?></td>
            </tr>
            <tr>
                <td class="label">Keterangan</td>
                <td><?= esc($barang['keterangan']) ?></td>
            </tr>
            <tr>
                <td class="label">Tanggal Input</td>
                <td><?= isset($barang['created_at']) ? date('d F Y', strtotime($barang['created_at'])) : date('d F Y') ?></td>
            </tr>
        </table>
        
        <p style="margin-top: 30px;">
            Demikian kartu barang ini dibuat untuk dapat dipergunakan sebagaimana mestinya.
        </p>
    </div>

    <div class="signature-section">
        <div class="signature-box">
            <p>Mengetahui,</p>
            <div class="signature-line"></div>
            <p><strong>Manager Gudang</strong></p>
        </div>
        <div class="signature-box">
            <p>Yang Menerbitkan,</p>
            <div class="signature-line"></div>
            <p><strong>Admin Sistem</strong></p>
        </div>
    </div>
</body>
</html>

