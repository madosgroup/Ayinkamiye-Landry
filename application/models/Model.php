<?php

defined('BASEPATH') OR exit('No direct script access allowed');   

class Model extends CI_Model{   



	public function create($table, $data) {

    $query = $this->db->insert($table, $data);

    return ($query) ? true : false;

  }

  public function inserer_plusieurs($table,$data){
      
    $query=$this->db->insert_batch($table,$data);
    return ($query) ? true : false;
    //return ($query)? true:false;

  }

  public function update($table, $criteres, $data) { 

    $this->db->where($criteres);

    $query = $this->db->update($table, $data);

    return ($query) ? true : false;

  }

  public function getList($table,$criteres = array()) {

    $this->db->where($criteres);

    $query = $this->db->get($table);

    return $query->result_array();

  }

  public function getOne($table, $criteres) {

    $this->db->where($criteres);

    $query = $this->db->get($table);

    return $query->row_array();

  }

  public function getListOrderByAsc($table,$name,$criteres = array()) {
    
    $this->db->order_by($name, 'ASC');
    $this->db->where($criteres);
    $query = $this->db->get($table);
    return $query->result_array();

  }

  public function getListOrderByDesc($table,$name,$criteres = array()) {
    
    $this->db->order_by($name, 'DESC');
    $this->db->where($criteres);
    $query = $this->db->get($table);
    return $query->result_array();

  }

  public  function delete($table,$criteres){

    $this->db->where($criteres);
    $query = $this->db->delete($table);
    return ($query) ? true : false;

  }

  public function getListNotin($table,$champs,$tableau = array(),$criteres = array()) { 

        $this->db->where($criteres);

        $this->db->where_not_in($champs,$tableau);

        $query = $this->db->get($table);

        return $query->result_array();

  }

  public function list_caracteristiques_propriete($CODE_TYPE_PROPRIETE){    

      $output = '';

      $query = $this->db->query("select caracteristiques.NOM_CARACTERISTIQUE,PLACEHOLDER_CARACTERISTIQUE,caracteristiques.CODE_CARACTERISTIQUE,SLUG_CARACTERISTIQUE from caracteristiques,caracteristiques_type_propriete WHERE caracteristiques.CODE_CARACTERISTIQUE=caracteristiques_type_propriete.CODE_CARACTERISTIQUE AND CODE_TYPE_PROPRIETE='$CODE_TYPE_PROPRIETE'  ");
      $resultats=$query->result_array();

      
      
      foreach($resultats as $row){

        $output .= '<div class="col-lg-12 col-md-12 sm-12 xs-12 form-group">';
        $output .= '<label for="basicInput">'.$row['NOM_CARACTERISTIQUE'].' <span style="color: red;">*</span></label>';
        $output .= '<input type="text" class="form-control" id="basicInput" placeholder="'.$row['PLACEHOLDER_CARACTERISTIQUE'].'" name="'.$row['SLUG_CARACTERISTIQUE'].'" >';
        $output .= '</div>';
        
        
      }
        
      return $output;
   }

 
  
  

 

}