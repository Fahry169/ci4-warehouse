<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;

class BarangController extends BaseController
{
    protected $barangModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
    }
    public function index()
    {
        $data['title'] = 'Daftar Barang';
        $data['barangs'] = $this->barangModel->orderBy('id', 'DESC')->findAll();
        return view('barangs/index', $data);
    }

    public function create()
    {
        helper('form');
        $data['title'] = 'Tambah Barang';
        return view('barangs/create', $data);
    }

    public function store()
    {
        helper('form');
        $rules = [
            'kode_barang' => 'required|is_unique[barangs.kode_barang]',
            'nama' => 'required|min_length[3]',
            'jumlah' => 'required|integer'
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }


        $file = $this->request->getFile('gambar');
        $fileName = null;
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads', $fileName);
        }

        $this->barangModel->save([
            'kode_barang' => $this->request->getPost('kode_barang'),
            'nama' => $this->request->getPost('nama'),
            'kategori' => $this->request->getPost('kategori'),
            'jumlah' => $this->request->getPost('jumlah'),
            'satuan' => $this->request->getPost('satuan'),
            'lokasi' => $this->request->getPost('lokasi'),
            'keterangan' => $this->request->getPost('keterangan'),
            'gambar' => $fileName,
        ]);

        return redirect()->to('/barangs')->with('success', 'Barang berhasil ditambahkan.');
    }
public function edit($id)
{
    $model = new BarangModel();
    $barang = $model->find($id);

    if (!$barang) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Barang dengan ID $id tidak ditemukan.");
    }

    return view('barangs/edit', ['barang' => $barang]);
}

public function update($id)
{
    $model = new BarangModel();
    $model->update($id, [
        'nama' => $this->request->getPost('nama'),
        'jumlah' => $this->request->getPost('jumlah'),
        'satuan' => $this->request->getPost('satuan'),
        'keterangan' => $this->request->getPost('keterangan'),
    ]);

    return redirect()->to(site_url('barangs'))->with('success', 'Barang berhasil diperbarui');
}

    public function delete($id = null)
    {
        $barang = $this->barangModel->find($id);
        if (!$barang)
            return redirect()->to('/barangs')->with('error', 'Data tidak ditemukan');


        if ($barang['gambar'] && file_exists(WRITEPATH . 'uploads/' . $barang['gambar'])) {
            unlink(WRITEPATH . 'uploads/' . $barang['gambar']);
        }


        $this->barangModel->delete($id);
        return redirect()->to('/barangs')->with('success', 'Barang berhasil dihapus.');
    }


    public function show($id = null)
    {
        $data['title'] = 'Detail Barang';
        $data['barang'] = $this->barangModel->find($id);
        if (!$data['barang'])
            return redirect()->to('/barangs')->with('error', 'Data tidak ditemukan');
        return view('barangs/show', $data);
    }
    public function stokHabis()
    {
        $data['title'] = 'Barang Stok Habis';
        $data['barangs'] = $this->barangModel->getStokHabis();
        return view('barangs/index', $data);
    }

    public function laporanKategori()
    {
        $data['title'] = 'Laporan Barang per Kategori';
        $data['laporan'] = $this->barangModel->getTotalBarangPerKategori();
        return view('barangs/laporan', $data);
    }

    public function ajaxList()
{
    $request = service('request');
    $barangModel = new \App\Models\BarangModel();

    $search = $request->getPost('search')['value'] ?? '';
    $start  = (int) ($request->getPost('start') ?? 0);
    $length = (int) ($request->getPost('length') ?? 10);

    $query = $barangModel->select('id, kode_barang, nama, kategori, jumlah, satuan');

    if ($search) {
        $query->groupStart()
              ->like('nama', $search)
              ->orLike('kategori', $search)
              ->orLike('kode_barang', $search)
              ->groupEnd();
    }

    $builderClone = clone $query;
    $totalFiltered = $builderClone->countAllResults(false);

    $data = $query->findAll($length, $start);
    $totalData = $barangModel->countAll();

    $json = [
        "draw"            => intval($request->getPost('draw')),
        "recordsTotal"    => $totalData,
        "recordsFiltered" => $totalFiltered,
        "data"            => array_map(function($row) {
            return [
                $row['id'],
                esc($row['kode_barang']),
                esc($row['nama']),
                esc($row['kategori']),
                esc($row['jumlah']),
                esc($row['satuan']),
                '<a href="/barangs/'.$row['id'].'" class="btn btn-sm btn-info">View</a>
                 <a href="/barangs/edit/'.$row['id'].'" class="btn btn-sm btn-warning">Edit</a>
                 <a href="/barangs/pdf/'.$row['id'].'" class="btn btn-sm btn-danger" target="_blank">PDF</a>
                 <a href="/barangs/delete/'.$row['id'].'" class="btn btn-sm btn-danger" onclick="return confirm(\'Yakin?\')">Hapus</a>'
            ];
        }, $data)
    ];

    return $this->response->setJSON($json);
}

    private function getCompanyData()
    {
        return [
            'print_date' => date('d F Y'),
            'company_name' => 'PT. Gudang Maju Jaya',
            'company_address' => 'Jl. Raya Industri No. 123, Jakarta 12345',
            'company_phone' => 'Telp: (021) 123-4567',
            'company_email' => 'Email: info@gudangmajujaya.com'
        ];
    }

    public function print($id = null)
    {
        $data['barang'] = $this->barangModel->find($id);
        if (!$data['barang']) {
            return redirect()->to('/barangs')->with('error', 'Data tidak ditemukan');
        }
        
        $data = array_merge($data, $this->getCompanyData());
        $data['title'] = 'Print Barang';
        
        return view('barangs/print', $data);
    }

    public function pdf($id = null)
    {
        $data['barang'] = $this->barangModel->find($id);
        if (!$data['barang']) {
            return redirect()->to('/barangs')->with('error', 'Data tidak ditemukan');
        }
        
        $data = array_merge($data, $this->getCompanyData());
        $html = view('barangs/pdf', $data);
        
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        
        $filename = 'Kartu_Barang_' . $data['barang']['kode_barang'] . '_' . date('Y-m-d') . '.pdf';
        $dompdf->stream($filename, ['Attachment' => true]);
    }
}
