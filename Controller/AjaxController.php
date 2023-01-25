<?php

namespace Kanboard\Plugin\JunkVolvo\Controller;

use Kanboard\Controller\BaseController;

class AjaxController extends BaseController
{
    public function getClientCars()
    {
        $client_id = $this->request->getStringParam('id');
        $client_exists = $this->clientsModel->exists($client_id);

        $client_cars = array_column($this->carsModel->getByClientId($client_id), 'name', 'id');
        $client_cars[0] = 'Не указана';

        $this->response->json($client_cars, $client_exists ? 200 : 404);
    }
}