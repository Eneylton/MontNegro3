<?php 

namespace App\Entidy;

use \App\Db\Database;

use \PDO;

class Ocorrencia{
    

    public $id;

    public $nome;
    public $usuarios_id;

    
    public function cadastar(){


        $obdataBase = new Database('ocorrencias');  
        
        $this->id = $obdataBase->insert([
          
         
            'nome'                   => $this->nome, 
            'usuarios_id'            => $this->usuarios_id

        ]);

        return true;

    }

public static function getList($where = null, $order = null, $limit = null){

    return (new Database ('ocorrencias'))->select($where,$order,$limit)
                                   ->fetchAll(PDO::FETCH_CLASS, self::class);

}

public static function getQtd($where = null){

    return (new Database ('ocorrencias'))->select($where,null,null,'COUNT(*) as qtd')
                                   ->fetchObject()
                                   ->qtd;

}


public static function getRotasID($id){
    return (new Database ('ocorrencias'))->select('id = ' .$id)
                                   ->fetchObject(self::class);
 
}

public function atualizar(){
    return (new Database ('ocorrencias'))->update('id = ' .$this-> id, [

        'nome'                   => $this->nome, 
        'usuarios_id'            => $this->usuarios_id

    ]);
  
}

public function excluir(){
    return (new Database ('ocorrencias'))->delete('id = ' .$this->id);
  
}


public static function getUsuarioPorEmail($email){

    return (new Database ('ocorrencias'))->select('email = "'.$email.'"')-> fetchObject(self::class);

}


}