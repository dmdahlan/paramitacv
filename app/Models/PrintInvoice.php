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
            ->join('deliv_invoice', 'deliv_invoice.deliv_idm = deliv_order.idm_deliv', 'left')
            ->where('no_inv', $keyword)
            ->get()->getResultArray();
    }
}
