<?php 

namespace App\Entidy;

use \App\Db\Database;

use \PDO;

class Veiculo{
    

    public $id;

    public $nome;

    
    public function cadastar(){


        $obdataBase = new Database('veiculos');  
        
        $this->id = $obdataBase->insert([
          
            
            'nome'                   => $this->nome 

        ]);

        return true;

    }

public static function getList($where = null, $order = null, $limit = null){

    return (new Database ('veiculos'))->select($where,$order,$limit)
                                   ->fetchAll(PDO::FETCH_CLASS, self::class);

}

public static function getQtd($where = null){

    return (new Database ('veiculos'))->select($where,null,null,'COUNT(*) as qtd')
                                   ->fetchObject()
                                   ->qtd;

}


public static function getID($id){
    return (new Database ('veiculos'))->select('id = ' .$id)
                                   ->fetchObject(self::class);
 
}

public function atualizar(){
    return (new Database ('veiculos'))->update('id = ' .$this-> id, [

                                               
        
        'nome'                   => $this->nome 

    ]);
  
}

public function excluir(){
    return (new Database ('veiculos'))->delete('id = ' .$this->id);
  
}


public static function getUsuarioPorEmail($email){

    return (new Database ('veiculos'))->select('email = "'.$email.'"')-> fetchObject(self::class);

}



}