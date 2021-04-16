<?php

namespace App\Models;

use CodeIgniter\Model;

class PrintInvoice extends Model
{
    protected $primaryKey = 'idm_deliv';

    public function inv($keyword)
    {
        return $this->db->table('deliv_order')
            ->join('master_unit', 'master_unit.idm_nopol = deliv_order.nopol_idm', 'left')
            ->join('master_dari', 'master_dari.idm_dari = deliv_order.dari_idm', 'left')
            ->join('master_tujuan', 'master_tujuan.idm_tujuan = deliv_order.tujuan_idm', 'left')
            ->join('deliv_invoice', 'deliv_invoice.deliv_idm = deliv_order.idm_deliv', 'left')
            ->where('no_inv', $keyword)
            ->where('deliv_order.deleted_at', null)
            ->get()->getResultArray();
    }
    public function ket($keyword)
    {
        return $this->db->table('deliv_order')
            ->select('deliv_invoice.po,deliv_invoice.no_inv')
            ->join('master_produk', 'master_produk.idm_produk=deliv_order.produk_idm', 'left')
            ->join('deliv_invoice', 'deliv_invoice.deliv_idm=deliv_order.idm_deliv', 'left')
            ->select('deliv_order.*,deliv_invoice.no_inv,deliv_invoice.tgl_inv,master_produk.customer,master_produk.alamat,master_produk.ppn as ppninv,master_produk.pph as pphinv')
            ->where('no_inv', $keyword)
            ->where('deliv_order.deleted_at', null)
            ->get()->getRowArray();
    }
    public function max()
    {
        return $this->db->table('deliv_invoice')
            ->selectMax('no_inv')->get()->getRowArray();
    }
}
