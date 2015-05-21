<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WordPlate\Components;

/**
 * This is the editor component.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class Editor extends AbstractComponent
{
    /**
     * Bootstrap the component.
     *
     * @return void
     */
    public function bootstrap()
    {
        $this->imageEditOverwrite();

        $this->filter->add('content_save_pre', [$this, 'contentSavePre']);
        $this->filter->add('jpeg_quality', [$this, 'jpegQuality']);
        $this->filter->add('tiny_mce_before_init', [$this, 'tinyMceBeforeInit']);

        $this->action->add('admin_menu', [$this, 'removeMetaBoxes']);
    }

    /**
     * Custom JPEG quality.
     *
     * @return int
     */
    public function jpegQuality()
    {
        return config('editor.jpeg_quality', 100);
    }

    /**
     * Remove Microsoft Word formatting on save for TinyMCE.
     *
     * @param $content
     *
     * @return mixed
     */
    public function contentSavePre($content)
    {
        return preg_replace('/<!--\[if gte mso.*?-->/ms', '', $content);
    }
    
    /**
     * Modifying TinyMCE editor to remove unused items.
     *
     * @param $init
     *
     * @return mixed
     */
    public function tinyMceBeforeInit($init)
    {
        // Add block format elements you want to show in dropdown.
        $init['block_formats'] = implode(';', config('editor.tinymce.blockformats'));

        // Disable buttons for the two toolbars.
        $toolbar1 = explode(',', $init['toolbar1']);
        $buttons1 = array_diff($toolbar1, config('editor.tinymce.disabled'));

        $toolbar2 = explode(',', $init['toolbar2']);
        $buttons2 = array_diff($toolbar2, config('editor.tinymce.disabled'));

        $init['toolbar1'] = implode(',', $buttons1);
        $init['toolbar2'] = implode(',', $buttons2);

        // Disable custom format on copy paste (useful when clients copy from Ms Word).
        $init['extended_valid_elements'] = 'span[!class]';
        $init['paste_auto_cleanup_on_paste'] = true;
        $init['paste_strip_class_attributes'] = 'all';
        $init['paste_remove_styles'] = true;

        return $init;
    }

    /**
     * Cleanup image edits.
     *
     * @return void
     */
    public function imageEditOverwrite()
    {
        if (!defined('IMAGE_EDIT_OVERWRITE')) {
            define('IMAGE_EDIT_OVERWRITE', config('theme.image_edit_overwrite', true));
        }
    }

    /**
     * Remove meta boxes in post edit.
     *
     * @return void
     */
    public function removeMetaBoxes()
    {
        $types = config('editor.meta_boxes');

        foreach ($types as $type => $boxes) {
            foreach ($boxes as $box) {
                remove_meta_box($box, $type, 'normal');
            }
        }
    }
}
