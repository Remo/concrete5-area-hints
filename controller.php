<?php

namespace Concrete\Package\AreaHints;

use \Concrete\Core\Package\Package,
    \Concrete\Core\Page\Page,
    \Concrete\Core\Support\Facade\Events,
    Concrete\Core\Html\Service\Html,
    \Concrete\Core\View\View;

class Controller extends Package {

    protected $pkgHandle = 'area_hints';
    protected $appVersionRequired = '5.7';
    protected $pkgVersion = '1.0';

    public function getPackageName() {
        return t('Area Hints');
    }

    public function getPackageDescription() {
        return t('A simple package adding hints to indicate where areas are.');
    }

    public function on_start() {
        Events::addListener(
            'on_before_render', function () {
                $c = Page::getCurrentPage();
                if (is_object($c) && $c->isEditMode()) {
                    $view = View::getInstance();
                    $html = new Html();
                    $view->addHeaderItem(
                            $html->css(
                                    'area_hints.css', 'area_hints'
                            )
                    );
                }
            }
        );
    }

}
