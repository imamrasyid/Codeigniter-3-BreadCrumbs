A very simple library to generate breadcrumbs for codeigniter 3

Installation is very traightforward. Copy the file to system\libraries folder.

There are 2 methods:

    * AddItem($title, $href)
    * AddMultipleItems($data)
    * Render()

AddItem() will add each breadcrumbs to the stack
AddMultipleItems() will add multiple breadcrumbs to the stack
Render() will generate the full breadcrumb.

Codeigniter has 2 ways of loading a library: 

    1. Autoload
    2. Manual loading

**Autoloading** is useful if you will be using the library in many places. In our case, since we will need the breadcrumbs throughout the site, it will be better better if we autoload it. Search for

    application\config\autoload.php
    
and go to the line

    $autoload['libraries']
    
and add it to the array, like for example 
    
    array('breadcrumbs')
    
**Manual Loading**: 
You can alternatively load the library in the controller itself before calling its methods.

    $this->load->library('breadcrumbs');
    
Then, from your controller, add the following lines

    $this->breadcrumbs->AddItem('Home', base_url());
    $this->breadcrumbs->AddMultipleItems(array(
      'Home' => base_url(),
      'Another Segment' => base_url() . index_page() . '/another_segment'
    ));

which will add each lines submitted in an array. Finally, to get the breadcrumbs, use the render() method.

    $this->breadcrumbs->render();
    
Assign it to a variable and pass it to your views for output. 
    
    $data['breadcrumbs'] = $this->breadcrumbs->render();
    $this->load->view('examplepage',$data);

Breadcrumbs helps us trace our way back, starting from the current page and ideally up to the homepage. It is commonsense that the last link is the current page, and it should not be clickable. This will be handled automatically, where the last link will be non-clickable.

Note: This source based on https://github.com/reeazr/codeigniter-breadcrumb
