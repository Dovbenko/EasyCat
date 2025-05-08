<?php declare(strict_types=1);

namespace BySudo\EasyCat\Controller\Form;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Data\Form\FormKey\Validator as FormKeyValidator;

/**
 * Controller for handling the custom checkout form submission.
 */
class Submit implements HttpPostActionInterface
{
    /**
     * Submit constructor with property promotion.
     */
    public function __construct(
        private Context $context,
        private JsonFactory $resultJsonFactory,
        private FormKeyValidator $formKeyValidator
    ) {}

    /**
     * Execute the form submission and return a JSON response.
     *
     * @return \Magento\Framework\Controller\Result\Json
     */
    public function execute()
    {
        $resultJson = $this->resultJsonFactory->create();
        $response = ['success' => false];

        try {
            $this->validateFormKey();
            $request = $this->context->getRequest();

            $name = $request->getParam('name');
            $email = $request->getParam('email');
            $comment = $request->getParam('comment');

            // TODO: Add logic to process the form data

            $response = [
                'success' => true,
                'message' => __('Form submitted successfully')
            ];
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }

        return $resultJson->setData($response);
    }

    /**
     * Validate the form key or throw an exception if invalid.
     *
     * @throws \Exception
     */
    private function validateFormKey(): void
    {
        $request = $this->context->getRequest();

        if (!$this->formKeyValidator->validate($request)) {
            throw new \Exception(__('Invalid form key'));
        }
    }
}
