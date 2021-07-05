<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    // function __construct() {
    //     parent::__construct();
    //     $this->load->helper(array('form', 'url'));
    //     $this->load->model('Mdashboard');
    // }

    public function index()
    {
        if (!$this->session->has_userdata('loged_in')) {
            redirect(base_url() . 'admin/loginPage');
        }

        $data['title'] = "ADMIN | Catalog App";
        $data['page'] = 'LISTADO PRODUCTOS';
        $data['content'] = "admin/dashboard";
        $this->db->order_by("tgl_upload", "desc");
        $data['products'] = $this->db->query("select * from produk order by id_produk desc")->result();
        $data['photos'] = $this->db->query("select * from foto_produk");

        $this->load->view('admin/template', $data);
    }

    function uploadpage()
    {
        $data['title'] = "Agregar producto";
        $data['page'] = 'AGREGAR PRODUCTO';
        $data['content'] = "admin/uploadpage";
        $data['categories'] = $this->db->query('select * from kategori order by id_kategori desc')->result();
        $this->load->view('admin/template', $data);
    }
    function editPage($id_produk)
    {
        $data['id_produk'] = $id_produk;
        $data['title'] = "Editar Producto";
        $data['page'] = 'EDITAR PRODUCTO';
        $data['content'] = "admin/uploadpage";
        $data['categories'] = $this->db->query('select * from kategori order by id_kategori desc')->result();
        $data['product'] = $this->db->get_where('produk', ['id_produk' => $id_produk])->result()[0];
        $data['photos'] = $this->db->get_where('foto_produk', ['id_produk' => $id_produk])->result();
        $data['edit'] = true;

        $this->load->view('admin/template', $data);
    }
    function editProduct($id_produk)
    {
        $photos = $this->input->post('image');

        $dataProduct = [
            'id_produk' => $id_produk,
            'nama_produk' => $this->input->post('namaproduk'),
            'harga' => $this->input->post('harga'),
            'stok' => $this->input->post('stok'),
            //'kategori' => $this->input->post('kategori'),
            'deskripsi' => $this->input->post('deskripsi'),
            'tgl_upload' => date("Y/m/d H:i:s")
        ];

        $this->db->where('id_produk', $id_produk);
        if ($this->db->update('produk', $dataProduct)) {
            foreach ($photos as $photo) {
                if (!$this->db->query("select * from foto_produk where id_produk='$id_produk' and nama_foto='$photo'")->num_rows()) {
                    $this->db->insert('foto_produk', [
                        'id_foto' => '',
                        'id_produk' => $id_produk,
                        'nama_foto' => $photo
                    ]);
                }
            }
        }

        $this->session->set_flashdata('alert-product', 'success');
        redirect(base_url() . 'admin/editPage/' . $id_produk);
    }
    function deletePhotoDb()
    {
        $id_produk = $this->input->post('idproduk');
        $nama_foto = $this->input->post('namafoto');

        $this->db->query("delete from foto_produk where id_produk = '$id_produk' and nama_foto='$nama_foto'");
    }


    function category()
    {
        $data['title'] = "Atur Kategori Produk";
        $data['page'] = 'ATUR KATEGORI PRODUK';
        $data['content'] = "admin/category";
        $data['categories'] = $this->db->query('select * from kategori order by id_kategori desc')->result();
        $this->load->view('admin/template', $data);
    }
    function addCategory()
    {
        $category = $this->input->post('category');
        if ($this->db->insert('kategori', ['id_kategori' => '', 'nama_kategori' => $category])) {
            $this->session->set_flashdata('alert-category', 'success');
        } else {
            $this->session->set_flashdata('alert-category', 'error');
        }
        redirect(base_url() . 'admin/category');
    }
    function deleteCategory($id)
    {
        if ($this->db->delete('kategori', ['id_kategori' => $id])) {
        } else {
            $this->session->set_flashdata('alert-category', 'error');
        }
        redirect(base_url() . 'admin/category');
    }

    function deleteProduct($id)
    {
        $this->db->delete('produk', ['id_produk' => $id]);
        redirect(base_url() . 'admin');
    }

    function socmed()
    {
        $data['title'] = "Sosial Media";
        $data['page'] = 'SOSIAL MEDIA';
        $data['content'] = "admin/socmed.php";
        $data['socmeds'] = $this->db->get('socmed')->result();
        $this->load->view('admin/template', $data);
    }
    function saveSocmed()
    {
        $ig = $this->input->post('instagram');
        $fb = $this->input->post('facebook');
        $twitter = $this->input->post('twitter');
        $tokped = $this->input->post('tokped');
        $shopee = $this->input->post('shopee');

        $show_ig = ($this->input->post('show_instagram') == 'on') ? 1 : 0;
        $show_fb = ($this->input->post('show_facebook') == 'on') ? 1 : 0;
        $show_twitter = ($this->input->post('show_twitter') == 'on') ? 1 : 0;
        $show_tokped = ($this->input->post('show_tokped') == 'on') ? 1 : 0;
        $show_shopee = ($this->input->post('show_shopee') == 'on') ? 1 : 0;

        $this->db->query("update socmed set link = '$ig', tampilkan = $show_ig where nama_socmed = 'instagram'");
        $this->db->query("update socmed set link = '$fb', tampilkan = $show_fb where nama_socmed = 'facebook'");
        $this->db->query("update socmed set link = '$twitter', tampilkan = $show_twitter where nama_socmed = 'twitter'");
        $this->db->query("update socmed set link = '$tokped', tampilkan = $show_tokped where nama_socmed = 'tokped'");
        $this->db->query("update socmed set link = '$shopee', tampilkan = $show_shopee where nama_socmed = 'shopee'");

        redirect(base_url() . 'admin/socmed');
    }


    function loginPage()
    {
        $data['title'] = "Login Admin | Repository TE Unjani";
        $this->load->view('admin/login', $data);
    }

    function login()
    {
        $password = $this->input->post('pass');
        $this->db->where('pass', $password);
        $check = $this->db->get('admin');
        if ($check->num_rows() > 0) {
            $this->session->set_userdata('loged_in', true);
            redirect(base_url() . 'admin/');
        } else {
            redirect(base_url() . 'admin/loginPage?password=wrong');
        }
    }

    function logout()
    {
        unset($_SESSION['loged_in']);
        redirect(base_url() . 'admin/loginPage');
    }

    function changePasswordPage()
    {
        $data['title'] = "CAMBIAR LA CONTRASEÑA";
        $data['page'] = 'CAMBIAR LA CONTRASEÑA';
        $data['content'] = "admin/changePassword.php";
        $this->load->view('admin/template', $data);
    }
    function changePassword()
    {
        $oldPassword = trim($this->input->post('old-password'));
        $newPassword = trim($this->input->post('new-password'));

        $res = $this->db->query("select * from admin where pass='$oldPassword'");

        if ($res->num_rows() > 0) {
            $this->db->query("update admin set pass = '$newPassword'");
            $this->session->set_flashdata('changePassword', 'success');
            redirect(base_url() . 'admin/changePasswordPage');
        } else {
            $this->session->set_flashdata('changePassword', 'error');
            redirect(base_url() . 'admin/changePasswordPage');
        }
    }

    function uploadFile()
    {

        $config['upload_path'] = 'assets/images/upload/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 5000000;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            $filename = $this->upload->data('file_name');
            echo json_encode(['status' => 'success', 'filename' => $filename]);
        } else {
            $error = array('error' => $this->upload->display_errors());
            echo json_encode(['status' => 'failed', 'error' => $error]);
        }
    }

    function uploadProduct()
    {
        $photos = $this->input->post('image');

        $dataProduct = [
            'nama_produk' => $this->input->post('namaproduk'),
            'harga' => $this->input->post('harga'),
            'stok' => $this->input->post('stok'),
            //'kategori' => $this->input->post('kategori'),
            'deskripsi' => $this->input->post('deskripsi'),
        ];

        if ($this->db->insert('produk', $dataProduct)) {
            $id_produk = $this->db->insert_id();
            foreach ($photos as $idx => $photo) {
                $this->db->insert('foto_produk', [
                    'id_foto' => '',
                    'id_produk' => $id_produk,
                    'nama_foto' => $photos[$idx]
                ]);
            }
        }

        $this->session->set_flashdata('alert-product', 'success');
        redirect(base_url() . 'admin/uploadpage');
    }

    function deletefile()
    {
        $file_id = $this->input->get('id_file');

        $this->db->delete('files', ['id_file' => $file_id]);
        redirect(base_url() . 'admin');
    }


    function custom()
    {
        $data['title'] = "LOGOTIPO PERSONALIZADO Y BANNER DE TIENDA";
        $data['page'] = 'LOGOTIPO PERSONALIZADO Y BANNER DE TIENDA';
        $data['content'] = "admin/custom";
        $this->load->view('admin/template', $data);
    }
    function uploadCustom()
    {

        $config['upload_path'] = 'assets/images/logo/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 5000000;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            $filename = $this->upload->data('file_name');
            echo json_encode(['status' => 'success', 'filename' => $filename]);
        } else {
            $error = array('error' => $this->upload->display_errors());
            echo json_encode(['status' => 'failed', 'error' => $error]);
        }
    }
    function saveLogo()
    {
        $logo = $this->input->post('logo');
        $banner = $this->input->post('banner');

        if (strlen($logo)) {
            $this->db->query("update custom set nama_foto = '$logo' where type = 'logo'");
        }
        if (strlen($banner)) {
            $this->db->query("update custom set nama_foto = '$banner' where type = 'banner'");
        }

        $this->session->set_flashdata('alert-logo', 'success');
        redirect(base_url() . 'admin/custom');
    }
}


ini_set('upload_max_filesize', '500M');
ini_set('post_max_size', '500M');
ini_set('max_input_time', 5000);
ini_set('max_execution_time', 5000);
