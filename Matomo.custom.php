<?php
declare(strict_types=1);

/**
 * @modul Matomo
 * @modul Matomo
 * @modul author Stefan Schlombs
 * @modul versionRequiredSystem 1.0.0
 *
 */
class PluginMatomo_custom extends Custom_abstract
{
    protected array $iniData = [];

    public function __construct()
    {
        /** @var ContainerFactoryLanguageParseIni $iniLang */
        $iniLang = Container::get('ContainerFactoryLanguageParseIni',
                                  '
[de_DE]
name="Matomo"
description="Matomo"
        ');

        $this->iniData = $iniLang->get();
    }

    public function getName(): string
    {
        return $this->iniData['name'];
    }

    public function getDescription(): string
    {
        return $this->iniData['description'];
    }

    public function getDependencies(): array
    {
        return [
            'PluginMatomo',
        ];
    }

}
