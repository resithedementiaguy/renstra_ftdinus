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
        return $this->db->delete('status_stok');
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
        $this->db->where('id', $id);
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

    public function get_publikasi_internasional()
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
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_publikasi_nasional()
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
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function count_q1_data()
    {
        $this->db->select('COUNT(*) as jumlah');
        $this->db->from('artikel_ilmiah');
        $this->db->where('kategori', 'Internasional Q1'); // Hanya menghitung Internasional Q1
        $query = $this->db->get();

        $result = $query->row(); // Ambil satu baris hasil
        return $result ? $result->jumlah : 0; // Jika hasil ada, kembalikan jumlah, jika tidak kembalikan 0
    }

    public function count_q2_data()
    {
        $this->db->select('COUNT(*) as jumlah');
        $this->db->from('artikel_ilmiah');
        $this->db->where('kategori', 'Internasional Q2'); // Hanya menghitung Internasional Q1
        $query = $this->db->get();

        $result = $query->row(); // Ambil satu baris hasil
        return $result ? $result->jumlah : 0; // Jika hasil ada, kembalikan jumlah, jika tidak kembalikan 0
    }

    public function count_q3_data()
    {
        $this->db->select('COUNT(*) as jumlah');
        $this->db->from('artikel_ilmiah');
        $this->db->where('kategori', 'Internasional Q3'); // Hanya menghitung Internasional Q1
        $query = $this->db->get();

        $result = $query->row(); // Ambil satu baris hasil
        return $result ? $result->jumlah : 0; // Jika hasil ada, kembalikan jumlah, jika tidak kembalikan 0
    }

    public function count_q4_data()
    {
        $this->db->select('COUNT(*) as jumlah');
        $this->db->from('artikel_ilmiah');
        $this->db->where('kategori', 'Internasional Q4'); // Hanya menghitung Internasional Q1
        $query = $this->db->get();

        $result = $query->row(); // Ambil satu baris hasil
        return $result ? $result->jumlah : 0; // Jika hasil ada, kembalikan jumlah, jika tidak kembalikan 0
    }

    public function count_s1_data()
    {
        $this->db->select('COUNT(*) as jumlah');
        $this->db->from('artikel_ilmiah');
        $this->db->where('kategori', 'Nasional Sinta 1'); // Hanya menghitung Nasional Sinta 1
        $query = $this->db->get();

        $result = $query->row(); // Ambil satu baris hasil
        return $result ? $result->jumlah : 0; // Jika hasil ada, kembalikan jumlah, jika tidak kembalikan 0
    }

    public function count_s2_data()
    {
        $this->db->select('COUNT(*) as jumlah');
        $this->db->from('artikel_ilmiah');
        $this->db->where('kategori', 'Nasional Sinta 2'); // Hanya menghitung Nasional Sinta 2
        $query = $this->db->get();

        $result = $query->row();
        return $result ? $result->jumlah : 0;
    }

    public function count_s3_data()
    {
        $this->db->select('COUNT(*) as jumlah');
        $this->db->from('artikel_ilmiah');
        $this->db->where('kategori', 'Nasional Sinta 3'); // Hanya menghitung Nasional Sinta 3
        $query = $this->db->get();

        $result = $query->row();
        return $result ? $result->jumlah : 0;
    }

    public function count_s4_data()
    {
        $this->db->select('COUNT(*) as jumlah');
        $this->db->from('artikel_ilmiah');
        $this->db->where('kategori', 'Nasional Sinta 4'); // Hanya menghitung Nasional Sinta 4
        $query = $this->db->get();

        $result = $query->row();
        return $result ? $result->jumlah : 0;
    }

    public function count_s5_data()
    {
        $this->db->select('COUNT(*) as jumlah');
        $this->db->from('artikel_ilmiah');
        $this->db->where('kategori', 'Nasional Sinta 5'); // Hanya menghitung Nasional Sinta 5
        $query = $this->db->get();

        $result = $query->row();
        return $result ? $result->jumlah : 0;
    }

    public function count_s6_data()
    {
        $this->db->select('COUNT(*) as jumlah');
        $this->db->from('artikel_ilmiah');
        $this->db->where('kategori', 'Nasional Sinta 6'); // Hanya menghitung Nasional Sinta 6
        $query = $this->db->get();

        $result = $query->row();
        return $result ? $result->jumlah : 0;
    }

    public function count_tidak_terakreditasi_data()
    {
        $this->db->select('COUNT(*) as jumlah');
        $this->db->from('artikel_ilmiah');
        $this->db->where('kategori', 'Nasional Tidak Terakreditasi'); // Hanya menghitung Nasional Tidak Terakreditasi
        $query = $this->db->get();

        $result = $query->row();
        return $result ? $result->jumlah : 0;
    }

    public function count_publikasi_internasional_data()
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
        $query = $this->db->get();

        $result = $query->row(); // Ambil satu baris hasil
        return $result ? $result->jumlah : 0; // Jika hasil ada, kembalikan jumlah, jika tidak kembalikan 0
    }

    public function count_publikasi_nasional_data()
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
        $query = $this->db->get();

        $result = $query->row(); // Ambil satu baris hasil
        return $result ? $result->jumlah : 0; // Jika hasil ada, kembalikan jumlah, jika tidak kembalikan 0
    }

    public function get_total_hibah_pengabdian()
    {
        $this->db->select('p.nama_ketua, p.judul, p.besar_hibah, ap.nama AS nama_anggota');
        $this->db->from('pengabdian p');
        $this->db->join('anggota_pelaporan ap', 'p.id = ap.id_jenis_lapor', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_hibah_penelitian()
    {
        $this->db->select('*');
        $this->db->from('penelitian');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function count_mandiri_penelitian()
    {
        $this->db->select('SUM(besar_hibah) as total_hibah'); // Menggunakan SUM untuk menjumlahkan besar_hibah
        $this->db->from('penelitian');
        $this->db->where('kategori', 'Mandiri'); // Hanya menghitung kategori Mandiri
        $query = $this->db->get();

        $result = $query->row(); // Ambil satu baris hasil
        return $result ? $result->total_hibah : 0; // Jika hasil ada, kembalikan total_hibah,
    }

    public function count_internal_penelitian()
    {
        $this->db->select('SUM(besar_hibah) as total_hibah'); // Menggunakan SUM untuk menjumlahkan besar_hibah
        $this->db->from('penelitian');
        $this->db->where('kategori', 'Internal'); // Hanya menghitung kategori Mandiri
        $query = $this->db->get();

        $result = $query->row(); // Ambil satu baris hasil
        return $result ? $result->total_hibah : 0; // Jika hasil ada, kembalikan total_hibah,
    }
    public function count_nasional_penelitian()
    {
        $this->db->select('SUM(besar_hibah) as total_hibah'); // Menggunakan SUM untuk menjumlahkan besar_hibah
        $this->db->from('penelitian');
        $this->db->where('kategori', 'Nasional'); // Hanya menghitung kategori Mandiri
        $query = $this->db->get();

        $result = $query->row(); // Ambil satu baris hasil
        return $result ? $result->total_hibah : 0; // Jika hasil ada, kembalikan total_hibah,
    }
    public function count_internasional_penelitian()
    {
        $this->db->select('SUM(besar_hibah) as total_hibah'); // Menggunakan SUM untuk menjumlahkan besar_hibah
        $this->db->from('penelitian');
        $this->db->where('kategori', 'Internasional'); // Hanya menghitung kategori Mandiri
        $query = $this->db->get();

        $result = $query->row(); // Ambil satu baris hasil
        return $result ? $result->total_hibah : 0; // Jika hasil ada, kembalikan total_hibah,
    }

    public function get_hibah_pengabdian()
    {
        $this->db->select('*');
        $this->db->from('pengabdian');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function count_mandiri_pengabdian()
    {
        $this->db->select('SUM(besar_hibah) as total_hibah'); // Menggunakan SUM untuk menjumlahkan besar_hibah
        $this->db->from('pengabdian');
        $this->db->where('kategori', 'Mandiri'); // Hanya menghitung kategori Mandiri
        $query = $this->db->get();

        $result = $query->row(); // Ambil satu baris hasil
        return $result ? $result->total_hibah : 0; // Jika hasil ada, kembalikan total_hibah,
    }

    public function count_internal_pengabdian()
    {
        $this->db->select('SUM(besar_hibah) as total_hibah'); // Menggunakan SUM untuk menjumlahkan besar_hibah
        $this->db->from('pengabdian');
        $this->db->where('kategori', 'Internal'); // Hanya menghitung kategori Mandiri
        $query = $this->db->get();

        $result = $query->row(); // Ambil satu baris hasil
        return $result ? $result->total_hibah : 0; // Jika hasil ada, kembalikan total_hibah,
    }
    public function count_nasional_pengabdian()
    {
        $this->db->select('SUM(besar_hibah) as total_hibah'); // Menggunakan SUM untuk menjumlahkan besar_hibah
        $this->db->from('pengabdian');
        $this->db->where('kategori', 'Nasional'); // Hanya menghitung kategori Mandiri
        $query = $this->db->get();

        $result = $query->row(); // Ambil satu baris hasil
        return $result ? $result->total_hibah : 0; // Jika hasil ada, kembalikan total_hibah,
    }
    public function count_internasional_pengabdian()
    {
        $this->db->select('SUM(besar_hibah) as total_hibah'); // Menggunakan SUM untuk menjumlahkan besar_hibah
        $this->db->from('pengabdian');
        $this->db->where('kategori', 'Internasional'); // Hanya menghitung kategori Mandiri
        $query = $this->db->get();

        $result = $query->row(); // Ambil satu baris hasil
        return $result ? $result->total_hibah : 0; // Jika hasil ada, kembalikan total_hibah,
    }

    public function get_publikasi_elektro()
    {
        $this->db->select('*');
        $this->db->from('artikel_ilmiah');
        $this->db->where('prodi', 'Teknik Elektro');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_publikasi_industri()
    {
        $this->db->select('*');
        $this->db->from('artikel_ilmiah');
        $this->db->where('prodi', 'Teknik Industri');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_publikasi_biomedis()
    {
        $this->db->select('*');
        $this->db->from('artikel_ilmiah');
        $this->db->where('prodi', 'Teknik Biomedis');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get(); 
        return $query->result();
    }

}
