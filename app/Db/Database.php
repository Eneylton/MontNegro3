<?php

namespace App\Db;

use \PDO;
use \PDOException;

class Database
{

    const HOST = 'localhost';
    const NAME = 'db_montenegro3';
    const USER = 'root';
    const PASS = '';


    private $table;

    /**
     * @var PDO
     */
    private $connection;


    public function __construct($table = null)
    {

        $this->table = $table;
        $this->setConnection();
    }

    private function setConnection()
    {

        try {
            $this->connection = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::NAME, self::USER, self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {

            die('ERROR: ' . $e->getMessage());
        }
    }


    /**
     * @param string
     * @param array
     * @return PDOStatement
     */

    public function execute($query, $params = [])
    {

        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement;
        } catch (PDOException $e) {

            die('ERROR: ' . $e->getMessage());
        }
    }



    public function select($where = null, $order = null, $limit = null, $fields = '*')
    {

        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

        $query = 'SELECT ' . $fields . ' FROM ' . $this->table . ' ' . $where . ' ' . $order . ' ' . $limit;

        return $this->execute($query);
    }

    
    public function selectEnt($where = null, $order = null, $limit = null, $fields = '*')
    {

        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

        $query = 'SELECT ' . $fields . ' FROM ' . $this->table . ' ' . $where . ' ' . $order . ' ' . $limit;

        return $this->execute($query);
    }


    public function selectEntregadores($where = null, $order = null, $limit = null, $fields = '*')
    {

        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

        $query = 'SELECT 
        l.id AS id,
        l.cod_id AS cod_id,
        l.data AS data,
        l.data_inicio AS data_inicio,
        l.data_fim AS data_fim,
        l.qtd AS qtd,
        e.nome AS entregadores,
        s.nome AS servicos,
        c.nome AS clientes,
        rg.nome AS regioes,
        l.servicos_id AS servicos_id,
        l.entregadores_id AS entregadores_id,
        l.clientes_id AS clientes_id,
        l.regioes_id AS regioes_id
    FROM
        logisticas AS l
            INNER JOIN
        entregadores AS e ON (l.entregadores_id = e.id)
            INNER JOIN
        servicos AS s ON (l.servicos_id = s.id)
            INNER JOIN
        clientes AS c ON (l.clientes_id = c.id)
            INNER JOIN
        regioes AS rg ON (l.regioes_id = rg.id)
        ' . $where . ' ' . $order . ' ' . $limit;

        return $this->execute($query);
    }


    public function selectRec($where = null, $order = null, $limit = null, $fields = '*')
    {

        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

        $query = 'SELECT 
        t.id as id,
        e.cod_id as codigo,
        t.nome as entregador,
        e.data as data_entrega,
        dev.data as data_devolucao,
        e.qtd as entrega,
        dev.qtd as devolucao,
        l.receber_id AS receber_id
    FROM
        entregadores AS t
            INNER JOIN
        entrega AS e ON (t.id = e.entregadores_id)
        INNER JOIN
        devolucao AS dev ON (t.id = dev.entregadores_id)
          INNER JOIN
        logisticas AS l ON (t.id = l.entregadores_id)
        ' . $where . ' ' . $order . ' ' . $limit;

        return $this->execute($query);
    }


    public function selectProducao($where = null, $order = null, $limit = null, $fields = '*')
    {

        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

        $query = 'SELECT 
        l.id AS id,
        l.cod_id AS cod_id,
        l.data AS data,
        l.data_inicio AS data_inicio,
        l.data_fim AS data_fim,
        l.qtd AS qtd,
        e.nome AS entregadores,
        s.nome AS servicos,
        c.nome AS clientes,
        rg.nome AS regioes,
        r.id AS receber,
        l.servicos_id AS servicos_id,
        l.entregadores_id AS entregadores_id,
        l.clientes_id AS clientes_id,
        l.regioes_id AS regioes_id
    FROM
        logisticas AS l
            INNER JOIN
        entregadores AS e ON (l.entregadores_id = e.id)
            INNER JOIN
        servicos AS s ON (l.servicos_id = s.id)
            INNER JOIN
        clientes AS c ON (l.clientes_id = c.id)
            INNER JOIN
        regioes AS rg ON (l.regioes_id = rg.id)
         INNER JOIN
        receber AS r ON (l.receber_id = r.id)
        ' . $where . ' ' . $order . ' ' . $limit;

        return $this->execute($query);
    }


    public function selectEstatistica1($where = null, $order = null, $limit = null, $fields = '*')
    {

        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

        $query = 'SELECT 
        et.nome as entregadores,
        eg.qtd as entregas,
        dev.qtd as devolucao,
        (eg.qtd + dev.qtd) AS total
        
    FROM
        entregadores AS et
            INNER JOIN
        entrega AS eg ON (et.id = eg.entregadores_id)
            INNER JOIN
        devolucao AS dev ON (et.id = dev.entregadores_id) group by et.nome
        ' . $where . ' ' . $order . ' ' . $limit;

        return $this->execute($query);
    }

