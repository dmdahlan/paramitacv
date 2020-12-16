<?php

namespace App\Models;

use CodeIgniter\Model;

class ReportNopol extends Model
{
    public function reportnopoll($tgl_awal, $tgl_akhir)
    {
        $sql = "SELECT
        master_unit.nopol,
        SUM(if((MONTH(deliv_order.tgl) =1),deliv_order.coun,null)) AS qjan,
        SUM(if((MONTH(deliv_order.tgl) =1),deliv_invoice.nominal,null)) AS jan,
        SUM(if((MONTH(deliv_order.tgl) =2),deliv_order.coun,null)) AS qfeb,
        SUM(if((MONTH(deliv_order.tgl) =2),deliv_invoice.nominal,null)) AS feb,
        SUM(if((MONTH(deliv_order.tgl) =3),deliv_order.coun,null)) AS qmar,
        SUM(if((MONTH(deliv_order.tgl) =3),deliv_invoice.nominal,null)) AS mar,
        SUM(if((MONTH(deliv_order.tgl) =4),deliv_order.coun,null)) AS qapr,
        SUM(if((MONTH(deliv_order.tgl) =4),deliv_invoice.nominal,null)) AS apr,
        SUM(if((MONTH(deliv_order.tgl) =5),deliv_order.coun,null)) AS qmei,
        SUM(if((MONTH(deliv_order.tgl) =5),deliv_invoice.nominal,null)) AS mei,
        SUM(if((MONTH(deliv_order.tgl) =6),deliv_order.coun,null)) AS qjun,
        SUM(if((MONTH(deliv_order.tgl) =6),deliv_invoice.nominal,null)) AS jun,
        SUM(if((MONTH(deliv_order.tgl) =7),deliv_order.coun,null)) AS qjul,
        SUM(if((MONTH(deliv_order.tgl) =7),deliv_invoice.nominal,null)) AS jul,
        SUM(if((MONTH(deliv_order.tgl) =8),deliv_order.coun,null)) AS qagt,
        SUM(if((MONTH(deliv_order.tgl) =8),deliv_invoice.nominal,null)) AS agt,
        SUM(if((MONTH(deliv_order.tgl) =9),deliv_order.coun,null)) AS qsep,
        SUM(if((MONTH(deliv_order.tgl) =9),deliv_invoice.nominal,null)) AS sep,
        SUM(if((MONTH(deliv_order.tgl) =10),deliv_order.coun,null)) AS qokt,
        SUM(if((MONTH(deliv_order.tgl) =10),deliv_invoice.nominal,null)) AS okt,
        SUM(if((MONTH(deliv_order.tgl) =11),deliv_order.coun,null)) AS qnop,
        SUM(if((MONTH(deliv_order.tgl) =11),deliv_invoice.nominal,null)) AS nop,
        SUM(if((MONTH(deliv_order.tgl) =12),deliv_order.coun,null)) AS qdess,
        SUM(if((MONTH(deliv_order.tgl) =12),deliv_invoice.nominal,null)) AS dess
        FROM deliv_order
        LEFT JOIN master_unit ON deliv_order.nopol_idm=master_unit.idm_nopol
        LEFT JOIN deliv_invoice ON deliv_order.idm_deliv=deliv_invoice.deliv_idm 
        WHERE deliv_order.deleted_at is null && tgl BETWEEN ? AND ?
        GROUP BY master_unit.nopol
        ORDER BY master_unit.jenis ASC";

        $query = $this->db->query($sql, array($tgl_awal, $tgl_akhir));
        return $query;
    }
}
