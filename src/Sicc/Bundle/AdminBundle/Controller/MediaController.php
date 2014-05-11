<?php

namespace Sicc\Bundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
class MediaController extends Controller
{

    protected $uploadDir;
    protected $file;
    protected $path;



    public function listAction($rootdirname,$types)
    {
        $finder = new Finder();
        $finder->files()->in($this->getWebDir($rootdirname));
        $finder = $this->getType($finder,$types);
        $folders = array();
        $folder= '';

        foreach ($finder as $file) {
            $folder = $file->getRelativePath();
            $folders[$folder][] =str_replace(['//','\\'],'/','/'.$rootdirname.'/'.$file->getRelativePathname()) ;
        }
        $response = new Response();

          $response->headers->set('Content-Type', 'application/json');
        return $this->render('SiccAdminBundle:Media:list.html.twig',array(
            'folders' => $folders
        ));
    }
    public function addAction(Request $request)
    {
        $folder =  $request->request->get('folder');
        $this->file = $request->files->get('file');
        $this->path = $this->setUploadDir($folder);
        $this->file->move($this->getUploadRootDir(),$this->file->getClientOriginalName());
        $this->path = $this->file->getClientOriginalName();

        return new Response('/'.$this->getWebPath());

    }

    private function getWebDir($rootdirname){

        return __DIR__.'/../../../../web/'.$rootdirname;
    }

    private function getType(Finder $finder,$type){
        switch($type){
            case 'pictures':
                $finder->name('*.png')->name('*.jpg')->name('*.jpeg')->name('*.gif');
        }
        return $finder;
    }

    public function getAbsolutePath()
    {
        return null === $this->path ? null : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path ? null : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        return 'media/'.$this->uploadDir;
    }
    protected function setUploadDir($uploadDir){
        $this->uploadDir = $uploadDir;
    }
    public function setFile($file)
    {
        $this->file = $file;
    }

    public function getFile()
    {
        return $this->file;
    }


}
