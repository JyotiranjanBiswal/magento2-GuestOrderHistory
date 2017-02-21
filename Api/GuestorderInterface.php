<?php

/**
 * Copyright 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Born\OrderController\Api;

/**
 * Defines the service contract for some simple maths functions. The purpose is
 * to demonstrate the definition of a simple web service, not that these
 * functions are really useful in practice. The function prototypes were therefore
 * selected to demonstrate different parameter and return values, not as a good
 * calculator design.
 */
interface GuestorderInterface
{
    /**
     * Return mixed.
     *
     * @api
     * @param string $param.
     * @return mixed.
     */
    public function getGuestOrderHistory($param);
}