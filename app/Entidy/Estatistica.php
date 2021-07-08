<?php 

namespace App\Entidy;

use \App\Db\Database;

use \PDO;

class Estatistica{
    

    public $entregadores;
    public $entregas;
    public $devolucao;
    public $total;

    
    public function cadastar(){


        $obdataBase = new Database('rotas');  
        
        $this->id = $obdataBase->insert([
          
         
            'descricao'                   => $this->descricao 

        ]);

        return true;

    }

public static function getList($where = null, $order = null, $limit = null){

    return (new Database ('rotas'))->selectEstatistica1($where,$order,$limit)
                                   ->fetchAll(PDO::FETCH_CLASS, self::class);

}

public static function getList2($where = null, $order = null, $limit = null){

    return (new Database ('rotas'))->selectEstatistica2($where,$order,$limit)
                                   ->fetchAll(PDO::FETCH_CLASS, self::class);

}

public static function getQtd($where = null){

    return (new Database ('rotas'))->select($where,null,null,'COUNT(*) as qtd')
                                   ->fetchObject()
                                   ->qtd;

}


public static function getRotasID($id){
    return (new Database ('rotas'))->select('id = ' .$id)
                                   ->fetchObject(self::class);
 
}

public function atualizar(){
    return (new Database ('rotas'))->update('id = ' .$this-> id, [

                                               
       
        'descricao'                   => $this->descricao 

    ]);
  
}

public function excluir(){
    return (new Database ('rotas'))->delete('id = ' .$this->id);
  
}


public static function getUsuarioPorEmail($email){

    return (new Database ('rotas'))->select('email = "'.$email.'"')-> fetchObject(self::class);

}


}