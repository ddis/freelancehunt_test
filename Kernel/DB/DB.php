<?php


namespace Kernel\DB;

use PDO;

/**
 * Class DB
 *
 * @package kernel\DB
 */
abstract class DB
{
    private $pdo = null;

    /**
     * DB constructor.
     */
    public function __construct()
    {
        $this->pdo = PDOProvider::getInstance();
    }

    abstract public static function tableName(): string;

    /**
     * @param $query
     *
     * @return bool
     */
    public function query($query): bool
    {
        $sth = $this->pdo->prepare($query);

        return $sth->execute();
    }

    /**
     * @param string $query
     * @param array  $bindParams
     * @param int    $fetchMod
     *
     * @return array
     */
    public function select(string $query, array $bindParams = [], $fetchMod = PDO::FETCH_ASSOC): array
    {
        $sth = $this->pdo->prepare($query);
        foreach ($bindParams as $key => $value) {
            $sth->bindValue(":$key", $value);
        }
        $sth->execute();

        return $sth->fetchAll($fetchMod);
    }

    /**
     * @param array $data
     * @param array $keys
     * @param bool  $ignore
     * @return bool
     */
    public function batchInsert(array $data, array $keys = [], bool $ignore = false)
    {
        if (!$keys) {
            $keys = static::saveFields();
        }

        $keys = implode(", ", $keys);

        $values = array_map(function ($item) {
            return '"' . implode('","', $item) . '"';
        }, $data);

        $values = "(" . implode("),(", $values) . ")";

        $sql = "INSERT " . ($ignore ? "IGNORE " : "") . "INTO " . static::tableName() . " ({$keys}) VALUES {$values}";

        return $this->query($sql);
    }

    /**
     * @return bool
     */
    public function clearData()
    {
        return $this->query("DELETE FROM " . static::tableName());
    }

    /**
     * @param array $bindParams
     * @param int   $fetchMod
     *
     * @return array
     */
    public function findAll(array $bindParams = [], $fetchMod = PDO::FETCH_ASSOC)
    {
        $sth = $this->find($bindParams);

        $sth->execute();

        return $sth->fetchAll($fetchMod);
    }

    /**
     * @param array $bindParams
     * @param int   $fetchMod
     *
     * @return array
     */
    public function findOne(array $bindParams = [], $fetchMod = PDO::FETCH_ASSOC)
    {
        $sth = $this->find($bindParams);

        $sth->execute();

        return $sth->fetch($fetchMod);
    }

    /**
     * @param array $data
     * @param bool  $ignore
     * @return bool
     */
    public function insert(array $data, bool $ignore = false): bool
    {
        $fields = implode('`, `', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));

        $query = "INSERT " . ($ignore ? "IGNORE " : "") . static::tableName() . " (`$fields`) VALUES ($values)";
        $sth   = $this->pdo->prepare($query);

        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }

        return $sth->execute();
    }

    /**
     * @param array  $data
     * @param string $where
     *
     * @return mixed
     */
    public function update(array $data, string $where)
    {
        $fields = array_map(function ($item) {
            return "`$item`=:$item";
        }, array_keys($data));

        $query = "UPDATE " . static::tableName() . " SET " . implode(', ', $fields) . " WHERE $where";

        $sth = $this->pdo->prepare($query);
        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }

        return $sth->execute();
    }

    /**
     * @param array $params
     * @return int
     */
    public function total($params = [])
    {
        $res = $this->find($params, "COUNT(id) as total");

        $res->execute();

        $total = $res->fetch(PDO::FETCH_ASSOC);

        return $total['total'] ?? 0;
    }

    /**
     * @param $where
     *
     * @return int
     */
    public function delete($where)
    {
        $query = "DELETE FROM " . static::tableName() . " WHERE $where";

        return $this->pdo->exec($query);
    }

    /**
     * @return mixed
     */
    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }

    /**
     * @param array  $bindParams
     * @param string $select
     *
     * @return bool|\PDOStatement
     */
    private function find(array $bindParams = [], $select = "*")
    {
        $params = array_map(function ($item) {
            return $item . " = :" . $item;
        }, array_keys($bindParams));

        $where = $params ? " WHERE " . implode(" AND ", $params) : "";

        $sth = $this->pdo->prepare("SELECT {$select} FROM " . static::tableName() . $where);

        foreach ($bindParams as $key => $value) {
            $sth->bindValue(":$key", $value);
        }

        return $sth;
    }
}
