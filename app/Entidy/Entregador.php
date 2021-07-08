<?php

namespace App\Entidy;

use \App\Db\Database;

use \PDO;

class Entregador
{


    public $id;
    public $nome;
    public $telefone;
    public $email;
    public $banco;
    public $agencia;
    public $conta;
    public $usuarios_id;
    public $rotas_id;
    public $regioes_id;
    public $veiculos_id;


    public function cadastar()
    {


        $obdataBase = new Database('entregadores');

        $this->id = $obdataBase->insert([

            'nome'                   => $this->nome,
            'telefone'               => $this->telefone,
            'email'                  => $this->email,
            'banco'                  => $this->banco,
            'agencia'                => $this->agencia,
            'conta'                  => $this->conta,
            'usuarios_id'            => $this->usuarios_id,
            'rotas_id'               => $this->rotas_id,
            'regioes_id'             => $this->regioes_id,
            'veiculos_id'            => $this->veiculos_id

        ]);

        return true;
    }

    public static function getList($where = null, $order = null, $limit = null)
    {

        return (new Database('entregadores'))->select($where, $order, $limit)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }
    public static function getListEntregador($where = null, $order = null, $limit = null)
    {

        return (new Database('entregadores'))->selectEntregador($where, $order, $limit)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function getQtdEntregador($where = null)
    {

        return (new Database('entregadores'))->selectQtd($where, null, null, 'COUNT(*) as qtd')
            ->fetchObject()
            ->qtd;
    }

    public static function getQtd($where = null)
    {

        return (new Database('entregadores'))->select($where, null, null, 'COUNT(*) as qtd')
            ->fetchObject()
            ->qtd;
    }


    public static function getID($id)
    {
        return (new Database('entregadores'))->select('id = ' . $id)
            ->fetchObject(self::class);
    }

    public static function getEntreRotasID($id)
    {
        return (new Database('entregadores'))->selectID('e.regioes_id = ' . $id)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public function atualizar()
    {
        return (new Database('entregadores'))->update('id = ' . $this->id, [


            'nome'                   => $this->nome,
            'telefone'               => $this->telefone,
            'email'                  => $this->email,
            'banco'                  => $this->banco,
            'agencia'                => $this->agencia,
            'conta'                  => $this->conta,
            'usuarios_id'            => $this->usuarios_id,
            'rotas_id'               => $this->rotas_id,
            'regioes_id'             => $this->regioes_id,
            'veiculos_id'            => $this->veiculos_id
        ]);
    }

    public function excluir()
    {
        return (new Database('entregadores'))->delete('id = ' . $this->id);
    }


    public static function getUsuarioPorEmail($email)
    {

        return (new Database('entregadores'))->select('email = "' . $email . '"')->fetchObject(self::class);
    }
}
