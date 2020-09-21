<?php
/**
 * SidebarSetupMenuDemoListener.php
 * avanzu-admin
 * Date: 23.02.14
 */

namespace App\EventListener;


use KevinPapst\AdminLTEBundle\Event\SidebarMenuEvent;
use KevinPapst\AdminLTEBundle\Model\MenuItemModel;
use Symfony\Component\HttpFoundation\Request;

class SidebarSetupMenuListener
{
    private $lignesDir;
    
    private $deviationsDir;
    
    private $horairesDir;
    
    private $informationsDir;

    public function onSetupMenu(SidebarMenuEvent $event)
    {
        $request = $event->getRequest();

        foreach ($this->getMenu($request) as $item) {
            $event->addItem($item);
        }

    }


    protected function getMenu(Request $request)
    {
        $rootItems = array(
            new MenuItemModel('dashboard', 'Accueil', 'home', array(), 'fa fa-dashboard'),
            new MenuItemModel('lignes', 'Plans de lignes', 'oziolab_bibus_bundle_walk', 
                array('path' => $this->lignesDir), 
                'fa fa-map-marker'
            ),
            new MenuItemModel('deviations', 'Déviations', 'oziolab_bibus_bundle_walk', 
                array('path' => $this->deviationsDir), 
                'fa fa-level-up'
            ),
            new MenuItemModel('horaires', 'Navettes', 'oziolab_bibus_bundle_walk', 
                array('path' => $this->horairesDir), 
                'fa fa-clock-o'
            ),
//            new MenuItemModel('contact', 'Contact', 'oziolab_bibus_contact', array(), 'fa fa-envelope'),
            new MenuItemModel('echo', 'ECHO', 'oziolab_bibus_echo_redirect', array(), 'fa fa-list'),
            //new MenuItemModel('informations', 'Echange de tours', 'oziolab_bibus_bundle_walk', 
			new MenuItemModel('informations', 'Echange de tours', 'https://monkiosque.ratpdev.com/bibus/_login/', 
               // array('path' => $this->informationsDir), 
                'fa fa-info-circle'
            ),
//            new MenuItemModel('aide', 'Aide à l\'utilisation', 'oziolab_bibus_help', array(), 'fa fa-question-circle'),        
            new MenuItemModel('aide', 'Planning évènementiel', 'https://docs.google.com/spreadsheets/d/1MXn2cCLe3r7XgbYKhA3D6ROZCRnjKxjAIVw0kmvHNY8/edit#gid=1423524341', array(), 'fa fa-calendar'),        
        );
        
        return $this->activateByRoute($request->get('_route'), $rootItems);

    }

    protected function activateByRoute($route, $items) {
        return $items;
    }
    
    public function setLignesDir($dir)
    {
        $this->lignesDir = $dir;
    }

    public function setDeviationsDir($dir)
    {
        $this->deviationsDir = $dir;
    }
    
    public function setHorairesDir($dir)
    {
        $this->horairesDir = $dir;
    }

    function setInformationsDir($informationsDir)
    {
        $this->informationsDir = $informationsDir;
    }
}