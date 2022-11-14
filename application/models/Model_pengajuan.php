<?php
class model_pengajuan extends CI_Model
{
	public function json_pengajuan($start='', $length='', $search=null, $column='', $dir='') {
        $condition = '';
		if ($search !== '') {
			$condition .= " WHERE (z.nomor LIKE '%".$search."%'
                            OR z.nama LIKE '%".$search."%'
                            OR z.nik LIKE '%".$search."%'
                            OR z.bagian LIKE '%".$search."%')
                            ";
		} else {
            $condition .= " WHERE z.status != 9 ";
        }

		$order = '';
		if ($column != '' && $dir != '') {
			switch ($column) {
				case '1':
					$col = 'z.nomor';
					break;
				case '2':
					$col = 'z.nama';
					break;
				case '3':
					$col = 'z.nik';
					break;
				case '4':
					$col = 'z.bagian';
					break;
				default:
					$col = '';
					break;
			}

			if ($col != '') {
				$order .= " ORDER BY $col $dir ";
			}
		} 

		$limit = "LIMIT $start, $length";
		if($length == '-1'){
			$limit = "";
		}

		$filtered = $this->db->query("SELECT z.* FROM (
			SELECT 
			id,
			nomor,
			nama,
			nik,
			bagian,
			tgl_pengajuan,
			CASE
			WHEN flag_keperluan = 1 THEN 'Sakit'
			WHEN flag_keperluan = 2 THEN 'Urusan Keluarga'
			ELSE lain_lain
			END as keperluan,
			CASE
			WHEN flag_keterangan = 1 THEN 'Kembali'
			ELSE 'Tidak Kembali'
			END as keterangan,

			CASE
			WHEN flag_ttd = 1 THEN 'Ttd Upload'
			ELSE 'Manual'
			END as status_ttd,

			ttd_dept_personalia,
			ttd_manager,
			status
			FROM `tb_pengajuan` ) z
			$condition
			$order $limit
		")->result();


		$total = $this->db->query("SELECT z.* FROM (
			SELECT 
			id,
			nomor,
			nama,
			nik,
			bagian,
			tgl_pengajuan,
			CASE
			WHEN flag_keperluan = 1 THEN 'Sakit'
			WHEN flag_keperluan = 2 THEN 'Urusan Keluarga'
			ELSE lain_lain
			END as keperluan,
			CASE
			WHEN flag_keterangan = 1 THEN 'Kembali'
			ELSE 'Tidak Kembali'
			END as keterangan,

			CASE
			WHEN flag_ttd = 1 THEN 'Ttd Upload'
			ELSE 'Manual'
			END as status_ttd,

			ttd_dept_personalia,
			ttd_manager,
			status
			FROM `tb_pengajuan` ) z
		$condition ")->num_rows();

        return [$filtered, $total];
    }

    public function delete($id='')
    {
    	$status = 0;

    	$this->db->trans_begin();

		$this->db->where('id', $id);
		$this->db->update('tb_pengajuan', ['status' => 9]);
		$this->db->query("UPDATE tb_pengajuan SET `status` = 9 WHERE `id` = $id ");


		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
		}
		else
		{
			$this->db->trans_commit();
			$status = 1;
		}

		return $status;	
    }
}