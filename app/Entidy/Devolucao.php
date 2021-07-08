<?php 

namespace App\Entidy;

use \App\Db\Database;

use \PDO;

class Devolucao{
    

    public $id;
    public $cod_id;
    public $qtd;
    public $logisticas_id;
    public $ocorrencias_id;
    public $entregadores_id;
    public $receber_id;
    
    public function cadastar(){


        $obdataBase = new Database('devolucao');  
        
        $this->id = $obdataBase->insert([
          
            'cod_id'                   => $this->cod_id, 
            'qtd'                      => $this->qtd,
            'logisticas_id'            => $this->logisticas_id,
            'entregadores_id'          => $this->entregadores_id,
            'receber_id'               => $this->receber_id,
            'ocorrencias_id'           => $this->ocorrencias_id
          
        ]);

        return true;

    }

public static function getList($where = null, $order = null, $limit = null){

    return (new Database ('devolucao'))->select($where,$order,$limit)
                                   ->fetchAll(PDO::FETCH_CLASS, self::class);

}

public static function getDevID($id){
    return (new Database ('devolucao'))->selectDevID('t.id = ' .$id)
    ->fetchAll(PDO::FETCH_CLASS, self::class);
 
}


public static function getDevOcorrencia($id){
    return (new Database ('devolucao'))->selectDevOc('e.id = ' .$id)
    ->fetchAll(PDO::FETCH_CLASS, self::class);
 
}


public static function getDevDia($id){
    return (new Database ('devolucao'))->selectDevDia('t.id = ' .$id)
    ->fetchAll(PDO::FETCH_CLASS, self::class);
 
}

public static function getListCleintes($where = null, $order = null, $limit = null){

    return (new Database ('devolucao'))->selectClientes($where,$order,$limit)
                                   ->fetchAll(PDO::FETCH_CLASS, self::class);

}

public static function getQtd($where = null){

    return (new Database ('devolucao'))->select($where,null,null,'COUNT(*) as qtd')
                                   ->fetchObject()
                                   ->qtd;

}
public static function getQtdClientes($where = null){

    return (new Database ('devolucao'))->selectQtdClientes($where,null,null,'COUNT(*) as qtd')
                                   ->fetchObject()
                                   ->qtd;

}


public static function getID($id){
    return (new Database ('devolucao'))->select('id = ' .$id)
                                   ->fetchObject(self::class);
 
}

public function atualizar(){
    return (new Database ('devolucao'))->update('id = ' .$this-> id, [

        'cod_id'                   => $this->cod_id, 
        'qtd'                      => $this->qtd,
        'logisticas_id'            => $this->logisticas_id,
        'entregadores_id'          => $this->entregadores_id,
        'receber_id'               => $this->receber_id,
        'ocorrencias_id'           => $this->ocorrencias_id
    ]);
  
}

public function excluir(){
    return (new Database ('devolucao'))->delete('id = ' .$this->id);
  
}


public static function getUsuarioPorEmail($email){

    return (new Database ('devolucao'))->select('email = "'.$email.'"')-> fetchObject(self::class);

}



}