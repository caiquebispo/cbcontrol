<?php

it('has http/controllers/permissioncontroller page', function () {
    $response = $this->get('/http/controllers/permissioncontroller');

    $response->assertStatus(200);
});
