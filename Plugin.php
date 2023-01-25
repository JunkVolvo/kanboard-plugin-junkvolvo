<?php

namespace Kanboard\Plugin\JunkVolvo;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Security\Role;
use Kanboard\Model\TaskMetadataModel;
use Kanboard\Plugin\JunkVolvo\Model\NewTaskModificationModel;
use Kanboard\Plugin\JunkVolvo\Model\NewTaskCreationModel;

class Plugin extends Base
{
    public function initialize()
    {
        //Helpers
        $this->helper->register('renderHelper', '\Kanboard\Plugin\JunkVolvo\Helper\RenderHelper');

        $this->container['taskModificationModel'] = $this->container->factory(function ($c) {
            return new NewTaskModificationModel($c);
        });

        $this->container['taskCreationModel'] = $this->container->factory(function ($c) {
            return new NewTaskCreationModel($c);
        });

        $this->template->hook->attach('template:task:form:first-column', 'JunkVolvo:task/form');
        $this->template->hook->attach('template:board:task:footer', 'JunkVolvo:board/task_footer');

        $this->hook->on('template:layout:js', ['template' => 'plugins/JunkVolvo/Assets/js/jvForm.js']);

        $container = $this->container;
        $duplicateFunc = function (array $hook_values) use ($container) {
            $taskMetadataModel = new TaskMetadataModel($container);

            $meta = [];
            $meta['jv_client'] = $taskMetadataModel->get($hook_values['source_task_id'], 'jv_client');
            $meta['jv_car'] = $taskMetadataModel->get($hook_values['source_task_id'], 'jv_car');
            $meta['jv_profit'] = $taskMetadataModel->get($hook_values['source_task_id'], 'jv_profit');
            array_filter($meta, function ($it) {
                return $it != '';
            });

            $taskMetadataModel->save($hook_values['destination_task_id'], $meta);
        };

        $this->hook->on('model:task:duplication:aftersave', $duplicateFunc);
        $this->hook->on('model:task:project_duplication:aftersave', $duplicateFunc);

        $this->projectAccessMap->add('JunkVolvoAjaxController', ['getClientCars'], Role::PROJECT_MEMBER);
    }

    public function getClasses()
    {
        return [
            'Plugin\JunkVolvo\Model' => [
                'ClientsModel',
                'CarsModel',
            ]
        ];
    }

    public function getPluginName()
    {
        return 'JunkVolvo';
    }

    public function getPluginAuthor()
    {
        return 'Dmitry Pankov';
    }

    public function getCompatibleVersion()
    {
        return '>=1.2.26';
    }
}