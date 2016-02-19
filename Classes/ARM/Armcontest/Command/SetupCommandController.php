<?php
namespace ARM\Armcontest\Command;

use TYPO3\Flow\Annotations as Flow;

/**
 * The setup controller for the Blog package, for setting up some
 * data to play with.
 *
 * @Flow\Scope("singleton")
 */
class SetupCommandController extends \TYPO3\Flow\Cli\CommandController {


	/**
	 * @Flow\Inject
	 * @var \TYPO3\Party\Domain\Repository\PartyRepository
	 */
	protected $partyRepository;

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Security\AccountRepository
	 */
	protected $accountRepository;

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Security\AccountFactory
	 */
	protected $accountFactory;

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Security\Authentication\AuthenticationManagerInterface
	 */
	protected $authenticationManager;

	/**
	 * Create an editor account
	 *
	 * Creates a new account which has editor rights.
	 *
	 * @param string $identifier Account identifier, aka "user name"
	 * @param string $password Plain text password for the new account
	 * @param string $firstName First name of the account's holder
	 * @param string $lastName Last name of the account's holder
	 * @return void
	 */
	public function createAccountCommand($identifier, $password, $firstName, $lastName) {
		$account = $this->accountFactory->createAccountWithPassword($identifier, $password, array('ARM.Armcontest:User'));
		$this->accountRepository->add($account);

		$personName = new \TYPO3\Party\Domain\Model\PersonName('', $firstName, '', $lastName);
		$person = new \TYPO3\Party\Domain\Model\Person();
		$person->setName($personName);
		$person->addAccount($account);
		$this->partyRepository->add($person);

		$this->outputLine('The account "%s" was created.', array($identifier));
	}
}
?>