<?php

namespace App\Models;

use CodeIgniter\Model;

class RekapPiutang extends Model
{
    public function rekaphutang($tgl_awal, $tgl_akhir)
    {
        $sql = "SELECT
        master_produk.customer,
        SUM(if(master_produk.ppn=0,if(MONTH(rekap_invoice.tgl_rekap)=1,rekap_invoice.nominal- rekap_invoice.nominal_claim,0),if(master_produk.ppn=1&&master_produk.pph=0,if(MONTH(rekap_invoice.tgl_rekap)=1,rekap_invoice.nominal+rekap_invoice.nominal *0.1 - rekap_invoice.nominal_claim,0),if(master_produk.ppn=1&&master_produk.pph=1,if(MONTH(rekap_invoice.tgl_rekap)=1,rekap_invoice.nominal+rekap_invoice.nominal *0.1 - rekap_invoice.nominal *0.02 - rekap_invoice.nominal_claim,0),0)))) AS jan,
        SUM(if(MONTH(rekap_invoice.tgl_bayar1)=1,rekap_invoice.nominal1,0)) AS byr_jan,
        SUM(if(master_produk.ppn=0,if(MONTH(rekap_invoice.tgl_rekap)=2,rekap_invoice.nominal- rekap_invoice.nominal_claim,0),if(master_produk.ppn=1&&master_produk.pph=0,if(MONTH(rekap_invoice.tgl_rekap)=2,rekap_invoice.nominal+rekap_invoice.nominal *0.1 - rekap_invoice.nominal_claim,0),if(master_produk.ppn=1&&master_produk.pph=1,if(MONTH(rekap_invoice.tgl_rekap)=2,rekap_invoice.nominal+rekap_invoice.nominal *0.1 - rekap_invoice.nominal *0.02 - rekap_invoice.nominal_claim,0),0)))) AS feb,
        SUM(if(MONTH(rekap_invoice.tgl_bayar1)=2,rekap_invoice.nominal1,0)) AS byr_feb,
        SUM(if(master_produk.ppn=0,if(MONTH(rekap_invoice.tgl_rekap)=3,rekap_invoice.nominal- rekap_invoice.nominal_claim,0),if(master_produk.ppn=1&&master_produk.pph=0,if(MONTH(rekap_invoice.tgl_rekap)=3,rekap_invoice.nominal+rekap_invoice.nominal *0.1 - rekap_invoice.nominal_claim,0),if(master_produk.ppn=1&&master_produk.pph=1,if(MONTH(rekap_invoice.tgl_rekap)=3,rekap_invoice.nominal+rekap_invoice.nominal *0.1 - rekap_invoice.nominal *0.02 - rekap_invoice.nominal_claim,0),0)))) AS mar,
        SUM(if(MONTH(rekap_invoice.tgl_bayar1)=3,rekap_invoice.nominal1,0)) AS byr_mar,
        SUM(if(master_produk.ppn=0,if(MONTH(rekap_invoice.tgl_rekap)=4,rekap_invoice.nominal- rekap_invoice.nominal_claim,0),if(master_produk.ppn=1&&master_produk.pph=0,if(MONTH(rekap_invoice.tgl_rekap)=4,rekap_invoice.nominal+rekap_invoice.nominal *0.1 - rekap_invoice.nominal_claim,0),if(master_produk.ppn=1&&master_produk.pph=1,if(MONTH(rekap_invoice.tgl_rekap)=4,rekap_invoice.nominal+rekap_invoice.nominal *0.1 - rekap_invoice.nominal *0.02 - rekap_invoice.nominal_claim,0),0)))) AS apr,
        SUM(if(MONTH(rekap_invoice.tgl_bayar1)=4,rekap_invoice.nominal1,0)) AS byr_apr,
        SUM(if(master_produk.ppn=0,if(MONTH(rekap_invoice.tgl_rekap)=5,rekap_invoice.nominal- rekap_invoice.nominal_claim,0),if(master_produk.ppn=1&&master_produk.pph=0,if(MONTH(rekap_invoice.tgl_rekap)=5,rekap_invoice.nominal+rekap_invoice.nominal *0.1 - rekap_invoice.nominal_claim,0),if(master_produk.ppn=1&&master_produk.pph=1,if(MONTH(rekap_invoice.tgl_rekap)=5,rekap_invoice.nominal+rekap_invoice.nominal *0.1 - rekap_invoice.nominal *0.02 - rekap_invoice.nominal_claim,0),0)))) AS mei,
        SUM(if(MONTH(rekap_invoice.tgl_bayar1)=5,rekap_invoice.nominal1,0)) AS byr_mei,
        SUM(if(master_produk.ppn=0,if(MONTH(rekap_invoice.tgl_rekap)=6,rekap_invoice.nominal- rekap_invoice.nominal_claim,0),if(master_produk.ppn=1&&master_produk.pph=0,if(MONTH(rekap_invoice.tgl_rekap)=6,rekap_invoice.nominal+rekap_invoice.nominal *0.1 - rekap_invoice.nominal_claim,0),if(master_produk.ppn=1&&master_produk.pph=1,if(MONTH(rekap_invoice.tgl_rekap)=6,rekap_invoice.nominal+rekap_invoice.nominal *0.1 - rekap_invoice.nominal *0.02 - rekap_invoice.nominal_claim,0),0)))) AS jun,
        SUM(if(MONTH(rekap_invoice.tgl_bayar1)=6,rekap_invoice.nominal1,0)) AS byr_jun,
        SUM(if(master_produk.ppn=0,if(MONTH(rekap_invoice.tgl_rekap)=7,rekap_invoice.nominal- rekap_invoice.nominal_claim,0),if(master_produk.ppn=1&&master_produk.pph=0,if(MONTH(rekap_invoice.tgl_rekap)=7,rekap_invoice.nominal+rekap_invoice.nominal *0.1 - rekap_invoice.nominal_claim,0),if(master_produk.ppn=1&&master_produk.pph=1,if(MONTH(rekap_invoice.tgl_rekap)=7,rekap_invoice.nominal+rekap_invoice.nominal *0.1 - rekap_invoice.nominal *0.02 - rekap_invoice.nominal_claim,0),0)))) AS jul,
        SUM(if(MONTH(rekap_invoice.tgl_bayar1)=7,rekap_invoice.nominal1,0)) AS byr_jul,
        SUM(if(master_produk.ppn=0,if(MONTH(rekap_invoice.tgl_rekap)=8,rekap_invoice.nominal- rekap_invoice.nominal_claim,0),if(master_produk.ppn=1&&master_produk.pph=0,if(MONTH(rekap_invoice.tgl_rekap)=8,rekap_invoice.nominal+rekap_invoice.nominal *0.1 - rekap_invoice.nominal_claim,0),if(master_produk.ppn=1&&master_produk.pph=1,if(MONTH(rekap_invoice.tgl_rekap)=8,rekap_invoice.nominal+rekap_invoice.nominal *0.1 - rekap_invoice.nominal *0.02 - rekap_invoice.nominal_claim,0),0)))) AS agt,
        SUM(if(MONTH(rekap_invoice.tgl_bayar1)=8,rekap_invoice.nominal1,0)) AS byr_agt,
        SUM(if(master_produk.ppn=0,if(MONTH(rekap_invoice.tgl_rekap)=9,rekap_invoice.nominal- rekap_invoice.nominal_claim,0),if(master_produk.ppn=1&&master_produk.pph=0,if(MONTH(rekap_invoice.tgl_rekap)=9,rekap_invoice.nominal+rekap_invoice.nominal *0.1 - rekap_invoice.nominal_claim,0),if(master_produk.ppn=1&&master_produk.pph=1,if(MONTH(rekap_invoice.tgl_rekap)=9,rekap_invoice.nominal+rekap_invoice.nominal *0.1 - rekap_invoice.nominal *0.02 - rekap_invoice.nominal_claim,0),0)))) AS sep,
        SUM(if(MONTH(rekap_invoice.tgl_bayar1)=9,rekap_invoice.nominal1,0)) AS byr_sep,
        SUM(if(master_produk.ppn=0,if(MONTH(rekap_invoice.tgl_rekap)=10,rekap_invoice.nominal- rekap_invoice.nominal_claim,0),if(master_produk.ppn=1&&master_produk.pph=0,if(MONTH(rekap_invoice.tgl_rekap)=10,rekap_invoice.nominal+rekap_invoice.nominal *0.1 - rekap_invoice.nominal_claim,0),if(master_produk.ppn=1&&master_produk.pph=1,if(MONTH(rekap_invoice.tgl_rekap)=10,rekap_invoice.nominal+rekap_invoice.nominal *0.1 - rekap_invoice.nominal *0.02 - rekap_invoice.nominal_claim,0),0)))) AS okt,
        SUM(if(MONTH(rekap_invoice.tgl_bayar1)=10,rekap_invoice.nominal1,0)) AS byr_okt,
        SUM(if(master_produk.ppn=0,if(MONTH(rekap_invoice.tgl_rekap)=11,rekap_invoice.nominal- rekap_invoice.nominal_claim,0),if(master_produk.ppn=1&&master_produk.pph=0,if(MONTH(rekap_invoice.tgl_rekap)=11,rekap_invoice.nominal+rekap_invoice.nominal *0.1 - rekap_invoice.nominal_claim,0),if(master_produk.ppn=1&&master_produk.pph=1,if(MONTH(rekap_invoice.tgl_rekap)=11,rekap_invoice.nominal+rekap_invoice.nominal *0.1 - rekap_invoice.nominal *0.02 - rekap_invoice.nominal_claim,0),0)))) AS nop,
        SUM(if(MONTH(rekap_invoice.tgl_bayar1)=11,rekap_invoice.nominal1,0)) AS byr_nop,
        SUM(if(master_produk.ppn=0,if(MONTH(rekap_invoice.tgl_rekap)=12,rekap_invoice.nominal- rekap_invoice.nominal_claim,0),if(master_produk.ppn=1&&master_produk.pph=0,if(MONTH(rekap_invoice.tgl_rekap)=12,rekap_invoice.nominal+rekap_invoice.nominal *0.1 - rekap_invoice.nominal_claim,0),if(master_produk.ppn=1&&master_produk.pph=1,if(MONTH(rekap_invoice.tgl_rekap)=12,rekap_invoice.nominal+rekap_invoice.nominal *0.1 - rekap_invoice.nominal *0.02 - rekap_invoice.nominal_claim,0),0)))) AS dess,
        SUM(if(MONTH(rekap_invoice.tgl_bayar1)=12,rekap_invoice.nominal1,0)) AS byr_des
        FROM rekap_invoice
        LEFT join master_produk ON rekap_invoice.produk_idm=master_produk.idm_produk

        WHERE rekap_invoice.deleted_at is null && tgl_rekap BETWEEN ? AND ?
        GROUP BY master_produk.customer
        order by master_produk.customer asc";

        $query = $this->db->query($sql, array($tgl_awal, $tgl_akhir));
        return $query;
    }
    public function rekapbayar($tgl_awal, $tgl_akhir)
    {
        $sql = "SELECT
        master_produk.customer,
        SUM(if(MONTH(rekap_invoice.tgl_bayar1)=1,rekap_invoice.nominal1,0)) AS jan,
        SUM(if(MONTH(rekap_invoice.tgl_bayar1)=2,rekap_invoice.nominal1,0)) AS feb,
        SUM(if(MONTH(rekap_invoice.tgl_bayar1)=3,rekap_invoice.nominal1,0)) AS mar,
        SUM(if(MONTH(rekap_invoice.tgl_bayar1)=4,rekap_invoice.nominal1,0)) AS apr,
        SUM(if(MONTH(rekap_invoice.tgl_bayar1)=5,rekap_invoice.nominal1,0)) AS mei,
        SUM(if(MONTH(rekap_invoice.tgl_bayar1)=6,rekap_invoice.nominal1,0)) AS jun,
        SUM(if(MONTH(rekap_invoice.tgl_bayar1)=7,rekap_invoice.nominal1,0)) AS jul,
        SUM(if(MONTH(rekap_invoice.tgl_bayar1)=8,rekap_invoice.nominal1,0)) AS agt,
        SUM(if(MONTH(rekap_invoice.tgl_bayar1)=9,rekap_invoice.nominal1,0)) AS sep,
        SUM(if(MONTH(rekap_invoice.tgl_bayar1)=10,rekap_invoice.nominal1,0)) AS okt,
        SUM(if(MONTH(rekap_invoice.tgl_bayar1)=11,rekap_invoice.nominal1,0)) AS nop,
        SUM(if(MONTH(rekap_invoice.tgl_bayar1)=12,rekap_invoice.nominal1,0)) AS dess
        FROM rekap_invoice
        LEFT join master_produk ON rekap_invoice.produk_idm=master_produk.idm_produk

        WHERE rekap_invoice.deleted_at is null && tgl_rekap BETWEEN ? AND ?
        GROUP BY master_produk.customer
        order by master_produk.customer asc";

        $query = $this->db->query($sql, array($tgl_awal, $tgl_akhir));
        return $query;
    }
}
