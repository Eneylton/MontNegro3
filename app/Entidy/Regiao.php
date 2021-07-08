<?php

namespace App\Entidy;

use \App\Db\Database;

use \PDO;

class Regiao
{


    public $id;

    public $nome;

    public $rotas_id;


    public function cadastar()
    {


        $obdataBase = new Database('regioes');

        $this->id = $obdataBase->insert([


            'nome'                   => $this->nome,
            'rotas_id'               => $this->rotas_id

        ]);

        return true;
    }

    public static function getRegioes($where = null, $order = null, $limit = null)
    {

        return (new Database('regioes'))->select($where, $order, $limit)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function getList($where = null, $order = null, $limit = null)
    {

        return (new Database('regioes'))->innerjoin($where, $order, $limit)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function getQtdRegiao($where = null)
    {

        return (new Database('regioes'))->qtdRegiao($where, null, null, 'COUNT(*) as qtd')
            ->fetchObject()
            ->qtd;
    }

    public static function getQtd($where = null)
    {

        return (new Database('regioes'))->select($where, null, null, 'COUNT(*) as qtd')
            ->fetchObject()
            ->qtd;
    }


    public static function getRotasID($id)
    {
        return (new Database('regioes'))->select('id = ' . $id)
            ->fetchObject(self::class);
    }
    public static function getRegioesID($id)
    {
        return (new Database('regioes'))->select('rotas_id = ' . $id)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public function atualizar()
    {
        return (new Database('regioes'))->update('id = ' . $this->id, [



            'nome'                   => $this->nome,
            'rotas_id'               => $this->rotas_id

        ]);
    }

    public function excluir()
    {
        return (new Database('regioes'))->delete('id = ' . $this->id);
    }


    public static function getUsuarioPorEmail($email)
    {

        return (new Database('regioes'))->select('email = "' . $email . '"')->fetchObject(self::class);
    }
}
