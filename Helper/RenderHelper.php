<?php

namespace Kanboard\Plugin\JunkVolvo\Helper;

use Kanboard\Core\Base;

class RenderHelper extends Base
{
    public function renderTaskForm(array $task)
    {
        $task_id = 0;
        if (isset($task['id']))
            $task_id = $task['id'];

        $html = '';

        // Клиенты
        $client = $this->taskMetadataModel->get($task_id, 'jv_client', '0');
        $clients = array_column($this->clientsModel->getAll(), 'name', 'id');
        array_unshift($clients, 'Не указан');

        $html .= $this->helper->form->label("Клиент", 'jv_client');
        $html .= $this->helper->form->select('jv_client', $clients, ['jv_client' => $client], [], [], 'form-input-small');

        // Машины
        $client_car = $this->taskMetadataModel->get($task_id, 'jv_car', '0');

        $client_cars = array_column($this->carsModel->getByClientId($client), 'name', 'id');
        $client_cars[0] = 'Не указана';
        if (!array_key_exists($client_car, $client_cars))
            $client_car = 0;

        $html .= $this->helper->form->label("Машина", 'jv_car');
        $html .= $this->helper->form->select('jv_car', $client_cars, ['jv_car' => $client_car], [], [], 'form-input-small');

        // Прибыль
        $profit = $this->taskMetadataModel->get($task_id, 'jv_profit', '0');

        $html .= $this->helper->form->label("Прибыль", 'jv_profit');
        $html .= $this->helper->form->number('jv_profit', ['jv_profit' => $profit], [], [], 'form-input-small');

        return $html;
    }

    public function renderTaskFooter(array $task)
    {
        $task_id = 0;
        if (isset($task['id']))
            $task_id = $task['id'];

        $client_id = $this->taskMetadataModel->get($task_id, 'jv_client', '0');
        $client = $this->clientsModel->getNameById($client_id);

        $client_car_id = $this->taskMetadataModel->get($task_id, 'jv_car', '0');
        $client_car = $this->carsModel->getNameById($client_car_id);

        $html = '';

        if ($client != null)
            $html .= $this->helper->form->label($client, 'jv_task_client_' . $task_id);

        if ($client_car != null)
            $html .= $this->helper->form->label($client_car, 'jv_task_car_' . $task_id);

        return $html;
    }
}