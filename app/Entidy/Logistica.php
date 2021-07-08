<?php

namespace App\Entidy;

use \App\Db\Database;

use \PDO;

class Logistica
{


    public $id;
    public $data;
    public $cod_id;
    public $data_inicio;
    public $data_fim;
    public $qtd;
    public $clientes_id;
    public $entregadores_id;
    public $servicos_id;
    public $regioes_id;
    public $receber_id;


    public function cadastar()
    {


        $obdataBase = new Database('logisticas');

        $this->id = $obdataBase->insert([


            'data'                          => $this->data,
            'cod_id'                        => $this->cod_id,
            'data_inicio'                   => $this->data_inicio,
            'data_fim'                      => $this->data_fim,
            'qtd'                           => $this->qtd,
            'clientes_id'                   => $this->clientes_id,
            'entregadores_id'               => $this->entregadores_id,
            'servicos_id'                   => $this->servicos_id,
            'regioes_id'                    => $this->regioes_id,
            'receber_id'                    => $this->receber_id
        ]);

        return true;
    }

    public static function getList($where = null, $order = null, $limit = null)
    {

        return (new Database('logisticas'))->selectEntregadores($where, $order, $limit)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function getListProducao($id = null, $order = null, $limit = null)
    {

        return (new Database('logisticas'))->selectProducao('l.receber_id = ' . $id, $order, $limit)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function getQtd($where = null)
    {

        return (new Database('logisticas'))->selectQtdEntregadores($where, null, null, 'COUNT(*) as qtd')
            ->fetchObject()
            ->qtd;
    }


    public static function getRotasID($id)
    {
        return (new Database('logisticas'))->select('id = ' . $id)
            ->fetchObject(self::class);
    }

    public function atualizar()
    {
        return (new Database('logisticas'))->update('id = ' . $this->id, [

       
            'data'                          => $this->data,
            'cod_id'                        => $this->cod_id,
            'data_inicio'                   => $this->data_inicio,
            'data_fim'                      => $this->data_fim,
            'qtd'                           => $this->qtd,
            'clientes_id'                   => $this->clientes_id,
            'entregadores_id'               => $this->entregadores_id,
            'servicos_id'                   => $this->servicos_id,
            'regioes_id'                    => $this->regioes_id,
            'receber_id'                    => $this->receber_id


        ]);
    }

    public function excluir()
    {
        return (new Database('logisticas'))->delete('id = ' . $this->id);
    }


    public static function getUsuarioPorEmail($email)
    {

        return (new Database('logisticas'))->select('email = "' . $email . '"')->fetchObject(self::class);
    }
}
