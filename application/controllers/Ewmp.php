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
                    // Tangani error upload
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('ewmp/creat_view');
                }
            }

            // Upload laporan kemajuan penelitian
            if (!empty($_FILES['laporan_maju_penelitian']['name'])) {
                $config['file_name'] = 'laporan_maju_' . time(); // Rename file
                $this->upload->initialize($config);

                if ($this->upload->do_upload('laporan_maju_penelitian')) {
                    $laporan_maju = $this->upload->data('file_name');
                } else {
                    // Tangani error upload
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('ewmp/creat_view');
                }
            }

            // Data spesifik penelitian
            $data_penelitian = array(
                'id_pelaporan' => $id_pelaporan,
                'nama_ketua' => $this->input->post('nama_ketua_penelitian'),
                'prodi' => $this->input->post('prodi_penelitian'),
                'kategori' => $this->input->post('kategori_penelitian'),
                'nama_anggota' => $this->input->post('nama_anggota_penelitian'),
                'judul' => $this->input->post('judul_penelitian'),
                'skim' => $this->input->post('skim_penelitian'),
                'pemberi_hibah' => $this->input->post('pemberi_hibah_penelitian'),
                'besar_hibah' => $this->input->post('besar_hibah_penelitian'),
                'mahasiswa' => $this->input->post('nama_mahasiswa_penelitian'),
                'kontrak' => $kontrak,
                'laporan_maju' => $laporan_maju,
                'ins_time' => $ins_time
            );

            // Menyimpan data penelitian
            $this->Ewmp_model->add_penelitian($data_penelitian);
        } elseif ($jenis_lapor == 'Pengabdian') {
            $config = array(
                'upload_path' => './uploads/pengabdian',
                'allowed_types' => 'pdf',
                'max_size' => 102400, // Maks 100 MB
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
        } elseif ($jenis_lapor == 'superBright') {
            $data = array(
                'sb1' => $this->input->post('sb1'),
                'sb2' => $this->input->post('sb2'),
                'sb3' => $this->input->post('sb3'),
                'sb4' => $this->input->post('sb4'),
                'sb5' => $this->input->post('sb5'),
                'sb6' => $this->input->post('sb6'),
                'sb7' => $this->input->post('sb7'),
                'sb8' => $this->input->post('sb8'),
                'sb9' => $this->input->post('sb9'),
                'sb10' => $this->input->post('sb10')
            );
            $this->Mod_darah->add_superbright($data);
        }

        redirect('ewmp');
    }

    public function delete_pelaporan($id)
    {
        $this->Ewmp_model->delete_pelaporan_ewmp($id);
        redirect('ewmp');
    }
}
