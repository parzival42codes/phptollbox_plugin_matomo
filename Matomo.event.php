<?php

class PluginMatomo_event extends Base
{
    public static function insertPositionHeaderJavascript(): void
    {
        $container = Container::DIC();

        if ($container->getDIC('/Cookie/CookieBanner/value')) {
            $templateCache = new ContainerExtensionTemplateLoad_cache_template(Core::getRootClass(__CLASS__),
                                                                               'header');
            $template      = new ContainerExtensionTemplate();
            $template->set($templateCache->getCacheContent()['header']);
            $template->assign('url',
                              (string)Config::get('/environment/config/custom/plugin/matomo/url'));
            $template->parse();
            ContainerExtensionTemplateParseInsertPositions::insert('/Page/header/javascript',
                                                                   $template->get());
        }

        ContainerExtensionTemplateParseInsertPositions::insert('/Page/CookieBanner/list',
                                                               ContainerFactoryLanguage::get('/PluginMatomo/cookieBanner/text'));


    }
}
