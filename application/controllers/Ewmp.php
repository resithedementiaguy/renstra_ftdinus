<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ewmp extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ewmp_model');
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
        $this->load->view('backend/partials/header');
        $this->load->view('backend/ewmp/add');
        $this->load->view('backend/partials/footer');
    }

    public function add()
    {
        $jenis_lapor = $this->input->post('jenis_lapor');

        date_default_timezone_set('Asia/Jakarta');
        $ins_time = date('Y-m-d H:i:s', time());

        $data = array(
            'email' => $this->input->post('email'),
            'jenis_lapor' => $jenis_lapor,
            'ins_time' => $ins_time
        );

        $this->Ewmp_model->add_pelaporan_ewmp($data);

        $id_pelaporan = $this->Ewmp_model->get_last_pelaporan_id();

        if ($jenis_lapor == 'Penelitian') {
            $config = array(
                'upload_path' => './uploads/penelitian',
                'allowed_types' => 'pdf',
                'max_size' => 102400, // Maks 100 MB
            );
            
            $this->load->library('upload', $config);
            
            $kontrak = null;
            $laporan_maju = null;
            
            // Upload kontrak penelitian
            if (!empty($_FILES['kontrak_penelitian']['name'])) {
                $config['file_name'] = 'kontrak_' . time(); // Rename file
                $this->upload->initialize($config);
            
                if ($this->upload->do_upload('kontrak_penelitian')) {
                    $kontrak = $this->upload->data('file_name');
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('ewmp/create_view');
                }
            }
            
            // Upload laporan kemajuan penelitian
            if (!empty($_FILES['laporan_maju_penelitian']['name'])) {
                $config['file_name'] = 'laporan_maju_' . time(); // Rename file
                $this->upload->initialize($config);
            
                if ($this->upload->do_upload('laporan_maju_penelitian')) {
                    $laporan_maju = $this->upload->data('file_name');
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('ewmp/create_view');
                }
            }
            
            // Data spesifik penelitian
            $data_penelitian = array(
                'id_pelaporan' => $id_pelaporan,
                'nama_ketua' => $this->input->post('nama_ketua_penelitian'),
                'prodi' => $this->input->post('prodi_penelitian'),
                'kategori' => $this->input->post('kategori_penelitian'),
                'judul' => $this->input->post('judul_penelitian'),
                'skim' => $this->input->post('skim_penelitian'),
                'pemberi_hibah' => $this->input->post('pemberi_hibah_penelitian'),
                'besar_hibah' => $this->input->post('besar_hibah_penelitian'),
                'kontrak' => $kontrak,
                'laporan_maju' => $laporan_maju,
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
                foreach ($nama_anggota as $index => $nama) {
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
            $config = array(
                'upload_path' => './uploads/pengabdian',
                'allowed_types' => 'pdf',
                'max_size' => 10240, // Maks 100 MB
            );

            $this->load->library('upload', $config);

            $kontrak = null;
            $laporan = null;

            // Upload kontrak pengabdian
            if (!empty($_FILES['kontrak_pengabdian']['name'])) {
                $config['file_name'] = 'kontrak_' . time(); // Rename file
                $this->upload->initialize($config);

                if ($this->upload->do_upload('kontrak_pengabdian')) {
                    $kontrak = $this->upload->data('file_name');
                } else {
                    // Tangani error upload
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('ewmp/create_view');
                }
            }

            // Upload laporan kemajuan pengabdian
            if (!empty($_FILES['laporan_pengabdian']['name'])) {
                $config['file_name'] = 'laporan_' . time(); // Rename file
                $this->upload->initialize($config);

                if ($this->upload->do_upload('laporan_pengabdian')) {
                    $laporan = $this->upload->data('file_name');
                } else {
                    // Tangani error upload
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('ewmp/create_view');
                }
            }

            // Data spesifik pengabdian
            $data_pengabdian = array(
                'id_pelaporan' => $id_pelaporan,
                'nama_ketua' => $this->input->post('nama_ketua_pengabdian'),
                'prodi' => $this->input->post('prodi_pengabdian'),
                'kategori' => $this->input->post('kategori_pengabdian'),
                'nama_anggota' => $this->input->post('nama_anggota_pengabdian'),
                'judul' => $this->input->post('judul_pengabdian'),
                'skim' => $this->input->post('skim_pengabdian'),
                'pemberi_hibah' => $this->input->post('pemberi_hibah_pengabdian'),
                'besar_hibah' => $this->input->post('besar_hibah_pengabdian'),
                'mahasiswa' => $this->input->post('nama_mahasiswa_pengabdian'),
                'kontrak' => $kontrak,
                'laporan' => $laporan,
                'ins_time' => $ins_time
            );

            // Menyimpan data pengabdian
            $this->Ewmp_model->add_pengabdian($data_pengabdian);
        } elseif ($jenis_lapor == 'Artikel/Karya Ilmiah') {
            $kategori = $this->input->post('kategori_ilmiah');
            $data_ilmiah = array(
                'id_pelaporan' => $id_pelaporan,
                'kategori' => $kategori,
                'nama_pertama' => $this->input->post('nama_pertama_ilmiah'),
                'nama_korespon' => $this->input->post('nama_korespon_ilmiah'),
                'nama_anggota' => $this->input->post('nama_anggota_ilmiah'),
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
        } elseif ($jenis_lapor == 'Prosiding') {
            $config = array(
                'upload_path' => './uploads/prosiding',
                'allowed_types' => 'pdf',
                'max_size' => 10240, // Maks 100 MB
            );

            $this->load->library('upload', $config);

            $bukti_loa = null;

            // Upload bukti_loa prosiding
            if (!empty($_FILES['bukti_loa_prosiding']['name'])) {
                $config['file_name'] = 'bukti_loa_' . time(); // Rename file
                $this->upload->initialize($config);

                if ($this->upload->do_upload('bukti_loa_prosiding')) {
                    $bukti_loa = $this->upload->data('file_name');
                } else {
                    // Tangani error upload
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('ewmp/create_view');
                }
            }

            // Data spesifik prosiding
            $data_prosiding = array(
                'id_pelaporan' => $id_pelaporan,
                'kategori' => $this->input->post('kategori_prosiding'),
                'nama_pertama' => $this->input->post('nama_pertama_prosiding'),
                'nama_korespon' => $this->input->post('nama_korespon_prosiding'),
                'nama_anggota' => $this->input->post('nama_anggota_prosiding'),
                'judul_artikel' => $this->input->post('judul_artikel_prosiding'),
                'judul_seminar' => $this->input->post('judul_seminar_prosiding'),
                'bukti_loa' => $bukti_loa,
                'doi' => $this->input->post('doi_prosiding'),
                'ins_time' => $ins_time
            );

            // Menyimpan data prosiding
            $this->Ewmp_model->add_prosiding($data_prosiding);
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
                $config = array(
                    'upload_path' => './uploads/haki/hak_cipta',
                    'allowed_types' => 'pdf',
                    'max_size' => 10240, // Maks 10 MB
                );
                $this->load->library('upload', $config);

                $sertifikat = null;

                // Upload file sertifikat
                if (!empty($_FILES['sertifikat_hcipta']['name'])) {
                    $config['file_name'] = 'sertifikat_' . time(); // Ganti nama file dengan timestamp
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('sertifikat_hcipta')) {
                        $sertifikat = $this->upload->data('file_name'); // Menyimpan nama file yang di-upload
                        log_message('debug', 'Sertifikat berhasil di-upload: ' . $sertifikat);
                    } else {
                        log_message('error', 'Upload file sertifikat gagal: ' . $this->upload->display_errors());
                        $this->session->set_flashdata('error', 'Gagal meng-upload sertifikat.');
                        redirect('ewmp/create_view');
                    }
                }

                // Menyimpan data Hak Cipta
                $data_hak_cipta = array(
                    'id_haki' => $id_haki,
                    'nama_usul' => $this->input->post('nama_pengusul_hcipta'),
                    'nama_pemegang' => $this->input->post('nama_pemegang_hcipta'),
                    'judul' => $this->input->post('judul_hcipta'),
                    'sertifikat' => $sertifikat,
                    'ins_time' => $ins_time
                );

                // Log data yang akan disimpan ke database
                log_message('debug', 'Data Hak Cipta yang akan disimpan: ' . json_encode($data_hak_cipta));

                // Pastikan fungsi add_haki_hcipta ada di model
                $this->Ewmp_model->add_haki_hcipta($data_hak_cipta);
            } elseif ($kategori_haki == 'Paten') {

                // Menyiapkan konfigurasi untuk file upload
                $config = array(
                    'upload_path' => './uploads/haki/paten',
                    'allowed_types' => 'pdf',
                    'max_size' => 10240, // Maks 10 MB
                );
                $this->load->library('upload', $config);

                $sertifikat = null;

                // Upload file sertifikat
                if (!empty($_FILES['sertifikat_paten']['name'])) {
                    $config['file_name'] = 'sertifikat_' . time(); // Ganti nama file dengan timestamp
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('sertifikat_paten')) {
                        $sertifikat = $this->upload->data('file_name'); // Menyimpan nama file yang di-upload
                        log_message('debug', 'Sertifikat berhasil di-upload: ' . $sertifikat);
                    } else {
                        log_message('error', 'Upload file sertifikat gagal: ' . $this->upload->display_errors());
                        $this->session->set_flashdata('error', 'Gagal meng-upload sertifikat.');
                        redirect('ewmp/create_view');
                    }
                }

                // Menyimpan data Hak Cipta
                $data_paten = array(
                    'id_haki' => $id_haki,
                    'nama_inventor' => $this->input->post('nama_inventor_paten'),
                    'judul' => $this->input->post('judul_invensi_paten'),
                    'sertifikat' => $sertifikat,
                    'ins_time' => $ins_time
                );

                // Log data yang akan disimpan ke database
                log_message('debug', 'Data Hak Cipta yang akan disimpan: ' . json_encode($data_paten));

                // Pastikan fungsi add_haki_hcipta ada di model
                $this->Ewmp_model->add_haki_paten($data_paten);
            } elseif ($kategori_haki == 'Desain Industri') {

                // Menyiapkan konfigurasi untuk file upload
                $config = array(
                    'upload_path' => './uploads/haki/desain_industri',
                    'allowed_types' => 'pdf',
                    'max_size' => 10240, // Maks 10 MB
                );
                $this->load->library('upload', $config);

                $sertifikat = null;

                // Upload file sertifikat
                if (!empty($_FILES['sertifikat_desain']['name'])) {
                    $config['file_name'] = 'sertifikat_' . time(); // Ganti nama file dengan timestamp
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('sertifikat_desain')) {
                        $sertifikat = $this->upload->data('file_name'); // Menyimpan nama file yang di-upload
                        log_message('debug', 'Sertifikat berhasil di-upload: ' . $sertifikat);
                    } else {
                        log_message('error', 'Upload file sertifikat gagal: ' . $this->upload->display_errors());
                        $this->session->set_flashdata('error', 'Gagal meng-upload sertifikat.');
                        redirect('ewmp/create_view');
                    }
                }

                // Menyimpan data Hak Cipta
                $data_desain = array(
                    'id_haki' => $id_haki,
                    'nama_usul' => $this->input->post('nama_pengusul_desain'),
                    'sertifikat' => $sertifikat,
                    'ins_time' => $ins_time
                );

                // Log data yang akan disimpan ke database
                log_message('debug', 'Data Hak Cipta yang akan disimpan: ' . json_encode($data_desain));

                // Pastikan fungsi add_haki_hcipta ada di model
                $this->Ewmp_model->add_haki_dindustri($data_desain);
            }
        } elseif ($jenis_lapor == "Editor Jurnal") {
            $config = array(
                'upload_path' => './uploads/jurnal/editor_jurnal',
                'allowed_types' => 'pdf',
                'max_size' => 10240, // Maks 100 MB
            );

            $this->load->library('upload', $config);

            $sk = null;

            // Upload sk editor
            if (!empty($_FILES['sk_editor']['name'])) {
                $config['file_name'] = 'sk_' . time(); // Rename file
                $this->upload->initialize($config);

                if ($this->upload->do_upload('sk_editor')) {
                    $sk = $this->upload->data('file_name');
                } else {
                    // Tangani error upload
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('ewmp/create_view');
                }
            }

            // Data spesifik editor
            $data_editor = array(
                'id_pelaporan' => $id_pelaporan,
                'nama_usul' => $this->input->post('nama_pengusul_editor'),
                'prodi' => $this->input->post('prodi_editor'),
                'judul' => $this->input->post('judul_jurnal_editor'),
                'file_sk' => $sk,
                'ins_time' => $ins_time
            );

            // Menyimpan data editor
            $this->Ewmp_model->add_editor_jurnal($data_editor);
        } elseif ($jenis_lapor == "Reviewer Jurnal") {
            $config = array(
                'upload_path' => './uploads/jurnal/reviewer_jurnal',
                'allowed_types' => 'pdf',
                'max_size' => 10240, // Maks 100 MB
            );

            $this->load->library('upload', $config);

            $sertifikat = null;

            // Upload sertifikat reviewer
            if (!empty($_FILES['sertifikat_reviewer']['name'])) {
                $config['file_name'] = 'sertifikat_' . time(); // Rename file
                $this->upload->initialize($config);

                if ($this->upload->do_upload('sertifikat_reviewer')) {
                    $sertifikat = $this->upload->data('file_name');
                } else {
                    // Tangani error upload
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('ewmp/create_view');
                }
            }

            // Data spesifik reviewer
            $data_reviewer = array(
                'id_pelaporan' => $id_pelaporan,
                'nama_usul' => $this->input->post('nama_pengusul_reviewer'),
                'prodi' => $this->input->post('prodi_reviewer'),
                'judul_artikel' => $this->input->post('judul_artikel_reviewer'),
                'judul_jurnal' => $this->input->post('judul_jurnal_reviewer'),
                'sertifikat' => $sertifikat,
                'ins_time' => $ins_time
            );

            // Menyimpan data reviewer
            $this->Ewmp_model->add_reviewer_jurnal($data_reviewer);
        } elseif ($jenis_lapor == 'Invited Speaker') {
            // Menyiapkan konfigurasi untuk file upload
            $config = array(
                'upload_path' => './uploads/invited_speaker',
                'allowed_types' => 'pdf',
                'max_size' => 10240, // Maks 10 MB
            );

            $this->load->library('upload', $config);

            $laporan_maju_speaker = null;

            // Upload file laporan undangan, sertifikat, dan bukti kegiatan
            if (!empty($_FILES['laporan_maju_speaker']['name'])) {
                $config['file_name'] = 'laporan_speaker_' . time(); // Ganti nama file dengan timestamp
                $this->upload->initialize($config);

                if ($this->upload->do_upload('laporan_maju_speaker')) {
                    $laporan_maju_speaker = $this->upload->data('file_name'); // Menyimpan nama file yang di-upload
                    log_message('debug', 'File laporan speaker berhasil di-upload: ' . $laporan_maju_speaker);
                } else {
                    // Tangani error jika upload gagal
                    $error_message = $this->upload->display_errors();
                    log_message('error', 'Upload file laporan speaker gagal: ' . $error_message);
                    $this->session->set_flashdata('error', 'Gagal meng-upload laporan.');
                    redirect('ewmp/create_view');
                }
            }

            // Data spesifik Invited Speaker
            $data_invited_speaker = array(
                'id_pelaporan' => $id_pelaporan,
                'nama_usul' => $this->input->post('nama_pengusul_speaker'),
                'prodi' => $this->input->post('prodi_speaker'),
                'judul' => $this->input->post('judul_kegiatan'),
                'penyelenggara' => $this->input->post('penyelenggara'),
                'dokumen' => $laporan_maju_speaker,
                'ins_time' => $ins_time
            );

            // Log data yang akan disimpan
            log_message('debug', 'Data Invited Speaker yang akan disimpan: ' . json_encode($data_invited_speaker));

            // Menyimpan data Invited Speaker
            $this->Ewmp_model->add_invited_speaker($data_invited_speaker);
            log_message('debug', 'Data Invited Speaker berhasil disimpan.');
        } elseif ($jenis_lapor == "Pengurus Organisasi Profesi") {
            // Menyiapkan konfigurasi untuk file upload
            $config = array(
                'upload_path' => './uploads/pengurus_organisasi_profesi', // Path untuk folder upload
                'allowed_types' => 'pdf', // Hanya tipe file PDF yang diizinkan
                'max_size' => 10240, // Maksimal ukuran file 10 MB
            );

            $this->load->library('upload', $config);

            $dokumen_organisasi = null;

            // Upload file dokumen SK, Surat Tugas, dan bukti lainnya
            if (!empty($_FILES['dokumen_organisasi']['name'])) {
                $config['file_name'] = 'dokumen_organisasi_' . time(); // Ganti nama file dengan timestamp
                $this->upload->initialize($config);

                if ($this->upload->do_upload('dokumen_organisasi')) {
                    $dokumen_organisasi = $this->upload->data('file_name'); // Menyimpan nama file yang di-upload
                } else {
                    // Tangani error jika upload gagal
                    log_message('error', 'Upload file dokumen organisasi gagal: ' . $this->upload->display_errors());
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('ewmp/create_view'); // Redirect jika gagal upload
                }
            }

            // Data spesifik Pengurus Organisasi
            $data_pengurus_organisasi = array(
                'id_pelaporan' => $id_pelaporan,
                'nama_org' => $this->input->post('nama_organisasi'),
                'jabatan' => $this->input->post('jabatan_organisasi'),
                'masa_jabatan' => $this->input->post('masa_jabatan_organisasi'),
                'file_sk' => $dokumen_organisasi,
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

    public function detail_pelaporan($id)
    {
        $this->load->model('Ewmp_model');

        // Ambil data pelaporan berdasarkan ID
        $pelaporan=$this->Ewmp_model->get_pelaporan_by_id($id);
        $data['pelaporan'] = $pelaporan;

        if (!$data['pelaporan']) {
            show_404();
        }

        if ($pelaporan['jenis_lapor'] == "Penelitian"){

            $data['penelitian']=$this->Ewmp_model->get_penelitian_by_id($id);
            // Tampilkan view detail
            $this->load->view('backend/partials/header');
            $this->load->view('backend/ewmp/details/detail_penelitian', $data);
            $this->load->view('backend/partials/footer');
        } elseif($pelaporan['jenis_lapor'] == "Pengabdian"){
            $data['pengabdian']=$this->Ewmp_model->get_pengabdian_by_id($id);
            // Tampilkan view detail
            $this->load->view('backend/partials/header');
            $this->load->view('backend/ewmp/details/detail_pengabdian', $data);
            $this->load->view('backend/partials/footer');
        } elseif($pelaporan['jenis_lapor'] == "Artikel/Karya Ilmiah"){
            $data['artikel_ilmiah']=$this->Ewmp_model->get_artikel_ilmiah_by_id($id);
            // Tampilkan view detail
            $this->load->view('backend/partials/header');
            $this->load->view('backend/ewmp/details/detail_ilmiah', $data);
            $this->load->view('backend/partials/footer');
        } elseif($pelaporan['jenis_lapor'] == "Prosiding"){
            $data['prosiding']=$this->Ewmp_model->get_prosiding_by_id($id);
            // Tampilkan view detail
            $this->load->view('backend/partials/header');
            $this->load->view('backend/ewmp/details/detail_prosiding', $data);
            $this->load->view('backend/partials/footer');
        } elseif($pelaporan['jenis_lapor'] == "HAKI"){
            $data['haki']=$this->Ewmp_model->get_haki_by_id($id);

            $id_haki=$data['haki']['id'];

            $data['haki_hcipta']=$this->Ewmp_model->get_haki_hcipta_by_id($id_haki);
            $data['haki_paten']=$this->Ewmp_model->get_haki_paten_by_id($id_haki);
            $data['haki_dindustri']=$this->Ewmp_model->get_haki_dindustri_by_id($id_haki);

            // Tampilkan view detail
            $this->load->view('backend/partials/header');
            $this->load->view('backend/ewmp/details/detail_haki', $data);
            $this->load->view('backend/partials/footer');
        } elseif($pelaporan['jenis_lapor'] == "Editor Jurnal"){
            $data['editor_jurnal']=$this->Ewmp_model->get_editor_jurnal_by_id($id);
            // Tampilkan view detail
            $this->load->view('backend/partials/header');
            $this->load->view('backend/ewmp/details/detail_editor_jurnal', $data);
            $this->load->view('backend/partials/footer');
        } elseif($pelaporan['jenis_lapor'] == "Reviewer Jurnal"){
            $data['reviewer_jurnal']=$this->Ewmp_model->get_reviewer_jurnal_by_id($id);
            // Tampilkan view detail
            $this->load->view('backend/partials/header');
            $this->load->view('backend/ewmp/details/detail_reviewer_jurnal', $data);
            $this->load->view('backend/partials/footer');
        } elseif($pelaporan['jenis_lapor'] == "Invited Speaker"){
            $data['invited_speaker']=$this->Ewmp_model->get_invited_speaker_by_id($id);
            // Tampilkan view detail
            $this->load->view('backend/partials/header');
            $this->load->view('backend/ewmp/details/detail_invited_speaker', $data);
            $this->load->view('backend/partials/footer');
        } elseif($pelaporan['jenis_lapor'] == "Pengurus Organisasi Profesi"){
            $data['pengurus_organisasi']=$this->Ewmp_model->get_pengurus_organisasi_by_id($id);
            // Tampilkan view detail
            $this->load->view('backend/partials/header');
            $this->load->view('backend/ewmp/details/detail_pengurus_organisasi', $data);
            $this->load->view('backend/partials/footer');
        }
    }

    public function delete_pelaporan($id)
    {
        $this->Ewmp_model->delete_pelaporan_ewmp($id);
        redirect('ewmp');
    }
}
