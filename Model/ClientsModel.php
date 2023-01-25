<?php

namespace Kanboard\Plugin\JunkVolvo\Model;

use Kanboard\Core\Base;

class ClientsModel extends Base
{
    const TABLE = 'jv_clients';

    public function getAll() : array
    {
        return $this->db->table(self::TABLE)
            ->asc('name')
            ->findAll();
    }

    public function getNameById(int $id) : ?string
    {
        $client = $this->db->table(self::TABLE)
            ->eq('id', $id)
            ->findOne();

        if($client == null)
            return null;
        else
            return $client['name'];
    }

    public function exists(int $id) : bool
    {
        $client = $this->db->table(self::TABLE)
            ->eq('id', $id)
            ->findOne();

        return $client != null;
    }

    public function getIdByName(string $name) : ?int
    {
        $client = $this->db->table(self::TABLE)
            ->eq('name', $name)
            ->findOne();

        if($client == null)
            return null;
        else
            return $client['id'];
    }
}