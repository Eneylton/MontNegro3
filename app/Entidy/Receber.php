<?php 

namespace App\Entidy;

use \App\Db\Database;

use \PDO;

class Receber{
    

    public $id;
    public $qtd;
    public $recebido;
    public $usuarios_id;
    public $clientes_id;


    
    public function cadastar(){


        $obdataBase = new Database('receber');  
        
        $this->id = $obdataBase->insert([
          
         
            'qtd'                           => $this->qtd, 
            'recebido'                      => $this->recebido,
            'usuarios_id'                   => $this->usuarios_id, 
            'clientes_id'                   => $this->clientes_id

        ]);

        return true;

    }

public static function getList($where = null, $order = null, $limit = null){

    return (new Database ('receber'))->select($where,$order,$limit)
                                   ->fetchAll(PDO::FETCH_CLASS, self::class);

}

public static function getListReceber($where = null, $order = null, $limit = null){

    return (new Database ('receber'))->selectReceber($where,$order,$limit)
                                   ->fetchAll(PDO::FETCH_CLASS, self::class);

}

public static function getQtd($where = null){

    return (new Database ('receber'))->select($where,null,null,'COUNT(*) as qtd')
                                   ->fetchObject()
                                   ->qtd;

}


public static function getRecebID($id){
    return (new Database ('receber'))->select('id = ' .$id)
                                   ->fetchObject(self::class);
 
}

public function atualizar(){
    return (new Database ('receber'))->update('id = ' .$this-> id, [

            'qtd'                           => $this->qtd, 
            'recebido'                      => $this->recebido,
            'usuarios_id'                   => $this->usuarios_id, 
            'clientes_id'                   => $this->clientes_id

    ]);
  
}

public function excluir(){
    return (new Database ('receber'))->delete('id = ' .$this->id);
  
}


public static function getUsuarioPorEmail($email){

    return (new Database ('receber'))->select('email = "'.$email.'"')-> fetchObject(self::class);

}


}