<?php
defined( '_JEXEC' ) or die;

class plgContentPlg_sumdu_modal extends JPlugin
{
	/**
	 * Load the language file on instantiation. Note this is only available in Joomla 3.1 and higher.
	 * If you want to support 3.0 series you must override the constructor
	 *
	 * @var    boolean
	 * @since  3.1
	 */
    protected $autoloadLanguage = true;
    private static $modalId     = 0;

	function onContentPrepare($context, &$article, &$params, $limitstart = 0) {
        $pregModal = '/(\{modal title\=\")(.+?)(\"})(.+?)(\{\/modal})/s';
        while (preg_match($pregModal, $article->text, $segments)) {
           $preparedText = '<a href="#plg_sumdu_modal_'. self::$modalId .'" role="button" class="btn" data-toggle="modal">'. $segments[2] .'</a>' . 
            '<div id="plg_sumdu_modal_'. self::$modalId .'" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="plg_sumdu_modal_label_'. self::$modalId .'">'. $segments[2] .'</h3>
                </div>
                <div class="modal-body">
                    '. $segments[4] .'
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">OK</button>
                </div>
            </div>';

            $article->text = str_replace(
                $segments[0], 
                $preparedText, 
                $article->text
            );
            self::$modalId++;
        }

        return true;
    }
}
?>