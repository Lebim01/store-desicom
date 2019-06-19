<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('Mdashboard');
    }

	public function index()
	{
        $data['title'] = "ADMIN | Repository TE Unjani";
        $data['page'] = 'DASHBOARD | REPOSITORY TE UNJANI';
        $data['content'] = "admin/dashboard";
        $data['files'] = $this->Mdashboard->getFile();

		$this->load->view('admin/template', $data);	
    }	
    
    function uploadpage() {
        $data['title'] = "Upload File | Repository TE Unjani";
        $data['page'] = 'UPLOAD FILE | REPOSITORY TE UNJANI';
        $data['content'] = "admin/uploadpage";
		$this->load->view('admin/template', $data);	
    }

    function changePasswordPage() {
        $data['title'] = "Ubah Password | Repository TE Unjani";
        $data['page'] = 'UBAH PASSWORD | REPOSITORY TE UNJANI';
        $data['content'] = "admin/changePassword.php";
		$this->load->view('admin/template', $data);
    }


    function loginPage() {
        $data['title'] = "Login Admin | Repository TE Unjani";                
		$this->load->view('admin/login', $data);
    }

    function login() {
        $password = $this->input->post('password');
        $this->db->where('password', $password);
        $check = $this->db->get('users');
        if($check->num_rows() > 0) {
            $this->session->set_userdata('loged_in', true);
            redirect(base_url().'admin/');
        } else {            
            redirect(base_url().'admin/loginPage?password=wrong');
        }
    }

    function logout() {
        unset($_SESSION['loged_in']);
        redirect(base_url().'admin/loginPage');
    }

    function changePassword() {
        $oldPassword = $this->input->post('old-password');
        $newPassword = $this->input->post('new-password');

        $this->db->where('password', $oldPassword);
        $res = $this->db->get('users');
        
        if($res->num_rows() > 0) {
            $this->db->update('users', ['password' => $newPassword]);
            $this->session->set_flashdata('changePassword', 'Password Berhasil Dirubah');
            redirect(base_url().'admin/changePasswordPage');
        } else {
            $this->session->set_flashdata('changePassword', 'Password Lama Salah');
            redirect(base_url().'admin/changePasswordPage');
        }
    }

    function uploadimage() {
        $config['upload_path']          = 'assets/images/upload/';
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 1000000;
        $config['encrypt_name'] = TRUE;                
		$this->load->library('upload', $config);
 
		if ($this->upload->do_upload('image')){
            $filename = $this->upload->data('file_name');            
            echo json_encode(['status'=>'success', 'filename'=>$filename]);
		} else {
            $error = array('error' => $this->upload->display_errors());
            echo json_encode(['status'=>'failed', 'error'=>$error]);
        }
    }

    function uploadfile() {
        $config['upload_path']          = 'assets/files/';
		$config['allowed_types']        = '*';
        $config['max_size']             = 1000000;
        $config['encrypt_name'] = TRUE;        

		$this->load->library('upload', $config);
 
		if ( ! $this->upload->do_upload('file')){
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('alert', 'error');
            redirect(base_url().'admin/uploadpage', $error);
		}else{
            $filename = $this->upload->data('file_name');
            $dataFile = [
                'nama_file' => $filename,
                'kategori' => $this->input->post('kategori'),
                'judul' => $this->input->post('judul'),
                'pengarang' => $this->input->post('pengarang'),
                'dosen_pembimbing' => $this->input->post('pembimbing'),
                'kata_kunci' => $this->input->post('kata_kunci'),
                'abstrak' => $this->input->post('abstrak'),
                'gambar_file' => $this->input->post('gambar_file'),
                'tgl_upload' => date("Y/m/d")
            ];            
                        
            $this->db->insert('files', $dataFile);

            if($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('alert', 'success');
            }

            redirect(base_url().'admin/uploadpage');
		}
    }

    function deletefile() {
        $file_id = $this->input->get('id_file');

        $this->db->delete('files', ['id_file'=>$file_id]);
        redirect(base_url().'admin');
    }
	
}
