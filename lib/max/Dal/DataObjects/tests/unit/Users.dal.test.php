<?php

/*
+---------------------------------------------------------------------------+
| Revive Adserver                                                           |
| http://www.revive-adserver.com                                            |
|                                                                           |
| Copyright: See the COPYRIGHT.txt file.                                    |
| License: GPLv2 or later, see the LICENSE.txt file.                        |
+---------------------------------------------------------------------------+
*/

require_once MAX_PATH . '/lib/OA/Dal.php';
require_once MAX_PATH . '/lib/max/Dal/tests/util/DalUnitTestCase.php';

/**
 * A class for testing non standard DataObjects_Users methods
 *
 * @package    MaxDal
 * @subpackage TestSuite
 *
 */
class DataObjects_UsersTest extends DalUnitTestCase
{
    var $userId;

    /**
     * The constructor method.
     */
    function __construct()
    {
        parent::__construct();
    }

    function setUp()
    {
        $doUsers = OA_Dal::factoryDO('users');
        $doUsers->contact_name = 'foo';
        $doUsers->username = 'Foo';
        $oDate = new Date();
        $doUsers->date_created = $doUsers->formatDate($oDate);
        $this->userId = DataGenerator::generateOne($doUsers);
        $this->assertTrue($this->userId);
    }

    function tearDown()
    {
        DataGenerator::cleanUp();
    }

    /**
     * Creates user and set
     *
     * @param DataObject $doUsers
     * @param integer $cUsers
     * @return array | integer  Array of users ids or one user id
     *                          if only one record was created
     */
    function createUser($doUsers = null, $cUsers = 1)
    {
        static $userCounter = 0;
        if (!$doUsers) {
            $doUsers = OA_Dal::factoryDO('users');
        }
        $aUsersIds = array();
        for ($i = 1; $i <= $cUsers; $i++) {
            if (empty($doUsers->username)) {
                $doUsers->username = 'test'.++$userCounter;
            }
            $aUsersIds[] = DataGenerator::generateOne($doUsers);
        }
        if ($cUsers == 1) {
            return $aUsersIds[0];
        }
        return $aUsersIds;
    }

    function testInsert()
    {
        $doUsers = OA_Dal::staticGetDO('users', $this->userId);
        $this->assertEqual($doUsers->username, 'foo');
    }

    function testUpdate()
    {
        $doUsers = OA_Dal::factoryDO('users');
        $doUsers->user_id = $this->userId;
        $doUsers->username = 'Bar';
        $this->assertTrue($doUsers->update());

        $doUsers = OA_Dal::staticGetDO('users', $this->userId);
        $this->assertEqual($doUsers->username, 'bar');
    }

    function testUserExists()
    {
        $doUsers = OA_Dal::factoryDO('users');
        $this->assertTrue($doUsers->userExists('foo'));
        $this->assertTrue($doUsers->userExists('Foo'));
        $this->assertTrue($doUsers->userExists('FOO'));
    }

    function testLogDateLastLogIn()
    {
        $userId = DataGenerator::generateOne('users');
        $now = new Date();
        $doUsers = OA_Dal::staticGetDO('users', $userId);
        $doUsers->logDateLastLogIn($now);
        $doUsers = OA_Dal::staticGetDO('users', $userId);
        $nowFormatted = $doUsers->formatDate($now);
        $this->assertEqual($doUsers->date_last_login, $nowFormatted);
    }

    function testDeleteUnverifiedUsers()
    {
        DataGenerator::cleanUp();
        $doUsers = OA_Dal::factoryDO('users');
        $cExistingUsers = $doUsers->count();

        // this user was created recently
        $doUsers = OA_Dal::factoryDO('users');
        $date = new Date();
        $date->subtractSeconds(SECONDS_PER_DAY);
        $doUsers->date_created = $doUsers->formatDate($date);
        $this->createUser($doUsers);

        // this user was created over a month ago - should be deleted
        $overMonthAgoSeconds = 31 * SECONDS_PER_DAY;
        $doUsers = OA_Dal::factoryDO('users');
        $date->subtractSeconds($overMonthAgoSeconds);
        $doUsers->date_created = $doUsers->formatDate($date);
        $this->createUser($doUsers);

        // this was created over a month ago but is verified
        $doUsers = OA_Dal::factoryDO('users');
        $date = new Date();
        $date->subtractSeconds($overMonthAgoSeconds);
        $doUsers->date_created = $doUsers->formatDate($date);
        $doUsers->sso_user_id = 123;
        $this->createUser($doUsers);

        $doUsers = OA_Dal::factoryDO('users');
        $this->assertEqual($doUsers->count(), 3 + $cExistingUsers);

        $doUsers = OA_Dal::factoryDO('users');
        $doUsers->deleteUnverifiedUsers(28 * SECONDS_PER_DAY);

        // check if one record was deleted
        $doUsers = OA_Dal::factoryDO('users');
        $this->assertEqual($doUsers->count(), 2 + $cExistingUsers);
    }

    function testRelinkAccounts()
    {
        $aExistingAccountPermissions = array(
            1 => array(1,2),
            2 => array(2),
        );
        $aPartialAccountPermissions = array(
            1 => array(1,3),
            2 => array(2),
            3 => array(1),
        );
        $existingUserId = $this->createUser();
        $this->_setAccountsAndPermissions($existingUserId, $aExistingAccountPermissions);
        $partialUserId = $this->createUser();
        $this->_setAccountsAndPermissions($partialUserId, $aPartialAccountPermissions);

        $doUsers = OA_Dal::factoryDO('users');
        $ret = $doUsers->relinkAccounts($existingUserId, $partialUserId);
        $this->assertTrue($ret);

        $aNewPermissions = $doUsers->getUsersPermissions($existingUserId);
        $this->_checkIfPermissionsExists($aExistingAccountPermissions, $aNewPermissions);
        $this->_checkIfPermissionsExists($aPartialAccountPermissions, $aNewPermissions);
    }

    function _checkIfPermissionsExists($permissionsToCheck, $aNewPermissions)
    {
        foreach ($permissionsToCheck as $accountId => $aPermissions) {
            foreach ($aPermissions as $permissionId) {
                $this->assertTrue(isset($aNewPermissions[$accountId][$permissionId]),
                        'Permission id('.$permissionId.') in account id('.$accountId.') is not set');
            }
        }
    }

    function _setAccountsAndPermissions($userId, $accountPermissions)
    {
        foreach ($accountPermissions as $accountId => $aPermissions) {
            OA_Permission::setAccountAccess($accountId, $userId);
            OA_Permission::storeUserAccountsPermissions($aPermissions, $accountId, $userId);
        }
    }

}
?>