<?php 

namespace App\Entidy;

use \App\Db\Database;

use \PDO;

class Carteira{
    

    public $id;
    public $qtd;
    
    public $valor;
    public $cod_id;
    public $entregadores_id;

    
    public function cadastar(){


        $obdataBase = new Database('carteira');  
        
        $this->id = $obdataBase->insert([
          
         
            'qtd'                      => $this->qtd, 
            'valor'                    => $this->valor, 
            'cod_id'                   => $this->cod_id, 
            'entregadores_id'          => $this->entregadores_id 

        ]);

        return true;

    }

public static function getList($where = null, $order = null, $limit = null){

    return (new Database ('carteira'))->select($where,$order,$limit)
                                   ->fetchAll(PDO::FETCH_CLASS, self::class);

}

public static function getQtd($where = null){

    return (new Database ('carteira'))->select($where,null,null,'COUNT(*) as qtd')
                                   ->fetchObject()
                                   ->qtd;

}


public static function getID($id){
    return (new Database ('carteira'))->select('entregadores_id = ' .$id)
                                   ->fetchObject(self::class);
 
}

public function atualizar(){
    return (new Database ('carteira'))->update('id = ' .$this-> id, [

        'qtd'                      => $this->qtd, 
        'valor'                    => $this->valor, 
        'cod_id'                   => $this->cod_id, 
        'entregadores_id'          => $this->entregadores_id 

    ]);
  
}

public function excluir(){
    return (new Database ('carteira'))->delete('id = ' .$this->id);
  
}


public static function getUsuarioPorEmail($email){

    return (new Database ('carteira'))->select('email = "'.$email.'"')-> fetchObject(self::class);

}


}