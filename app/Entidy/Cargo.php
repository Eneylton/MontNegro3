<?php 

namespace App\Entidy;

use \App\Db\Database;

use \PDO;

class Cargo{
    

    public $id;
    public $descricao;
    
    public function cadastar(){


        $obdataBase = new Database('cargos');  
        
        $this->id = $obdataBase->insert([
          
            'nome'                   => $this->nome, 
            'descricao'              => $this->descricao
          
        ]);

        return true;

    }

public static function getList($where = null, $order = null, $limit = null){

    return (new Database ('cargos'))->select($where,$order,$limit)
                                   ->fetchAll(PDO::FETCH_CLASS, self::class);

}
public static function getListCleintes($where = null, $order = null, $limit = null){

    return (new Database ('cargos'))->selectClientes($where,$order,$limit)
                                   ->fetchAll(PDO::FETCH_CLASS, self::class);

}

public static function getQtd($where = null){

    return (new Database ('cargos'))->select($where,null,null,'COUNT(*) as qtd')
                                   ->fetchObject()
                                   ->qtd;

}
public static function getQtdClientes($where = null){

    return (new Database ('cargos'))->selectQtdClientes($where,null,null,'COUNT(*) as qtd')
                                   ->fetchObject()
                                   ->qtd;

}


public static function getID($id){
    return (new Database ('cargos'))->select('id = ' .$id)
                                   ->fetchObject(self::class);
 
}

public function atualizar(){
    return (new Database ('cargos'))->update('id = ' .$this-> id, [

        'nome'                   => $this->nome, 
        'descricao'              => $this->descricao
    ]);
  
}

public function excluir(){
    return (new Database ('cargos'))->delete('id = ' .$this->id);
  
}


public static function getUsuarioPorEmail($email){

    return (new Database ('cargos'))->select('email = "'.$email.'"')-> fetchObject(self::class);

}



}