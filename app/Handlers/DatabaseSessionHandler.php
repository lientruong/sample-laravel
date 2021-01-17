<?php

namespace App\Handlers;

class DatabaseSessionHandler extends \Illuminate\Session\DatabaseSessionHandler {

    /**
     * Get the default payload for the session.
     *
     * @param  string  $data
     * @return array
     */
    protected function getDefaultPayload($data)
    {
        $a = parent::getDefaultPayload($data);
        $this->addTenantInformation($a);
        return $a;
    }

    /**
     * Add the request information to the session payload.
     *
     * @param  array  $payload
     * @return $this
     */
    protected function addTenantInformation(&$payload)
    {
        $payload['tenant_id'] = empty(tenancy()->tenant) ? null : tenancy()->tenant->id;

        return $this;
    }}