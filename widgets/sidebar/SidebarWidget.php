<?php
namespace app\widgets\sidebar;

use yii\widgets\Menu;

class SidebarWidget extends Menu
{
    public $submenuTemplate = "\n<ul class=\"nav-children\">\n{items}\n</ul>\n";
    public $options = ['class' => 'side-bar-menu'];
    public $activateParents = true;
    public $encodeLabels = false;

    public function init()
    {
        $this->items = [
            ['label' => '首页', 'url' => ['site/index']],
            ['label' => '<a href="#">管理员管理</a>', 'options' => ['class' => 'nav-parent'], 'items' => [
                ['label' => '管理员列表', 'url' => ['/site/listadmin'], 'options' => ['class' => 'nav-parent'], 'items' => [
                    ['label' => '修改管理员', 'url' => ['/site/updateadmin'], 'visible' => false],
                ]],
                ['label' => '添加管理员', 'url' => ['/site/reg']]
            ]],
            ['label' => '<a href="#">图文小程序</a>', 'options' => ['class' => 'nav-parent'], 'items' => [
                
            ]],
        ];
    }
    protected function normalizeItems($items, &$active)
    {
        foreach ($items as $i => $item) {
            if (!isset($item['label'])) {
                $item['label'] = '';
            }
            $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
            $items[$i]['label'] = $encodeLabel ? Html::encode($item['label']) : $item['label'];
            $hasActiveChild = false;
            if (isset($item['items'])) {
                $items[$i]['items'] = $this->normalizeItems($item['items'], $hasActiveChild);
                if (empty($items[$i]['items']) && $this->hideEmptyItems) {
                    unset($items[$i]['items']);
                    if (!isset($item['url'])) {
                        unset($items[$i]);
                        continue;
                    }
                }
            }
            if (!isset($item['active'])) {
                if ($this->activateParents && $hasActiveChild || $this->activateItems && $this->isItemActive($item)) {
                    $active = $items[$i]['active'] = true;
                } else {
                    $items[$i]['active'] = false;
                }
            } elseif ($item['active']) {
                $active = true;
            }

            if (isset($item['visible']) && !$item['visible']) {
                unset($items[$i]);
                continue;
            }
        }

        return array_values($items);
    }
}
