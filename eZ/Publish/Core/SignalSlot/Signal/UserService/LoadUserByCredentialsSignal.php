<?php
/**
 * LoadUserByCredentialsSignal class
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @version //autogentag//
 */

namespace eZ\Publish\Core\SignalSlot\Signal\UserService;
use eZ\Publish\Core\SignalSlot\Signal;

/**
 * LoadUserByCredentialsSignal class
 * @package eZ\Publish\Core\SignalSlot\Signal\UserService
 */
class LoadUserByCredentialsSignal extends Signal
{
    /**
     * Login
     *
     * @var mixed
     */
    public $login;

    /**
     * Password
     *
     * @var mixed
     */
    public $password;

}
