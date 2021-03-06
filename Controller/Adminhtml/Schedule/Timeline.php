<?php
/**
 * KiwiCommerce
 *
 * Do not edit or add to this file if you wish to upgrade to newer versions in the future.
 * If you wish to customise this module for your needs.
 * Please contact us https://kiwicommerce.co.uk/contacts.
 *
 * @category   KiwiCommerce
 * @package    KiwiCommerce_CronScheduler
 * @copyright  Copyright (C) 2018 Kiwi Commerce Ltd (https://kiwicommerce.co.uk/)
 * @license    https://kiwicommerce.co.uk/magento2-extension-license/
 */

namespace KiwiCommerce\CronScheduler\Controller\Adminhtml\Schedule;

use Magento\Framework\Controller\ResultFactory;

/**
 * Class Timeline
 * @package KiwiCommerce\CronScheduler\Controller\Adminhtml\Schedule
 */
class Timeline extends \Magento\Backend\App\Action
{
    /**
     * @var \KiwiCommerce\CronScheduler\Helper\Schedule
     */
    public $scheduleHelper = null;

    /**
     * @var string
     */
    protected $aclResource = "job_schedule_timeline";

    /**
     * Class constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \KiwiCommerce\CronScheduler\Helper\Schedule $scheduleHelper
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \KiwiCommerce\CronScheduler\Helper\Schedule $scheduleHelper
    ) {
        $this->scheduleHelper = $scheduleHelper;
        parent::__construct($context);
    }

    /**
     * Is action allowed?
     * @return boolean
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('KiwiCommerce_CronScheduler::'.$this->aclResource);
    }

    /**
     * Action to display timeline
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $this->scheduleHelper->getLastCronStatusMessage();
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu("Magento_Backend::system");
        $resultPage->getConfig()->getTitle()->prepend(__('Cron Scheduler Timeline'));
        $resultPage->addBreadcrumb(__('CronScheduler'), __('CronScheduler'));
        return $resultPage;
    }
}
