<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TypePropriete extends CI_Controller {

	
	public function index(){ 

		$listoftype=array();

		$list_type_propriete=$this->Model->getList('type_propriete'); 

		foreach ($list_type_propriete as $property_type) {

			


			$listoftype[]=array(

				'type_article'=>$property_type['TYPE_PROPRIETE'],

				'update'=>'<a class="btn btn-success btn-xs" href="' . base_url("TypePropriete/index_update/") .$property_type['CODE_TYPE_PROPRIETE'] . '" style="width:80px;"><i class="fa fa-edit"></i> Modifier </a>


               <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" 

                            data-target="#mydelete'.$property_type['CODE_TYPE_PROPRIETE'] .'" style="margin-top:5px;width:80px;"><i class="fa fa-trash"></i> Supprimer </button>

                <div class="modal fade" id="mydelete'.$property_type['CODE_TYPE_PROPRIETE'].'">

         <div class="modal-dialog">

          <div class="modal-content">

           <div class="modal-body">

            <h5>Voulez vous vraiment supprimer le  type de propriété <b>'.$property_type['TYPE_PROPRIETE'].'?</b></h5>

           </div>

           <div class="modal-footer">

             <a class="btn  btn-primary btn-md" href="'.base_url("TypePropriete/delete/".$property_type['CODE_TYPE_PROPRIETE']).'">Supprimer</a>

             <button class="btn  btn-md" class="close" data-dismiss="modal">Annuler</button>

           </div>

          </div>

         </div> 

        </div>'

			); 

		}

		$data['list']=$listoftype;  

        $templates=array(

         'table_open' => '<table class="table table-bordered table-stripped table-hover table-condensed" id="table_id"> ',

         'table_close'  => '</table>');

        $this->table->set_heading(array('Type de propriété','Options')); 



        $this->table->set_template($templates);

		$this->load->view('type_propriete_list_view',$data); 

	}

	public function index_add(){

		
	    $this->load->view('type_propriete_add_view'); 
	}
	public function add(){

		$this->form_validation->set_rules('type_propriete','Type de propriété','trim|required'); 
		
		
		if($this->form_validation->run()==FALSE){
            
            $data['message']= '';
            $data['type_propriete']=$this->input->post('type_propriete');
            
            
			$this->load->view('type_propriete_add_view',$data);

		}
		else{ 

			$code_type_propriete=md5(uniqid(rand(), true));
			
			$TYPE_PROPRIETE=$this->input->post('type_propriete');
			$SLUG_TYPE_PROPRIETE=url_title(convert_accented_characters($TYPE_PROPRIETE), 'dash', true);


			//verifier si la ctegorie existe deja 
			$TRIM=trim($TYPE_PROPRIETE); 
			$query_total_type = $this->db->query("select * from type_propriete where TYPE_PROPRIETE='$TRIM' ");
			 
			if ($query_total_type->num_rows()>0) { 
				
				$data['message']='<div class="alert alert-danger text-center">Le type de propriété  <b>'.$TYPE_PROPRIETE.'</b> existe déjà.</div>';
		        $this->session->set_flashdata($data);
		        redirect(base_url('TypePropriete/index_add'));
			}
			else{

				$data_type_propriete=array( 
					'TYPE_PROPRIETE'=>$TYPE_PROPRIETE,
					'SLUG_TYPE_PROPRIETE'=>$SLUG_TYPE_PROPRIETE,
					'CODE_TYPE_PROPRIETE'=>$code_type_propriete
				);
				$sucess=$this->Model->create('type_propriete',$data_type_propriete);

				if ($sucess) {
					
					$this->session->set_flashdata('feedback', 'Enregistré'); 
				    redirect(base_url('TypePropriete/'));
				}
			}
			


		}
		
	}

	public function index_update(){

		$critere['CODE_TYPE_PROPRIETE']=$this->uri->segment(3);
        $data['get_type_propriete']=$this->Model->getOne('type_propriete',$critere);
        $this->load->view('type_propriete_update_view',$data);
		
	}

	public function update(){

		$this->form_validation->set_rules('type_propriete','Type de propriété','trim|required');

		if($this->form_validation->run()==FALSE){
            
            $data['message']= '';
			$this->load->view('type_article_update_view',$data);

		}
		else{ 

			$critere_update['CODE_TYPE_PROPRIETE']=$this->input->post('code_type_propriete');

			$TYPE_PROPRIETE=$this->input->post('type_propriete');
			$SLUG_TYPE_PROPRIETE=url_title(convert_accented_characters($TYPE_PROPRIETE), 'dash', true);
			
			$data_type_propriete=array( 
				'TYPE_PROPRIETE'=>$TYPE_PROPRIETE,
				'SLUG_TYPE_PROPRIETE'=>$SLUG_TYPE_PROPRIETE
			);
			$sucess=$this->Model->update('type_propriete',$critere_update,$data_type_propriete);

			

			if ($sucess) {
				
				$this->session->set_flashdata('feedback', 'Modifié'); 
			    redirect(base_url('TypePropriete/'));
			}


		}
		
	}

	public function delete(){

		$table ='type_propriete';
    
  	    $criteres['CODE_TYPE_PROPRIETE']=$this->uri->segment(3);
  	 
  	    $this->Model->delete($table,$criteres);
  	    $this->session->set_flashdata('feedback', 'Supprimé');

  	    redirect(base_url('TypePropriete/'));
		
	}
	
}