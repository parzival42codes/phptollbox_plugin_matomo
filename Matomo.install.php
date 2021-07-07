<?php declare(strict_types=1);


class PluginMatomo_install extends ContainerFactoryModulInstall_abstract
{


    public function install(): void
    {

    }

    public function uninstall(): void
    {
        $this->removeStdEntities();
    }

    public function activate(): void
    {
        $this->importRoute();
        $this->importMenu();
        $this->importLanguage();
    }

    public function deactivate(): void
    {
        $this->removeStdEntitiesDeactivate();
    }


}
