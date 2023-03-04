<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Breadcrumbs
{
    private $breadcrumbs = array();
    private $tag_open = '';
    private $tag_close = '';
    private $tag_item_open = '';
    private $tag_item_open_active = '';
    private $tag_item_close = '';
    private $result = '';

    function __construct($config = array(), $reset_output = TRUE)
    {
        if ($reset_output) $this->result = '';
        if (!empty($config)) {
            if (!is_array($config)) $this->LoadDefaultConfig(TRUE);
            else {
                if (key_exists('tag_open', $config)) $this->SetTagOpen($config['tag_open']);
                else $this->LoadDefaultConfig(FALSE, 'tag_open');

                if (key_exists('tag_close', $config)) $this->SetTagOpen($config['tag_close']);
                else $this->LoadDefaultConfig(FALSE, 'tag_close');

                if (key_exists('tag_item_open', $config)) $this->SetTagOpen($config['tag_item_open']);
                else $this->LoadDefaultConfig(FALSE, 'tag_item_open');

                if (key_exists('tag_item_open_active', $config)) $this->SetTagOpen($config['tag_item_open_active']);
                else $this->LoadDefaultConfig(FALSE, 'tag_item_open_active');

                if (key_exists('tag_item_close', $config)) $this->SetTagOpen($config['tag_item_close']);
                else $this->LoadDefaultConfig(FALSE, 'tag_item_close');

                if (key_exists('anchor', $config)) $this->SetTagOpen($config['anchor']);
                else $this->LoadDefaultConfig(FALSE, 'anchor');
            }
        } else $this->LoadDefaultConfig(TRUE);
    }

    public function Initialize($config = array())
    {
        if (!empty($config)) {
            if (!is_array($config)) $this->LoadDefaultConfig(TRUE);
            else {
                if (key_exists('tag_open', $config)) $this->SetTagOpen($config['tag_open']);
                else $this->LoadDefaultConfig(FALSE, 'tag_open');

                if (key_exists('tag_close', $config)) $this->SetTagOpen($config['tag_close']);
                else $this->LoadDefaultConfig(FALSE, 'tag_close');

                if (key_exists('tag_item_open', $config)) $this->SetTagOpen($config['tag_item_open']);
                else $this->LoadDefaultConfig(FALSE, 'tag_item_open');

                if (key_exists('tag_item_open_active', $config)) $this->SetTagOpen($config['tag_item_open_active']);
                else $this->LoadDefaultConfig(FALSE, 'tag_item_open_active');

                if (key_exists('tag_item_close', $config)) $this->SetTagOpen($config['tag_item_close']);
                else $this->LoadDefaultConfig(FALSE, 'tag_item_close');

                if (key_exists('anchor', $config)) $this->SetTagOpen($config['anchor']);
                else $this->LoadDefaultConfig(FALSE, 'anchor');
            }
        } else $this->LoadDefaultConfig(TRUE);
    }

    private function LoadDefaultConfig($load_all = FALSE, $key = '')
    {
        if ($load_all == TRUE) {
            $this->tag_open = '<ol class="breadcrumb float-sm-right">';
            $this->tag_close = '</ol>';
            $this->tag_item_open = '<li class="breadcrumb-item">';
            $this->tag_item_open_active = '<li class="breadcrumb-item active">';
            $this->tag_item_close = '</li>';
        } else {
            switch ($key) {
                case 'tag_open': {
                        $this->tag_open = '<ol class="breadcrumb float-sm-right">';
                        break;
                    }
                case 'tag_close': {
                        $this->tag_close = '</ol>';
                        break;
                    }
                case 'tag_item_open': {
                        $this->tag_item_open = '<li class="breadcrumb-item>';
                        break;
                    }
                case 'tag_item_open_active': {
                        $this->tag_item_open_active = '<li class="breadcrumb-item active">';
                        break;
                    }
                case 'tag_item_close': {
                        $this->tag_item_close = '</li>';
                        break;
                    }

                default:
                    break;
            }
        }
    }

    public function SetTagOpen($html_element = '')
    {
        if ($html_element == '') $this->LoadDefaultConfig(FALSE, 'tag_open');
        else $this->tag_open = $html_element;
    }

    public function SetTagClose($html_element = '')
    {
        if ($html_element == '') $this->LoadDefaultConfig(FALSE, 'tag_close');
        else $this->tag_close = $html_element;
    }

    public function SetTagItemOpen($html_element = '')
    {
        if ($html_element == '') $this->LoadDefaultConfig(FALSE, 'tag_close');
        else $this->tag_item_open = $html_element;
    }

    public function SetTagItemOpenActive($html_element = '')
    {
        if ($html_element == '') $this->LoadDefaultConfig(FALSE, 'tag_close');
        else $this->tag_item_open_active = $html_element;
    }

    public function SetTagItemClose($html_element = '')
    {
        if ($html_element == '') $this->LoadDefaultConfig(FALSE, 'tag_close');
        else $this->tag_item_close = $html_element;
    }

    public function AddItem($title = '', $href = '')
    {
        $this->breadcrumbs[] = array(
            'title' => $title,
            'href' => ($href == '' ? 'javascript:void(0)' : $href)
        );
    }

    public function AddMultipleItems($data = array())
    {
        if (!is_array($data)) return;
        else {
            foreach ($data as $key => $value) {
                $this->breadcrumbs[] = array(
                    'title' => $key,
                    'href' => ($value == '' ? 'javascript:void(0)' : $value)
                );
            }
        }
    }

    public function Render()
    {
        $breadcrumb_count = count($this->breadcrumbs) - 1;
        $this->result .= $this->tag_open;
        foreach ($this->breadcrumbs as $key => $value) {
            if ($key === $breadcrumb_count) {
                $this->result .= $this->tag_item_open_active;
                $this->result .= $value['title'];
                $this->result .= $this->tag_item_close;
                // $this->result .= 'Last Index';
            } else {
                $this->result .= $this->tag_item_open;
                $this->result .= '<a href="' . $value['href'] . '">' . $value['title'] . '</a>';
                $this->result .= $this->tag_item_close;
            }
        }

        $this->result .= $this->tag_close;
        return $this->result;
    }
}
