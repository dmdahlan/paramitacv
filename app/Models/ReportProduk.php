<?php

namespace App\Models;

use CodeIgniter\Model;

class ReportProduk extends Model
{
    public function reportproduk($tgl_awal, $tgl_akhir)
    {
        $sql = "SELECT
        master_produk.produk,
        SUM(if((MONTH(deliv_order.tgl) =1),deliv_invoice.nominal,null)) AS jan,
        SUM(if((MONTH(deliv_order.tgl) =2),deliv_invoice.nominal,null)) AS feb,
        SUM(if((MONTH(deliv_order.tgl) =3),deliv_invoice.nominal,null)) AS mar,
        SUM(if((MONTH(deliv_order.tgl) =4),deliv_invoice.nominal,null)) AS apr,
        SUM(if((MONTH(deliv_order.tgl) =5),deliv_invoice.nominal,null)) AS mei,
        SUM(if((MONTH(deliv_order.tgl) =6),deliv_invoice.nominal,null)) AS jun,
        SUM(if((MONTH(deliv_order.tgl) =7),deliv_invoice.nominal,null)) AS jul,
        SUM(if((MONTH(deliv_order.tgl) =8),deliv_invoice.nominal,null)) AS agt,
        SUM(if((MONTH(deliv_order.tgl) =9),deliv_invoice.nominal,null)) AS sep,
        SUM(if((MONTH(deliv_order.tgl) =10),deliv_invoice.nominal,null)) AS okt,
        SUM(if((MONTH(deliv_order.tgl) =11),deliv_invoice.nominal,null)) AS nop,
        SUM(if((MONTH(deliv_order.tgl) =12),deliv_invoice.nominal,null)) AS dess
        FROM deliv_order
        LEFT JOIN master_produk ON deliv_order.produk_idm=master_produk.idm_produk
        LEFT JOIN deliv_invoice ON deliv_order.idm_deliv=deliv_invoice.deliv_idm 
        WHERE deliv_order.deleted_at is null && deliv_order.tgl BETWEEN ? AND ?
        GROUP BY master_produk.produk
        ORDER BY master_produk.produk ASC";
        $query = $this->db->query($sql, array($tgl_awal, $tgl_akhir));
        return $query;
    }
}
