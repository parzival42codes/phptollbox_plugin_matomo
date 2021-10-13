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
            $template->set($templateCache->get()['header']);
            $template->assign('url',
                              (string)Config::get('/PluginMatomo/url'));
            $template->parse();
            ContainerExtensionTemplateParseInsertPositions::insert('/ContainerIndexPage/Template/Positions/Head/Javascript',
                                                                   $template->get());
        }

        ContainerExtensionTemplateParseInsertPositions::insert('/Page/CookieBanner/list',
                                                               ContainerFactoryLanguage::get('/PluginMatomo/cookieBanner/text'));

    }

    public static function setHeader($triggering, $object, &$scope): void
    {
        $scope['headerCMS']['connect-src'][] = (string)Config::get('/PluginMatomo/url');
        $scope['headerCMS']['script-src'][] = (string)Config::get('/PluginMatomo/url');
        $scope['headerCMS']['img-src'][] = (string)Config::get('/PluginMatomo/url');
    }
}
