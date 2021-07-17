<?php

class HistoryPesanan_m extends CI_Model
{
    public function getAllHistoryPesanan()
    {
        $this->db->select('id_pesanan,namaPegawai,tgl_pesan,nama_Customer');
        $this->db->from('tbl_pesanan');
        $this->db->join('tbl_pegawai', 'tbl_pegawai.id_pegawai = tbl_pesanan.id_pegawai');
        return $query = $this->db->get()->result_array();
    }

    public function getOrderDetails($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_detailpesanan');
        $this->db->join('tbl_pesanan', 'tbl_pesanan.id_pesanan = tbl_detailpesanan.id_pesanan');
        $this->db->join('tbl_menu', 'tbl_menu.id_menu = tbl_detailpesanan.id_menu');
        $this->db->where('tbl_detailpesanan.id_pesanan', $id);
        return $query = $this->db->get()->result_array();
    }

    public function getCustomerName($id)
    {
        $query = $this->db->select('nama_Customer as Nama')->from('tbl_pesanan')->where('id_pesanan', $id)->get();
        return $query->row()->Nama;
    }

    public function id_transaksi()
    {
        $query = $this->db->query(
            "SELECT IFNULL(MAX(SUBSTRING(id_transaksi,5)),0)+1 AS no_urut FROM tbl_transaksi"
        );
        $data = $query->row_array();
        $no_urut = sprintf("%'.04d", $data['no_urut']);

        $id = 'K' . $no_urut;


        return $id;
    }
}
