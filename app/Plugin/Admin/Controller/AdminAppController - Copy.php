<?php
const IMAGE_HANDLERS = [
    IMAGETYPE_JPEG => [
        'load' => 'imagecreatefromjpeg',
        'save' => 'imagejpeg',
        'quality' => 100
    ],
    IMAGETYPE_PNG => [
        'load' => 'imagecreatefrompng',
        'save' => 'imagepng',
        'quality' => 0
    ],
    IMAGETYPE_GIF => [
        'load' => 'imagecreatefromgif',
        'save' => 'imagegif'
    ]
];

App::uses('AppController', 'Controller');
//App::uses('Session', 'Controller/Component/Auth');

class AdminAppController extends AppController {

    public $components = array(
        'Flash',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'users',
                'action' => 'dashboad'
            ),
            'logoutRedirect' => array(
                'action' => 'index',
                'plugin'=>'admin'
                
            ),
            'authenticate' => array(
                'Form' => array(
                    'passwordHasher' => 'Blowfish'
                )
               
            )
        )
    );
   
    public function beforeFilter() {
        // echo $this->Auth->user(); die;   
        $this->Auth->autoRedirect = false;
        $this->Auth->allow('index','forgot_password');
        /*if(empty($this->Session->read("UserData"))){
            session_destroy();
            $this->Auth->allow('index','forgot_password');
        }*/
        
    }
    public function checklogin(){
        /*$userinfo  = $this->Session->read("UserData");
        pr($userinfo); die;*/
        if(!$this->Auth->user()){
            $this->redirect(array('controller'=>'admin','action' => 'index','plugin'=>'admin'));
        }
        $this->loadModel('Admin.SiteSettings');
        $siteData =  $this->SiteSettings->find('first');
        $favicon="";
        if(!empty($siteData)){
            $favicon =  Configure::read('AbsoluteUrl').'SiteSettings/'.$siteData['SiteSettings']['favion'];
            $siteLogo =  Configure::read('AbsoluteUrl').'SiteSettings/'.$siteData['SiteSettings']['logo'];
        }
        $this->set(compact('favicon'));
        Configure::write('favicon', $favicon);
        Configure::write('siteLogo', $siteLogo);
        Configure::write('SiteTitle', $siteData['SiteSettings']['title']);
       
    }

    function createThumbnail($src, $dest, $targetWidth, $targetHeight = null) {

        // 1. Load the image from the given $src
        // - see if the file actually exists
        // - check if it's of a valid image type
        // - load the image resource
    
        // get the type of the image
        // we need the type to determine the correct loader
        $type = exif_imagetype($src);
    
        // if no valid type or no handler found -> exit
        if (!$type || !IMAGE_HANDLERS[$type]) {
            return null;
        }
    
        // load the image with the correct loader
        $image = call_user_func(IMAGE_HANDLERS[$type]['load'], $src);
    
        // no image found at supplied location -> exit
        if (!$image) {
            return null;
        }
    
    
        // 2. Create a thumbnail and resize the loaded $image
        // - get the image dimensions
        // - define the output size appropriately
        // - create a thumbnail based on that size
        // - set alpha transparency for GIFs and PNGs
        // - draw the final thumbnail
    
        // get original image width and height
        $width = imagesx($image);
        $height = imagesy($image);
    
        // maintain aspect ratio when no height set
        if ($targetHeight == null) {
    
            // get width to height ratio
            $ratio = $width / $height;
    
            // if is portrait
            // use ratio to scale height to fit in square
            if ($width > $height) {
                $targetHeight = floor($targetWidth / $ratio);
            }
            // if is landscape
            // use ratio to scale width to fit in square
            else {
                $targetHeight = $targetWidth;
                $targetWidth = floor($targetWidth * $ratio);
            }
        }
    
        // create duplicate image based on calculated target size
        $thumbnail = imagecreatetruecolor($targetWidth, $targetHeight);
    
        // set transparency options for GIFs and PNGs
        if ($type == IMAGETYPE_GIF || $type == IMAGETYPE_PNG) {
    
            // make image transparent
            imagecolortransparent(
                $thumbnail,
                imagecolorallocate($thumbnail, 0, 0, 0)
            );
    
            // additional settings for PNGs
            if ($type == IMAGETYPE_PNG) {
                imagealphablending($thumbnail, false);
                imagesavealpha($thumbnail, true);
            }
        }
    
        // copy entire source image to duplicate image and resize
        imagecopyresampled(
            $thumbnail,
            $image,
            0, 0, 0, 0,
            $targetWidth, $targetHeight,
            $width, $height
        );
    
    
        // 3. Save the $thumbnail to disk
        // - call the correct save method
        // - set the correct quality level
    
        // save the duplicate version of the image to disk
        return call_user_func(
            IMAGE_HANDLERS[$type]['save'],
            $thumbnail,
            $dest,
            IMAGE_HANDLERS[$type]['quality']
        );
    }

    function createSlug($string, $id = null,$modelName) {
        $slug = Inflector::slug($string, '-');
        $slug = strtolower($slug);
        $this->loadModel('Admin.'.$modelName);
        $i = 0;
        $params = array(
          'conditions' => array($modelName.'.slug' => $slug), 
          'fields' => array($modelName.'.id',$modelName.'.slug'));
    
        if (!is_null($id)) 
          $params['conditions']['not'] = array($modelName.'.id'=>$id);
        
        while (count($this->$modelName->find('all', $params)))  {
          $i++;
          $params['conditions'][$modelName.'.slug'] = $slug."-".$i;
        }
        if ($i) $slug .= "-".$i;
    
        return $slug;
    }


    

    
}

