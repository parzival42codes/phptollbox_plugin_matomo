<?php declare(strict_types=1);


class PluginMatomo_install extends ContainerFactoryModulInstall_abstract
{


    public function install(): void
    {
        $this->importLanguage();
        $this->importConfig();

        $this->installFunction(function () {
            /** @var array $data */ /*$before*/

            /** @var ContainerExtensionTemplateLoad_cache_template $templateCache */
            $templateCache = Container::get('ContainerExtensionTemplateLoad_cache_template',
                                            'PluginMatomo',
                                            'install.privacy');

            $crud = new ContainerExtensionTemplateParseInsertPositions_crud();
            $crud->setCrudPosition('/Content/Privacy/Additional');
            $crud->setCrudClass('PluginMatomo');
            $crud->setCrudContent($templateCache->get()['install.privacy']);

            $progressData['message'] = $crud->insertUpdate();

            /*$after*/
        });

        $this->setEvent('/ContainerIndexPage/Template/Positions',
                        'PluginMatomo_event',
                        'insertPositionHeaderJavascript');

        $this->setEvent('/Core/Index/Header',
                        'PluginMatomo_event',
                        'setHeader');

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
