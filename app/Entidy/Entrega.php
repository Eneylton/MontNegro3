<?php

namespace App\Entidy;

use \App\Db\Database;

use \PDO;

class Entrega
{


    public $id;
    public $cod_id;
    public $qtd;
    public $logisticas_id;
    public $entregadores_id;
    public $receber_id;

    public function cadastar()
    {


        $obdataBase = new Database('entrega');

        $this->id = $obdataBase->insert([

            'cod_id'                   => $this->cod_id,
            'qtd'                      => $this->qtd,
            'logisticas_id'            => $this->logisticas_id,
            'receber_id'               => $this->receber_id,
            'entregadores_id'          => $this->entregadores_id

        ]);

        return true;
    }

    public static function getList($where = null, $order = null, $limit = null)
    {

        return (new Database('entrega'))->select($where, $order, $limit)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function getListCleintes($where = null, $order = null, $limit = null)
    {

        return (new Database('entrega'))->selectClientes($where, $order, $limit)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function getListEntregas($id)
    {
        return (new Database('entrega'))->selectEntregas('t.id = ' . $id)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }
    public static function getListEntID($id)
    {
        return (new Database('entrega'))->selectEntreID('t.id = ' . $id)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }
    public static function getListEntTotal($id)
    {
        return (new Database('entrega'))->selectEntreTotal('t.id = ' . $id)
            ->fetchObject(self::class);
    }

    public static function getQtd($where = null)
    {

        return (new Database('entrega'))->select($where, null, null, 'COUNT(*) as qtd')
            ->fetchObject()
            ->qtd;
    }
    public static function getQtdClientes($where = null)
    {

        return (new Database('entrega'))->selectQtdClientes($where, null, null, 'COUNT(*) as qtd')
            ->fetchObject()
            ->qtd;
    }


    public static function getID($id)
    {
        return (new Database('entrega'))->select('id = ' . $id)
            ->fetchObject(self::class);
    }

    public static function getRecID($id)
    {
        return (new Database('entrega'))->selectRec('l.receber_id = ' . $id)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public function atualizar()
    {
        return (new Database('entrega'))->update('id = ' . $this->id, [

            'cod_id'                   => $this->cod_id,
            'qtd'                      => $this->qtd,
            'logisticas_id'            => $this->logisticas_id,
            'receber_id'               => $this->receber_id,
            'entregadores_id'          => $this->entregadores_id
        ]);
    }

    public function excluir()
    {
        return (new Database('entrega'))->delete('id = ' . $this->id);
    }


    public static function getUsuarioPorEmail($email)
    {

        return (new Database('entrega'))->select('email = "' . $email . '"')->fetchObject(self::class);
    }
}
