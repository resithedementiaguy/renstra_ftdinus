<?php
defined('BASEPATH') or exit('No direct script access allowed');

//Include autoloader dari Composer
require 'dompdf/vendor/autoload.php';

use Dompdf\Dompdf;

class Ewmp extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ewmp_model');
        $this->load->model('Mod_tahun');

        // Cek login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['pelaporan'] = $this->Ewmp_model->get_pelaporan_ewmp();
        $this->load->view('backend/partials/header');
        $this->load->view('backend/ewmp/view', $data);
        $this->load->view('backend/partials/footer');
    }

    public function create_view()
    {
        $data['tahun'] = $this->Mod_tahun->get_all_tahun();
        $this->load->view('backend/partials/header');
        $this->load->view('backend/ewmp/add', $data);
        $this->load->view('backend/partials/footer');
    }

    public function hasil()
    {
        $data['data_internasional'] = $this->Ewmp_model->count_publikasi_internasional_data();
        $data['data_nasional'] = $this->Ewmp_model->count_publikasi_nasional_data();

        // Hitung total data
        $data['total'] = $data['data_nasional'] + $data['data_internasional'];

        // Hitung persentase
        if ($data['total'] > 0) { // Hindari pembagian dengan nol
            $data['persentase_nasional'] = ($data['data_nasional'] / $data['total']) * 100;
            $data['persentase_internasional'] = ($data['data_internasional'] / $data['total']) * 100;
        } else {
            $data['persentase_nasional'] = 0;
            $data['persentase_internasional'] = 0;
        }

        $data['tahun'] = $this->Mod_tahun->get_all_tahun();

        // Kirim data ke view
        $this->load->view('backend/partials/header');
        $this->load->view('backend/ewmp/hasil', $data);
        $this->load->view('backend/partials/footer');
    }

    public function add()
    {
        $jenis_lapor = $this->input->post('jenis_lapor');

        date_default_timezone_set('Asia/Jakarta');
        $ins_time = date('Y-m-d H:i:s', time());

        if ($jenis_lapor == 'Penelitian') {
            $this->form_validation->set_rules('nama_ketua_penelitian', 'Nama Ketua', 'required');
            $this->form_validation->set_rules('prodi_penelitian', 'Program Studi', 'required');
            $this->form_validation->set_rules('kategori_penelitian', 'Kategori', 'required');
            $this->form_validation->set_rules('judul_penelitian', 'judul', 'required');
            $this->form_validation->set_rules('skim_penelitian', 'skim', 'required');
            $this->form_validation->set_rules('pemberi_hibah_penelitian', 'pemberi hibah', 'required');
            $this->form_validation->set_rules('besar_hibah_penelitian', 'besar hibah', 'required');
            $this->form_validation->set_rules('kontrak_penelitian', 'link kontrak penelitian', 'required');
            $this->form_validation->set_rules('laporan_maju_penelitian', 'link laporan maju penelitian', 'required');
        } elseif ($jenis_lapor == 'Pengabdian') {
            $this->form_validation->set_rules('nama_ketua_pengabdian', 'Nama Ketua', 'required');
            $this->form_validation->set_rules('prodi_pengabdian', 'Program Studi', 'required');
            $this->form_validation->set_rules('kategori_pengabdian', 'Kategori', 'required');
            $this->form_validation->set_rules('judul_pengabdian', 'judul', 'required');
            $this->form_validation->set_rules('skim_pengabdian', 'skim', 'required');
            $this->form_validation->set_rules('pemberi_hibah_pengabdian', 'pemberi hibah', 'required');
            $this->form_validation->set_rules('besar_hibah_pengabdian', 'besar hibah', 'required');
            $this->form_validation->set_rules('kontrak_pengabdian', 'link kontrak pengabdian', 'required');
            $this->form_validation->set_rules('laporan_pengabdian', 'link laporan pengabdian', 'required');
        } elseif ($jenis_lapor == 'Artikel/Karya Ilmiah') {
            $this->form_validation->set_rules('nama_pertama_ilmiah', 'Nama pertama', 'required');
            $this->form_validation->set_rules('nama_korespon_ilmiah', 'Nama korespon', 'required');
            $this->form_validation->set_rules('kategori_ilmiah', 'Kategori', 'required');
            $this->form_validation->set_rules('judul_artikel_ilmiah', 'judul artikel', 'required');
            $this->form_validation->set_rules('judul_jurnal_ilmiah', 'judul jurnal', 'required');
            $this->form_validation->set_rules('link_jurnal_ilmiah', 'Link jurnal', 'required');
            $this->form_validation->set_rules('volume_jurnal_ilmiah', 'volume jurnal', 'required');

            $kategori = $this->input->post('kategori_ilmiah');
            // Tambahkan field `pengindeks` jika kategori internasional
            $internasional = ["Internasional Q1", "Internasional Q2", "Internasional Q3", "Internasional Q4", "Internasional Non Scopus"];
            if (in_array($kategori, $internasional)) {
                $this->form_validation->set_rules('pengindeks_ilmiah', 'pengindeks', 'required');
            }
        } elseif ($jenis_lapor == 'Prosiding') {
            $this->form_validation->set_rules('nama_pertama_prosiding', 'Nama pertama', 'required');
            $this->form_validation->set_rules('nama_korespon_prosiding', 'Nama korespon', 'required');
            $this->form_validation->set_rules('kategori_prosiding', 'Kategori', 'required');
            $this->form_validation->set_rules('judul_artikel_prosiding', 'judul artikel', 'required');
            $this->form_validation->set_rules('judul_seminar_prosiding', 'judul seminar', 'required');
            $this->form_validation->set_rules('bukti_loa_prosiding', 'link bukti LOA', 'required');
        } elseif ($jenis_lapor == 'HAKI') {
            $haki = $this->input->post('kategori_haki');
            if ($haki == 'Hak Cipta') {
                $this->form_validation->set_rules('nama_pengusul_hcipta', 'Nama pengusul', 'required');
                $this->form_validation->set_rules('judul_hcipta', 'judul', 'required');
                $this->form_validation->set_rules('sertifikat_hcipta', 'sertifikat hak cipta', 'required');
            } elseif ($haki == 'Merk') {
                $this->form_validation->set_rules('nama_pengusul_merk', 'Nama pengusul', 'required');
                $this->form_validation->set_rules('judul_merk', 'judul', 'required');
                $this->form_validation->set_rules('sertifikat_merk', 'sertifikat merk', 'required');
            } elseif ($haki == 'Lisensi') {
                $this->form_validation->set_rules('nama_pengusul_lisensi', 'Nama pengusul', 'required');
                $this->form_validation->set_rules('judul_lisensi', 'judul', 'required');
                $this->form_validation->set_rules('sertifikat_lisensi', 'sertifikat lisensi', 'required');
            } elseif ($haki == 'Buku') {
                $this->form_validation->set_rules('nama_pengusul_buku', 'Nama pengusul', 'required');
                $this->form_validation->set_rules('isbn_buku', 'ISBN', 'required');
                $this->form_validation->set_rules('judul_buku', 'judul', 'required');
                $this->form_validation->set_rules('file_buku', 'file buku', 'required');
            } elseif ($haki == 'Paten') {
                $this->form_validation->set_rules('judul_invensi_paten', 'judul', 'required');
                $this->form_validation->set_rules('sertifikat_paten', 'sertifikat paten', 'required');
            } elseif ($haki == 'Desain Industri') {
                // Tambahkan validasi untuk Desain Industri
                $this->form_validation->set_rules('nama_pengusul_desain[]', 'Nama Pengusul', 'required');
                $this->form_validation->set_rules('sertifikat_desain', 'sertifikat desain', 'required');
                // Tambahkan validasi lain yang diperlukan
            }
        } elseif ($jenis_lapor == 'Editor Jurnal') {
            $this->form_validation->set_rules('nama_pengusul_editor', 'Nama pengusul', 'required');
            $this->form_validation->set_rules('judul_jurnal_editor', 'judul jurnal', 'required');
            $this->form_validation->set_rules('sk_editor', 'link sk', 'required');
        } elseif ($jenis_lapor == 'Reviewer Jurnal') {
            $this->form_validation->set_rules('nama_pengusul_reviewer', 'Nama pengusul', 'required');
            $this->form_validation->set_rules('judul_artikel_reviewer', 'judul artikel', 'required');
            $this->form_validation->set_rules('judul_jurnal_reviewer', 'judul jurnal', 'required');
            $this->form_validation->set_rules('sertifikat_reviewer', 'link sertifikat reviewer', 'required');
        } elseif ($jenis_lapor == 'Invited Speaker') {
            $this->form_validation->set_rules('nama_pengusul_speaker', 'Nama pengusul', 'required');
            $this->form_validation->set_rules('judul_kegiatan', 'judul kegiatan', 'required');
            $this->form_validation->set_rules('penyelenggara', 'penyelenggara', 'required');
            $this->form_validation->set_rules('laporan_maju_speaker', 'link laporan maju', 'required');
        } elseif ($jenis_lapor == 'Pengurus Organisasi Profesi') {
            $this->form_validation->set_rules('nama_organisasi', 'Nama organisasi', 'required');
            $this->form_validation->set_rules('jabatan_organisasi', 'jabatan organisasi', 'required');
            $this->form_validation->set_rules('masa_jabatan_organisasi', 'masa jabatan', 'required');
            $this->form_validation->set_rules('dokumen_organisasi', 'link dokumen', 'required');
        }

        if ($this->form_validation->run() === FALSE) {
            $errors = validation_errors('<li>', '</li>');
            $this->session->set_flashdata('error', $errors);
            $this->session->set_flashdata('show_modal', true); // Indikator untuk memicu modal
            redirect('ewmp/create_view'); // Ganti dengan URL form Anda
        } else {

            $data = array(
                'email' => $this->input->post('email'),
                'jenis_lapor' => $jenis_lapor,
                'ins_time' => $ins_time
            );

            $this->Ewmp_model->add_pelaporan_ewmp($data);

            $id_pelaporan = $this->Ewmp_model->get_last_pelaporan_id();

            if ($jenis_lapor == 'Penelitian') {
                // $config = array(
                //     'upload_path' => './uploads/penelitian',
                //     'allowed_types' => 'pdf',
                //     'max_size' => 102400, // Maks 100 MB
                // );

                // $this->load->library('upload', $config);

                // $kontrak = null;
                // $laporan_maju = null;

                // // Upload kontrak penelitian
                // if (!empty($_FILES['kontrak_penelitian']['name'])) {
                //     $config['file_name'] = 'kontrak_' . time(); // Rename file
                //     $this->upload->initialize($config);

                //     if ($this->upload->do_upload('kontrak_penelitian')) {
                //         $kontrak = $this->upload->data('file_name');
                //     } else {
                //         $this->session->set_flashdata('error', $this->upload->display_errors());
                //         redirect('ewmp/create_view');
                //     }
                // }

                // // Upload laporan kemajuan penelitian
                // if (!empty($_FILES['laporan_maju_penelitian']['name'])) {
                //     $config['file_name'] = 'laporan_maju_' . time(); // Rename file
                //     $this->upload->initialize($config);

                //     if ($this->upload->do_upload('laporan_maju_penelitian')) {
                //         $laporan_maju = $this->upload->data('file_name');
                //     } else {
                //         $this->session->set_flashdata('error', $this->upload->display_errors());
                //         redirect('ewmp/create_view');
                //     }
                // }

                // Data spesifik penelitian
                $data_penelitian = array(
                    'id_pelaporan' => $id_pelaporan,
                    'tahun' => $this->input->post('tahun'),
                    'nama_ketua' => $this->input->post('nama_ketua_penelitian'),
                    'prodi' => $this->input->post('prodi_penelitian'),
                    'kategori' => $this->input->post('kategori_penelitian'),
                    'judul' => $this->input->post('judul_penelitian'),
                    'skim' => $this->input->post('skim_penelitian'),
                    'pemberi_hibah' => $this->input->post('pemberi_hibah_penelitian'),
                    'besar_hibah' => $this->input->post('besar_hibah_penelitian'),
                    'kontrak' => $this->input->post('kontrak_penelitian'),
                    'laporan_maju' => $this->input->post('laporan_maju_penelitian'),
                    'ins_time' => $ins_time
                );

                // Menyimpan data penelitian
                $this->Ewmp_model->add_penelitian($data_penelitian);

                // Dapatkan ID penelitian terbaru
                $id_penelitian = $this->Ewmp_model->get_last_penelitian_id();

                // Menyimpan data anggota penelitian
                $program_studi_anggota = $this->input->post();
                $nama_anggota = $this->input->post('nama_anggota_penelitian');

                if (!empty($nama_anggota) && is_array($nama_anggota)) {
                    $index = 1; // Mulai dari 1
                    foreach (array_values($nama_anggota) as $nama) {
                        // Cari program studi anggota sesuai indeks
                        $prodi_key = 'prodi_anggota_penelitian_' . $index;
                        $prodi = isset($program_studi_anggota[$prodi_key]) ? $program_studi_anggota[$prodi_key] : null;

                        $data_anggota = array(
                            'id_jenis_lapor' => $id_penelitian,
                            'kategori' => 'Penelitian',
                            'nama' => $nama,
                            'prodi' => $prodi
                        );

                        // Panggil fungsi model untuk menyimpan anggota
                        $this->Ewmp_model->add_anggota_pelaporan($data_anggota);

                        $index++; // Increment untuk iterasi berikutnya
                    }
                }

                // Menyimpan data mahasiswa penelitian
                $nim = $this->input->post('nim_mahasiswa_penelitian');
                $nama_mahasiswa = $this->input->post('nama_mahasiswa_penelitian');

                if (!empty($nama_mahasiswa) && is_array($nama_mahasiswa)) {
                    foreach ($nama_mahasiswa as $index => $nama) {

                        $data_mahasiswa = array(
                            'id_jenis_lapor' => $id_penelitian,
                            'kategori' => 'Penelitian',
                            'nama' => $nama,
                            'nim' => $nim[$index]
                        );

                        // Panggil fungsi model untuk menyimpan mahasiswa
                        $this->Ewmp_model->add_mhs_pelaporan($data_mahasiswa);
                    }
                }
            } elseif ($jenis_lapor == 'Pengabdian') {
                // $config = array(
                //     'upload_path' => './uploads/pengabdian',
                //     'allowed_types' => 'pdf',
                //     'max_size' => 10240, // Maks 100 MB
                // );

                // $this->load->library('upload', $config);

                // $kontrak = null;
                // $laporan = null;

                // // Upload kontrak pengabdian
                // if (!empty($_FILES['kontrak_pengabdian']['name'])) {
                //     $config['file_name'] = 'kontrak_' . time(); // Rename file
                //     $this->upload->initialize($config);

                //     if ($this->upload->do_upload('kontrak_pengabdian')) {
                //         $kontrak = $this->upload->data('file_name');
                //     } else {
                //         // Tangani error upload
                //         $this->session->set_flashdata('error', $this->upload->display_errors());
                //         redirect('ewmp/create_view');
                //     }
                // }

                // // Upload laporan kemajuan pengabdian
                // if (!empty($_FILES['laporan_pengabdian']['name'])) {
                //     $config['file_name'] = 'laporan_' . time(); // Rename file
                //     $this->upload->initialize($config);

                //     if ($this->upload->do_upload('laporan_pengabdian')) {
                //         $laporan = $this->upload->data('file_name');
                //     } else {
                //         // Tangani error upload
                //         $this->session->set_flashdata('error', $this->upload->display_errors());
                //         redirect('ewmp/create_view');
                //     }
                // }

                // Data spesifik pengabdian
                $data_pengabdian = array(
                    'id_pelaporan' => $id_pelaporan,
                    'tahun' => $this->input->post('tahun'),
                    'nama_ketua' => $this->input->post('nama_ketua_pengabdian'),
                    'prodi' => $this->input->post('prodi_pengabdian'),
                    'kategori' => $this->input->post('kategori_pengabdian'),
                    'judul' => $this->input->post('judul_pengabdian'),
                    'skim' => $this->input->post('skim_pengabdian'),
                    'pemberi_hibah' => $this->input->post('pemberi_hibah_pengabdian'),
                    'besar_hibah' => $this->input->post('besar_hibah_pengabdian'),
                    'kontrak' => $this->input->post('kontrak_pengabdian'),
                    'laporan' => $this->input->post('laporan_pengabdian'),
                    'ins_time' => $ins_time
                );
                // Menyimpan data pengabdian
                $this->Ewmp_model->add_pengabdian($data_pengabdian);

                // Dapatkan ID pengabdian terbaru
                $id_pengabdian = $this->Ewmp_model->get_last_pengabdian_id();

                // Menyimpan data anggota pengabdian
                $program_studi_anggota = $this->input->post();
                $nama_anggota = $this->input->post('nama_anggota_pengabdian');

                if (!empty($nama_anggota) && is_array($nama_anggota)) {
                    $index = 1; // Mulai dari 1
                    foreach (array_values($nama_anggota) as $nama) {
                        // Cari program studi anggota sesuai indeks
                        $prodi_key = 'prodi_anggota_pengabdian_' . $index;
                        $prodi = isset($program_studi_anggota[$prodi_key]) ? $program_studi_anggota[$prodi_key] : null;

                        $data_anggota = array(
                            'id_jenis_lapor' => $id_pengabdian,
                            'kategori' => 'Pengabdian',
                            'nama' => $nama,
                            'prodi' => $prodi
                        );

                        // Panggil fungsi model untuk menyimpan anggota
                        $this->Ewmp_model->add_anggota_pelaporan($data_anggota);

                        $index++; // Increment untuk iterasi berikutnya
                    }
                }

                // Menyimpan data mahasiswa pengabdian
                $nim = $this->input->post('nim_mahasiswa_pengabdian');
                $nama_mahasiswa = $this->input->post('nama_mahasiswa_pengabdian');

                if (!empty($nama_mahasiswa) && is_array($nama_mahasiswa)) {
                    foreach ($nama_mahasiswa as $index => $nama) {

                        $data_mahasiswa = array(
                            'id_jenis_lapor' => $id_pengabdian,
                            'kategori' => 'Pengabdian',
                            'nama' => $nama,
                            'nim' => $nim[$index]
                        );

                        // Panggil fungsi model untuk menyimpan mahasiswa
                        $this->Ewmp_model->add_mhs_pelaporan($data_mahasiswa);
                    }
                }
            } elseif ($jenis_lapor == 'Artikel/Karya Ilmiah') {
                $kategori = $this->input->post('kategori_ilmiah');
                $data_ilmiah = array(
                    'id_pelaporan' => $id_pelaporan,
                    'tahun' => $this->input->post('tahun'),
                    'kategori' => $kategori,
                    'nama_pertama' => $this->input->post('nama_pertama_ilmiah'),
                    'prodi' => $this->input->post('prodi_ilmiah'),
                    'nama_korespon' => $this->input->post('nama_korespon_ilmiah'),
                    'judul_artikel' => $this->input->post('judul_artikel_ilmiah'),
                    'judul_jurnal' => $this->input->post('judul_jurnal_ilmiah'),
                    'link_jurnal' => $this->input->post('link_jurnal_ilmiah'),
                    'volume_jurnal' => $this->input->post('volume_jurnal_ilmiah'),
                    'nomor_jurnal' => $this->input->post('nomor_jurnal_ilmiah'),
                    'doi' => $this->input->post('doi_ilmiah'),
                    'ins_time' => $ins_time
                );

                // Tambahkan field `pengindeks` jika kategori internasional
                $internasional = ["Internasional Q1", "Internasional Q2", "Internasional Q3", "Internasional Q4", "Internasional Non Scopus"];
                if (in_array($kategori, $internasional)) {
                    $data_ilmiah['pengindeks'] = $this->input->post('pengindeks_ilmiah');
                }

                // Menyimpan data artikel/karya ilmiah
                $this->Ewmp_model->add_artikel_ilmiah($data_ilmiah);

                // Dapatkan ID ilmiah terbaru
                $id_ilmiah = $this->Ewmp_model->get_last_artikel_ilmiah_id();

                // Menyimpan data anggota ilmiah
                $program_studi_anggota = $this->input->post();
                $nama_anggota = $this->input->post('nama_anggota_ilmiah');

                if (!empty($nama_anggota) && is_array($nama_anggota)) {
                    $index = 1; // Mulai dari 1
                    foreach (array_values($nama_anggota) as $nama) {
                        // Cari program studi anggota sesuai indeks
                        $prodi_key = 'prodi_anggota_ilmiah_' . $index;
                        $prodi = isset($program_studi_anggota[$prodi_key]) ? $program_studi_anggota[$prodi_key] : null;

                        $data_anggota = array(
                            'id_jenis_lapor' => $id_ilmiah,
                            'kategori' => 'Artikel/Karya Ilmiah',
                            'nama' => $nama,
                            'prodi' => $prodi
                        );

                        // Panggil fungsi model untuk menyimpan anggota
                        $this->Ewmp_model->add_anggota_pelaporan($data_anggota);

                        $index++; // Increment untuk iterasi berikutnya
                    }
                }
            } elseif ($jenis_lapor == 'Prosiding') {
                // $config = array(
                //     'upload_path' => './uploads/prosiding',
                //     'allowed_types' => 'pdf',
                //     'max_size' => 10240, // Maks 100 MB
                // );

                // $this->load->library('upload', $config);

                // $bukti_loa = null;

                // // Upload bukti_loa prosiding
                // if (!empty($_FILES['bukti_loa_prosiding']['name'])) {
                //     $config['file_name'] = 'bukti_loa_' . time(); // Rename file
                //     $this->upload->initialize($config);

                //     if ($this->upload->do_upload('bukti_loa_prosiding')) {
                //         $bukti_loa = $this->upload->data('file_name');
                //     } else {
                //         // Tangani error upload
                //         $this->session->set_flashdata('error', $this->upload->display_errors());
                //         redirect('ewmp/create_view');
                //     }
                // }

                // Data spesifik prosiding
                $data_prosiding = array(
                    'id_pelaporan' => $id_pelaporan,
                    'tahun' => $this->input->post('tahun'),
                    'kategori' => $this->input->post('kategori_prosiding'),
                    'nama_pertama' => $this->input->post('nama_pertama_prosiding'),
                    'prodi' => $this->input->post('prodi_prosiding'),
                    'nama_korespon' => $this->input->post('nama_korespon_prosiding'),
                    'judul_artikel' => $this->input->post('judul_artikel_prosiding'),
                    'judul_seminar' => $this->input->post('judul_seminar_prosiding'),
                    'bukti_loa' => $this->input->post('bukti_loa_prosiding'),
                    'doi' => $this->input->post('doi_prosiding'),
                    'ins_time' => $ins_time
                );

                // Menyimpan data prosiding
                $this->Ewmp_model->add_prosiding($data_prosiding);

                // Dapatkan ID prosiding terbaru
                $id_prosiding = $this->Ewmp_model->get_last_prosiding_id();

                // Menyimpan data anggota prosiding
                $program_studi_anggota = $this->input->post();
                $nama_anggota = $this->input->post('nama_anggota_prosiding');

                if (!empty($nama_anggota) && is_array($nama_anggota)) {
                    $index = 1; // Mulai dari 1
                    foreach (array_values($nama_anggota) as $nama) {
                        // Cari program studi anggota sesuai indeks
                        $prodi_key = 'prodi_anggota_prosiding_' . $index;
                        $prodi = isset($program_studi_anggota[$prodi_key]) ? $program_studi_anggota[$prodi_key] : null;

                        $data_anggota = array(
                            'id_jenis_lapor' => $id_prosiding,
                            'kategori' => 'Prosiding',
                            'nama' => $nama,
                            'prodi' => $prodi
                        );

                        // Panggil fungsi model untuk menyimpan anggota
                        $this->Ewmp_model->add_anggota_pelaporan($data_anggota);

                        $index++; // Increment untuk iterasi berikutnya
                    }
                }
            } elseif ($jenis_lapor == 'HAKI') {
                $kategori_haki = $this->input->post('kategori_haki');
                log_message('debug', 'Kategori HAKI: ' . $kategori_haki);

                // Simpan data kategori HAKI ke tabel
                $data_haki = array(
                    'id_pelaporan' => $id_pelaporan,
                    'kategori' => $kategori_haki,
                    'ins_time' => $ins_time
                );
                $this->Ewmp_model->add_haki($data_haki);

                // Ambil ID HAKI terakhir
                $id_haki = $this->Ewmp_model->get_last_haki_id();
                log_message('debug', 'Last HAKI ID: ' . $id_haki);

                if ($kategori_haki == 'Hak Cipta') {
                    // Log data dari form input
                    log_message('debug', 'Nama Pengusul: ' . $this->input->post('nama_pengusul_hcipta'));
                    log_message('debug', 'Nama Pemegang Hak Cipta: ' . $this->input->post('nama_pemegang_hcipta'));
                    log_message('debug', 'Judul Hak Cipta: ' . $this->input->post('judul_hcipta'));

                    // Menyiapkan konfigurasi untuk file upload
                    // $config = array(
                    //     'upload_path' => './uploads/haki/hak_cipta',
                    //     'allowed_types' => 'pdf',
                    //     'max_size' => 10240, // Maks 10 MB
                    // );
                    // $this->load->library('upload', $config);

                    // $sertifikat = null;

                    // // Upload file sertifikat
                    // if (!empty($_FILES['sertifikat_hcipta']['name'])) {
                    //     $config['file_name'] = 'sertifikat_' . time(); // Ganti nama file dengan timestamp
                    //     $this->upload->initialize($config);

                    //     if ($this->upload->do_upload('sertifikat_hcipta')) {
                    //         $sertifikat = $this->upload->data('file_name'); // Menyimpan nama file yang di-upload
                    //         log_message('debug', 'Sertifikat berhasil di-upload: ' . $sertifikat);
                    //     } else {
                    //         log_message('error', 'Upload file sertifikat gagal: ' . $this->upload->display_errors());
                    //         $this->session->set_flashdata('error', 'Gagal meng-upload sertifikat.');
                    //         redirect('ewmp/create_view');
                    //     }
                    // }

                    // Menyimpan data Hak Cipta
                    $data_hak_cipta = array(
                        'id_haki' => $id_haki,
                        'tahun' => $this->input->post('tahun'),
                        'nama_usul' => $this->input->post('nama_pengusul_hcipta'),
                        'prodi' => $this->input->post('prodi_hcipta'),
                        'judul' => $this->input->post('judul_hcipta'),
                        'sertifikat' => $this->input->post('sertifikat_hcipta'),
                        'ins_time' => $ins_time
                    );

                    // Log data yang akan disimpan ke database
                    log_message('debug', 'Data Hak Cipta yang akan disimpan: ' . json_encode($data_hak_cipta));

                    // Pastikan fungsi add_haki_hcipta ada di model
                    $this->Ewmp_model->add_haki_hcipta($data_hak_cipta);

                    // Dapatkan ID hcipta terbaru
                    $id_hcipta = $this->Ewmp_model->get_last_hcipta_id();

                    // Menyimpan data anggota hcipta
                    $nama_anggota = $this->input->post('nama_hcipta');

                    if (!empty($nama_anggota) && is_array($nama_anggota)) {
                        $index = 1;
                        foreach (array_values($nama_anggota) as $nama) {
                            $data_anggota = array(
                                'id_jenis_lapor' => $id_hcipta,
                                'kategori' => 'Hak Cipta',
                                'nama' => $nama
                            );

                            // Panggil fungsi model untuk menyimpan anggota
                            $this->Ewmp_model->add_anggota_pelaporan($data_anggota);

                            $index++; // Increment untuk iterasi berikutnya
                        }
                    }
                } elseif ($kategori_haki == 'Merk') {
                    // $config = array(
                    //     'upload_path' => './uploads/haki/merk',
                    //     'allowed_types' => 'pdf',
                    //     'max_size' => 10240, // Maks 10 MB
                    // );
                    // $this->load->library('upload', $config);

                    // $sertifikat = null;

                    // if (!empty($_FILES['sertifikat_merk']['name'])) {
                    //     $config['file_name'] = 'sertifikat_' . time();
                    //     $this->upload->initialize($config);

                    //     if ($this->upload->do_upload('sertifikat_merk')) {
                    //         $sertifikat = $this->upload->data('file_name');
                    //         log_message('debug', 'Sertifikat Merk berhasil di-upload: ' . $sertifikat);
                    //     } else {
                    //         log_message('error', 'Upload file sertifikat Merk gagal: ' . $this->upload->display_errors());
                    //         $this->session->set_flashdata('error', 'Gagal meng-upload sertifikat.');
                    //         redirect('ewmp/create_view');
                    //     }
                    // }

                    $data_merk = array(
                        'id_haki' => $id_haki,
                        'tahun' => $this->input->post('tahun'),
                        'nama_usul' => $this->input->post('nama_pengusul_merk'),
                        'judul' => $this->input->post('judul_merk'),
                        'sertifikat' => $this->input->post('sertifikat_merk'),
                        'ins_time' => $ins_time
                    );

                    log_message('debug', 'Data Merk yang akan disimpan: ' . json_encode($data_merk));
                    $this->Ewmp_model->add_haki_merk($data_merk);

                    // Dapatkan ID merk terbaru
                    $id_merk = $this->Ewmp_model->get_last_merk_id();

                    // Menyimpan data anggota merk
                    $nama_anggota = $this->input->post('nama_merk'); // Nama pemegang merk yang dikirim dari form

                    if (!empty($nama_anggota) && is_array($nama_anggota)) {
                        $index = 1;
                        foreach (array_values($nama_anggota) as $nama) {
                            $data_anggota = array(
                                'id_jenis_lapor' => $id_merk,
                                'kategori' => 'Merk',
                                'nama' => $nama
                            );

                            // Panggil fungsi model untuk menyimpan anggota
                            $this->Ewmp_model->add_anggota_pelaporan($data_anggota);

                            $index++; // Increment untuk iterasi berikutnya
                        }
                    }
                } elseif ($kategori_haki == 'Lisensi') {
                    // $config = array(
                    //     'upload_path' => './uploads/haki/lisensi',
                    //     'allowed_types' => 'pdf',
                    //     'max_size' => 10240, // Maks 10 MB
                    // );
                    // $this->load->library('upload', $config);

                    // $sertifikat = null;

                    // if (!empty($_FILES['sertifikat_lisensi']['name'])) {
                    //     $config['file_name'] = 'sertifikat_' . time();
                    //     $this->upload->initialize($config);

                    //     if ($this->upload->do_upload('sertifikat_lisensi')) {
                    //         $sertifikat = $this->upload->data('file_name');
                    //         log_message('debug', 'Sertifikat Lisensi berhasil di-upload: ' . $sertifikat);
                    //     } else {
                    //         log_message('error', 'Upload file sertifikat Lisensi gagal: ' . $this->upload->display_errors());
                    //         $this->session->set_flashdata('error', 'Gagal meng-upload sertifikat.');
                    //         redirect('ewmp/create_view');
                    //     }
                    // }

                    // Menyimpan data Lisensi
                    $data_lisensi = array(
                        'id_haki' => $id_haki,
                        'tahun' => $this->input->post('tahun'),
                        'nama_usul' => $this->input->post('nama_pengusul_lisensi'),
                        'judul' => $this->input->post('judul_lisensi'),
                        'sertifikat' => $this->input->post('sertifikat_lisensi'),
                        'ins_time' => $ins_time
                    );

                    log_message('debug', 'Data Lisensi yang akan disimpan: ' . json_encode($data_lisensi));
                    $this->Ewmp_model->add_haki_lisensi($data_lisensi);

                    // Dapatkan ID lisensi terbaru
                    $id_lisensi = $this->Ewmp_model->get_last_lisensi_id();

                    // Menyimpan data anggota Lisensi
                    $nama_anggota = $this->input->post('nama_lisensi'); // Nama pemegang lisensi yang dikirim dari form

                    if (!empty($nama_anggota) && is_array($nama_anggota)) {
                        $index = 1; // Mulai dari 1
                        foreach (array_values($nama_anggota) as $nama) {
                            $data_anggota = array(
                                'id_jenis_lapor' => $id_lisensi, // ID haki lisensi yang baru saja disimpan
                                'kategori' => 'Lisensi', // Menandakan kategori adalah lisensi
                                'nama' => $nama
                            );

                            // Panggil fungsi model untuk menyimpan anggota
                            $this->Ewmp_model->add_anggota_pelaporan($data_anggota);

                            $index++; // Increment untuk iterasi berikutnya
                        }
                    }
                } elseif ($kategori_haki == 'Buku') {
                    // $config = array(
                    //     'upload_path' => './uploads/haki/buku',
                    //     'allowed_types' => 'pdf',
                    //     'max_size' => 10240, // Maks 10 MB
                    // );
                    // $this->load->library('upload', $config);

                    // $file_buku = null;

                    // if (!empty($_FILES['file_buku']['name'])) {
                    //     $config['file_name'] = 'buku_' . time();
                    //     $this->upload->initialize($config);

                    //     if ($this->upload->do_upload('file_buku')) {
                    //         $file_buku = $this->upload->data('file_name');
                    //         log_message('debug', 'File Buku berhasil di-upload: ' . $file_buku);
                    //     } else {
                    //         log_message('error', 'Upload file Buku gagal: ' . $this->upload->display_errors());
                    //         $this->session->set_flashdata('error', 'Gagal meng-upload file buku.');
                    //         redirect('ewmp/create_view');
                    //     }
                    // }

                    $data_buku = array(
                        'id_haki' => $id_haki,
                        'tahun' => $this->input->post('tahun'),
                        'nama_usul' => $this->input->post('nama_pengusul_buku'),
                        'isbn' => $this->input->post('isbn_buku'),
                        'judul_buku' => $this->input->post('judul_buku'),
                        'file_buku' => $this->input->post('file_buku'),
                        'ins_time' => $ins_time
                    );

                    log_message('debug', 'Data Buku yang akan disimpan: ' . json_encode($data_buku));
                    $this->Ewmp_model->add_haki_buku($data_buku);
                } elseif ($kategori_haki == 'Paten') {

                    // Menyiapkan konfigurasi untuk file upload
                    // $config = array(
                    //     'upload_path' => './uploads/haki/paten',
                    //     'allowed_types' => 'pdf',
                    //     'max_size' => 10240, // Maks 10 MB
                    // );
                    // $this->load->library('upload', $config);

                    // $sertifikat = null;

                    // // Upload file sertifikat
                    // if (!empty($_FILES['sertifikat_paten']['name'])) {
                    //     $config['file_name'] = 'sertifikat_' . time(); // Ganti nama file dengan timestamp
                    //     $this->upload->initialize($config);

                    //     if ($this->upload->do_upload('sertifikat_paten')) {
                    //         $sertifikat = $this->upload->data('file_name'); // Menyimpan nama file yang di-upload
                    //         log_message('debug', 'Sertifikat berhasil di-upload: ' . $sertifikat);
                    //     } else {
                    //         log_message('error', 'Upload file sertifikat gagal: ' . $this->upload->display_errors());
                    //         $this->session->set_flashdata('error', 'Gagal meng-upload sertifikat.');
                    //         redirect('ewmp/create_view');
                    //     }
                    // }

                    // Menyimpan data Hak Cipta
                    $data_paten = array(
                        'id_haki' => $id_haki,
                        'tahun' => $this->input->post('tahun'),
                        'prodi' => $this->input->post('prodi_paten'),
                        'judul' => $this->input->post('judul_invensi_paten'),
                        'sertifikat' => $this->input->post('sertifikat_paten'),
                        'ins_time' => $ins_time
                    );

                    // Log data yang akan disimpan ke database
                    log_message('debug', 'Data Hak Cipta yang akan disimpan: ' . json_encode($data_paten));

                    // Pastikan fungsi add_haki_hcipta ada di model
                    $this->Ewmp_model->add_haki_paten($data_paten);

                    // Dapatkan ID paten terbaru
                    $id_paten = $this->Ewmp_model->get_last_paten_id();

                    // Menyimpan data anggota paten
                    $nama_anggota = $this->input->post('nama_inventor');

                    if (!empty($nama_anggota) && is_array($nama_anggota)) {
                        $index = 1; // Mulai dari 1
                        foreach (array_values($nama_anggota) as $nama) {
                            $data_anggota = array(
                                'id_jenis_lapor' => $id_paten,
                                'kategori' => 'Paten',
                                'nama' => $nama
                            );

                            // Panggil fungsi model untuk menyimpan anggota
                            $this->Ewmp_model->add_anggota_pelaporan($data_anggota);

                            $index++; // Increment untuk iterasi berikutnya
                        }
                    }
                } elseif ($kategori_haki == 'Desain Industri') {

                    // Menyiapkan konfigurasi untuk file upload
                    // $config = array(
                    //     'upload_path' => './uploads/haki/desain_industri',
                    //     'allowed_types' => 'pdf',
                    //     'max_size' => 10240, // Maks 10 MB
                    // );
                    // $this->load->library('upload', $config);

                    // $sertifikat = null;

                    // // Upload file sertifikat
                    // if (!empty($_FILES['sertifikat_desain']['name'])) {
                    //     $config['file_name'] = 'sertifikat_' . time(); // Ganti nama file dengan timestamp
                    //     $this->upload->initialize($config);

                    //     if ($this->upload->do_upload('sertifikat_desain')) {
                    //         $sertifikat = $this->upload->data('file_name'); // Menyimpan nama file yang di-upload
                    //         log_message('debug', 'Sertifikat berhasil di-upload: ' . $sertifikat);
                    //     } else {
                    //         log_message('error', 'Upload file sertifikat gagal: ' . $this->upload->display_errors());
                    //         $this->session->set_flashdata('error', 'Gagal meng-upload sertifikat.');
                    //         redirect('ewmp/create_view');
                    //     }
                    // }

                    // Menyimpan data Hak Cipta
                    $data_desain = array(
                        'id_haki' => $id_haki,
                        'tahun' => $this->input->post('tahun'),
                        'prodi' => $this->input->post('prodi_desain'),
                        'judul' => $this->input->post('judul_desain'),
                        'sertifikat' => $this->input->post('sertifikat_desain'),
                        'ins_time' => $ins_time
                    );

                    // Log data yang akan disimpan ke database
                    log_message('debug', 'Data Hak Cipta yang akan disimpan: ' . json_encode($data_desain));

                    // Pastikan fungsi add_haki_hcipta ada di model
                    $this->Ewmp_model->add_haki_dindustri($data_desain);

                    // Dapatkan ID dindustri terbaru
                    $id_dindustri = $this->Ewmp_model->get_last_dindustri_id();

                    // Menyimpan data anggota dindustri
                    $nama_anggota = $this->input->post('nama_pengusul_desain');

                    if (!empty($nama_anggota) && is_array($nama_anggota)) {
                        $index = 1; // Mulai dari 1
                        foreach (array_values($nama_anggota) as $nama) {
                            $data_anggota = array(
                                'id_jenis_lapor' => $id_dindustri,
                                'kategori' => 'Desain Industri',
                                'nama' => $nama
                            );

                            // Panggil fungsi model untuk menyimpan anggota
                            $this->Ewmp_model->add_anggota_pelaporan($data_anggota);

                            $index++; // Increment untuk iterasi berikutnya
                        }
                    }
                }
            } elseif ($jenis_lapor == "Editor Jurnal") {
                // $config = array(
                //     'upload_path' => './uploads/jurnal/editor_jurnal',
                //     'allowed_types' => 'pdf',
                //     'max_size' => 10240, // Maks 100 MB
                // );

                // $this->load->library('upload', $config);

                // $sk = null;

                // // Upload sk editor
                // if (!empty($_FILES['sk_editor']['name'])) {
                //     $config['file_name'] = 'sk_' . time(); // Rename file
                //     $this->upload->initialize($config);

                //     if ($this->upload->do_upload('sk_editor')) {
                //         $sk = $this->upload->data('file_name');
                //     } else {
                //         // Tangani error upload
                //         $this->session->set_flashdata('error', $this->upload->display_errors());
                //         redirect('ewmp/create_view');
                //     }
                // }

                // Data spesifik editor
                $data_editor = array(
                    'id_pelaporan' => $id_pelaporan,
                    'tahun' => $this->input->post('tahun'),
                    'nama_usul' => $this->input->post('nama_pengusul_editor'),
                    'prodi' => $this->input->post('prodi_editor'),
                    'judul' => $this->input->post('judul_jurnal_editor'),
                    'file_sk' => $this->input->post('sk_editor'),
                    'ins_time' => $ins_time
                );

                // Menyimpan data editor
                $this->Ewmp_model->add_editor_jurnal($data_editor);
            } elseif ($jenis_lapor == "Reviewer Jurnal") {
                // $config = array(
                //     'upload_path' => './uploads/jurnal/reviewer_jurnal',
                //     'allowed_types' => 'pdf',
                //     'max_size' => 10240, // Maks 100 MB
                // );

                // $this->load->library('upload', $config);

                // $sertifikat = null;

                // // Upload sertifikat reviewer
                // if (!empty($_FILES['sertifikat_reviewer']['name'])) {
                //     $config['file_name'] = 'sertifikat_' . time(); // Rename file
                //     $this->upload->initialize($config);

                //     if ($this->upload->do_upload('sertifikat_reviewer')) {
                //         $sertifikat = $this->upload->data('file_name');
                //     } else {
                //         // Tangani error upload
                //         $this->session->set_flashdata('error', $this->upload->display_errors());
                //         redirect('ewmp/create_view');
                //     }
                // }

                // Data spesifik reviewer
                $data_reviewer = array(
                    'id_pelaporan' => $id_pelaporan,
                    'tahun' => $this->input->post('tahun'),
                    'nama_usul' => $this->input->post('nama_pengusul_reviewer'),
                    'prodi' => $this->input->post('prodi_reviewer'),
                    'judul_artikel' => $this->input->post('judul_artikel_reviewer'),
                    'judul_jurnal' => $this->input->post('judul_jurnal_reviewer'),
                    'sertifikat' => $this->input->post('sertifikat_reviewer'),
                    'ins_time' => $ins_time
                );

                // Menyimpan data reviewer
                $this->Ewmp_model->add_reviewer_jurnal($data_reviewer);
            } elseif ($jenis_lapor == 'Invited Speaker') {
                // Menyiapkan konfigurasi untuk file upload
                // $config = array(
                //     'upload_path' => './uploads/invited_speaker',
                //     'allowed_types' => 'pdf',
                //     'max_size' => 10240, // Maks 10 MB
                // );

                // $this->load->library('upload', $config);

                // $laporan_maju_speaker = null;

                // // Upload file laporan undangan, sertifikat, dan bukti kegiatan
                // if (!empty($_FILES['laporan_maju_speaker']['name'])) {
                //     $config['file_name'] = 'laporan_speaker_' . time(); // Ganti nama file dengan timestamp
                //     $this->upload->initialize($config);

                //     if ($this->upload->do_upload('laporan_maju_speaker')) {
                //         $laporan_maju_speaker = $this->upload->data('file_name'); // Menyimpan nama file yang di-upload
                //         log_message('debug', 'File laporan speaker berhasil di-upload: ' . $laporan_maju_speaker);
                //     } else {
                //         // Tangani error jika upload gagal
                //         $error_message = $this->upload->display_errors();
                //         log_message('error', 'Upload file laporan speaker gagal: ' . $error_message);
                //         $this->session->set_flashdata('error', 'Gagal meng-upload laporan.');
                //         redirect('ewmp/create_view');
                //     }
                // }

                // Data spesifik Invited Speaker
                $data_invited_speaker = array(
                    'id_pelaporan' => $id_pelaporan,
                    'tahun' => $this->input->post('tahun'),
                    'nama_usul' => $this->input->post('nama_pengusul_speaker'),
                    'prodi' => $this->input->post('prodi_speaker'),
                    'judul' => $this->input->post('judul_kegiatan'),
                    'penyelenggara' => $this->input->post('penyelenggara'),
                    'dokumen' => $this->input->post('laporan_maju_speaker'),
                    'ins_time' => $ins_time
                );

                // Log data yang akan disimpan
                log_message('debug', 'Data Invited Speaker yang akan disimpan: ' . json_encode($data_invited_speaker));

                // Menyimpan data Invited Speaker
                $this->Ewmp_model->add_invited_speaker($data_invited_speaker);
                log_message('debug', 'Data Invited Speaker berhasil disimpan.');
            } elseif ($jenis_lapor == "Pengurus Organisasi Profesi") {
                // Menyiapkan konfigurasi untuk file upload
                // $config = array(
                //     'upload_path' => './uploads/pengurus_organisasi_profesi', // Path untuk folder upload
                //     'allowed_types' => 'pdf', // Hanya tipe file PDF yang diizinkan
                //     'max_size' => 10240, // Maksimal ukuran file 10 MB
                // );

                // $this->load->library('upload', $config);

                // $dokumen_organisasi = null;

                // // Upload file dokumen SK, Surat Tugas, dan bukti lainnya
                // if (!empty($_FILES['dokumen_organisasi']['name'])) {
                //     $config['file_name'] = 'dokumen_organisasi_' . time(); // Ganti nama file dengan timestamp
                //     $this->upload->initialize($config);

                //     if ($this->upload->do_upload('dokumen_organisasi')) {
                //         $dokumen_organisasi = $this->upload->data('file_name'); // Menyimpan nama file yang di-upload
                //     } else {
                //         // Tangani error jika upload gagal
                //         log_message('error', 'Upload file dokumen organisasi gagal: ' . $this->upload->display_errors());
                //         $this->session->set_flashdata('error', $this->upload->display_errors());
                //         redirect('ewmp/create_view'); // Redirect jika gagal upload
                //     }
                // }

                // Data spesifik Pengurus Organisasi
                $data_pengurus_organisasi = array(
                    'id_pelaporan' => $id_pelaporan,
                    'tahun' => $this->input->post('tahun'),
                    'nama_org' => $this->input->post('nama_organisasi'),
                    'jabatan' => $this->input->post('jabatan_organisasi'),
                    'masa_jabatan' => $this->input->post('masa_jabatan_organisasi'),
                    'file_sk' => $this->input->post('dokumen_organisasi'),
                    'ins_time' => $ins_time
                );

                // Menyimpan data Pengurus Organisasi
                $this->Ewmp_model->add_pengurus_organisasi($data_pengurus_organisasi);

                // Log pesan bahwa data pengurus organisasi berhasil disimpan
                log_message('debug', 'Data Pengurus Organisasi berhasil disimpan: ' . json_encode($data_pengurus_organisasi));
            }

            // Set flashdata for success message
            $this->session->set_flashdata('success', 'Data berhasil disimpan!');
            redirect('ewmp/create_view');
        }
    }

    public function detail_pelaporan($id)
    {
        $this->load->model('Ewmp_model');

        // Ambil data pelaporan berdasarkan ID
        $pelaporan = $this->Ewmp_model->get_pelaporan_by_id($id);
        $data['pelaporan'] = $pelaporan;

        if (!$data['pelaporan']) {
            show_404();
        }

        if ($pelaporan['jenis_lapor'] == "Penelitian") {

            $data['penelitian'] = $this->Ewmp_model->get_penelitian_by_id($id);

            $id_penelitian = $data['penelitian']['id'];
            $kategori = 'Penelitian';

            $data['anggota_penelitian'] = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_penelitian, $kategori);
            $data['mahasiswa_penelitian'] = $this->Ewmp_model->get_mhs_pelaporan_by_id($id_penelitian, $kategori);

            // Tampilkan view detail
            $this->load->view('backend/partials/header');
            $this->load->view('backend/ewmp/details/detail_penelitian', $data);
            $this->load->view('backend/partials/footer');
        } elseif ($pelaporan['jenis_lapor'] == "Pengabdian") {
            $data['pengabdian'] = $this->Ewmp_model->get_pengabdian_by_id($id);

            $id_pengabdian = $data['pengabdian']['id'];
            $kategori = 'Pengabdian';

            $data['anggota_pengabdian'] = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_pengabdian, $kategori);
            $data['mahasiswa_pengabdian'] = $this->Ewmp_model->get_mhs_pelaporan_by_id($id_pengabdian, $kategori);
            // Tampilkan view detail
            $this->load->view('backend/partials/header');
            $this->load->view('backend/ewmp/details/detail_pengabdian', $data);
            $this->load->view('backend/partials/footer');
        } elseif ($pelaporan['jenis_lapor'] == "Artikel/Karya Ilmiah") {
            $data['artikel_ilmiah'] = $this->Ewmp_model->get_artikel_ilmiah_by_id($id);

            $id_ilmiah = $data['artikel_ilmiah']['id'];
            $kategori = 'Artikel/Karya Ilmiah';

            $data['anggota_ilmiah'] = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_ilmiah, $kategori);

            // Tampilkan view detail
            $this->load->view('backend/partials/header');
            $this->load->view('backend/ewmp/details/detail_ilmiah', $data);
            $this->load->view('backend/partials/footer');
        } elseif ($pelaporan['jenis_lapor'] == "Prosiding") {
            $data['prosiding'] = $this->Ewmp_model->get_prosiding_by_id($id);

            $id_prosiding = $data['prosiding']['id'];
            $kategori = 'Prosiding';

            $data['anggota_prosiding'] = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_prosiding, $kategori);
            // Tampilkan view detail
            $this->load->view('backend/partials/header');
            $this->load->view('backend/ewmp/details/detail_prosiding', $data);
            $this->load->view('backend/partials/footer');
        } elseif ($pelaporan['jenis_lapor'] == "HAKI") {
            $data['haki'] = $this->Ewmp_model->get_haki_by_id($id);

            if (!$data['haki']) {
                show_error('Data HAKI tidak ditemukan', 404, 'Error');
                return;
            }

            $id_haki = $data['haki']['id'];

            $data['haki_hcipta'] = $this->Ewmp_model->get_haki_hcipta_by_id($id_haki) ?? [];
            $data['haki_merk'] = $this->Ewmp_model->get_haki_merk_by_id($id_haki) ?? [];
            $data['haki_lisensi'] = $this->Ewmp_model->get_haki_lisensi_by_id($id_haki) ?? [];
            $data['haki_buku'] = $this->Ewmp_model->get_haki_buku_by_id($id_haki) ?? [];
            $data['haki_paten'] = $this->Ewmp_model->get_haki_paten_by_id($id_haki) ?? [];
            $data['haki_dindustri'] = $this->Ewmp_model->get_haki_dindustri_by_id($id_haki) ?? [];

            // Pemegang HAKI
            $data['pemegang_hcipta'] = $this->get_pemegang_haki($data['haki_hcipta'], 'Hak Cipta');
            $data['pemegang_merk'] = $this->get_pemegang_haki($data['haki_merk'], 'Merk');
            $data['pemegang_lisensi'] = $this->get_pemegang_haki($data['haki_lisensi'], 'Lisensi');
            $data['pemegang_buku'] = $this->get_pemegang_haki($data['haki_buku'], 'Buku');
            $data['pemegang_paten'] = $this->get_pemegang_haki($data['haki_paten'], 'Paten');
            $data['pemegang_dindustri'] = $this->get_pemegang_haki($data['haki_dindustri'], 'Desain Industri');

            // Tampilkan view detail
            $this->load->view('backend/partials/header');
            $this->load->view('backend/ewmp/details/detail_haki', $data);
            $this->load->view('backend/partials/footer');
        } elseif ($pelaporan['jenis_lapor'] == "Editor Jurnal") {
            $data['editor_jurnal'] = $this->Ewmp_model->get_editor_jurnal_by_id($id);
            // Tampilkan view detail
            $this->load->view('backend/partials/header');
            $this->load->view('backend/ewmp/details/detail_editor_jurnal', $data);
            $this->load->view('backend/partials/footer');
        } elseif ($pelaporan['jenis_lapor'] == "Reviewer Jurnal") {
            $data['reviewer_jurnal'] = $this->Ewmp_model->get_reviewer_jurnal_by_id($id);
            // Tampilkan view detail
            $this->load->view('backend/partials/header');
            $this->load->view('backend/ewmp/details/detail_reviewer_jurnal', $data);
            $this->load->view('backend/partials/footer');
        } elseif ($pelaporan['jenis_lapor'] == "Invited Speaker") {
            $data['invited_speaker'] = $this->Ewmp_model->get_invited_speaker_by_id($id);
            // Tampilkan view detail
            $this->load->view('backend/partials/header');
            $this->load->view('backend/ewmp/details/detail_invited_speaker', $data);
            $this->load->view('backend/partials/footer');
        } elseif ($pelaporan['jenis_lapor'] == "Pengurus Organisasi Profesi") {
            $data['pengurus_organisasi'] = $this->Ewmp_model->get_pengurus_organisasi_by_id($id);
            // Tampilkan view detail
            $this->load->view('backend/partials/header');
            $this->load->view('backend/ewmp/details/detail_pengurus_organisasi', $data);
            $this->load->view('backend/partials/footer');
        }
    }

    private function get_pemegang_haki($haki_data, $kategori)
    {
        if (empty($haki_data)) {
            return [];
        }

        $id_haki = $haki_data['id'] ?? null;
        if (!$id_haki) {
            return [];
        }

        return $this->Ewmp_model->get_anggota_pelaporan_by_id($id_haki, $kategori) ?? [];
    }

    public function delete_pelaporan($id)
    {
        $this->Ewmp_model->delete_pelaporan_ewmp($id);
        redirect('ewmp');
    }

    public function publikasi_internasional()
    {
        $data['pub_internasional'] = $this->Ewmp_model->get_publikasi_internasional();

        // Iterasi untuk mendapatkan anggota setiap publikasi
        foreach ($data['pub_internasional'] as $key => $publikasi) {
            $id_ilmiah = $publikasi->id; // Pastikan sesuai nama kolom di database
            $kategori = 'Artikel/Karya Ilmiah';
            $data['pub_internasional'][$key]->anggota_ilmiah = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_ilmiah, $kategori);
        }

        $data['q1_data'] = $this->Ewmp_model->count_q1_data();
        $data['q2_data'] = $this->Ewmp_model->count_q2_data();
        $data['q3_data'] = $this->Ewmp_model->count_q3_data();
        $data['q4_data'] = $this->Ewmp_model->count_q4_data();

        // Hitung total data
        $data['total_data'] = $data['q1_data'] + $data['q2_data'] + $data['q3_data'] + $data['q4_data'];

        $this->load->view('backend/partials/header');
        $this->load->view('backend/ewmp/hasil_views/publikasi_internasional', $data);
        $this->load->view('backend/partials/footer');
    }


    public function publikasi_nasional()
    {
        $data['pub_nasional'] = $this->Ewmp_model->get_publikasi_nasional();

        // Iterasi untuk mendapatkan anggota setiap publikasi
        foreach ($data['pub_nasional'] as $key => $publikasi) {
            $id_ilmiah = $publikasi->id; // Pastikan sesuai nama kolom di database
            $kategori = 'Artikel/Karya Ilmiah';
            $data['pub_nasional'][$key]->anggota_ilmiah = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_ilmiah, $kategori);
        }

        // Data publikasi
        $data['s1_data'] = $this->Ewmp_model->count_s1_data();
        $data['s2_data'] = $this->Ewmp_model->count_s2_data();
        $data['s3_data'] = $this->Ewmp_model->count_s3_data();
        $data['s4_data'] = $this->Ewmp_model->count_s4_data();
        $data['s5_data'] = $this->Ewmp_model->count_s5_data();
        $data['s6_data'] = $this->Ewmp_model->count_s6_data();
        $data['tdk_terakreditasi_data'] = $this->Ewmp_model->count_tidak_terakreditasi_data();

        // Hitung total data
        $data['total_data'] = $data['s1_data'] + $data['s2_data'] + $data['s3_data'] + $data['s4_data'] + $data['s5_data'] + $data['s6_data'] + $data['tdk_terakreditasi_data'];

        $this->load->view('backend/partials/header');
        $this->load->view('backend/ewmp/hasil_views/publikasi_nasional', $data);
        $this->load->view('backend/partials/footer');
    }

    public function hibah_penelitian()
    {
        $data['penelitian'] = $this->Ewmp_model->get_hibah_penelitian();

        // Iterasi untuk mendapatkan anggota setiap publikasi
        foreach ($data['penelitian'] as $key => $penelitian) {
            $id_penelitian = $penelitian->id; // Pastikan sesuai nama kolom di database
            $kategori = 'Penelitian';
            $data['penelitian'][$key]->anggota_penelitian = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_penelitian, $kategori);
        }

        $data['mandiri_data'] = $this->Ewmp_model->count_mandiri_penelitian();
        $data['internal_data'] = $this->Ewmp_model->count_internal_penelitian();
        $data['nasional_data'] = $this->Ewmp_model->count_nasional_penelitian();
        $data['internasional_data'] = $this->Ewmp_model->count_internasional_penelitian();

        $this->load->view('backend/partials/header');
        $this->load->view('backend/ewmp/hasil_views/hibah_penelitian', $data);
        $this->load->view('backend/partials/footer');
    }

    public function hibah_pengabdian()
    {
        $data['pengabdian'] = $this->Ewmp_model->get_hibah_pengabdian();

        // Iterasi untuk mendapatkan anggota setiap publikasi
        foreach ($data['pengabdian'] as $key => $pengabdian) {
            $id_pengabdian = $pengabdian->id; // Pastikan sesuai nama kolom di database
            $kategori = 'pengabdian';
            $data['pengabdian'][$key]->anggota_pengabdian = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_pengabdian, $kategori);
        }

        $data['mandiri_data'] = $this->Ewmp_model->count_mandiri_pengabdian();
        $data['internal_data'] = $this->Ewmp_model->count_internal_pengabdian();
        $data['nasional_data'] = $this->Ewmp_model->count_nasional_pengabdian();
        $data['internasional_data'] = $this->Ewmp_model->count_internasional_pengabdian();

        $this->load->view('backend/partials/header');
        $this->load->view('backend/ewmp/hasil_views/hibah_pengabdian', $data);
        $this->load->view('backend/partials/footer');
    }

    public function kesesuaian_publikasi()
    {
        // Add logging to debug data retrieval
        log_message('debug', 'Starting kesesuaian_publikasi method');

        // Fetch publikasi data for each department with error checking
        $data['data_elektro'] = $this->Ewmp_model->get_publikasi_elektro();
        log_message('debug', 'Elektro publikasi count: ' . count($data['data_elektro']));

        $data['data_industri'] = $this->Ewmp_model->get_publikasi_industri();
        log_message('debug', 'Industri publikasi count: ' . count($data['data_industri']));

        $data['data_biomedis'] = $this->Ewmp_model->get_publikasi_biomedis();
        log_message('debug', 'Biomedis publikasi count: ' . count($data['data_biomedis']));

        // Add anggota information for each publikasi
        $data_collections = [
            &$data['data_elektro'],
            &$data['data_industri'],
            &$data['data_biomedis']
        ];

        foreach ($data_collections as &$publikasi_collection) {
            foreach ($publikasi_collection as $key => $publikasi) {
                $id_ilmiah = $publikasi->id;
                $kategori = 'Artikel/Karya Ilmiah';
                $publikasi_collection[$key]->anggota_ilmiah = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_ilmiah, $kategori);

                // Add debug logging
                log_message('debug', 'Publikasi ID: ' . $id_ilmiah . ', Anggota count: ' . count($publikasi_collection[$key]->anggota_ilmiah));
            }
        }

        // Add a debug view to print out raw data
        $data['debug_elektro'] = $data['data_elektro'];
        $data['debug_industri'] = $data['data_industri'];
        $data['debug_biomedis'] = $data['data_biomedis'];

        // Load views
        $this->load->view('backend/partials/header');
        $this->load->view('backend/ewmp/hasil_views/kesesuaian_publikasi', $data);
        $this->load->view('backend/partials/footer');
    }

    public function kesesuaian_penelitian()
    {
        // Logging untuk debugging
        log_message('debug', 'Starting kesesuaian_penelitian method');

        // Fetch data penelitian untuk masing-masing prodi
        $data['data_elektro'] = $this->Ewmp_model->get_penelitian_elektro();
        log_message('debug', 'Elektro penelitian count: ' . count($data['data_elektro']));

        $data['data_industri'] = $this->Ewmp_model->get_penelitian_industri();
        log_message('debug', 'Industri penelitian count: ' . count($data['data_industri']));

        $data['data_biomedis'] = $this->Ewmp_model->get_penelitian_biomedis();
        log_message('debug', 'Biomedis penelitian count: ' . count($data['data_biomedis']));

        // Data koleksi untuk mempermudah pengolahan anggota
        $data_collections = [
            &$data['data_elektro'],
            &$data['data_industri'],
            &$data['data_biomedis']
        ];

        foreach ($data_collections as &$penelitian_collection) {
            foreach ($penelitian_collection as $key => $penelitian) {
                $id_penelitian = $penelitian->id; // Pastikan nama kolom sesuai database
                $kategori = 'Penelitian';
                $penelitian_collection[$key]->anggota_penelitian = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_penelitian, $kategori);

                // Logging jumlah anggota penelitian
                log_message('debug', 'penelitian ID: ' . $id_penelitian . ', Anggota count: ' . count($penelitian_collection[$key]->anggota_penelitian));
            }
        }

        // Hitung jumlah penelitian berdasarkan kategori
        $data['elektro_data'] = [
            'mandiri' => $this->Ewmp_model->count_mandiri_penelitian('Teknik Elektro'),
            'internal' => $this->Ewmp_model->count_internal_penelitian('Teknik Elektro'),
            'nasional' => $this->Ewmp_model->count_nasional_penelitian('Teknik Elektro'),
            'internasional' => $this->Ewmp_model->count_internasional_penelitian('Teknik Elektro'),
        ];

        $data['industri_data'] = [
            'mandiri' => $this->Ewmp_model->count_mandiri_penelitian('Teknik Industri'),
            'internal' => $this->Ewmp_model->count_internal_penelitian('Teknik Industri'),
            'nasional' => $this->Ewmp_model->count_nasional_penelitian('Teknik Industri'),
            'internasional' => $this->Ewmp_model->count_internasional_penelitian('Teknik Industri'),
        ];

        $data['biomedis_data'] = [
            'mandiri' => $this->Ewmp_model->count_mandiri_penelitian('Teknik Biomedis'),
            'internal' => $this->Ewmp_model->count_internal_penelitian('Teknik Biomedis'),
            'nasional' => $this->Ewmp_model->count_nasional_penelitian('Teknik Biomedis'),
            'internasional' => $this->Ewmp_model->count_internasional_penelitian('Teknik Biomedis'),
        ];

        // Load views
        $this->load->view('backend/partials/header');
        $this->load->view('backend/ewmp/hasil_views/kesesuaian_penelitian', $data);
        $this->load->view('backend/partials/footer');
    }

    public function update_kesesuaian_penelitian($id)
    {
        $this->load->model('Ewmp_model');

        $data = array(
            'kesesuaian' => $this->input->post('kesesuaian_penelitian')
        );

        if ($this->Ewmp_model->update_penelitian($id, $data)) {
            echo 'success';
        } else {
            echo 'error';
        }
    }


    public function kesesuaian_pengabdian()
    {
        // Logging untuk debugging
        log_message('debug', 'Starting kesesuaian_pengabdian method');

        // Fetch data pengabdian untuk masing-masing prodi
        $data['data_elektro'] = $this->Ewmp_model->get_pengabdian_elektro();
        log_message('debug', 'Elektro pengabdian count: ' . count($data['data_elektro']));

        $data['data_industri'] = $this->Ewmp_model->get_pengabdian_industri();
        log_message('debug', 'Industri pengabdian count: ' . count($data['data_industri']));

        $data['data_biomedis'] = $this->Ewmp_model->get_pengabdian_biomedis();
        log_message('debug', 'Biomedis pengabdian count: ' . count($data['data_biomedis']));

        // Data koleksi untuk mempermudah pengolahan anggota
        $data_collections = [
            &$data['data_elektro'],
            &$data['data_industri'],
            &$data['data_biomedis']
        ];

        foreach ($data_collections as &$pengabdian_collection) {
            foreach ($pengabdian_collection as $key => $pengabdian) {
                $id_pengabdian = $pengabdian->id;
                $kategori = 'Pengabdian';
                $pengabdian_collection[$key]->anggota_pengabdian = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_pengabdian, $kategori);

                // Logging jumlah anggota pengabdian
                log_message('debug', 'Pengabdian ID: ' . $id_pengabdian . ', Anggota count: ' . count($pengabdian_collection[$key]->anggota_pengabdian));
            }
        }

        // Hitung jumlah pengabdian berdasarkan kategori
        $data['elektro_data'] = [
            'mandiri' => $this->Ewmp_model->count_mandiri_pengabdian('Teknik Elektro'),
            'internal' => $this->Ewmp_model->count_internal_pengabdian('Teknik Elektro'),
            'nasional' => $this->Ewmp_model->count_nasional_pengabdian('Teknik Elektro'),
            'internasional' => $this->Ewmp_model->count_internasional_pengabdian('Teknik Elektro'),
        ];

        $data['industri_data'] = [
            'mandiri' => $this->Ewmp_model->count_mandiri_pengabdian('Teknik Industri'),
            'internal' => $this->Ewmp_model->count_internal_pengabdian('Teknik Industri'),
            'nasional' => $this->Ewmp_model->count_nasional_pengabdian('Teknik Industri'),
            'internasional' => $this->Ewmp_model->count_internasional_pengabdian('Teknik Industri'),
        ];

        $data['biomedis_data'] = [
            'mandiri' => $this->Ewmp_model->count_mandiri_pengabdian('Teknik Biomedis'),
            'internal' => $this->Ewmp_model->count_internal_pengabdian('Teknik Biomedis'),
            'nasional' => $this->Ewmp_model->count_nasional_pengabdian('Teknik Biomedis'),
            'internasional' => $this->Ewmp_model->count_internasional_pengabdian('Teknik Biomedis'),
        ];

        // Load views
        $this->load->view('backend/partials/header');
        $this->load->view('backend/ewmp/hasil_views/kesesuaian_pengabdian', $data);
        $this->load->view('backend/partials/footer');
    }

    public function update_kesesuaian_pengabdian($id)
    {
        $this->load->model('Ewmp_model');

        $data = array(
            'kesesuaian' => $this->input->post('kesesuaian_pengabdian')
        );

        if ($this->Ewmp_model->update_pengabdian($id, $data)) {
            echo 'success';
        } else {
            echo 'error';
        }
    }
}
