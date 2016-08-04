<?php
/*
 *  Copyright notice
 *
 *  (c) 2016 Andreas Thurnheer-Meier <tma@iresults.li>, iresults
 *  Daniel Corn <cod@iresults.li>, iresults
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 */
namespace Iresults\NewsFilter\Tests\Unit;

/**
 * @author COD
 * Created 20.07.16 16:26
 */
abstract class AbstractBootstrap
{

    public function run()
    {
        $this->loadTypo3();
        $this->configureAutoloader();
    }

    abstract protected function loadTypo3Bootstrap($base);

    private function loadTypo3()
    {
        if (file_exists(__DIR__ . '/../../../../../typo3')) {
            $base = realpath(__DIR__ . '/../../../../..');
        } elseif (getenv('TYPO3_PATH_WEB') && file_exists(getenv('TYPO3_PATH_WEB'))) {
            $base = realpath(getenv('TYPO3_PATH_WEB'));
        } else {
            throw new \RuntimeException('TYPO3 base not found. Please define the environment variable TYPO3_PATH_WEB');
        }
        $this->loadTypo3Bootstrap($base);
    }

    private function configureAutoloader()
    {
        spl_autoload_register(
            function ($className) {
                // Tx_IresultsUserRegistration_Service_NotificationService
                if ($this->hasPrefix($className, 'Tx_IresultsUserRegistration_', $restOfString)) {
                    require_once __DIR__ . '/../Classes/' . str_replace('_', '/', $restOfString) . '.php';
                } elseif ($this->hasPrefix($className, 'IresultsUserRegistration\\Tests\\', $restOfString)) {
                    require_once __DIR__ . '/../Tests/' . str_replace('\\', '/', $restOfString) . '.php';
                } elseif ($this->hasPrefix($className, 'IresultsUserRegistration\\', $restOfString)) {
                    require_once __DIR__ . '/../Classes/' . str_replace('\\', '/', $restOfString) . '.php';
                }
            }
        );

        // Load composer autoloader
        if (file_exists(__DIR__ . '/../vendor/')) {
            require_once __DIR__ . '/../vendor/autoload.php';
        } else {
            if (!class_exists('Cundd\\CunddComposer\\Autoloader')) {
                require_once __DIR__ . '/../../cundd_composer/Classes/Autoloader.php';
            }
            if (!class_exists('Cundd\\CunddComposer\\Utility\\GeneralUtility')) {
                require_once __DIR__ . '/../../cundd_composer/Classes/Utility/GeneralUtility.php';
            }
            \Cundd\CunddComposer\Autoloader::register();
        }
    }

    /**
     * @param string $input
     * @param string $prefix
     * @param        $restOfString
     * @return bool
     */
    private function hasPrefix($input, $prefix, &$restOfString)
    {
        $length = strlen($prefix);

        if (substr($input, 0, $length) === $prefix) {
            $restOfString = substr($input, $length);

            return true;
        }
        $restOfString = '';

        return false;
    }
}
