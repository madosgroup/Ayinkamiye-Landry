<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Propriete extends CI_Controller {
    
    public function index() {  

        

        $query_all_products = $this->db->query("select * from propriete  ORDER BY DATE_CREATION ASC ");
        $list_banque=$query_all_products->result_array();

        $listofbanque=array(); 

        foreach ($list_banque as $prov) {

            //type propriete
            $critere_type['CODE_TYPE_PROPRIETE']=$prov['CODE_TYPE_PROPRIETE'];
            $type_propriete=$this->Model->getOne('type_propriete',$critere_type);

            $date_creation=date("d-m-Y",strtotime($prov['DATE_CREATION']));
            $time=date("H:i:s",strtotime($prov['DATE_CREATION'])); 
            $display_res=' Le ' .$date_creation.' à '.$time;
            
            
            $all_options='<a class="btn btn-warning btn-xs" href="' . base_url("Propriete/details/") .$prov['CODE_PROPRIETE'] . '" style="width:140px;" ><i class="fa fa-info-circle"></i> Détails </a>
            '; 

            
            $listofbanque[]=array(
                
                'nom_produit'=>$prov['NOM_PROPRIETE'], 
                'date_creation'=>$display_res,
                'prix'=>number_format($prov['PRIX_PROPRIETE'], 0, ',', ' ').' '.'FBU',
                'type_propriete'=>$type_propriete['TYPE_PROPRIETE'],
                'update'=>''.$all_options.''
            );

        }

        $data['list']=$listofbanque;   

        $templates=array(

         'table_open' => '<table id="table_id" class="table display table-bordered table-striped no-wrap"> ',

         'table_close'  => '</table>'); 

        $this->table->set_heading(array('Nom','Date de création','Prix','Type de propriété','Options')); 



        $this->table->set_template($templates);  

        $this->load->view('propriete_list_view',$data); 
    } 
    public function index_add(){

        $data['liste_type_propriete']=$this->Model->getList('type_propriete');

        $this->load->view('propriete_add_view',$data);   
    }  
    public function add(){   
        
        $code_propriete=md5(uniqid(rand(), true)); 
        
        
        $CODE_TYPE_PROPRIETE=$this->input->post('type_propriete');
        $NOM_PROPRIETE_NON_TRAITE=$this->input->post('nom_propriete');
        $DESCRIPTION_PROPRIETE=$this->input->post('desc_propriete');
        
        $NOM_PROPRIETE=$this->input->post('nom_propriete');
        $PRIX_PROPRIETE=$this->input->post('prix_propriete');
        $DATE_CREATION=date('Y-m-d H:i:s'); 

        
        

        $query = $this->db->query("select caracteristiques.NOM_CARACTERISTIQUE,caracteristiques.CODE_CARACTERISTIQUE,SLUG_CARACTERISTIQUE from caracteristiques,caracteristiques_type_propriete WHERE caracteristiques.CODE_CARACTERISTIQUE=caracteristiques_type_propriete.CODE_CARACTERISTIQUE AND CODE_TYPE_PROPRIETE='$CODE_TYPE_PROPRIETE'  ");
        $resultats=$query->result_array(); 
        
        $data_bus=array();
        if (!empty($resultats)) {
            
            foreach($resultats as $row){

                $dodi=$row['SLUG_CARACTERISTIQUE'];
                $valeur=$this->input->post($dodi);

                $SLUG_VALEUR=url_title(convert_accented_characters($valeur), 'dash', true);

                $data_bus[]=array(
                    'CODE_PROPRIETE'=>$code_propriete,
                    'CODE_CARACTERISTIQUE'=>$row['CODE_CARACTERISTIQUE'],
                    'VALEUR_CARACTERISTIQUE'=>$valeur,
                    'SLUG_VALEUR_CARACTERISTIQUE'=>$SLUG_VALEUR 

                );
            } 
            $insert_caracteristiques=$this->Model->inserer_plusieurs('caracteristiques_propriete',$data_bus);
        }

        $IMAGE_NAME='propriete'.$code_propriete; 
        $PHOTO_PRINCIPALE;
        if(isset($_FILES['image_principale']) &&  $_FILES['image_principale']['name'] != ''){

            $file_ext = pathinfo($_FILES["image_principale"]["name"], PATHINFO_EXTENSION);
            $MAGO=$IMAGE_NAME.'.'.$file_ext;

            $config['upload_path'] ='./uploads/photo_principale/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['file_name'] = $MAGO;

            $this->load->library('upload', $config);
            $this->upload->do_upload('image_principale'); 
            $data_image=$this->upload->data();

            $config=array(
             'image_library'=>'GD2',
             'source_image'=>$data_image['full_path'],
             'new_image'=>'./uploads/photo_principale/thumbs/',
             'create_thumb'=>TRUE,
             'thumb_marker'=>'',
             'maintain_ratio'=>TRUE,
             'width'=>400,
             'height'=>400
             );
            $this->load->library('image_lib',$config); 
            $this->image_lib->resize();

            $PHOTO_PRINCIPALE= $MAGO;     
        }
        
       
        $SLUG_NOM_PROPRIETE=url_title(convert_accented_characters($NOM_PROPRIETE), 'dash', true);


        $data_article=array( 

            'NOM_PROPRIETE'=>$NOM_PROPRIETE,
            'SLUG_NOM_PROPRIETE'=>$SLUG_NOM_PROPRIETE,
            'PROPRIETE_VIEWS'=>'0',
            'PROPRIETE_RATING_NOTE'=>0.0, 
            'PHOTO_PRINCIPALE_PROPRIETE'=>$PHOTO_PRINCIPALE,
            'PRIX_PROPRIETE'=>$PRIX_PROPRIETE,
            'CODE_TYPE_PROPRIETE'=>$CODE_TYPE_PROPRIETE,
            'DESCRIPTION_PROPRIETE'=>$DESCRIPTION_PROPRIETE,
            'CODE_TYPE_PROPRIETE'=>$CODE_TYPE_PROPRIETE,
            'DATE_CREATION'=>$DATE_CREATION,
            'VALIDE'=>'0',
            'ACTIF'=>'0',
            'CODE_PROPRIETE'=>$code_propriete
        );
        $donnees_article=$this->Model->create('propriete',$data_article); 
        
        if ($donnees_article) { 
            
            $this->session->set_flashdata('feedback', 'Ajouté');
            redirect(base_url('Propriete/'));
        }
        
    }

    public function index_add_photos(){  
        
        $this->load->view('article_add_photo_view'); 
    }

    public function add_photos(){ 

        $data['message']='<div class="alert alert-success text-center">Votre produit a été crée avec succès et sera passé en revue dans un délai de 2 jours ouvrables.</div>';
        $this->session->set_flashdata($data);

        redirect(base_url()."Articles/");
    }

    public function index_update(){ 
        
        $data['titre']="Articles";
        $critere['CODE_ARTICLE']=$this->uri->segment(3);
        $data['get_article']=$this->Model->getOne('article',$critere); 

        

        //Type article
        $CODE_TYPE_ARTICLE=$data['get_article']['CODE_TYPE_ARTICLE'];
        $criteriu['CODE_TYPE_ARTICLE']=$data['get_article']['CODE_TYPE_ARTICLE'];
        $data['type_article']=$this->Model->getOne('type_article',$criteriu);

        //sous categorie selectionner
        $criteres_sous_cate['CODE_SOUS_CATEGORIE']=$data['type_article']['CODE_SOUS_CATEGORIE'];
        $data['sous_categorie']=$this->Model->getOne('sous_categorie',$criteres_sous_cate);
            
        //categorie
        $criteres_categorie['CODE_CATEGORIE']=$data['sous_categorie']['CODE_CATEGORIE'];
        $data['categorie']=$this->Model->getOne('categorie',$criteres_categorie);

        //liste des categorie not in
        $la_code_categorie=$data['categorie']['CODE_CATEGORIE'];
        $query_liste_categories = $this->db->query("select CATEGORIE,CODE_CATEGORIE from categorie where CODE_CATEGORIE not in('$la_code_categorie')  ");
        $data['liste_categorie']=$query_liste_categories->result_array();

        //liste des sous categories not in
        $la_code_sous_categorie=$data['sous_categorie']['CODE_SOUS_CATEGORIE']; 
        $query_liste_sous_categories = $this->db->query("select SOUS_CATEGORIE,CODE_SOUS_CATEGORIE from sous_categorie where CODE_CATEGORIE='$la_code_categorie' AND CODE_SOUS_CATEGORIE not in('$la_code_sous_categorie')  ");
        $data['liste_des_sous_categories']=$query_liste_sous_categories->result_array();
            

        //liste des types articles  not in
        $la_code_sous_categorie=$data['sous_categorie']['CODE_SOUS_CATEGORIE'];
        $la_code_type_article=$data['type_article']['CODE_TYPE_ARTICLE'];
        $query_liste_type_article = $this->db->query("select TYPE_ARTICLE,CODE_TYPE_ARTICLE from  type_article where CODE_SOUS_CATEGORIE='$la_code_sous_categorie' AND CODE_TYPE_ARTICLE not in('$la_code_type_article')  ");
        $data['liste_des_type_article']=$query_liste_type_article->result_array();

        //marque
        $criteres_marque['CODE_MARQUE']=$data['get_article']['CODE_MARQUE'];
        $data['la_marque']=$this->Model->getOne('marque',$criteres_marque);
        $marquo=$data['la_marque']['CODE_MARQUE']; 

        $query_liste_marque = $this->db->query("select * from marque_type_article,marque where marque_type_article.CODE_MARQUE=marque.CODE_MARQUE  AND CODE_TYPE_ARTICLE='$CODE_TYPE_ARTICLE' AND marque.CODE_MARQUE<>'$marquo'   ");
        $data['marques_restants']=$query_liste_marque->result_array();

       
        
        //caracteristiques
        $query = $this->db->query("select caracteristiques.NOM_CARACTERISTIQUE,PLACEHOLDER_CARACTERISTIQUE,caracteristiques.CODE_CARACTERISTIQUE,SLUG_CARACTERISTIQUE from caracteristiques,caracteristiques_type_article WHERE caracteristiques.CODE_CARACTERISTIQUE=caracteristiques_type_article.CODE_CARACTERISTIQUE AND CODE_TYPE_ARTICLE='$CODE_TYPE_ARTICLE'  ");
        $resultats=$query->result_array();

        $caracteristiques_produits=$this->Model->getList('caracteristiques_produits',$critere);
        
        $caracta=array();
        foreach ($resultats as $key) {

            foreach ($caracteristiques_produits as  $value) {
                
                if ($key['CODE_CARACTERISTIQUE']==$value['CODE_CARACTERISTIQUE']) {
                    
                    $caracta[]=array(
                        'NOM_CARACTERISTIQUE'=>$key['NOM_CARACTERISTIQUE'],
                        'SLUG_CARACTERISTIQUE'=>$key['SLUG_CARACTERISTIQUE'],
                        'PLACEHOLDER_CARACTERISTIQUE'=>$key['PLACEHOLDER_CARACTERISTIQUE'],
                        'VALEUR_CARACTERISTIQUE'=>$value['VALEUR_CARACTERISTIQUE'],
                    );
                }
            }
            
        }

        $data['caracteristiques_list']=$caracta;

        


        

        //listes des photos

        $data['list_photos']=$this->Model->getList('photos_article',$critere); 

         
        $this->load->view('article_update_view',$data);
    }

    public function update(){

        $critero['CODE_ARTICLE'] = $this->input->post('code_article');


        $code_boutique=$this->session->userdata('CODE_BOUTIQUE');
        
        $CODE_TYPE_ARTICLE=$this->input->post('type_article');
        $NOM_ARTICLE_NON_TRAITE=$this->input->post('nom_article');

        
        $NOM_ARTICLE=$this->input->post('nom_article');
        $PRIX=$this->input->post('prix_article');
        $PRIX_PROMO=$this->input->post('prix_promo');
        $CODE_MARQUE=$this->input->post('marque');

        
        $QUANTITE_STOCK=$this->input->post('quantite_stock');
        $A_GARANTIE=$this->input->post('valeur_garantie');
        $GARANTIE_EN_MOIS=$this->input->post('garantie_en_mois');
        $DATE_CREATION=date('Y-m-d H:i:s');

        
        $PROMO="";
        if(empty($PRIX_PROMO)){
            $PROMO="0";
        }
        else{
            $PROMO=$PRIX_PROMO;
        }

        $MOIS_EN_GARANTIE="";
        if(empty($GARANTIE_EN_MOIS) || $A_GARANTIE=="0" ){
            $MOIS_EN_GARANTIE="0";
        }
        else{
            $MOIS_EN_GARANTIE=$GARANTIE_EN_MOIS;
        }

        //supprimer tous les caracteristique
        $this->Model->delete('caracteristiques_produits',$critero);

        $query = $this->db->query("select caracteristiques.NOM_CARACTERISTIQUE,caracteristiques.CODE_CARACTERISTIQUE,SLUG_CARACTERISTIQUE from caracteristiques,caracteristiques_type_article WHERE caracteristiques.CODE_CARACTERISTIQUE=caracteristiques_type_article.CODE_CARACTERISTIQUE AND CODE_TYPE_ARTICLE='$CODE_TYPE_ARTICLE'  ");
        $resultats=$query->result_array(); 
        
        $data_bus=array();
        if (!empty($resultats)) {
            
            foreach($resultats as $row){

                
                $dodi=$row['SLUG_CARACTERISTIQUE'];

                $valeur=$this->input->post($dodi);

                $SLUG_VALEUR=url_title(convert_accented_characters($valeur), 'dash', true);

                $data_bus[]=array(
                    'CODE_ARTICLE'=>$this->input->post('code_article'),
                    'CODE_CARACTERISTIQUE'=>$row['CODE_CARACTERISTIQUE'],
                    'VALEUR_CARACTERISTIQUE'=>$valeur,
                    'SLUG_VALEUR_CARACTERISTIQUE'=>$SLUG_VALEUR
                );
            } 
            $insert_caracteristiques=$this->Model->inserer_plusieurs('caracteristiques_produits',$data_bus);
        }

        
        $code_article=$this->input->post('code_article');
        $IMAGE_NAME='article'.$code_boutique.$code_article;

        //debut
        $PHOTO_PRINCIPALE;
        if(isset($_FILES['image_principale']) &&  $_FILES['image_principale']['name'] != ''){

            $file_ext = pathinfo($_FILES["image_principale"]["name"], PATHINFO_EXTENSION);
            $MAGO=$IMAGE_NAME.'.'.$file_ext;

            $config['upload_path'] ='./uploads/photo_principale/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['file_name'] = $MAGO;

            $this->load->library('upload', $config);
            $this->upload->do_upload('image_principale'); 
            $data_image=$this->upload->data();

            $config=array(
             'image_library'=>'GD2',
             'source_image'=>$data_image['full_path'],
             'new_image'=>'./uploads/photo_principale/thumbs/',
             'create_thumb'=>TRUE,
             'thumb_marker'=>'',
             'maintain_ratio'=>TRUE,
             'width'=>400,
             'height'=>400
             );
            $this->load->library('image_lib',$config); 
            $this->image_lib->resize();

            $remov=$this->Model->getList('article',$critero);
            foreach ($remov as $row) {
                if (!empty($row['PHOTO_PRINCIPALE_ARTICLE'])) {
                   unlink('./uploads/photo_principale/'.$row['PHOTO_PRINCIPALE_ARTICLE']); 

                   unlink('./uploads/photo_principale/thumbs/'.$row['PHOTO_PRINCIPALE_ARTICLE']);
                }
                
            }
            $PHOTO_PRINCIPALE=$MAGO;    
        }
        else{

            $roi=$this->Model->getOne('article',$critero);
            $PHOTO_PRINCIPALE=$roi['PHOTO_PRINCIPALE_ARTICLE'];

        }
        //fin 

        $SLUG_NOM_ARTICLE=url_title(convert_accented_characters($NOM_ARTICLE), 'dash', true);


        $data_article=array( 

            'NOM_ARTICLE'=>$NOM_ARTICLE,
            'SLUG_NOM_ARTICLE'=>$SLUG_NOM_ARTICLE,
            'PHOTO_PRINCIPALE_ARTICLE'=>$PHOTO_PRINCIPALE, 
            'CODE_MARQUE'=>$CODE_MARQUE,
            'PRIX'=>$PRIX,
            'PRIX_BARRE'=>$PROMO,
            'QUANTITE_STOCK'=>$QUANTITE_STOCK,
            'A_GARANTIE'=>$A_GARANTIE,
            'GARANTIE_EN_MOIS'=>$MOIS_EN_GARANTIE,
            'CODE_TYPE_ARTICLE'=>$CODE_TYPE_ARTICLE,
            'VALIDE'=>'0',
            'ACTIF'=>'0',
            'DATE_CREATION'=>$DATE_CREATION
        );
         $donnees_article=$this->Model->update('article', $critero,$data_article);  
        


        if ($donnees_article) {

            $this->session->set_flashdata('feedback', 'Updated');
            redirect(base_url('Articles/index_update_photos/'.$code_article));

        }

       
    } 

    

    public function upload() {

        $code_article=$this->input->post('code_articlo'); 
        $code_photo=md5(uniqid(rand(), true));
        $code_vendeur=$this->session->userdata('CODE_UTILISATEUR_SELLER');

        $IMAGE_NAME='article'.$code_vendeur.$code_article.$code_photo;

        if (!empty($_FILES)) {

        $file_ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

        $tempFile = $_FILES['file']['tmp_name'];
        $fileName = $IMAGE_NAME.'.'.$file_ext;
        $targetPath = getcwd() . '/uploads/photos_article/';
        $targetFile = $targetPath . $fileName ;

        move_uploaded_file($tempFile, $targetFile);

        $this->Model->create('photos_article',array('PHOTO_ARTICLE'=>$fileName,'CODE_PHOTO_ARTICLE'=>$code_photo,'  CODE_ARTICLE'=>$code_article));
       
        }
    }

    public function load_photos(){

        $code_article=$this->input->post('code_article');
        $critere['CODE_ARTICLE']=$code_article;

       // Upload directory
        $target_dir = getcwd() . '/uploads/photos_article/';
        // Target directory
        $dir = $target_dir;
        

        $listo=$this->Model->getList('photos_article',$critere);
        
        $file_list=array();
        foreach ($listo as $key => $value) {

            

            if (is_dir($dir)){

                $file_path = $target_dir.$value['PHOTO_ARTICLE'];

                if(!is_dir($file_path)){

                  $size = filesize($file_path);

                  $file_list[] = array(
                        'name'=>$value['PHOTO_ARTICLE'],
                        'size'=>$size,
                        //'path'=>$file_path
                  );

                }

            }



        }

       

        echo json_encode($file_list);


    }
    public function index_update_photos(){ 

        $data['titre']="Articles";
        $this->load->view('article_update_photo_view',$data);

    }
    public function remove(){
        $upload_path="./uploads/photos_article/";  
        $file=$this->input->post("file");
        if (file_exists($file)) {
            unlink($file);
            
        }
    }

    public function details(){
        
        $critere['CODE_PROPRIETE']=$this->uri->segment(3);
        $data['get_propriete']=$this->Model->getOne('propriete',$critere); 

        

        //Type article
        $CODE_TYPE_ARTICLE=$data['get_propriete']['CODE_TYPE_PROPRIETE'];
        $criteriu['CODE_TYPE_PROPRIETE']=$data['get_propriete']['CODE_TYPE_PROPRIETE'];
        $data['le_type_propriete']=$this->Model->getOne('type_propriete',$criteriu);

        
        //caracteristiques
        $query = $this->db->query("select caracteristiques.NOM_CARACTERISTIQUE,PLACEHOLDER_CARACTERISTIQUE,caracteristiques.CODE_CARACTERISTIQUE,SLUG_CARACTERISTIQUE from caracteristiques,caracteristiques_type_propriete WHERE caracteristiques.CODE_CARACTERISTIQUE=caracteristiques_type_propriete.CODE_CARACTERISTIQUE AND CODE_TYPE_PROPRIETE='$CODE_TYPE_ARTICLE'  ");
        $resultats=$query->result_array();

        $caracteristiques_produits=$this->Model->getList('caracteristiques_propriete',$critere);
        
        $caracta=array();
        foreach ($resultats as $key) {

            foreach ($caracteristiques_produits as  $value) {
                
                if ($key['CODE_CARACTERISTIQUE']==$value['CODE_CARACTERISTIQUE']) {
                    
                    $caracta[]=array(
                        'NOM_CARACTERISTIQUE'=>$key['NOM_CARACTERISTIQUE'],
                        'SLUG_CARACTERISTIQUE'=>$key['SLUG_CARACTERISTIQUE'],
                        'PLACEHOLDER_CARACTERISTIQUE'=>$key['PLACEHOLDER_CARACTERISTIQUE'],
                        'VALEUR_CARACTERISTIQUE'=>$value['VALEUR_CARACTERISTIQUE'],
                    );
                }
            }
            
        }

        $data['caracteristiques_list']=$caracta;

        

        $this->load->view('propriete_details_view',$data); 
    }
    public function delete_files() {
        $target_dir = "./uploads/photos_article/";
        $filename = $target_dir.$_POST['name'];
        unlink($filename);
        $crit['PHOTO_ARTICLE']=$_POST['name'];
        $this->Model->delete('photos_article',$crit);
        //$this->home_m->delete_files($file_name);
    }

    public function list_sous_categorie(){ 

        if($this->input->post('CODE_CATEGORIE')){ 

            echo $this->Model_ajouter_article->list_sous_categorie($this->input->post('CODE_CATEGORIE'));
        }
    }
  
    public function list_type_article(){

        if($this->input->post('CODE_SOUS_CATEGORIE')){ 

            echo $this->Model_ajouter_article->list_type_article($this->input->post('CODE_SOUS_CATEGORIE'));
        }

    }

    public function list_caracteristiques_propriete(){

        if($this->input->post('CODE_TYPE_PROPRIETE')){

            echo $this->Model->list_caracteristiques_propriete($this->input->post('CODE_TYPE_PROPRIETE'));
        }

    }

  
    public function append_ajout_article(){

        $CODE_GRAND_CATEGORIE=$this->input->post('CODE_GRAND_CATEGORIE');
        $CODE_CATEGORIE=$this->input->post('CODE_CATEGORIE');
        $CODE_SOUS_CATEGORIE=$this->input->post('CODE_SOUS_CATEGORIE');

        if($CODE_GRAND_CATEGORIE && $CODE_CATEGORIE && $CODE_SOUS_CATEGORIE){

            echo $this->Model_ajouter_article->append_ajout_article($CODE_GRAND_CATEGORIE,$CODE_CATEGORIE,$CODE_SOUS_CATEGORIE);
        }
    }

    public function fetch_modele_smartphone(){ 

        if($this->input->post('CODE_MARQUE')){

            echo $this->Model_marque->fetch_modele_smartphone($this->input->post('CODE_MARQUE')); 
        }

    }

    public function motifs_rejets(){   

        $CODE_ARTICLE= $this->input->post('iid');
       

        $query_motifs_rejet = $this->db->query("select * from motifs_rejet_article where CODE_ARTICLE='$CODE_ARTICLE' ORDER BY DATE_REJET DESC   ");
        $motifs_rejet=$query_motifs_rejet->row_array(); 

        $societera=array();

        if ($query_motifs_rejet->num_rows()>0){ 

            $societera[]=array(
                'motif'=>$motifs_rejet['MOTIF']
            );

        }
        else{

            $societera[]=array(
                'motif'=>"Celui-ci est en cours de validation, Veuillez patienter, vous serez prévenus lors de sa validation."
            );

        }
        echo json_encode($societera); 


    } 

    public function activer_article(){

        $code_article=$this->input->post('code_article');
        $critero['CODE_ARTICLE']=$code_article;

        $data=array(
          'ACTIF'=>'1'
        );
        $this->Model->update('article',$critero, $data);

    }
    public function desactiver_article(){

        $code_article=$this->input->post('code_article');
        $critero['CODE_ARTICLE']=$code_article;

        $data=array(
          'ACTIF'=>'0'
        );
        $this->Model->update('article', $critero, $data);

    }

    public function update_prix_vente(){

        $code_article=$this->input->post('code_article_input');
        $prix_vente_input=$this->input->post('prix_vente_input');
        $critero['CODE_ARTICLE']=$code_article;

        $data=array(
          'PRIX'=>$prix_vente_input
        );
        $this->Model->update('article',$critero, $data);

    }

    public function update_prix_promotionel(){ 

        $code_article=$this->input->post('code_article_input');
        $prix_promo_input=$this->input->post('prix_promo_input');
        $critero['CODE_ARTICLE']=$code_article;

        $data=array(
          'PRIX_BARRE'=>$prix_promo_input
        );
        $this->Model->update('article',$critero, $data);

    }

    public function update_quantite(){

        $code_article=$this->input->post('code_article_input');
        $quantite_stock_input=$this->input->post('quantite_stock_input');
        $critero['CODE_ARTICLE']=$code_article;

        $data=array(
          'QUANTITE_STOCK'=>$quantite_stock_input
        );
        $this->Model->update('article',$critero, $data);  

    }

    public function sell_yours(){
        
        $code_articles=$this->uri->segment(4);
        $slug_articles=$this->uri->segment(3);

        if (!empty($this->session->userdata('LOGIN')) ) {

            $critere['CODE_ARTICLE']=$this->uri->segment(4);
            $code_articles=$this->uri->segment(4);

            $data['get_article']=$this->Model->getOne('article',$critere);

            //Type article
            $CODE_TYPE_ARTICLE=$data['get_article']['CODE_TYPE_ARTICLE'];
            $criteriu['CODE_TYPE_ARTICLE']=$data['get_article']['CODE_TYPE_ARTICLE'];
            $data['type_article']=$this->Model->getOne('type_article',$criteriu);

            //sous categorie selectionner
            $criteres_sous_cate['CODE_SOUS_CATEGORIE']=$data['type_article']['CODE_SOUS_CATEGORIE'];
            $data['sous_categorie']=$this->Model->getOne('sous_categorie',$criteres_sous_cate);
                
            //categorie
            $criteres_categorie['CODE_CATEGORIE']=$data['sous_categorie']['CODE_CATEGORIE'];
            $data['categorie']=$this->Model->getOne('categorie',$criteres_categorie);

            //liste des categorie not in
            $la_code_categorie=$data['categorie']['CODE_CATEGORIE'];
            $query_liste_categories = $this->db->query("select CATEGORIE,CODE_CATEGORIE from categorie where CODE_CATEGORIE not in('$la_code_categorie')  ");
            $data['liste_categorie']=$query_liste_categories->result_array();

            //liste des sous categories not in
            $la_code_sous_categorie=$data['sous_categorie']['CODE_SOUS_CATEGORIE']; 
            $query_liste_sous_categories = $this->db->query("select SOUS_CATEGORIE,CODE_SOUS_CATEGORIE from sous_categorie where CODE_CATEGORIE='$la_code_categorie' AND CODE_SOUS_CATEGORIE not in('$la_code_sous_categorie')  ");
            $data['liste_des_sous_categories']=$query_liste_sous_categories->result_array();
                

            //liste des types articles  not in
            $la_code_sous_categorie=$data['sous_categorie']['CODE_SOUS_CATEGORIE'];
            $la_code_type_article=$data['type_article']['CODE_TYPE_ARTICLE'];
            $query_liste_type_article = $this->db->query("select TYPE_ARTICLE,CODE_TYPE_ARTICLE from  type_article where CODE_SOUS_CATEGORIE='$la_code_sous_categorie' AND CODE_TYPE_ARTICLE not in('$la_code_type_article')  ");
            $data['liste_des_type_article']=$query_liste_type_article->result_array();

            //marque
            $criteres_marque['CODE_MARQUE']=$data['get_article']['CODE_MARQUE'];
            $data['la_marque']=$this->Model->getOne('marque',$criteres_marque);
            $marquo=$data['la_marque']['CODE_MARQUE']; 

            $query_liste_marque = $this->db->query("select * from marque_type_article,marque where marque_type_article.CODE_MARQUE=marque.CODE_MARQUE  AND CODE_TYPE_ARTICLE='$CODE_TYPE_ARTICLE' AND marque.CODE_MARQUE<>'$marquo'   ");
            $data['marques_restants']=$query_liste_marque->result_array();

           
            
            //caracteristiques
            $query = $this->db->query("select caracteristiques.NOM_CARACTERISTIQUE,PLACEHOLDER_CARACTERISTIQUE,caracteristiques.CODE_CARACTERISTIQUE,SLUG_CARACTERISTIQUE from caracteristiques,caracteristiques_type_article WHERE caracteristiques.CODE_CARACTERISTIQUE=caracteristiques_type_article.CODE_CARACTERISTIQUE AND CODE_TYPE_ARTICLE='$CODE_TYPE_ARTICLE'  ");
            $resultats=$query->result_array();

            $caracteristiques_produits=$this->Model->getList('caracteristiques_produits',$critere);
            
            $caracta=array();
            foreach ($resultats as $key) {

                foreach ($caracteristiques_produits as  $value) {
                    
                    if ($key['CODE_CARACTERISTIQUE']==$value['CODE_CARACTERISTIQUE']) {
                        
                        $caracta[]=array(
                            'NOM_CARACTERISTIQUE'=>$key['NOM_CARACTERISTIQUE'],
                            'SLUG_CARACTERISTIQUE'=>$key['SLUG_CARACTERISTIQUE'],
                            'PLACEHOLDER_CARACTERISTIQUE'=>$key['PLACEHOLDER_CARACTERISTIQUE'],
                            'VALEUR_CARACTERISTIQUE'=>$value['VALEUR_CARACTERISTIQUE'],
                        );
                    }
                }
                
            } 

            $data['caracteristiques_list']=$caracta;
            


            $this->load->view('article_add_sell_yours_view',$data);

        } else {

            $session = array(
                'code_article'=>$code_articles,
                'slug_article'=>$slug_articles,
            );
            $this->session->set_userdata($session);

            redirect(base_url('Log_in/')); 

        }


      
    }

    public function add_sell_yours(){  
        
        $code_article=md5(uniqid(rand(), true)); 
        $code_photo=md5(uniqid(rand(), true));

        $code_boutique=$this->session->userdata('CODE_BOUTIQUE');
        
        $CODE_TYPE_ARTICLE=$this->input->post('type_article');
        $NOM_ARTICLE_NON_TRAITE=$this->input->post('nom_article');

        
        $NOM_ARTICLE=$this->input->post('nom_article');
        $PRIX=$this->input->post('prix_article');
        $PRIX_PROMO=$this->input->post('prix_promo');
        $CODE_MARQUE=$this->input->post('marque');

        
        $QUANTITE_STOCK=$this->input->post('quantite_stock');
        $A_GARANTIE=$this->input->post('valeur_garantie');
        $GARANTIE_EN_MOIS=$this->input->post('garantie_en_mois');
        $DATE_CREATION=date('Y-m-d H:i:s');

        
        $PROMO="";
        if(empty($PRIX_PROMO)){
            $PROMO="0";
        }
        else{
            $PROMO=$PRIX_PROMO;
        }

        $MOIS_EN_GARANTIE="";
        if(empty($GARANTIE_EN_MOIS)){
            $MOIS_EN_GARANTIE="0";
        }
        else{
            $MOIS_EN_GARANTIE=$GARANTIE_EN_MOIS;
        }

        $query = $this->db->query("select caracteristiques.NOM_CARACTERISTIQUE,caracteristiques.CODE_CARACTERISTIQUE,SLUG_CARACTERISTIQUE from caracteristiques,caracteristiques_type_article WHERE caracteristiques.CODE_CARACTERISTIQUE=caracteristiques_type_article.CODE_CARACTERISTIQUE AND CODE_TYPE_ARTICLE='$CODE_TYPE_ARTICLE'  ");
        $resultats=$query->result_array(); 
        
        $data_bus=array();
        if (!empty($resultats)) {
            
            foreach($resultats as $row){

                $dodi=$row['SLUG_CARACTERISTIQUE'];
                $valeur=$this->input->post($dodi);

                $SLUG_VALEUR=url_title(convert_accented_characters($valeur), 'dash', true);

                $data_bus[]=array(
                    'CODE_ARTICLE'=>$code_article,
                    'CODE_CARACTERISTIQUE'=>$row['CODE_CARACTERISTIQUE'],
                    'VALEUR_CARACTERISTIQUE'=>$valeur,
                    'SLUG_VALEUR_CARACTERISTIQUE'=>$SLUG_VALEUR 

                );
            } 
            $insert_caracteristiques=$this->Model->inserer_plusieurs('caracteristiques_produits',$data_bus);
        }
        
        //recuprer la photo de article existant
        $crimbou['CODE_ARTICLE']=$this->input->post('coduu_article');
        $laphoto=$this->Model->getOne('article',$crimbou);
        $PHOTO_PRINCIPALE=$laphoto['PHOTO_PRINCIPALE_ARTICLE'];
        
        $SLUG_NOM_ARTICLE=url_title(convert_accented_characters($NOM_ARTICLE), 'dash', true);

        $data_article=array( 

            'NOM_ARTICLE'=>$NOM_ARTICLE,
            'SLUG_NOM_ARTICLE'=>$SLUG_NOM_ARTICLE,
            'ARTICLE_VIEWS'=>'0',
            'PHOTO_PRINCIPALE_ARTICLE'=>$PHOTO_PRINCIPALE, 
            'CODE_MARQUE'=>$CODE_MARQUE,
            'CODE_FICHE_TECHNIQUE'=>'vide',
            'PRIX'=>$PRIX,
            'PRIX_BARRE'=>$PROMO,
            'QUANTITE_STOCK'=>$QUANTITE_STOCK,
            'A_GARANTIE'=>$A_GARANTIE,
            'GARANTIE_EN_MOIS'=>$MOIS_EN_GARANTIE,
            'CODE_TYPE_ARTICLE'=>$CODE_TYPE_ARTICLE,
            'DESCRIPTION_ARTICLE'=>'vide',
            'VALIDE'=>'0',
            'ACTIF'=>'0',
            'DATE_CREATION'=>$DATE_CREATION,
            'CODE_BOUTIQUE'=>$code_boutique,
            'CODE_ARTICLE'=>$code_article
        );
        $donnees_article=$this->Model->create('article',$data_article); 
        
       
        //Ajouter photos dans table
        $listofphotos=$this->Model->getList('photos_article',$crimbou);

        $data_photos_produits=array();
        foreach($listofphotos as $pictures){

            $data_photos_produits[]=array(
                'PHOTO_ARTICLE'=>$pictures['PHOTO_ARTICLE'],
                'CODE_ARTICLE'=>$code_article,
                'CODE_PHOTO_ARTICLE'=>$code_photo
            );
        }
        $insert_photos_produits=$this->Model->inserer_plusieurs('photos_article',$data_photos_produits);

        if ($donnees_article && $insert_photos_produits) {

            $this->session->set_flashdata('feedback', 'Ajouté');
            redirect(base_url('Articles/'));

        }

   
    }
    
  
 
}
