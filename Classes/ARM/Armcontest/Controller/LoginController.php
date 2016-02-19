<?php
namespace ARM\Armcontest\Controller;

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Error\Message;
class LoginController extends \TYPO3\Flow\Mvc\Controller\ActionController {

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Session\SessionInterface
	 */
	protected $session;
	
	/*
    * @var string
    */
	protected $providerName = 'DefaultProvider';
    /**
     * @var \TYPO3\Flow\Utility\Now
     * @Flow\Inject
     */

    protected $time;

    /**
     * @var \TYPO3\Flow\Security\Cryptography\HashService
     * @Flow\Inject
     */
    protected $hashService;
    /**
     * @var \TYPO3\Flow\Utility\Algorithms
     * @Flow\Inject
     */
    protected $algorithms;
	/**
	 * @var $settings
	 * @Flow\Inject
	 */
	protected $settings;
	/**
	 * @var \TYPO3\Flow\Security\Authentication\AuthenticationManagerInterface
	 * @Flow\Inject
	 */
	protected $authenticationManager;

	/**
	 * @var \TYPO3\Flow\Security\AccountRepository
	 * @Flow\Inject
	 */
	protected $accountRepository;

	/**
	 * @Flow\Inject
	 * @var \ARM\Armcontest\Domain\Repository\UserRepository
	 */
	protected $userRepository;

	/**
	 * @var \TYPO3\Flow\Security\AccountFactory
	 * @Flow\Inject
	 */
	protected $accountFactory;

	/**
	 * @var \ARM\Armcontest\Factory\UserFactory
	 * @Flow\Inject
	 */
	protected $userFactory;

	/**
	 * @var \TYPO3\Flow\Security\Context
	 * @Flow\Inject
	 */
	protected $securityContext;

    /**
     * A standalone template view
     *
     * @Flow\Inject
     * @var \TYPO3\Fluid\View\StandaloneView
     */
    protected $standaloneView;
	
	
	/**
	 * index action, does only display the form
	 */
	public function indexAction() {
		$account = $this->securityContext->getAccount();
	}
	
	
	/**
	 * @throws \TYPO3\Flow\Security\Exception\AuthenticationRequiredException
	 * @return void
	 */
	public function authenticateAction() {
		
		try {
			$this->authenticationManager->authenticate();
			$this->flashMessageContainer->addMessage(
				new Message('Login successful')
			);
			$this->redirect('index', 'Standard');
		} catch (\TYPO3\Flow\Security\Exception\AuthenticationRequiredException $exception) {

			$this->flashMessageContainer->addMessage(new \TYPO3\Flow\Error\Error('Login failed'));
			$this->redirect('index', 'Standard');
		}
	}

	
    public function logoutAction() {
        $this->authenticationManager->logout();
		$this->flashMessageContainer->addMessage(
			new Message('Logout successful')
		);
        $this->redirect('index', 'Standard');
    }
    
	/**
	 * @param \TYPO3\Flow\Security\Exception\AuthenticationRequiredException $exception The exception thrown while the authentication process
	 * @return void
	 */
	protected function onAuthenticationFailure(\TYPO3\Flow\Security\Exception\AuthenticationRequiredException $exception = NULL) {
		$this->flashMessageContainer->addMessage(new \TYPO3\Flow\Error\Error('Authentication failed!', ($exception === NULL ? 1347016771 : $exception->getCode())));

	}
}