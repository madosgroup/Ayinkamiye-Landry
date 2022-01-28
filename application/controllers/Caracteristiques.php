<?php

defined('BASEPATH') OR exit('No direct script access allowed'); 

class Caracteristiques extends CI_Controller { 

	public function index(){

		$listofbanque=array();

		//$list_banque=$this->Model->getList('caracteristiques_type_article'); 

		$query_all_products = $this->db->query("select DISTINCT CODE_TYPE_PROPRIETE from caracteristiques_type_propriete  ");
        $list_banque=$query_all_products->result_array(); 

		foreach ($list_banque as $prov) { 
            
            $crito['CODE_TYPE_PROPRIETE']=$prov['CODE_TYPE_PROPRIETE'];
            $type_article=$this->Model->getOne('type_propriete',$crito);

            
            $les_sous=$this->Model->getOne('caracteristiques_type_propriete',$crito);
            
            

			$listofbanque[]=array(

				'type_propriete'=>$type_article['TYPE_PROPRIETE'],  

                'caracteristique'=>'<button type="button" class="btn btn-success btn-sm editbuttonPropriet" data-toggle="modal" data-id="'.$prov['CODE_TYPE_PROPRIETE'].'"><i class="fa fa-list-alt"></i> Liste des caractéristiques </button>',
                

				'update'=>'<a class="btn btn-success btn-xs" href="' . base_url("Caracteristiques/index_update/") .$prov['CODE_TYPE_PROPRIETE'] . '" style="width:80px;"><i class="fa fa-edit"></i> Modifier </a>

				<div class="modal fade" id="Modal_liste_proprietaire_mes_comptes"> 
		         <div class="modal-dialog modal-lg">
		          <div class="modal-content"> 
		           <div class="modal-header">
		             <button type="button" class="close" data-dismiss="modal">&times;</button>  
		             <h4 class="modal-title">Liste des caractéristiques</h4>
		           </div>
		           <div class="modal-body">
		             <table class="table table-striped" id="table_idu">
		               <thead>
		                 <tr>
		                   <th>Caractéristique</th>
		                   <th>Placeholder</th>
		                   <th>Option</th>
		                 </tr>
		               </thead>

		               <tbody class="body_liste_proprietaire_mes_comptes">
		                 
		               </tbody>

		             </table>
		           </div>
		           <div class="modal-footer">
		             <button class="btn  btn-md" class="close" data-dismiss="modal">Fermer</button>
		           </div>
		          </div>
		         </div>
		        </div> '

			);

		}

		$data['list']=$listofbanque; 

        $templates=array(

         'table_open' => '<table class="table table-bordered table-stripped table-hover table-condensed" id="table_id"> ',

         'table_close'  => '</table>');

        $this->table->set_heading(array('Type de propriété','Caractéristiques','Options')); 



        $this->table->set_template($templates);   

		$this->load->view('caracteristiques_list_view',$data);  

	}
	public function index_add(){ 
       
       $data['list_type_propriete']=$this->Model->getListOrderByAsc('type_propriete','TYPE_PROPRIETE');
	   $this->load->view('caracteristiques_add_view',$data); 
	}
	public function add(){ 


		$code_type_propriete=$this->input->post('type_propriete');
		$nom_caracteristique=$this->input->post('nom_caracterique');
		$placeholder_caracteristique=$this->input->post('placeholder_caracterique');
		
		
        
		$data_pour_caracteristiques_type_article=array();
		$data_pour_caracteristiques=array();

        for ($i=0;$i<sizeof($nom_caracteristique);$i++) {

        	$code_caracteristique=md5(uniqid(rand(), true));

        	$data_pour_caracteristiques[$i]=array(
        		'NOM_CARACTERISTIQUE'=>$nom_caracteristique[$i],
        		'SLUG_CARACTERISTIQUE'=>url_title(convert_accented_characters($nom_caracteristique[$i]), 'dash', true),
        		'PLACEHOLDER_CARACTERISTIQUE'=>$placeholder_caracteristique[$i],
        		'CODE_CARACTERISTIQUE'=>$code_caracteristique
        	);

           $data_pour_caracteristiques_type_article[$i]=array(
	           	'CODE_CARACTERISTIQUE'=>$code_caracteristique,
	           	'CODE_TYPE_PROPRIETE'=>$code_type_propriete
           );
        }


        $insert_caracteristiques=$this->Model->inserer_plusieurs('caracteristiques',$data_pour_caracteristiques);

        $insert_caracteristiques_sous_categorie=$this->Model->inserer_plusieurs('caracteristiques_type_propriete',$data_pour_caracteristiques_type_article);

        if ($insert_caracteristiques && $insert_caracteristiques_sous_categorie) {
          
          $this->session->set_flashdata('feedback', 'Ajouté');
          redirect(base_url('Caracteristiques/'));
        }


	}
	public function index_update(){ 
      
		$critere['CODE_TYPE_PROPRIETE']=$this->uri->segment(3);
		$data['typo_article']=$this->Model->getOne('type_propriete',$critere);

        $limbe=$this->Model->getList('caracteristiques_type_propriete ',$critere);
        
        $carambe=array();
        foreach ($limbe as $lili) {
        	
        	$critere_caract['CODE_CARACTERISTIQUE']=$lili['CODE_CARACTERISTIQUE'];
        	$lecaract=$this->Model->getOne('caracteristiques',$critere_caract);
        	$carambe[]=array(
        		'NOM_CARACTERISTIQUE'=>$lecaract['NOM_CARACTERISTIQUE'],
        		'PLACEHOLDER_CARACTERISTIQUE'=>$lecaract['PLACEHOLDER_CARACTERISTIQUE']
        	);

        }
        $data['caracteriser']=$carambe;

        


         //liste des types articles not in 
	    $provincia=$this->Model->getOne('type_propriete',$critere);
	    $la_criterio=$provincia['CODE_TYPE_PROPRIETE'];
	    $data['list_sous_categories']=$this->Model->getListNotin('type_propriete','CODE_TYPE_PROPRIETE',$la_criterio);
	    //liste des types articles not in


        $this->load->view('caracteristiques_update_view',$data);
		
	}
	public function update(){

		$code_type_article=$this->input->post('type_propriete');
	    $nom_caracteristique=$this->input->post('nom_caracterique');
	    $placeholder_caracteristique=$this->input->post('placeholder_caracterique');

	    //delete
		$critere_update['CODE_TYPE_PROPRIETE']=$this->input->post('type_propriete');
		$LIST=$this->Model->getList('caracteristiques_type_propriete',$critere_update);
		foreach ($LIST as  $value) {
			
			$crimbo['CODE_CARACTERISTIQUE']=$value['CODE_CARACTERISTIQUE'];
			$this->Model->delete('caracteristiques',$crimbo);

		}
		$this->Model->delete('caracteristiques_type_propriete',$critere_update);

	    $data_pour_caracteristiques_type_article=array();
		$data_pour_caracteristiques=array();
        for ($i=0;$i<sizeof($nom_caracteristique);$i++) {

        	$code_caracteristique=md5(uniqid(rand(), true));

        	$data_pour_caracteristiques[$i]=array(
        		'NOM_CARACTERISTIQUE'=>$nom_caracteristique[$i],
        		'SLUG_CARACTERISTIQUE'=>url_title(convert_accented_characters($nom_caracteristique[$i]), 'dash', true),
        		'PLACEHOLDER_CARACTERISTIQUE'=>$placeholder_caracteristique[$i],
        		'CODE_CARACTERISTIQUE'=>$code_caracteristique
        	);

           $data_pour_caracteristiques_type_article[$i]=array(
	           	'CODE_CARACTERISTIQUE'=>$code_caracteristique,
	           	'CODE_TYPE_PROPRIETE'=>$code_type_article
           );
        }


        $insert_caracteristiques=$this->Model->inserer_plusieurs('caracteristiques',$data_pour_caracteristiques);

        $insert_caracteristiques_sous_categorie=$this->Model->inserer_plusieurs('caracteristiques_type_propriete',$data_pour_caracteristiques_type_article);

        if ($insert_caracteristiques && $insert_caracteristiques_sous_categorie) {
          
          $this->session->set_flashdata('feedback', 'Modifié');
          redirect(base_url('Caracteristiques/'));
        }

	}
	public function list_caracteristiques(){

	    $critr['CODE_TYPE_PROPRIETE']= $this->input->post('iid');
	    $compte_groupement_societaire=$this->Model->getList('caracteristiques_type_propriete',$critr);
	    
	    $societera=array();

	    foreach ($compte_groupement_societaire as $soc) {
	      
	      $croi['CODE_CARACTERISTIQUE']=$soc['CODE_CARACTERISTIQUE'];
	      $lesoc=$this->Model->getOne('caracteristiques',$croi);

	      $parameter=$this->input->post('iid').'/'.$lesoc['CODE_CARACTERISTIQUE'];

	      $societera[]=array(
	      	'caracteristique'=>$lesoc['NOM_CARACTERISTIQUE'],
	      	'placeholder'=>$lesoc['PLACEHOLDER_CARACTERISTIQUE'],
	      	'option'=>'<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" 
            data-target="#mydelete'.$lesoc['CODE_CARACTERISTIQUE'] .'"><i class="fa fa-trash"></i> Supprimer </button>
            <div class="modal fade" id="mydelete'.$lesoc['CODE_CARACTERISTIQUE'].'">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-body">
             <h5>Voulez vous vraiment supprimer la caractéristique  <b>'.$lesoc['NOM_CARACTERISTIQUE'].'?</b></h5>
            </div>
            <div class="modal-footer">
             <a class="btn  btn-primary btn-md" href="'.base_url("Caracteristiques/delete/".$parameter).'">Supprimer</a>
             <button class="btn  btn-md" class="close" data-dismiss="modal">Annuler</button>
            </div>
            </div>
            </div>
            </div>'
	      );

	    }
	  
	    //$data['medicinecategory'] = $this->medicine_model->getMedicineCategoryById($id);
	    echo json_encode($societera);

  }
	public function delete(){

		$table1 ='caracteristiques';
		$table2 ='caracteristiques_type_propriete';
    
  	    $criteres_caracteristique['CODE_CARACTERISTIQUE']=$this->uri->segment(4);
  	    $criteres_caracteristique_type_article['CODE_CARACTERISTIQUE']=$this->uri->segment(4);
  	    $criteres_caracteristique_type_article['CODE_TYPE_PROPRIETE']=$this->uri->segment(3);
  	 
  	    $this->Model->delete($table1,$criteres_caracteristique);
  	    $this->Model->delete($table2,$criteres_caracteristique_type_article);

  	    $this->session->set_flashdata('feedback', 'Supprimé');

  	    redirect(base_url('Caracteristiques/'));
		
	}
}