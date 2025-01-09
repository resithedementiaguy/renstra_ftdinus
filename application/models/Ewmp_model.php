<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ewmp_model extends CI_Model
{

    public function add_pelaporan_ewmp($data)
    {
        return $this->db->insert('pelaporan_ewmp', $data);
    }

    public function get_pelaporan_ewmp()
    {
        $this->db->select('*');
        $this->db->from('pelaporan_ewmp');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_pelaporan_ewmp_by_id($user_id)
    {
        $this->db->select('*');
        $this->db->from('pelaporan_ewmp');
        $this->db->where('id_user', $user_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_pelaporan_by_id($id)
    {
        return $this->db->get_where('pelaporan_ewmp', ['id' => $id])->row_array();
    }

    public function get_last_pelaporan_id()
    {
        $this->db->select('id'); // Asumsi kolom ID adalah 'id'
        $this->db->from('pelaporan_ewmp');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        $result = $query->row();

        return $result ? $result->id : null;
    }


    public function update_pelaporan_ewmp($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('pelaporan_ewmp', $data);
    }

    public function delete_pelaporan_ewmp($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('pelaporan_ewmp');
    }

    public function add_penelitian($data)
    {
        return $this->db->insert('penelitian', $data);
    }

    public function get_penelitian_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('penelitian');
        $this->db->where('id_pelaporan', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_last_penelitian_id()
    {
        $this->db->select('id'); // Asumsi kolom ID adalah 'id'
        $this->db->from('penelitian');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        $result = $query->row();

        return $result ? $result->id : null;
    }

    public function update_penelitian($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('penelitian', $data);
    }

    public function delete_penelitian($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('status_stok');
    }

    public function add_pengabdian($data)
    {
        return $this->db->insert('pengabdian', $data);
    }

    public function get_pengabdian_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('pengabdian');
        $this->db->where('id_pelaporan', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_last_pengabdian_id()
    {
        $this->db->select('id'); // Asumsi kolom ID adalah 'id'
        $this->db->from('pengabdian');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        $result = $query->row();

        return $result ? $result->id : null;
    }

    public function update_pengabdian($id, $data)
    {
        $this->db->where('id_pelaporan', $id);
        return $this->db->update('pengabdian', $data);
    }

    public function delete_pengabdian($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('status_stok');
    }

    public function add_artikel_ilmiah($data)
    {
        return $this->db->insert('artikel_ilmiah', $data);
    }

    public function get_artikel_ilmiah_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('artikel_ilmiah');
        $this->db->where('id_pelaporan', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_last_artikel_ilmiah_id()
    {
        $this->db->select('id'); // Asumsi kolom ID adalah 'id'
        $this->db->from('artikel_ilmiah');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        $result = $query->row();

        return $result ? $result->id : null;
    }

    public function update_artikel_ilmiah($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('artikel_ilmiah', $data);
    }

    public function delete_artikel_ilmiah($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('status_stok');
    }

    public function add_prosiding($data)
    {
        return $this->db->insert('prosiding', $data);
    }

    public function get_prosiding_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('prosiding');
        $this->db->where('id_pelaporan', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_last_prosiding_id()
    {
        $this->db->select('id'); // Asumsi kolom ID adalah 'id'
        $this->db->from('prosiding');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        $result = $query->row();

        return $result ? $result->id : null;
    }

    public function update_prosiding($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('prosiding', $data);
    }

    public function delete_prosiding($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('status_stok');
    }

    public function add_haki($data)
    {
        $this->db->insert('haki', $data);
        return $this->db->insert_id();
    }

    public function get_last_haki_id()
    {
        $this->db->select('id');
        $this->db->from('haki');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->id;
        }
        return null;
    }

    public function get_haki_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('haki');
        $this->db->where('id_pelaporan', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_haki_kategori_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('haki');
        $this->db->where('id_pelaporan', $id);
        $query = $this->db->get();
        return $query->result_array(); // Mengembalikan array dari semua baris
    }

    public function add_haki_hcipta($data)
    {
        $this->db->insert('haki_hcipta', $data);
    }

    public function get_haki_hcipta_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('haki_hcipta');
        $this->db->where('id_haki', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_last_hcipta_id()
    {
        $this->db->select('id'); // Asumsi kolom ID adalah 'id'
        $this->db->from('haki_hcipta');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        $result = $query->row();

        return $result ? $result->id : null;
    }

    public function add_haki_merk($data)
    {
        if ($this->db->insert('haki_merk', $data)) {
            log_message('debug', 'Data Merk berhasil disimpan');
        } else {
            log_message('error', 'Gagal menyimpan data Merk: ' . $this->db->error());
        }
    }

    public function get_haki_merk_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('haki_merk');
        $this->db->where('id_haki', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_last_merk_id()
    {
        $this->db->select('id');
        $this->db->from('haki_merk');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        $result = $query->row();

        return $result ? $result->id : null;
    }

    public function add_haki_lisensi($data)
    {
        $this->db->insert('haki_lisensi', $data);
    }

    public function get_haki_lisensi_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('haki_lisensi');
        $this->db->where('id_haki', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_last_lisensi_id()
    {
        $this->db->select('id');
        $this->db->from('haki_lisensi');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        $result = $query->row();

        return $result ? $result->id : null;
    }

    public function add_haki_buku($data)
    {
        $this->db->insert('haki_buku', $data);
    }

    public function get_haki_buku_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('haki_buku');
        $this->db->where('id_haki', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_last_buku_id()
    {
        $this->db->select('id');
        $this->db->from('haki_buku');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        $result = $query->row();

        return $result ? $result->id : null;
    }

    public function add_haki_paten($data)
    {
        return $this->db->insert('haki_paten', $data);
    }

    public function get_haki_paten_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('haki_paten');
        $this->db->where('id_haki', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_last_paten_id()
    {
        $this->db->select('id'); // Asumsi kolom ID adalah 'id'
        $this->db->from('haki_paten');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        $result = $query->row();

        return $result ? $result->id : null;
    }

    public function add_haki_dindustri($data)
    {
        return $this->db->insert('haki_dindustri', $data);
    }

    public function get_haki_dindustri_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('haki_dindustri');
        $this->db->where('id_haki', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_last_dindustri_id()
    {
        $this->db->select('id');
        $this->db->from('haki_dindustri');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        $result = $query->row();

        return $result ? $result->id : null;
    }

    public function add_editor_jurnal($data)
    {
        return $this->db->insert('editor_jurnal', $data);
    }

    public function get_editor_jurnal_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('editor_jurnal');
        $this->db->where('id_pelaporan', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function update_editor_jurnal($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('editor_jurnal', $data);
    }

    public function delete_editor_jurnal($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('status_stok');
    }

    public function add_reviewer_jurnal($data)
    {
        return $this->db->insert('reviewer_jurnal', $data);
    }

    public function get_reviewer_jurnal_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('reviewer_jurnal');
        $this->db->where('id_pelaporan', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function update_reviewer_jurnal($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('reviewer_jurnal', $data);
    }

    public function delete_reviewer_jurnal($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('status_stok');
    }

    public function add_invited_speaker($data)
    {
        $this->db->insert('iv_speaker', $data);
    }

    public function get_invited_speaker_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('iv_speaker');
        $this->db->where('id_pelaporan', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function update_invited_speaker($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('iv_speaker', $data);
    }

    public function delete_invited_speaker($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('iv_speaker');
    }

    public function add_pengurus_organisasi($data)
    {
        $this->db->insert('org_profesi', $data);
    }

    public function get_pengurus_organisasi_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('org_profesi');
        $this->db->where('id_pelaporan', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function update_pengurus_organisasi($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('org_profesi', $data);
    }

    public function delete_pengurus_organisasi($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('org_profesi');
    }

    public function add_anggota_pelaporan($data)
    {
        $this->db->insert('anggota_pelaporan', $data);
    }

    public function get_anggota_pelaporan_by_id($id, $kategori)
    {
        $this->db->select('*');
        $this->db->from('anggota_pelaporan');
        $this->db->where('id_jenis_lapor', $id);
        $this->db->where('kategori', $kategori);
        $query = $this->db->get();
        return $query->result();
    }

    public function add_inventor_haki($data)
    {
        $this->db->insert('inventor_haki', $data);
    }

    public function get_inventor_haki_by_id($id, $kategori)
    {
        $this->db->select('*');
        $this->db->from('inventor_haki');
        $this->db->where('id_jenis_haki', $id);
        $this->db->where('kategori', $kategori);
        $query = $this->db->get();
        return $query->result();
    }

    public function add_mhs_pelaporan($data)
    {
        $this->db->insert('mhs_pelaporan', $data);
    }

    public function get_mhs_pelaporan_by_id($id, $kategori)
    {
        $this->db->select('*');
        $this->db->from('mhs_pelaporan');
        $this->db->where('id_jenis_lapor', $id);
        $this->db->where('kategori', $kategori);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_publikasi_internasional($tahun = null)
    {
        $this->db->select('*');
        $this->db->from('artikel_ilmiah');
        $this->db->where_in('kategori', [
            'Internasional Q1',
            'Internasional Q2',
            'Internasional Q3',
            'Internasional Q4',
            'Internasional Non Scopus'
        ]);
        $this->db->where('tahun', $tahun); //Filter berdasarkan tahun
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_publikasi_nasional($tahun = null)
    {
        $this->db->select('*');
        $this->db->from('artikel_ilmiah');
        $this->db->where_in('kategori', [
            'Nasional Sinta 1',
            'Nasional Sinta 2',
            'Nasional Sinta 3',
            'Nasional Sinta 4',
            'Nasional Sinta 5',
            'Nasional Sinta 6',
            'Nasional Tidak Terakreditasi'
        ]);
        $this->db->where('tahun', $tahun); //Filter berdasarkan tahun
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function count_q1_data($tahun = null)
    {
        $this->db->select('COUNT(*) as jumlah');
        $this->db->from('artikel_ilmiah');
        $this->db->where('kategori', 'Internasional Q1'); // Hanya menghitung Internasional Q1
        $this->db->where('tahun', $tahun); //Filter berdasarkan tahun
        $query = $this->db->get();

        $result = $query->row(); // Ambil satu baris hasil
        return $result ? $result->jumlah : 0; // Jika hasil ada, kembalikan jumlah, jika tidak kembalikan 0
    }

    public function count_q2_data($tahun = null)
    {
        $this->db->select('COUNT(*) as jumlah');
        $this->db->from('artikel_ilmiah');
        $this->db->where('kategori', 'Internasional Q2'); // Hanya menghitung Internasional Q1
        $this->db->where('tahun', $tahun); //Filter berdasarkan tahun
        $query = $this->db->get();

        $result = $query->row(); // Ambil satu baris hasil
        return $result ? $result->jumlah : 0; // Jika hasil ada, kembalikan jumlah, jika tidak kembalikan 0
    }

    public function count_q3_data($tahun = null)
    {
        $this->db->select('COUNT(*) as jumlah');
        $this->db->from('artikel_ilmiah');
        $this->db->where('kategori', 'Internasional Q3'); // Hanya menghitung Internasional Q1
        $this->db->where('tahun', $tahun); //Filter berdasarkan tahun
        $query = $this->db->get();

        $result = $query->row(); // Ambil satu baris hasil
        return $result ? $result->jumlah : 0; // Jika hasil ada, kembalikan jumlah, jika tidak kembalikan 0
    }

    public function count_q4_data($tahun = null)
    {
        $this->db->select('COUNT(*) as jumlah');
        $this->db->from('artikel_ilmiah');
        $this->db->where('kategori', 'Internasional Q4'); // Hanya menghitung Internasional Q1
        $this->db->where('tahun', $tahun); //Filter berdasarkan tahun
        $query = $this->db->get();

        $result = $query->row(); // Ambil satu baris hasil
        return $result ? $result->jumlah : 0; // Jika hasil ada, kembalikan jumlah, jika tidak kembalikan 0
    }

    public function count_s1_data($tahun = null)
    {
        $this->db->select('COUNT(*) as jumlah');
        $this->db->from('artikel_ilmiah');
        $this->db->where('kategori', 'Nasional Sinta 1'); // Hanya menghitung Nasional Sinta 1
        $this->db->where('tahun', $tahun); //Filter berdasarkan tahun
        $query = $this->db->get();

        $result = $query->row(); // Ambil satu baris hasil
        return $result ? $result->jumlah : 0; // Jika hasil ada, kembalikan jumlah, jika tidak kembalikan 0
    }

    public function count_s2_data($tahun = null)
    {
        $this->db->select('COUNT(*) as jumlah');
        $this->db->from('artikel_ilmiah');
        $this->db->where('kategori', 'Nasional Sinta 2'); // Hanya menghitung Nasional Sinta 2
        $this->db->where('tahun', $tahun); //Filter berdasarkan tahun
        $query = $this->db->get();

        $result = $query->row();
        return $result ? $result->jumlah : 0;
    }

    public function count_s3_data($tahun = null)
    {
        $this->db->select('COUNT(*) as jumlah');
        $this->db->from('artikel_ilmiah');
        $this->db->where('kategori', 'Nasional Sinta 3'); // Hanya menghitung Nasional Sinta 3
        $this->db->where('tahun', $tahun); //Filter berdasarkan tahun
        $query = $this->db->get();

        $result = $query->row();
        return $result ? $result->jumlah : 0;
    }

    public function count_s4_data($tahun = null)
    {
        $this->db->select('COUNT(*) as jumlah');
        $this->db->from('artikel_ilmiah');
        $this->db->where('kategori', 'Nasional Sinta 4'); // Hanya menghitung Nasional Sinta 4
        $this->db->where('tahun', $tahun); //Filter berdasarkan tahun
        $query = $this->db->get();

        $result = $query->row();
        return $result ? $result->jumlah : 0;
    }

    public function count_s5_data($tahun = null)
    {
        $this->db->select('COUNT(*) as jumlah');
        $this->db->from('artikel_ilmiah');
        $this->db->where('kategori', 'Nasional Sinta 5'); // Hanya menghitung Nasional Sinta 5
        $this->db->where('tahun', $tahun); //Filter berdasarkan tahun
        $query = $this->db->get();

        $result = $query->row();
        return $result ? $result->jumlah : 0;
    }

    public function count_s6_data($tahun = null)
    {
        $this->db->select('COUNT(*) as jumlah');
        $this->db->from('artikel_ilmiah');
        $this->db->where('kategori', 'Nasional Sinta 6'); // Hanya menghitung Nasional Sinta 6
        $this->db->where('tahun', $tahun); //Filter berdasarkan tahun
        $query = $this->db->get();

        $result = $query->row();
        return $result ? $result->jumlah : 0;
    }

    public function count_tidak_terakreditasi_data($tahun = null)
    {
        $this->db->select('COUNT(*) as jumlah');
        $this->db->from('artikel_ilmiah');
        $this->db->where('kategori', 'Nasional Tidak Terakreditasi'); // Hanya menghitung Nasional Tidak Terakreditasi
        $this->db->where('tahun', $tahun); //Filter berdasarkan tahun   
        $query = $this->db->get();

        $result = $query->row();
        return $result ? $result->jumlah : 0;
    }

    public function count_publikasi_internasional_data($tahun = null)
    {
        $this->db->select('COUNT(*) as jumlah');
        $this->db->from('artikel_ilmiah');
        $this->db->where_in('kategori', [
            'Internasional Q1',
            'Internasional Q2',
            'Internasional Q3',
            'Internasional Q4',
            'Internasional Non Scopus'
        ]);
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $query = $this->db->get();

        $result = $query->row();
        return $result ? $result->jumlah : 0;
    }

    public function count_publikasi_nasional_data($tahun = null)
    {
        $this->db->select('COUNT(*) as jumlah');
        $this->db->from('artikel_ilmiah');
        $this->db->where_in('kategori', [
            'Nasional Sinta 1',
            'Nasional Sinta 2',
            'Nasional Sinta 3',
            'Nasional Sinta 4',
            'Nasional Sinta 5',
            'Nasional Sinta 6',
            'Nasional Tidak Terakreditasi'
        ]);
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $query = $this->db->get();

        $result = $query->row();
        return $result ? $result->jumlah : 0;
    }

    public function get_total_hibah_pengabdian()
    {
        $this->db->select('p.nama_ketua, p.judul, p.besar_hibah, ap.nama AS nama_anggota');
        $this->db->from('pengabdian p');
        $this->db->join('anggota_pelaporan ap', 'p.id = ap.id_jenis_lapor', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_hibah_penelitian($tahun = null)
    {
        $this->db->select('*');
        $this->db->from('penelitian');
        $this->db->where('tahun', $tahun);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function count_mandiri_penelitian($tahun = null, $prodi = null)
    {
        $this->db->select_sum('besar_hibah');
        $this->db->where('kategori', 'Mandiri');
        $this->db->where('tahun', $tahun);
        if ($prodi) {
            $this->db->where('prodi', $prodi);
        }
        $query = $this->db->get('penelitian');
        return $query->row()->besar_hibah ?? 0;
    }

    public function count_internal_penelitian($tahun = null, $prodi = null)
    {
        $this->db->select_sum('besar_hibah');
        $this->db->where('kategori', 'Internal');
        $this->db->where('tahun', $tahun);
        if ($prodi) {
            $this->db->where('prodi', $prodi);
        }
        $query = $this->db->get('penelitian');
        return $query->row()->besar_hibah ?? 0;
    }

    public function count_nasional_penelitian($tahun = null, $prodi = null)
    {
        $this->db->select_sum('besar_hibah');
        $this->db->where('kategori', 'Nasional');
        $this->db->where('tahun', $tahun);
        if ($prodi) {
            $this->db->where('prodi', $prodi);
        }
        $query = $this->db->get('penelitian');
        return $query->row()->besar_hibah ?? 0;
    }

    public function count_internasional_penelitian($tahun = null, $prodi = null)
    {
        $this->db->select_sum('besar_hibah');
        $this->db->where('kategori', 'Internasional');
        $this->db->where('tahun', $tahun);
        if ($prodi) {
            $this->db->where('prodi', $prodi);
        }
        $query = $this->db->get('penelitian');
        return $query->row()->besar_hibah ?? 0;
    }

    public function get_hibah_pengabdian($tahun = null)
    {
        $this->db->select('*');
        $this->db->from('pengabdian');
        $this->db->where('tahun', $tahun);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function count_mandiri_pengabdian($tahun = null, $prodi = null)
    {
        $this->db->select_sum('besar_hibah', 'total_hibah');
        $this->db->where('kategori', 'Mandiri');
        $this->db->where('tahun', $tahun);
        if ($prodi) {
            $this->db->where('prodi', $prodi);
        }
        $query = $this->db->get('pengabdian');
        return $query->row()->total_hibah ?? 0;
    }

    public function count_internal_pengabdian($tahun = null, $prodi = null)
    {
        $this->db->select_sum('besar_hibah', 'total_hibah');
        $this->db->where('kategori', 'Internal');
        $this->db->where('tahun', $tahun);
        if ($prodi) {
            $this->db->where('prodi', $prodi);
        }
        $query = $this->db->get('pengabdian');
        return $query->row()->total_hibah ?? 0;
    }

    public function count_nasional_pengabdian($tahun = null, $prodi = null)
    {
        $this->db->select_sum('besar_hibah', 'total_hibah');
        $this->db->where('kategori', 'Nasional');
        $this->db->where('tahun', $tahun);
        if ($prodi) {
            $this->db->where('prodi', $prodi);
        }
        $query = $this->db->get('pengabdian');
        return $query->row()->total_hibah ?? 0;
    }

    public function count_internasional_pengabdian($tahun = null, $prodi = null)
    {
        $this->db->select_sum('besar_hibah', 'total_hibah');
        $this->db->where('kategori', 'Internasional');
        $this->db->where('tahun', $tahun);
        if ($prodi) {
            $this->db->where('prodi', $prodi);
        }
        $query = $this->db->get('pengabdian');
        return $query->row()->total_hibah ?? 0;
    }

    public function get_publikasi_elektro($tahun = null)
    {
        $this->db->select('*');
        $this->db->from('artikel_ilmiah');
        $this->db->where('prodi', 'Teknik Elektro');
        $this->db->where('tahun', $tahun);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_publikasi_industri($tahun = null)
    {
        $this->db->select('*');
        $this->db->from('artikel_ilmiah');
        $this->db->where('prodi', 'Teknik Industri');
        $this->db->where('tahun', $tahun);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_publikasi_biomedis($tahun = null)
    {
        $this->db->select('*');
        $this->db->from('artikel_ilmiah');
        $this->db->where('prodi', 'Teknik Biomedis');
        $this->db->where('tahun', $tahun);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_penelitian_elektro($tahun)
    {
        $this->db->select('*');
        $this->db->from('penelitian');
        $this->db->where('prodi', 'Teknik Elektro');
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_penelitian_industri($tahun)
    {
        $this->db->select('*');
        $this->db->from('penelitian');
        $this->db->where('prodi', 'Teknik Industri');
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_penelitian_biomedis($tahun)
    {
        $this->db->select('*');
        $this->db->from('penelitian');
        $this->db->where('prodi', 'Teknik Biomedis');
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_pengabdian_elektro($tahun)
    {
        $this->db->select('*');
        $this->db->from('pengabdian');
        $this->db->where('prodi', 'Teknik Elektro');
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_pengabdian_industri($tahun)
    {
        $this->db->select('*');
        $this->db->from('pengabdian');
        $this->db->where('prodi', 'Teknik Industri');
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_pengabdian_biomedis($tahun)
    {
        $this->db->select('*');
        $this->db->from('pengabdian');
        $this->db->where('prodi', 'Teknik Biomedis');
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }


    public function get_penelitian_eksternal($tahun)
    {
        $this->db->select('penelitian.*, SUM(besar_hibah) OVER() as total_hibah');
        $this->db->from('penelitian');
        $this->db->where_in('kategori', ['Nasional', 'Internasional']);
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_penelitian_internal($tahun)
    {
        $this->db->select('penelitian.*, SUM(besar_hibah) OVER() as total_hibah');
        $this->db->from('penelitian');
        $this->db->where_in('kategori', ['Mandiri', 'Internal']);
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_pengabdian_eksternal($tahun)
    {
        $this->db->select('pengabdian.*, SUM(besar_hibah) OVER() as total_hibah');
        $this->db->from('pengabdian');
        $this->db->where_in('kategori', ['Nasional', 'Internasional']);
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_pengabdian_internal($tahun)
    {
        $this->db->select('pengabdian.*, SUM(besar_hibah) OVER() as total_hibah');
        $this->db->from('pengabdian');
        $this->db->where_in('kategori', ['Mandiri', 'Internal']);
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // FUNCTION GET CETAK PELAPORAN TEKNIK ELEKTRO

    public function get_publikasi_nasional_elektro($tahun)
    {
        $this->db->select('*');
        $this->db->from('artikel_ilmiah');
        $this->db->where_in('kategori', [
            'Nasional Sinta 1',
            'Nasional Sinta 2',
            'Nasional Sinta 3',
            'Nasional Sinta 4',
            'Nasional Sinta 5',
            'Nasional Sinta 6',
            'Nasional Tidak Terakreditasi'
        ]);
        $this->db->where('prodi', 'Teknik Elektro');
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_publikasi_internasional_elektro($tahun)
    {
        $this->db->select('*');
        $this->db->from('artikel_ilmiah');
        $this->db->where_in('kategori', [
            'Internasional Q1',
            'Internasional Q2',
            'Internasional Q3',
            'Internasional Q4',
            'Internasional Non Scopus'
        ]);
        $this->db->where('prodi', 'Teknik Elektro');
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_seminar_internasional_elektro($tahun)
    {
        $this->db->select('*');
        $this->db->from('prosiding');
        $this->db->where_in('kategori', 'Internasional');
        $this->db->where('prodi', 'Teknik Elektro');
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_seminar_nasional_elektro($tahun)
    {
        $this->db->select('*');
        $this->db->from('prosiding');
        $this->db->where_in('kategori', 'Nasional');
        $this->db->where('prodi', 'Teknik Elektro');
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_hcipta_elektro($tahun)
    {
        $this->db->select('*');
        $this->db->from('haki_hcipta');
        $this->db->where('prodi', 'Teknik Elektro');
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_dindustri_elektro($tahun)
    {
        $this->db->select('*');
        $this->db->from('haki_dindustri');
        $this->db->where('prodi', 'Teknik Elektro');
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_paten_elektro($tahun)
    {
        $this->db->select('*');
        $this->db->from('haki_paten');
        $this->db->where('prodi', 'Teknik Elektro');
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_penelitian_eksternal_elektro($tahun)
    {
        $this->db->select('penelitian.*, SUM(besar_hibah) OVER() as total_hibah');
        $this->db->from('penelitian');
        $this->db->where_in('kategori', ['Nasional', 'Internasional']);
        $this->db->where('prodi', 'Teknik Elektro');
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_penelitian_internal_elektro($tahun)
    {
        $this->db->select('penelitian.*, SUM(besar_hibah) OVER() as total_hibah');
        $this->db->from('penelitian');
        $this->db->where_in('kategori', ['Mandiri', 'Internal']);
        $this->db->where('prodi', 'Teknik Elektro');
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_pengabdian_eksternal_elektro($tahun)
    {
        $this->db->select('pengabdian.*, SUM(besar_hibah) OVER() as total_hibah');
        $this->db->from('pengabdian');
        $this->db->where_in('kategori', ['Nasional', 'Internasional']);
        $this->db->where('prodi', 'Teknik Elektro');
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_pengabdian_internal_elektro($tahun)
    {
        $this->db->select('pengabdian.*, SUM(besar_hibah) OVER() as total_hibah');
        $this->db->from('pengabdian');
        $this->db->where_in('kategori', ['Mandiri', 'Internal']);
        $this->db->where('prodi', 'Teknik Elektro');
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // FUNCTION GET CETAK PELAPORAN TEKNIK INDUSTRI

    public function get_publikasi_nasional_industri($tahun)
    {
        $this->db->select('*');
        $this->db->from('artikel_ilmiah');
        $this->db->where_in('kategori', [
            'Nasional Sinta 1',
            'Nasional Sinta 2',
            'Nasional Sinta 3',
            'Nasional Sinta 4',
            'Nasional Sinta 5',
            'Nasional Sinta 6',
            'Nasional Tidak Terakreditasi'
        ]);
        $this->db->where('prodi', 'Teknik Industri');
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_publikasi_internasional_industri($tahun)
    {
        $this->db->select('*');
        $this->db->from('artikel_ilmiah');
        $this->db->where_in('kategori', [
            'Internasional Q1',
            'Internasional Q2',
            'Internasional Q3',
            'Internasional Q4',
            'Internasional Non Scopus'
        ]);
        $this->db->where('prodi', 'Teknik Industri');
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_seminar_internasional_industri($tahun)
    {
        $this->db->select('*');
        $this->db->from('prosiding');
        $this->db->where_in('kategori', 'Internasional');
        $this->db->where('prodi', 'Teknik Industri');
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_seminar_nasional_industri($tahun)
    {
        $this->db->select('*');
        $this->db->from('prosiding');
        $this->db->where_in('kategori', 'Nasional');
        $this->db->where('prodi', 'Teknik Industri');
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_hcipta_industri($tahun)
    {
        $this->db->select('*');
        $this->db->from('haki_hcipta');
        $this->db->where('prodi', 'Teknik Industri');
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_dindustri_industri($tahun)
    {
        $this->db->select('*');
        $this->db->from('haki_dindustri');
        $this->db->where('prodi', 'Teknik Industri');
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_paten_industri($tahun)
    {
        $this->db->select('*');
        $this->db->from('haki_paten');
        $this->db->where('prodi', 'Teknik Industri');
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_penelitian_eksternal_industri($tahun)
    {
        $this->db->select('penelitian.*, SUM(besar_hibah) OVER() as total_hibah');
        $this->db->from('penelitian');
        $this->db->where_in('kategori', ['Nasional', 'Internasional']);
        $this->db->where('prodi', 'Teknik Industri');
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_penelitian_internal_industri($tahun)
    {
        $this->db->select('penelitian.*, SUM(besar_hibah) OVER() as total_hibah');
        $this->db->from('penelitian');
        $this->db->where_in('kategori', ['Mandiri', 'Internal']);
        $this->db->where('prodi', 'Teknik Industri');
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_pengabdian_eksternal_industri($tahun)
    {
        $this->db->select('pengabdian.*, SUM(besar_hibah) OVER() as total_hibah');
        $this->db->from('pengabdian');
        $this->db->where_in('kategori', ['Nasional', 'Internasional']);
        $this->db->where('prodi', 'Teknik Industri');
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_pengabdian_internal_industri($tahun)
    {
        $this->db->select('pengabdian.*, SUM(besar_hibah) OVER() as total_hibah');
        $this->db->from('pengabdian');
        $this->db->where_in('kategori', ['Mandiri', 'Internal']);
        $this->db->where('prodi', 'Teknik Industri');
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // FUNCTION GET CETAK PELAPORAN TEKNIK BIOMEDIS

    public function get_publikasi_nasional_biomedis($tahun)
    {
        $this->db->select('*');
        $this->db->from('artikel_ilmiah');
        $this->db->where_in('kategori', [
            'Nasional Sinta 1',
            'Nasional Sinta 2',
            'Nasional Sinta 3',
            'Nasional Sinta 4',
            'Nasional Sinta 5',
            'Nasional Sinta 6',
            'Nasional Tidak Terakreditasi'
        ]);
        $this->db->where('prodi', 'Teknik Biomedis');
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_publikasi_internasional_biomedis($tahun)
    {
        $this->db->select('*');
        $this->db->from('artikel_ilmiah');
        $this->db->where_in('kategori', [
            'Internasional Q1',
            'Internasional Q2',
            'Internasional Q3',
            'Internasional Q4',
            'Internasional Non Scopus'
        ]);
        $this->db->where('prodi', 'Teknik Biomedis');
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_seminar_internasional_biomedis($tahun)
    {
        $this->db->select('*');
        $this->db->from('prosiding');
        $this->db->where_in('kategori', 'Internasional');
        $this->db->where('prodi', 'Teknik Biomedis');
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_seminar_nasional_biomedis($tahun)
    {
        $this->db->select('*');
        $this->db->from('prosiding');
        $this->db->where_in('kategori', 'Nasional');
        $this->db->where('prodi', 'Teknik Biomedis');
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_hcipta_biomedis($tahun)
    {
        $this->db->select('*');
        $this->db->from('haki_hcipta');
        $this->db->where('prodi', 'Teknik Biomedis');
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_dindustri_biomedis($tahun)
    {
        $this->db->select('*');
        $this->db->from('haki_dindustri');
        $this->db->where('prodi', 'Teknik Biomedis');
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_paten_biomedis($tahun)
    {
        $this->db->select('*');
        $this->db->from('haki_paten');
        $this->db->where('prodi', 'Teknik Biomedis');
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_penelitian_eksternal_biomedis($tahun)
    {
        $this->db->select('penelitian.*, SUM(besar_hibah) OVER() as total_hibah');
        $this->db->from('penelitian');
        $this->db->where_in('kategori', ['Nasional', 'Internasional']);
        $this->db->where('prodi', 'Teknik Biomedis');
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_penelitian_internal_biomedis($tahun)
    {
        $this->db->select('penelitian.*, SUM(besar_hibah) OVER() as total_hibah');
        $this->db->from('penelitian');
        $this->db->where_in('kategori', ['Mandiri', 'Internal']);
        $this->db->where('prodi', 'Teknik Biomedis');
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_pengabdian_eksternal_biomedis($tahun)
    {
        $this->db->select('pengabdian.*, SUM(besar_hibah) OVER() as total_hibah');
        $this->db->from('pengabdian');
        $this->db->where_in('kategori', ['Nasional', 'Internasional']);
        $this->db->where('prodi', 'Teknik Biomedis');
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_pengabdian_internal_biomedis($tahun)
    {
        $this->db->select('pengabdian.*, SUM(besar_hibah) OVER() as total_hibah');
        $this->db->from('pengabdian');
        $this->db->where_in('kategori', ['Mandiri', 'Internal']);
        $this->db->where('prodi', 'Teknik Biomedis');
        $this->db->where('tahun', $tahun); // Filter berdasarkan tahun
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
}
