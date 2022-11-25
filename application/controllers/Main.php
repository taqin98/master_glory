<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		require 'vendor/setasign/fpdf/fpdf.php';
		
		$this->load->model('Model_pengajuan');
		check_login();
	}

	public function index()
	{

		$data['title_page'] = 'Dashboard';
		$data['page_number'] = 1;
		$data['css_plugins'] = 'DataTables/datatables.min.css';
		$data['js_plugins'] = 'DataTables/datatables.min.js';
		$data['js'] = 'dashboard/js';
		admin_view($data, 'dashboard/index');
	}

	public function form_pengajuan()
	{
		$data['title_page'] = 'Form Pengajuan';
		$data['page_number'] = 2;
		$data['js'] = 'pengajuan/js';
		admin_view($data, 'pengajuan/form_pengajuan');
	}

	public function process_pengajuan()
	{
		$status = 0;
		$data = array(
		'nomor' 		=> $this->input->post('nomor'),
		'nama' 			=> $this->input->post('nama'),
		'nik' 			=> $this->input->post('nik'),
		'bagian' 		=> $this->input->post('bagian'),
		'tgl_pengajuan' 	=> date('Y-m-d', strtotime( $this->input->post('tgl') )) . ' ' . date('H:i:s'),
		'flag_keperluan' 	=> $this->input->post('flag_kep'),
		'flag_keterangan' 	=> $this->input->post('flag_ket'),
		'flag_ttd' 			=> $this->input->post('flag_ttd'),
		'lain_lain' 		=> $this->input->post('lain_lain'),
		'ttd_dept_personalia'=> $this->input->post('ttd_personalia'),
		'ttd_manager' 	=> $this->input->post('ttd_manager')
		);

		$this->db->trans_begin();
		$this->db->insert('tb_pengajuan', $data);
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
		}
		else
		{
			$this->db->trans_commit();
			$status = 1;
		}


		echo json_encode($status);
	}

	public function get_data_table()
	{
		if ($this->input->is_ajax_request()) {
			$draw   = $this->input->post('draw');
			$start  = $this->input->post('start');
			$length = $this->input->post('length');
			$search = $this->input->post('search');
			$order  = $this->input->post('order');

			$json = $this->Model_pengajuan->json_pengajuan($start, $length, $search['value'], $order[0]['column'], $order[0]['dir']);

            $filtered   = $json[1];
            $total      = $json[1];
            $json_data  = $json[0];
            $data       = [];

            if (!empty($json_data)) {
                $no = $start + 1;
                foreach ($json_data as $row => $val) {
                    $btn_print = '<a href="'.base_url('main/print/'.$val->id).'" target="_blank" class="btn btn-sm btn-primary me-2"><i data-feather="printer"></i> </a>';
                    $btn_trash = '<a href="#" class="btn btn-sm btn-danger" onclick="hapus('.$val->id.')"><i data-feather="trash-2"></i> </a>';
                    $btn_merge = $btn_print . $btn_trash;
                    $data[$row] = array(
                        $no++,
                        $val->nomor,
                        $val->nama,
                        $val->nik,
                        $val->bagian,
                        tanggal_indo($val->tgl_pengajuan),
                        $val->keperluan,
                        $val->keterangan,
                        $val->status_ttd,
                        $btn_merge
                    );
                }
            }

            $result = array(
                'draw' => $draw,
                'recordsFiltered' => $filtered,
                'recordsTotal' => $total,
                'data' => $data,
            );

			echo json_encode($result);
		}
	}

	function looping_char($num=0, $char='')
	{
		$characters = '';
		for ($i=0; $i < $num; $i++) { 
			$characters .= $char;
		}
		return $characters;

	}

	public function print()
	{
		$Pdf = new FPDF('p','mm','A5');
		$Pdf->AddPage();
		$Pdf->SetFont('Arial','',10);
        $Pdf->SetTextColor(0,0,0);

        $Pdf->SetTextColor(0,0,0);
        $Pdf->SetFont('Arial','',16);
        // mencetak string
        $SetX = $SetY = $ColWidth = $ColHeight = 10;
        $Pdf->SetX($SetX);
        $Pdf->SetFont('Arial','B',18);
        $Pdf->Cell(0,10,'MEMO INTERN',0,1,'C');
        $Pdf->SetFont('Arial','B',14);
        $Pdf->Cell(0,7,'MEMO INTERN',0,1,'C');
        $Pdf->SetRightMargin(10);
        $Pdf->SetXY($SetX,$SetY + 10);
        $Pdf->SetLineWidth(1);
        $Pdf->Cell(0,10,' ','B',1,'R');

        $Pdf->SetXY($SetX,$SetY + 25);
        $Pdf->SetFont('Arial','',11);
        $Pdf->Cell(0,10,'Diberikan kepada',0,1,'L');
        
        $Pdf->SetX($SetX + 20);
        $Pdf->Cell($ColWidth + 10,$ColHeight,'Nama',0,0,'L');
        $Pdf->Cell(0,$ColHeight,' : '.$this->looping_char(50,'.'),0,1,'L');

        $Pdf->SetX($SetX + 20);
        $Pdf->Cell($ColWidth + 10,$ColHeight,'NIK',0,0,'L');
        $Pdf->Cell(0,$ColHeight,' : '.$this->looping_char(50,'.'),0,1,'L');


        $Pdf->SetX($SetX + 20);
        $Pdf->Cell($ColWidth + 10,$ColHeight,'Bagian',0,0,'L');
        $Pdf->Cell(0,$ColHeight,' : '.$this->looping_char(50,'.'),0,1,'L');

        $Pdf->SetX($SetX + 20);
        $Pdf->Cell($ColWidth + 10,$ColHeight,'Keperluan',0,0,'L');
        $Pdf->SetX($SetX + $ColWidth + 30);
        $Pdf->Cell($ColWidth, $ColHeight, ' :   '.chr(127), 0, 0, 'L');
        $Pdf->Cell($ColWidth*4, $ColHeight,'Sakit',0,0,'L');
        $Pdf->SetX( $Pdf->GetX() );
        $Pdf->Cell(0,$ColHeight,'('.$this->looping_char(30,'.').')',0,1,'L');

        $Pdf->SetX($SetX + $ColWidth + 35.5);
        $Pdf->Cell($ColWidth/2, $ColHeight, chr(127), 0, 0, 'L');
        $Pdf->Cell($ColWidth*4,$ColHeight,'Urusan keluarga',0,0,'L');
        $Pdf->SetX( $Pdf->GetX() );
        $Pdf->Cell(0,$ColHeight,'('.$this->looping_char(30,'.').')',0,1,'L');

        $Pdf->SetX($SetX + $ColWidth + 35.5);
        $Pdf->Cell($ColWidth/2, $ColHeight, chr(127), 0, 0, 'L');
        $Pdf->Cell($ColWidth*4,$ColHeight,'Lain-lain',0,0,'L');
        $Pdf->SetX( $Pdf->GetX() );
        $Pdf->Cell(0,$ColHeight,'('.$this->looping_char(30,'.').')',0,1,'L');

        $Pdf->SetX( $Pdf->GetX() + 45 );
        $Pdf->Cell(0,$ColHeight, $this->looping_char(75,'.') ,0,1,'L');
        $Pdf->SetX( $Pdf->GetX() + 45 );
        $Pdf->Cell(0,$ColHeight, $this->looping_char(75,'.') ,0,1,'L');
        $Pdf->Cell($ColWidth*2,$ColHeight, 'Semarang, ' ,0,0,'L');
        $Pdf->Cell(0,$ColHeight, $this->looping_char(22,'.') ,0,1,'L');
        $Pdf->Cell($ColWidth*2,$ColHeight, 'Tanda tangan Ybs, ' ,0,1,'L');
        $Pdf->Cell($ColWidth*3.5,$ColHeight*2, '('.$this->looping_char(25,' ').')' ,0,1,'C');
        $Pdf->Cell($ColWidth*3.5,$ColHeight, 'Dept. Personalia' ,0,1,'C');


        $Pdf->SetXY( $Pdf->GetX() + 50, $Pdf->GetY() - 30 );
        $Pdf->Cell($ColWidth*3.5,$ColHeight*2, '('.$this->looping_char(25,' ').')' ,0,1,'C');
        $Pdf->SetX( $Pdf->GetX() + 50);
        $Pdf->Cell($ColWidth*3.5,$ColHeight, 'Dept. Personalia' ,0,1,'C');

        $Pdf->SetXY( $Pdf->GetX() + 95, $Pdf->GetY() - 30 );
        $Pdf->Cell($ColWidth*3.5,$ColHeight*2, '('.$this->looping_char(25,' ').')' ,0,1,'C');
        $Pdf->SetX( $Pdf->GetX() + 95);
        $Pdf->Cell($ColWidth*3.5,$ColHeight, 'Dept. Personalia' ,0,1,'C');

		$Pdf->Output();

	}

	public function delete_pengajuan()
	{
		$id =	$this->db->escape($this->input->post('id'));
		$del = $this->Model_pengajuan->delete( $id );
		echo json_encode($del);
	}
}
