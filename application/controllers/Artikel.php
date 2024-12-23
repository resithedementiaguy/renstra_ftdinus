<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Artikel extends CI_Controller
{
    public function index()
    {
        $this->load->model('Artikel_model');
        $data['years'] = $this->Artikel_model->getTahunList();
        $tahun = $this->input->get('tahun') ?? date('Y');
        $kategoriData = $this->Artikel_model->getTotalByCategoryAndYear($tahun);
        $dosenData = $this->Artikel_model->getJumlahDosenByYear($tahun);
        $tahunList = $this->Artikel_model->getTahunList();

        // Define the $years array
        $years = array_map(function ($year) {
            return $year['tahun'];
        }, $data['years']);

        $kategori = [];
        $total_jurnal = 0;
        $jumlah_dosen = $dosenData['total_dosen'] ?? 0;

        foreach ($kategoriData as $row) {
            if (strpos($row['kategori'], 'Internasional') !== false || strpos($row['kategori'], 'Nasional') !== false) {
                $total_jurnal += $row['total'];
            }
            $kategori[$row['kategori']] = $row['total'];
        }

        $jurnal_bereputasi = 0;
        $jurnal_internasional = $kategori['Internasional Non Scopus'] ?? 0;
        $jurnal_nasional = 0;

        foreach (['Internasional Q1', 'Internasional Q2', 'Internasional Q3', 'Internasional Q4'] as $kategori_key) {
            $jurnal_bereputasi += $kategori[$kategori_key] ?? 0;
        }

        foreach (['Nasional Sinta 1', 'Nasional Sinta 2', 'Nasional Sinta 3', 'Nasional Sinta 4', 'Nasional Sinta 5', 'Nasional Sinta 6'] as $kategori_key) {
            $jurnal_nasional += $kategori[$kategori_key] ?? 0;
        }

        $data = [
            'tahun' => $tahun,
            'tahunList' => $tahunList,
            'years' => $years,  // Pass $years to the view
            'kategori' => $kategori,
            'jumlah_dosen' => $jumlah_dosen,
            'total_jurnal_bereputasi' => $jurnal_bereputasi,
            'total_jurnal_internasional' => $jurnal_bereputasi + $jurnal_internasional,
            'total_jurnal_nasional' => $jurnal_nasional
        ];

        $this->load->view('backend/artikel_view', $data);
    }
}