    public function selectEstatistica2($where = null, $order = null, $limit = null, $fields = '*')
    {

        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

        $query = 'SELECT 
        o.nome as ocorrencias,
        sum(dev.qtd ) as total
        
    FROM
        devolucao AS dev
            INNER JOIN
        entregadores AS e ON (dev.entregadores_id = e.id)
            INNER JOIN
        ocorrencias AS o ON (dev.ocorrencias_id = o.id) group by o.nome
        ' . $where . ' ' . $order . ' ' . $limit;

        return $this->execute($query);
    }


    public function selectClientes($where = null, $order = null, $limit = null, $fields = '*')
    {

        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

        $query = 'SELECT 
        cli.id AS id,
        cli.nome AS nome,
        s.nome AS servicos,
        st.nome AS setores,
        cli.servicos_id as servicos_id,
        cli.setores_id as setores_id
        FROM
        clientes AS cli
        INNER JOIN
        servicos AS s ON (cli.servicos_id = s.id)
        INNER JOIN
        setores AS st ON (cli.setores_id = st.id)
        ' . $where . ' ' . $order . ' ' . $limit;

        return $this->execute($query);
    }


    public function selectReceber($where = null, $order = null, $limit = null, $fields = '*')
    {

            $where = strlen($where) ? 'WHERE ' . $where : '';
            $order = strlen($order) ? 'ORDER BY ' . $order : '';
            $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

            $query = 'SELECT 
            r.id AS id,
            r.data AS data,
            r.qtd AS qtd,
            r.recebido AS recebido,
            cli.nome AS cliente
            FROM
            receber AS r
            INNER JOIN
            clientes AS cli ON (r.clientes_id = cli.id)
            ' . $where . ' ' . $order . ' ' . $limit;

        return $this->execute($query);
    }

    public function selectEntregas($where = null, $order = null, $limit = null, $fields = '*')
    {

        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

        $query = 'SELECT 
        t.nome AS nome, e.data AS data, SUM(e.qtd) AS total
        FROM
        entrega AS e
        INNER JOIN
        entregadores AS t ON (e.entregadores_id = t.id) 
        ' . $where . ' group by MONTH(e.data) ' . $order . ' ' . $limit . ' ';

        return $this->execute($query);
        }


    public function selectDevID($where = null, $order = null, $limit = null, $fields = '*')
    {

        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

        $query = 'SELECT 
        dev.data as data,
        t.nome as entregador,
        dev.qtd as total
        FROM
        devolucao AS dev
        INNER JOIN
        entregadores AS t ON (dev.entregadores_id = t.id)
        ' . $where . ' AND month(dev.data) = MONTH(CURRENT_DATE()) ' . $order . ' ' . $limit . ' ';

        return $this->execute($query);
        }


    public function selectDevOc($where = null, $order = null, $limit = null, $fields = '*')
    {

        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

        $query = 'SELECT 
        o.nome as nome,
        dev.qtd as total
    FROM
        devolucao AS dev
            INNER JOIN
        ocorrencias AS o ON (o.id = dev.ocorrencias_id)
        INNER JOIN
        entregadores AS e ON (e.id = dev.entregadores_id)
        ' . $where . ' AND month(dev.data) = MONTH(CURRENT_DATE()) group by o.nome' . $order . ' ' . $limit . ' ';

        return $this->execute($query);
        }


    public function selectDevDia($where = null, $order = null, $limit = null, $fields = '*')
    {

        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

        $query = 'SELECT 
        e.qtd as total
        FROM
        devolucao AS e
        INNER JOIN
        entregadores AS t ON (e.entregadores_id = t.id)
        ' . $where . ' AND e.data >= current_date() ' . $order . ' ' . $limit . ' ';

        return $this->execute($query);
        }


        public function selectEntreID($where = null, $order = null, $limit = null, $fields = '*')
        {
    
            $where = strlen($where) ? 'WHERE ' . $where : '';
            $order = strlen($order) ? 'ORDER BY ' . $order : '';
            $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

            $query = 'SELECT 
            e.data as data,
            t.nome as entregador,
            e.qtd as total
            FROM
            entrega AS e
            INNER JOIN
            entregadores AS t ON (e.entregadores_id = t.id)
            ' . $where . ' AND month(e.data) = MONTH(CURRENT_DATE())' . $order . ' ' . $limit . ' ';

            return $this->execute($query);
            }

        public function selectEntreTotal($where = null, $order = null, $limit = null, $fields = '*')
        {
    
            $where = strlen($where) ? 'WHERE ' . $where : '';
            $order = strlen($order) ? 'ORDER BY ' . $order : '';
            $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

            $query = 'SELECT 
            sum(e.qtd) as total
            FROM
            entrega AS e
            INNER JOIN
            entregadores AS t ON (e.entregadores_id = t.id)
            ' . $where . ' AND e.data >= current_date()' . $order . ' ' . $limit . ' ';

            return $this->execute($query);
            }


