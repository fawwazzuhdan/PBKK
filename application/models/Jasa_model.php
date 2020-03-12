<?php defined('BASEPATH') or exit('No direct script access allowed');

class Jasa_model extends CI_Model
{
    private $_table = "jasa";

    public $idservice;
    public $namaservice;
    public $harga;
    public $gambar = "default.jpg";
    public $deskripsi;

    public function rules()
    {
        return [
            [
                'field' => 'namaservice',
                'label' => 'namaservice',
                'rules' => 'required'
            ],

            [
                'field' => 'harga',
                'label' => 'harga',
                'rules' => 'numeric'
            ],

            [
                'field' => 'deskripsi',
                'label' => 'deskripsi',
                'rules' => 'required'
            ]
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["idservice" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->idservice = uniqid();
        $this->namaservice = $post["namaservice"];
        $this->harga = $post["harga"];
        $this->gambar = $this->_uploadImage();
        $this->deskripsi = $post["deskripsi"];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->idservice = $post["id"];
        $this->namaservice = $post["namaservice"];
        $this->harga = $post["harga"];


        if (!empty($_FILES["gambar"]["name"])) {
            $this->gambar = $this->_uploadImage();
        } else {
            $this->gambar = $post["old_image"];
        }

        $this->deskripsi = $post["deskripsi"];
        $this->db->update($this->_table, $this, array('idservice' => $post['id']));
    }

    public function delete($id)
    {
        $this->_deleteImage($id);
        return $this->db->delete($this->_table, array("idservice" => $id));
    }

    private function _uploadImage()
    {
        $config['upload_path']          = './upload/product/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['file_name']            = $this->idservice;
        $config['overwrite']            = true;
        $config['max_size']             = 1024; // 1MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('gambar')) {
            return $this->upload->data("file_name");
        }

        return "default.jpg";
    }

    private function _deleteImage($id)
    {
        $product = $this->getById($id);
        if ($product->gambar != "default.jpg") {
            $filename = explode(".", $product->gambar)[0];
            return array_map('unlink', glob(FCPATH . "upload/product/$filename.*"));
        }
    }
}
