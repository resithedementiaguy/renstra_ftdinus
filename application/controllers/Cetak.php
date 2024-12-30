<?php
defined('BASEPATH') or exit('No direct script access allowed');

//Include autoloader dari Composer
require 'dompdf/vendor/autoload.php';

use Dompdf\Dompdf;

class Cetak extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ewmp_model');
        $this->load->model('Mod_iku');
        $this->load->model('Mod_renstra');
        $this->load->model('Ewmp_model');
        $this->load->model('Artikel_model');
        $this->load->helper('renstra_helper');

        // Cek login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    public function generate_pdf_renstra()
    {
        // Buat instance Dompdf
        $dompdf = new Dompdf();

        // Ambil data level1
        $data['level1'] = $this->Mod_iku->get_level1();

        // Ambil nilai tahun dari database
        $years = $this->db->query("
        SELECT tahun 
        FROM (SELECT * FROM tahun ORDER BY tahun DESC LIMIT 6) subquery 
        ORDER BY tahun ASC")
            ->result_array();
        $data['years'] = array_column($years, 'tahun');

        // Inisialisasi array untuk menyimpan rata-rata per tahun
        $rata_rata_jurnal_per_tahun = [];
        $rata_rata_penelitian_per_tahun = [];
        $rata_rata_penelitian_mahasiswa_per_tahun = [];
        $rata_rata_seminar_per_tahun = [];
        $total_dana_penelitian_per_tahun = [];

        $rata_rata_pengabdian_per_tahun = [];
        $rata_rata_pengabdian_mahasiswa_per_tahun = [];
        $total_dana_pengabdian_per_tahun = [];
        $total_haki_per_tahun = [];

        $rata_rata_jurnal_pengabdian_per_tahun = [];
        $rata_rata_prosiding_pengabdian_per_tahun = [];

        foreach ($data['years'] as $tahun) {
            $dosenData = $this->Artikel_model->getJumlahDosenByYear($tahun);
            $mahasiswaData = $this->Artikel_model->getJumlahMahasiswaByYear($tahun);
            $jumlah_dosen = $dosenData['total_dosen'] ?? 0;
            $jumlah_mahasiswa = $mahasiswaData['total_mahasiswa'] ?? 0;

            // Rata-rata per tahun
            $rata_rata_jurnal_per_tahun[$tahun] = hitungRataRataJurnal($tahun, $jumlah_dosen);
            $rata_rata_penelitian_per_tahun[$tahun] = hitungRataPenelitian($tahun, $jumlah_dosen);
            $rata_rata_penelitian_mahasiswa_per_tahun[$tahun] = hitungRataPenelitianMahasiswa($tahun, $jumlah_dosen);
            $rata_rata_seminar_per_tahun[$tahun] = hitungRataSeminar($tahun, $jumlah_dosen);
            $rata_rata_pengabdian_per_tahun[$tahun] = hitungRataPengabdian($tahun, $jumlah_dosen);
            $rata_rata_pengabdian_mahasiswa_per_tahun[$tahun] = hitungRataPengabdianMahasiswa($tahun, $jumlah_mahasiswa);

            $rata_rata_jurnal_pengabdian_per_tahun[$tahun] = hitungRataJurnalPengabdian($tahun, $jumlah_dosen);
            $rata_rata_prosiding_pengabdian_per_tahun[$tahun] = hitungRataProsidingPengabdian($tahun, $jumlah_dosen);

            // Total Dana Penelitian dan Pengabdian per tahun
            $total_dana_penelitian_per_tahun[$tahun] = hitungTotalDanaPenelitian($tahun);
            $total_dana_pengabdian_per_tahun[$tahun] = hitungTotalDanaPengabdian($tahun);

            // Total HAKI per tahun
            $total_haki_per_tahun[$tahun] = hitungTotalHaki($tahun);
        }

        // Menyiapkan data untuk view
        $data['rata_rata_jurnal_per_tahun'] = $rata_rata_jurnal_per_tahun;
        $data['rata_rata_penelitian_per_tahun'] = $rata_rata_penelitian_per_tahun;
        $data['rata_rata_penelitian_mahasiswa_per_tahun'] = $rata_rata_penelitian_mahasiswa_per_tahun;
        $data['rata_rata_seminar_per_tahun'] = $rata_rata_seminar_per_tahun;
        $data['total_dana_penelitian_per_tahun'] = $total_dana_penelitian_per_tahun;
        $data['total_dana_pengabdian_per_tahun'] = $total_dana_pengabdian_per_tahun;
        $data['rata_rata_pengabdian_per_tahun'] = $rata_rata_pengabdian_per_tahun;
        $data['rata_rata_pengabdian_mahasiswa_per_tahun'] = $rata_rata_pengabdian_mahasiswa_per_tahun;
        $data['total_haki_per_tahun'] = $total_haki_per_tahun;
        $data['rata_rata_jurnal_pengabdian_per_tahun'] = $rata_rata_jurnal_pengabdian_per_tahun;
        $data['rata_rata_prosiding_pengabdian_per_tahun'] = $rata_rata_prosiding_pengabdian_per_tahun;

        // Load view sebagai HTML untuk PDF
        $html = $this->load->view('backend/renstra/pdf/cetak_renstra', $data, true);

        // Load HTML content ke Dompdf
        $dompdf->loadHtml($html);

        // Set ukuran kertas dan orientasi
        $dompdf->setPaper('A4', 'landscape');

        // Render PDF
        $dompdf->render();

        // Output PDF (1 = download, 0 = preview)
        $dompdf->stream("renstra.pdf", array("Attachment" => 0));
    }

    public function generate_pdf_renstra_tahunan($year = null)
    {
        // Buat instance Dompdf
        $dompdf = new Dompdf();

        // Gunakan tahun yang dipilih atau tahun pertama dari database
        if ($year === null) {
            $year = $this->db->select('tahun')->from('tahun')->order_by('tahun', 'ASC')->get()->row()->tahun;
        }

        $data['selected_year'] = $year;
        $data['level1'] = $this->Mod_iku->get_level1_for_year($year);

        // Load view sebagai HTML
        $html = $this->load->view('backend/renstra/pdf/cetak_renstra_tahunan', $data, true);

        // Load HTML content ke Dompdf
        $dompdf->loadHtml($html);

        // Set ukuran kertas dan orientasi
        $dompdf->setPaper('A4', 'potrait');

        // Render PDF
        $dompdf->render();

        // Output PDF (1 = download, 0 = preview)
        $dompdf->stream("renstra_{$year}.pdf", array("Attachment" => 0));
    }

    public function generate_pdf_rekapitulasi($tahun)
    {
        // Buat instance Dompdf
        $dompdf = new Dompdf();

        $data['tahun'] = $tahun;

        // Fetch data penelitian dan pengabdian berdasarkan tahun
        $data['penelitian_elektro'] = $this->Ewmp_model->get_penelitian_elektro($tahun);
        $data['penelitian_industri'] = $this->Ewmp_model->get_penelitian_industri($tahun);
        $data['penelitian_biomedis'] = $this->Ewmp_model->get_penelitian_biomedis($tahun);

        $data['pengabdian_elektro'] = $this->Ewmp_model->get_pengabdian_elektro($tahun);
        $data['pengabdian_industri'] = $this->Ewmp_model->get_pengabdian_industri($tahun);
        $data['pengabdian_biomedis'] = $this->Ewmp_model->get_pengabdian_biomedis($tahun);

        // Load view sebagai HTML
        $html = $this->load->view('backend/ewmp/pdf/cetak_rekapitulasi', $data, true);

        // Load HTML content ke Dompdf
        $dompdf->loadHtml($html);

        // Set ukuran kertas dan orientasi
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF
        $dompdf->render();

        // Output PDF (1 = download, 0 = preview)
        $dompdf->stream("rekapitulasi_{$tahun}.pdf", array("Attachment" => 0));
    }


    public function generate_pdf_hasil($tahun)
    {
        // Buat instance Dompdf
        $dompdf = new Dompdf();

        $data['tahun'] = $tahun;

        $data['penelitian_eksternal'] = $this->Ewmp_model->get_penelitian_eksternal($tahun);

        // Iterasi untuk mendapatkan anggota setiap penelitian
        foreach ($data['penelitian_eksternal'] as $key => $penelitian) {
            $id_penelitian_eksternal = $penelitian->id;
            $kategori = 'Penelitian';
            $data['penelitian_eksternal'][$key]->anggota_penelitian_eksternal = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_penelitian_eksternal, $kategori);
        }

        $data['penelitian_internal'] = $this->Ewmp_model->get_penelitian_internal($tahun);

        // Iterasi untuk mendapatkan anggota setiap penelitian
        foreach ($data['penelitian_internal'] as $key => $penelitian) {
            $id_penelitian_internal = $penelitian->id;
            $kategori = 'Penelitian';
            $data['penelitian_internal'][$key]->anggota_penelitian_internal = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_penelitian_internal, $kategori);
        }

        $data['pengabdian_eksternal'] = $this->Ewmp_model->get_pengabdian_eksternal($tahun);

        // Iterasi untuk mendapatkan anggota setiap pengabdian
        foreach ($data['pengabdian_eksternal'] as $key => $pengabdian) {
            $id_pengabdian_eksternal = $pengabdian->id;
            $kategori = 'Pengabdian';
            $data['pengabdian_eksternal'][$key]->anggota_pengabdian_eksternal = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_pengabdian_eksternal, $kategori);
        }

        $data['pengabdian_internal'] = $this->Ewmp_model->get_pengabdian_internal($tahun);

        // Iterasi untuk mendapatkan anggota setiap pengabdian
        foreach ($data['pengabdian_internal'] as $key => $pengabdian) {
            $id_pengabdian_internal = $pengabdian->id;
            $kategori = 'Pengabdian';
            $data['pengabdian_internal'][$key]->anggota_pengabdian_internal = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_pengabdian_internal, $kategori);
        }

        // CETAK PELAPORAN TEKNIK ELEKTRO

        // Publikasi Teknik Elektro
        $data['publikasi_nasional_elektro'] = $this->Ewmp_model->get_publikasi_nasional_elektro($tahun);

        // Iterasi untuk mendapatkan anggota setiap publikasi
        foreach ($data['publikasi_nasional_elektro'] as $key => $publikasi) {
            $id_publikasi_nasional_elektro = $publikasi->id;
            $kategori = 'Artikel/Karya Ilmiah';
            $data['publikasi_nasional_elektro'][$key]->anggota_publikasi_nasional_elektro = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_publikasi_nasional_elektro, $kategori);
        }

        $data['publikasi_internasional_elektro'] = $this->Ewmp_model->get_publikasi_internasional_elektro($tahun);

        // Iterasi untuk mendapatkan anggota setiap publikasi
        foreach ($data['publikasi_internasional_elektro'] as $key => $publikasi) {
            $id_publikasi_internasional_elektro = $publikasi->id;
            $kategori = 'Artikel/Karya Ilmiah';
            $data['publikasi_internasional_elektro'][$key]->anggota_publikasi_internasional_elektro = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_publikasi_internasional_elektro, $kategori);
        }

        $data['seminar_nasional_elektro'] = $this->Ewmp_model->get_seminar_nasional_elektro($tahun);

        // Iterasi untuk mendapatkan anggota setiap seminar
        foreach ($data['seminar_nasional_elektro'] as $key => $seminar) {
            $id_seminar_nasional_elektro = $seminar->id;
            $kategori = 'Prosiding';
            $data['seminar_nasional_elektro'][$key]->anggota_seminar_nasional_elektro = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_seminar_nasional_elektro, $kategori);
        }

        $data['seminar_internasional_elektro'] = $this->Ewmp_model->get_seminar_internasional_elektro($tahun);

        // Iterasi untuk mendapatkan anggota setiap seminar
        foreach ($data['seminar_internasional_elektro'] as $key => $seminar) {
            $id_seminar_internasional_elektro = $seminar->id;
            $kategori = 'Prosiding';
            $data['seminar_internasional_elektro'][$key]->anggota_seminar_internasional_elektro = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_seminar_internasional_elektro, $kategori);
        }

        $data['hcipta_elektro'] = $this->Ewmp_model->get_hcipta_elektro($tahun);

        // Iterasi untuk mendapatkan anggota setiap hcipta
        foreach ($data['hcipta_elektro'] as $key => $hcipta) {
            $id_hcipta_elektro = $hcipta->id;
            $kategori = 'Hak Cipta';
            $data['hcipta_elektro'][$key]->anggota_hcipta_elektro = $this->Ewmp_model->get_inventor_haki_by_id($id_hcipta_elektro, $kategori);
        }

        $data['dindustri_elektro'] = $this->Ewmp_model->get_dindustri_elektro($tahun);

        // Iterasi untuk mendapatkan anggota setiap dindustri
        foreach ($data['dindustri_elektro'] as $key => $dindustri) {
            $id_dindustri_elektro = $dindustri->id;
            $kategori = 'Desain Industri';
            $data['dindustri_elektro'][$key]->anggota_dindustri_elektro = $this->Ewmp_model->get_inventor_haki_by_id($id_dindustri_elektro, $kategori);
        }

        $data['paten_elektro'] = $this->Ewmp_model->get_paten_elektro($tahun);

        // Iterasi untuk mendapatkan anggota setiap paten
        foreach ($data['paten_elektro'] as $key => $paten) {
            $id_paten_elektro = $paten->id;
            $kategori = 'Paten';
            $data['paten_elektro'][$key]->anggota_paten_elektro = $this->Ewmp_model->get_inventor_haki_by_id($id_paten_elektro, $kategori);
        }

        $data['penelitian_eksternal_elektro'] = $this->Ewmp_model->get_penelitian_eksternal_elektro($tahun);

        // Iterasi untuk mendapatkan anggota setiap penelitian_eksternal
        foreach ($data['penelitian_eksternal_elektro'] as $key => $penelitian_eksternal) {
            $id_penelitian_eksternal_elektro = $penelitian_eksternal->id;
            $kategori = 'Penelitian';
            $data['penelitian_eksternal_elektro'][$key]->anggota_penelitian_eksternal_elektro = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_penelitian_eksternal_elektro, $kategori);
        }

        $data['penelitian_internal_elektro'] = $this->Ewmp_model->get_penelitian_internal_elektro($tahun);

        // Iterasi untuk mendapatkan anggota setiap penelitian_internal
        foreach ($data['penelitian_internal_elektro'] as $key => $penelitian_internal) {
            $id_penelitian_internal_elektro = $penelitian_internal->id;
            $kategori = 'Penelitian';
            $data['penelitian_internal_elektro'][$key]->anggota_penelitian_internal_elektro = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_penelitian_internal_elektro, $kategori);
        }

        $data['pengabdian_internal_elektro'] = $this->Ewmp_model->get_pengabdian_internal_elektro($tahun);

        // Iterasi untuk mendapatkan anggota setiap pengabdian_internal
        foreach ($data['pengabdian_internal_elektro'] as $key => $pengabdian_internal) {
            $id_pengabdian_internal_elektro = $pengabdian_internal->id;
            $kategori = 'pengabdian';
            $data['pengabdian_internal_elektro'][$key]->anggota_pengabdian_internal_elektro = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_pengabdian_internal_elektro, $kategori);
        }

        $data['pengabdian_eksternal_elektro'] = $this->Ewmp_model->get_pengabdian_eksternal_elektro($tahun);

        // Iterasi untuk mendapatkan anggota setiap pengabdian_eksternal
        foreach ($data['pengabdian_eksternal_elektro'] as $key => $pengabdian_eksternal) {
            $id_pengabdian_eksternal_elektro = $pengabdian_eksternal->id;
            $kategori = 'pengabdian';
            $data['pengabdian_eksternal_elektro'][$key]->anggota_pengabdian_eksternal_elektro = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_pengabdian_eksternal_elektro, $kategori);
        }

        // CETAK PELAPORAN TEKNIK INDUSTRI

        // Publikasi Teknik Industri
        $data['publikasi_nasional_industri'] = $this->Ewmp_model->get_publikasi_nasional_industri($tahun);

        // Iterasi untuk mendapatkan anggota setiap publikasi
        foreach ($data['publikasi_nasional_industri'] as $key => $publikasi) {
            $id_publikasi_nasional_industri = $publikasi->id;
            $kategori = 'Artikel/Karya Ilmiah';
            $data['publikasi_nasional_industri'][$key]->anggota_publikasi_nasional_industri = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_publikasi_nasional_industri, $kategori);
        }

        $data['publikasi_internasional_industri'] = $this->Ewmp_model->get_publikasi_internasional_industri($tahun);

        // Iterasi untuk mendapatkan anggota setiap publikasi
        foreach ($data['publikasi_internasional_industri'] as $key => $publikasi) {
            $id_publikasi_internasional_industri = $publikasi->id;
            $kategori = 'Artikel/Karya Ilmiah';
            $data['publikasi_internasional_industri'][$key]->anggota_publikasi_internasional_industri = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_publikasi_internasional_industri, $kategori);
        }

        $data['seminar_nasional_industri'] = $this->Ewmp_model->get_seminar_nasional_industri($tahun);

        // Iterasi untuk mendapatkan anggota setiap seminar
        foreach ($data['seminar_nasional_industri'] as $key => $seminar) {
            $id_seminar_nasional_industri = $seminar->id;
            $kategori = 'Prosiding';
            $data['seminar_nasional_industri'][$key]->anggota_seminar_nasional_industri = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_seminar_nasional_industri, $kategori);
        }

        $data['seminar_internasional_industri'] = $this->Ewmp_model->get_seminar_internasional_industri($tahun);

        // Iterasi untuk mendapatkan anggota setiap seminar
        foreach ($data['seminar_internasional_industri'] as $key => $seminar) {
            $id_seminar_internasional_industri = $seminar->id;
            $kategori = 'Prosiding';
            $data['seminar_internasional_industri'][$key]->anggota_seminar_internasional_industri = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_seminar_internasional_industri, $kategori);
        }

        $data['hcipta_industri'] = $this->Ewmp_model->get_hcipta_industri($tahun);

        // Iterasi untuk mendapatkan anggota setiap hcipta
        foreach ($data['hcipta_industri'] as $key => $hcipta) {
            $id_hcipta_industri = $hcipta->id;
            $kategori = 'Hak Cipta';
            $data['hcipta_industri'][$key]->anggota_hcipta_industri = $this->Ewmp_model->get_inventor_haki_by_id($id_hcipta_industri, $kategori);
        }

        $data['dindustri_industri'] = $this->Ewmp_model->get_dindustri_industri($tahun);

        // Iterasi untuk mendapatkan anggota setiap dindustri
        foreach ($data['dindustri_industri'] as $key => $dindustri) {
            $id_dindustri_industri = $dindustri->id;
            $kategori = 'Desain Industri';
            $data['dindustri_industri'][$key]->anggota_dindustri_industri = $this->Ewmp_model->get_inventor_haki_by_id($id_dindustri_industri, $kategori);
        }

        $data['paten_industri'] = $this->Ewmp_model->get_paten_industri($tahun);

        // Iterasi untuk mendapatkan anggota setiap paten
        foreach ($data['paten_industri'] as $key => $paten) {
            $id_paten_industri = $paten->id;
            $kategori = 'Paten';
            $data['paten_industri'][$key]->anggota_paten_industri = $this->Ewmp_model->get_inventor_haki_by_id($id_paten_industri, $kategori);
        }

        $data['penelitian_eksternal_industri'] = $this->Ewmp_model->get_penelitian_eksternal_industri($tahun);

        // Iterasi untuk mendapatkan anggota setiap penelitian eksternal
        foreach ($data['penelitian_eksternal_industri'] as $key => $penelitian_eksternal) {
            $id_penelitian_eksternal_industri = $penelitian_eksternal->id;
            $kategori = 'Penelitian';
            $data['penelitian_eksternal_industri'][$key]->anggota_penelitian_eksternal_industri = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_penelitian_eksternal_industri, $kategori);
        }

        $data['penelitian_internal_industri'] = $this->Ewmp_model->get_penelitian_internal_industri($tahun);

        // Iterasi untuk mendapatkan anggota setiap penelitian internal
        foreach ($data['penelitian_internal_industri'] as $key => $penelitian_internal) {
            $id_penelitian_internal_industri = $penelitian_internal->id;
            $kategori = 'Penelitian';
            $data['penelitian_internal_industri'][$key]->anggota_penelitian_internal_industri = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_penelitian_internal_industri, $kategori);
        }

        $data['pengabdian_eksternal_industri'] = $this->Ewmp_model->get_pengabdian_eksternal_industri($tahun);

        // Iterasi untuk mendapatkan anggota setiap pengabdian eksternal
        foreach ($data['pengabdian_eksternal_industri'] as $key => $pengabdian_eksternal) {
            $id_pengabdian_eksternal_industri = $pengabdian_eksternal->id;
            $kategori = 'pengabdian';
            $data['pengabdian_eksternal_industri'][$key]->anggota_pengabdian_eksternal_industri = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_pengabdian_eksternal_industri, $kategori);
        }

        $data['pengabdian_internal_industri'] = $this->Ewmp_model->get_pengabdian_internal_industri($tahun);

        // Iterasi untuk mendapatkan anggota setiap pengabdian internal
        foreach ($data['pengabdian_internal_industri'] as $key => $pengabdian_internal) {
            $id_pengabdian_internal_industri = $pengabdian_internal->id;
            $kategori = 'pengabdian';
            $data['pengabdian_internal_industri'][$key]->anggota_pengabdian_internal_industri = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_pengabdian_internal_industri, $kategori);
        }

        // CETAK PELAPORAN TEKNIK BIOMEDIS

        // Publikasi Biomedis
        $data['publikasi_nasional_biomedis'] = $this->Ewmp_model->get_publikasi_nasional_biomedis($tahun);

        // Iterasi untuk mendapatkan anggota setiap publikasi
        foreach ($data['publikasi_nasional_biomedis'] as $key => $publikasi) {
            $id_publikasi_nasional_biomedis = $publikasi->id;
            $kategori = 'Artikel/Karya Ilmiah';
            $data['publikasi_nasional_biomedis'][$key]->anggota_publikasi_nasional_biomedis = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_publikasi_nasional_biomedis, $kategori);
        }

        $data['publikasi_internasional_biomedis'] = $this->Ewmp_model->get_publikasi_internasional_biomedis($tahun);

        // Iterasi untuk mendapatkan anggota setiap publikasi
        foreach ($data['publikasi_internasional_biomedis'] as $key => $publikasi) {
            $id_publikasi_internasional_biomedis = $publikasi->id;
            $kategori = 'Artikel/Karya Ilmiah';
            $data['publikasi_internasional_biomedis'][$key]->anggota_publikasi_internasional_biomedis = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_publikasi_internasional_biomedis, $kategori);
        }

        $data['seminar_nasional_biomedis'] = $this->Ewmp_model->get_seminar_nasional_biomedis($tahun);

        // Iterasi untuk mendapatkan anggota setiap seminar
        foreach ($data['seminar_nasional_biomedis'] as $key => $seminar) {
            $id_seminar_nasional_biomedis = $seminar->id;
            $kategori = 'Prosiding';
            $data['seminar_nasional_biomedis'][$key]->anggota_seminar_nasional_biomedis = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_seminar_nasional_biomedis, $kategori);
        }

        $data['seminar_internasional_biomedis'] = $this->Ewmp_model->get_seminar_internasional_biomedis($tahun);

        // Iterasi untuk mendapatkan anggota setiap seminar
        foreach ($data['seminar_internasional_biomedis'] as $key => $seminar) {
            $id_seminar_internasional_biomedis = $seminar->id;
            $kategori = 'Prosiding';
            $data['seminar_internasional_biomedis'][$key]->anggota_seminar_internasional_biomedis = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_seminar_internasional_biomedis, $kategori);
        }

        $data['hcipta_biomedis'] = $this->Ewmp_model->get_hcipta_biomedis($tahun);

        // Iterasi untuk mendapatkan anggota setiap hcipta
        foreach ($data['hcipta_biomedis'] as $key => $hcipta) {
            $id_hcipta_biomedis = $hcipta->id;
            $kategori = 'Hak Cipta';
            $data['hcipta_biomedis'][$key]->anggota_hcipta_biomedis = $this->Ewmp_model->get_inventor_haki_by_id($id_hcipta_biomedis, $kategori);
        }

        $data['dindustri_biomedis'] = $this->Ewmp_model->get_dindustri_biomedis($tahun);

        // Iterasi untuk mendapatkan anggota setiap dindustri
        foreach ($data['dindustri_biomedis'] as $key => $dindustri) {
            $id_dindustri_biomedis = $dindustri->id;
            $kategori = 'Desain Industri';
            $data['dindustri_biomedis'][$key]->anggota_dindustri_biomedis = $this->Ewmp_model->get_inventor_haki_by_id($id_dindustri_biomedis, $kategori);
        }

        $data['paten_biomedis'] = $this->Ewmp_model->get_paten_biomedis($tahun);

        // Iterasi untuk mendapatkan anggota setiap paten
        foreach ($data['paten_biomedis'] as $key => $paten) {
            $id_paten_biomedis = $paten->id;
            $kategori = 'Paten';
            $data['paten_biomedis'][$key]->anggota_paten_biomedis = $this->Ewmp_model->get_inventor_haki_by_id($id_paten_biomedis, $kategori);
        }

        $data['penelitian_eksternal_biomedis'] = $this->Ewmp_model->get_penelitian_eksternal_biomedis($tahun);

        // Iterasi untuk mendapatkan anggota setiap penelitian eksternal
        foreach ($data['penelitian_eksternal_biomedis'] as $key => $penelitian_eksternal) {
            $id_penelitian_eksternal_biomedis = $penelitian_eksternal->id;
            $kategori = 'Penelitian';
            $data['penelitian_eksternal_biomedis'][$key]->anggota_penelitian_eksternal_biomedis = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_penelitian_eksternal_biomedis, $kategori);
        }

        $data['penelitian_internal_biomedis'] = $this->Ewmp_model->get_penelitian_internal_biomedis($tahun);

        // Iterasi untuk mendapatkan anggota setiap penelitian internal
        foreach ($data['penelitian_internal_biomedis'] as $key => $penelitian_internal) {
            $id_penelitian_internal_biomedis = $penelitian_internal->id;
            $kategori = 'Penelitian';
            $data['penelitian_internal_biomedis'][$key]->anggota_penelitian_internal_biomedis = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_penelitian_internal_biomedis, $kategori);
        }

        $data['pengabdian_eksternal_biomedis'] = $this->Ewmp_model->get_pengabdian_eksternal_biomedis($tahun);

        // Iterasi untuk mendapatkan anggota setiap pengabdian eksternal
        foreach ($data['pengabdian_eksternal_biomedis'] as $key => $pengabdian_eksternal) {
            $id_pengabdian_eksternal_biomedis = $pengabdian_eksternal->id;
            $kategori = 'pengabdian';
            $data['pengabdian_eksternal_biomedis'][$key]->anggota_pengabdian_eksternal_biomedis = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_pengabdian_eksternal_biomedis, $kategori);
        }

        $data['pengabdian_internal_biomedis'] = $this->Ewmp_model->get_pengabdian_internal_biomedis($tahun);

        // Iterasi untuk mendapatkan anggota setiap pengabdian internal
        foreach ($data['pengabdian_internal_biomedis'] as $key => $pengabdian_internal) {
            $id_pengabdian_internal_biomedis = $pengabdian_internal->id;
            $kategori = 'pengabdian';
            $data['pengabdian_internal_biomedis'][$key]->anggota_pengabdian_internal_biomedis = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_pengabdian_internal_biomedis, $kategori);
        }

        // Load view sebagai HTML
        $html = $this->load->view('backend/ewmp/pdf/cetak_hasil', $data, true);

        // Load HTML content ke Dompdf
        $dompdf->loadHtml($html);

        // Set ukuran kertas dan orientasi
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF
        $dompdf->render();

        // Output PDF (1 = download, 0 = preview)
        $dompdf->stream("hasil_pelaporan_{$tahun}.pdf", array("Attachment" => 0));
    }
}
