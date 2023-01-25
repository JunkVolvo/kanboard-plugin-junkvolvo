<?php

namespace Kanboard\Plugin\JunkVolvo\Model;

use Kanboard\Model\TaskModificationModel;

class NewTaskModificationModel extends TaskModificationModel
{
    public function update(array $values, $fire_events = true): bool
    {
        $meta = array();

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

        $this->taskMetadataModel->save($values['id'], $meta);

        return parent::update($values, $fire_events);
    }
}