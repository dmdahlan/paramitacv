<?php

namespace App\Models;

use CodeIgniter\Model;

class ReportUnit extends Model
{
    public function reportUnit($tgl_awal, $tgl_akhir)
    {
        $sql = "SELECT
        master_unit.jenis as jenis,
        SUM(if((MONTH(deliv_order.tgl) =1),deliv_order.coun,null)) AS jan,
        SUM(if((MONTH(deliv_order.tgl) =2),deliv_order.coun,null)) AS feb,
        SUM(if((MONTH(deliv_order.tgl) =3),deliv_order.coun,null)) AS mar,
        SUM(if((MONTH(deliv_order.tgl) =4),deliv_order.coun,null)) AS apr,
        SUM(if((MONTH(deliv_order.tgl) =5),deliv_order.coun,null)) AS mei,
        SUM(if((MONTH(deliv_order.tgl) =6),deliv_order.coun,null)) AS jun,
        SUM(if((MONTH(deliv_order.tgl) =7),deliv_order.coun,null)) AS jul,
        SUM(if((MONTH(deliv_order.tgl) =8),deliv_order.coun,null)) AS agt,
        SUM(if((MONTH(deliv_order.tgl) =9),deliv_order.coun,null)) AS sep,
        SUM(if((MONTH(deliv_order.tgl) =10),deliv_order.coun,null)) AS okt,
        SUM(if((MONTH(deliv_order.tgl) =11),deliv_order.coun,null)) AS nop,
        SUM(if((MONTH(deliv_order.tgl) =12),deliv_order.coun,null)) AS dess
        FROM master_unit
        left JOIN deliv_order ON master_unit.idm_nopol=deliv_order.nopol_idm
        WHERE deliv_order.deleted_at IS NULL && tgl BETWEEN ? AND ?
        GROUP BY master_unit.jenis
        ORDER BY master_unit.jenis ASC";
        $query = $this->db->query($sql, array($tgl_awal, $tgl_akhir));
        return $query;
    }
}
