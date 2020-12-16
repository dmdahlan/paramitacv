<?php

namespace App\Models;

use CodeIgniter\Model;

class ReportGajidriver extends Model
{
    public function reportgajidriver($tgl_awal, $tgl_akhir)
    {
        $sql = "SELECT
        master_driver.nama,
        SUM(if((MONTH(deliv_gaji.tgl_gaji) =1),deliv_order.coun,null)) AS janqty,
        SUM(if((MONTH(deliv_gaji.tgl_gaji) =1),master_gaji.gaji,null)) AS jangaji,
        SUM(if((MONTH(deliv_gaji.tgl_gaji) =2),deliv_order.coun,null)) AS febqty,
        SUM(if((MONTH(deliv_gaji.tgl_gaji) =2),master_gaji.gaji,null)) AS febgaji,
        SUM(if((MONTH(deliv_gaji.tgl_gaji) =3),deliv_order.coun,null)) AS marqty,
        SUM(if((MONTH(deliv_gaji.tgl_gaji) =3),master_gaji.gaji,null)) AS margaji,
        SUM(if((MONTH(deliv_gaji.tgl_gaji) =4),deliv_order.coun,null)) AS aprqty,
        SUM(if((MONTH(deliv_gaji.tgl_gaji) =4),master_gaji.gaji,null)) AS aprgaji,
        SUM(if((MONTH(deliv_gaji.tgl_gaji) =5),deliv_order.coun,null)) AS meiqty,
        SUM(if((MONTH(deliv_gaji.tgl_gaji) =5),master_gaji.gaji,null)) AS meigaji,
        SUM(if((MONTH(deliv_gaji.tgl_gaji) =6),deliv_order.coun,null)) AS junqty,
        SUM(if((MONTH(deliv_gaji.tgl_gaji) =6),master_gaji.gaji,null)) AS jungaji,
        SUM(if((MONTH(deliv_gaji.tgl_gaji) =7),deliv_order.coun,null)) AS julqty,
        SUM(if((MONTH(deliv_gaji.tgl_gaji) =7),master_gaji.gaji,null)) AS julgaji,
        SUM(if((MONTH(deliv_gaji.tgl_gaji) =8),deliv_order.coun,null)) AS agtqty,
        SUM(if((MONTH(deliv_gaji.tgl_gaji) =8),master_gaji.gaji,null)) AS agtgaji,
        SUM(if((MONTH(deliv_gaji.tgl_gaji) =9),deliv_order.coun,null)) AS sepqty,
        SUM(if((MONTH(deliv_gaji.tgl_gaji) =9),master_gaji.gaji,null)) AS sepgaji,
        SUM(if((MONTH(deliv_gaji.tgl_gaji) =10),deliv_order.coun,null)) AS oktqty,
        SUM(if((MONTH(deliv_gaji.tgl_gaji) =10),master_gaji.gaji,null)) AS oktgaji,
        SUM(if((MONTH(deliv_gaji.tgl_gaji) =11),deliv_order.coun,null)) AS nopqty,
        SUM(if((MONTH(deliv_gaji.tgl_gaji) =11),master_gaji.gaji,null)) AS nopgaji,
        SUM(if((MONTH(deliv_gaji.tgl_gaji) =12),deliv_order.coun,null)) AS desqty,
        SUM(if((MONTH(deliv_gaji.tgl_gaji) =12),master_gaji.gaji,null)) AS desgaji
        FROM deliv_order
        LEFT JOIN master_driver ON deliv_order.driver_idm=master_driver.idm_driver
        LEFT JOIN deliv_gaji ON deliv_order.idm_deliv=deliv_gaji.deliv_idm
        LEFT JOIN master_gaji ON deliv_order.ketjuan=master_gaji.ketjuan
        WHERE deliv_order.deleted_at is null && deliv_gaji.tgl_gaji BETWEEN ? AND ?
        GROUP BY master_driver.nama 
        ORDER BY master_driver.nama asc";
        $query = $this->db->query($sql, array($tgl_awal, $tgl_akhir));
        return $query;
    }
}
