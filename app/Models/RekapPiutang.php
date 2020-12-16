<?php

namespace App\Models;

use CodeIgniter\Model;

class RekapPiutang extends Model
{
    public function rekaphutang($tgl_awal, $tgl_akhir)
    {
        $sql = "SELECT
        master_produk.customer,
        sum(if((master_produk.ppn + master_produk.pph=0),rekap_invoice.nominal-rekap_invoice.nominal1-rekap_invoice.nominal2,
        if((master_produk.ppn + master_produk.pph=1),rekap_invoice.nominal+rekap_invoice.nominal*0.1-rekap_invoice.nominal1-rekap_invoice.nominal2,
        if((master_produk.ppn + master_produk.pph=2),rekap_invoice.nominal+rekap_invoice.nominal*0.1-
        rekap_invoice.nominal*0.02-rekap_invoice.nominal1-rekap_invoice.nominal2,NULL)))) AS piutang

        FROM rekap_invoice
        LEFT join master_produk ON rekap_invoice.produk_idm=master_produk.idm_produk

        WHERE rekap_invoice.deleted_at is null && tgl_rekap BETWEEN ? AND ?
        GROUP BY master_produk.customer
        order by master_produk.customer asc";

        $query = $this->db->query($sql, array($tgl_awal, $tgl_akhir));
        return $query;
    }
}