    public function selectEntregador($where = null, $order = null, $limit = null, $fields = '*')
    {

        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

        $query = 'SELECT 
        e.id as id,
        e.nome as nome,
        e.telefone as telefone,
        e.email as email,
        e.banco as banco,
        e.agencia as agencia,
        e.conta as conta,
        e.rotas_id as rotas_id,
        e.regioes_id as regioes_id,
        e.veiculos_id as veiculos_id,
        r.descricao as rota,
        re.nome as regiao,
        v.nome as veiculo
        FROM
        entregadores AS e
            INNER JOIN
        rotas AS r ON (e.rotas_id = r.id)
            INNER JOIN
        regioes AS re ON (e.regioes_id = re.id)
         INNER JOIN
        veiculos AS v ON (e.veiculos_id = v.id)
        ' . $where . ' ' . $order . ' ' . $limit;

        return $this->execute($query);
    }

    public function selectQtd($where = null, $order = null, $limit = null, $fields = '*')
    {
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';


        $query = 'SELECT ' . $fields . '
        
        FROM
        entregadores AS e
        INNER JOIN
        rotas AS r ON (e.rotas_id = r.id)
        INNER JOIN
        regioes AS re ON (e.regioes_id = re.id)
        INNER JOIN
        veiculos AS v ON (e.veiculos_id = v.id)
            ' . $where . ' ' . $order . ' ' . $limit;

        return $this->execute($query);
    }


    public function selectID($where = null, $order = null, $limit = null, $fields = '*')
    {
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';


        $query = 'SELECT 
        e.id AS id, 
        r.descricao AS rota, 
        e.nome AS entregadores,
        rg.nome AS regiao
        FROM
        entregadores AS e
        INNER JOIN
        rotas AS r ON (e.rotas_id = r.id)
        INNER JOIN
        regioes AS rg ON (e.rotas_id = rg.id)
            ' . $where . ' ' . $order . ' ' . $limit;

        return $this->execute($query);
    }


    public function selectQtdClientes($where = null, $order = null, $limit = null, $fields = '*')
    {
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';


        $query = 'SELECT ' . $fields . '
        
        FROM
        clientes AS cli
        INNER JOIN
        servicos AS s ON (cli.servicos_id = s.id)
        INNER JOIN
        setores AS st ON (cli.setores_id = st.id)
            ' . $where . ' ' . $order . ' ' . $limit;

        return $this->execute($query);
    }

    public function selectQtdEntregadores($where = null, $order = null, $limit = null, $fields = '*')
    {
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';


        $query = 'SELECT ' . $fields . '
        
        FROM
        logisticas AS l
            INNER JOIN
        entregadores AS e ON (l.entregadores_id = e.id)
            INNER JOIN
        servicos AS s ON (l.servicos_id = s.id)
            INNER JOIN
        clientes AS c ON (l.clientes_id = c.id)
            INNER JOIN
        regioes AS rg ON (l.regioes_id = rg.id)
            ' . $where . ' ' . $order . ' ' . $limit;

        return $this->execute($query);
    }





    public function insert($values)
    {

        $fields = array_keys($values);
        $binds  = array_pad([], count($fields), '?');

        $query = 'INSERT INTO ' . $this->table . ' (' . implode(',', $fields) . ') VALUE (' . implode(',', $binds) . ')';

        $this->execute($query, array_values($values));

        return $this->connection->lastInsertId();
    }

    public function update($where, $values)
    {

        $fields = array_keys($values);

        $query = 'UPDATE ' . $this->table . ' SET ' . implode('=?,', $fields) . '=? WHERE ' . $where;
        $this->execute($query, array_values($values));
        return true;
    }


    public function delete($where)
    {

        $query = 'DELETE FROM ' . $this->table . ' WHERE ' . $where;
        $this->execute($query);
        return true;
    }

    public function qtdRegiao($where = null, $order = null, $limit = null, $fields = '*')
    {
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';


        $query = 'SELECT ' . $fields . '
        
        FROM
        regioes AS re
            INNER JOIN
        rotas AS ro ON (re.rotas_id = ro.id)
            ' . $where . ' ' . $order . ' ' . $limit;

        return $this->execute($query);
    }


    public function innerjoin($where = null, $order = null, $limit = null, $fields = '*')
    {

        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

        $query = 'SELECT 
        re.id as id,
        re.nome as nome,
        re.rotas_id as rotas_id ,
        ro.descricao as descricao
        FROM
        regioes AS re
            INNER JOIN
        rotas AS ro ON (re.rotas_id = ro.id)
        ' . $where . ' ' . $order . ' ' . $limit;

        return $this->execute($query);
    }
}
