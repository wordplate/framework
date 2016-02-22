<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WordPlate\WordPress\Components;

use WordPlate\Exceptions\InvalidConfigurationException;

/**
 * This is the editor component.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
final class Editor extends Component
{
    /**
     * Bootstrap the component.
     *
     * @return void
     */
    public function register()
    {
        $this->imageEditOverwrite();

        $this->filter->add('content_save_pre', [$this, 'contentSavePre']);
        $this->filter->add('jpeg_quality', [$this, 'jpegQuality']);
        $this->filter->add('sanitize_file_name', [$this, 'sanitizeFileName'], 10, 2);
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
        return (int) config('editor.jpeg_quality', 100);
    }

    /**
     * Remove special characters in file names.
     *
     * @param string $name
     *
     * @return string
     */
    public function sanitizeFileName($name)
    {
        return remove_accents($name);
    }

    /**
     * Remove Microsoft Word formatting on save for TinyMCE.
     *
     * @param string $content
     *
     * @return string
     */
    public function contentSavePre($content)
    {
        return preg_replace('/<!--\[if gte mso.*?-->/ms', '', $content);
    }

    /**
     * Modifying TinyMCE editor to remove unused items.
     *
     * @param array $init
     *
     * @return array
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
     * Remove meta boxes in post edit.
     *
     * @throws \WordPlate\Exceptions\InvalidConfigurationException
     *
     * @return void
     */
    public function removeMetaBoxes()
    {
        $types = config('editor.meta_boxes');

        if (!is_array($types)) {
            throw new InvalidConfigurationException('editor.meta_boxes', 'array');
        }

        foreach ($types as $type => $boxes) {
            foreach ($boxes as $box) {
                remove_meta_box($box, $type, 'normal');
            }
        }
    }
}
