<?php declare(strict_types=1);

namespace BySudo\EasyCat\Block;

use Magento\Framework\View\Element\Template;

/**
 * Block class for rendering the custom checkout form.
 */
class CheckoutForm extends Template
{
    /**
     * Get the form action URL for the custom checkout form.
     *
     * @return string
     */
    public function getFormAction()
    {
        return $this->getUrl('easycat/form/submit');
    }
}
