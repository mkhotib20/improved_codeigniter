<?php
class Upload extends CI_Model
{
    public $config;
    public $errors;
    public $data;
    
    public function __construct() 
    {
        parent::__construct();
        $this->config['upload_path'] = './uploads/';
        $this->config['allowed_types'] = 'gif|jpg|png';
        $this->config['max_size'] = 2000;
        $this->config['max_width'] = 1500;
        $this->config['max_height'] = 1500;
        $this->load->library('upload', $this->config);
    }
    public function save($file)
    {
        if (!$this->upload->do_upload($file)) {
            $this->errors = $this->upload->display_errors();
            return false;
        }
        $this->data = (object) $this->upload->data();
        return true;
    }
    public function getErrors()
    {
        return $this->errors;
    }
    public function getImageName()
    {
        return $this->data->file_name;
    }
    
}
