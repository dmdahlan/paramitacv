<?php

namespace App\Controllers;

class Report_muatan extends BaseController
{
    public function index()
    {
        $data = [
            'title'         => 'Report | Muatan'
        ];
        return view('report/vw_reportmuatan', $data);
    }
    public function repmuatan()
    {
        $tgl_awal  = $this->request->getPost('tgl_awal');
        $tgl_akhir = $this->request->getPost('tgl_akhir');

        $report = $this->reportmuatan->reportMuatann($tgl_awal, $tgl_akhir)->getResult();
        $recordTotal = $this->reportmuatan->reportMuatann($tgl_awal, $tgl_akhir)->getFieldCount();
        $recordFiltered = $this->reportmuatan->reportMuatann($tgl_awal, $tgl_akhir)->getFieldCount();

        $data = array();
        $no = @$_POST['start'];
        $temp_bln_q1 = 0;
        $temp_bln_1 = 0;
        $temp_bln_q2 = 0;
        $temp_bln_2 = 0;
        $temp_bln_q3 = 0;
        $temp_bln_3 = 0;
        $temp_bln_q4 = 0;
        $temp_bln_4 = 0;
        $temp_bln_q5 = 0;
        $temp_bln_5 = 0;
        $temp_bln_q6 = 0;
        $temp_bln_6 = 0;
        $temp_bln_q7 = 0;
        $temp_bln_7 = 0;
        $temp_bln_q8 = 0;
        $temp_bln_8 = 0;
        $temp_bln_q9 = 0;
        $temp_bln_9 = 0;
        $temp_bln_q10 = 0;
        $temp_bln_10 = 0;
        $temp_bln_q11 = 0;
        $temp_bln_11 = 0;
        $temp_bln_q12 = 0;
        $temp_bln_12 = 0;
        $temp_bln_total = 0;

        foreach ($report as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->namaproduk;
            $row[] = $this->rupiah($r->qjan);
            $row[] = $this->rupiah($r->jan);
            $row[] = $this->rupiah($r->qfeb);
            $row[] = $this->rupiah($r->qfeb);
            $row[] = $this->rupiah($r->qmar);
            $row[] = $this->rupiah($r->mar);
            $row[] = $this->rupiah($r->qapr);
            $row[] = $this->rupiah($r->apr);
            $row[] = $this->rupiah($r->qmei);
            $row[] = $this->rupiah($r->mei);
            $row[] = $this->rupiah($r->qjun);
            $row[] = $this->rupiah($r->jun);
            $row[] = $this->rupiah($r->qjul);
            $row[] = $this->rupiah($r->jul);
            $row[] = $this->rupiah($r->qagt);
            $row[] = $this->rupiah($r->agt);
            $row[] = $this->rupiah($r->qsep);
            $row[] = $this->rupiah($r->sep);
            $row[] = $this->rupiah($r->qokt);
            $row[] = $this->rupiah($r->okt);
            $row[] = $this->rupiah($r->qnop);
            $row[] = $this->rupiah($r->nop);
            $row[] = $this->rupiah($r->qdess);
            $row[] = $this->rupiah($r->dess);


            $temp_bln_q1      += $r->qjan;
            $temp_bln_1       += $r->jan;
            $temp_bln_q2      += $r->qfeb;
            $temp_bln_2       += $r->feb;
            $temp_bln_q3      += $r->qmar;
            $temp_bln_3       += $r->mar;
            $temp_bln_q4      += $r->qapr;
            $temp_bln_4       += $r->apr;
            $temp_bln_q5      += $r->qmei;
            $temp_bln_5       += $r->mei;
            $temp_bln_q6      += $r->qjun;
            $temp_bln_6       += $r->jun;
            $temp_bln_q7      += $r->qjul;
            $temp_bln_7       += $r->jul;
            $temp_bln_q8      += $r->qagt;
            $temp_bln_8       += $r->agt;
            $temp_bln_q9      += $r->qsep;
            $temp_bln_9       += $r->sep;
            $temp_bln_q10     += $r->qokt;
            $temp_bln_10      += $r->okt;
            $temp_bln_q11     += $r->qnop;
            $temp_bln_11      += $r->nop;
            $temp_bln_q12     += $r->qdess;
            $temp_bln_12      += $r->dess;
            //add html for action
            $data[] = $row;
        }
        $data[] = array(
            '',
            'Total Per Bulan',
            $this->rupiah($temp_bln_q1),
            $this->rupiah($temp_bln_1),
            $this->rupiah($temp_bln_q2),
            $this->rupiah($temp_bln_2),
            $this->rupiah($temp_bln_q3),
            $this->rupiah($temp_bln_3),
            $this->rupiah($temp_bln_q4),
            $this->rupiah($temp_bln_4),
            $this->rupiah($temp_bln_5),
            $this->rupiah($temp_bln_q5),
            $this->rupiah($temp_bln_q6),
            $this->rupiah($temp_bln_6),
            $this->rupiah($temp_bln_q7),
            $this->rupiah($temp_bln_7),
            $this->rupiah($temp_bln_q8),
            $this->rupiah($temp_bln_8),
            $this->rupiah($temp_bln_q9),
            $this->rupiah($temp_bln_9),
            $this->rupiah($temp_bln_q10),
            $this->rupiah($temp_bln_10),
            $this->rupiah($temp_bln_q11),
            $this->rupiah($temp_bln_11),
            $this->rupiah($temp_bln_q12),
            $this->rupiah($temp_bln_12),
        );

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $recordTotal,
            "recordsFiltered" => $recordFiltered,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
}
