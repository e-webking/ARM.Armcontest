<?php

namespace ARM\Armcontest\Factory;

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Party\Domain\Model\ElectronicAddress;
use TYPO3\Flow\Security\Account;
use TYPO3\Flow\Validation\Error;
use TYPO3\Flow\Error\Message;

/**
 * Class UserFactory
 *
 * @package ARM\ArmcontestFactory
 * @Flow\Scope("singleton")
 */
class UserFactory {

    const AUTHENTICATION_PROVIDER_NAME = 'DefaultProvider';
    const CURRENT_PACKAGE_KEY = 'ARM.Armcontest';
    const BASIC_USER_GROUP = 'ARM.Armcontest:User';

    /**
     * @var \TYPO3\Flow\Security\AccountFactory
     * @Flow\Inject
     */
    protected $accountFactory;

    /**
     * @var \TYPO3\Flow\Security\AccountRepository
     * @Flow\Inject
     */
    protected $accountRepository;

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
     * @var \TYPO3\Flow\Security\Policy\PolicyService
     * @Flow\Inject
     */
    protected $policyService;

    /**
     * Returns the authentication provider name
     *
     * @return string
     */
    public function getAuthenticationProviderName() {
        return self::AUTHENTICATION_PROVIDER_NAME;
    }

    /**
     * Creates a User with the given information
     *
     * The User is not added to the repository, the caller has to add the
     * User account to the AccountRepository and the User to the
     * PartyRepository to persist it.
     *
     * @param string $username The username of the user to be created.
     * @param string $password Password of the user to be created
     * @param string $firstName First name of the user to be created
     * @param string $lastName Last name of the user to be created
     * @param array $roleIdentifiers A list of role identifiers to assign
     * @return TYPO3\Party\Domain\Model\Person The created user instance
     */
    public function create($username, $password, $firstName, $lastName, array $roleIdentifiers = NULL) {
        $user = new  \ARM\ArmcontestDomain\Model\User();
        $name = new \TYPO3\Party\Domain\Model\PersonName('', $firstName, '', $lastName, '', $username);

        $user->setName($name);

        if ($roleIdentifiers === NULL || $roleIdentifiers === array()) {
            $roleIdentifiers = array(self::BASIC_USER_GROUP);
        }

        $account = $this->accountFactory->createAccountWithPassword($username, $password, $roleIdentifiers, self::AUTHENTICATION_PROVIDER_NAME);
        $user->addAccount($account);

        return $user;
    }

    /**
     * Returns all roles defined in the  ARM.Armcontest package
     *
     * @return array<\TYPO3\Flow\Security\Policy\Role>
     */
    public function getRoles() {
        $roles = array();
        foreach ($this->policyService->getRoles() as $role) {
            if ($role->getPackageKey() === self::CURRENT_PACKAGE_KEY) {
                $roles[] = $role;
            }
        }
        return $roles;
    }
}