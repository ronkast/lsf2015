<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_componente extends CI_Controller {
     public function __construct() {
        parent::__construct();
        
        $this->load->model('m_componente');
        $this->load->model('m_tipo');
        $this->load->library(array('session','form_validation'));
	$this->load->database('default');
    }
    function index(){
        $data['componente'] = $this->m_componente->getData();
        $data['contenido'] = 'componente/c_indexcomponente'; 
        $this->load->view('template', $data);    
    }
    function Lista(){ 
        //$data['componente'] = $this->m_componente->getAllComponente();
        $data['componente'] = $this->m_componente->getData();
        $this->load->view('componente/v_listacomponente', $data);    
    }    
            
    function crear(){
        $data['tipo'] = $this->m_tipo->getAllTipos();
        $this->load->view('componente/v_crearcomponente',$data);    
    }
    function  createcomponente(){
        $this->form_validation->set_rules('nombre', 'Ingrese usuario', 'required|trim|min_length[2]|max_length[150]|xss_clean');             
        //lanzamos mensajes de error si es que los hay
        $this->form_validation->set_message('required', 'El %s es requerido');
        $this->form_validation->set_message('min_length', 'El %s debe tener al menos %s carácteres');
        $this->form_validation->set_message('max_length', 'El %s debe tener al menos %s carácteres');
        if($this->form_validation->run() == FALSE)
        {
            $this->crear();
        }else{
        // print_r($_POST);
        $cod_tipo = $this->input->post('tipos');
        $nombre_componente = $this->input->post('nombre');
        $precio = $this->input->post('precio');
        $descripcion = $this->input->post('descripcion');
        $this->m_componente->creareComponente($cod_tipo, $nombre_componente, $descripcion, $precio);
        
        // $this->index();
        $this->load->view('componente/v_crearcomponente');
            
        }        
    }
}
?>