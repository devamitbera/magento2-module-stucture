<?php

namespace StackExchange\Magento\Controller;


class Router implements \Magento\Framework\App\RouterInterface
{

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * @var \Magento\Framework\App\ActionFactory
     */
    private $actionFactory;

    /**
     * @var \Magento\Framework\Event\ManagerInterface
     */
    private $eventManager;

    /**
     * @var \Magento\Framework\App\ResponseInterface
     */
    private $response;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    private $url;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var \Magento\Cms\Model\PageFactory
     */
    private $pageFactory;

    public function __construct(
        \Magento\Framework\App\ActionFactory $actionFactory,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Magento\Framework\UrlInterface $url,
        \Magento\Cms\Model\PageFactory $pageFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\App\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger  
    ) {
        
        $this->pageFactory = $pageFactory;
        $this->storeManager = $storeManager;
        $this->url = $url;
        $this->response = $response;
        $this->eventManager = $eventManager;
        $this->actionFactory = $actionFactory;
        $this->logger = $logger;
    }

    public function match(\Magento\Framework\App\RequestInterface $request)
    {
        $this->logger->critical(__METHOD__);
        
        $identifier = trim($request->getPathInfo(), '/');
        $this->logger->critical('identifier >>  '. $identifier);
        
        $condition = new \Magento\Framework\DataObject(['identifier' => $identifier, 'continue' => true]);
        return null;
    }

}
