<?php declare(strict_types=1);


class PluginMatomo_install extends ContainerFactoryModulInstall_abstract
{


    public function install(): void
    {
        $this->importLanguage();

        $this->installFunction(function () {
            /** @var array $data */ /*$before*/

            /** @var ContainerExtensionTemplateLoad_cache_template $templateCache */
            $templateCache = Container::get('ContainerExtensionTemplateLoad_cache_template',
                                            'PluginMatomo',
                                            'install.privacy');

            $crud = new ContainerExtensionTemplateParseInsertPositions_crud();
            $crud->setCrudPosition('/Content/Privacy/Additional');
            $crud->setCrudClass('PluginMatomo');
            $crud->setCrudContent($templateCache->getCacheContent()['install.privacy']);

            $progressData['message'] = $crud->insertUpdate();

            /*$after*/
        });

        $this->installFunction(function () {
            /** @var array $data */ /*$before*/

            /** @var Event_crud $crud */
            $crud = Container::get('Event_crud');
            $crud->setCrudPath('/ContainerIndexPage/Template/Positions');
            $crud->setCrudTriggerClass('PluginMatomo_event');
            $crud->setCrudTriggerMethod('insertPositionHeaderJavascript');

            $progressData['message'] = $crud->insert();;


            /*$after*/
        });
    }

    public function uninstall(): void
    {
        $this->removeStdEntities();
    }

    public function activate(): void
    {
    }

    public function deactivate(): void
    {
        $this->removeStdEntitiesDeactivate();
    }


}
