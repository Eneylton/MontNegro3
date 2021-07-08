<?php 

namespace App\Entidy;

use \App\Db\Database;

use \PDO;

class Acesso{
    

    public $id;
    public $nivel;
    
    public function cadastar(){


        $obdataBase = new Database('acessos');  
        
        $this->id = $obdataBase->insert([
          
            'nome'                   => $this->nome, 
            'nivel'                  => $this->nivel
          
        ]);

        return true;

    }

public static function getList($where = null, $order = null, $limit = null){

    return (new Database ('acessos'))->select($where,$order,$limit)
                                   ->fetchAll(PDO::FETCH_CLASS, self::class);

}
public static function getListCleintes($where = null, $order = null, $limit = null){

    return (new Database ('acessos'))->selectClientes($where,$order,$limit)
                                   ->fetchAll(PDO::FETCH_CLASS, self::class);

}

public static function getQtd($where = null){

    return (new Database ('acessos'))->select($where,null,null,'COUNT(*) as qtd')
                                   ->fetchObject()
                                   ->qtd;

}
public static function getQtdClientes($where = null){

    return (new Database ('acessos'))->selectQtdClientes($where,null,null,'COUNT(*) as qtd')
                                   ->fetchObject()
                                   ->qtd;

}


public static function getID($id){
    return (new Database ('acessos'))->select('id = ' .$id)
                                   ->fetchObject(self::class);
 
}

public function atualizar(){
    return (new Database ('acessos'))->update('id = ' .$this-> id, [

        'nome'                   => $this->nome, 
        'nivel'              => $this->nivel
    ]);
  
}

public function excluir(){
    return (new Database ('acessos'))->delete('id = ' .$this->id);
  
}


public static function getUsuarioPorEmail($email){

    return (new Database ('acessos'))->select('email = "'.$email.'"')-> fetchObject(self::class);

}



}