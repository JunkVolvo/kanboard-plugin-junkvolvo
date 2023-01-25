<?php

namespace Kanboard\Plugin\JunkVolvo\Model;

use Kanboard\Model\TaskCreationModel;

class NewTaskCreationModel extends TaskCreationModel
{
    public function create(array $values): int
    {
        $meta = [];

        if (isset($values['jv_client'])) {
            $meta['jv_client'] = $values['jv_client'];
            unset($values['jv_client']);
        }

        if (isset($values['jv_car'])) {
            $meta['jv_car'] = $values['jv_car'];
            unset($values['jv_car']);
        }

        if (isset($values['jv_profit'])) {
            $meta['jv_profit'] = $values['jv_profit'];
            unset($values['jv_profit']);
        }

        $task_id = parent::create($values);

        $this->taskMetadataModel->save($task_id, $meta);

        return $task_id;
    }
}