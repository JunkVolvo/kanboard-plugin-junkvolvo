<?php

namespace Kanboard\Plugin\JunkVolvo\Model;

use Kanboard\Core\Base;

class CarsModel extends Base
{
    const TABLE = 'jv_cars';

    public function getAll() : array
    {
        return $this->db->table(self::TABLE)
            ->findAll();
    }

    public function getByClientId(int $client_id) : array
    {
        return $this->db->table(self::TABLE)
            ->eq('client_id', $client_id)
            ->findAll();
    }

    public function getNameById(int $car_id) : ?string
    {
        $car = $this->db->table(self::TABLE)
            ->eq('id', $car_id)
            ->findOne();

        if($car == null)
            return null;
        else
            return $car['name'];
    }
}